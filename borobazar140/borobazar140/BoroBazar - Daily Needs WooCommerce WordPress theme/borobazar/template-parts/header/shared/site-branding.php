<?php
$siteLogo = get_theme_mod('custom_logo');
$bottomNavigationDisplay = $borobazarGlobalSearch = 'off';

if (function_exists('borobazar_global_option_data')) {
    $bottomNavigationDisplay = borobazar_global_option_data('bottom_nav_switch', 'off');
    $borobazarGlobalSearch = borobazar_global_option_data('borobazar_enable_global_search', 'off');
}
?>

<div class="site-branding flex items-center justify-between self-center shrink-0 pr-4 lg:pr-8 xl:pr-0 mr-auto xl:mr-10">

    <?php if ($bottomNavigationDisplay !== 'off' && $borobazarGlobalSearch !== 'off') { ?>
        <?php if (!is_front_page()) { ?>
            <button aria-label="<?php echo esc_attr__('Back', 'borobazar'); ?>" class="borobazar-mobile-back-navigator text-lighter p-0 b-0 -ml-0.5 bg-transparent hidden items-center">
                <svg class="w-7 h-auto" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 010 .708L3.207 8l2.647 2.646a.5.5 0 01-.708.708l-3-3a.5.5 0 010-.708l3-3a.5.5 0 01.708 0z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M2.5 8a.5.5 0 01.5-.5h10.5a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                </svg>
            </button>
        <?php } ?>
    <?php } ?>

    <?php
    if (!empty($siteLogo)) {
        the_custom_logo();
    } else { ?>
        <!-- end of .custom-logo -->

        <div class="site-text-logo flex flex-col">
            <h2 class="site-title text-lg sm:text-xl 2xl:text-[22px] mt-0 mb-0.5">
                <a class="no-underline" href="<?php echo esc_url(home_url('/')); ?>" rel="<?php echo esc_attr__('home', 'borobazar'); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </h2>
            <!-- end of .site-title -->

            <?php
            $borobazar_description = get_bloginfo('description', 'display');
            if ($borobazar_description || is_customize_preview()) {
            ?>
                <p class="site-description my-0">
                    <?php echo apply_filters('borobazar_site_description', $borobazar_description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </p>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ($bottomNavigationDisplay !== 'off' && $borobazarGlobalSearch !== 'off') { ?>
        <button type="button" aria-label="<?php echo esc_attr__('Search', 'borobazar'); ?>" class="borobazar-header-search-handler self-center hidden text-lightest p-0 bg-transparent border-0 transition-colors duration-200 hover:bg-transparent hover:text-brand-hover focus:bg-transparent focus:text-brand-hover">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor" />
            </svg>
        </button>
    <?php } ?>
</div>
<!-- end of .site-branding -->