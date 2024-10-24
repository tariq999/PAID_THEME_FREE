<form role="search" method="get" id="searchform" class="search-form flex items-center relative" action="/">
    <label for="s" class="flex flex-col w-full m-0">
        <span class="screen-reader-text"><?php echo esc_html__('Search for:', 'borobazar'); ?></span>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="search-field" placeholder="<?php echo esc_attr__('Search...', 'borobazar'); ?>" autocomplete="off" />
    </label>
    <button type="submit" id="searchsubmit" class="search-submit flex items-center justify-center h-full py-2 px-4 absolute top-0 right-0 border-0 rounded-tl-none rounded-bl-none cursor-pointer bg-transparent text-lightest transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-main focus:text-main">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="21px" width="21px">
            <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
        </svg>
    </button>
</form>