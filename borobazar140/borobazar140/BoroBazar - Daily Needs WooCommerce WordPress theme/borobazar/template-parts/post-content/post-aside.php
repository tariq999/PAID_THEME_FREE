<?php
$borobazarReadMoreText = esc_html__('Read More..', 'borobazar');
$allowed_html = wp_kses_allowed_html('post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-media flex items-start mb-4 md:mb-7">
        <?php
        borobazar_post_thumbnail();
        ?>
    </div>
    <!-- end of .entry-media -->

    <div class="entry-post-content">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title mt-0 mb-3 sm:mb-[14px] md:mb-4"><a class="no-underline break-words" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>

            <div class="entry-meta flex flex-wrap items-center">
                <?php
                if (get_post_type() === 'post') {
                    borobazar_post_category();
                }
                borobazar_post_meta();
                ?>
            </div>
        </header>
        <!-- end of .entry-header -->

        <div class="entry-content">
            <?php
            the_excerpt();
            ?>
        </div>
        <!-- end of .entry-content -->

        <footer class="entry-footer mt-6 sm:mt-7">
            <a class="borobazar-outline-btn no-underline" href="<?php echo esc_url(get_permalink()); ?>">
                <?php echo wp_kses($borobazarReadMoreText, $allowed_html); ?>
            </a>
        </footer>
        <!-- end of .entry-footer -->
    </div>
</article>
<!-- #post-<?php the_ID(); ?> -->