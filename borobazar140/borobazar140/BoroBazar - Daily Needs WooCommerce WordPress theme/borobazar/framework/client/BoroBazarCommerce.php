<?php

namespace Framework\Client;

if (!defined('ABSPATH')) {
  exit('Direct script access denied.');
}

class BoroBazarCommerce
{
  public function __construct()
  {
    add_action('borobazar_grid_layouts', [$this, 'borobazarGridLayouts']);
    add_action('borobazar_woo_mini_cart_hook', [$this, 'borobazarTopBarMiniCart'], 10, 1);
    add_filter('woocommerce_add_to_cart_fragments', [$this, 'borobazarWoocommerceCartLinkFragment'], 10, 1);
    add_action('customize_register', [$this, 'borobazarCustomizerChange'], 11);
    add_filter('woocommerce_product_options_general_product_data', [$this, 'borobazarWooCommerceGeneralTabCustomFields']);
    add_action('woocommerce_process_product_meta', [$this, 'borobazarWooCommerceSaveFields']);
    add_filter('loop_shop_per_page', [$this, 'borobazarWooCommerceItemOnShop'], 30);
    add_filter('woocommerce_cross_sells_total', [$this, 'borobazarChangeCrossSellsColumns']);
  }


  /**
   * borobazarChangeCrossSellsColumns
   *
   * @param  integer $columns
   * @return void
   */
  public function borobazarChangeCrossSellsColumns($columns)
  {
    $columns = 4;
    if (function_exists('borobazar_global_option_data')) {
      $columns = borobazar_global_option_data('woo_crosssell_product_grid_count', 4);
      return $columns;
    }
    return $columns;
  }

  /**
   * borobazarWooCommerceItemOnShop
   *
   * @param  integer $products
   * @return integer
   */
  public function borobazarWooCommerceItemOnShop($products)
  {
    $products = 24;
    if (function_exists('borobazar_global_option_data')) {
      $products = borobazar_global_option_data('woo_product_limit_on_shop', 24);
    }
    return $products;
  }

  /**
   * borobazarGridLayouts
   *
   * @return void
   */
  public function borobazarGridLayouts()
  {
    $gridLayout = 'grid_alpine';
    if (function_exists('borobazar_global_option_data')) {
      $gridLayout = borobazar_global_option_data('woo_grid_switch', 'grid_alpine');
    }
    switch ($gridLayout) {
      case 'grid_alpine':
        return get_template_part('template-parts/product-grid/grid', 'alpine');
        break;

      case 'grid_oak':
        return get_template_part('template-parts/product-grid/grid', 'oak');
        break;

      case 'grid_maple':
        return get_template_part('template-parts/product-grid/grid', 'maple');
        break;
      case 'grid_sweetgum':
        return get_template_part('template-parts/product-grid/grid', 'sweetgum');
        break;
      case 'grid_broomstick':
        return get_template_part('template-parts/product-grid/grid', 'broomstick');
        break;
      case 'grid_obsidian':
        return get_template_part('template-parts/product-grid/grid', 'obsidian');
        break;

      default:
        return get_template_part('template-parts/product-grid/grid', 'alpine');
        break;
    }
  }

  /**
   * borobazarTopBarMiniCart.
   *
   * @return void
   */

  public function borobazarTopBarMiniCart()
  {
    $layout = 'header-cart';

    if ($layout !== 'header-cart') {
      return;
    } ?>

    <aside class="borobazar-drawer-root borobazar-mini-cart-drawer borobazar-drawer-from-right">
      <button type="button" class="borobazar-drawer-handler borobazar-mini-cart-drawer-handler ml-6 sm:ml-8 text-lightest flex items-center p-0 border-0 bg-transparent outline-none cursor-pointer group transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-brand-hover focus:text-brand-hover" aria-label="<?php echo esc_attr__('Mini Cart', 'borobazar'); ?>">
        <?php borobazar_cart_link(); ?>
      </button>
      <!-- end of mini cart handler -->

      <div class="borobazar-drawer-content flex flex-col w-full sm:w-98 h-full bg-white fixed top-0 right-0 z-50 translate-x-full overflow-hidden transition-transform duration-300">
        <div class="borobazar-drawer-header flex items-center justify-between shrink-0 py-2.5 px-5 sm:px-8 border-b border-main">
          <h3 class="my-3 sm:my-3.5"><?php echo esc_html__('Shopping Cart', 'borobazar'); ?></h3>
          <button type="button" class="borobazar-drawer-close text-lightest flex items-center p-0 border-0 bg-transparent outline-none cursor-pointer group transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-main focus:text-main">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 18 18">
              <path d="M6.572,4.87a1.2,1.2,0,0,0-1.7,1.7l6.947,6.947L4.87,20.465a1.2,1.2,0,1,0,1.7,1.7l6.946-6.946,6.946,6.946a1.2,1.2,0,0,0,1.7-1.7l-6.946-6.946,6.947-6.947a1.2,1.2,0,0,0-1.7-1.7l-6.946,6.947Z" transform="translate(-4.518 -4.518)" fill="currentColor" />
            </svg>
          </button>
        </div>
        <!-- end of .borobazar-drawer-header -->

        <?php if (!is_cart()) { ?>
          <div class="borobazar-drawer-body h-full grow">
            <?php the_widget('WC_Widget_Cart', 'title='); ?>
          </div>
        <?php } ?>
      </div>
      <!-- end of .borobazar-drawer-content -->

      <div class="borobazar-drawer-overlay fixed w-full h-full inset-0 bg-black bg-opacity-40 z-30 transition-all duration-300 cursor-pointer opacity-0 invisible pointer-events-none"></div>
      <!-- end of .borobazar-drawer-overlay -->
    </aside>
<?php
  }

  /**
   * borobazarWoocommerceCartLinkFragment
   *
   * @param  mixed $fragments
   * @return void
   */
  public function borobazarWoocommerceCartLinkFragment($fragments)
  {
    ob_start();
    borobazar_cart_link();
    $fragments['.borobazar-mini-cart-fragment'] = ob_get_clean();
    return $fragments;
  }

  /**
   * borobazarCustomizerChange
   *
   * @return void
   */
  public function borobazarCustomizerChange()
  {
    global $wp_customize;
    $wp_customize->remove_section('woocommerce_product_catalog');
    $wp_customize->remove_control('woocommerce_thumbnail_image_width');
    $wp_customize->remove_control('woocommerce_single_image_width');
  }

  /**
   * borobazarWooCommerceGeneralTabCustomFields.
   *
   * @return void
   */
  public function borobazarWooCommerceGeneralTabCustomFields()
  {
    get_template_part('template-parts/global/woocommerce', 'unit');
  }

  /**
   * borobazarWooCommerceSaveFields.
   *
   * @param mixed $post_id
   *
   * @return void
   */
  public function borobazarWooCommerceSaveFields($post_id)
  {
    $product = wc_get_product($post_id);
    $product_unit = !empty(sanitize_text_field($_POST['_borobazar_woocommerce_product_unit'])) ? sanitize_text_field($_POST['_borobazar_woocommerce_product_unit']) : '';
    $product->update_meta_data('_borobazar_woocommerce_product_unit', $product_unit);
    $product_unit_label = !empty(sanitize_text_field($_POST['_borobazar_woocommerce_product_unit_label'])) ? sanitize_text_field($_POST['_borobazar_woocommerce_product_unit_label']) : '';
    $product->update_meta_data('_borobazar_woocommerce_product_unit_label', $product_unit_label);
    $product->save();
  }
}
