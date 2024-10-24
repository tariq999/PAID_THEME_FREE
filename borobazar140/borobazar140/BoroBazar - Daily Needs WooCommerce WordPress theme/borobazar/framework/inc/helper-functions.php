<?php

if (!function_exists('borobazar_is_blog_page')) {
    /**
     * Check whether blog template or not.
     *
     * @since 1.0.0
     */
    function borobazar_is_blog_page()
    {
        if (!borobazar_is_woo_page() && (is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search())) {
            return true;
        }

        return false;
    }
}

if (!function_exists('borobazar_is_woo_page')) {
    /**
     * Check whether woocommerce archive template or not.
     *
     * @since 1.0.0
     */
    function borobazar_is_woo_page()
    {
        if (class_exists('WooCommerce') && (is_shop() || is_cart() || is_account_page() || is_checkout())) {
            return true;
        }

        return false;
    }
}


if (!function_exists('borobazar_is_search_page')) {
    /**
     * Get all pages
     *
     * @return array
     */
    function borobazar_is_search_page()
    {
        $searchPage  = (int) get_theme_mod('borobazar_search_page');

        if (empty($searchPage)) {
            return false;
        }

        $currentPage = get_the_ID();

        if ($searchPage === $currentPage) {
            return true;
        }

        return false;
    }
}


if (!function_exists('blog_dynamic_css')) {
    /**
     * blog_dynamic_css.
     *
     * @param mixed $blogColorSchema
     *
     * @return void
     */
    function blog_dynamic_css($blogColorSchema)
    {
        $variables = $blogBannerBGColor = $blogBannerBGTextColor = '';
        if (!empty($blogColorSchema)) {
            foreach ($blogColorSchema as $value) {
                $blogBannerBGColor = $value['blogBannerBGColor'];
                $blogBannerBGTextColor = $value['blogBannerTextColor'];
            }
        }
        $variables .= '
            --localBlogBannerBGColor: ' . $blogBannerBGColor . ';
            --localBlogBannerTextColor: ' . $blogBannerBGTextColor . ';
        ';

        return $variables;
    }
}

if (!function_exists('banner_dynamic_css')) {
    /**
     * banner_dynamic_css.
     *
     * @param mixed $bannerColorSchema
     *
     * @return void
     */
    function banner_dynamic_css($bannerColorSchema)
    {
        $variables = $pageBannerBGColor = $pageBannerTextColor = '';
        if (!empty($bannerColorSchema)) {
            foreach ($bannerColorSchema as $value) {
                $pageBannerBGColor = $value['pageBannerBGColor'];
                $pageBannerTextColor = $value['pageBannerTextColor'];
            }
        }
        $variables .= '
            --localPageBannerBGColor: ' . $pageBannerBGColor . ';
            --localPageBannerTextColor: ' . $pageBannerTextColor . ';
        ';

        return $variables;
    }
}


if (!function_exists('demo_importing_check')) {
    /**
     * demo_importing_check.
     *
     * @return bool
     */
    function demo_importing_check()
    {
        $plugin_check_borobazar_helper = false;
        $plugin_check_google_map = false;
        $plugin_check_OCDI = false;
        $plugin_check_kirki = false;
        $plugin_check_WooCommerce = false;

        if (class_exists('BoroBazarHelper')) {
            $plugin_check_borobazar_helper = true;
        }
        if (class_exists('Load_Google_Map')) {
            $plugin_check_google_map = true;
        }
        if (class_exists('OCDI_Plugin')) {
            $plugin_check_OCDI = true;
        }
        if (class_exists('Kirki')) {
            $plugin_check_kirki = true;
        }
        if (class_exists('WooCommerce')) {
            $plugin_check_WooCommerce = true;
        }

        if (
            $plugin_check_borobazar_helper == true && $plugin_check_google_map == true && $plugin_check_OCDI == true && $plugin_check_kirki == true && $plugin_check_WooCommerce == true
        ) {
            return true;
        }

        return false;
    }
}


