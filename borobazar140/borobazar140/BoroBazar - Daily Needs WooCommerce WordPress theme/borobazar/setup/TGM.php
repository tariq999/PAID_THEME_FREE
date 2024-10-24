<?php

namespace  Turbo\Setup;

use Turbo\Setup\Traits\SetupTrait;

include_once get_template_directory() . '/setup/class-tgm-plugin-activation.php';

class TGM
{
    use SetupTrait;

    /**
     * Class initialize
     */
    function __construct()
    {
        $license_activated = get_option('rsw_activation_status', false);
        if (empty($license_activated)) {
            return;
        }

        add_action('tgmpa_register', [$this, 'turbo_register_required_plugins']);
    }

    function turbo_register_required_plugins()
    {
        $required_plugins = $this->get_bundle_plugins();

        $config = array(
            'id'           => 'tgmpapa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpapa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'turbo'),
                'menu_title'                      => esc_html__('Turbo Required Plugins', 'turbo'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'turbo'), // %s = plugin name.
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'turbo'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'turbo'), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'turbo'), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'turbo'), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'turbo'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'turbo'), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'turbo'), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'turbo'), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'turbo'), // %1$s = plugin name(s).
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'turbo'),
                'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins', 'turbo'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'turbo'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'turbo'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'turbo'), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($required_plugins, $config);
    }
}
