<?php

/**
 *  Third party plugin related function.
 *
 * Function Lists
 *
 *  - borobazar_cart_link()
 *  - borobazar_css_variables()
 *  - borobazar_check_product_in_cart()
 *  - borobazar_comments()
 */


if (!function_exists('borobazar_get_multi_lang_args')) {
    /**
     * Multi-language args
     *
     * @since 1.0.0
     */
    function borobazar_get_multi_lang_args()
    {
        if (!class_exists('SitePress')) {
            return;
        }

        global $sitepress;

        $languages = $sitepress->get_ls_languages();
        $display_as = get_theme_mod('borobazar_lang_switcher_as', 'translated_name');
        $active_language = [];
        $inactive_languages = [];

        foreach ($languages as $key => $language) {
            if ($language['active']) {
                $active_language[$key] = $language;
                $active_language[$key]['display_as'] = $display_as;
            } else {
                $inactive_languages[$key] = $language;
                $inactive_languages[$key]['display_as'] = $display_as;
            }
        }

        $args = [
            'languages'          => $languages,
            'active_language'    => reset($active_language),
            'inactive_languages' => $inactive_languages,
            'display_as'         => $display_as,
        ];

        return $args;
    }
}

if (!function_exists('borobazar_get_woo_terms')) {

    /**
     * borobazar_get_woo_terms
     *
     * @param  string $product_id
     * @param  string $taxonomy
     * @return array
     */
    function borobazar_get_woo_terms($product_id, $taxonomy)
    {
        $html = '';
        $terms = get_the_terms($product_id, $taxonomy);

        if (is_wp_error($terms)) {
            return $terms;
        }

        if (empty($terms)) {
            return false;
        }

        foreach ($terms as $term) {
            $link = get_term_link($term, $taxonomy);
            if (is_wp_error($link)) {
                return $link;
            }
            $html .= '<a href="' . esc_url($link) . '" rel="tag">' . $term->name . '</a>';
        }
        echo apply_filters('borobazar_get_woo_terms_markup', $html);
    }
}

if (!function_exists('borobazar_cart_link')) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     *
     * @since 1.0.0
     */
    function borobazar_cart_link()
    {
        $args = [];
        $layout = 'header-cart';

        $layouts = [
            'header-cart' => 'cart-counter/header.php',
        ];

        $cartLayout = isset($layouts[$layout]) ? $layouts[$layout] : 'cart-counter/header.php';

        wc_get_template($cartLayout, $args);
    }
}

/**
 * borobazar_typo_controller
 *
 * @param  mixed $typo
 * @param  mixed $default
 * @return void
 */
function borobazar_typo_controller($typo, $default)
{
    $typo_array = [];

    if (class_exists('Kirki')) {
        if (!empty($typo['variant'])) {
            if (preg_match("/^\d+$/", $typo['variant'])) {
                // check if number only
                $typo_array['font-weight'] = $typo['variant'];
                $typo_array['font-style'] = '';
            } elseif (preg_match('~[0-9]+~', $typo['variant'])) {
                // check if string has number
                // then split the number and sting
                $splittedVariant = preg_split('/(?<=[0-9])(?=[\sa-z]+)/i', $typo['variant']);
                $typo_array['font-weight'] = $splittedVariant[0];
                $typo_array['font-style'] = $splittedVariant[1];
            } else {
                // if string only
                $typo_array['font-weight'] = '';
                $typo_array['font-style']  = $typo['variant'];
            }
        } else {
            $typo_array['font-weight'] = $default['font-weight'];
            $typo_array['font-style']  = $default['font-style'];
        }
        $typo_array['font-family']    = !empty($typo['font-family']) ? $typo['font-family']   : $default['font-family'];
        $typo_array['font-size']      = !empty($typo['font-size'])   ? $typo['font-size']     : $default['font-size'];
        $typo_array['line-height']    = !empty($typo['line-height']) ? $typo['line-height']   : $default['line-height'];
        $typo_array['letter-spacing'] = !empty($typo['letter-spacing']) ? $typo['letter-spacing'] : $default['letter-spacing'];
        $typo_array['color']          = !empty($typo['color']) ? $typo['color']         : $default['color'];
        $typo_array['text-transform'] = !empty($typo['text-transform']) ? $typo['text-transform'] : $default['text-transform'];
    } else {
        return $default;
    }

    return $typo_array;
}

