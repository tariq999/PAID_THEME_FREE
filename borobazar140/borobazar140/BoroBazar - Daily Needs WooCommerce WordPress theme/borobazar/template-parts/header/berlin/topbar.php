<div class="borobazar-header-topbar hidden xl:block bg-base">
    <div class="min-h-20 w-full max-w-120 mx-auto flex items-center justify-between px-4 sm:px-5 lg:px-8 2xl:px-10">
        <?php borobazar_site_branding(); ?>

        <div class="borobazar-header-topbar-search flex-1">
            <?php borobazar_header_search(); ?>
            <?php borobazar_header_global_search(); ?>
        </div>
        <!-- end of global search -->

        <div class="flex items-center">
            <?php borobazar_woo_link(); ?>
        </div>
        <!-- end of woo -->
    </div>
</div>