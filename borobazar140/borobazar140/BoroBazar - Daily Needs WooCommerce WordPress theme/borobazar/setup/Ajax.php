<?php

namespace Turbo\Setup;

/**
 * Ajax class
 */
class Ajax
{
    /**
     * Initialize ajax class
     */
    public function __construct()
    {
        add_action('wp_ajax_change_permalink_structure', [$this, 'change_permalink_structure']);
        add_action('wp_ajax_activate_license_key', [$this, 'activate_license_key']);
        add_action('wp_ajax_install_activate_child_theme', [$this, 'install_activate_child_theme']);
        add_action('wp_ajax_install_activate_plugin', [$this, 'install_activate_plugin']);
    }

    public function change_permalink_structure()
    {
        if (!current_user_can('manage_options')) {
            wp_send_json_error([
                'message' => __('Permission denied', 'turbo'),
                'code'    => 403,
                'type'    => 'forbidden',
            ]);
        }

        global $wp_rewrite;

        $new_structure = sanitize_text_field($_POST['new_structure']);
        $wp_rewrite->set_permalink_structure($new_structure);
        $wp_rewrite->flush_rules();

        wp_send_json_success([
            'permalink_structure' => get_option('permalink_structure'),
            'message' => esc_html__('Permalink structure updated successfully!', 'turbo'),
            'html' => '<span title="All set" class="inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#02BC7D" class="w-6 h-6 xl:w-8 xl:h-8 drop-shadow-sm">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </span>',
        ], 200);
    }

