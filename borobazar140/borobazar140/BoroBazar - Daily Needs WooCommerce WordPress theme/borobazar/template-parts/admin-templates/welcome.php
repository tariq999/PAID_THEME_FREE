<?php
$borobazar_theme = wp_get_theme();
if ($borobazar_theme->parent_theme) {
    $borobazar_template_dir = basename(get_theme_file_path());
    $borobazar_theme = wp_get_theme($borobazar_template_dir);
}
$borobazar_author      = wp_get_theme()->get('Author');
$allowed_tags          = wp_kses_allowed_html('post');
$plugins               = TGM_Plugin_Activation::$instance->plugins;

/**
 * Checking Demo importer
 */
$OCDI_button_check = demo_importing_check();
$OCDI_button_class = 'disabled';

if ($OCDI_button_check != false) {
    $OCDI_button_class = 'enable';
}

?>

<div class="borobazar-theme-setup-main-wrapper">
    <div class="borobazar-theme-description borobazar-theme-setup-content-wrapper">
        <!-- LOGO -->
        <div class="borobazar-getting-started-logo-wrapper">
            <div class="borobazar-logo">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/main-logo.svg')); ?>" alt="<?php echo esc_attr($borobazar_theme->get('Name')); ?>">
                <sup>
                    <?php
                    echo esc_html__('v.', 'borobazar');
                    echo apply_filters('borobazar_version_getting_started', BOROBAZAR_VERSION);
                    ?>
                </sup>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="borobazar-getting-started-description-wrapper">
            <h1 class="borobazar-theme-setup-content-title"><?php esc_html_e('Congrats on the new store! 🎉', 'borobazar') ?></h1>
            <p class="description-text">
                <?php echo esc_html_e('Complete these simple steps to get your store up and running.', 'borobazar'); ?>
            </p>
        </div>

        <?php require_once get_theme_file_path('/template-parts/admin-templates/intro.php'); ?>

        <?php if ($OCDI_button_check != false) { ?>
            <div class="borobazar-theme-setup-import-demo-data" title='<?php echo esc_attr__('Please complete all the theme setup progress above.', 'borobazar'); ?>'>
                <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-demos')); ?>" class="<?php echo esc_attr($OCDI_button_class); ?>">
                    <?php echo esc_html__('Import Demo Data', 'borobazar'); ?>
                </a>
            </div>
        <?php } ?>
        <!-- Basic structure set up end -->

        <!-- Info Box -->
        <div class="borobazar-getting-started-column-wrapper">
            <div class="borobazar-plugins-bulk-list">
                <h3><?php echo esc_html__('Support & Documentation', 'borobazar'); ?></h3>
                <p class="plugin-installation-notice">
                    <?php esc_html_e('Check our documentation and get started', 'borobazar') ?>
                </p>
            </div>

            <div class="borobazar-getting-started-column">
                <a href="<?php echo esc_url('https://redqsupport.ticksy.com/'); ?>" class="borobazar-misc-info-block" target="_blank" rel="noopener noreferrer">
                    <div class="borobazar-misc-info-img-wrapper">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/headphone.svg')); ?>" alt="<?php esc_attr_e('Customer Support', 'borobazar') ?>">
                    </div>
                    <div class="borobazar-misc-info-content-wrapper">
                        <h3><?php esc_html_e('Customer Support', 'borobazar'); ?></h3>
                        <p><?php echo esc_html__('Please open a ticket in the support forum if got any bug or issues in our theme.', 'borobazar'); ?></p>
                    </div>
                </a>
            </div>
            <div class="borobazar-getting-started-column">
                <a href="<?php echo esc_url('https://borobazarwp-doc.vercel.app/'); ?>" class="borobazar-misc-info-block" target="_blank" rel="noopener noreferrer">
                    <div class="borobazar-misc-info-img-wrapper">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/document.svg')); ?>" alt="<?php esc_attr_e('Online Documentaion', 'borobazar') ?>">
                    </div>
                    <div class="borobazar-misc-info-content-wrapper">
                        <h3><?php esc_html_e('Online Documentaion', 'borobazar') ?></h3>
                        <p><?php esc_html_e('Please check the online documentation for better understanding.', 'borobazar') ?></p>
                    </div>
                </a>
            </div>

            <div class="borobazar-plugins-bulk-list">
                <p class="plugin-installation-notice">
                    <?php esc_html_e('Special note : Please complete the setup guide for better understanding of BoroBazar.', 'borobazar') ?>
                </p>
            </div>

        </div>
        <!-- /Info box -->
    </div>

    <!-- Pagintaion -->
    <div class="borobazar-theme-setup-pagination">
        <a href="#" class='prev disabled'>
            <span class="dashicons dashicons-arrow-left-alt"></span>
            <?php echo esc_html__('Previous Step', 'borobazar'); ?>
        </a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-theme-setup-screen')); ?>" class='next'>
            <?php echo esc_html__('Next Step', 'borobazar'); ?>
            <span class="dashicons dashicons-arrow-right-alt"></span>
        </a>
    </div>
</div>