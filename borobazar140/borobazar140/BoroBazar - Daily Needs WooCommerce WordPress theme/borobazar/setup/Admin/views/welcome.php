<?php
$theme = $this->get_theme_info();
?>

<div class="redq-setup-wizard-welcome text-center">
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 pt-12 mt-12 border-t border-dashed border-t-[#e6e6e6]">
        <figure class="w-full">
            <img src="<?php echo RSW_ASSETS ?>/img/preview1.png" alt="preview_img">
        </figure>
        <div>
            <div class="border-b border-b-[#e6e6e6] self-start pb-4 text-start">
                <p class="text-sm font-normal text-[#575757] leading-7">
                    <?php echo $theme->get('Description'); ?>
                </p>
            </div>
            <p class="text-sm font-normal text-[#575757] leading-7 mt-4 text-start">
                <span class="text-base font-medium"><?php echo esc_html__('Tags', 'borobazar'); ?>:</span> <?php echo implode(', ', $theme->get('Tags')); ?>
            </p>
        </div>
    </div>
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