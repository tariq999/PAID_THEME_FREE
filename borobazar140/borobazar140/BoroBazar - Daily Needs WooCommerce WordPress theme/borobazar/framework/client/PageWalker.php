<?php

namespace Framework\Client;

use Walker;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class BoroBazarCutomPageWalker extends Walker
{
    /**
     * What the class handles.
     *
     * @since 2.1.0
     *
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'page';

    /**
     * Database fields to use.
     *
     * @since 2.1.0
     *
     * @var array
     *
     * @see Walker::$db_fields
     *
     * @todo Decouple this.
     */
    public $db_fields = [
        'parent' => 'post_parent',
        'id' => 'ID',
    ];

    /**
     * Outputs the beginning of the current level in the tree before elements are output.
     *
     * @since 2.1.0
     * @see Walker::start_lvl()
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of page. Used for padding. Default 0.
     * @param array  $args   Optional. Arguments for outputting the next level.
     *                       Default empty array.
     */
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        if (isset($args['item_spacing']) && 'preserve' === $args['item_spacing']) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $indent = str_repeat($t, $depth);
        $output .= "{$n}{$indent}<ul class='children'>{$n}";
    }

    /**
     * Outputs the end of the current level in the tree after elements are output.
     *
     * @since 2.1.0
     * @see Walker::end_lvl()
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of page. Used for padding. Default 0.
     * @param array  $args   Optional. Arguments for outputting the end of the current level.
     *                       Default empty array.
     */
    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        if (isset($args['item_spacing']) && 'preserve' === $args['item_spacing']) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $indent = str_repeat($t, $depth);
        $output .= "{$indent}</ul>{$n}";
    }

    /**
     * Outputs the beginning of the current element in the tree.
     *
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string  $output       Used to append additional content. Passed by reference.
     * @param WP_Post $page         Page data object.
     * @param int     $depth        Optional. Depth of page. Used for padding. Default 0.
     * @param array   $args         Optional. Array of arguments. Default empty array.
     * @param int     $current_page Optional. Page ID. Default 0.
     */
    public function start_el(&$output, $page, $depth = 0, $args = [], $current_page = 0)
    {
        if (isset($args['item_spacing']) && 'preserve' === $args['item_spacing']) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        if ($depth) {
            $indent = str_repeat($t, $depth);
        } else {
            $indent = '';
        }

        $css_class = ['page_item', 'page-item-'.$page->ID];

        if (isset($args['pages_with_children'][$page->ID])) {
            $css_class[] = 'page_item_has_children';
        }

        if (!empty($current_page)) {
            $_current_page = get_post($current_page);
            if ($_current_page && in_array($page->ID, $_current_page->ancestors)) {
                $css_class[] = 'current_page_ancestor';
            }
            if ($page->ID == $current_page) {
                $css_class[] = 'current_page_item';
            } elseif ($_current_page && $page->ID == $_current_page->post_parent) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ($page->ID == get_option('page_for_posts')) {
            $css_class[] = 'current_page_parent';
        }

        /**
         * Filters the list of CSS classes to include with each page item in the list.
         *
         * @since 2.8.0
         * @see wp_list_pages()
         *
         * @param string[] $css_class    An array of CSS classes to be applied to each list item.
         * @param WP_Post  $page         Page data object.
         * @param int      $depth        Depth of page, used for padding.
         * @param array    $args         An array of arguments.
         * @param int      $current_page ID of the current page.
         */
        $css_classes = implode(' ', apply_filters('page_css_class', $css_class, $page, $depth, $args, $current_page));
        $css_classes = $css_classes ? ' class="'.esc_attr($css_classes).'"' : '';

        if ('' === $page->post_title) {
            /* translators: %d: ID of a post. */
            $page->post_title = sprintf(esc_html__('#%d (no title)', 'borobazar'), $page->ID);
        }

        $args['link_before'] = empty($args['link_before']) ? '' : $args['link_before'];
        $args['link_after'] = empty($args['link_after']) ? '' : $args['link_after'];

        $atts = [];
        $atts['href'] = get_permalink($page->ID);
        $atts['aria-current'] = ($page->ID == $current_page) ? 'page' : '';

        /**
         * Filters the HTML attributes applied to a page menu item's anchor element.
         *
         * @since 4.8.0
         *
         * @param array $atts {
         *                    The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @var string $href         The href attribute.
         *     @var string $aria_current The aria-current attribute.
         * }
         *
         * @param WP_Post $page         Page data object.
         * @param int     $depth        Depth of page, used for padding.
         * @param array   $args         An array of arguments.
         * @param int     $current_page ID of the current page.
         */
        $atts = apply_filters('page_menu_link_attributes', $atts, $page, $depth, $args, $current_page);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' '.$attr.'="'.$value.'"';
            }
        }

        $has_children = 0;
        if (in_array('page_item_has_children', $css_class)) {
            $has_children = 1;
        }

        // $output .= $indent . sprintf(
        //     '<li%s><a%s>%s%s%s</a>%s',
        //     $css_classes,
        //     $attributes,
        //     $args['link_before'],
        //     /** This filter is documented in wp-includes/post-template.php */
        //     apply_filters('the_title', $page->post_title, $page->ID),
        //     $args['link_after'],
        // );

        $output .= $indent.'<li'.$css_classes.'>';
        $output .= '<a '.$attributes.'>';
        $output .= $args['link_before'].apply_filters('the_title', $page->post_title, $page->ID).$args['link_after'];
        $output .= '</a>';
        if ($has_children > 0) {
            $output .= 
                '<span class="menu-drop-down-selector" title="open">
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.99997 5.85018C4.82075 5.85018 4.64155 5.78175 4.50492 5.64518L0.205141 1.34536C-0.0683805 1.07184 -0.0683805 0.628372 0.205141 0.354961C0.478553 0.0815496 0.921933 0.0815496 1.19548 0.354961L4.99997 4.15968L8.80449 0.355094C9.07801 0.0816825 9.52135 0.0816825 9.79474 0.355094C10.0684 0.628505 10.0684 1.07197 9.79474 1.34549L5.49503 5.64531C5.35832 5.78191 5.17913 5.85018 4.99997 5.85018Z" fill="currentColor"/>
                    </svg>                
                </span>';
        }

        if (!empty($args['show_date'])) {
            if ('modified' == $args['show_date']) {
                $time = $page->post_modified;
            } else {
                $time = $page->post_date;
            }

            $date_format = empty($args['date_format']) ? '' : $args['date_format'];
            $output .= ' '.mysql2date($date_format, $time);
        }
    }

    /**
     * Outputs the end of the current element in the tree.
     *
     * @since 2.1.0
     * @see Walker::end_el()
     *
     * @param string  $output Used to append additional content. Passed by reference.
     * @param WP_Post $page   Page data object. Not used.
     * @param int     $depth  Optional. Depth of page. Default 0 (unused).
     * @param array   $args   Optional. Array of arguments. Default empty array.
     */
    public function end_el(&$output, $page, $depth = 0, $args = [])
    {
        if (isset($args['item_spacing']) && 'preserve' === $args['item_spacing']) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $output .= "</li>{$n}";
    }
}
