<?php
$allowedIframe = borobazar_allowed_iframe_html();
$borobazarReadMoreText = esc_html__('Read More..', 'borobazar');
$allowed_html = wp_kses_allowed_html('post');
$content = do_shortcode(apply_filters('the_content', $post->post_content));
$media = get_media_embedded_in_content($content, ['video', 'iframe']);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!empty($media)) { ?>
        <div class="entry-media mb-4 md:mb-7">
            <div class="borobazar-video-iframe-container borobazar-image-fade-in relative overflow-hidden w-full">
                <?php
                echo wp_kses(do_shortcode($media[0]), $allowedIframe);
                ?>
            </div>
        </div>
    <?php } ?>
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