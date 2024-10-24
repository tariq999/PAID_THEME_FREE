<?php

namespace Turbo\Setup\Admin;

use Turbo\Setup\Traits\SetupTrait;

class SetupWizard
{
    use SetupTrait;

    /**
     * Steps variable
     *
     * @var array
     */
    public static $steps = [];

    /**
     * Active step variable
     *
     * @var array
     */
    public static $step;

    /**
     * Class initialize
     */
    function __construct()
    {

        $this->set_steps();
        $this->set_required_tabs();
        $this->setup_wizard_page();
    }

    /**
     * Setup WIzard page
     *
     * @return void
     */
    public function setup_wizard_page()
    {
        if (empty($_GET['page']) || ('rsw-dashboard' !== $_GET['page'])) {
            return;
        }

        $theme = $this->get_theme_info();

        echo '<div class="redq-setup-wizard-wrapper relative md:grid md:grid-cols-12 md:gap-5 p-6 lg:p-12 my-8 md:grid-rows-[auto_200px] bg-white rounded-lg max-w-full w-full shadow-main-shadow">';
       
        echo       '<span class="absolute right-6 lg:right-12 top-6 inline-block rounded-[4px]">';
        include __DIR__ . '/views/logo.php';
        echo       '</span>';

        $this->rsw_styles();
        $this->rsw_steps();
        
        $this->rsw_content();
        $this->rsw_navigation();
        echo '</div>';

        $this->update_browse_steps();
    }

    /**
     * Check required tab
     *
     * @return void
     */
    public static function check_if_required_tab_not_browse()
    {
        $purchase_code = get_option('rsw_purchase_code', '');
        $activation_status = get_option('rsw_activation_status', false);
        $last_active = get_option('rsw_last_active', null);
        $last_require = get_option('rsw_last_required', 0);
        $browsed_steps = get_option('rsw_browsed_steps', []);
        $required_steps = get_option('rsw_required_steps', []);
        $steps = array_keys(apply_filters('rsw/tab_steps', []));
        $step = isset($_GET['step']) ? sanitize_key($_GET['step']) : current($steps);

        if ($last_require && isset($_GET['next']) && ($_GET['next'] == 1)) {
            $browsed_steps[] = $last_active;
            update_option('rsw_browsed_steps', $browsed_steps);
            $url = self::generte_redirect_url($step);
            wp_redirect($url);
            exit;
        } else {
            foreach ($required_steps as $key => $required_step) {
                if (array_search($step, $steps) > array_search($required_step, $steps) && (!in_array($required_step, $browsed_steps) || (in_array($required_step, $browsed_steps) && !$purchase_code && !$activation_status))) {
                    $url = self::generte_redirect_url($required_step);
                    wp_redirect($url);
                    exit;
                }
            }
        }
    }

    /**
     * Generate redirect URL
     *
     * @return string
     */
    public static function generte_redirect_url($step)
    {
        return add_query_arg('step', $step, self::wizard_url());
    }

    /**
     * Set steps
     *
     * @return void
     */
    public function set_steps()
    {
        self::$steps = apply_filters('rsw/tab_steps', []);
        self::$step = isset($_GET['step']) ? sanitize_key($_GET['step']) : current(array_keys(self::$steps));
    }

    /**
     * Set required tab items
     *
     * @return void
     */
    public function set_required_tabs()
    {
        $rsw_required_steps = get_option('rsw_required_steps', []);

        if (!empty($rsw_required_steps)) {
            return;
        }

        // Filter the array based on the 'required' key's value
        $filteredArray = array_filter(self::$steps, function ($item) {
            return isset($item['required']) && $item['required'];
        });

        update_option('rsw_required_steps', array_keys($filteredArray));
    }

