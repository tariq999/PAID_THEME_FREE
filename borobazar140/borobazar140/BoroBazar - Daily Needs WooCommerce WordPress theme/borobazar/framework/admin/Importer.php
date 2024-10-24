<?php

namespace Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class Importer
{
    public function __construct()
    {
        add_filter('ocdi/plugin_page_setup', [$this, 'importerPageSetup']);
        add_filter('ocdi/plugin_page_title', [$this, 'importerPageTitle']);
        add_filter('ocdi/plugin_intro_text', [$this, 'pluginIntroText']);
        add_filter('ocdi/disable_pt_branding', [$this, 'disabledPTBranding']);
        add_action('ocdi/after_import', [$this, 'importAfterSetup']);
        add_filter('pt-ocdi/import_files', [$this, 'importDemoFiles']);
    }

    /**
     * disableCustomerSaveImage.
     *
     * @param mixed $data
     *
     * @return bool
     */
    public function disableCustomerSaveImage($data)
    {
        return false;
    }

    /**
     * enableWpCustomizeSaveHooks.
     *
     * @param mixed $data
     *
     * @return bool
     */
    public function enableWpCustomizeSaveHooks($data)
    {
        return false;
    }

    /**
     * importerPageSetup.
     *
     * @param mixed $default_settings
     *
     * @return array
     */
    public function importerPageSetup($default_settings)
    {
        $default_settings['parent_slug'] = 'admin.php';
        $default_settings['page_title']  = esc_html__('BoroBazar Demos', 'borobazar');
        $default_settings['menu_title']  = esc_html__('BoroBazar Demos', 'borobazar');
        $default_settings['capability']  = 'import';
        $default_settings['menu_slug']   = 'borobazar-demos';

        return $default_settings;
    }

    /**
     * importerPageTitle.
     *
     * @param mixed $intro_text
     *
     * @return void
     */
    public function importerPageTitle($intro_text)
    {
        // Start output buffer for displaying the plugin intro text.
        ob_start(); ?>
        <div class="ocdi__title-container">
            <h1 class="ocdi__title-container-title">
                <?php esc_html_e('BoroBazar Demo Importer', 'borobazar'); ?>
            </h1>
        </div>
    <?php
        $importer_page_title = ob_get_clean();
        return $importer_page_title;
    }

    /**
     * pluginIntroText.
     *
     * @param mixed $intro_text
     *
     * @return void
     */
    public function pluginIntroText($intro_text)
    {
        // Start output buffer for displaying the plugin intro text.
        ob_start(); ?>
        <div class="borobazar-theme-setup-main-wrapper">
            <div class="borobazar-theme-description borobazar-theme-setup-content-wrapper">
                <div class="borobazar-getting-started-description-wrapper">
                    <h1 class="borobazar-theme-setup-content-title"><?php esc_html_e('Description', 'borobazar'); ?></h1>
                    <p class="description-text">
                        <?php esc_html_e('When you import the data, the following things might happen : ', 'borobazar'); ?>
                    </p>
                    <ul>
                        <li>
                            <?php esc_html_e('1. No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'borobazar'); ?>
                        </li>
                        <li>
                            <?php esc_html_e('2. Posts, pages, images, widgets, menus and other theme settings will get imported.', 'borobazar'); ?>
                        </li>
                        <li>
                            <b>
                                <?php esc_html_e('3. Please click on the Import button only once and wait, it can take a couple of minutes.', 'borobazar'); ?>
                            </b>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
<?php
        $notices = ob_get_clean();

        return $notices;
    }

    /**
     * disabledPTBranding.
     *
     * @return bool
     */
    public function disabledPTBranding()
    {
        return true;
    }

    /**
     * importAfterSetup.
     *
     * @return void
     */
    public function importAfterSetup()
    {
        // Assign menus to their locations.
        $main_menu = get_term_by('name', 'Borobazar Main Menu', 'nav_menu');
        set_theme_mod(
            'nav_menu_locations',
            [
                'borobazar-menu' => $main_menu->term_id,
            ]
        );

        // delete hello-world
        $dummyBlog = get_posts(['name' => 'hello-world']);
        if (count($dummyBlog) && isset($dummyBlog[0]->ID)) {
            wp_delete_post($dummyBlog[0]->ID);
        }

        // front page
        $front_page_id = get_page_by_title('Home Page');
        if (isset($front_page_id->ID)) {
            update_option('page_on_front', $front_page_id->ID);
        }
        update_option('show_on_front', 'page');

        // blog page
        $blog_page = get_page_by_title('Blog');
        if (isset($blog_page->ID)) {
            update_option('page_for_posts', $blog_page->ID);
        }
    }




    public function importDemoFiles()
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
            ],
        ];
    }
}
