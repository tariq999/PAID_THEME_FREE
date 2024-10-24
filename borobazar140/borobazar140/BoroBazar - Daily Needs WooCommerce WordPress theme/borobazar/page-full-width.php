<?php

/**
 * Template Name: BoroBazar Full Width Template.
 *
 * @since 1.0.0
 */
get_header();

remove_action('borobazar_before_content', 'borobazar_banner', 10);
?>

<?php
/**
 * Functions hooked into borobazar_before_content action.
 *
 * @function borobazar_banner() - 5
 */
do_action('borobazar_before_content');
?>

<main id="site-wrapper" class="site-full-width-wrapper grow max-w-120 w-full mx-auto">
    <div id="primary" class="site-main">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
    <!-- end of .site-main -->
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
