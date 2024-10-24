<?php
$allowedHTML = wp_kses_allowed_html('post');

$searchPlaceholder = '';
$goToSearchPage = '';
$borobazarGlobalSearch = 'off';

if (function_exists('borobazar_global_option_data')) {
    $borobazarGlobalSearch = borobazar_global_option_data('borobazar_enable_global_search', 'off');
    $searchPlaceholder = borobazar_global_option_data('borobazar_global_search_placeholder', esc_html__('What are you looking for..', 'borobazar'));
    $goToSearchPage = borobazar_global_option_data('borobazar_global_search_load_more_label', esc_html__('Explore search page.', 'borobazar'));
}

?>

<?php if (class_exists('BoroBazarHelper') && (($borobazarGlobalSearch !== 'off')) && !has_block('borobazar-blocks/borobazar-search-block') && !has_block('borobazar-blocks/borobazar-extended-search-block')) { ?>
    <div class="borobazar-header-search borobazar-global-search-container flex-1 self-center max-w-full lg:max-w-[800px] w-full mx-auto absolute left-0 px-4 lg:relative lg:px-0 hidden">
        <label class="borobazar-header-search-field flex flex-1 items-center relative z-10 transition-all duration-300 opacity-0 mb-0">
            <span class="sr-only">
                <?php echo esc_html($searchPlaceholder); ?>
            </span>

            <span class="flex items-center justify-center w-12 h-full text-lightest absolute top-0 left-0 pointer-events-none">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor"></path>
                </svg>
            </span>
            <input class="borobazar-global-search-input flex-1" placeholder="<?php echo esc_attr($searchPlaceholder); ?>" type="text" name="borobazar-global-search-input" autocomplete="off">
            <span class="native-search-clear borobazar-header-search-clear flex items-center justify-center w-12 h-full text-lightest absolute top-0 right-0 p-0 cursor-pointer transition-colors duration-200 hover:text-main focus:text-main">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 18 18">
                    <path d="M6.572,4.87a1.2,1.2,0,0,0-1.7,1.7l6.947,6.947L4.87,20.465a1.2,1.2,0,1,0,1.7,1.7l6.946-6.946,6.946,6.946a1.2,1.2,0,0,0,1.7-1.7l-6.946-6.946,6.947-6.947a1.2,1.2,0,0,0-1.7-1.7l-6.946,6.947Z" transform="translate(-4.518 -4.518)" fill="currentColor" />
                </svg>
            </span>
        </label>
        <!-- End of global search input field -->

        <div class="borobazar-global-search-results pt-2 mt-0.5 min-h-20 bg-white shadow-dropdown rounded-md absolute top-full left-4 lg:left-0 w-calc-full-8 lg:w-full max-h-[64vh] sm:max-h-[54vh] lg:max-h-96 overflow-hidden z-10" style="display:none;">
            <div class="products"></div>
            <div class="borobazar-loader min-h-20 pb-2">
                <span class="dot-1"></span>
                <span class="dot-2"></span>
                <span class="dot-3"></span>
            </div>
            <a style="display:none;" href="" class="borobazar-more-result bg-white sticky bottom-0 left-0 z-1 rounded-bl-md rounded-br-md block mt-2 p-3.5 text-center transition no-underline">
                <?php echo esc_html($goToSearchPage); ?>
            </a>
        </div>
        <div class="borobazar-global-search-overlay borobazar-header-search-clear fixed bg-black bg-opacity-40 inset-0 transition-all duration-300 opacity-0 invisible z-1"></div>
    </div>
    <!-- End of global search container -->

    <button type="button" class="borobazar-header-search-handler self-center flex text-lightest p-0 xl:px-1 bg-transparent border-0 transition-colors duration-200 hover:bg-transparent hover:text-brand-hover focus:bg-transparent focus:text-brand-hover" aria-label="<?php echo esc_attr__('Search', 'borobazar'); ?>">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor" />
        </svg>
    </button>
    <!-- End of global search handler btn -->
<?php } ?>