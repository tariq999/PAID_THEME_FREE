<span class="borobazar-mini-cart-fragment flex items-center">
    <span class="inline-flex items-center relative">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path d="M19.7998 19.0172L18.5401 4.8319C18.5131 4.51697 18.2477 4.27853 17.9372 4.27853H15.3458C15.3098 1.91207 13.3753 0 10.9998 0C8.62435 0 6.68979 1.91207 6.6538 4.27853H4.06239C3.74746 4.27853 3.48652 4.51697 3.45953 4.8319L2.19981 19.0172C2.19981 19.0352 2.19531 19.0532 2.19531 19.0712C2.19531 20.6863 3.67548 22 5.49756 22H16.5021C18.3241 22 19.8043 20.6863 19.8043 19.0712C19.8043 19.0532 19.8043 19.0352 19.7998 19.0172ZM10.9998 1.21472C12.7049 1.21472 14.0951 2.58241 14.1311 4.27853H7.86852C7.90451 2.58241 9.2947 1.21472 10.9998 1.21472ZM16.5021 20.7853H5.49756C4.35482 20.7853 3.42803 20.0294 3.41004 19.0982L4.61576 5.49775H6.6493V7.34233C6.6493 7.67975 6.91924 7.94969 7.25666 7.94969C7.59409 7.94969 7.86402 7.67975 7.86402 7.34233V5.49775H14.1311V7.34233C14.1311 7.67975 14.401 7.94969 14.7385 7.94969C15.0759 7.94969 15.3458 7.67975 15.3458 7.34233V5.49775H17.3794L18.5896 19.0982C18.5716 20.0294 17.6403 20.7853 16.5021 20.7853Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
            </g>
        </svg>
        <span class="borobazar-mini-cart-count min-w-[16px] min-h-[16px] absolute -top-1.5 -right-1 p-[3px] bg-brand text-white text-[11px] leading-none font-semibold rounded-3xl">
            <?php
            echo wp_kses_data(
                sprintf(
                    /* translators: 1: get cart content counts, 2: get cart counts. */
                    _n(
                        '%d',
                        '%d',
                        WC()->cart->get_cart_contents_count(),
                        'borobazar'
                    ),
                    WC()->cart->get_cart_contents_count()
                )
            ); ?>
        </span>
    </span>
    <span class="hidden 2xl:inline-flex ml-2 md:text-[15px] font-normal text-main transition-colors duration-200 group-hover:text-current group-focus:text-current">
        <?php echo esc_html__('Cart', 'borobazar'); ?>
    </span>
</span>