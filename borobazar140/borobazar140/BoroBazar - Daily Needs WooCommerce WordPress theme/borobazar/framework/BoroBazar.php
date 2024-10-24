<?php

namespace Framework;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Framework\Admin\AdminMenu;
use Framework\Admin\AdminScripts;
use Framework\Admin\AdminStyles;
use Framework\Admin\Importer;
use Framework\Admin\Plugins;
use Framework\Client\ClientScripts;
use Framework\Client\ClientStyles;
use Framework\Client\BoroBazarCommerce;
use Framework\Client\BoroBazarCommerceSingle;
use Framework\Client\BoroBazarCustomNavMenuWalker;
use Framework\Client\BoroBazarCutomPageWalker;
use Turbo\Setup\Wizard;


class BoroBazar
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->initHooks();
        $this->loadClasses();
    }

    /**
     * initHooks.
     *
     * @return void
     */
    public function initHooks()
    {
        add_action('after_setup_theme', [$this, 'setupTheme']);
        add_action('wp_head', [$this, 'borobazarPingBackHeader']);
        add_action('widgets_init', [$this, 'borobazarWidgetsInit']);
        add_action('init', [$this, 'borobazar_image_sizes']);
    }

    /**
     * setupTheme.
     *
     * @return void
     */
    public function setupTheme()
    {
        if (!isset($GLOBALS['content_width'])) {
            $GLOBALS['content_width'] = apply_filters('borobazar_content_width', 1514);
        }
        load_theme_textdomain('borobazar', get_template_directory() . '/languages');

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        register_nav_menus([
            'borobazar-menu' => esc_html__('BoroBazar Main Menu', 'borobazar')
        ]);
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);
        add_theme_support('custom-background', apply_filters('borobazar_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => esc_attr_x('Small', 'Name of the small font size in the block editor', 'borobazar'),
                    'shortName' => esc_attr_x('S', 'Short name of the small font size in the block editor.', 'borobazar'),
                    'size'      => 18,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => esc_attr_x('Regular', 'Name of the regular font size in the block editor', 'borobazar'),
                    'shortName' => esc_attr_x('M', 'Short name of the regular font size in the block editor.', 'borobazar'),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => esc_attr_x('Large', 'Name of the large font size in the block editor', 'borobazar'),
                    'shortName' => esc_attr_x('L', 'Short name of the large font size in the block editor.', 'borobazar'),
                    'size'      => 24,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => esc_attr_x('Larger', 'Name of the larger font size in the block editor', 'borobazar'),
                    'shortName' => esc_attr_x('XL', 'Short name of the larger font size in the block editor.', 'borobazar'),
                    'size'      => 40,
                    'slug'      => 'larger',
                ),
            )
        );

        add_theme_support('align-wide');
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support(
            'post-formats',
            [
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'status',
                'audio',
                'chat',
            ]
        );

        // editor style
        add_theme_support('editor-styles');
        add_editor_style('/dist/borobazar-editor-style.css');

        // woocommerce
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // remove widgets block editor
        remove_theme_support('widgets-block-editor');
    }

    /**
     * borobazar_image_sizes
     *
     * @return void
     */
    public function borobazar_image_sizes()
    {
        // Grid specific image size
        if (function_exists('add_image_size')) {
            add_image_size('borobazar-grid-thumb', 300, 300, true); //300 pixels wide & height, cropped true
        }
    }

    /**
     * borobazarPingBackHeader.
     *
     * @return void
     */
    public function borobazarPingBackHeader()
    {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }

    /**
     * borobazarWidgetsInit
     *
     * @return void
     */
    public function borobazarWidgetsInit()
    {
        register_sidebar(
            [
                'name'          => esc_html__('BoroBazar - Blog Sidebar', 'borobazar'),
                'id'            => 'borobazar-sidebar',
                'description'   => esc_html__('Add widgets here.', 'borobazar'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class = "widget-title">',
                'after_title'   => '</h4>',
            ]
        );
        register_sidebar(
            [
                'name'          => esc_html__('BoroBazar - WooCommerce Page Sidebar', 'borobazar'),
                'id'            => 'borobazar-woo-sidebar',
                'description'   => esc_html__('Add sidebar widgets to WooCommerce pages (e.g. Product single, Cart, My account).', 'borobazar'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class = "widget-title">',
                'after_title'   => '</h4>',
            ]
        );

        register_sidebar(
            [
                'name'          => esc_html__('BoroBazar - WooCommerce Shop Sidebar', 'borobazar'),
                'id'            => 'borobazar-woo-shop-sidebar',
                'description'   => esc_html__('Add sidebar widgets to WooCommerce Shop page only.', 'borobazar'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class = "widget-title">',
                'after_title'   => '</h4>',
            ]
        );
    }

    /**
     * loadClasses.
     *
     * @return void
     */
    public function loadClasses()
    {
        if (is_admin()) {
            //new AdminMenu();
            new AdminScripts();
            new AdminStyles();
            // new Importer();
           // new Plugins();
            new Wizard();
        }

        new ClientScripts();
        new ClientStyles();
        new BoroBazarCommerce();
        new BoroBazarCommerceSingle();
        new BoroBazarCustomNavMenuWalker();
        new BoroBazarCutomPageWalker();
    }
}
