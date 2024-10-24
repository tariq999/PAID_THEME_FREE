<?php
$siteLoaderType = 'gif';
$siteLoaderGifImg = '';

if (function_exists('borobazar_global_option_data')) {
    $siteLoaderType = borobazar_global_option_data('site_loader_type', 'gif');
    $siteLoaderGifImg = borobazar_global_option_data('site_loader_gif', '');
}

?>

<div class="borobazar-site-loader fixed inset-0 flex flex-col items-center justify-center bg-white">
    <?php if (isset($siteLoaderType) && $siteLoaderType === 'gif') { ?>
        <img class="w-20 h-auto" width="80" height="80" src="<?php echo esc_url($siteLoaderGifImg ? $siteLoaderGifImg : get_theme_file_uri('/assets/client/images/loading.gif')); ?>" alt="<?php echo esc_attr__('Site Loader', 'borobazar'); ?>">
    <?php } else { ?>
        <svg class="circular w-14 h-14 md:w-16 md:h-16 3xl:w-18 3xl:h-18 4xl:w-20 4xl:h-20" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    <?php } ?>
</div>