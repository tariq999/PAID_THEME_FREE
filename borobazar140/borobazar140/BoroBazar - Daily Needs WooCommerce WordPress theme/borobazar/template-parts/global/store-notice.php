<?php
$allowedHTML = wp_kses_allowed_html('post');
$displayStoreNoticeLink  = 'on';
$borobazarStoreNoticeText = '';
$borobazarStoreNoticeLinkText = esc_html__('Learn More', 'borobazar');
$borobazarStoreNoticeLink = '#';

if (function_exists('borobazar_global_option_data')) {
    $borobazarStoreNoticeText     = borobazar_global_option_data('borobazar_store_notice_text', '');
    $displayStoreNoticeLink       = borobazar_global_option_data('borobazar_store_notice_link_switch', 'on');
    $borobazarStoreNoticeLink     = borobazar_global_option_data('borobazar_store_notice_link', '#');
    $borobazarStoreNoticeLinkText = borobazar_global_option_data('borobazar_store_notice_link_text', esc_html__('Learn More', 'borobazar'));

    $borobazarShowCountDown = borobazar_global_option_data('borobazar_countdown_switch', 'off');
    $borobazarCountDownDate     = borobazar_global_option_data('date_setting', "");

    $paddingY = $borobazarShowCountDown == 'on' ? 'py-4' : 'py-2';
}

?>

<div class="borobazar-store-notice min-h-[40px] w-full <?php echo esc_attr($paddingY) ?> px-4 md:px-6 lg:px-8 text-left sm:text-center hidden items-center justify-center relative text-sm flex-wrap">

    <div class="borobazar-store-notice-content-wrappar flex items-center">
        <div class="borobazar-store-notice-content pr-6 sm:pr-2">
            <?php echo wp_kses($borobazarStoreNoticeText, $allowedHTML); ?>
            <?php if (!empty($displayStoreNoticeLink) && $displayStoreNoticeLink !== 'off') { ?>
                <a class="text-current font-semibold no-underline inline-block ml-1 border-b border-current opacity-90 hover:opacity-100 focus:opacity-100" href="<?php echo esc_url($borobazarStoreNoticeLink); ?>">
                    <?php echo wp_kses($borobazarStoreNoticeLinkText, $allowedHTML); ?>
                </a>
            <?php } ?>
        </div>
        <button type="button" aria-label="<?php echo esc_attr__('Close', 'borobazar'); ?>" class="borobazar-store-notice-close w-7 h-7 rounded-full flex items-center justify-center outline-none absolute right-2 text-current opacity-80 transition-colors duration-200 bg-transparent hover:bg-white hover:bg-opacity-10 hover:opacity-100 focus:bg-white focus:bg-opacity-10 focus:opacity-100">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.6568 12.5254L9.13141 8.00002L13.6569 3.4745C13.9691 3.16231 13.9691 2.65539 13.6568 2.3431C13.3446 2.03091 12.8377 2.03091 12.5255 2.3431L8 6.86862L3.47448 2.3431C3.16229 2.03091 2.65537 2.03091 2.34318 2.3431C2.03089 2.65539 2.03089 3.16231 2.34308 3.4745L6.86859 8.00002L2.34318 12.5254C2.03089 12.8377 2.03089 13.3447 2.34308 13.6568C2.65537 13.9691 3.16229 13.9691 3.47459 13.6568L8 9.13143L12.5254 13.6568C12.8377 13.9691 13.3446 13.9691 13.6569 13.6568C13.9691 13.3447 13.9691 12.8377 13.6568 12.5254Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
            </svg>
        </button>
    </div>
    <?php
    if ($borobazarShowCountDown == 'on') {
    ?>
        <div id="borobazar-countdown"></div>
    <?php
    }
    ?>
</div>
<!-- end of .borobazar-store-notice -->