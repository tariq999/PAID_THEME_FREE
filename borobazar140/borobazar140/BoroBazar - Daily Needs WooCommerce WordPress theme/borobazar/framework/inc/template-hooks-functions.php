<?php

if (!function_exists('borobazar_get_header_layout')) {
    /**
     * Header layout.
     *
     * @since 1.0.0
     */
    function borobazar_get_header_layout()
    {
        $layout = 'default';
        return get_theme_mod('borobazar_header_layout', $layout);
    }
}

if (!function_exists('borobazar_header_wrapper_start')) {
    /**
     * Header wrapper.
     *
     * @since 1.0.0
     */
    function borobazar_header_wrapper_start()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/wrapper-start';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_header_topbar')) {
    /**
     * Topbar.
     *
     * @since 1.0.0
     */
    function borobazar_header_topbar()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/topbar';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_site_branding')) {
    /**
     * Site branding.
     *
     * @since 1.0.0
     */
    function borobazar_site_branding()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/site-branding';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_header_menu')) {
    /**
     * Header menu.
     *
     * @since 1.0.0
     */
    function borobazar_header_menu()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/menu';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_header_drawer_menu')) {
    /**
     * Header drawer menu.
     *
     * @since 1.0.0
     */
    function borobazar_header_drawer_menu()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/drawer-menu';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_header_search')) {
    /**
     * Header search.
     *
     * @since 1.0.0
     */
    function borobazar_header_search()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/search';
        get_template_part($template);
    }
}


if (!function_exists('borobazar_header_global_search')) {
    /**
     * Header global search
     *
     * @since 1.0.0
     */
    function borobazar_header_global_search()
    {
        $layout   = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/global-search';

        get_template_part($template);
    }
}

if (!function_exists('borobazar_woo_link')) {
    /**
     * Woo link.
     *
     * @since 1.0.0
     */
    function borobazar_woo_link()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/woo';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_wpml_function')) {
    /**
     * WPML language.
     *
     * @since 1.0.0
     */
    function borobazar_wpml_function()
    {
        if (!class_exists('SitePress')) {
            return;
        }

        $langSwitcher = get_theme_mod('borobazar_lang_switcher', 'off');

        if ($langSwitcher === 'off') {
            return;
        }

        $template = 'template-parts/global/language';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_header_wrapper_end')) {
    /**
     * Header wrapper end.
     *
     * @since 1.0.0
     */
    function borobazar_header_wrapper_end()
    {
        $layout = borobazar_get_header_layout();
        $template = 'template-parts/header/' . $layout . '/wrapper-end';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_get_footer_layout')) {
    /**
     * Footer layout.
     *
     * @since 1.0.0
     */
    function borobazar_get_footer_layout()
    {
        $layout = 'default';

        return get_theme_mod('borobazar_footer_layout', $layout);
    }
}

if (!function_exists('borobazar_footer_render')) {
    /**
     * Footer render.
     *
     * @since 1.0.0
     */
    function borobazar_footer_render()
    {

        $layout = borobazar_get_footer_layout();
        $template = 'template-parts/footer/' . $layout . '/footer';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_get_copyright_layout')) {
    /**
     * Copyright layout.
     *
     * @since 1.0.0
     */
    function borobazar_get_copyright_layout()
    {
        $layout = 'default';

        return get_theme_mod('borobazar_copyright_layout', $layout);
    }
}

if (!function_exists('borobazar_copyright_render')) {
    /**
     * Copyright render.
     *
     * @since 1.0.0
     */
    function borobazar_copyright_render()
    {
        $layout = borobazar_get_copyright_layout();
        $template = 'template-parts/copyright/' . $layout . '/copyright';
        get_template_part($template);
    }
}

if (!function_exists('borobazar_banner')) {
    /**
     * Banner
     *
     * @since 1.0.0
     */
    function borobazar_banner()
    {
        if (borobazar_is_blog_page()) {
            $name = 'banner-blog';
        } elseif (is_singular('post')) {
            $name = 'banner-single';
        } elseif (borobazar_is_woo_page()) {
            $name = 'banner-shop';
        } elseif (class_exists('WooCommerce') && is_product()) {
            $name = 'banner-none';
        } else {
            $name = 'banner';
        }

        $template = 'template-parts/banner/' . $name;

        get_template_part($template);
    }
}

if (!function_exists('borobazar_site_loader')) {
    /**
     * Site loader
     *
     * @since 1.0.0
     */
    function borobazar_site_loader()
    {
        if (get_theme_mod('site_loader', 'off') === 'on') {
            $template = 'template-parts/global/site-loader';
        } else {
            $template = '';
        }
        get_template_part($template);
    }
}

if (!function_exists('borobazar_store_notice')) {
    /**
     * Store notice
     *
     * @since 1.0.0
     */
    function borobazar_store_notice()
    {
        $template = '';
        if (class_exists('WooCommerce') && (is_account_page() && !is_user_logged_in())) {
            // remove header only from WooCommerce login page
        } else {
            if (get_theme_mod('borobazar_store_notice_switch', 'off') === 'on') {
                $template = 'template-parts/global/store-notice';
            }
        }
        get_template_part($template);
    }
}
