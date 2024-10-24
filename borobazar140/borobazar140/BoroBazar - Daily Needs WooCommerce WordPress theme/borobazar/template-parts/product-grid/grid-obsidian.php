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


<div <?php wc_product_class('borobazar-grid-obsidian', $product);?>>

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

    <div class="borobazar-product-<?php echo esc_attr($product->get_id()); ?> borobazar-obsidian-product-card h-full grid grid-cols-[170px,1fr] gap-5 border border-[#EAEEF2] rounded-lg bg-white overflow-hidden transition-all hover:shadow-product-hover">

        <div class="borobazar-obsidian-product-card-thumb relative h-full min-h-[150px] border-r border-[#EAEAEA] overflow-hidden">
            <a href="<?php echo esc_url($link); ?>" class="borobazar-image-fade-in block" aria-label="<?php echo esc_attr($productTitle); ?>">
                <img loading="lazy" class="opacity-0 transition-opacity duration-200 !mb-0" src="<?php echo esc_url($thumbnail); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" alt="<?php echo esc_attr($productTitle); ?>">
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
                    <span class="py-[2px] px-2 bg-error text-white text-[12px]  rounded-full absolute top-[10px] right-[10px] z-1">
                        <?php echo esc_html__('Out Of Stock', 'borobazar'); ?>
                    </span>
                <?php }?>
                <?php if ($isInStock && $isOnSale && $productType === 'simple') {?>
                    <span class="py-[2px] px-2 bg-brand text-white text-[12px]  rounded-full absolute top-[10px] right-[10px] z-1">
                    <?php
                         echo sprintf(
                            /* translators: %s: Discount.*/
                            __('Save %s %%','borobazar'),$price_discount
                        );
                    ?>
                    </span>
                <?php }?>
                <?php if ($isInStock && $isOnSale && $productType === 'variable') {?>
                    <span class="py-[2px] px-2 bg-brand text-white text-[12px]  rounded-full absolute top-[10px] right-[10px] z-1">
                        <?php echo esc_html__('On Sale', 'borobazar'); ?>
                    </span>
                <?php }?>
            </a>
            <?php if (($showQuickView === 'on' && class_exists('RedQWooCommerceQuickView')) && $productType !== 'redq_rental') {?>
                <a href="#redq-quick-view-modal" class="button-redq-woocommerce-quick-view m-auto !absolute inset-0 w-full h-full opacity-0 transition-all hover:opacity-100 hover:bg-[rgba(0,0,0,0.3)]" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('View Products', 'borobazar'); ?>" rel="modal:open">
                    <span class="flex items-center justify-center w-full h-full text-white">
                        <svg stroke="currentColor" fill="none" stroke-width="2.1" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </span>
                </a>
            <?php } else {?>
                <a href="<?php echo esc_url($productURL); ?>" class="grid grid-cols-[1fr,max-content] items-center bg-[#F4F6F8] rounded-[4px] mt-auto no-underline transition-all text-gray-600 hover:text-black font-medium" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('View Products', 'borobazar'); ?>">
                    <span class="flex items-center justify-center w-full h-full text-main">
                        <svg stroke="currentColor" fill="none" stroke-width="2.1" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </span>
                </a>
            <?php }?>
        </div> <!-- end .borobazar-obsidian-product-card-thumb -->

        <div class="borobazar-obsidian-product-card-meta flex justify-between gap-3">
            <div class="pt-[18px]">
                <a href="<?php echo esc_url($link); ?>" class="borobazar-obsidian-product-card-title block text-sm sm:text-md leading-6 overflow-hidden text-ellipsis no-underline mb-3">
                    <?php woocommerce_template_loop_product_title();?>
                </a>
                <div class="borobazar-obsidian-product-card-price text-sm sm:text-base text-main font-semibold mb-0.5 sm:mb-1.5">
                    <?php woocommerce_template_loop_price();?>
                </div>
                <div class="<?php echo esc_attr($display); ?> flex-col justify-between z-1 borobazar-qty-button borobazar-qty-button-<?php echo esc_attr($product->get_id()); ?>">
                    <span class="text-sm sm:text-base text-[#02b290] font-semibold quantity borobazar-cart-qty borobazar-cart-product-<?php echo esc_attr($product->get_id()); ?>">
                        <?php echo wp_kses('x' . $qty, $allowedHTML); ?>
                    </span>
                </div>
            </div>
            <?php if (!empty($unit)): ?>
                <span class="block unit text-sm text-dark mb-[10px]">
                    <?php echo wp_kses($unit, $allowedHTML); ?>
                    <?php echo wp_kses($label, $allowedHTML); ?>
                </span>
            <?php endif;?>

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
                    <div class="<?php echo esc_attr($cartButton); ?> flex flex-col items-center border-l border-[#EAEAEA] no-underline transition-all text-gray-600 hover:text-black font-medium product_type_simple borobazar-update-qty borobazar-add-to-cart-<?php echo esc_attr($product->get_id()); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php echo esc_attr__('Add to Cart', 'borobazar'); ?>">
                        <span class="w-[70px] h-1/2 flex items-center justify-center ml-auto">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2999 7.29998H8.70002V1.69996C8.70002 1.31364 8.38638 1 7.99994 1C7.61362 1 7.29998 1.31364 7.29998 1.69996V7.29998H1.69996C1.31364 7.29998 1 7.61362 1 7.99994C1 8.38638 1.31364 8.70002 1.69996 8.70002H7.29998V14.2999C7.29998 14.6864 7.61362 15 7.99994 15C8.38638 15 8.70002 14.6864 8.70002 14.2999V8.70002H14.2999C14.6864 8.70002 15 8.38638 15 7.99994C15 7.61362 14.6864 7.29998 14.2999 7.29998Z" fill="#000000" stroke="#000000" stroke-width="0.5" />
                            </svg>
                        </span>
                        <!-- <span class="flex items-center justify-center">Add </span> -->
                        <span class="w-[70px] h-1/2 border-t border-[#EAEAEA] flex items-center justify-center ml-auto">
                            <svg width=" 16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3845_18)">
                                    <path d="M8.80005 7.19922H15.2C15.6416 7.19922 16 7.55767 16 7.99917C16 8.44082 15.6416 8.79927 15.2 8.79927H8.80005H7.2H0.799951C0.358447 8.79927 0 8.44082 0 7.99917C0 7.55767 0.358447 7.19922 0.799951 7.19922H7.2H8.80005Z" fill="#ACACAC" stroke="#ACACAC" stroke-width="0.5" />
                                </g>
                                <defs>
                                    <clipPath>
                                        <rect width="16" height="16" fill="#ACACAC" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                    </div>
                    <!-- End -->

                    <!-- Counter -->
                    <div class="<?php echo esc_attr($display); ?> flex-col justify-between border-l border-[#EAEAEA] z-1 borobazar-qty-button-<?php echo esc_attr($product->get_id()); ?>">
                        <span class="flex items-center justify-center w-[70px] h-1/2 border-b border-[#EAEAEA] bg-[#F8F8F9] cursor-pointer transition-all decrement borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="plus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Increment', 'borobazar'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2999 7.29998H8.70002V1.69996C8.70002 1.31364 8.38638 1 7.99994 1C7.61362 1 7.29998 1.31364 7.29998 1.69996V7.29998H1.69996C1.31364 7.29998 1 7.61362 1 7.99994C1 8.38638 1.31364 8.70002 1.69996 8.70002H7.29998V14.2999C7.29998 14.6864 7.61362 15 7.99994 15C8.38638 15 8.70002 14.6864 8.70002 14.2999V8.70002H14.2999C14.6864 8.70002 15 8.38638 15 7.99994C15 7.61362 14.6864 7.29998 14.2999 7.29998Z" fill="black" stroke="black" stroke-width="0.5" />
                            </svg>
                        </span>
                        <span class="flex items-center justify-center w-[70px] h-1/2 cursor-pointer transition-all increment borobazar-update-qty" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-type="minus" data-stock_qty="<?php echo esc_attr($stock_qty); ?>" title="<?php echo esc_attr__('Decrement', 'borobazar'); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3845_18)">
                                    <path d="M8.80005 7.19922H15.2C15.6416 7.19922 16 7.55767 16 7.99917C16 8.44082 15.6416 8.79927 15.2 8.79927H8.80005H7.2H0.799951C0.358447 8.79927 0 8.44082 0 7.99917C0 7.55767 0.358447 7.19922 0.799951 7.19922H7.2H8.80005Z" fill="black" stroke="black" stroke-width="0.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_3845_18">
                                        <rect width="16" height="16" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </span>

                        <!-- <span class="self-center text-sm sm:text-base text-white font-semibold quantity borobazar-cart-qty borobazar-cart-product-<?php echo esc_attr($product->get_id()); ?>">
                            <?php echo wp_kses('x' . $qty, $allowedHTML); ?>
                        </span> -->
                    </div>
                    <!-- End Counter -->

                <?php }?>
            <?php }?>
        </div> <!-- end .borobazar-obsidian-product-card-meta -->

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