<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 *
 * @version 3.4.0
 */
defined('ABSPATH') || exit;

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
$pageBannerSwitch    = 'on';

if (function_exists('borobazar_global_option_data')) {
    $displaySideBar   = borobazar_global_option_data('woo_shop_sidebar_switch', 'off');
    $sideBarPosition  = borobazar_global_option_data('woo_sidebar_position', 'right');
    $pageBannerSwitch = borobazar_global_option_data('woo_banner_switch', 'on');
}


if (is_active_sidebar('borobazar-woo-shop-sidebar')) {
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


<?php
/**
 * Functions hooked into borobazar_before_content action.
 *
 * @function borobazar_banner() - 5
 */
do_action('borobazar_before_content');
?>

<main id="site-wrapper" class="site-wrapper flex flex-col items-start grow max-w-120 w-full mx-auto py-8 md:py-10 xl:py-12 2xl:py-14 3xl:py-18 px-4 sm:px-5 lg:px-8 2xl:px-10 <?php echo esc_attr($sideBarClass); ?>">
    <div id="primary" class="site-main <?php echo esc_attr($siteMainWithSidebar); ?>">
        <?php
        /*
        * Hook: woocommerce_before_main_content.
        *
        * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
        * @hooked woocommerce_breadcrumb - 20
        * @hooked WC_Structured_Data::generate_website_data() - 30
        */
        do_action('woocommerce_before_main_content');
        ?>

        <header class="woocommerce-products-header">
            <?php if (!empty($pageBannerSwitch) && $pageBannerSwitch !== 'on') : ?>
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action('woocommerce_archive_description');
            ?>
        </header>

        <?php
        // WooCommerce Product loop area start

        if (woocommerce_product_loop()) {
            /*
            * Hook: woocommerce_before_shop_loop.
            *
            * @hooked woocommerce_output_all_notices - 10
            * @hooked woocommerce_result_count - 20
            * @hooked woocommerce_catalog_ordering - 30
            */
            do_action('woocommerce_before_shop_loop');

            woocommerce_product_loop_start();
            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /*
                    * Hook: woocommerce_shop_loop.
                    */
                    do_action('woocommerce_shop_loop');

                    /*
                    * Hook: borobazar_grid_layouts.
                    */
                    do_action('borobazar_grid_layouts');
                }
            }
            woocommerce_product_loop_end();

            /*
            * Hook: woocommerce_after_shop_loop.
            *
            * @hooked woocommerce_pagination - 10
            */
            do_action('woocommerce_after_shop_loop');
        } else {
            /*
            * Hook: woocommerce_no_products_found.
            *
            * @hooked wc_no_products_found - 10
            */
            do_action('woocommerce_no_products_found');
        }
        /*
        * Hook: woocommerce_after_main_content.
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
    if (is_active_sidebar('borobazar-woo-shop-sidebar') && (!empty($displaySideBar) && $displaySideBar === 'on')) {
        do_action('woocommerce_sidebar');
    }
    ?>
</main>
<!-- end of .site-wrapper -->

<?php
get_footer('shop');