    /**
     * Setup steps
     *
     * @return void
     */
    public function rsw_styles()
    {
        wp_enqueue_style('admin-style');
        wp_enqueue_script('admin-script');

        $plugins = apply_filters('rsw/bundled_plugins', []);
        $ajax_nonce = wp_create_nonce("rsw-activate-plugins");
        $ocdi_ajax_nonce = wp_create_nonce('ocdi-ajax-verification');
        $wp_customize_on = apply_filters('ocdi/enable_wp_customize_save_hooks', false);
        $success_image = RSW_ASSETS . '/img/success.svg';
        wp_localize_script('admin-script', 'rsw_data', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'plugins' => $plugins,
            'security' => $ajax_nonce,
            'ocdi_security' => $ocdi_ajax_nonce,
            'success_image' => $success_image,
            'wp_customize_on' => $wp_customize_on,
        ]);
    }

    /**
     * Setup steps
     *
     * @return void
     */
    public function rsw_steps()
    {
        $template = __DIR__ . '/views/steps.php';

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Setup wizard Content
     *
     * @return void
     */
    public function rsw_content()
    {
        echo '<div class="redq-setup-wizard-content md:col-span-8 xl:col-span-9 md:pl-5 3xl:col-span-10 md:row-start-1 md:row-end-2 5 pt-10 lg:pt-5">';
        call_user_func([$this, self::$steps[self::$step]['callback']]);
        echo '</div>';
    }

    /**
     * Setup wizard navigation
     *
     * @return void
     */
    public function rsw_navigation()
    {
        $template = __DIR__ . '/views/navigation.php';

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Steps dynamic class
     *
     * @param string $step_key
     * @return string
     */
    public function html_class($step_key)
    {
        if ($step_key === self::$step) {
            return 'active';
        }
        if (array_search(self::$step, array_keys(self::$steps)) > array_search($step_key, array_keys(self::$steps))) {
            return 'done';
        }
        return '';
    }

    /**
     * Steps sub text dynamic
     *
     * @param string $step_key
     * @return string
     */
    public function sub_text($step_key)
    {
        if ($step_key === self::$step) {
            return esc_html('In Progress', 'turbo');
        }
        if (array_search(self::$step, array_keys(self::$steps)) > array_search($step_key, array_keys(self::$steps))) {
            return esc_html('Completed', 'turbo');
        }
        return esc_html('Pending', 'turbo');
    }

    /**
     * loader
     *
     * @return void
     */
    public function loader()
    {
        echo '<span class="loader w-4 h-4 hidden rounded-full border-2 border-r-white border-l-white border-t-white border-b-transparent animate-spin ms-3"></span>';
    }

    /**
     * Steps dynamic class
     *
     * @param string $step_key
     * @return string
     */
    public function load_icons($step_key)
    {
        if ($step_key === self::$step) {
            return '<img src="' . RSW_ASSETS . '/img/in-progress.svg" alt="Alert!">';
        }
        if (array_search(self::$step, array_keys(self::$steps)) > array_search($step_key, array_keys(self::$steps))) {
            return '<img src="' . RSW_ASSETS . '/img/completed.svg" alt="Success!">';
        }
        return '<img src="' . RSW_ASSETS . '/img/pending.svg" alt="Error!">';
    }

    /**
     * Next step url
     *
     * @return string
     */
    public function next_step_link()
    {
        $purchase_code = get_option('rsw_purchase_code', '');
        $activation_status = get_option('rsw_activation_status', false);
        $keys = array_keys(self::$steps);
        $args = [
            'step' => esc_attr($keys[array_search(self::$step, array_keys(self::$steps)) + 1]),
        ];
        if ($purchase_code && $activation_status) {
            $args['next'] = true;
        }
        return add_query_arg($args, self::wizard_url());
    }

    /**
     * Previous step url
     *
     * @return string
     */
    public function prev_step_link()
    {
        $keys = array_keys(self::$steps);
        return add_query_arg('step', esc_attr($keys[array_search(self::$step, array_keys(self::$steps)) - 1]), self::wizard_url());
    }

    /**
     * Wizard page url
     *
     * @return string
     */
    public static function wizard_url()
    {
        return admin_url('admin.php?page=rsw-dashboard');
    }

    /**
     * Welcome content
     *
     * @return void
     */
    public function step_welcome()
    {
        $template = __DIR__ . '/views/welcome.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * theme_requirement function
     *
     * @return void
     */
    public function step_requirements()
    {
        $requirements = $this->get_requirement();

        $template = __DIR__ . '/views/requirements.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Activation content
     *
     * @return void
     */
    public function step_activation()
    {
        $purchase_code = get_option('rsw_purchase_code', '');
        $activation_status = get_option('rsw_activation_status', false);
        $masked_length = max(strlen($purchase_code) - 16, 0);
        $masked_code = substr($purchase_code, 0, 6) . str_repeat('*', $masked_length) . substr($purchase_code, -6);

        $template = __DIR__ . '/views/activation.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Child Theme content
     *
     * @return void
     */
    public function step_child_theme()
    {
        $template = __DIR__ . '/views/child-theme.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Plugins content
     *
     * @return void
     */
    public function step_plugins()
    {
        $plugins = apply_filters('rsw/bundled_plugins', []);
        $template = __DIR__ . '/views/plugins.php';
        if (file_exists($template)) {
            include $template;
        }
    }

      /**
     * Supported Plugins content
     *
     * @return void
     */
    // public function step_supported_plugins()
    // {
    //     $plugins = apply_filters('rsw/bundled_plugins', []);
    //     $template = __DIR__ . '/views/supported-plugins.php';
    //     if (file_exists($template)) {
    //         include $template;
    //     }
    // }


    /**
     * Dumy Content content
     *
     * @return void
     */
    public function step_demo_content()
    {
        if (class_exists('OCDI_Plugin')) {
            wp_enqueue_style('ocdi-main-css', OCDI_URL . 'assets/css/main.css', array(), OCDI_VERSION);
        }

        $template = __DIR__ . '/views/demo-content.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Done/ Final steps content
     *
     * @return void
     */
    public function step_done()
    {
        $template = __DIR__ . '/views/completed.php';
        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Update browsed steps
     *
     * @return void
     */
    public function update_browse_steps()
    {
        update_option('rsw_last_active', self::$step);
        if (!empty(self::$steps[self::$step]['required'])) {
            update_option('rsw_last_required', 1);
        } else {
            update_option('rsw_last_required', 0);
        }
    }
}
