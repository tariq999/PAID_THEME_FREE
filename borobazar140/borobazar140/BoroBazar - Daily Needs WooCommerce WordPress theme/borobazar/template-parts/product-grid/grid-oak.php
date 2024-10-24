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


<div <?php wc_product_class('borobazar-grid-oak', $product); ?>>

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

    <div class="borobazar-product-<?php echo esc_attr($product->get_id()); ?> borobazar-oak-product-card grid grid-rows-[max-content] h-full border border-[#EAEEF2] rounded bg-white overflow-hidden transition-all hover:shadow-product-hover">

        <div class="borobazar-oak-product-card-thumb relative h-40 sm:h-48 overflow-hidden">
            <a class="borobazar-image-fade-in" href="<?php echo esc_url($link); ?>" aria-label="<?php echo esc_attr($productTitle); ?>">
                <img loading="lazy" class="opacity-0 transition-opacity duration-200 !mb-0" src="<?php echo esc_url($thumbnail); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" alt="<?php echo esc_attr($productTitle); ?>">
                <?php if (!empty($splicedGalleryIDs) && isset($splicedGalleryIDs)) { ?>
                    <?php foreach ($splicedGalleryIDs as $key => $galleryImageID) { ?>
                        <?php
                        $sliderImageURL = wp_get_attachment_image_url($galleryImageID, $imageSize) ? wp_get_attachment_image_url($galleryImageID, $imageSize) : $placeholderImage;
                        $sliderImageSrcset = wp_get_attachment_image_srcset($galleryImageID, $imageSize);
                        $sliderImageSizes = wp_get_attachment_image_sizes($galleryImageID, $imageSize);
                        ?>
                        <img loading="lazy" class="thumb-1 opacity-0 transition-opacity duration-200" src="<?php echo esc_url($sliderImageURL); ?>" srcset="<?php echo esc_attr($sliderImageSrcset) ?>" sizes="<?php echo esc_attr($sliderImageSizes); ?>" alt="product-grid-gallery-item <?php echo esc_attr($productTitle); ?>">
                    <?php } ?>
                <?php } ?>
                <?php if (!$isInStock) { ?>
                    <span class="product-badge text-xs text-white font-bold bg-error rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php echo esc_html__('Out Of Stock', 'borobazar'); ?>
                    </span>
                <?php } ?>

                <?php if ($isInStock && $isOnSale && $productType === 'simple') { ?>
                    <span class="product-badge text-xs text-white font-bold bg-brand rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php
                        echo sprintf(/* translators: %s: Discount.*/
                            __('Save %s %%', 'borobazar'),
                            $price_discount
                        );
                        ?>
                    </span>
                <?php } ?>
                <?php if ($isInStock && $isOnSale && $productType === 'variable') { ?>
                    <span class="product-badge text-xs text-white font-bold bg-brand rounded-3xl py-0.5 px-1.5 absolute top-3 sm:top-3.5 left-3 sm:left-3.5 z-1">
                        <?php echo esc_html__('On Sale', 'borobazar'); ?>
                    </span>
                <?php } ?>
            </a>
        </div>

        <div class="px-3 sm:px-4 pb-3 sm:pb-6 pt-2.5 sm:pt-3 flex flex-col justify-between">
            <div class="borobazar-oak-product-card-price text-sm sm:text-base text-main font-semibold mb-0.5 sm:mb-1.5">
                <?php woocommerce_template_loop_price(); ?>
            </div>

            <a href="<?php echo esc_url($link); ?>" class="borobazar-oak-product-card-title block mb-auto text-sm sm:text-md leading-6 overflow-hidden text-ellipsis no-underline">
                <?php woocommerce_template_loop_product_title(); ?>
            </a>

            <?php if (!empty($unit)) : ?>
                <span class="block unit text-sm text-dark mt-[10px]">
                    <?php echo wp_kses($unit, $allowedHTML); ?>
                    <?php echo wp_kses($label, $allowedHTML); ?>
                </span>
            <?php endif; ?>

            <?php if ($isInStock) { ?>
                <?php if ($productType === 'simple') { ?>

                    <?php $product_link = class_exists('BoroBazarHelper') ? '#' : $link; ?>

                    <!-- Add to cart button -->
                    <a href="<?php echo esc_url($product_link); ?>" class="<?php echo esc_attr($cartButton); ?> grid grid-cols-[1fr,max-content] items-center bg-[#F4F6F8] rounded-[4px] mt-[10px] no-underline transition-all text-gray-600 hover:text-black font-medium product_type_simple borobazar-update-qty borobazar-add-to-cart-<?php echo esc_attr($product->get_id()); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('Add to Cart', 'borobazar'); ?>">
                        <span class="flex items-center justify-center"> <?php echo esc_html__('Add', 'borobazar'); ?> </span>
                        <span class="w-10 h-10 bg-[#E5E8EC] rounded-tr-[4px] rounded-br-[4px] flex items-center justify-center ml-auto">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2999 7.29998H8.70002V1.69996C8.70002 1.31364 8.38638 1 7.99994 1C7.61362 1 7.29998 1.31364 7.29998 1.69996V7.29998H1.69996C1.31364 7.29998 1 7.61362 1 7.99994C1 8.38638 1.31364 8.70002 1.69996 8.70002H7.29998V14.2999C7.29998 14.6864 7.61362 15 7.99994 15C8.38638 15 8.70002 14.6864 8.70002 14.2999V8.70002H14.2999C14.6864 8.70002 15 8.38638 15 7.99994C15 7.61362 14.6864 7.29998 14.2999 7.29998Z" fill="#ACACAC" stroke="#ACACAC" stroke-width="0.5" />
                            </svg>
                        </span>
                    </a>
                    <!-- End -->

                    <!-- Counter -->
                    <div class="<?php echo esc_attr($display); ?> justify-between bg-brand rounded-[4px] z-1 mt-[10px] borobazar-qty-button borobazar-qty-button-<?php echo esc_attr($product->get_id()); ?>">

                        <span class="flex items-center justify-center w-10 h-10 cursor-pointer rounded-tl-[4px] rounded-bl-[4px] transition-all bg-black/10 decrement borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="minus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Decrement', 'borobazar'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3845_18)">
                                    <path d="M8.80005 7.19922H15.2C15.6416 7.19922 16 7.55767 16 7.99917C16 8.44082 15.6416 8.79927 15.2 8.79927H8.80005H7.2H0.799951C0.358447 8.79927 0 8.44082 0 7.99917C0 7.55767 0.358447 7.19922 0.799951 7.19922H7.2H8.80005Z" fill="white" stroke="white" stroke-width="0.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_3845_18">
                                        <rect width="16" height="16" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </span>

                        <span class="self-center text-sm sm:text-base text-white font-semibold quantity borobazar-cart-qty borobazar-cart-product-<?php echo esc_attr($product->get_id()); ?>">
                            <?php echo wp_kses('x' . $qty, $allowedHTML); ?>
                        </span>

                        <span class="flex items-center justify-center w-10 h-10 cursor-pointer rounded-tr-[4px] rounded-br-[4px] transition-all bg-black/10 increment borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="plus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Increment', 'borobazar'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2999 7.29998H8.70002V1.69996C8.70002 1.31364 8.38638 1 7.99994 1C7.61362 1 7.29998 1.31364 7.29998 1.69996V7.29998H1.69996C1.31364 7.29998 1 7.61362 1 7.99994C1 8.38638 1.31364 8.70002 1.69996 8.70002H7.29998V14.2999C7.29998 14.6864 7.61362 15 7.99994 15C8.38638 15 8.70002 14.6864 8.70002 14.2999V8.70002H14.2999C14.6864 8.70002 15 8.38638 15 7.99994C15 7.61362 14.6864 7.29998 14.2999 7.29998Z" fill="white" stroke="white" stroke-width="0.5" />
                            </svg>
                        </span>
                    </div>
                    <!-- End Counter -->

                <?php } else { ?>

                    <!-- View Products button -->
                    <?php if (($showQuickView === 'on' && class_exists('RedQWooCommerceQuickView')) && $productType !== 'redq_rental') { ?>
                        <a href="#redq-quick-view-modal" class="button-redq-woocommerce-quick-view grid grid-cols-[1fr,max-content] items-center bg-[#F4F6F8] rounded-[4px] mt-[10px] no-underline transition-all text-gray-600 hover:text-black font-medium" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('View Products', 'borobazar'); ?>" rel="modal:open">
                            <span class="flex items-center justify-center"><?php echo esc_html__('View Products', 'borobazar'); ?></span>
                            <span class="w-10 h-10 bg-[#E5E8EC] rounded-tr-[4px] rounded-br-[4px] flex items-center justify-center ml-auto">
                                <svg stroke="currentColor" fill="none" stroke-width="2.1" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.25em" width="1.25em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </span>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo esc_url($link); ?>" class="grid grid-cols-[1fr,max-content] items-center bg-[#F4F6F8] rounded-[4px] mt-[10px] no-underline transition-all text-gray-600 hover:text-black font-medium" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('View Products', 'borobazar'); ?>">
                            <span class="flex items-center justify-center"><?php echo esc_html__('View Products', 'borobazar'); ?></span>
                            <span class="w-10 h-10 bg-[#E5E8EC] rounded-tr-[4px] rounded-br-[4px] flex items-center justify-center ml-auto">
                                <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.41065 9.03532L2.66522 15.7785C2.36923 16.0737 1.88969 16.0737 1.59296 15.7785C1.29697 15.4833 1.29697 15.0037 1.59296 14.7085L7.80335 8.50034L1.59371 2.29219C1.29772 1.99696 1.29772 1.51741 1.59371 1.22143C1.88969 0.926191 2.36998 0.926191 2.66597 1.22143L9.4114 7.96455C9.70284 8.25674 9.70284 8.74382 9.41065 9.03532Z" fill="#737D90" stroke="#737D90" />
                                </svg>
                            </span>
                        </a>
                    <?php } ?>
                    <!-- End View Products button -->
                <?php } ?>
            <?php } ?>
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