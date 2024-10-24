<?php

namespace Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\Traits\StyleScriptLoader;

class AdminScripts
{
    use StyleScriptLoader;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'loadScripts']);
    }

    /**
     * registerScripts
     *
     * @return void
     */
    private static function registerScripts()
    {
        $register_scripts = apply_filters('borobazar_admin_scripts_array', [
            'swiper' => [
                'src'     => get_theme_file_uri('/assets/global/library/swiper-bundle.min.js'),
                'deps'    => ['jquery', 'underscore'],
                'version' => '7.0.5',
            ],
            'borobazar-admin-main' => [
                'src'     => get_theme_file_uri('/assets/admin/js/borobazar-admin-main.js'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
            ],
        ]);

        foreach ($register_scripts as $name => $key) {
            self::registerScript($name, $key['src'], $key['deps'], $key['version']);
        }
    }

    /**
     * loadScripts.
     *
     * @return void
     */
    public function loadScripts()
    {
        self::registerScripts();
        wp_enqueue_script('jquery-ui-accordion');
        self::enqueueScript('swiper');
        self::enqueueScript('lazyload');
        self::enqueueScript('lottie-player');
        self::enqueueScript('borobazar-admin-main');
    }
}
