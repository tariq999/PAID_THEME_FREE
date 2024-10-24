<?php
$allowedHTML = wp_kses_allowed_html('post');
$displayFooterWidgets = 'on';
$customFooterLayout = '';

if (function_exists('borobazar_global_option_data')) {
    $displayFooterWidgets = borobazar_global_option_data('footer_widget_switch', 'on');
    $customFooterLayout   = borobazar_global_option_data('custom_footer_layout', '');
}

if (!empty($customFooterLayout) && $customFooterLayout !== '#') {
    $args = array(
        'post_type'     => array('footer'),
        'post_status'   => array('publish'),
        'p'             => $customFooterLayout
    );
    $footerWidgets = new WP_Query($args);
}
?>

<?php if (class_exists('Kirki') && class_exists('BoroBazarHelper')) { ?>
    <?php if ($displayFooterWidgets !== 'off') { ?>
        <div class="borobazar-footer-area">
            <?php
            if (isset($footerWidgets) && $footerWidgets->have_posts()) {
                // The Loop
                while ($footerWidgets->have_posts()) {
                    $footerWidgets->the_post();
            ?>
                    <div class="borobazar-site-footer-content">
                        <?php the_content(); ?>
                    </div>
            <?php
                    // End Loop
                }
            } ?>
        </div>
    <?php } ?>
<?php } ?>
<!-- end of .borobazar-footer-area -->

<?php
// Restore original Post Data
wp_reset_postdata();
?>