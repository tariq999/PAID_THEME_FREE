<?php

/**
 *  Theme Options Settings related functions are listed here.
 *
 * Function Lists
 *
 *  - borobazar_global_option_data()
 *  - borobazar_local_option_data()
 *  - borobazar_get_current_page_ID()
 */
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$globalOptions = $localOptions = $screenID = '';

if (class_exists('Kirki')) {
    if (!function_exists('borobazar_global_option_data')) {
        /**
         * borobazar_global_option_data.
         *
         * @param mixed $optionKey
         *
         * @return string|integer
         */
        function borobazar_global_option_data($optionKey, $default)
        {
            if (class_exists('BoroBazarHelper')) {
                $globalOptions = Kirki::get_option('borobazar_config', $optionKey);
            } else {
                $globalOptions = $default;
            }
            return $globalOptions;
        }
    }
}

if (!function_exists('borobazar_local_option_data')) {
    /**
     * borobazar_local_option_data.
     *
     * @param mixed $postID
     * @param mixed $metaKey
     * @param mixed $boolean
     *
     * @return string|integer
     */
    function borobazar_local_option_data($postID, $metaKey, $boolean)
    {
        $localOptions = get_post_meta($postID, $metaKey, $boolean);

        return $localOptions;
    }
}

if (!function_exists('borobazar_get_current_page_ID')) {
    /**
     * borobazar_get_current_page_ID.
     *
     * @return string|integer
     */
    function borobazar_get_current_page_ID()
    {
        if ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) {
            $screenID = get_option('page_for_posts');

            return $screenID;
        } else {
            $screenID = get_queried_object_id();

            return $screenID;
        }
    }
}
