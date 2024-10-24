<?php

/**
 * borobazar_breadcrumb.
 *
 * @param mixed $arrow_sign
 *
 * @return void
 */
if (!function_exists('borobazar_breadcrumb')) {
    function borobazar_breadcrumb($arrow_sign = '&#x2192;')
    {
        /* === OPTIONS === */
        $text['home']     = esc_html__('Home', 'borobazar'); // text for the 'Home' link
        $text['category'] = esc_html__('%s', 'borobazar'); // text for a category page
        $text['tax']      = esc_html__('%s', 'borobazar'); // text for a taxonomy page
        $text['search']   = esc_html__('%s', 'borobazar'); // text for a search results page
        $text['tag']      = esc_html__('%s', 'borobazar'); // text for a tag page
        $text['author']   = esc_html__('%s', 'borobazar'); // text for an author page
        $text['404']      = esc_html__('Error 404', 'borobazar'); // text for the 404 page

        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="borobazar-breadcrumb-delimiter inline-flex mx-3">
            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.85018 5.00003C5.85018 5.17925 5.78175 5.35845 5.64518 5.49508L1.34536 9.79486C1.07184 10.0684 0.628372 10.0684 0.354961 9.79486C0.0815496 9.52145 0.0815496 9.07807 0.354961 8.80452L4.15968 5.00003L0.355094 1.19551C0.0816825 0.921988 0.0816825 0.478652 0.355094 0.205262C0.628505 -0.0683918 1.07197 -0.0683918 1.34549 0.205262L5.64531 4.50497C5.78191 4.64168 5.85018 4.82087 5.85018 5.00003Z" fill="currentColor"/>
            </svg>
        </span>'; // delimiter between crumbs
        $before = '<span class="current font-medium md:font-semibold">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $allowed_html = wp_kses_allowed_html('post');
        $homeLink   = home_url() . '/';
        $linkBefore = '<span typeof="v:Breadcrumb">';
        $linkAfter  = '</span>';
        $linkAttr   = ' rel="v:url" property="v:title"';
        $link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

        if (is_front_page()) {
            if ($showOnHome == 1) {
                echo '<div class="borobazar-breadcrumb capitalize"> 
                    <span class="borobazar-breadcrumb-home-icon inline-flex mr-2 relative top-[3px]">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M18.4114 8.84356C18.4109 8.84315 18.4105 8.84261 18.4101 8.8422L11.1574 1.59055C10.8483 1.2813 10.4373 1.11108 10.0001 1.11108C9.56288 1.11108 9.15187 1.2813 8.8426 1.59055L1.59374 8.83854C1.59129 8.84098 1.58872 8.84356 1.58641 8.846C0.951581 9.48443 0.952666 10.5203 1.58953 11.1571C1.88049 11.4481 2.26465 11.6166 2.67552 11.6344C2.69234 11.636 2.70916 11.6368 2.72612 11.6368H3.01505V16.9734C3.01505 18.0296 3.87451 18.8889 4.9308 18.8889H7.76827C8.05598 18.8889 8.28916 18.6556 8.28916 18.368V14.184C8.28916 13.7021 8.68131 13.3101 9.16327 13.3101H10.8369C11.3188 13.3101 11.7109 13.7021 11.7109 14.184V18.368C11.7109 18.6556 11.944 18.8889 12.2317 18.8889H15.0692C16.1256 18.8889 16.985 18.0296 16.985 16.9734V11.6368H17.253C17.6901 11.6368 18.1011 11.4666 18.4105 11.1572C19.048 10.5195 19.0483 9.48172 18.4114 8.84356ZM17.6738 10.4207C17.5613 10.5331 17.4118 10.5951 17.253 10.5951H16.4641C16.1764 10.5951 15.9432 10.8283 15.9432 11.116V16.9734C15.9432 17.4552 15.5512 17.8472 15.0692 17.8472H12.7526V14.184C12.7526 13.1278 11.8933 12.2684 10.8369 12.2684H9.16327C8.10684 12.2684 7.24738 13.1278 7.24738 14.184V17.8472H4.9308C4.44898 17.8472 4.05682 17.4552 4.05682 16.9734V11.116C4.05682 10.8283 3.82364 10.5951 3.53594 10.5951H2.76057C2.75244 10.5946 2.74443 10.5942 2.73616 10.594C2.58098 10.5913 2.43543 10.5298 2.32637 10.4206C2.09441 10.1886 2.09441 9.81117 2.32637 9.5791C2.3265 9.5791 2.3265 9.57897 2.32664 9.57883L2.32705 9.57842L9.57943 2.32704C9.69175 2.2146 9.8411 2.15275 10.0001 2.15275C10.1589 2.15275 10.3083 2.2146 10.4207 2.32704L17.6715 9.57693C17.6726 9.57802 17.6738 9.5791 17.6749 9.58019C17.9056 9.81253 17.9052 10.1892 17.6738 10.4207Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"/>
                            </g>
                        </svg>
                    </span>
                    <a href="' . esc_url($homeLink) . '">' . $text['home'] . ' </a>
                </div>';
            }
        } elseif (is_home() && !is_front_page()) {
            if ($showOnHome == 0) {
                echo '<div class="borobazar-breadcrumb capitalize"> 
                    <span class="borobazar-breadcrumb-home-icon inline-flex mr-2 relative top-[3px]">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M18.4114 8.84356C18.4109 8.84315 18.4105 8.84261 18.4101 8.8422L11.1574 1.59055C10.8483 1.2813 10.4373 1.11108 10.0001 1.11108C9.56288 1.11108 9.15187 1.2813 8.8426 1.59055L1.59374 8.83854C1.59129 8.84098 1.58872 8.84356 1.58641 8.846C0.951581 9.48443 0.952666 10.5203 1.58953 11.1571C1.88049 11.4481 2.26465 11.6166 2.67552 11.6344C2.69234 11.636 2.70916 11.6368 2.72612 11.6368H3.01505V16.9734C3.01505 18.0296 3.87451 18.8889 4.9308 18.8889H7.76827C8.05598 18.8889 8.28916 18.6556 8.28916 18.368V14.184C8.28916 13.7021 8.68131 13.3101 9.16327 13.3101H10.8369C11.3188 13.3101 11.7109 13.7021 11.7109 14.184V18.368C11.7109 18.6556 11.944 18.8889 12.2317 18.8889H15.0692C16.1256 18.8889 16.985 18.0296 16.985 16.9734V11.6368H17.253C17.6901 11.6368 18.1011 11.4666 18.4105 11.1572C19.048 10.5195 19.0483 9.48172 18.4114 8.84356ZM17.6738 10.4207C17.5613 10.5331 17.4118 10.5951 17.253 10.5951H16.4641C16.1764 10.5951 15.9432 10.8283 15.9432 11.116V16.9734C15.9432 17.4552 15.5512 17.8472 15.0692 17.8472H12.7526V14.184C12.7526 13.1278 11.8933 12.2684 10.8369 12.2684H9.16327C8.10684 12.2684 7.24738 13.1278 7.24738 14.184V17.8472H4.9308C4.44898 17.8472 4.05682 17.4552 4.05682 16.9734V11.116C4.05682 10.8283 3.82364 10.5951 3.53594 10.5951H2.76057C2.75244 10.5946 2.74443 10.5942 2.73616 10.594C2.58098 10.5913 2.43543 10.5298 2.32637 10.4206C2.09441 10.1886 2.09441 9.81117 2.32637 9.5791C2.3265 9.5791 2.3265 9.57897 2.32664 9.57883L2.32705 9.57842L9.57943 2.32704C9.69175 2.2146 9.8411 2.15275 10.0001 2.15275C10.1589 2.15275 10.3083 2.2146 10.4207 2.32704L17.6715 9.57693C17.6726 9.57802 17.6738 9.5791 17.6749 9.58019C17.9056 9.81253 17.9052 10.1892 17.6738 10.4207Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"/>
                            </g>
                        </svg>
                    </span>
                    <a href="' . esc_url($homeLink) . '">' . $text['home'] . $delimiter . ' </a>
                    <span class="current font-medium md:font-semibold">' . get_the_title(get_option('page_for_posts', true)) . '</span>
                </div>';
            }
        } elseif (class_exists('WooCommerce') && is_shop()) {
            if ($showOnHome == 0) {
                echo '<div class="borobazar-breadcrumb capitalize"> 
                    <span class="borobazar-breadcrumb-home-icon inline-flex mr-2 relative top-[3px]">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M18.4114 8.84356C18.4109 8.84315 18.4105 8.84261 18.4101 8.8422L11.1574 1.59055C10.8483 1.2813 10.4373 1.11108 10.0001 1.11108C9.56288 1.11108 9.15187 1.2813 8.8426 1.59055L1.59374 8.83854C1.59129 8.84098 1.58872 8.84356 1.58641 8.846C0.951581 9.48443 0.952666 10.5203 1.58953 11.1571C1.88049 11.4481 2.26465 11.6166 2.67552 11.6344C2.69234 11.636 2.70916 11.6368 2.72612 11.6368H3.01505V16.9734C3.01505 18.0296 3.87451 18.8889 4.9308 18.8889H7.76827C8.05598 18.8889 8.28916 18.6556 8.28916 18.368V14.184C8.28916 13.7021 8.68131 13.3101 9.16327 13.3101H10.8369C11.3188 13.3101 11.7109 13.7021 11.7109 14.184V18.368C11.7109 18.6556 11.944 18.8889 12.2317 18.8889H15.0692C16.1256 18.8889 16.985 18.0296 16.985 16.9734V11.6368H17.253C17.6901 11.6368 18.1011 11.4666 18.4105 11.1572C19.048 10.5195 19.0483 9.48172 18.4114 8.84356ZM17.6738 10.4207C17.5613 10.5331 17.4118 10.5951 17.253 10.5951H16.4641C16.1764 10.5951 15.9432 10.8283 15.9432 11.116V16.9734C15.9432 17.4552 15.5512 17.8472 15.0692 17.8472H12.7526V14.184C12.7526 13.1278 11.8933 12.2684 10.8369 12.2684H9.16327C8.10684 12.2684 7.24738 13.1278 7.24738 14.184V17.8472H4.9308C4.44898 17.8472 4.05682 17.4552 4.05682 16.9734V11.116C4.05682 10.8283 3.82364 10.5951 3.53594 10.5951H2.76057C2.75244 10.5946 2.74443 10.5942 2.73616 10.594C2.58098 10.5913 2.43543 10.5298 2.32637 10.4206C2.09441 10.1886 2.09441 9.81117 2.32637 9.5791C2.3265 9.5791 2.3265 9.57897 2.32664 9.57883L2.32705 9.57842L9.57943 2.32704C9.69175 2.2146 9.8411 2.15275 10.0001 2.15275C10.1589 2.15275 10.3083 2.2146 10.4207 2.32704L17.6715 9.57693C17.6726 9.57802 17.6738 9.5791 17.6749 9.58019C17.9056 9.81253 17.9052 10.1892 17.6738 10.4207Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"/>
                            </g>
                        </svg>
                    </span>
                    <a href="' . esc_url($homeLink) . '">' . $text['home'] . $delimiter . ' </a>
                    <span class="current font-medium md:font-semibold">' . get_the_title(get_option('woocommerce_shop_page_id')) . '</span>
                </div>';
            }
        } else {
            echo '<div class="borobazar-breadcrumb capitalize"> 
                    <span class="borobazar-breadcrumb-home-icon inline-flex mr-2 relative top-[3px]">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M18.4114 8.84356C18.4109 8.84315 18.4105 8.84261 18.4101 8.8422L11.1574 1.59055C10.8483 1.2813 10.4373 1.11108 10.0001 1.11108C9.56288 1.11108 9.15187 1.2813 8.8426 1.59055L1.59374 8.83854C1.59129 8.84098 1.58872 8.84356 1.58641 8.846C0.951581 9.48443 0.952666 10.5203 1.58953 11.1571C1.88049 11.4481 2.26465 11.6166 2.67552 11.6344C2.69234 11.636 2.70916 11.6368 2.72612 11.6368H3.01505V16.9734C3.01505 18.0296 3.87451 18.8889 4.9308 18.8889H7.76827C8.05598 18.8889 8.28916 18.6556 8.28916 18.368V14.184C8.28916 13.7021 8.68131 13.3101 9.16327 13.3101H10.8369C11.3188 13.3101 11.7109 13.7021 11.7109 14.184V18.368C11.7109 18.6556 11.944 18.8889 12.2317 18.8889H15.0692C16.1256 18.8889 16.985 18.0296 16.985 16.9734V11.6368H17.253C17.6901 11.6368 18.1011 11.4666 18.4105 11.1572C19.048 10.5195 19.0483 9.48172 18.4114 8.84356ZM17.6738 10.4207C17.5613 10.5331 17.4118 10.5951 17.253 10.5951H16.4641C16.1764 10.5951 15.9432 10.8283 15.9432 11.116V16.9734C15.9432 17.4552 15.5512 17.8472 15.0692 17.8472H12.7526V14.184C12.7526 13.1278 11.8933 12.2684 10.8369 12.2684H9.16327C8.10684 12.2684 7.24738 13.1278 7.24738 14.184V17.8472H4.9308C4.44898 17.8472 4.05682 17.4552 4.05682 16.9734V11.116C4.05682 10.8283 3.82364 10.5951 3.53594 10.5951H2.76057C2.75244 10.5946 2.74443 10.5942 2.73616 10.594C2.58098 10.5913 2.43543 10.5298 2.32637 10.4206C2.09441 10.1886 2.09441 9.81117 2.32637 9.5791C2.3265 9.5791 2.3265 9.57897 2.32664 9.57883L2.32705 9.57842L9.57943 2.32704C9.69175 2.2146 9.8411 2.15275 10.0001 2.15275C10.1589 2.15275 10.3083 2.2146 10.4207 2.32704L17.6715 9.57693C17.6726 9.57802 17.6738 9.5791 17.6749 9.58019C17.9056 9.81253 17.9052 10.1892 17.6738 10.4207Z" fill="currentColor" stroke="currentColor" stroke-width="0.2"/>
                            </g>
                        </svg>
                    </span>' . sprintf($link, $homeLink, $text['home']) . $delimiter;

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) {
                    $cats = get_category_parents($thisCat->parent, true, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo apply_filters('borobazar_breadcrumb_category_filter', $cats);
                }
                echo sprintf($before . $text['category'], single_cat_title('', false) . $after);
            } elseif (is_tax()) {
                $thisTerm = get_term_by('id', get_queried_object_id(), get_queried_object()->taxonomy);
                if (!empty($thisTerm) && $thisTerm->parent != 0) {
                    $cats = get_category_parents($thisTerm->parent, true, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo apply_filters('borobazar_breadcrumb_taxonomy_filter', $cats);
                }
                echo sprintf($before . $text['tax'], single_cat_title('', false) . $after);
            } elseif (is_search()) {
                echo sprintf($before . $text['search'], get_search_query() . $after);
            } elseif (is_day()) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
                echo sprintf($before . get_the_time('d') . $after);
            } elseif (is_month()) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($before . get_the_time('F') . $after);
            } elseif (is_year()) {
                echo sprintf($before . get_the_time('Y') . $after);
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());

                if (isset($post_type) && !empty($post_type)) {
                    echo sprintf($before . $post_type->labels->singular_name . $after);
                }
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if (!empty($cat)) {
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, true, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo sprintf($cats);
                    printf($link, get_permalink($parent), $parent->post_title);
                    if ($showCurrent == 1) {
                        echo sprintf($delimiter . $before . get_the_title() . $after);
                    }
                } else {
                    if ($showCurrent == 1) {
                        $title = get_the_title();
                        echo wp_kses($title, $allowed_html);
                    }
                }
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1) {
                    echo sprintf($before . get_the_title() . $after);
                }
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = [];
                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); ++$i) {
                    echo sprintf($breadcrumbs[$i]);
                    if ($i != count($breadcrumbs) - 1) {
                        echo sprintf($delimiter);
                    }
                }
                if ($showCurrent == 1) {
                    echo sprintf($delimiter . $before . get_the_title() . $after);
                }
            } elseif (is_tag()) {
                echo sprintf($before . $text['tag'], single_tag_title('', false) . $after);
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo sprintf($before . $text['author'], $userdata->display_name . $after);
            } elseif (is_404()) {
                echo sprintf($before . $text['404'] . $after);
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() !== 'post') {
                    if (get_post_type() === 'product') {
                        printf($link, get_permalink(wc_get_page_id('shop')), esc_html__('products','borobazar'));
                        if ($showCurrent == 1) {
                            echo sprintf($delimiter . $before . get_the_title() . $after);
                        }
                    } else {
                        $post_type = get_post_type_object(get_post_type());
                        $slug = $post_type->rewrite;
                        printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                        if ($showCurrent == 1) {
                            echo sprintf($delimiter . $before . get_the_title() . $after);
                        }
                    }
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, true, $delimiter);
                    if ($showCurrent == 0) {
                        $cats = preg_replace("#^(.+)$delimiter$#", '$1', $cats);
                    }
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo sprintf($cats);
                    if ($showCurrent == 1) {
                        echo sprintf('%s %s %s', $before, get_the_title(), $after);
                    }
                }
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ' (';
                }
                echo esc_html__('Page', 'borobazar') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ')';
                }
            }

            echo '</div>';
        }
    }
}
