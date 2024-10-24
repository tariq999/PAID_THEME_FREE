<?php
/**
 * Template part for displaying posts.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

// Redirecting to appropriate post format
get_template_part('template-parts/post-content/post', get_post_format());