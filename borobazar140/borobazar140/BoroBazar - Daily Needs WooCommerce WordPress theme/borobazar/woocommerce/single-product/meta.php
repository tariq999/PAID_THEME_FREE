<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;
$allowedHTML = wp_kses_allowed_html('post');
?>
<div class="product_meta">

    <?php do_action('woocommerce_product_meta_start'); ?>

    <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
        <div class="sku_wrapper flex items-start">
            <?php esc_html_e('SKU:', 'borobazar'); ?>
            <span class="sku">
                <?php $sku = $product->get_sku(); ?>
                <?php
                if (!empty($sku)) {
                    echo wp_kses($sku, $allowedHTML);
                } else {
                    echo esc_html__('N/A', 'borobazar');
                }
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- category meta area -->
    <?php if (count($product->get_category_ids()) > 0) { ?>
        <div class="posted_in flex items-start">
            <div class="title">
                <?php
                $cat_count = count($product->get_category_ids());
                if (1 === $cat_count) {
                    printf(esc_html__('Category:', 'borobazar'), $cat_count);
                } else {
                    printf(
                        esc_html(
                            _n('Category:', 'Categories:', $cat_count, 'borobazar')
                        ),
                        $cat_count
                    );
                }
                ?>
            </div>
            <div class="category-list">
                <?php borobazar_get_woo_terms($product->get_id(), 'product_cat'); ?>
            </div>
        </div>
    <?php } ?>

    <!-- Tags meta area -->
    <?php if (count($product->get_tag_ids()) > 0) { ?>
        <div class="tagged_as flex items-start">
            <div class="title">
                <?php
                $tag_count = count($product->get_tag_ids());
                if (1 === $tag_count) {
                    printf(esc_html__('Tag:', 'borobazar'), $tag_count);
                } else {
                    printf(
                        esc_html(
                            _n('Tag:', 'Tags:', $tag_count, 'borobazar')
                        ),
                        $tag_count
                    );
                }
                ?>
            </div>
            <div class="tags-list">
                <?php borobazar_get_woo_terms($product->get_id(), 'product_tag'); ?>
            </div>
        </div>
    <?php } ?>

    <?php do_action('woocommerce_product_meta_end'); ?>

</div>