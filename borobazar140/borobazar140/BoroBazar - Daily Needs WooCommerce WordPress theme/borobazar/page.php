<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header();
?>

<?php
$sideBarName     = '';
$sideBarClass    = '';
$displaySideBar  = 'off';
$sideBarPosition = 'right';
$siteMainWithSidebar = 'w-full';

if (function_exists('borobazar_global_option_data')) {
    if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_product())) {
        $sideBarName     = 'borobazar-woo-sidebar';
        $displaySideBar  = borobazar_global_option_data('woo_sidebar_switch', 'off');
        $sideBarPosition = borobazar_global_option_data('woo_sidebar_position', 'right');
    } else {
        $sideBarName     = 'borobazar-sidebar';
        $displaySideBar  = borobazar_global_option_data('page_sidebar', 'off');
        $sideBarPosition = borobazar_global_option_data('page_sidebar_position', 'right');
    }
}

if (class_exists('WooCommerce') && (is_account_page() && !is_user_logged_in()) !== true) {
    if (is_active_sidebar($sideBarName)) {
        if (!empty($displaySideBar) && $displaySideBar === 'on') {
            if ($sideBarPosition === 'left') {
                $sideBarClass = 'site-wrapper-with-sidebar lg:flex-row-reverse';
                $siteMainWithSidebar = 'w-full lg:w-calc-full-88 lg:pl-10 2xl:pl-12 3xl:pl-14';
            } else {
                $sideBarClass = 'site-wrapper-with-sidebar lg:flex-row';
                $siteMainWithSidebar = 'w-full lg:w-calc-full-88 lg:pr-10 2xl:pr-12 3xl:pr-14';
            }
        }
    }
}

?>

<?php
/**
 * Functions hooked into borobazar_before_content action.
 *
 * @function borobazar_banner() - 5
 */
do_action('borobazar_before_content');
?>

<main id="site-wrapper" class="site-wrapper container flex flex-col items-start grow mx-auto py-8 md:py-10 xl:py-12 2xl:py-14 3xl:py-18 <?php echo esc_attr($sideBarClass); ?>">
    <div id="primary" class="site-main <?php echo esc_attr($siteMainWithSidebar); ?>">

        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content/content', 'page');
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </div>
    <!-- end of .site-main -->

    <?php
    if (class_exists('WooCommerce') && (is_account_page() && !is_user_logged_in()) !== true) {
        if (is_active_sidebar($sideBarName) && (!empty($displaySideBar) && $displaySideBar === 'on')) {
            get_sidebar();
        }
    }
    ?>
</main>
<!-- end of .site-wrapper -->
<?php
/**
 * Functions hooked into borobazar_after_content action.
 */
do_action('borobazar_after_content');
?>

<?php
get_footer();
