<?php
/*
Plugin Name: Admin Menu Width
Description: A plugin to set the width of the WordPress admin menu.
Version: 1.0
Author: Thomas Weschke \ WPDesigns4u.com
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include the main class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-admin-menu-width.php';

// Initialize the plugin.
function run_admin_menu_width() {
    $plugin = new Admin_Menu_Width();
    $plugin->run();
}
run_admin_menu_width();
?>
