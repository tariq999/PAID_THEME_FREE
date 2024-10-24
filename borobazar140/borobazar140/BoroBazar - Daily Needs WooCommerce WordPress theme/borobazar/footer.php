<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>


<?php
/*
    * Functions hooked into borobazar_before_footer action
    *
    * @see template-hooks.php file
    * @see template-hooks-function.php file
    */
do_action('borobazar_before_footer');
?>

<?php
if (class_exists('WooCommerce') && (is_account_page() && !is_user_logged_in())) {
    // remove footer only from WooCommerce login page
} else { ?>

    <footer class="site-footer footer-<?php echo borobazar_get_footer_layout(); ?>">
        <div class="borobazar-footer-inner-wrapper w-full max-w-120 mx-auto px-4 sm:px-5 lg:px-8 2xl:px-10">
            <?php
            /**
             * Functions hooked into borobazar_footer action.
             *
             * @see template-hooks.php file
             * @see template-hooks-function.php file
             */
            do_action('borobazar_footer_' . borobazar_get_footer_layout());
            ?>

            <div class="site-copyright copyright-<?php echo borobazar_get_copyright_layout(); ?>">
                <?php
                /**
                 * Functions hooked into borobazar_copyright action.
                 *
                 * @see template-hooks.php file
                 * @see template-hooks-function.php file
                 */
                do_action('borobazar_copyright_' . borobazar_get_copyright_layout());
                ?>
            </div>
        </div>
    </footer>

<?php
    /*
    * Functions hooked into borobazar_after_footer action
    *
    * @see template-hooks.php file
    * @see template-hooks-function.php file
    */
    do_action('borobazar_after_footer');


    // Start Bottom Navigation
    $bottomNavigationDisplay = 'off';
    if (function_exists('borobazar_global_option_data')) {
        $bottomNavigationDisplay = borobazar_global_option_data('bottom_nav_switch', 'off');
    };

    if ($bottomNavigationDisplay !== 'off') {
        get_template_part('template-parts/footer/bottom', 'nav');
    }
    // End Bottom Navigation

} ?>

<?php wp_footer(); ?>

</body>

</html>