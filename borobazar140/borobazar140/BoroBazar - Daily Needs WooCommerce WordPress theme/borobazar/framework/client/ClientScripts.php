<?php

namespace Framework\Client;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\Traits\StyleScriptLoader;

class ClientScripts
{
    use StyleScriptLoader;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'loadScripts']);
    }

    /**
     * registerScripts.
     *
     * @return void
     */
    private static function registerScripts()
    {
        $register_scripts = apply_filters('borobazar_frontend_scripts_array', [
            'swiper' => [
                'src'     => get_theme_file_uri('/assets/global/library/swiper-bundle.min.js'),
                'deps'    => ['jquery', 'underscore'],
                'version' => '7.0.5',
            ],
            'jquery.overlayScrollbars.min' => [
                'src'     => get_theme_file_uri('/assets/client/library/jquery.overlayScrollbars.min.js'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
            ],
            'borobazar-woo' => [
                'src'     => get_theme_file_uri('/assets/client/js/borobazar-woo.js'),
                'deps'    => ['swiper'],
                'version' => BOROBAZAR_VERSION,
            ],

            'borobazar-countdown' => [
                'src'     => get_theme_file_uri('/assets/client/library/simplyCountdown.min.js'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
            ],
            'borobazar-countdown-settings' => [
                'src'     => get_theme_file_uri('/assets/client/js/countdownSettings.js'),
                'deps'    => ['borobazar-countdown'],
                'version' => BOROBAZAR_VERSION,
            ],
            'borobazar-main' => [
                'src'     => get_theme_file_uri('/assets/client/js/borobazar-main.js'),
                'deps'    => ['swiper', 'borobazar-woo'],
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
        self::enqueueScript('swiper');
        self::enqueueScript('jquery.overlayScrollbars.min');
        self::enqueueScript('borobazar-woo');
        if (get_theme_mod('borobazar_countdown_switch') == 'on') {
            self::enqueueScript('borobazar-countdown');
            self::enqueueScript('borobazar-countdown-settings');

            wp_localize_script("borobazar-countdown-settings", "countDownData", [
                'date' => get_theme_mod("date_setting")
            ]);
        }
        self::enqueueScript('borobazar-main');
    }
}
