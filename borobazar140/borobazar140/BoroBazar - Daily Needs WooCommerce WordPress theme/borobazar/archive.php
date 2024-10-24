<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package borobazar
 */

get_header();
?>

<?php
$displaySideBar = $pageBannerSwitch = 'on';
$sideBarClass        = '';
$sideBarPosition     = 'right';
$siteMainWithSidebar = 'w-full';

if (function_exists('borobazar_global_option_data')) {
    $displaySideBar   = borobazar_global_option_data('blog_sidebar_switch', 'on');
    $sideBarPosition  = borobazar_global_option_data('blog_sidebar_position', 'right');
    $pageBannerSwitch = borobazar_global_option_data('blog_banner_switch', 'on');
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
    <div id="primary" class="site-main space-y-10 md:space-y-12 2xl:space-y-16 <?php echo esc_attr($siteMainWithSidebar); ?>">

        <?php
        if (have_posts()) :

            if (!empty($pageBannerSwitch) && $pageBannerSwitch === 'off') :
        ?>
                <header class="page-header pb-3 border-b border-main">
                    <?php
                    the_archive_title('<h1 class="page-title mt-0 mb-2">', '</h1>');
                    the_archive_description('<div class="archive-description -mb-3">', '</div>');
                    ?>
                </header>
                <!-- end of .page-header -->
            <?php endif; ?>

        <?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();

                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */
                get_template_part('template-parts/content/content', get_post_type());

            endwhile;

            /* Start the post navigation */
            the_posts_navigation([
                'mid_size' => 2,
                'prev_text' => '
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.149817 5.00003C0.149817 5.17925 0.218247 5.35845 0.35482 5.49508L4.65464 9.79486C4.92816 10.0684 5.37163 10.0684 5.64504 9.79486C5.91845 9.52145 5.91845 9.07807 5.64504 8.80452L1.84032 5.00003L5.64491 1.19551C5.91832 0.921988 5.91832 0.478652 5.64491 0.205262C5.3715 -0.0683918 4.92803 -0.0683918 4.65451 0.205262L0.354687 4.50497C0.218092 4.64168 0.149817 4.82087 0.149817 5.00003Z" fill="#8C969F"/>
                </svg>' . esc_html__('Previous', 'borobazar'),
                'next_text' => esc_html__('Next', 'borobazar') . '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.85018 5.00003C5.85018 5.17925 5.78175 5.35845 5.64518 5.49508L1.34536 9.79486C1.07184 10.0684 0.628372 10.0684 0.354961 9.79486C0.0815496 9.52145 0.0815496 9.07807 0.354961 8.80452L4.15968 5.00003L0.355094 1.19551C0.0816825 0.921988 0.0816825 0.478652 0.355094 0.205262C0.628505 -0.0683918 1.07197 -0.0683918 1.34549 0.205262L5.64531 4.50497C5.78191 4.64168 5.85018 4.82087 5.85018 5.00003Z" fill="#8C969F"/>
                </svg>
                ',
            ]);
        else :

            get_template_part('template-parts/content', 'none');

        endif;
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
