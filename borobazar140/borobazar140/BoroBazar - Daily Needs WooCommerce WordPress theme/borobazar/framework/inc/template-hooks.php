<?php

/**
 * Global hooks
 *
 * @see template-hooks-functions.php
 * 
 */
add_action('wp_body_open', 'borobazar_store_notice', 5);
add_action('wp_body_open', 'borobazar_site_loader', 10);

/**
 * Header Layout (default).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_header_default', 'borobazar_header_wrapper_start', 5);
add_action('borobazar_header_default', 'borobazar_site_branding', 10);
add_action('borobazar_header_default', 'borobazar_header_menu', 15);
add_action('borobazar_header_default', 'borobazar_header_search', 20);
add_action('borobazar_header_default', 'borobazar_header_global_search', 20);
add_action('borobazar_header_default', 'borobazar_woo_link', 30);
add_action('borobazar_header_default', 'borobazar_header_drawer_menu', 35);
add_action('borobazar_header_default', 'borobazar_header_wrapper_end', 40);

/**
 * Header Layout (Berlin).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_header_berlin', 'borobazar_header_wrapper_start', 5);
add_action('borobazar_header_berlin', 'borobazar_site_branding', 10);
add_action('borobazar_header_berlin', 'borobazar_header_menu', 15);
add_action('borobazar_header_berlin', 'borobazar_header_search', 20);
add_action('borobazar_header_berlin', 'borobazar_header_global_search', 20);
add_action('borobazar_header_berlin', 'borobazar_woo_link', 25);
add_action('borobazar_header_berlin', 'borobazar_header_drawer_menu', 28);
add_action('borobazar_header_berlin', 'borobazar_header_wrapper_end', 30);

/**
 * Header Layout (Bogota).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_header_bogota', 'borobazar_header_wrapper_start', 5);
add_action('borobazar_header_bogota', 'borobazar_site_branding', 10);
add_action('borobazar_header_bogota', 'borobazar_header_menu', 15);
add_action('borobazar_header_bogota', 'borobazar_header_search', 20);
add_action('borobazar_header_bogota', 'borobazar_header_global_search', 20);
add_action('borobazar_header_bogota', 'borobazar_woo_link', 25);
add_action('borobazar_header_bogota', 'borobazar_header_drawer_menu', 28);
add_action('borobazar_header_bogota', 'borobazar_header_wrapper_end', 30);

/**
 * Header Layout (Denver).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_header_denver', 'borobazar_header_wrapper_start', 5);
add_action('borobazar_header_denver', 'borobazar_header_drawer_menu', 8);
add_action('borobazar_header_denver', 'borobazar_site_branding', 10);
add_action('borobazar_header_denver', 'borobazar_header_search', 20);
add_action('borobazar_header_denver', 'borobazar_header_global_search', 20);
add_action('borobazar_header_denver', 'borobazar_woo_link', 25);
add_action('borobazar_header_denver', 'borobazar_header_wrapper_end', 30);


/** 
 * Footer Layout (default).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_footer_default', 'borobazar_footer_render', 5);

/*
 * Copyright Layout (default).
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_copyright_default', 'borobazar_copyright_render', 5);

/**
 * Before page content
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_before_content', 'borobazar_banner', 10);

/** 
 * Render WPML Switcher if plugins is activated and configured
 *
 * @see  template-hooks-functions.php
 */
add_action('borobazar_wpml', 'borobazar_wpml_function', 10);
