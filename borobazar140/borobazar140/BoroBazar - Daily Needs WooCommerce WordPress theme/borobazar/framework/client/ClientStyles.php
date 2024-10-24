<?php

namespace Framework\Client;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\Traits\StyleScriptLoader;

class ClientStyles
{
    use StyleScriptLoader;

    public function __construct()
    {
        add_filter('body_class', [$this, 'borobazarBodyClasses']);
        add_action('wp_enqueue_scripts', [$this, 'loadStyles']);
    }

    /**
     * borobazarBodyClasses.
     *
     * @param array $classes
     *
     * @return array
     */
    public function borobazarBodyClasses($classes)
    {
        $bottomNavigationDisplay = $borobazarGlobalSearch = 'off';

        $classes[] = 'borobazar-' . BOROBAZAR_VERSION;
        if (class_exists('BoroBazarHelper')) {
            $classes[] = 'borobazar-helper-' . BOROBAZAR_HELPER_VERSION;
        }

        if (function_exists('borobazar_global_option_data')) {
            $bottomNavigationDisplay = borobazar_global_option_data('bottom_nav_switch', 'off');
            $borobazarGlobalSearch   = borobazar_global_option_data('borobazar_enable_global_search', 'off');
        }

        // Add class of feed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'borobazar';
        }

        // when bottom nav is enable
        if ($bottomNavigationDisplay !== 'off') {
            $classes[] = 'borobazar-bottom-nav-is-active';
        }

        // when global search is disable
        if ($borobazarGlobalSearch !== 'on') {
            $classes[] = 'borobazar-global-search-disable';
        }

        // When transparent header is enable
        if (borobazar_get_header_layout() == 'bogota') {
            $classes[] = 'transparent-header';
        }

        // Add class when WooCommerce exist
        if (class_exists('WooCommerce')) {
            $classes[] = 'borobazar-woo';

            // add class when product single has gallery images
            if (is_singular('product')) {
                global $post;
                if ($post->post_type != "product") {
                    return $classes;
                }
                $product = wc_get_product($post->ID);
                if (!empty($product->get_gallery_image_ids())) {
                    $classes[] = 'onsale-on-product-gallery';
                }
            }
        }

        // Add class based on banner search
        if (has_block('borobazar-blocks/search-banner')) {
            $classes[] = 'borobazar-banner-search-visible';
        }

        return $classes;
    }

    /**
     * registerStyles.
     */
    private static function registerStyles()
    {
        $register_styles = apply_filters('borobazar_frontend_styles_array', [
            'swiper_css' => [
                'src'     => get_theme_file_uri('/assets/global/library/swiper-bundle.min.css'),
                'deps'    => [],
                'version' => '7.0.5',
                'has_rtl' => false,
            ],
            'jquery.overlayScrollbars.min' => [
                'src'     => get_theme_file_uri('/assets/client/library/jquery.overlayScrollbars.min.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => false,
            ],
            'borobazar-tailwind' => [
                'src'     => get_theme_file_uri('/dist/borobazar-tailwind.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => true,
            ],
            'borobazar-woo-style' => [
                'src'     => get_theme_file_uri('/dist/borobazar-woo-style.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => true,
            ],
            'borobazar-main-style' => [
                'src'     => get_theme_file_uri('/dist/borobazar-main-style.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => true,
            ],
            'borobazar-countdown-style' => [
                'src'     => get_theme_file_uri('/assets/client/css/simplyCountdown.theme.default.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => true,
            ],
        ]);

        foreach ($register_styles as $name => $props) {
            self::registerStyle($name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl']);
        }
    }

    /**
     * loadStyles.
     */
    public function loadStyles()
    {
        self::registerStyles();
        self::enqueueStyle('swiper_css');
        self::enqueueStyle('jquery.overlayScrollbars.min');
        self::enqueueStyle('borobazar-tailwind');
        self::enqueueStyle('borobazar-woo-style');
        self::enqueueStyle('borobazar-main-style');

        if (is_rtl()) {
            wp_enqueue_style('borobazar-manual-rtl', get_theme_file_uri('/assets/client/css/borobazar-custom-rtl.css'), [], BOROBAZAR_VERSION);
        }

        if (get_theme_mod('borobazar_countdown_switch') == 'on') {
            self::enqueueStyle('borobazar-countdown-style');
        }
    }
}
