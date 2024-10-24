<?php

/**
 * The template for displaying all single posts.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */
get_header();
?>

<?php
$sideBarClass        = '';
$displaySideBar      = 'on';
$sideBarPosition     = 'right';
$siteMainWithSidebar = 'w-full';

if (function_exists('borobazar_global_option_data')) {
    $displaySideBar  = borobazar_global_option_data('blog_single_sidebar_switch', 'on');
    $sideBarPosition = borobazar_global_option_data('blog_single_sidebar_position', 'right');
}



if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout())) {
    $sideBarName = 'borobazar-woo-sidebar';
} else {
    $sideBarName = 'borobazar-sidebar';
}

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

            get_template_part('template-parts/content/content', 'single');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </div>
    <!-- end of .site-main -->

    <?php
    if (is_active_sidebar('borobazar-sidebar') && (!empty($displaySideBar) && $displaySideBar === 'on')) {
        get_sidebar();
    }
    ?>
</main>
<!-- end of .site-wrapper -->

<?php
get_footer();
