<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 * function lists:
 * borobazar_post_meta()
 * borobazar_post_thumbnail()
 * borobazar_post_category()
 * borobazar_post_gallery_slider()
 * borobazar_post_navigation()
 * borobazar_allowed_iframe_html()
 * borobazar_get_header_layout_classes()
 */
const SVG_ARGS = [
    'svg' => [
        'fill'         => true,
        'width'        => true,
        'height'       => true,
        'stroke'       => true,
        'stroke-width' => true,
        'viewbox'      => true,
        'class'        => true,
    ],
    'path' => [
        'd'               => true,
        'fill'            => true,
        'fill-rule'       => true,
        'clip-rule'       => true,
        'stroke-width'    => true,
        'stroke-linecap'  => true,
        'stroke-linejoin' => true,
    ],
];

if (!function_exists('borobazar_post_meta')) {
    /**
     * borobazar_post_meta.
     *
     * @return void
     */
    function borobazar_post_meta()
    {
        $html = '';
        $allowedHTML = wp_kses_allowed_html('post');
        $allowedHTMLWithSvg = array_merge($allowedHTML, SVG_ARGS);

        $html .= '<span class="date flex items-center shrink-0">
        <svg stroke="#8C969F" fill="#8C969F" stroke-width="0" viewBox="0 0 17 17" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm8-7A8 8 0 110 8a8 8 0 0116 0z" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M7.5 3a.5.5 0 01.5.5v5.21l3.248 1.856a.5.5 0 01-.496.868l-3.5-2A.5.5 0 017 9V3.5a.5.5 0 01.5-.5z" clip-rule="evenodd" />
        </svg>
        <span class="ml-2 inline-flex items-center text-sm font-medium">' . get_the_date() . '</span>
        </span>';

        echo wp_kses($html, $allowedHTMLWithSvg);
    }
}

if (!function_exists('borobazar_post_thumbnail')) {
    /**
     * borobazar_post_thumbnail.
     *
     * @return void
     */
    function borobazar_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        if (is_singular()) { ?>
            <div class="post-thumbnail borobazar-image-fade-in inline-flex items-start rounded-md overflow-hidden">
                <?php the_post_thumbnail('opacity-0 transition-opacity duration-200'); ?>
            </div>
        <?php } else { ?>
            <a class="post-thumbnail borobazar-image-fade-in inline-flex items-start rounded-md overflow-hidden" href="<?php echo esc_url(get_the_permalink()); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('opacity-0 transition-opacity duration-200'); ?>
            </a>
<?php
        }
    }
}

if (!function_exists('borobazar_post_category')) {
    /**
     * borobazar_post_category.
     *
     * @return void
     */
    function borobazar_post_category()
    {
        $html = '';
        $home_url = home_url('/');
        $categories = get_the_category();
        $categoriesLength = count($categories);
        $remainCategoriesLength = $categoriesLength - 2;
        $categories = $categoriesLength >= 2 ? array_slice($categories, 0, 2) : $categories;
        $allowedHTML = wp_kses_allowed_html('post');
        $allowedHTMLWithSvg = array_merge($allowedHTML, SVG_ARGS);

        if ($categoriesLength > 0) {
            $html .= '<span class="categories flex items-center mr-2 sm:mr-4 md:mr-5">';
            $html .= '<svg class="mr-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                <path d="M8.56764 0.603179C8.96715 0.204781 9.51227 -0.0129221 10.0764 0.000593824L15.8461 0.14766C16.9426 0.175014 17.8252 1.05741 17.8525 2.15413L17.9994 7.92399C18.0128 8.48812 17.7952 9.03326 17.397 9.43295L9.4323 17.3977C8.62749 18.2008 7.32471 18.2008 6.51991 17.3977L0.603243 11.4808C-0.20108 10.6766 -0.20108 9.37245 0.603243 8.56809L8.56764 0.603179ZM1.18569 10.8983L7.10235 16.8151C7.5852 17.297 8.367 17.297 8.84985 16.8151L16.8144 8.85032C17.0533 8.61041 17.184 8.28345 17.1759 7.94491L17.0291 2.17505C17.0125 1.51711 16.4831 0.987579 15.8252 0.971167L10.0556 0.824101C10.0452 0.82394 10.035 0.823779 10.0246 0.823779C9.69682 0.824261 9.38258 0.954433 9.15041 1.18581L1.18569 9.15072C0.703964 9.6336 0.703964 10.4154 1.18569 10.8983Z" fill="#8C969F" stroke="#8C969F" stroke-width="0.5"/>
                <path d="M12.4999 4C13.3283 4 13.9999 4.67156 14 5.5C14 6.32844 13.3283 7 12.5 7C11.6716 7 11 6.32844 11 5.5C11.001 4.67205 11.6719 4.00097 12.4999 4ZM12.4999 6.37688C12.9843 6.37688 13.3768 5.98426 13.3769 5.5C13.3769 5.01574 12.9843 4.62312 12.5 4.62312C12.0157 4.62312 11.6231 5.01574 11.6231 5.5C11.6236 5.98402 12.0159 6.37627 12.4999 6.37688Z" fill="#8C969F"/>
                </g>
            </svg>
            ';
            foreach ($categories as $category) {
                $html .= '<a class="category mr-2 text-sm lowercase no-underline text-current font-medium" href="' . esc_url(get_term_link($category->term_id)) . '">' . $category->name . '</a>';
            }
            if ($categoriesLength > 2) {
                $html .= '<a class="more text-sm lowercase no-underline text-current font-medium" href="' . esc_url(get_permalink()) . '">' . $remainCategoriesLength . '+</a>';
            }
            $html .= '</span>';

            echo wp_kses($html, $allowedHTMLWithSvg);
        }
    }
}

