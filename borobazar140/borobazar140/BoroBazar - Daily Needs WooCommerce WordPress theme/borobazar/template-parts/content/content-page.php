<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package borobazar
 */

$pageBannerSwitch = 'on';

if (function_exists('borobazar_global_option_data')) {
    if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_product())) {
        $pageBannerSwitch = borobazar_global_option_data('woo_banner_switch', 'on');
    } else {
        $pageBannerSwitch    = borobazar_global_option_data('page_banner_switch', 'on');
    }
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    if (!empty($pageBannerSwitch) && $pageBannerSwitch !== 'on') {
    ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title break-words mt-0">', '</h1>'); ?>
        </header>
        <!-- end of .entry-header -->
    <?php } ?>

    <?php borobazar_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'borobazar'),
                'after'  => '</div>',
            )
        );
        ?>
    </div>
    <!-- end of .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'borobazar'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer>
        <!-- end of .entry-footer -->
    <?php endif; ?>
</article>
<!-- #post-<?php the_ID(); ?> -->