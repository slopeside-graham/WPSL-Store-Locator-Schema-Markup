<?php
/*
Plugin Name: WP Store Locator - Schema Markup
Description: Add Schema Markup Support to WP Store Locator
Author: Graham Holland
Author URI:
Version: 1.0
*/
//phpinfo();

const scriptver = '1.0.11-11-2021-1';  // Use this in register script calls to bypass cache.

// Include shortcodes
include_once(plugin_dir_path(__FILE__) . 'shortcodes.php');

// Include Setting Pages
include_once(plugin_dir_path(__FILE__) . '/admin/admin.php');

// Create a Stiing Page in Store Locator Page
function add_schema_admin()
{
    add_submenu_page(
        'edit.php?post_type=wpsl_stores',
        'Schema Markup',
        'Schema Markup',
        'manage_wpsl_settings',
        'schema',
        'wpsl_schema_page_admin'
    );
}
add_action('admin_menu', 'add_schema_admin');
