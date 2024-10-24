<?php
$pageBannerSwitch = $showBreadCrumb = 'on';
$bannerTitle         = get_the_title();
$allowedHTML         = wp_kses_allowed_html('post');
$pageBannerTextColor = '#000000';

if (function_exists('borobazar_global_option_data')) {
    $pageBannerSwitch    = borobazar_global_option_data('page_banner_switch', 'on');
    $showBreadCrumb      = borobazar_global_option_data('page_breadcrumb_switch', 'on');
    $pageBannerTextColor = borobazar_global_option_data('page_banner_text_color', '#000000');
}

?>

<?php if (!empty($pageBannerSwitch) && $pageBannerSwitch === 'on') : ?>
    <div class="borobazar-page-banner borobazar-site-page-banner">
        <div class="borobazar-page-banner-content" style="--banner-text-color: <?php echo esc_attr($pageBannerTextColor); ?>">
            <span class="borobazar-page-banner-subtitle"><?php echo esc_html__('explore ', 'borobazar'); ?></span>
            <h1><?php echo wp_kses($bannerTitle, $allowedHTML); ?></h1>
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