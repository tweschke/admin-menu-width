<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Admin_Menu_Width {

    public function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/admin-menu-width-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/admin-menu-width-settings.php';
        require_once plugin_dir_path( __FILE__ ) . 'class-admin-menu-width-update-checker.php';
    }

    private function define_admin_hooks() {
        $plugin_admin = new Admin_Menu_Width_Admin();
        add_action( 'admin_menu', array( $plugin_admin, 'add_settings_page' ) );
        add_action( 'admin_init', array( $plugin_admin, 'register_settings' ) );
    }

    public function run() {
        $this->define_admin_hooks();
    }
}