if (!function_exists('borobazar_post_gallery_slider')) {
    /**
     * borobazar_post_gallery_slider.
     *
     * @return void
     */
    function borobazar_post_gallery_slider()
    {
        $html = '';
        $gallery = get_post_gallery(get_the_ID(), false);
        $allowedHTML = wp_kses_allowed_html('post');
        $allowedHTMLWithSvg = array_merge($allowedHTML, SVG_ARGS);

        if (!isset($gallery['src'])) {
            return;
        }

        $html .= '<div class="borobazar-post-gallery relative">';
        $html .= '<div class="swiper rounded-md bg-gray-200" id="swiper-' . esc_attr(get_the_ID()) . '">';
        $html .= '<div class="swiper-wrapper">';
        foreach ($gallery['src'] as $src) {
            $html .= '<div class="swiper-slide">';
            $html .= '<div class="borobazar-post-gallery-item flex items-center justify-center relative">';
            $html .= '<img src="' . esc_url($src) . '" class="gallery-img" alt="' . esc_attr__('Post gallery image', 'borobazar') . '" />';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        // end of .swiper-wrapper
        $html .= '<div class="swiper-pagination"></div>';
        $html .= '</div>';
        // end of .swiper
        $html .= '<button type="button" class="borobazar-post-gallery-prev w-8 h-8 sm:w-10 sm:h-10 absolute top-2/4 -mt-4 sm:-mt-5 left-2 sm:left-4 z-1 flex items-center justify-center p-0 bg-white text-lighter rounded-full cursor-pointer shadow-fab transition-all duration-200 hover:text-white focus:text-white hover:bg-brand focus:bg-brand" id="borobazar-post-gallery-prev-' . esc_attr(get_the_ID()) . '">';
        $html .= '<svg class="h-5 w-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>';
        $html .= '</button>';
        // end of .borobazar-post-gallery-prev
        $html .= '<button type="button" class="borobazar-post-gallery-next w-8 h-8 sm:w-10 sm:h-10 absolute top-2/4 -mt-4 sm:-mt-5 right-2 sm:right-4 z-1 flex items-center justify-center p-0 bg-white text-lighter rounded-full cursor-pointer shadow-fab transition-all duration-200 hover:text-white focus:text-white hover:bg-brand focus:bg-brand" id="borobazar-post-gallery-next-' . esc_attr(get_the_ID()) . '">';
        $html .= '<svg class="h-5 w-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
        $html .= '</button>';
        // end of .borobazar-post-gallery-next
        $html .= '</div>';

        echo wp_kses($html, $allowedHTMLWithSvg);
    }
}

if (!function_exists('borobazar_post_navigation')) {
    /**
     * borobazar_post_navigation.
     *
     * @return void
     */
    function borobazar_post_navigation()
    {
        $prevPost = get_previous_post();
        $nextPost = get_next_post();
        $allowedHTML = wp_kses_allowed_html('post');
        $allowedHTMLWithSvg = array_merge($allowedHTML, SVG_ARGS);
        $html = '';

        if ($prevPost || $nextPost) {
            $html .= '<nav class="navigation post-navigation pt-10 lg:pt-18">';
            $html .= '<div class="nav-links flex items-start sm:items-center justify-between relative">';
            if ($prevPost) {
                $html .= '<a class="nav-previous group w-full inline-flex items-center pr-2.5 sm:pr-5 3xl:pr-10 no-underline" href="' . esc_url(get_permalink($prevPost->ID)) . '">';
                if (get_the_post_thumbnail($prevPost->ID)) {
                    $html .= '<span class="thumb-img hidden sm:flex sm:shrink-0 sm:items-center w-20 h-20 relative mr-5 rounded-md overflow-hidden transition-opacity duration-300 group-hover:opacity-80 group-focus:opacity-80">' . get_the_post_thumbnail($prevPost->ID) . '</span>';
                }
                $html .= '<span class="nav-text">';
                $html .= '<span class="flex items-center text-lighter mb-1 sm:mb-2">';
                $html .= '<svg class="mr-2" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.150305 5.00003C0.150305 5.17925 0.218736 5.35845 0.355309 5.49508L4.65513 9.79486C4.92865 10.0684 5.37212 10.0684 5.64553 9.79486C5.91894 9.52145 5.91894 9.07807 5.64553 8.80452L1.84081 5.00003L5.64539 1.19551C5.91881 0.921988 5.91881 0.478652 5.64539 0.205262C5.37198 -0.0683918 4.92852 -0.0683918 4.65499 0.205262L0.355175 4.50497C0.21858 4.64168 0.150305 4.82087 0.150305 5.00003Z" fill="#8C969F"/></svg>';
                $html .= esc_html__('Previous', 'borobazar');
                $html .= '</span>';
                $html .= '<h6 class="m-0 font-semibold">' . $prevPost->post_title . '</h6>';
                $html .= '</span>';
                $html .= '</a>';
            }
            if ($prevPost && $nextPost) {
                $html .= '<span class="hr-bar hidden sm:inline-block w-[1px] h-full bg-[#E7ECF0] absolute left-1/2 top-0"></span>';
            }
            if ($nextPost) {
                $html .= '<a class="nav-next group w-full inline-flex items-center justify-end text-right pl-2.5 sm:pl-5 3xl:pl-10 no-underline" href="' . esc_url(get_permalink($nextPost->ID)) . '">';
                $html .= '<span class="nav-text">';
                $html .= '<span class="flex items-center justify-end text-lighter mb-1 sm:mb-2">';
                $html .= esc_html__('Next', 'borobazar');
                $html .= '<svg class="ml-2" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.84969 5.00003C5.84969 5.17925 5.78126 5.35845 5.64469 5.49508L1.34487 9.79486C1.07135 10.0684 0.627884 10.0684 0.354472 9.79486C0.0810613 9.52145 0.0810613 9.07807 0.354472 8.80452L4.15919 5.00003L0.354605 1.19551C0.0811942 0.921988 0.0811942 0.478652 0.354605 0.205262C0.628016 -0.0683918 1.07148 -0.0683918 1.34501 0.205262L5.64482 4.50497C5.78142 4.64168 5.84969 4.82087 5.84969 5.00003Z" fill="#8C969F"/></svg>';
                $html .= '</span>';
                $html .= '<h6 class="m-0 font-semibold">' . $nextPost->post_title . '</h6>';
                $html .= '</span>';
                if (get_the_post_thumbnail($nextPost->ID)) {
                    $html .= '<span class="thumb-img hidden sm:flex sm:shrink-0 sm:items-center w-20 h-20 relative ml-5 rounded-md overflow-hidden transition-opacity duration-300 group-hover:opacity-80 group-focus:opacity-80">' . get_the_post_thumbnail($nextPost->ID) . '</span>';
                }
                $html .= '</a>';
            }
            $html .= '</div>';
            $html .= '</nav>';
        }

        echo wp_kses($html, $allowedHTMLWithSvg);
    }
}

if (!function_exists('borobazar_allowed_iframe_html')) {
    /**
     * borobazar_allowed_iframe_html.
     *
     * @return void
     */
    function borobazar_allowed_iframe_html()
    {
        return [
            'iframe' => [
                'title'           => [],
                'width'           => [],
                'height'          => [],
                'scrolling'       => [],
                'frameborder'     => [],
                'allowfullscreen' => [],
                'allow'           => [],
                'name'            => [],
                'src'             => [],
            ],
        ];
    }
}

if (!function_exists('borobazar_get_header_layout_classes')) {
    /**
     * Header layout classes.
     *
     * @since 1.0.0
     */
    function borobazar_get_header_layout_classes()
    {
        $headerLayout = get_theme_mod('borobazar_header_layout', 'default');
        $headerVariantClasses = '';
        $addClassBasedOnAdminBar = is_admin_bar_showing() ? 'top-8' : 'top-0';

        switch ($headerLayout) {
            case 'berlin':
                $headerVariantClasses = 'sticky bg-white z-50 xl:z-10 transition-all duration-200' . ' ' . $addClassBasedOnAdminBar;
                break;

            case 'bogota':
                $headerVariantClasses = 'sticky z-50 transition-all duration-200' . ' ' . $addClassBasedOnAdminBar;
                break;

            default:
                $headerVariantClasses = 'sticky bg-white shadow-border-lighter z-50 transition-all duration-200' . ' ' . $addClassBasedOnAdminBar;
                break;
        }

        return $headerVariantClasses;
    }
}
