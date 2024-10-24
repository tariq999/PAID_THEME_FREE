<?php

/**
 * Template part for displaying results in search pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('border border-main rounded-xl p-5 sm:p-6 md:p-7'); ?>>
    <div class="entry-post-content">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title m-0"><a class="no-underline break-words" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
        </header>
        <!-- end of .entry-header -->

        <div class="entry-content entry-content-search">
            <?php
            the_excerpt();
            ?>
        </div>
        <!-- end of .entry-content -->
    </div>
</article>
<!-- #post-<?php the_ID(); ?> -->