<?php

namespace Framework\Client;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class BoroBazarCommerceSingle
{
    public function __construct()
    {
        add_action('borobazar_product_single_layouts', [$this, 'borobazarProductSingleLayouts']);
    }

    public function borobazarProductSingleLayouts()
    {
        $singleLayout = 'layout_one';
        if (function_exists('borobazar_global_option_data')) {
            $singleLayout = borobazar_global_option_data('woo_single_layout_switch', 'layout_one');
        }

        switch ($singleLayout) {
            case 'layout_one':
                get_template_part('template-parts/product-single/layout-one/layout', 'one');
                break;

            default:
                get_template_part('template-parts/product-single/layout-one/layout', 'one');
                break;
        }
    }
}
