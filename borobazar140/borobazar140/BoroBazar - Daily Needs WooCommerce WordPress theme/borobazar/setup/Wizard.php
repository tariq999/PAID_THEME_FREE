<?php

namespace Turbo\Setup;

use Turbo\Setup\Traits\SetupTrait;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class
 */
class Wizard
{
    use SetupTrait;

    /**
     * contractor
     */
    public function __construct()
    {
        //_log("TEST");
        $this->define_constants();
        new Hooks();
        add_action('after_setup_theme', [$this, 'init_wizard']);
        add_action('after_switch_theme', [$this, 'activation_redirect']);
        add_filter('woocommerce_enable_setup_wizard', [$this, 'enable_woocommerce_setup_wizard'], 10, 1);
    }

    /**
     * Define constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('RSW_VERSION', '10');
        define('RSW_FILE', __FILE__);
        define('RSW_PATH', __DIR__);
        define('RSW_URL', plugins_url('', RSW_FILE));
        define('RSW_ASSETS', get_template_directory_uri() . '/setup/assets');
        define('RSW_DIR_PATH', plugin_dir_path(__FILE__));
        define('RSW_DIST', get_template_directory_uri() . '/setup/dist');
    }

    /**
     * activation_redirect.
     *
     * @return void
     */
    public function activation_redirect()
    {
        $child_theme = $this->is_child_theme_active();
        if (isset($_GET['page']) && $_GET['page'] === 'rsw-dashboard') {
            return;
        }

        if (current_user_can('switch_themes')) {
            header('Location:' . admin_url() . 'admin.php?page=rsw-dashboard&step=welcome');
        }
    }

    public function enable_woocommerce_setup_wizard($enable)
    {
        return false;
    }

    /**
     * Load plugin files
     *
     * @return void
     */
    public function init_wizard()
    {
        if (is_admin()) {
            new Assets();
            new Ajax();
            new TGM();
            new Admin();
        }
    }
}
