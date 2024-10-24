<?php

namespace Turbo\Setup\Admin;

use Turbo\Setup\Traits\SetupTrait;

use TGM_Plugin_Activation;

/**
 * Admin menu class
 */
class Menu
{
    use SetupTrait;

    public $settings;
    /**
     * Initialize menu
     */
    function __construct()
    {
        $this->settings = new Settings();
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'restrict_admin_page']);
    }

    public function restrict_admin_page()
    {
        global $pagenow;

        if ('themes.php' == $pagenow && isset($_GET['page']) && 'one-click-demo-import' == $_GET['page']) {
            wp_die(__('Sorry, you are not allowed to access this page.'));
        }
    }

    /**
     * Handle plugin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        remove_submenu_page('themes.php', 'one-click-demo-import');

        $parent_slug = 'rsw-dashboard';
        $capability  = 'manage_options';

        add_menu_page(
            __('Borobazar', 'borobazar'),
            __('Borobazar', 'borobazar'),
            $capability,
            $parent_slug,
            [$this, 'dashboard_page'],
            'dashicons-admin-site',
            61
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('Setup Wizard', 'turbo'),
            esc_html__('Setup Wizard', 'turbo'),
            'manage_options',
            'admin.php?page=rsw-dashboard&step=welcome',
            ''
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('Requirements', 'turbo'),
            esc_html__('Requirements', 'turbo'),
            'manage_options',
            'admin.php?page=rsw-dashboard&step=requirements',
            ''
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('License Activation', 'turbo'),
            esc_html__('License Activation', 'turbo'),
            'manage_options',
            'admin.php?page=rsw-dashboard&step=activation',
            ''
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('Borobazar Options Panel', 'borobazar'),
            esc_html__('Borobazar Options Panel', 'borobazar'),
            'manage_options',
            'customize.php?autofocus[section]=borobazar_config',
            ''
        );
    
        add_submenu_page(
            $parent_slug,
            esc_html__('Theme Documentation', 'borobazar'),
            esc_html__('Documentation', 'borobazar'),
            'manage_options',
            'theme-documentation',
            [$this, 'theme_documentation_callback']
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('FAQs', 'borobazar'),
            esc_html__('FAQs', 'borobazar'),
            'switch_themes',
            'turbo-miscellaneous',
            [$this, 'miscellaneous_tab']
        );

        add_submenu_page(
            $parent_slug,
            esc_html__('Theme Support', 'borobazar'),
            esc_html__('Support Forum', 'borobazar'),
            'manage_options',
            'theme-support',
            [$this, 'theme_support_callback']
        );
    }

    /**
     * Handle menu page
     *
     * @return void
     */
    public function dashboard_page()
    {
        wp_enqueue_style('rsw-tailwind');
        wp_enqueue_style('rsw-global');

        $this->settings->dashboard_page();
    }

    public function theme_documentation_callback()
    {
        wp_redirect('https://wordpress-rental-booking-doc.vercel.app/');
        exit;
    }

    /**
     * Include file.
     *
     * @return void
     */
    public function miscellaneous_tab()
    {
        include __DIR__ . '/view/miscellaneous.php';
    }

    public function theme_support_callback()
    {
        wp_redirect('https://redqsupport.ticksy.com/');
        exit;
    }
}
