<?php
$searchPlaceholder = get_theme_mod('borobazar_global_search_placeholder', esc_html__('What are you looking for..', 'borobazar'));
$loadMoreProducts = get_theme_mod('borobazar_global_search_load_more_label', esc_html__('Explore search page.', 'borobazar'));
$allowedHTML = wp_kses_allowed_html('post');
?>

<?php if (class_exists('BoroBazarHelper') && (has_block('borobazar-blocks/borobazar-search-block') || has_block('borobazar-blocks/borobazar-extended-search-block'))) { ?>
    <div class="borobazar-header-search lg:max-w-[800px] w-calc-full-8 lg:w-full absolute left-4 top-auto z-1 lg:static lg:left-auto self-center mx-auto flex-1 items-center hidden">
        <label class="borobazar-header-search-field flex-1 relative transition-opacity duration-300 opacity-0 mb-0">
            <span class="sr-only"><?php echo wp_kses($searchPlaceholder, $allowedHTML); ?></span>
            <span class="flex items-center justify-center w-12 h-full text-lightest absolute top-0 left-0 pointer-events-none">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor"></path>
                </svg>
            </span>
            <input class="borobazar-product-search-form-input w-full" placeholder="<?php echo esc_attr($searchPlaceholder); ?>" type="text" name="text-search" autocomplete="off" />
            <span class="borobazar-header-search-clear cursor-pointer flex items-center justify-center w-12 h-full text-lightest absolute top-0 right-0 p-0 transition-colors duration-200 hover:text-main focus:text-main">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 18 18">
                    <path d="M6.572,4.87a1.2,1.2,0,0,0-1.7,1.7l6.947,6.947L4.87,20.465a1.2,1.2,0,1,0,1.7,1.7l6.946-6.946,6.946,6.946a1.2,1.2,0,0,0,1.7-1.7l-6.946-6.946,6.947-6.947a1.2,1.2,0,0,0-1.7-1.7l-6.946,6.947Z" transform="translate(-4.518 -4.518)" fill="currentColor" />
                </svg>
            </span>
        </label>
    </div>
    <!-- End of header search input field -->

    <button type="button" class="borobazar-header-search-handler self-center flex text-lightest p-0 xl:px-1 bg-transparent border-0 transition-colors duration-200 hover:bg-transparent hover:text-brand-hover focus:bg-transparent focus:text-brand-hover" aria-label="<?php echo esc_attr__('Search Handler', 'borobazar'); ?>">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.0144 17.9256L13.759 12.6703C14.777 11.4129 15.3899 9.81507 15.3899 8.07486C15.3899 4.04156 12.1081 0.759766 8.07483 0.759766C4.04152 0.759766 0.759766 4.04152 0.759766 8.07483C0.759766 12.1081 4.04156 15.3899 8.07486 15.3899C9.81507 15.3899 11.4129 14.777 12.6703 13.759L17.9256 19.0144C18.0757 19.1645 18.2728 19.24 18.47 19.24C18.6671 19.24 18.8642 19.1645 19.0144 19.0144C19.3155 18.7133 19.3155 18.2266 19.0144 17.9256ZM8.07486 13.8499C4.89009 13.8499 2.2998 11.2596 2.2998 8.07483C2.2998 4.89006 4.89009 2.29976 8.07486 2.29976C11.2596 2.29976 13.8499 4.89006 13.8499 8.07483C13.8499 11.2596 11.2596 13.8499 8.07486 13.8499Z" fill="currentColor" />
        </svg>
    </button>
    <!-- End of header search handler btn -->
<?php } ?>