<?php
$borobazar_theme          = wp_get_theme();
if ($borobazar_theme->parent_theme) {
    $borobazar_template_dir = basename(get_theme_file_path());
    $borobazar_theme        = wp_get_theme($borobazar_template_dir);
}
$allowed_tags = wp_kses_allowed_html('post');
$plugins = TGM_Plugin_Activation::$instance->plugins;
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

        <!-- faq wrapper -->
        <div class="borobazar-getting-started-faq-section">
            <div class="borobazar-plugins-bulk-list">
                <h3><?php echo esc_html__('F.A.Q', 'borobazar'); ?></h3>
                <p class="plugin-installation-notice">
                    <?php esc_html_e('Check our most frequently asked question', 'borobazar') ?>
                </p>
            </div>

            <div class="borobazar-getting-started-faq-wrapper">
                <div id="borobazar_getting_started_faq">
                    <!-- Accordion Item -->
                    <h3 class="borobazar-getting-started-faq-header">
                        <?php esc_html_e('How can I update the theme to a newer version?', 'borobazar') ?>
                        <span class="faq-header-icon">
                            <span class="faq-header-icon-expand">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-expand.svg')); ?>" alt="<?php esc_attr_e('Expand', 'borobazar') ?>">
                            </span>
                            <span class="faq-header-icon-collapse">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-collapse.svg')); ?>" alt="<?php esc_attr_e('Collapse', 'borobazar') ?>">
                            </span>
                        </span>
                    </h3>
                    <div class="borobazar-getting-started-faq-content">
                        <p><?php esc_html_e('To update the theme with a newer version, go to WP_Admin panel > Dashboard > Updates section. Then check for update. Also you can force check the update by clicking on "check again" link.', 'borobazar') ?></p>
                    </div>

                    <!-- Accordion Item -->
                    <h3 class="borobazar-getting-started-faq-header">
                        <?php esc_html_e('How can I import demo data after theme installation?', 'borobazar') ?>
                        <span class="faq-header-icon">
                            <span class="faq-header-icon-expand">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-expand.svg')); ?>" alt="<?php esc_attr_e('Expand', 'borobazar') ?>">
                            </span>
                            <span class="faq-header-icon-collapse">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-collapse.svg')); ?>" alt="<?php esc_attr_e('Collapse', 'borobazar') ?>">
                            </span>
                        </span>
                    </h3>
                    <div class="borobazar-getting-started-faq-content">
                        <p><?php esc_html_e('After installation the theme, please install all the required plugins first. After the installation and activation, setup all the necessary API keys, data in the recommeced plugins. For more help, when the all the theme installation progress done GREEN, then you can import demo content from the demo installation window.', 'borobazar') ?></p>
                    </div>

                    <!-- Accordion Item -->
                    <h3 class="borobazar-getting-started-faq-header">
                        <?php esc_html_e('How can I make any custom changes any the theme?', 'borobazar') ?>
                        <span class="faq-header-icon">
                            <span class="faq-header-icon-expand">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-expand.svg')); ?>" alt="<?php esc_attr_e('Expand', 'borobazar') ?>">
                            </span>
                            <span class="faq-header-icon-collapse">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-collapse.svg')); ?>" alt="<?php esc_attr_e('Collapse', 'borobazar') ?>">
                            </span>
                        </span>
                    </h3>
                    <div class="borobazar-getting-started-faq-content">
                        <p><?php esc_html_e('It is always preferable not to do any custom changes inside the theme directly. It is always wise to work on the child theme of the current installed theme.', 'borobazar') ?></p>
                    </div>

                    <!-- Accordion Item -->
                    <h3 class="borobazar-getting-started-faq-header">
                        <?php esc_html_e('Do I need to use Gutenberg plugin or the default Gutenberg facilities provided by the WordPress is enough?', 'borobazar') ?>
                        <span class="faq-header-icon">
                            <span class="faq-header-icon-expand">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-expand.svg')); ?>" alt="<?php esc_attr_e('Expand', 'borobazar') ?>">
                            </span>
                            <span class="faq-header-icon-collapse">
                                <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/accordion-collapse.svg')); ?>" alt="<?php esc_attr_e('Collapse', 'borobazar') ?>">
                            </span>
                        </span>
                    </h3>
                    <div class="borobazar-getting-started-faq-content">
                        <p><?php esc_html_e('There is no conflict whether to use default Gutenberg facilities or the Gutenberg plugin.', 'borobazar') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /faq wrapper -->
    </div>

    <!-- Pagintaion -->
    <div class="borobazar-theme-setup-pagination">
        <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-plugins')); ?>" class='prev'>
            <span class="dashicons dashicons-arrow-left-alt"></span>
            <?php echo esc_html__('Previous Step', 'borobazar'); ?>
        </a>
        <a href="#" class='next disabled'>
            <?php echo esc_html__('Next Step', 'borobazar'); ?>
            <span class="dashicons dashicons-arrow-right-alt"></span>
        </a>
    </div>
</div>