<?php
$borobazar_theme          = wp_get_theme();
if ($borobazar_theme->parent_theme) {
    $borobazar_template_dir = basename(get_theme_file_path());
    $borobazar_theme        = wp_get_theme($borobazar_template_dir);
}
$borobazar_author = wp_get_theme()->get('Author');
$plugins          = TGM_Plugin_Activation::$instance->plugins;
$borobazar_installed_plugins      = get_plugins();
foreach ($plugins as $key => $plugin) {
    if (class_exists($plugin['plugin_class_name'])) {
        $check_variable[] = 'yes';
    } else {
        $check_variable[] = 'no';
    }
}
$allowed_tags = wp_kses_allowed_html('post');
?>

<div class="borobazar-theme-setup-main-wrapper">
    <div class="borobazar-getting-started-content borobazar-theme-setup-content-wrapper">

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

        <div class="borobazar-required-plugins-list" id="borobazar-scroll-to-plugins">
            <div class="borobazar-plugins-bulk-list">
                <h3><?php echo esc_html__('Required plugins list', 'borobazar'); ?></h3>
                <?php if (in_array('no', $check_variable)) : ?>
                    <p class="plugin-installation-notice">
                        <?php esc_html_e('For Bulk Installations,', 'borobazar') ?>
                        <a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>">
                            <?php echo esc_html__("click here", 'borobazar'); ?>
                        </a>
                    </p>
                <?php endif ?>
            </div>

            <div class="borobazar-plugins-activation-wrapper">
                <?php
                foreach ($plugins as $plugin) {
                    $plugin_status = '';
                    $file_path = $plugin['file_path'];
                    $developed_by = $plugin['developed_by'];
                    $required_true = $plugin['required'];
                    $plugin_action = $this->borobazar_plugin_link($plugin);
                ?>
                    <?php if (!empty($required_true) && $required_true === true) { ?>
                        <div class="borobazar-necessary-plugins-column">

                            <div class="borobazar-necessary-plugins">
                                <div class="borobazar-plugins-image">
                                    <?php if (isset($plugin['image_url']) && !empty($plugin['image_url'])) {  ?>
                                        <img src="<?php echo esc_url($plugin['image_url']); ?>" alt="<?php echo esc_attr($plugin['name']); ?>">
                                    <?php } ?>
                                </div>
                                <div class="borobazar-plugins-name-version">
                                    <div class="borobazar-plugin-importance-tag-list">
                                        <?php if (isset($plugin['required']) && $plugin['required'] && $plugin['required'] == true) : ?>
                                            <span class="borobazar-plugin-importance-tag required">
                                                <?php echo esc_html__('Required', 'borobazar'); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (isset($plugin['recommended']) && $plugin['recommended'] && $plugin['recommended'] == true) : ?>
                                            <span class="borobazar-plugin-importance-tag recommended">
                                                <?php echo esc_html__('Recommended', 'borobazar'); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (!empty($borobazar_installed_plugins[$plugin['file_path']]['Version']) &&  !empty($plugin['version'])) : ?>
                                            <?php if (version_compare($borobazar_installed_plugins[$plugin['file_path']]['Version'], $plugin['version'], '<')) : ?>
                                                <span class="borobazar-plugin-importance-tag update">
                                                    <?php echo esc_html__('Update Avaiable', 'borobazar'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>

                                    <span class="plugin-name"><?php echo wp_kses($plugin['name'], $allowed_tags) ?></span>

                                    <span class="plugin-install-btn">
                                        <?php foreach ($plugin_action as $action) {
                                            echo wp_kses($action, $allowed_tags);
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <!-- End of required plugin list -->


        <div class="borobazar-recommended-plugins-list">
            <div class="borobazar-plugins-bulk-list">
                <h3><?php echo esc_html__('Supported plugins list', 'borobazar'); ?></h3>
                <?php if (in_array('no', $check_variable)) : ?>
                    <p class="plugin-installation-notice">
                        <?php esc_html_e('For Bulk Installations,', 'borobazar') ?>
                        <a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>">
                            <?php echo esc_html__("click here", 'borobazar'); ?>
                        </a>
                    </p>
                <?php endif ?>
            </div>

            <div class="borobazar-plugins-activation-wrapper">
                <?php
                foreach ($plugins as $plugin) {
                    $plugin_status = '';
                    $file_path = $plugin['file_path'];
                    $developed_by = $plugin['developed_by'];
                    $required = $plugin['required'];
                    $plugin_action = $this->borobazar_plugin_link($plugin);
                ?>
                    <?php if ($required === false) { ?>
                        <div class="borobazar-necessary-plugins-column">

                            <div class="borobazar-necessary-plugins">
                                <div class="borobazar-plugins-image">
                                    <?php if (isset($plugin['image_url']) && !empty($plugin['image_url'])) {  ?>
                                        <img src="<?php echo esc_url($plugin['image_url']); ?>" alt="<?php echo esc_attr($plugin['name']); ?>">
                                    <?php } ?>
                                </div>
                                <div class="borobazar-plugins-name-version">
                                    <div class="borobazar-plugin-importance-tag-list">
                                        <?php if (isset($plugin['required']) && $plugin['required'] && $plugin['required'] == true) : ?>
                                            <span class="borobazar-plugin-importance-tag required">
                                                <?php echo esc_html__('Required', 'borobazar'); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (isset($plugin['recommended']) && $plugin['recommended'] && $plugin['recommended'] == true) : ?>
                                            <span class="borobazar-plugin-importance-tag recommended">
                                                <?php echo esc_html__('Recommended', 'borobazar'); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (!empty($borobazar_installed_plugins[$plugin['file_path']]['Version']) &&  !empty($plugin['version'])) : ?>
                                            <?php if (version_compare($borobazar_installed_plugins[$plugin['file_path']]['Version'], $plugin['version'], '<')) : ?>
                                                <span class="borobazar-plugin-importance-tag update">
                                                    <?php echo esc_html__('Update Avaiable', 'borobazar'); ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <span class="plugin-name"><?php echo wp_kses($plugin['name'], $allowed_tags) ?></span>

                                    <span class="plugin-install-btn">
                                        <?php foreach ($plugin_action as $action) {
                                            echo wp_kses($action, $allowed_tags);
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <!-- End of recommended plugin list -->
    </div>

    <!-- Pagintaion -->
    <div class="borobazar-theme-setup-pagination">
        <?php $demoImporterCheck = demo_importing_check(); ?>
        <?php if (class_exists('OCDI_Plugin') && $demoImporterCheck != false) { ?>
            <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-demos')); ?>" class='prev'>
                <span class="dashicons dashicons-arrow-left-alt"></span>
                <?php echo esc_html__('Previous Step', 'borobazar'); ?>
            </a>
        <?php } else { ?>
            <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-theme-setup-screen')); ?>" class='prev'>
                <span class="dashicons dashicons-arrow-left-alt"></span>
                <?php echo esc_html__('Previous Step', 'borobazar'); ?>
            </a>
        <?php } ?>


        <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-miscellaneous')); ?>" class='next'>
            <?php echo esc_html__('Next Step', 'borobazar'); ?>
            <span class="dashicons dashicons-arrow-right-alt"></span>
        </a>
    </div>
</div>