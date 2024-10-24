<?php
$count_posts         = wp_count_posts('page');
$callingMenuClass    = 'Framework\\Client\\BoroBazarCustomNavMenuWalker';
$callingPageNavClass = 'Framework\\Client\\BoroBazarCutomPageWalker';

?>

<nav id="borobazar-main-navigation" class="borobazar-main-navigation layout-default hidden xl:flex">
    <div class="borobazar-menu-area">
        <?php
        if (has_nav_menu('borobazar-menu')) {
            wp_nav_menu([
                'container'       => 'div',
                'container_class' => 'borobazar-menu-wrapper',
                'theme_location'  => 'borobazar-menu',
                'menu_id'         => 'borobazar-main-menu',
                'menu_class'      => 'borobazar-main-menu',
                'walker'          => new $callingMenuClass(),
                'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
            ]);
        } else {
            if ($count_posts) {
                $published_posts = $count_posts->publish;
                if ($published_posts !== 0) {
                    wp_nav_menu([
                        'container'       => 'div',
                        'container_class' => 'borobazar-menu-wrapper',
                        'theme_location'  => 'borobazar-menu',
                        'menu_id'         => 'borobazar-main-menu',
                        'menu_class'      => 'borobazar-main-menu',
                        'walker'          => new $callingMenuClass(),
                        'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
                    ]);
                } else {
                    wp_nav_menu([
                        'container'       => 'div',
                        'container_class' => 'borobazar-menu-wrapper',
                        'theme_location'  => 'borobazar-menu',
                        'menu_id'         => 'borobazar-main-menu',
                        'menu_class'      => 'borobazar-main-menu',
                        'walker'          => new $callingMenuClass(),
                        'fallback_cb'     => 'Framework\\Client\\BoroBazarCustomNavMenuWalker::fallback',
                    ]);
                }
            }
        }
        ?>
    </div>
</nav>