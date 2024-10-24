<?php
$pageBannerSwitch = $showBreadCrumb = 'on';
$bannerTitle         = get_the_title();
$allowedHTML         = wp_kses_allowed_html('post');
$pageBannerTextColor = '#000000';

if (function_exists('borobazar_global_option_data')) {
    $pageBannerSwitch    = borobazar_global_option_data('blog_banner_switch', 'on');
    $showBreadCrumb      = borobazar_global_option_data('blog_breadcrumb_switch', 'on');
    $pageBannerTextColor = borobazar_global_option_data('blog_banner_text_color', '#000000');
}

?>

<?php if (!empty($pageBannerSwitch) && $pageBannerSwitch !== 'off') : ?>
    <div class="borobazar-page-banner borobazar-blog-page-banner">
        <div class="borobazar-page-banner-content" style="--banner-text-color: <?php echo esc_attr($pageBannerTextColor); ?>">
            <?php if (is_home()) : ?>
                <?php
                if (get_option('page_for_posts', true) !== '0') :
                    $our_title = get_the_title(get_option('page_for_posts', true));
                else :
                    $our_title = esc_html__('Blog', 'borobazar');
                endif;
                ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore', 'borobazar'); ?>
                </span>
                <h1>
                    <?php echo wp_kses($our_title, $allowedHTML); ?>
                </h1>
            <?php elseif (is_category()) : ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore category ', 'borobazar'); ?>
                </span>
                <h1>
                    <?php printf(
                        /* translators: 1: category title */
                        esc_html__('%s', 'borobazar'),
                        '' . single_cat_title('', false) . ''
                    ); ?>
                </h1>
            <?php elseif (is_tag()) : ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore tag ', 'borobazar'); ?>
                </span>
                <h1>
                    <?php printf(
                        /* translators: 1: tag title */
                        esc_html__('%s', 'borobazar'),
                        '' . single_tag_title('', false) . ''
                    ); ?>
                </h1>
            <?php elseif (is_author()) : ?>
                <?php $curauth = get_query_var('author_name') ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore author posts ', 'borobazar'); ?>
                </span>
                <h1>
                    <?php echo wp_kses($curauth->display_name, $allowedHTML); ?>
                </h1>
            <?php elseif (is_404()) : ?>
                <h1><?php echo esc_html__('Error 404', 'borobazar'); ?></h1>
            <?php elseif (is_archive()) : ?>
                <?php if (class_exists('WooCommerce') && (is_shop() || is_product_category())) : ?>
                    <h1><?php woocommerce_page_title(); ?></h1>
                <?php else : ?>
                    <?php if (is_day()) : ?>
                        <span class="borobazar-page-banner-subtitle">
                            <?php echo esc_html__('explore daily archives ', 'borobazar'); ?>
                        </span>
                        <h1>
                            <?php printf(
                                /* translators: 1: daily archive text */
                                esc_html__('%s', 'borobazar'),
                                get_the_date()
                            ); ?>
                        </h1>
                    <?php elseif (is_month()) : ?>
                        <span class="borobazar-page-banner-subtitle">
                            <?php echo esc_html__('explore monthly archives ', 'borobazar'); ?>
                        </span>
                        <h1>
                            <?php
                            printf(
                                /* translators: 1: monthly archive text */
                                esc_html__('%s', 'borobazar'),
                                get_the_date(_x('F Y', 'monthly archives date format', 'borobazar'))
                            );
                            ?>
                        </h1>
                    <?php elseif (is_year()) :  ?>
                        <span class="borobazar-page-banner-subtitle">
                            <?php echo esc_html__('explore yearly archives ', 'borobazar'); ?>
                        </span>
                        <h1>
                            <?php
                            printf(
                                /* translators: 1: yearly archive text */
                                esc_html__('%s', 'borobazar'),
                                get_the_date(_x('Y', 'yearly archives date format', 'borobazar'))
                            );
                            ?>
                        </h1>
                    <?php else : ?>
                        <span class="borobazar-page-banner-subtitle">
                            <?php echo esc_html__('explore', 'borobazar'); ?>
                        </span>
                        <h1><?php esc_html_e('Blog Archives', 'borobazar'); ?></h1>
                    <?php endif; ?>
                <?php endif; ?>

            <?php elseif (is_search()) : ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore', 'borobazar'); ?>
                </span>
                <h1>
                    <?php echo esc_html__('Searched query : ', 'borobazar'); ?>
                    <?php echo wp_kses(get_search_query(), $allowedHTML); ?>
                </h1>
            <?php else : ?>
                <span class="borobazar-page-banner-subtitle">
                    <?php echo esc_html__('explore ', 'borobazar'); ?>
                </span>
                <h1>
                    <?php echo wp_kses($bannerTitle, $allowedHTML); ?>
                </h1>
            <?php endif; ?>
            <?php
            if ($showBreadCrumb === 'on') {
                if (function_exists('borobazar_breadcrumb')) {
                    borobazar_breadcrumb();
                }
            }
            ?>
        </div>
        <!-- end of .borobazar-page-banner-content -->
    </div>
    <!-- end of .borobazar-page-banner -->
<?php endif; ?>