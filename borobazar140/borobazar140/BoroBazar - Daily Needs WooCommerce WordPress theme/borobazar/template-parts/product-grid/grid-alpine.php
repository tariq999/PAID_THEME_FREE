<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

$showQuickView = 'off';
if (function_exists('borobazar_global_option_data')) {
    $showQuickView = borobazar_global_option_data('woo_preview_pop_switch', 'on');
}
$allowedHTML = wp_kses_allowed_html('post');
?>

<div <?php wc_product_class('borobazar-grid-alpine', $product);?>>

    <?php
$cartItems = $splicedGalleryIDs = [];
$width = $height = '';

if (function_exists('borobazar_check_product_in_cart_by_ID')) {
    $qty = borobazar_check_product_in_cart_by_ID($product->get_id());
} else {
    $qty = false;
}

$display = $qty ? "flex" : "hidden";
$cartButton = $qty ? 'hidden' : 'flex';
$stock_qty = $product->get_manage_stock() ? $product->get_stock_quantity() : -1;
$unit = get_post_meta($product->get_id(), '_borobazar_woocommerce_product_unit', true);
$label = get_post_meta($product->get_id(), '_borobazar_woocommerce_product_unit_label', true);

// image control area
$imageSize = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
$thumbnail = get_the_post_thumbnail_url($product->get_id(), $imageSize);
$imageRatio = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), $imageSize);
$width = !empty($imageRatio) ? $imageRatio[1] : 300;
$height = !empty($imageRatio) ? $imageRatio[2] : 300;
$galleryImageIDs = $product ? $product->get_gallery_image_ids() : [];

$isInStock = $product->is_in_stock();
$isOnSale = $product->is_on_sale();
$productTitle = $product->get_title();
$productType = get_the_terms($product->get_id(), 'product_type') ? current(get_the_terms($product->get_id(), 'product_type'))->slug : '';
$link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
if ($productType === 'simple') {
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    $price_diff = (float) $regular_price - (float) $sale_price;
    $price_discount = round(($price_diff / $regular_price) * 100);
}

if (function_exists('borobazar_check_product_in_cart')) {
    $cartItems = borobazar_check_product_in_cart();
}

if (!empty($galleryImageIDs) && isset($galleryImageIDs)) {
    $splicedGalleryIDs = array_slice($galleryImageIDs, 0, 1);
}
$placeholderImage = get_theme_file_uri('/assets/client/images/placeholder-icon.svg');
?>

    <?php
/**
 * Hook: woocommerce_before_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
do_action('woocommerce_before_shop_loop_item');
?>

    <?php
/**
 * Hook: woocommerce_before_shop_loop_item_title.
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */
do_action('woocommerce_before_shop_loop_item_title');
?>

    <?php
/**
 * Hook: woocommerce_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_product_title - 10
 */
