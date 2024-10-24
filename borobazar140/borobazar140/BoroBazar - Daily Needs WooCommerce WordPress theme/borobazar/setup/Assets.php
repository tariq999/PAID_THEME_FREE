<?php

namespace Turbo\Setup;

/**
 * Assets class handler
 */
class Assets
{
    /**
     * Initialize assets
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * get_scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'admin-script' => [
                'src'     => RSW_ASSETS . '/js/admin.js',
                'version' => filemtime(RSW_PATH . '/assets/js/admin.js'),
                'deps'    => ['jquery']
            ]
        ];
    }

    /**
     * get_styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'rsw-global' => [
                'src'     => RSW_DIST . '/rsw-global.css',
                'version' => filemtime(RSW_PATH . '/dist/rsw-global.css'),
            ],
            'rsw-tailwind' => [
                'src'     => RSW_DIST . '/rsw-tailwind.css',
                'version' => filemtime(RSW_PATH . '/dist/rsw-tailwind.css'),
            ]
        ];
    }

    /**
     * Register assets
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ($scripts as $handle => $script) {


            $deps = isset($script['deps']) ? $script['deps'] : false;
            $version = isset($script['version']) ? $script['version'] : RSW_VERSION;
            wp_register_script($handle, $script['src'], $deps, $version, true);
        }

        foreach ($styles as $handle => $style) {


            $deps = isset($style['deps']) ? $style['deps'] : false;
            $version = isset($style['version']) ? $style['version'] : RSW_VERSION;
            wp_register_style($handle, $style['src'], $deps, $version);
        }
    }
}