if (!function_exists('borobazar_css_variables')) {

    /**
     * borobazar_css_variables
     *
     * @return void
     */
    function borobazar_css_variables()
    {
        $heading1 = $heading2 = $heading3 = $heading4 = $heading5 = $heading6 = $body = $special = '';
        // Default color values
        $brandColor           = '#02b290';
        $topbarBgColor        = '#f2f5f9';
        $topbarSearchColor    = '#595959';
        $topbarContentColor   = '#8C969F';
        $topbarCounterColor   = '#FFFFFF';
        $topbarCounterBg      = '#02b290';
        $brandHoverColor      = '#01A585';
        $mainTextColor        = '#000000';
        $darkTextColor        = '#595959';
        $lightTextColor       = '#666666';
        $lighterTextColor     = '#808080';
        $lightestTextColor    = '#8C969F';
        $mainBorderColor      = '#E2E8F0';
        $lightBorderColor     = '#DBDEE5';
        $lighterBorderColor   = '#E7ECF0';
        $bgColor              = '#F3F5F9';
        $storeNoticeBgColor   = '#02b290';
        $storeNoticeTextColor = '#ffffff';
        $bottomNavBgColor     = '#ffffff';
        $bottomNavIconColor   = '#8C969F';
        $typographySwitch     = 'off';
        // Default typo values with fallback sans-serif font, font-weight & font style added
        $body_default = [
            'font-family' => 'Inter, sans-serif',
            'variant'     => 'regular',
            'font-size'   => '15px',
            'line-height' => '1.8',
            'font-weight' => '400',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
            'color'          => '',
        ];
        $heading1_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '40px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $heading2_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '24px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $heading3_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '22px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $heading4_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '18px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $heading5_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '16px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $heading6_default = [
            'font-family' => 'Manrope, sans-serif',
            'variant'     => '700',
            'font-size'   => '15px',
            'line-height' => '1.5',
            'color'       => '#000000',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
        ];
        $special_default = [
            'font-family' => 'Caveat, cursive',
            'variant'     => '700',
            'font-size'   => '30px',
            'line-height' => '1.26',
            'font-weight' => '700',
            'font-style'  => 'normal',
            'text-transform' => '',
            'letter-spacing' => '',
            'color'          => '',
        ];

        // grab kirki option values
        if (function_exists('borobazar_global_option_data')) {
            //topbar settings
            $topbarBgColor        = borobazar_global_option_data('borobazar_topbar_bg_color', $topbarBgColor);
            $topbarSearchColor    = borobazar_global_option_data('borobazar_topbar_search_text_color', $topbarSearchColor);
            $topbarContentColor    = borobazar_global_option_data('borobazar_topbar_content_color', $topbarContentColor);
            $topbarCounterColor    = borobazar_global_option_data('borobazar_topbar_counter_color', $topbarCounterColor);
            $topbarCounterBg    = borobazar_global_option_data('borobazar_topbar_counter_bg_color', $topbarCounterBg);
      
      

            // color settings
            $brandColor           = borobazar_global_option_data('borobazar_brand_color', $brandColor);
            $brandHoverColor      = borobazar_global_option_data('borobazar_brand_hover_color', $brandHoverColor);
            $mainTextColor        = borobazar_global_option_data('borobazar_main_text_color', $mainTextColor);
            $darkTextColor        = borobazar_global_option_data('borobazar_dark_text_color', $darkTextColor);
            $lightTextColor       = borobazar_global_option_data('borobazar_light_text_color', $lightTextColor);
            $lighterTextColor     = borobazar_global_option_data('borobazar_lighter_text_color', $lighterTextColor);
            $lightestTextColor    = borobazar_global_option_data('borobazar_lightest_text_color', $lightestTextColor);
            $mainBorderColor      = borobazar_global_option_data('borobazar_main_border_color', $mainBorderColor);
            $lightBorderColor     = borobazar_global_option_data('borobazar_light_border_color', $lightBorderColor);
            $lighterBorderColor   = borobazar_global_option_data('borobazar_lighter_border_color', $lighterBorderColor);
            $bgColor              = borobazar_global_option_data('borobazar_bg_color', $bgColor);
            $storeNoticeBgColor   = borobazar_global_option_data('borobazar_store_notice_bg_color', $storeNoticeBgColor);
            $storeNoticeTextColor = borobazar_global_option_data('borobazar_store_notice_text_color', $storeNoticeTextColor);
            $bottomNavBgColor     = borobazar_global_option_data('bottom_nav_bg_color', $bottomNavBgColor);
            $bottomNavIconColor   = borobazar_global_option_data('bottom_nav_font_color', $bottomNavIconColor);
            // typography settings
            $typographySwitch = borobazar_global_option_data('borobazar_typography_switch', 'off');
            $body             = borobazar_global_option_data('body_typography_setting', $body_default);
            $heading1         = borobazar_global_option_data('heading1_typography_setting', $heading1_default);
            $heading2         = borobazar_global_option_data('heading2_typography_setting', $heading2_default);
            $heading3         = borobazar_global_option_data('heading3_typography_setting', $heading3_default);
            $heading4         = borobazar_global_option_data('heading4_typography_setting', $heading4_default);
            $heading5         = borobazar_global_option_data('heading5_typography_setting', $heading5_default);
            $heading6         = borobazar_global_option_data('heading6_typography_setting', $heading6_default);
            $special          = borobazar_global_option_data('special_typography_setting', $special_default);
        }

        $heading1 = borobazar_typo_controller($heading1, $heading1_default);
        $heading2 = borobazar_typo_controller($heading2, $heading2_default);
        $heading3 = borobazar_typo_controller($heading3, $heading3_default);
        $heading4 = borobazar_typo_controller($heading4, $heading4_default);
        $heading5 = borobazar_typo_controller($heading5, $heading5_default);
        $heading6 = borobazar_typo_controller($heading6, $heading6_default);
        $body     = borobazar_typo_controller($body, $body_default);
        $special  = borobazar_typo_controller($special, $special_default);

        // printing variables
        $cssVariables = '';
        $cssVariables .= ':root {
            --topbar-content         : ' .$topbarContentColor .';
            --topbar-search          : ' . $topbarSearchColor .';
            --topbar-bg              : ' . $topbarBgColor .';
            --topbar-counter         : ' . $topbarCounterColor .';
            --topbar-counter-bg      : ' . $topbarCounterBg .';
            --color-brand            : ' . $brandColor . ';
            --color-brand-hover      : ' . $brandHoverColor . ';
            --color-main-text        : ' . $mainTextColor . ';
            --color-dark-text        : ' . $darkTextColor . ';
            --color-light-text       : ' . $lightTextColor . ';
            --color-lighter-text     : ' . $lighterTextColor . ';
            --color-lightest-text    : ' . $lightestTextColor . ';
            --color-border-main      : ' . $mainBorderColor . ';
            --color-border-light     : ' . $lightBorderColor . ';
            --color-border-lighter   : ' . $lighterBorderColor . ';
            --color-bg               : ' . $bgColor . ';
            --color-store-notice-bg  : ' . $storeNoticeBgColor . ';
            --color-store-notice-text: ' . $storeNoticeTextColor . ';
            --color-bottom-nav-bg    : ' . $bottomNavBgColor . ';
            --color-bottom-nav-icon  : ' . $bottomNavIconColor . ';
            --body-font-family       : ' . $body['font-family'] . ';
            --body-font-size         : ' . $body['font-size'] . ';
            --body-font-weight       : ' . $body['font-weight'] . ';
            --body-font-style        : ' . $body['font-style'] . ';
            --body-line-height       : ' . $body['line-height'] . ';
            --h1-font-family         : ' . $heading1['font-family'] . ';
            --h1-font-size           : ' . $heading1['font-size'] . ';
            --h1-font-weight         : ' . $heading1['font-weight'] . ';
            --h1-font-style          : ' . $heading1['font-style'] . ';
            --h1-line-height         : ' . $heading1['line-height'] . ';
            --h1-color               : ' . $heading1['color'] . ';
            --h2-font-family         : ' . $heading2['font-family'] . ';
            --h2-font-size           : ' . $heading2['font-size'] . ';
            --h2-font-weight         : ' . $heading2['font-weight'] . ';
            --h2-font-style          : ' . $heading2['font-style'] . ';
            --h2-line-height         : ' . $heading2['line-height'] . ';
            --h2-color               : ' . $heading2['color'] . ';
            --h3-font-family         : ' . $heading3['font-family'] . ';
            --h3-font-size           : ' . $heading3['font-size'] . ';
            --h3-font-weight         : ' . $heading3['font-weight'] . ';
            --h3-font-style          : ' . $heading3['font-style'] . ';
            --h3-line-height         : ' . $heading3['line-height'] . ';
            --h3-color               : ' . $heading3['color'] . ';
            --h4-font-family         : ' . $heading4['font-family'] . ';
            --h4-font-size           : ' . $heading4['font-size'] . ';
            --h4-font-weight         : ' . $heading4['font-weight'] . ';
            --h4-font-style          : ' . $heading4['font-style'] . ';
            --h4-line-height         : ' . $heading4['line-height'] . ';
            --h4-color               : ' . $heading4['color'] . ';
            --h5-font-family         : ' . $heading5['font-family'] . ';
            --h5-font-size           : ' . $heading5['font-size'] . ';
            --h5-font-weight         : ' . $heading5['font-weight'] . ';
            --h5-font-style          : ' . $heading5['font-style'] . ';
            --h5-line-height         : ' . $heading5['line-height'] . ';
            --h5-color               : ' . $heading5['color'] . ';
            --h6-font-family         : ' . $heading6['font-family'] . ';
            --h6-font-size           : ' . $heading6['font-size'] . ';
            --h6-font-weight         : ' . $heading6['font-weight'] . ';
            --h6-font-style          : ' . $heading6['font-style'] . ';
            --h6-line-height         : ' . $heading6['line-height'] . ';
            --h6-color               : ' . $heading6['color'] . ';
            --special-font-family    : ' . $special['font-family'] . ';
            --special-font-size      : ' . $special['font-size'] . ';
            --special-font-weight    : ' . $special['font-weight'] . ';
            --special-font-style     : ' . $special['font-style'] . ';
            --special-line-height    : ' . $special['line-height'] . ';
        }';

        // enqueue style
        wp_enqueue_style(
            'borobazar-css-variables',
            get_theme_file_uri('/assets/client/css/custom-script.css')
        );

        wp_add_inline_style('borobazar-css-variables', $cssVariables);
        // theme default fonts when theme helper & kirki not installed and active
        if ($typographySwitch !== 'on') {
            wp_enqueue_style('borobazar-manrope-font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap', false);
            wp_enqueue_style('borobazar-inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', false);
            wp_enqueue_style('borobazar-caveat-font', 'https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap', false);
        }
    }
}