do_action('woocommerce_shop_loop_item_title');
?>

    <div class="borobazar-alpine-product-card borobazar-product-<?php echo esc_attr($product->get_id()); ?> shadow-product rounded bg-white overflow-hidden transition-all hover:shadow-product-hover h-full">
        <div class="borobazar-alpine-product-card-thumb relative h-40 sm:h-48 overflow-hidden">
            <a class="borobazar-image-fade-in" href="<?php echo esc_url($link); ?>" aria-label="<?php echo esc_attr($productTitle); ?>">
                <img loading="lazy" class="opacity-0 transition-opacity duration-200" src="<?php echo esc_url($thumbnail); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" alt="<?php echo esc_attr($productTitle); ?>">
                <?php if (!empty($splicedGalleryIDs) && isset($splicedGalleryIDs)) {?>
                    <?php foreach ($splicedGalleryIDs as $key => $galleryImageID) {?>
                        <?php
$sliderImageURL = wp_get_attachment_image_url($galleryImageID, $imageSize) ? wp_get_attachment_image_url($galleryImageID, $imageSize) : $placeholderImage;
    $sliderImageSrcset = wp_get_attachment_image_srcset($galleryImageID, $imageSize);
    $sliderImageSizes = wp_get_attachment_image_sizes($galleryImageID, $imageSize);
    ?>
                        <img loading="lazy" class="thumb-1 opacity-0 transition-opacity duration-200" src="<?php echo esc_url($sliderImageURL); ?>" srcset="<?php echo esc_attr($sliderImageSrcset) ?>" sizes="<?php echo esc_attr($sliderImageSizes); ?>" alt="product-grid-gallery-item <?php echo esc_attr($productTitle); ?>">
                    <?php }?>
                <?php }?>

                <?php if (!$isInStock) {?>
                    <span class="product-badge text-xs text-white font-bold bg-error rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php echo esc_html__('Out Of Stock', 'borobazar'); ?>
                    </span>
                <?php }?>

                <?php if ($isInStock && $isOnSale && $productType === 'simple') {?>
                    <span class="product-badge text-xs text-white font-bold bg-brand rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php
                          echo sprintf(
                            /* translators: %s: Discount.*/
                            __('Save %s %%','borobazar'),$price_discount
                        ); //text for on sale badge 
                         ?>
                    </span>
                <?php }?>
                <?php if ($isInStock && $isOnSale && $productType === 'variable') {?>
                    <span class="product-badge text-xs text-white font-bold bg-brand rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php echo esc_html__('On Sale', 'borobazar'); ?>
                    </span>
                <?php }?>

                <?php if ($product->backorders_allowed()) {?>
                    <span class="product-badge text-xs text-white font-bold bg-brand rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php echo esc_html__('Pre Order', 'borobazar'); ?>
                    </span>
                <?php }?>

            </a>

            <?php if ($isInStock) {?>
                <?php if ($productType === 'simple') {?>

                    <?php
if (class_exists('BoroBazarHelper')) {
    $product_link = '#';
} else {
    $product_link = $link;
}
    ?>
                    <!-- Add to cart button -->
                    <a href="<?php echo esc_url($product_link); ?>" class="<?php echo esc_attr($cartButton); ?> add-to-cart absolute items-center justify-center w-9 h-9 rounded-full bottom-3 right-3.5 bg-brand z-1 text-white no-underline transition-all hover:text-white hover:bg-brand-hover focus:text-white product_type_simple  borobazar-update-qty borobazar-add-to-cart-<?php echo esc_attr($product->get_id()); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('Add to Cart', 'borobazar'); ?>">
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.2 7.2H8.80005V0.799951C8.80005 0.358447 8.4416 0 7.99995 0C7.55845 0 7.2 0.358447 7.2 0.799951V7.2H0.799951C0.358447 7.2 0 7.55845 0 7.99995C0 8.4416 0.358447 8.80005 0.799951 8.80005H7.2V15.2C7.2 15.6416 7.55845 16 7.99995 16C8.4416 16 8.80005 15.6416 8.80005 15.2V8.80005H15.2C15.6416 8.80005 16 8.4416 16 7.99995C16 7.55845 15.6416 7.2 15.2 7.2Z" fill="currentColor" stroke="white" stroke-width="0.5" />
                        </svg>
                    </a>
                    <!-- End -->

                    <!-- Counter -->
                    <div class="<?php echo esc_attr($display); ?> justify-between p-0.75 absolute left-1/2 bottom-3 -translate-x-1/2 w-32 sm:w-36 4xl:w-40 h-9 sm:h-9.5 bg-white rounded-3xl z-1 shadow-counter borobazar-qty-button borobazar-qty-button-<?php echo esc_attr($product->get_id()); ?>">

                        <span class="flex items-center justify-center w-11 sm:w-12 text-lightest cursor-pointer rounded-3xl transition-all hover:bg-base decrement borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="minus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Decrement', 'borobazar'); ?>">
                            <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.80005 1.20001H15.2C15.6416 1.20001 16 1.55846 16 1.99996C16 2.44161 15.6416 2.80006 15.2 2.80006H8.80005H7.2H0.799951C0.358447 2.80006 0 2.44161 0 1.99996C0 1.55846 0.358447 1.20001 0.799951 1.20001H7.2H8.80005Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
                            </svg>
                        </span>

                        <span class="self-center text-sm sm:text-base text-main font-semibold quantity borobazar-cart-qty borobazar-cart-product-<?php echo esc_attr($product->get_id()); ?>">
                            <?php echo wp_kses('x' . $qty, $allowedHTML); ?>
                        </span>

                        <span class="flex items-center justify-center w-11 sm:w-12 text-lightest cursor-pointer rounded-3xl transition-all hover:bg-base increment borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="plus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Increment', 'borobazar'); ?>">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.2 7.2H8.80005V0.799951C8.80005 0.358447 8.4416 0 7.99995 0C7.55845 0 7.2 0.358447 7.2 0.799951V7.2H0.799951C0.358447 7.2 0 7.55845 0 7.99995C0 8.4416 0.358447 8.80005 0.799951 8.80005H7.2V15.2C7.2 15.6416 7.55845 16 7.99995 16C8.4416 16 8.80005 15.6416 8.80005 15.2V8.80005H15.2C15.6416 8.80005 16 8.4416 16 7.99995C16 7.55845 15.6416 7.2 15.2 7.2Z" fill="currentColor" stroke="#8C969F" stroke-width="0.5" />
                            </svg>
                        </span>
                    </div>
                    <!-- End -->

                <?php } else {?>

                    <?php if (($showQuickView === 'on' && class_exists('RedQWooCommerceQuickView')) && $productType !== 'redq_rental') {?>

                        <a href="#redq-quick-view-modal" class="button-redq-woocommerce-quick-view  absolute flex items-center justify-center w-9 h-9 rounded-full bottom-3 right-3.5 bg-brand z-1 text-white no-underline transition-all hover:text-white hover:bg-brand-hover focus:text-white" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('Quick View', 'borobazar'); ?>" rel="modal:open">
                            <svg stroke="currentColor" fill="none" stroke-width="2.1" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.25em" width="1.25em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </a>

                    <?php } else {?>

                        <a href="<?php echo esc_url($link); ?>" class="add-to-cart absolute flex items-center justify-center w-9 h-9 rounded-full bottom-3 right-3.5 bg-brand z-1 text-white no-underline transition-all hover:text-white hover:bg-brand-hover focus:text-white" aria-label="<?php echo esc_attr__('View Details', 'borobazar'); ?>">
                            <svg stroke="currentColor" fill="none" stroke-width="2.2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.35em" width="1.35em" xmlns="http://www.w3.org/2000/svg">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </a>

                    <?php }?>
                <?php }?>
            <?php }?>
        </div>
        <div class="px-3 sm:px-4 pb-3 sm:pb-6 pt-2.5 sm:pt-3">
            <div class="borobazar-alpine-product-card-price text-sm sm:text-base text-main font-semibold mb-0.5 sm:mb-1.5">
                <?php woocommerce_template_loop_price();?>
                <?php if (!empty($unit)) {?>
                    <span class="unit text-sm sm:text-base text-main font-semibold">
                        <?php
echo wp_kses($label, $allowedHTML);
    echo wp_kses($unit, $allowedHTML);
    ?>
                    </span>
                <?php }?>
            </div>
            <a href="<?php echo esc_url($link); ?>" class="borobazar-alpine-product-card-title block text-sm sm:text-md leading-6 overflow-hidden text-ellipsis no-underline">
                <?php woocommerce_template_loop_product_title();?>
            </a>
        </div>

    </div>


    <?php
/**
 * Hook: woocommerce_after_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_rating - 5
 * @hooked woocommerce_template_loop_price - 10
 */
do_action('woocommerce_after_shop_loop_item_title');
?>

    <?php
/**
 * Hook: woocommerce_after_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_close - 5
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */
do_action('woocommerce_after_shop_loop_item');
?>

</div>