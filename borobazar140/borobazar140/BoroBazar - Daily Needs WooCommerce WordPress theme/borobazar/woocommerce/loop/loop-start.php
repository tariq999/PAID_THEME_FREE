<?php

/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
  exit;
}

global $woocommerce_loop;


$gridLayout = $gridWrapperClass = '';

if (function_exists('borobazar_global_option_data')) {
  $gridLayout = borobazar_global_option_data('woo_grid_switch', 'grid_alpine');
}

$gridWrapperClassDefault = "borobazar-product-loop-start products";

if (isset($woocommerce_loop['name'])) {
  switch ($gridLayout) {
      // You may also like… is up-sells in product single page
      // You may be interested in… is cross-sells in cart page
    case 'grid_alpine':
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-alpine grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 3xl:grid-cols-6 4xl:grid-cols-8 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-alpine grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 3xl:grid-cols-6 4xl:grid-cols-8 gap-3 md:gap-4 2xl:gap-5";
      }
      break;

    case 'grid_oak':
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-oak grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 3xl:grid-cols-5 4xl:grid-cols-6 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-oak grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 3xl:grid-cols-5 4xl:grid-cols-6 gap-3 md:gap-4 2xl:gap-5";
      }
      break;
    case 'grid_sweetgum':
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-oak grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 3xl:grid-cols-5 4xl:grid-cols-6 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-oak grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 3xl:grid-cols-5 4xl:grid-cols-6 gap-3 md:gap-4 2xl:gap-5";
      }
      break;

    case 'grid_maple':
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-maple grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-maple grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
      }
      break;
    case 'grid_broomstick':
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-broomstick grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-broomstick grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
      }
      break;
      case 'grid_obsidian':
        if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
          $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-obsidian grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
        } else {
          $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-obsidian grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-3 4xl:grid-cols-4 gap-3 md:gap-4 2xl:gap-5";
        }
        break;

    default:
      if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-alpine grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 3xl:grid-cols-6 4xl:grid-cols-8 gap-3 md:gap-4 2xl:gap-5";
      } else {
        $gridWrapperClass = "{$gridWrapperClassDefault} borobozar-product-grid-alpine grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 3xl:grid-cols-6 4xl:grid-cols-8 gap-3 md:gap-4 2xl:gap-5";
      }
      break;
  }
}

?>

<div class="<?php echo esc_attr($gridWrapperClass) ?>">