add_action('wp_enqueue_scripts', 'borobazar_css_variables');
add_action('admin_enqueue_scripts', 'borobazar_css_variables');

/**
 * borobazar_check_product_in_cart.
 *
 * @return void
 */
function borobazar_check_product_in_cart()
{
    $result = [];

    if (class_exists('WooCommerce') && !empty(WC()->cart)) {
        $cart_items = WC()->cart->get_cart();
        if (!count($cart_items)) {
            return $result;
        }
        foreach ($cart_items as $cart_item_key => $cart_item) {
            $result[$cart_item['product_id']] = $cart_item['quantity'];
        }
    }

    return $result;
}

/*
 * borobazar_comments.
 *
 * @return void
 */
if (!function_exists('borobazar_comments')) {
    function borobazar_comments($comment, $args, $depth)
    {
        $allowedHTML = wp_kses_allowed_html('post');
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        $comment_author_url = get_comment_author_url($comment);
        $comment_author = get_comment_author($comment);
        $avatar = get_avatar($comment, $args['avatar_size']); ?>

        <li <?php comment_class($args['has_children'] ? 'post-comment has-children' : 'post-comment'); ?> id="comment-<?php comment_ID(); ?>">
            <article class="comment-card flex items-start py-5 sm:py-6">
                <?php if (!empty($avatar)) { ?>
                    <figure class="comment-avatar m-0">
                        <?php echo wp_kses($avatar, $allowedHTML); ?>
                    </figure>
                    <!-- end of .comment-avatar -->
                <?php } ?>

                <div class="comment-content">
                    <header class="comment-header flex items-center">
                        <?php
                        if (!empty($comment_author_url)) {
                            printf('<a href="%s" rel="external nofollow" class="url inline-flex items-center flex-wrap no-underline">', esc_url($comment_author_url));
                        } ?>
                        <h6 class="name m-0 mb-2 mr-3 font-semibold">
                            <?php
                            printf(
                                wp_kses(
                                    /* translators: %s: Comment author link. */
                                    __('%s <span class="screen-reader-text says">says:</span>', 'borobazar'),
                                    [
                                        'span' => [
                                            'class' => [],
                                        ],
                                    ]
                                ),
                                '<b class="fn font-semibold">' . $comment_author . '</b>'
                            ); ?>
                        </h6>
                        <span class="date mb-2 text-lighter text-sm leading-normal"> <?php comment_date(get_option('date_format')); ?> </span>
                        <?php
                        if (!empty($comment_author_url)) {
                            echo wp_kses('</a>', $allowedHTML);
                        } ?>
                    </header>
                    <!-- end of .comment-header  -->

                    <div class="comment-body">
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em> <?php esc_html_e('Your comment is awaiting moderation.', 'borobazar'); ?></em>
                            <br />
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                    <!-- end of .comment-body -->

                    <footer class="comment-footer leading-none">
                        <?php
                        comment_reply_link(array_merge(
                            $args,
                            [
                                'reply_text' => '' .
                                    '<svg class="mr-1.5" width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.25 3.37592V0.718416C6.25 0.530291 6.13687 0.360291 5.96375 0.286541C5.79125 0.213416 5.58938 0.250291 5.455 0.382166L0.1425 5.53842C0.05125 5.62654 0 5.74779 0 5.87467C0 6.00154 0.05125 6.12279 0.1425 6.21092L5.455 11.3672C5.59062 11.4984 5.79187 11.5353 5.96375 11.4628C6.13687 11.389 6.25 11.219 6.25 11.0309V8.37467H7.13625C10.0338 8.37467 12.705 9.94967 14.1069 12.4822L14.12 12.5059C14.2037 12.6584 14.3625 12.7497 14.5312 12.7497C14.57 12.7497 14.6088 12.7453 14.6475 12.7353C14.855 12.6822 15 12.4953 15 12.2809C15 7.42217 11.0894 3.45967 6.25 3.37592Z" fill="currentColor"/>
                                </svg>' . 'Reply',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                            ]
                        )); ?>
                    </footer>
                    <!-- end of .comment-footer -->
                </div>
            </article>
    <?php
    }
}
