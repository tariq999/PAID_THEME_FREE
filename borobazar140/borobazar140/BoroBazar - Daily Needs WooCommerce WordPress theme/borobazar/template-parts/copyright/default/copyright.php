<?php
$paymentMethods = [];
$languageSwitcher = 'off';
$allowedHTML = wp_kses_allowed_html('post');

$copyrightText = esc_html__('RedQ, Inc. All rights reserved', 'borobazar');
if (function_exists('borobazar_global_option_data')) {
    $paymentMethods = borobazar_global_option_data('copyright_payment_support', []);
    $copyrightText  = borobazar_global_option_data('copyright_texts', esc_html__('RedQ, Inc. All rights reserved', 'borobazar'));
    $languageSwitcher  = borobazar_global_option_data('borobazar_lang_switcher', 'off');
}

$copyrightAreaClass = 'text-center';
if (sizeof($paymentMethods) > 0 || $languageSwitcher === 'on') {
    $copyrightAreaClass = 'flex flex-col gap-4 lg:gap-0 lg:flex-row items-center justify-between';
}

$copyrightTextClass = '';
if (sizeof($paymentMethods) > 0 && $languageSwitcher === 'on') {
    $copyrightTextClass = 'flex-1 text-center';
}

?>

<div class="borobazar-copyright-area py-7 border-t border-lighter <?php echo esc_attr($copyrightAreaClass); ?>">
    <?php if (sizeof($paymentMethods) > 0) { ?>
        <div class="borobazar-supported-payment-methods flex-1 flex flex-wrap justify-start items-center gap-[14px] sm:gap-5">
            <?php foreach ($paymentMethods as $paymentMethod) { ?>
                <img class="w-auto h-3 sm:h-[14px]" src="<?php echo esc_url($paymentMethod['payment_method_logo']) ?>" alt="<?php echo esc_attr('Supported payment', 'borobazar'); ?>" />
            <?php } ?>
        </div>
        <!-- end of supported payment methods -->
    <?php } ?>

    <div class="<?php echo esc_attr($copyrightTextClass); ?>">
        <?php
        $year = date('Y');
        /* translators: 1: Theme name, 2: Theme author. */
        echo esc_html__('© Copyright ', 'borobazar');
        echo wp_kses($year . ' ', $allowedHTML);
        echo wp_kses($copyrightText, $allowedHTML);
        ?>
    </div>
    <!-- end of copyright text -->

    <?php if ($languageSwitcher === 'on') {
        /**
         * Functions hooked into borobazar_copyright action.
         *
         * @hooked borobazar_wpml_function - 10
         */
        do_action('borobazar_wpml');
    } ?>
</div>