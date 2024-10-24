<?php

/**
 * BoroBazar functions and definitions.
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\BoroBazar;

if (!defined('BOROBAZAR_THEME_NAME')) {
    if (!empty(wp_get_theme()->get('Template'))) {
        define('BOROBAZAR_THEME_NAME', wp_get_theme()->get('Template'));
    } else {
        define('BOROBAZAR_THEME_NAME', wp_get_theme()->get('Name'));
    }
}

if (!defined('BOROBAZAR_VERSION')) {
    if (!empty(wp_get_theme()->get('Template'))) {
        define('BOROBAZAR_VERSION', wp_get_theme('borobazar')->get('Version'));
    } else {
        define('BOROBAZAR_VERSION', wp_get_theme()->get('Version'));
    }
}

if (!defined('BOROBAZAR_MIN_PHP_VER_REQUIRED')) {
    define('BOROBAZAR_MIN_PHP_VER_REQUIRED', wp_get_theme()->get('RequiresPHP'));
}

if (!defined('BOROBAZAR_MIN_WP_VER_REQUIRED')) {
    define('BOROBAZAR_MIN_WP_VER_REQUIRED', wp_get_theme()->get('RequiresWP'));
}

require get_theme_file_path('/vendor/autoload.php');
require get_theme_file_path('/framework/helpers/class-kirki-installer-section.php');
if (is_admin()) {
    require get_theme_file_path('/framework/helpers/class-tgm-plugin-activation.php');
}
new BoroBazar();


function borobazarUpdateNotice()
{
    $class = esc_attr('notice notice-success is-dismissible');
    $message = esc_html__('Dear valued customer. Please follow up this announcement first.', 'borobazar');
    $description = esc_html__('As BoroBazar v1.2.x is introuduced, some changes are made from previous version to this version. So, migrating users from the older version ', 'borobazar');
    $link = esc_url('https://borobazarwp-doc.vercel.app/breaking-change');
    $lnk_text = esc_html__('please follow up this documentaion.', 'borobazar');
    printf('<div class="%1$s"> <h3> %2$s </h3> <p> %3$s <a href="%4$s" target="_blank">%5$s</a> [note : link will be open in a new tab]. </p> </div>', $class, $message, $description, $link, $lnk_text);
}
// add_action('admin_notices', 'borobazarUpdateNotice');
