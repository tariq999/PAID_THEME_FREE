<?php
$pageBannerSwitch = $showBreadCrumb = 'on';
$pageBannerTextColor = '#000000';

if (function_exists('borobazar_global_option_data')) {
    $pageBannerSwitch    = borobazar_global_option_data('woo_banner_switch', 'on');
    $showBreadCrumb      = borobazar_global_option_data('woo_page_breadcrumb_switch', 'on');
    $pageBannerTextColor = borobazar_global_option_data('woo_banner_text_color', '#000000');
}

?>

<!-- // remove shop banner only for WooCommerce login page -->
<?php if (class_exists('WooCommerce')) : ?>
    <?php if ((is_archive() || is_shop() || is_cart() || is_checkout() || (is_account_page() && is_user_logged_in()))) : ?>
        <?php if (!is_product()) : ?>
            <?php if (!empty($pageBannerSwitch) && $pageBannerSwitch === 'on') : ?>
                <div class="borobazar-page-banner borobazar-woo-page-banner">
                    <div class="borobazar-page-banner-content" style="--banner-text-color: <?php echo esc_attr($pageBannerTextColor); ?>">
                        <span class="borobazar-page-banner-subtitle">
                            <?php echo esc_html__('explore ', 'borobazar'); ?>
                        </span>
                        <?php if (is_shop() || is_archive()) { ?>
                            <h1>
                                <?php woocommerce_page_title(); ?>
                            </h1>
                        <?php } else { ?>
                            <?php the_title('<h1 class="entry-title break-words mt-0">', '</h1>'); ?>
                        <?php } ?>

                        <?php
                        if ($showBreadCrumb === 'on') {
                            if (function_exists('borobazar_breadcrumb')) {
                                borobazar_breadcrumb();
                            }
                        }
                        ?>
                    </div>
                    <!-- end of .borobazar-page-banner-content -->
                </div>
                <!-- end of .borobazar-page-banner -->
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>