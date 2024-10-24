<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>

<!doctype html>
<html class="h-full antialiased" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- need maximum-scale 1 to prevent ios input focus auto zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col min-h-full overflow-x-hidden'); ?>>
    <?php wp_body_open(); ?>

    <?php
    /*
        * Functions hooked into borobazar_before_header action
        *
        * @see template-hooks.php file
        * @see template-hooks-function.php file
        */
    do_action('borobazar_before_header');
    ?>

    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'borobazar'); ?></a>
    <!-- end of .skip-link -->

    <?php
    if (class_exists('WooCommerce') && (is_account_page() && !is_user_logged_in())) {
        // remove header only from WooCommerce login page
    } else { ?>

        <?php if (borobazar_get_header_layout() === 'berlin') { ?>
            <?php get_template_part('template-parts/header/berlin/topbar'); ?>
        <?php } ?>

        <header id="masthead" class="site-header header-<?php echo esc_attr(borobazar_get_header_layout()); ?> <?php echo esc_attr(borobazar_get_header_layout_classes()); ?>">
            <?php
            /**
             * Functions hooked into borobazar_header action.
             *
             * @see template-hooks.php file
             * @see template-hooks-function.php file
             */
            do_action('borobazar_header_' . borobazar_get_header_layout());
            ?>
        </header>
        <!-- End of header -->

        <?php
        /*
        * Functions hooked into borobazar_after_header action
        *
        * @see template-hooks.php file
        * @see template-hooks-function.php file
        */
        do_action('borobazar_after_header');
        ?>

    <?php } ?>