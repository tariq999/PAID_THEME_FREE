<?php

/**
 * The Template for displaying all single products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 *
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop');

// woocommerce content wrapper and breadcrumb remove
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
?>

<?php
$sideBarClass        = '';
$displaySideBar      = 'off';
$sideBarPosition     = 'right';
$siteMainWithSidebar = 'w-full';

if (function_exists('borobazar_global_option_data')) {
    $displaySideBar   = borobazar_global_option_data('woo_single_sidebar_switch', 'off');
    $sideBarPosition  = borobazar_global_option_data('woo_single_sidebar_position', 'right');
}

if (is_active_sidebar('borobazar-woo-sidebar')) {
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

?>

<main id="site-wrapper" class="site-wrapper flex flex-col items-start grow max-w-120 w-full mx-auto py-8 md:py-10 px-4 sm:px-5 lg:px-8 2xl:px-10 <?php echo esc_attr($sideBarClass); ?>">
    <div id="primary" class="site-main <?php echo esc_attr($siteMainWithSidebar); ?>">
        <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action('woocommerce_before_main_content');
        ?>

        <?php
        if (function_exists('borobazar_breadcrumb')) {
            borobazar_breadcrumb();
        }
        ?>
        <!-- end of breadcrumb -->

        <?php
        while (have_posts()) :
            the_post();
            do_action('borobazar_product_single_layouts');
        endwhile; // end of the loop.
        ?>

        <?php
        /**
         * woocommerce_after_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('woocommerce_after_main_content');
        ?>
    </div>
    <!-- end of .site-main -->

    <?php
    /*
    * Hook: woocommerce_sidebar.
    *
    * @hooked woocommerce_get_sidebar - 10
    */
    if (is_active_sidebar('borobazar-woo-sidebar') && (!empty($displaySideBar) && $displaySideBar === 'on')) {
        do_action('woocommerce_sidebar');
    }
    ?>
</main>
<!-- end of .site-wrapper -->

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */