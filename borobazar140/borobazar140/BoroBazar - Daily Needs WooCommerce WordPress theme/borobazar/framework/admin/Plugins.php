<?php

namespace Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class Plugins
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('tgmpa_register', [$this, 'loadPlugins']);
    }

    /**
     * loadPlugins.
     *
     * @return void
     */
    public function loadPlugins()
    {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = [
            [
                'name'               => esc_html__('BoroBazar Theme Helper', 'borobazar'),
                'slug'               => 'borobazar-helper',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'BoroBazarHelper',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/borobazar-helper.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.3.8/borobazar-helper.zip'),
                'version'            => '1.3.8',
                'developed_by'       => 'own',
            ],
            [
                'name'               => esc_html__('GridSter - WooCommerce, Gutenberg Grid Plugin', 'borobazar'),
                'slug'               => 'gridster',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'GridSter',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/gridster.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.3.6/gridster.zip'),
                'version'            => '1.2.2',
                'developed_by'       => 'own',
                'has_notices'        => false,
            ],
            [
                'name'               => esc_html__('RedQ Reuse Form', 'borobazar'),
                'slug'               => 'redq-reuse-form',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'RedqReuseForm',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/redq-reuse-form.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.2/redq-reuse-form.zip'),
                'version'            => '4.0.5',
                'developed_by'       => 'own',
            ],
            [
                'name'               => esc_html__('FireMobile - Firebase Mobile Authentication', 'borobazar'),
                'slug'               => 'wp-firebase-auth',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'WFOTP',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/firebase-mobile-auth.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.0/wp-firebase-auth.zip'),
                'version'            => '1.0.0',
                'developed_by'       => 'own',
                'has_notices'        => false,
            ],
            [
                'name'               => esc_html__('Load Google Map', 'borobazar'),
                'slug'               => 'googlemap',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Load_Google_Map',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/google-map.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.0/googlemap.zip'),
                'version'            => '1.0.2',
                'developed_by'       => 'own',
            ],
            [
                'name'               => esc_html__('RedQ WooCommerce Quick View', 'borobazar'),
                'slug'               => 'redq-woocommerce-quick-view',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'RedQWooCommerceQuickView',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/pop-up.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.0/redq-woocommerce-quick-view.zip'),
                'version'            => '1.0.2',
                'developed_by'       => 'own',
            ],
            [
                'name'               => esc_html__('WooCommerce - excelling eCommerce', 'borobazar'),
                'slug'               => 'woocommerce',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'WooCommerce',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/woocommerce.svg')),
                'developed_by'       => 'other',
            ],
            [
                'name'               => esc_html__('Kirki Customizer Framework', 'borobazar'),
                'slug'               => 'kirki',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Kirki',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/kirki.svg')),
                'developed_by'       => 'other',
            ],

            [
                'name'               => esc_html__('Contact Form 7', 'borobazar'),
                'slug'               => 'contact-form-7',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'WPCF7',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/contact-from-7.svg')),
                'developed_by'       => 'other',
            ],
            [
                'name'               => esc_html__('One Click Demo Importer', 'borobazar'),
                'slug'               => 'one-click-demo-import',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'OCDI_Plugin',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/demo-importer.svg')),
                'developed_by'       => 'other',
            ],
            [
                'name'               => esc_html__('Cookie Notice for GDPR & CCPA', 'borobazar'),
                'slug'               => 'cookie-notice',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Cookie_Notice',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/gdpr_cookie_notice.svg')),
                'developed_by'       => 'other',
                'has_notices'        => false,
            ],
            [
                'name'               => esc_html__('Safe SVG', 'borobazar'),
                'slug'               => 'safe-svg',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'safe_svg',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/svg-support.svg')),
                'developed_by'       => 'other',
            ],
            [
                'name'               => esc_html__('Variation Swatches for WooCommerce', 'borobazar'),
                'slug'               => 'woo-variation-swatches',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Woo_Variation_Swatches',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/variation.svg')),
                'developed_by'       => 'other',
                'has_notices'        => false,
            ],
            [
                'name'               => esc_html__('Nextend Social Login and Register', 'borobazar'),
                'slug'               => 'nextend-facebook-connect',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'NextendSocialLogin',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/social-login.svg')),
                'developed_by'       => 'other',
                'has_notices'        => false,
            ],
        ];

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = [
            'id'           => 'borobazar',             // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        ];
        tgmpa($plugins, $config);
    }
}
