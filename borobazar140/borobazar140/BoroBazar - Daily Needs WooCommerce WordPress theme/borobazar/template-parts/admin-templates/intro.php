<?php
global $borobazarActivation;
$borobazar_theme = wp_get_theme();
if ($borobazar_theme->parent_theme) {
    $borobazar_template_dir = basename(get_theme_file_path());
    $borobazar_theme        = wp_get_theme($borobazar_template_dir);
}
$borobazar_author      = wp_get_theme()->get('Author');
$borobazar_description = wp_get_theme()->get('Description');
$allowed_tags          = wp_kses_allowed_html('post');
$plugins               = TGM_Plugin_Activation::$instance->plugins;
$structure             = get_option('permalink_structure');
$permalinkState        = false;
$permalinkStateText    = '';
$algoliaState          = false;
$algoliaSetupLink      = '';
$algoliaStateText      = '';

/**
 * Checking permalink
 */
if ($structure != '') {
    $permalinkState = true;
    $permalinkStateText = esc_html__('Done', 'borobazar');
} else {
    $permalinkState = false;
    $permalinkStateText = esc_html__('Configure from here', 'borobazar');
}

$allRequiredPluginCheck = theme_related_plugin_check();
$allServerRequiermentCheck = theme_server_requirment_check();
?>


<div class="borobazar-theme-setup-basic-wrapper">
    <div class="borobazar-theme-setup-step <?php echo esc_attr($allServerRequiermentCheck) ? 'is-done' : '' ?>">
        <div class="borobazar-theme-setup-step-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
            </svg>
        </div>
        <div class="borobazar-theme-setup-step-content">
            <h4><?php echo esc_html__('Server Configuration', 'borobazar') ?></h4>
            <p><?php echo esc_html__('Check your server configuration and take step', 'borobazar') ?></p>
        </div>
        <div class="borobazar-theme-setup-step-action">
            <?php if ($allServerRequiermentCheck != false) { ?>
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-active.svg')); ?>" alt="<?php esc_attr_e('Success!', 'borobazar') ?>">
            <?php } else { ?>
                <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-theme-setup-screen#borobazar-scroll-to-server-info')); ?>">
                    <?php echo esc_html__('Click here', 'borobazar'); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <!-- End of server configuration -->

    <div class="borobazar-theme-setup-step <?php echo esc_attr($permalinkState) ? 'is-done' : '' ?>">
        <div class="borobazar-theme-setup-step-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
        </div>
        <div class="borobazar-theme-setup-step-content">
            <h4><?php echo esc_html__('Permalink Setup', 'borobazar') ?></h4>
            <p><?php echo esc_html__('Make your site url seo friendly', 'borobazar') ?></p>
        </div>
        <div class="borobazar-theme-setup-step-action">
            <?php if ($permalinkState != false) { ?>
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-active.svg')); ?>" alt="<?php esc_attr_e('Success!', 'borobazar') ?>">
            <?php } else { ?>
                <a href="<?php echo esc_url(admin_url('options-permalink.php')); ?>">
                    <?php echo esc_html__('Click here', 'borobazar'); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <!-- End of permalink setup -->

    <div class="borobazar-theme-setup-step <?php echo esc_attr($allRequiredPluginCheck) ? 'is-done' : '' ?>">
        <div class="borobazar-theme-setup-step-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="borobazar-theme-setup-step-content">
            <h4><?php echo esc_html__('All Plugin Setup', 'borobazar') ?></h4>
            <p><?php echo esc_html__('Set up all plugins for better functionality', 'borobazar') ?></p>
        </div>
        <div class="borobazar-theme-setup-step-action">
            <?php if ($allRequiredPluginCheck != false) { ?>
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-active.svg')); ?>" alt="<?php esc_attr_e('Success!', 'borobazar') ?>">
            <?php } else { ?>
                <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-plugins#borobazar-scroll-to-plugins')); ?>">
                    <?php echo esc_html__('Click here', 'borobazar'); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <!-- End of all plugin setup -->
</div>