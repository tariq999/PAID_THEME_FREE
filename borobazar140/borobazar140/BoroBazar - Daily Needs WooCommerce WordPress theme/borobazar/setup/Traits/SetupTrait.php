<?php

namespace Turbo\Setup\Traits;


trait SetupTrait
{

    public function get_theme_info()
    {
        $theme = wp_get_theme();

        if (empty($theme->get('Template'))) {
            return $theme;
        }

        $parent = $theme->parent();

        return $parent;
    }

    public function is_child_theme_active()
    {
        $theme = wp_get_theme();

        if (empty($theme->get('Template'))) {
            return false;
        }

        return true;
    }

    public function get_bundle_plugins()
    {
        $plugins = [
            [
                'name'               => esc_html__('BoroBazar Theme Helper', 'borobazar'),
                'slug'               => 'borobazar-helper',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'BoroBazarHelper',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/borobazar-helper.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/borobazar-helper.zip'),
                'version'            => '1.4.0',
                'developed_by'       => 'own',
                'base'               => 'borobazar-helper/borobazar-helper.php',
            ],
            [
                'name'               => esc_html__('GridSter - WooCommerce, Gutenberg Grid Plugin', 'borobazar'),
                'slug'               => 'gridster',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'GridSter',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/gridster.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/gridster.zip'),
                'version'            => '1.2.3',
                'developed_by'       => 'own',
                'has_notices'        => false,
                'base'               => 'gridster/gridster.php',
            ],
            // [
            //     'name'               => esc_html__('RedQ Reuse Form', 'borobazar'),
            //     'slug'               => 'redq-reuse-form',
            //     'required'           => false,
            //     'force_activation'   => false,
            //     'force_deactivation' => false,
            //     'plugin_class_name'  => 'RedqReuseForm',
            //     'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/redq-reuse-form.svg')),
            //     'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.2/redq-reuse-form.zip'),
            //     'version'            => '4.0.5',
            //     'developed_by'       => 'own',
            //     'base'               => 'redq-reuse-form/redq-reuse-form.php',

            // ],
            [
                'name'               => esc_html__('FireMobile - Firebase Mobile Authentication', 'borobazar'),
                'slug'               => 'wp-firebase-auth',
                'required'           => false,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'WFOTP',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/firebase-mobile-auth.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/wp-firebase-auth.zip'),
                'version'            => '1.0.0',
                'developed_by'       => 'own',
                'has_notices'        => false,
                'base'               =>'wp-firebase-auth/WPFirebaseOTP.php'
            ],
            [
                'name'               => esc_html__('Load Google Map', 'borobazar'),
                'slug'               => 'googlemap',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Load_Google_Map',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/google-map.svg')),
                'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/googlemap.zip'),
                'version'            => '1.0.2',
                'developed_by'       => 'own',
                'base'               =>'googlemap/load-google-map.php'
            ],
            // [
            //     'name'               => esc_html__('RedQ WooCommerce Quick View', 'borobazar'),
            //     'slug'               => 'redq-woocommerce-quick-view',
            //     'required'           => false,
            //     'force_activation'   => false,
            //     'force_deactivation' => false,
            //     'plugin_class_name'  => 'RedQWooCommerceQuickView',
            //     'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/pop-up.svg')),
            //     'source'             => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/plugins/1.0/redq-woocommerce-quick-view.zip'),
            //     'version'            => '1.0.2',
            //     'developed_by'       => 'own',
            //     'base'               =>'redq-woocommerce-quick-view/redq-woocommerce-quick-view.php'
            // ],
            [
                'name'               => esc_html__('WooCommerce - excelling eCommerce', 'borobazar'),
                'slug'               => 'woocommerce',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'WooCommerce',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/woocommerce.svg')),
                'developed_by'       => 'Automattic',
                'base'                  => 'woocommerce/woocommerce.php',
            ],
            [
                'name'               => esc_html__('Kirki Customizer Framework', 'borobazar'),
                'slug'               => 'kirki',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'Kirki',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/kirki.svg')),
                'developed_by'       => 'Themeum',
                'base'               => 'kirki/kirki.php',
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
                'base'               => 'contact-form-7/wp-contact-form-7.php',
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
                'base'               => 'one-click-demo-import/one-click-demo-import.php',
            ],
            // [
            //     'name'               => esc_html__('Cookie Notice for GDPR & CCPA', 'borobazar'),
            //     'slug'               => 'cookie-notice',
            //     'required'           => false,
            //     'force_activation'   => false,
            //     'force_deactivation' => false,
            //     'plugin_class_name'  => 'Cookie_Notice',
            //     'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/gdpr_cookie_notice.svg')),
            //     'developed_by'       => 'other',
            //     'has_notices'        => false,
            //     'base'               => 'cookie-notice/cookie-notice.php',
            // ],
            [
                'name'               => esc_html__('Safe SVG', 'borobazar'),
                'slug'               => 'safe-svg',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false,
                'plugin_class_name'  => 'safe_svg',
                'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/svg-support.svg')),
                'developed_by'       => 'other',
                'base'               => 'safe-svg/safe-svg.php',
            ],
            // [
            //     'name'               => esc_html__('Variation Swatches for WooCommerce', 'borobazar'),
            //     'slug'               => 'woo-variation-swatches',
            //     'required'           => false,
            //     'force_activation'   => false,
            //     'force_deactivation' => false,
            //     'plugin_class_name'  => 'Woo_Variation_Swatches',
            //     'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/variation.svg')),
            //     'developed_by'       => 'other',
            //     'has_notices'        => false,
            //     'base'               => 'woo-variation-swatches/woo-variation-swatches.php',
            // ],
            // [
            //     'name'               => esc_html__('Nextend Social Login and Register', 'borobazar'),
            //     'slug'               => 'nextend-facebook-connect',
            //     'required'           => false,
            //     'force_activation'   => false,
            //     'force_deactivation' => false,
            //     'plugin_class_name'  => 'NextendSocialLogin',
            //     'image_url'          => esc_url(get_theme_file_uri('/assets/admin/plugin-thumbs/social-login.svg')),
            //     'developed_by'       => 'other',
            //     'has_notices'        => false,
            //     'base'               => 'nextend-facebook-connect/nextend-facebook-connect.php',
            // ],
        ];
        return $plugins;
    }

    public function get_import_files()
    {
        return [
            [
                'import_file_name'           => 'Classic',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/classic.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/classic.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/classic.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img1.png')),
                'import_notice'              => esc_html__('Classic demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/'),
                'front_page'                 =>'Home Page',
            ],
            [
                'import_file_name'           => 'Vintage',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/vintage.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/vintage.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/vintage.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img2.png')),
                'import_notice'              => esc_html__('Vintage demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/vintage/'),
                'front_page'                  => 'Home Page',
            ],
            [
                'import_file_name'           => 'Modern',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/modern.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/modern.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/modern.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img3.png')),
                'import_notice'              => esc_html__('Modern demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/modern/'),
                'front_page'                  => 'Home Page',
            ],
            [
                'import_file_name'           => 'Minimal',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/minimal.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/minimal.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/minimal.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img4.png')),
                'import_notice'              => esc_html__('Minimal demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/minimal/'),
                'front_page'                  => 'Home Page',
            ],
            [
                'import_file_name'           => 'Standard',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/standard.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/standard.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/standard.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img6.png')),
                'import_notice'              => esc_html__('Standard demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/standard/'),
                'front_page'                  => 'Home Page',
            ],
            [
                'import_file_name'           => 'Trendy',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/trendy.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/trendy.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/trendy.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img7.png')),
                'import_notice'              => esc_html__('Trendy demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/trendy/'),
                'front_page'                  => 'Home Page',
            ],
            [
                'import_file_name'           => 'Elegant',
                'categories'                 => ['Grocery & Bakery'],
                'import_file_url'            => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/elegant.xml'),
                'import_customizer_file_url' => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/elegant.dat'),
                'import_widget_file_url'     => esc_url('https://s3.amazonaws.com/redqteam.com/borobazarwp/demos/elegant.wie'),
                'import_preview_image_url'   => esc_url(get_theme_file_uri('/assets/admin/images/demo-importer/img8.png')),
                'import_notice'              => esc_html__('Elegant demo data is ready to import.', 'borobazar'),
                'preview_url'                => esc_url('https://borobazar.redq.io/elegant/'),
                'front_page'                  => 'Home Page',
            ],
        ];
    }

    public function get_requirement()
    {
        global $wp_version, $wpdb;

        $WP_VERSION              = '5.0.0';
        $WP_MEMORY_LIMIT         = '256M';
        $PHP_VERSION             = '7.0.0';
        $PHP_MAX_INPUT_VARIABLES = '3000';
        $PHP_MAX_EXECUTION_TIME  = '30';
        $PHP_MAX_POST_SIZE       = '8M';
        $MAX_UPLOAD_SIZE         = '16 MB';

        $results = [
            'wp_version' => [
                'title' => esc_html__('WordPress Version', 'borobazar'),
                'required' => $WP_VERSION,
                'current' => $wp_version,
                'status' => version_compare($wp_version, $WP_VERSION, '>='),
                'compare' => '>='
            ],
            'php_version' => [
                'title' => esc_html__('PHP Version', 'borobazar'),
                'required' => $PHP_VERSION,
                'current' => phpversion(),
                'status' => version_compare(phpversion(), $PHP_VERSION, '>='),
                'compare' => '>='
            ],
            'database_version' => $this->get_database_info(),
            'memory_limit' => [
                'title' => esc_html__('WordPress Memory Limit', 'borobazar'),
                'required' => $WP_MEMORY_LIMIT,
                'current' => WP_MEMORY_LIMIT,
                'status' => ((int) filter_var(WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT)),
                'compare' => '>='
            ],
            'php_max_input_vars' => [
                'title' => esc_html__('PHP max input variables', 'borobazar'),
                'required' => $PHP_MAX_INPUT_VARIABLES,
                'current' => ini_get('max_input_vars'),
                'status' => ini_get('max_input_vars') >= $PHP_MAX_INPUT_VARIABLES,
                'compare' => '>='
            ],
            'max_execution_time' => [
                'title' => esc_html__('PHP maximum execution time', 'borobazar'),
                'required' => $PHP_MAX_EXECUTION_TIME,
                'current' => ini_get('max_execution_time'),
                'status' => ini_get('max_execution_time') >= $PHP_MAX_EXECUTION_TIME,
                'compare' => '>='
            ],
            'post_max_size' => [
                'title' => esc_html__('PHP post maximum size', 'borobazar'),
                'required' => $PHP_MAX_POST_SIZE,
                'current' => ini_get('post_max_size'),
                'status' => ini_get('post_max_size') >= (int) filter_var($PHP_MAX_POST_SIZE, FILTER_SANITIZE_NUMBER_INT),
                'compare' => '>='
            ],
            'max_upload_size' => [
                'title' => esc_html__('Maximum Upload Size', 'borobazar'),
                'required' => $MAX_UPLOAD_SIZE,
                'current' => size_format(wp_max_upload_size()),
                'status' => (int) filter_var(size_format(wp_max_upload_size()), FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($MAX_UPLOAD_SIZE, FILTER_SANITIZE_NUMBER_INT),
                'compare' => '>='
            ]
        ];

        return $results;
    }

    public function get_database_info()
    {
        global $wpdb;

        $DB_SCHEMA               = '';
        $MYSQL_VERSION           = '5.6';
        $MARIA_DB_VERSION        = '10.1';

        $serverVersion = $wpdb->get_var('SELECT VERSION()');
        if (strpos($serverVersion, 'MariaDB') !== false) {
            $DB_SCHEMA = 'mariaDB';
        } else {
            $DB_SCHEMA = 'mysql';
        }

        if ($DB_SCHEMA === 'mysql') {
            $database = [
                'title' => esc_html__('MySQL Version', 'borobazar'),
                'required' => $MYSQL_VERSION,
                'current' => $wpdb->db_version(),
                'status' => version_compare($wpdb->db_version(), $MYSQL_VERSION, '>='),
                'compare' => '>='
            ];
        } else {
            $database = [
                'title' => esc_html__('MariaDB Version', 'borobazar'),
                'required' => $MARIA_DB_VERSION,
                'current' => $wpdb->db_version(),
                'status' => version_compare($wpdb->db_version(), $MARIA_DB_VERSION, '>='),
                'compare' => '>='
            ];
        }

        return $database;
    }

    public function set_menu($selected_import)
    {
        $main_menu = get_term_by('name', 'Borobazar Main Menu', 'nav_menu');
        $locations = get_theme_mod('nav_menu_locations');
        $locations['borobazar-menu'] = $main_menu->term_id;
        //_log( $locations);
        set_theme_mod(
            'nav_menu_locations',
            $locations
        );
    }

    public function set_default_pages($selected_import)
    {
        $front_page = $this->turbo_get_post($selected_import['front_page']);
        if (!empty($front_page)) {
            update_option('page_on_front', $front_page);
            update_option('show_on_front', 'page');
        }

        $post_page = $this->turbo_get_post('News');
        if (!empty($post_page)) {
            update_option('page_for_posts', $post_page);
        }


        $option_group = [];
        $listing_page = $this->turbo_get_post('Car Listing');
        if (empty($listing_page)) {
            $listing_page = $this->turbo_get_post('Listing');
        }
        if (!empty($listing_page)) {
            $option_group['listing_page'] = $listing_page;
            update_option('inspect_options', $option_group);
        }
    }

    public function set_inventory_product_mapping($selected_import = [])
    {
        global $wpdb;

        $product_ids = get_posts([
            'post_type' => 'product',
            'fields' => 'ids',
            'posts_per_page' => -1,
        ]);

        $inventory_ids = get_posts([
            'post_type' => 'inventory',
            'fields' => 'ids',
            'posts_per_page' => -1,
        ]);

        if (empty($product_ids) || empty($inventory_ids)) {
            return;
        }

        $pivot_table = $wpdb->prefix . 'rnb_inventory_product';
        $used_inventory_ids = [];

        foreach ($product_ids as $product_id) {
            $existing_inventory_id = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT inventory FROM $pivot_table WHERE product = %d",
                    $product_id
                )
            );

            if ($existing_inventory_id) {
                continue;
            }

            $available_inventory_ids = array_diff($inventory_ids, $used_inventory_ids);
            $inventory_index = array_rand($available_inventory_ids);
            if (!isset($available_inventory_ids[$inventory_index])) {
                continue;
            }
            $selected_inventory_id = $available_inventory_ids[$inventory_index];

            $wpdb->query($wpdb->prepare(
                "INSERT INTO $pivot_table (inventory, product) VALUES (%d, %d)",
                $selected_inventory_id,
                $product_id
            ));

            $used_inventory_ids[] = $selected_inventory_id;
        }
    }

    public function turbo_get_post($page_title, $post_type = 'page')
    {
        global $wpdb;

        $sql = $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
            AND post_type = %s",
            $page_title,
            $post_type
        );

        $page_id = $wpdb->get_var($sql);

        return $page_id;
    }


    /**
     * get_required_plugins_for_demo_data.
     *
     * @return bool
     */
    public function get_required_plugins_for_demo_data()
    {
        $plugins = $this->get_bundle_plugins();
        $required_plugins = [
            'borobazar-helper',
            'gridster',
            'googlemap',
            'woocommerce',
            'kirki',
            'contact-form-7',
            'one-click-demo-import',
            'safe-svg'
        ];

        foreach ($plugins as $plugin) {
            if (!class_exists($plugin['plugin_class_name']) && !is_plugin_active($plugin['base'])) {
                return false;
            }    
        }
        return true;
       
        
        
    }

    public function get_quick_links()
    {
        return [
            [
                'title' => esc_html__('Docs', 'borobazar'),
                'link' => 'https://borobazarwp-doc.vercel.app/',
            ],
            [
                'title' => esc_html__('FAQs', 'borobazar'),
                'link' => 'https://borobazarwp-doc.vercel.app/faq',
            ],
            [
                'title' => esc_html__('Support', 'borobazar'),
                'link' => 'https://redqsupport.ticksy.com/',
            ],
            [
                'title' => esc_html__('Translate Guide', 'borobazar'),
                'link' => 'https://www.youtube.com/watch?v=vx_ATyqEnNg',
            ]
        ];
    }
}
