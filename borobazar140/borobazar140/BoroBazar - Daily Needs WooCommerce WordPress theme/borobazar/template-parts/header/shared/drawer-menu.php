<?php
$count_posts         = wp_count_posts('page');
$callingMenuClass    = 'Framework\\Client\\BoroBazarCustomNavMenuWalker';
$callingPageNavClass = 'Framework\\Client\\BoroBazarCutomPageWalker';

?>

<aside class="borobazar-drawer-root borobazar-drawer-navigation self-center ml-6 sm:ml-8 block xl:hidden">
    <button type="button" class="borobazar-drawer-handler borobazar-navigation-drawer-handler flex flex-col space-y-[5px] w-5 p-0 border-0 bg-transparent outline-none cursor-pointer group hover:bg-transparent focus:bg-transparent" aria-label="<?php echo esc_attr__('Drawer Menu', 'borobazar'); ?>">
        <span class="flex w-full h-0.5 rounded bg-deep-gray transition-colors duration-200 group-hover:bg-brand-hover group-focus:bg-brand-hover"></span>
        <span class="flex w-full h-0.5 rounded bg-deep-gray transition-colors duration-200 group-hover:bg-brand-hover group-focus:bg-brand-hover"></span>
        <span class="flex w-full h-0.5 rounded bg-deep-gray transition-colors duration-200 group-hover:bg-brand-hover group-focus:bg-brand-hover"></span>
    </button>
    <!-- end of .borobazar-drawer-handler -->

    <div class="borobazar-drawer-content flex flex-col w-calc-full-13 sm:w-96 h-full bg-white fixed top-0 left-0 z-50 -translate-x-full overflow-hidden transition-transform duration-300">
        <div class="borobazar-drawer-header flex items-center justify-between shrink-0 py-2.5 px-4">
            <?php
            borobazar_site_branding();
            // end of branding

            if (class_exists('WooCommerce')) {
                $myAccountPageID = get_option('woocommerce_myaccount_page_id');
                if (!empty($myAccountPageID)) {
            ?>
                    <a class="borobazar-join-us-btn flex items-center no-underline text-lightest ml-6 sm:ml-8 group transition-colors duration-200 hover:text-brand-hover focus:text-brand-hover" href="<?php echo esc_url(get_permalink($myAccountPageID)); ?>">
                        <svg class="group-hover:text-current group-focus:text-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.8996 10.9996C20.8996 5.52799 16.4718 1.09961 10.9996 1.09961C5.52799 1.09961 1.09961 5.52739 1.09961 10.9996C1.09961 16.4227 5.49038 20.8996 10.9996 20.8996C16.4862 20.8996 20.8996 16.4477 20.8996 10.9996ZM10.9996 2.25977C15.8188 2.25977 19.7395 6.18043 19.7395 10.9996C19.7395 12.7625 19.2151 14.457 18.2427 15.8922C14.3381 11.6921 7.66824 11.6845 3.75649 15.8922C2.7841 14.457 2.25977 12.7625 2.25977 10.9996C2.25977 6.18043 6.18043 2.25977 10.9996 2.25977ZM4.48007 16.8197C7.95178 12.9256 14.0483 12.9266 17.519 16.8197C14.0357 20.7168 7.96492 20.718 4.48007 16.8197Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                            <path d="M11 11.5801C12.9191 11.5801 14.4805 10.0187 14.4805 8.09961V6.93945C14.4805 5.02036 12.9191 3.45898 11 3.45898C9.08091 3.45898 7.51953 5.02036 7.51953 6.93945V8.09961C7.51953 10.0187 9.08091 11.5801 11 11.5801ZM8.67969 6.93945C8.67969 5.65996 9.7205 4.61914 11 4.61914C12.2795 4.61914 13.3203 5.65996 13.3203 6.93945V8.09961C13.3203 9.3791 12.2795 10.4199 11 10.4199C9.7205 10.4199 8.67969 9.3791 8.67969 8.09961V6.93945Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                        </svg>
                    </a>
            <?php
                }
            }
            ?>
        </div>
        <!-- end of .borobazar-drawer-header -->

        <?php
        if (has_nav_menu('borobazar-menu')) {
            wp_nav_menu([
                'container'       => 'div',
                'container_class' => 'borobazar-drawer-menu-wrapper overflow-hidden h-full grow',
                'theme_location'  => 'borobazar-menu',
                'menu_id'         => 'borobazar-drawer-menu',
                'menu_class'      => 'borobazar-drawer-menu list-none m-0 p-0',
                'walker'          => new $callingMenuClass(),
                'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
            ]);
        } else {
            if ($count_posts) {
                $published_posts = $count_posts->publish;
                if ($published_posts !== 0) {
                    wp_nav_menu([
                        'container'       => 'div',
                        'container_class' => 'borobazar-drawer-menu-wrapper overflow-hidden h-full grow',
                        'theme_location'  => 'borobazar-menu',
                        'menu_id'         => 'borobazar-drawer-menu',
                        'menu_class'      => 'borobazar-drawer-menu list-none m-0 p-0',
                        'walker'          => new $callingMenuClass(),
                        'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
                    ]);
                } else {
                    wp_nav_menu([
                        'container'       => 'div',
                        'container_class' => 'borobazar-drawer-menu-wrapper overflow-hidden h-full grow',
                        'theme_location'  => 'borobazar-menu',
                        'menu_id'         => 'borobazar-drawer-menu',
                        'menu_class'      => 'borobazar-drawer-menu list-none m-0 p-0',
                        'walker'          => new $callingMenuClass(),
                        'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
                    ]);
                }
            }
        }
        ?>
    </div>
    <!-- end of .borobazar-drawer-content -->

    <div class="borobazar-drawer-overlay fixed w-full h-full inset-0 bg-black bg-opacity-40 z-30 transition-all duration-300 cursor-pointer opacity-0 invisible pointer-events-none"></div>
    <!-- end of .borobazar-drawer-overlay -->
</aside>