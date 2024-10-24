<?php
woocommerce_wp_text_input(
    [
        'id'          => '_borobazar_woocommerce_product_unit_label',
        'data_type'   => 'text',
        'label'       => esc_html__('Product Unit Label', 'borobazar'),
        'placeholder' => esc_html__('Ex. /, per', 'borobazar'),
        'class'       => 'borobazar-woocommerce-product-unit-label',
        'desc_tip'    => true,
        'description' => esc_html__('Enter product unit label that will show in product front-end', 'borobazar'),
    ]
);

woocommerce_wp_text_input(
    [
        'id'          => '_borobazar_woocommerce_product_unit',
        'data_type'   => 'text',
        'label'       => esc_html__('Product Unit', 'borobazar'),
        'placeholder' => esc_html__('Ex. kg, ml', 'borobazar'),
        'class'       => 'borobazar-woocommerce-product-unit',
        'desc_tip'    => true,
        'description' => esc_html__('Enter product unit that will show in product front-end', 'borobazar'),
    ]
);
