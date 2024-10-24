<?php

/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

$allowed_html = wp_kses_allowed_html('post');

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="cart" action="<?php echo esc_url($product_url); ?>" method="get">
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<button type="submit" class="single_add_to_cart_button button alt">
		<img class="mr-3" src="<?php echo esc_url(get_theme_file_uri('/assets/client/images/single-add-to-cart.svg')); ?>" alt="<?php echo esc_attr__('Product single add to cart icon', 'borobazar'); ?>" />
		<?php echo wp_kses($button_text, $allowed_html); ?>
	</button>

	<?php wc_query_string_form_fields($product_url); ?>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>