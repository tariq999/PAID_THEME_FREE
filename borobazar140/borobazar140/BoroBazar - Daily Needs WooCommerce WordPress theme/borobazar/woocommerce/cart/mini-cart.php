<?php

/**
 * Mini-cart.
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.  borobazar-update-qty
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 *
 * @version 7.9.0
 */
defined('ABSPATH') || exit;

$emptyCSSClass = $cartCounterClass = '';
$cartItems = [];
if (function_exists('borobazar_check_product_in_cart')) {
    $cartItems = borobazar_check_product_in_cart();
}
if (empty($cartItems)) {
    $emptyCSSClass = 'borobazar-empty-mini-cart';
}
$allowed_html = wp_kses_allowed_html('post');
$cartCounterClass = 'mini-cart-update-qty';

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>
    <div class="borobazar-mini-cart-items overflow-hidden h-full">
        <div class="py-3.5">
            <?php
            do_action('woocommerce_before_mini_cart_contents');

            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>

                    <div class="borobazar-mini-cart-item py-2.5 px-5 sm:py-3.5 sm:px-8 flex flex-start overflow-hidden borobazar-product-<?php echo esc_attr($product_id); ?>">
                        <div class="borobazar-mini-cart-item-thumbnail borobazar-image-fade-in w-20 h-20 mr-5 relative overflow-hidden">
                            <?php echo wp_kses($thumbnail, $allowed_html); ?>
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button borobazar_remove_mini_cart_item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-type="clean_cart_item" data-source="mini_cart_remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <path  data-name="Path 16584" d="M17.074,2.925a10,10,0,1,0,0,14.149A10.016,10.016,0,0,0,17.074,2.925Zm-3.129,11.02a.769.769,0,0,1-1.088,0L10,11.088,7.007,14.081a.769.769,0,0,1-1.088-1.088L8.912,10,6.055,7.143A.769.769,0,0,1,7.143,6.055L10,8.912l2.721-2.721a.769.769,0,0,1,1.088,1.088L11.088,10l2.857,2.857A.769.769,0,0,1,13.945,13.945Z" transform="translate(0 0)" fill="#fff"/>
                                        </svg>
								    </a>',
                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                    esc_attr__('Remove this item', 'borobazar'),
                                    esc_attr($product_id),
                                    esc_attr($cart_item_key),
                                    esc_attr($_product->get_sku())
                                ),
                                $cart_item_key
                            ); ?>
                        </div>
                        <div class="borobazar-mini-cart-item-info flex-1">
                            <div class="flex flex-start justify-between">
                                <?php if (empty($product_permalink)) : ?>
                                    <span class="borobazar-mini-cart-item-title">
                                        <?php echo wp_kses($product_name, $allowed_html); ?>
                                    </span>
                                <?php else : ?>
                                    <a class="borobazar-mini-cart-item-title" href=" <?php echo esc_url($product_permalink); ?>">
                                        <?php echo wp_kses($product_name, $allowed_html); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="borobazar-mini-cart-item-price shrink-0 text-main font-semibold text-sm sm:text-base">
                                    <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                </div>
                            </div>
                            <p class="borobazar-mini-cart-item-price text-sm text-lighter mt-1 mb-2">
                                <?php echo apply_filters('borobazar_cart_item_price', sprintf('%s %s', esc_html__('Unit price : ', 'borobazar'), WC()->cart->get_product_subtotal($_product, 1), $cart_item, $cart_item_key)); ?>
                            </p>
                            <div class="borobazar-mini-cart-counter inline-flex items-center">
                                <span class="decrement text-lighter shrink-0 flex items-center justify-center w-7 h-7 rounded-full border border-main cursor-pointer transition duration-200 hover:bg-brand hover:border-brand hover:text-white <?php echo esc_attr($cartCounterClass); ?>" data-product_id="<?php echo esc_attr($product_id); ?>" data-type="minus" data-source="mini_cart">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="1.25" viewBox="0 0 10 1.25">
                                        <path data-name="Path 9" d="M142.157,142.158h-4.375v1.25h10v-1.25h-5.625Z" transform="translate(-137.782 -142.158)" fill="currentColor" />
                                    </svg>
                                </span>
                                <span class="borobazar-mini-cart-counter-value min-w-[40px] flex-1 text-main text-center">
                                    <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
                                </span>
                                <span class="increment text-lighter shrink-0 flex items-center justify-center w-7 h-7 rounded-full border border-main cursor-pointer transition duration-200 hover:bg-brand hover:border-brand hover:text-white <?php echo esc_attr($cartCounterClass); ?>" data-product_id="<?php echo esc_attr($product_id); ?>" data-type="plus" data-source="mini_cart">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10">
                                        <path data-name="Path 9" d="M143.407,137.783h-1.25v4.375h-4.375v1.25h4.375v4.375h1.25v-4.375h4.375v-1.25h-4.375Z" transform="translate(-137.782 -137.783)" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

            <?php
                }
            }

            do_action('woocommerce_mini_cart_contents');
            ?>
        </div>
    </div>

<?php else : ?>
    <div class="borobazar-mini-cart-empty-message h-full flex flex-col items-center justify-center p-8">
        <img class="-ml-12" src="<?php echo esc_url(get_theme_file_uri('/assets/client/images/mini-cart-empty.png')); ?>" alt="<?php echo esc_attr__('no product found', 'borobazar'); ?>">
        <h3 class="my-2"><?php esc_html_e('Your cart is empty', 'borobazar'); ?></h3>
        <p class="my-0"><?php esc_html_e('Please add product to your cart', 'borobazar'); ?></p>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
<div class="borobazar-mini-cart-total py-6 px-5 sm:p-8 border-t border-main <?php echo esc_attr($emptyCSSClass); ?>">
    <div class="borobazar-mini-cart-amount flex items-center justify-between text-base -mt-1 mb-5 sm:mb-6">
        <?php
        /**
         * Hook: woocommerce_widget_shopping_cart_total.
         *
         * @hooked woocommerce_widget_shopping_cart_subtotal - 10
         */
        do_action('woocommerce_widget_shopping_cart_total');
        ?>
    </div>
    <a class="flex flex-col items-center justify-center min-h-13 py-2.5 px-5 text-sm font-semibold rounded-md text-white bg-brand transition-colors duration-300 hover:bg-brand-hover focus:bg-brand-hover" href="<?php echo esc_url(wc_get_checkout_url()); ?>">
        <span class="label text-white"><?php echo esc_html__('Proceed To Checkout', 'borobazar'); ?></span>
        <span class="borobazar-loader">
            <span class="dot-1"></span>
            <span class="dot-2"></span>
            <span class="dot-3"></span>
        </span>
    </a>
</div>
<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>


<?php do_action('woocommerce_after_mini_cart'); ?>