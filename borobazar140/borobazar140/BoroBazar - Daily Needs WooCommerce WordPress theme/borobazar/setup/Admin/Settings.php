<?php

namespace Turbo\Setup\Admin;

/**
 * Handle settings
 */
class Settings
{

    /**
     * Constructor
     */
    function __construct()
    {
        add_action('admin_init', [$this, 'redirect']);
    }

    /**
     * Redirect
     *
     * @return void
     */
    public function redirect()
    {
        SetupWizard::check_if_required_tab_not_browse();
    }

    /**
     * Dashboard Page | Setup Wizard
     *
     * @return void
     */
    public function dashboard_page()
    {
        new SetupWizard();
    }

    /**
     * Report handler
     *
     * @return void
     */
    public function report_page()
    {
        $template = __DIR__ . '/views/report.php';

        if (file_exists($template)) {
            include $template;
        }
    }
}
