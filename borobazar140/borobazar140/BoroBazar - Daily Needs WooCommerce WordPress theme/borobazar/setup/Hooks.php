<?php

namespace Turbo\Setup;

use Turbo\Setup\Traits\SetupTrait;

class Hooks
{
    use SetupTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        add_filter('ocdi/import_files', [$this, 'ocdi_import_files']);
        add_filter('rsw/bundled_plugins', [$this, 'rsw_bundled_plugins']);
        add_filter('rsw/child_theme_slug', [$this, 'rsw_child_theme_slug']);
        add_filter('rsw/child_theme_source', [$this, 'rsw_child_theme_source']);
        add_filter('rsw/rest_base_url', [$this, 'rsw_rest_base_url']);
        add_filter('rsw/tab_steps', [$this, 'rsw_tab_steps']);
        add_filter('rsw/item_id', [$this, 'rsw_item_id']);
        add_action('ocdi/after_import', [$this, 'after_demo_import']);
    }

    /**
     * Product Item Id which needs to be verify
     *
     * @return string
     */
    public function rsw_item_id()
    {
        return '35496701';
    }

    /**
     * Uses Example: steps/tabs
     *
     * @return array
     */
    public function rsw_tab_steps()
    {
        return [
            'welcome' => [
                'label' => __('Welcome', 'borobazar'),
                'callback' => 'step_welcome',
            ],
            'requirements' => [
                'label' => __('Requirements', 'borobazar'),
                'callback' => 'step_requirements',
            ],
            'activation' => [
                'label' => __('Activation', 'borobazar'),
                'callback' => 'step_activation',
                'required' => true,
            ],
            'child_theme' => [
                'label' => __('Child Theme', 'borobazar'),
                'callback' => 'step_child_theme',
            ],
            'plugins' => [
                'label' => __('Plugins', 'borobazar'),
                'callback' => 'step_plugins',
            ],
            'demo_content' => [
                'label' => __('Demo Content', 'borobazar'),
                'callback' => 'step_demo_content',
            ],
            // 'supported_plugins' => [
            //     'label' => __('Supported Plugin', 'borobazar'),
            //     'callback' => 'step_supported_plugins',
            // ],
            'done' => [
                'label' => __('Done', 'borobazar'),
                'callback' => 'step_done',
            ],
        ];
    }

    /**
     * Uses Example: rest base url
     *
     * @return string
     */
    public function rsw_rest_base_url()
    {
        return 'https://rnb.redq.io';
    }

    /**
     * Uses Example: child theme source
     *
     * @return string
     */
    //TO DO: Add child them link 
    public function rsw_child_theme_source()
    {
        return 'https://s3.amazonaws.com/redqteam.com/borobazarwp/child-theme/borobazar-child.zip';
    }

    /**
     * Uses Example: child theme slug
     *
     * @return string
     */
    public function rsw_child_theme_slug()
    {
        return 'borobazar-child';
    }

    /**
     * Uses Example: Demo data
     *
     * @return array
     */
    function ocdi_import_files()
    {
        return $this->get_import_files();
    }

    /**
     * Uses Example: Bundled pluigns array
     *
     * @return array
     */
    public function rsw_bundled_plugins()
    {
        return $this->get_bundle_plugins();
    }
//  TODO:FIX menu and home page
    /**
     * after_demo_import.
     *
     * @return void
     */
    public function after_demo_import($selected_import)
    {
        $dummyBlog = get_posts(['name' => 'hello-world']);
        if (count($dummyBlog) && isset($dummyBlog[0]->ID)) {
            wp_delete_post($dummyBlog[0]->ID);
        }
        $this->set_menu($selected_import);
        $this->set_default_pages($selected_import);
    }
}
