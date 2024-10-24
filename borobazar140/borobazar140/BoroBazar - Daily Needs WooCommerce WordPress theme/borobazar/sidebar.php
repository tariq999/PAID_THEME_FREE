<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package borobazar
 */

if (class_exists('WooCommerce')) {
    if ((is_cart() || is_account_page() || is_checkout() || is_product())) {
        if (!is_active_sidebar('borobazar-woo-sidebar')) {
            return;
        }
    } elseif ((is_woocommerce()) || (is_shop() && !is_product())) {
        if (!is_active_sidebar('borobazar-woo-shop-sidebar')) {
            return;
        }
    } else {
        if (!is_active_sidebar('borobazar-sidebar')) {
            return;
        }
    }
} else {
    if (!is_active_sidebar('borobazar-sidebar')) {
        return;
    }
}
?>

<aside id="secondary" class="widget-area w-full lg:w-88 shrink-0 mt-12 lg:mt-0">
    <?php if (class_exists('WooCommerce')) { ?>
        <?php if ((is_cart() || is_account_page() || is_checkout() || is_product())) { ?>
            <?php if (is_active_sidebar('borobazar-woo-sidebar')) { ?>
                <?php dynamic_sidebar('borobazar-woo-sidebar'); ?>
            <?php } ?>
        <?php } elseif ((is_woocommerce()) || (is_shop() && !is_product())) { ?>
            <?php if (is_active_sidebar('borobazar-woo-shop-sidebar')) { ?>
                <?php dynamic_sidebar('borobazar-woo-shop-sidebar'); ?>
            <?php } ?>
        <?php } elseif ((!is_woocommerce())) { ?>
            <?php if (is_active_sidebar('borobazar-sidebar')) { ?>
                <?php dynamic_sidebar('borobazar-sidebar'); ?>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <?php if (is_active_sidebar('borobazar-sidebar')) { ?>
            <?php dynamic_sidebar('borobazar-sidebar'); ?>
        <?php } ?>
    <?php } ?>
</aside>
<!-- end of .widget-area -->