if (!function_exists('theme_related_plugin_check')) {
    /**
     * theme_related_plugin_check.
     *
     * @return bool
     */
    function theme_related_plugin_check()
    {
        $plugin_check_borobazar_helper = false;
        $plugin_check_google_map       = false;
        $plugin_check_OCDI             = false;
        $plugin_check_kirki            = false;
        $plugin_check_WooCommerce      = false;
        $plugin_check_gridster         = false;

        if (class_exists('WooCommerce')) {
            $plugin_check_WooCommerce = true;
        }

        if (class_exists('BoroBazarHelper')) {
            $plugin_check_borobazar_helper = true;
        }
        if (class_exists('Load_Google_Map')) {
            $plugin_check_google_map = true;
        }
        if (class_exists('OCDI_Plugin')) {
            $plugin_check_OCDI = true;
        }
        if (class_exists('Kirki')) {
            $plugin_check_kirki = true;
        }

        if (class_exists("GridSter")) {
            $plugin_check_gridster = true;
        }

        if (
            $plugin_check_borobazar_helper == true && $plugin_check_google_map == true && $plugin_check_OCDI == true && $plugin_check_kirki == true && $plugin_check_WooCommerce == true && $plugin_check_gridster == true
        ) {
            return true;
        }

        return false;
    }
}



if (!function_exists('theme_server_requirment_check')) {
    /**
     * theme_server_requirment_check.
     *
     * @return bool
     */
    function theme_server_requirment_check()
    {
        global $wp_version, $wpdb;

        $WP_VERSION = '5.0.0';
        $WP_VERSION_CHECK = false;

        $WP_MEMORY_LIMIT = '256M';
        $WP_MEMORY_LIMIT_CHECK = false;

        $PHP_VERSION = '7.0.0';
        $PHP_VERSION_CHECK = false;

        $PHP_MAX_INPUT_VARIABLES = '3000';
        $PHP_MAX_INPUT_VARIABLES_CHECK = false;

        $PHP_MAX_EXECUTION_TIME = '30';
        $PHP_MAX_EXECUTION_TIME_CHECK = false;

        $PHP_MAX_POST_SIZE = '8M';
        $PHP_MAX_POST_SIZE_CHECK = false;

        $MAX_UPLOAD_SIZE = '16 MB';
        $MAX_UPLOAD_SIZE_CHECK = false;

        $DB_SCHEMA = '';
        $MYSQL_VERSION = '5.6';
        $MARIA_DB_VERSION = '10.1';
        $DB_VERSION_CHECK = false;

        $serverVersion = $wpdb->get_var('SELECT VERSION()');
        if (strpos($serverVersion, 'MariaDB') !== false) {
            $DB_SCHEMA = 'mariaDB';
        } else {
            $DB_SCHEMA = 'mysql';
        }
        if (!empty($DB_SCHEMA) && $DB_SCHEMA === 'mariaDB') {
            $DB_VERSION = $MARIA_DB_VERSION;
        } else {
            $DB_VERSION = $MYSQL_VERSION;
        }

        if ($wp_version >= $WP_VERSION) {
            $WP_VERSION_CHECK = true;
        }

        if ((int) filter_var(WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT)) {
            $WP_MEMORY_LIMIT_CHECK = true;
        }

        if (phpversion() >= $PHP_VERSION) {
            $PHP_VERSION_CHECK = true;
        }

        if (ini_get('max_input_vars') >= $PHP_MAX_INPUT_VARIABLES) {
            $PHP_MAX_INPUT_VARIABLES_CHECK = true;
        }

        if (ini_get('max_execution_time') >= $PHP_MAX_EXECUTION_TIME) {
            $PHP_MAX_EXECUTION_TIME_CHECK = true;
        }
        if (ini_get('post_max_size') >= (int) filter_var($PHP_MAX_POST_SIZE, FILTER_SANITIZE_NUMBER_INT)) {
            $PHP_MAX_POST_SIZE_CHECK = true;
        }
        if ((int) filter_var(size_format(wp_max_upload_size()), FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($MAX_UPLOAD_SIZE, FILTER_SANITIZE_NUMBER_INT)) {
            $MAX_UPLOAD_SIZE_CHECK = true;
        }

        if ($wpdb->db_version() >= $DB_VERSION) {
            $DB_VERSION_CHECK = true;
        }

        if (
            $WP_VERSION_CHECK == true && $WP_MEMORY_LIMIT_CHECK == true && $PHP_VERSION_CHECK == true && $PHP_MAX_INPUT_VARIABLES_CHECK == true && $PHP_MAX_EXECUTION_TIME_CHECK == true && $PHP_MAX_POST_SIZE_CHECK == true && $MAX_UPLOAD_SIZE_CHECK == true && $DB_VERSION_CHECK == true
        ) {
            return true;
        }

        return false;
    }
}
