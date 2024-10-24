<?php
$borobazarReadMoreText = esc_html__('Read More', 'borobazar');
$allowed_html = wp_kses_allowed_html('post');
$pageBannerSwitch = 'on';

if (function_exists('borobazar_global_option_data')) {
    $pageBannerSwitch = borobazar_global_option_data('blog_single_banner_switch', 'on');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-media flex items-center mb-6 sm:mb-9">
            <?php
            borobazar_post_thumbnail();
            ?>
        </div>
    <?php endif; ?>
    <!-- end of .entry-media -->

    <header class="entry-header">
        <?php
        if (!empty($pageBannerSwitch) && $pageBannerSwitch !== 'on') {
            the_title('<h1 class="entry-title break-words mt-0 mb-5">', '</h1>');
        }
        ?>

        <div class="entry-meta">
            <?php
            borobazar_post_meta();
            ?>
        </div>
        <!-- end of .entry-meta -->
    </header>
    <!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'borobazar'),
                'after'  => '</div>',
            )
        );
        ?>
    </div>
    <!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'borobazar'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer>
        <!-- end of.entry-footer -->

    <?php endif; ?>
</article>
<!-- #post-<?php the_ID(); ?> -->

<?php
$tagsList = get_the_tag_list('', esc_html_x(', ', 'Comma used between tag items.', 'borobazar'));
$categoriesList = get_the_category_list(esc_html_x(', ', 'Comma used between category items.', 'borobazar'));

if ($tagsList) {
    printf(
        '<div class="entry-post-tags"> 
          <span class="tag-title font-semibold text-main font-h6 mr-1">%1$s </span>
          <span class="tag-items">%2$s</span>
          </div>',
        esc_html_x('Tags: ', 'Used before tag items.', 'borobazar'),
        $tagsList
    );
}
// end of .entry-post-tag

if ($categoriesList) {
    printf(
        '<div class="entry-post-categories">
          <span class="cat-title font-semibold text-main font-h6 mr-1">%1$s </span>
          <span class="cat-items">%2$s</span>
          </div>',
        esc_html_x('Categories:', 'Used before category items.', 'borobazar'),
        $categoriesList
    );
}
// end of .entry-post-category

if (is_singular('attachment')) {
    the_post_navigation(
        array(
            /* translators: %s: parent post link */
            'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'borobazar'), '%title'),
        )
    );
} elseif (is_singular('post')) {
    borobazar_post_navigation();
}
// end of .post-navigation
