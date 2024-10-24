<?php

namespace Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\Traits\StyleScriptLoader;

class AdminStyles
{
    use StyleScriptLoader;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'loadStyles']);
    }

    /**
     * registerStyles.
     *
     * @return void
     */
    private static function registerStyles()
    {
        $register_styles = apply_filters('borobazar_admin_styles_array', [
            'borobazar-getting-started-css' => [
                'src'     => get_theme_file_uri('/assets/admin/css/getting-started.css'),
                'deps'    => [],
                'version' => BOROBAZAR_VERSION,
                'has_rtl' => false,
            ],
        ]);

        foreach ($register_styles as $name => $props) {
            self::registerStyle($name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl']);
        }
    }

    /**
     * loadStyles.
     *
     * @return void
     */
    public function loadStyles()
    {
        self::registerStyles();
        self::enqueueStyle('borobazar-getting-started-css');
    }
}
