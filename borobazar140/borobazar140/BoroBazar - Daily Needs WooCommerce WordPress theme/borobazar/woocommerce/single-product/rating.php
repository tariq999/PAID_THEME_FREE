<?php

/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
    return;
}
$allowed_html = wp_kses_allowed_html('post');
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ($rating_count > 0) : ?>

    <div class="woocommerce-product-rating">
        <div class="inline-flex items-center">
            <?php echo wc_get_rating_html($average, $rating_count); // WPCS: XSS ok. 
            ?>
            <b><?php echo apply_filters('borobazar_woo_single_average_rating', $average) ?></b>
        </div>
        <?php if (comments_open()) : ?>
            <?php //phpcs:disable 
            ?>
            <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( /* translators: 1: review, 2: review plural. */_n('%s review', '%s reviews', $review_count, 'borobazar'), '<span class="count">' . wp_kses($review_count, $allowed_html) . '</span>'); ?>)</a>
            <?php // phpcs:enable 
            ?>
        <?php endif ?>
    </div>

<?php endif; ?>