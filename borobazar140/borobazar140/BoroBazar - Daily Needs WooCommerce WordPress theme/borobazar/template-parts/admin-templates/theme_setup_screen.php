<?php
global $wpdb, $wp_version;
$borobazar_theme = wp_get_theme();
if ($borobazar_theme->parent_theme) {
    $borobazar_template_dir = basename(get_theme_file_path());
    $borobazar_theme = wp_get_theme($borobazar_template_dir);
}

$borobazar_author = wp_get_theme()->get('Author');
$allowed_tags     = wp_kses_allowed_html('post');
$plugins          = TGM_Plugin_Activation::$instance->plugins;

$WP_VERSION              = '5.0.0';
$WP_MEMORY_LIMIT         = '256M';
$PHP_VERSION             = '7.0.0';
$PHP_MAX_INPUT_VARIABLES = '3000';
$PHP_MAX_EXECUTION_TIME  = '30';
$PHP_MAX_POST_SIZE       = '8M';
$MAX_UPLOAD_SIZE         = '16 MB';
$DB_SCHEMA               = '';
$MYSQL_VERSION           = '5.6';
$MARIA_DB_VERSION        = '10.1';

$serverVersion = $wpdb->get_var('SELECT VERSION()');
if (strpos($serverVersion, 'MariaDB') !== false) {
    $DB_SCHEMA = 'mariaDB';
} else {
    $DB_SCHEMA = 'mysql';
}

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

        <!-- server info section start -->
        <div class="borobazar-theme-plugins-status-wrapper" id="borobazar-scroll-to-server-info">
            <div class="borobazar-plugins-bulk-list">
                <h3><?php esc_html_e('Site Configuration', 'borobazar') ?></h3>
                <p class="plugin-installation-notice">
                    <?php esc_html_e('Mandatory site configuration', 'borobazar') ?>
                </p>
            </div>
            <div class="borobazar-theme-plugins-status-table">
                <div class="plugin-status-table-head">
                    <div class="plugin-status-table-column name-column">
                        <?php esc_html_e('Config name', 'borobazar'); ?>
                    </div>
                    <div class="plugin-status-table-column status-column">
                        <?php esc_html_e('Required status', 'borobazar'); ?>
                    </div>
                    <div class="plugin-status-table-column status-column">
                        <?php esc_html_e('Current status', 'borobazar'); ?>
                    </div>
                </div>
                <div class="plugin-status-table-body">

                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('WordPress version', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($WP_VERSION, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if ($wp_version >= $WP_VERSION) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses($wp_version, $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses($wp_version, $allowed_tags); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('WordPress Memory Limit', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($WP_MEMORY_LIMIT, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if ((int) filter_var(WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($WP_MEMORY_LIMIT, FILTER_SANITIZE_NUMBER_INT)) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses(WP_MEMORY_LIMIT, $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses(WP_MEMORY_LIMIT, $allowed_tags); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('PHP version', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php
                            esc_html_e('>= ', 'borobazar');
                            echo wp_kses($PHP_VERSION, $allowed_tags);
                            ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if (phpversion() >= $PHP_VERSION) : ?>
                                <span class="requirement-success">
                                    <?php echo phpversion(); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo phpversion(); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('PHP max input variables', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($PHP_MAX_INPUT_VARIABLES, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if (ini_get('max_input_vars') >= $PHP_MAX_INPUT_VARIABLES) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses(ini_get('max_input_vars'), $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses(ini_get('max_input_vars'), $allowed_tags); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('PHP maximum execution time', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($PHP_MAX_EXECUTION_TIME, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if (ini_get('max_execution_time') >= $PHP_MAX_EXECUTION_TIME) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses(ini_get('max_execution_time'), $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses(ini_get('max_execution_time'), $allowed_tags); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('PHP post maximum size', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($PHP_MAX_POST_SIZE, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if (ini_get('post_max_size') >= (int) filter_var($PHP_MAX_POST_SIZE, FILTER_SANITIZE_NUMBER_INT)) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses(ini_get('post_max_size'), $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses(ini_get('post_max_size'), $allowed_tags); ?>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>


                    <div class="plugin-status-table-row">
                        <div class="plugin-status-table-column name-column">
                            <?php esc_html_e('Maximum Upload Size', 'borobazar'); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php echo wp_kses($MAX_UPLOAD_SIZE, $allowed_tags); ?>
                        </div>
                        <div class="plugin-status-table-column status-column">
                            <?php if ((int) filter_var(size_format(wp_max_upload_size()), FILTER_SANITIZE_NUMBER_INT) >= (int) filter_var($MAX_UPLOAD_SIZE, FILTER_SANITIZE_NUMBER_INT)) : ?>
                                <span class="requirement-success">
                                    <?php echo wp_kses(size_format(wp_max_upload_size()), $allowed_tags); ?>
                                </span>
                            <?php else : ?>
                                <span class="requirement-error">
                                    <?php echo wp_kses(size_format(wp_max_upload_size()), $allowed_tags); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <?php if ($DB_SCHEMA === 'mysql') { ?>
                        <div class="plugin-status-table-row">
                            <div class="plugin-status-table-column name-column">
                                <?php esc_html_e('MySQL version', 'borobazar'); ?>
                            </div>
                            <div class="plugin-status-table-column status-column">
                                <?php
                                esc_html_e('>= ', 'borobazar');
                                echo wp_kses($MYSQL_VERSION, $allowed_tags);
                                ?>
                            </div>
                            <div class="plugin-status-table-column status-column">
                                <?php if ($wpdb->db_version() >= $MYSQL_VERSION) : ?>
                                    <span class="requirement-success">
                                        <?php echo wp_kses($wpdb->db_version(), $allowed_tags); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="requirement-error">
                                        <?php echo wp_kses($wpdb->db_version(), $allowed_tags); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="plugin-status-table-row">
                            <div class="plugin-status-table-column name-column">
                                <?php esc_html_e('MariaDB version', 'borobazar'); ?>
                            </div>
                            <div class="plugin-status-table-column status-column">
                                <?php
                                esc_html_e('>= ', 'borobazar');
                                echo wp_kses($MARIA_DB_VERSION, $allowed_tags);
                                ?>
                            </div>
                            <div class="plugin-status-table-column status-column">
                                <?php if ($wpdb->db_version() >= $MARIA_DB_VERSION) : ?>
                                    <span class="requirement-success">
                                        <?php echo wp_kses($wpdb->db_version(), $allowed_tags); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="requirement-error">
                                        <?php echo wp_kses($wpdb->db_version(), $allowed_tags); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
        <!-- server info section end -->


        <!-- plugin info section start -->
        <?php if (!empty($plugins)) { ?>
            <div class="borobazar-theme-plugins-status-wrapper">

                <div class="borobazar-plugins-bulk-list is-status">
                    <h3><?php esc_html_e('Plugin Status', 'borobazar') ?></h3>
                    <p>
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-active.svg')); ?>" alt="active">
                        <?php esc_html_e('means active plugin.', 'borobazar') ?>
                    </p>
                    <p>
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-alert.svg')); ?>" alt="alert">
                        <?php esc_html_e('means installed but deactivated plugin.', 'borobazar') ?>
                    </p>
                    <p>
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-error.svg')); ?>" alt="error">
                        <?php esc_html_e('means not installed plugin.', 'borobazar') ?>
                    </p>
                </div>

                <div class="borobazar-theme-plugins-status-table">
                    <div class="plugin-status-table-head">
                        <div class="plugin-status-table-column name-column"><?php esc_html_e('Plugin name', 'borobazar'); ?></div>
                        <div class="plugin-status-table-column status-column"><?php esc_html_e('Plugin status', 'borobazar'); ?></div>
                    </div>
                    <div class="plugin-status-table-body">
                        <?php
                        foreach ($plugins as $key => $plugin) {
                            $plugin_action = $this->borobazar_plugin_link($plugin);
                            $plugin_status = array_keys($plugin_action)[0];
                            if (class_exists($plugin['plugin_class_name'])) {
                                $check_variable[] = 'yes';
                            } else {
                                $check_variable[] = 'no';
                            }
                        ?>
                            <div class="plugin-status-table-row">
                                <div class="plugin-status-table-column name-column">
                                    <?php echo wp_kses($plugin['name'], $allowed_tags) ?>
                                </div>
                                <div class="plugin-status-table-column status-column">
                                    <?php if ($plugin_status === 'install') { ?>
                                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-error.svg')); ?>" alt="<?php echo esc_attr($plugin['name']) ?>">
                                    <?php } elseif ($plugin_status === 'deactivate') { ?>
                                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-active.svg')); ?>" alt="<?php echo esc_attr($plugin['name']) ?>">
                                    <?php } elseif ($plugin_status === 'update') { ?>
                                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-alert.svg')); ?>" alt="<?php echo esc_attr($plugin['name']) ?>">
                                    <?php } else { ?>
                                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/plugin-alert.svg')); ?>" alt="<?php echo esc_attr($plugin['name']) ?>">
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="plugin-status-table-footer">
                        <div class="plugin-status-table-row">
                            <div class="plugin-status-table-column name-column"><?php esc_html_e('For more information', 'borobazar') ?></div>
                            <div class="plugin-status-table-column status-column">
                                <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-plugins')); ?>"><?php esc_html_e('Click Here', 'borobazar') ?></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
        <!-- plugin info section end -->
    </div>

    <!-- Pagintaion -->
    <div class="borobazar-theme-setup-pagination">
        <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar')); ?>" class='prev'>
            <span class="dashicons dashicons-arrow-left-alt"></span>
            <?php echo esc_html__('Previous Step', 'borobazar'); ?>
        </a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=borobazar-plugins')); ?>" class='next'>
            <?php echo esc_html__('Next Step', 'borobazar'); ?>
            <span class="dashicons dashicons-arrow-right-alt"></span>
        </a>
    </div>
</div>