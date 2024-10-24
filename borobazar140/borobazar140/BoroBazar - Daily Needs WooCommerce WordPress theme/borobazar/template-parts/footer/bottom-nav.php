<nav class="borobazar-bottom-navigation position-sticky bottom-0 z-40 h-14 sm:h-16 hidden items-center justify-between px-5 md:px-6 lg:px-8 shadow-bottom-nav">
    <button type="button" aria-label="<?php echo esc_attr__('Menu', 'borobazar'); ?>" class="borobazar-navigation-drawer-handler flex items-center p-0 border-0 bg-transparent outline-none cursor-pointer group transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-brand-hover focus:text-brand-hover">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="14" viewBox="0 0 25.567 18">
            <g transform="translate(-776 -462)">
                <rect data-name="Rectangle 941" width="12.749" height="2.499" rx="1.25" transform="translate(776 462)" fill="currentColor"></rect>
                <rect data-name="Rectangle 942" width="25.567" height="2.499" rx="1.25" transform="translate(776 469.75)" fill="currentColor"></rect>
                <rect data-name="Rectangle 943" width="17.972" height="2.499" rx="1.25" transform="translate(776 477.501)" fill="currentColor"></rect>
            </g>
        </svg>
    </button>
    <!-- End of bottom-nav menu drawer handler -->

    <a aria-label="<?php echo esc_attr__('Home', 'borobazar'); ?>" href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center p-0 border-0 bg-transparent outline-none cursor-pointer group transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-brand-hover focus:text-brand-hover">
        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="20px" viewBox="0 0 17.996 20.442">
            <path d="M48.187,7.823,39.851.182A.7.7,0,0,0,38.9.2L31.03,7.841a.7.7,0,0,0-.211.5V19.311a.694.694,0,0,0,.694.694H37.3A.694.694,0,0,0,38,19.311V14.217h3.242v5.095a.694.694,0,0,0,.694.694h5.789a.694.694,0,0,0,.694-.694V8.335a.7.7,0,0,0-.228-.512ZM47.023,18.617h-4.4V13.522a.694.694,0,0,0-.694-.694H37.3a.694.694,0,0,0-.694.694v5.095H32.2V8.63l7.192-6.98L47.02,8.642v9.975Z" transform="translate(-30.619 0.236)" fill="currentColor" stroke="currentColor" stroke-width="0.4"></path>
        </svg>
    </a>
    <!-- End of bottom-nav home -->

    <button type="button" aria-label="<?php echo esc_attr__('Cart', 'borobazar'); ?>" class="borobazar-mini-cart-drawer-handler flex items-center p-0 border-0 bg-transparent outline-none cursor-pointer group transition-colors duration-200 hover:bg-transparent focus:bg-transparent hover:text-brand-hover focus:text-brand-hover">
        <?php get_template_part('woocommerce/cart-counter/header'); ?>
    </button>
    <!-- End of mini cart handler -->

    <?php if (class_exists('WooCommerce')) { ?>
        <?php $myAccountPageID = get_option('woocommerce_myaccount_page_id'); ?>
        <a aria-label="<?php echo esc_attr__('Account', 'borobazar'); ?>" class="borobazar-join-us-btn flex cursor-pointer items-center no-underline group transition-colors duration-200 hover:text-brand-hover focus:text-brand-hover" href="<?php echo esc_url(get_permalink($myAccountPageID)); ?>">
            <svg class="group-hover:text-current group-focus:text-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.8996 10.9996C20.8996 5.52799 16.4718 1.09961 10.9996 1.09961C5.52799 1.09961 1.09961 5.52739 1.09961 10.9996C1.09961 16.4227 5.49038 20.8996 10.9996 20.8996C16.4862 20.8996 20.8996 16.4477 20.8996 10.9996ZM10.9996 2.25977C15.8188 2.25977 19.7395 6.18043 19.7395 10.9996C19.7395 12.7625 19.2151 14.457 18.2427 15.8922C14.3381 11.6921 7.66824 11.6845 3.75649 15.8922C2.7841 14.457 2.25977 12.7625 2.25977 10.9996C2.25977 6.18043 6.18043 2.25977 10.9996 2.25977ZM4.48007 16.8197C7.95178 12.9256 14.0483 12.9266 17.519 16.8197C14.0357 20.7168 7.96492 20.718 4.48007 16.8197Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                <path d="M11 11.5801C12.9191 11.5801 14.4805 10.0187 14.4805 8.09961V6.93945C14.4805 5.02036 12.9191 3.45898 11 3.45898C9.08091 3.45898 7.51953 5.02036 7.51953 6.93945V8.09961C7.51953 10.0187 9.08091 11.5801 11 11.5801ZM8.67969 6.93945C8.67969 5.65996 9.7205 4.61914 11 4.61914C12.2795 4.61914 13.3203 5.65996 13.3203 6.93945V8.09961C13.3203 9.3791 12.2795 10.4199 11 10.4199C9.7205 10.4199 8.67969 9.3791 8.67969 8.09961V6.93945Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
            </svg>
        </a>
        <!-- End of bottom-nav woo account -->
    <?php } ?>
</nav>