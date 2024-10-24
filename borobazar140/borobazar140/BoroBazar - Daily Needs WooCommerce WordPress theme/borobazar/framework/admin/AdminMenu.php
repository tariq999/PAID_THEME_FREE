<?php

namespace Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use TGM_Plugin_Activation;

class AdminMenu
{
    /**
     * includes_path.
     *
     * @var string
     */
    private $includes_path = '';

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->includes_path = wp_normalize_path(dirname(__FILE__));
        add_action('admin_init', [$this, 'borobazarPluginSetupAction']);
        add_action('admin_menu', [$this, 'adminMenu']);
        add_action('after_switch_theme', [$this, 'activationRedirect']);
        add_filter('display_post_states', [$this, 'borobazarDisplayPostStates'], 10, 2);
    }

    /**
     * activationRedirect.
     *
     * @return void
     */
    public function activationRedirect()
    {
        if (current_user_can('switch_themes')) {
            header('Location:' . admin_url() . 'admin.php?page=borobazar');
        }
    }

    public function adminMenu()
    {
        if (current_user_can('switch_themes')) {
            $plugins_callback = [$this, 'plugins_tab'];

            if (isset($_GET['tgmpa-install']) || isset($_GET['tgmpa-update'])) { // phpcs:ignore WordPress.Security
                require_once $this->includes_path . '/../helpers/class-tgm-plugin-activation.php';
                remove_action('admin_notices', [$GLOBALS['tgmpa'], 'notices']);
                $plugins_callback = [$GLOBALS['tgmpa'], 'install_plugins_page'];
            }

            // Work around for theme check.
            $borobazar_menu_page_creation_method = 'add_menu_page';
            $borobazar_submenu_page_creation_method = 'add_submenu_page';

            $welcome_screen = $borobazar_menu_page_creation_method(
                'BoroBazar',
                'BoroBazar',
                'switch_themes',
                'borobazar',
                [$this, 'welcome_screen'],
                'dashicons-admin-site'
            );

            $theme_setup_screen = $borobazar_submenu_page_creation_method(
                'borobazar',
                esc_html__('Theme Requirements', 'borobazar'),
                esc_html__('Theme Requirements', 'borobazar'),
                'switch_themes',
                'borobazar-theme-setup-screen',
                [$this, 'theme_setup_screen']
            );

            $plugins = $borobazar_submenu_page_creation_method(
                'borobazar',
                esc_html__('Plugins', 'borobazar'),
                esc_html__('Plugins', 'borobazar'),
                'install_plugins',
                'borobazar-plugins',
                $plugins_callback
            );

            $miscellaneous = $borobazar_submenu_page_creation_method(
                'borobazar',
                esc_html__('FAQs', 'borobazar'),
                esc_html__('FAQs', 'borobazar'),
                'switch_themes',
                'borobazar-miscellaneous',
                [$this, 'miscellaneous_tab']
            );

            if (class_exists('OCDI_Plugin')) {
                $demos = $borobazar_submenu_page_creation_method(
                    'borobazar',
                    esc_html__('Demos', 'borobazar'),
                    esc_html__('Demos', 'borobazar'),
                    'manage_options',
                    'borobazar-demos',
                    [$this, null]
                );
            }
        }
    }

    /**
     * Include file.
     *
     * @return void
     */
    public function welcome_screen()
    {
        require_once $this->includes_path . '/../../template-parts/admin-templates/welcome.php';
    }

    /**
     * Include file.
     *
     * @return void
     */
    public function theme_setup_screen()
    {
        require_once $this->includes_path . '/../../template-parts/admin-templates/theme_setup_screen.php';
    }

    /**
     * Include file.
     *
     * @return void
     */
    public function miscellaneous_tab()
    {
        require_once $this->includes_path . '/../../template-parts/admin-templates/miscellaneous.php';
    }

    /**
     * Include file.
     *
     * @return void
     */
    public function plugins_tab()
    {
        require_once $this->includes_path . '/../../template-parts/admin-templates/plugins.php';
    }

    /**
     * borobazar_plugin_link.
     *
     * @param mixed $item
     *
     * @return void
     */
    public function borobazar_plugin_link($item)
    {
        $borobazar_installed_plugins = get_plugins();
        $item['sanitized_plugin'] = $item['name'];
        $plugin_base_class = $item['plugin_class_name'];
        $borobazar_plugin_actions = [];
        if (!$item['version']) {
            $item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update($item['slug']);
        }

        if (!isset($borobazar_installed_plugins[$item['file_path']])) {
            $borobazar_plugin_actions = [
                'install' => sprintf(
                    '<a href="%1$s" class="borobazar-plugin-activation-link install-color">' . esc_html__('Install', 'borobazar') . '</a>',
                    esc_url(wp_nonce_url(
                        add_query_arg(
                            [
                                'page'          => urlencode(TGM_Plugin_Activation::$instance->menu),
                                'plugin'        => urlencode($item['slug']),
                                'plugin_name'   => urlencode($item['sanitized_plugin']),
                                'plugin_source' => urlencode($item['source']),
                                'tgmpa-install' => 'install-plugin',
                            ],
                            TGM_Plugin_Activation::$instance->get_tgmpa_url()
                        ),
                        'tgmpa-install',
                        'tgmpa-nonce'
                    )),
                    $item['sanitized_plugin']
                ),
            ];
        } elseif (is_plugin_inactive($item['file_path'])) {
            $borobazar_plugin_actions = [
                'activate' => sprintf(
                    '<a href="%1$s" class="borobazar-plugin-activation-link activate-needed">' . esc_html__('Activate', 'borobazar') . '</a>',
                    esc_url(add_query_arg(
                        [
                            'plugin'                   => urlencode($item['slug']),
                            'plugin_name'              => urlencode($item['sanitized_plugin']),
                            'plugin_source'            => urlencode($item['source']),
                            'borobazar-activate'       => 'activate-plugin',
                            'borobazar-activate-nonce' => wp_create_nonce('borobazar-activate'),
                        ],
                        esc_url(admin_url('admin.php?page=borobazar-plugins'))
                    )),
                    $item['sanitized_plugin']
                ),
            ];
        } elseif (version_compare($borobazar_installed_plugins[$item['file_path']]['Version'], $item['version'], '<')) {
            $borobazar_plugin_actions = [
                'update' => sprintf(
                    '<a href="%1$s" class="borobazar-plugin-activation-link update-needed">' . esc_html__('Update', 'borobazar') . '</a>',
                    wp_nonce_url(
                        add_query_arg(
                            [
                                'page'          => urlencode(TGM_Plugin_Activation::$instance->menu),
                                'plugin'        => urlencode($item['slug']),
                                'tgmpa-update'  => 'update-plugin',
                                'plugin_source' => urlencode($item['source']),
                                'version'       => urlencode($item['version']),
                            ],
                            TGM_Plugin_Activation::$instance->get_tgmpa_url()
                        ),
                        'tgmpa-update',
                        'tgmpa-nonce'
                    ),
                    $item['sanitized_plugin']
                ),
            ];
        } elseif (class_exists($plugin_base_class)) {
            $borobazar_plugin_actions = [
                'deactivate' => sprintf(
                    '<a href="%1$s" class="borobazar-plugin-activation-link deactive">' . esc_html__('Deactivate', 'borobazar') . '</a>',
                    esc_url(add_query_arg(
                        [
                            'plugin'                     => urlencode($item['slug']),
                            'plugin_name'                => urlencode($item['sanitized_plugin']),
                            'plugin_source'              => urlencode($item['source']),
                            'borobazar-deactivate'       => 'deactivate-plugin',
                            'borobazar-deactivate-nonce' => wp_create_nonce('borobazar-deactivate'),
                        ],
                        esc_url(admin_url('admin.php?page=borobazar-plugins'))
                    )),
                    $item['sanitized_plugin']
                ),
            ];
        }

        return $borobazar_plugin_actions;
    }

    /**
     * borobazarPluginSetupAction
     *
     * @return void
     */
    public function borobazarPluginSetupAction()
    {
        if (current_user_can('edit_theme_options')) {
            if (isset($_GET['borobazar-deactivate']) && 'deactivate-plugin' == $_GET['borobazar-deactivate']) {
                check_admin_referer('borobazar-deactivate', 'borobazar-deactivate-nonce');
                $plugins = TGM_Plugin_Activation::$instance->plugins;
                foreach ($plugins as $plugin) {
                    if ($plugin['slug'] == $_GET['plugin']) {
                        deactivate_plugins($plugin['file_path']);
                    }
                }
            }
            if (isset($_GET['borobazar-activate']) && 'activate-plugin' == $_GET['borobazar-activate']) {
                check_admin_referer('borobazar-activate', 'borobazar-activate-nonce');
                $plugins = TGM_Plugin_Activation::$instance->plugins;
                foreach ($plugins as $plugin) {
                    if (isset($_GET['plugin']) && $plugin['slug'] == $_GET['plugin']) {
                        activate_plugin($plugin['file_path']);
                        wp_redirect(esc_url(admin_url('admin.php?page=borobazar-plugins')));
                        exit;
                    }
                }
            }
        }
    }


    /**
     * borobazarDisplayPostStates
     *
     * @param  array $post_states
     * @param  WP_Post $post
     * 
     * @return void
     */
    public function borobazarDisplayPostStates($post_states, $post)
    {
        if ((int) get_theme_mod('borobazar_search_page') === $post->ID) {
            $post_states['borobazar_search_page_id'] = esc_html__('Search Page', 'borobazar');
        }

        return $post_states;
    }
}