    public function activate_license_key()
    {
        $deactivate = false;
        if (isset($_POST['deactivate']) && !empty($_POST['deactivate'])) {
            $deactivate = true;
        }

        if (!check_ajax_referer('rsw-activate-plugins', 'security', false)) {
            wp_send_json_error([
                'message' => __('Nonce verification failed.', 'turbo'),
                'code'    => 403,
                'type'    => 'forbidden',
            ]);
        }

        $purchase_code = sanitize_text_field($_POST['licenseKey']);
        $item_id       = apply_filters('rsw/item_id', '');

        if (empty($purchase_code)) {
            wp_send_json_error([
                'message' => __('Purchase code can not be empty.', 'turbo'),
                'code'    => 404,
                'type'    => 'not_found',
            ]);
        }

        if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $purchase_code)) {
            wp_send_json_error([
                'message' => __('Purchase code is invalid, try with valid one.', 'turbo'),
                'code'    => 400,
                'type'    => 'bad_request',
            ]);
        }


        $rest_base_url = apply_filters('rsw/rest_base_url', '');

        if (empty($rest_base_url)) {
            wp_send_json_error([
                'message' => __('Rest URL is not defined.', 'turbo'),
                'code'    => 404,
                'type'    => 'api_request_failed',
            ]);
        }

        $rest_url =  add_query_arg(array(
            'item_id'       => sanitize_text_field($item_id),
            'purchase_code' => sanitize_text_field($purchase_code),
            'site_url'      => site_url(),
            'deactivate'    => $deactivate,
        ), $rest_base_url . '/wp-json/redqteam/v1/elv');

        $response = wp_remote_get($rest_url, []);

        if (is_wp_error($response) || (200 !== wp_remote_retrieve_response_code($response))) {
            wp_send_json_error([
                'message' => __('Something went wrong with API request.', 'turbo'),
                'code'    => 404,
                'type'    => 'api_request_failed',
            ]);
        }

        $responseBody = wp_remote_retrieve_body($response);
        $result       = json_decode($responseBody, true);

        if (('valid' != $result['item']) || intval($item_id) !== intval($result['product_id'])) {
            wp_send_json_error([
                'message' => __('Purchase code is invalid, try with valid one.', 'turbo'),
                'code'    => 404,
                'type'    => 'activation_failed',
            ]);
        }

        if (isset($result['deactivated']) && !empty($result['deactivated'])) {
            update_option('rsw_purchase_code', '');
            update_option('rsw_activation_status', false);
            wp_send_json_success([
                'message'  => __('License deactivated successfully.', 'turbo'),
                'status'   => __('Inactive', 'turbo'),
                'btn_text' => __('Activate', 'turbo'),
                'code'     => 200,
                'type'     => 'deactivation_success',
            ]);
        }

        update_option('rsw_activation_status', true);
        update_option('rsw_purchase_code', $purchase_code);

        wp_send_json_success([
            'message'  => __('License activated successfully.', 'turbo'),
            'status'   => __('Active', 'turbo'),
            'btn_text' => __('Deactivate', 'turbo'),
            'code'     => 200,
            'type'     => 'activation_success',
        ]);
    }

    /**
     * Install child theme
     *
     * @return array
     */
    public function install_activate_child_theme()
    {
        if (!check_ajax_referer('rsw-activate-plugins', 'security', false)) {
            wp_send_json_success(__('Nonce verification failed.', 'turbo'));
        }

        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $slug          = apply_filters('rsw/child_theme_slug', '');
        $download_link = apply_filters('rsw/child_theme_source', '');

        if (empty($slug) || empty($download_link)) {
            wp_send_json_error(__('Child Theme slug or source missing.', 'turbo'));
        }

        $theme = wp_get_theme(); // gets the current theme
        if ($slug == $theme->get('TextDomain')) {
            wp_send_json_success(__('Child Theme already installed & activated.', 'turbo'));
        }

        // Install the theme
        $upgrader = new \Theme_Upgrader(new \Theme_Installer_Skin());
        $result = $upgrader->install($download_link);

        if (is_wp_error($result)) {
            wp_send_json_error($result->get_error_message());
        }

        $activate = switch_theme($slug);

        if (is_wp_error($activate)) {
            wp_send_json_error($activate->get_error_message());
        }

        wp_send_json_success(__('Theme installed & activated successfully.', 'turbo'));
    }

    /**
     * Install plugin
     *
     */
    public function install_activate_plugin()
    {
        $type = !empty($_POST['type']) ? $_POST['type'] : '';
        $slug = !empty($_POST['slug']) ? $_POST['slug'] : '';
        $base = !empty($_POST['base']) ? $_POST['base'] : '';
        $url  = !empty($_POST['url']) ? $_POST['url'] : '';

        if (!check_ajax_referer('rsw-activate-plugins', 'security', false)) {
            wp_send_json_error([
                'message' => __('Nonce verification failed.', 'turbo'),
                'code'    => 403,
                'type'    => 'forbidden',
            ]);
        }

        if (in_array($base, apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_send_json_success(__('Plugin already installed & activated successfully.', 'turbo'));
        }

        $pluginPath = WP_PLUGIN_DIR . '/' . $base;
        $isInstalled = file_exists($pluginPath);
        if (!$isInstalled) {
            // Include the necessary WordPress files for installing and activating plugins
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

            if ('wporg' == $type) {
                // Prepare the plugin data
                $plugin_info = plugins_api('plugin_information', [
                    'slug'   => $slug,
                    'fields' => array(
                        'short_description' => false,
                        'sections'          => false,
                    ),
                ]);

                if (is_wp_error($plugin_info)) {
                    wp_send_json_error($plugin_info->get_error_message());
                }

                $plugin_download_link = $plugin_info->download_link;
            }

            if ('self' == $type) {
                $plugin_download_link = $url;
            }

            // Install and activate the plugin
            $upgrader = new \Plugin_Upgrader();
            $result   = $upgrader->install($plugin_download_link);

            if (is_wp_error($result)) {
                wp_send_json_error($result->get_error_message());
            }

            $activate = activate_plugin($upgrader->plugin_info());

            if ($slug === 'elementor') {
                update_option('elementor_onboarded', true);
            }
        } else {
            $activate = activate_plugin($base);
        }

        if (is_wp_error($activate)) {
            wp_send_json_error($activate->get_error_message());
        }

        wp_send_json_success(__('Plugin installed & activated successfully.', 'turbo'));
    }
}
