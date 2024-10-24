<?php

namespace Framework\Traits;

defined('ABSPATH') || exit;

trait StyleScriptLoader
{
    private static $scripts = [];

    private static $styles = [];

    /**
     * registerScript.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param bool   $in_footer
     */
    public static function registerScript($handle, $path, $deps = ['jquery'], $version = BOROBAZAR_VERSION, $in_footer = true)
    {
        self::$scripts[] = $handle;
        wp_register_script($handle, $path, $deps, $version, $in_footer);
    }

    /**
     * enqueueScript.
     *
     * @param string $handle
     * 
     */
    public static function enqueueScript($handle)
    {
        wp_enqueue_script($handle);
    }

    /**
     * registerStyle.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param string $media
     * @param bool   $has_rtl
     */
    public static function registerStyle($handle, $path, $deps = [], $version = BOROBAZAR_VERSION, $media = 'all', $has_rtl)
    {
        self::$styles[] = $handle;
        wp_register_style($handle, $path, $deps, $version, $media);

        if ($has_rtl) {
            wp_style_add_data($handle, 'rtl', 'replace');
        }
    }

    /**
     * enqueueStyle.
     *
     * @param string $handle
     * 
     */
    public static function enqueueStyle($handle)
    {
        wp_enqueue_style($handle);
    }

    /**
     * localizeScripts.
     *
     * @param string $handle
     * @param string $localize_variable_name
     * @param array  $data
     */
    public static function localizeScripts($handle, $localize_variable_name = '', $data = [])
    {
        wp_localize_script($handle, $localize_variable_name, $data);
    }
}
