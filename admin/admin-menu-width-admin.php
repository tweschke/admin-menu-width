<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Admin_Menu_Width_Admin {

    public function add_settings_page() {
        add_options_page(
            'Admin Menu Width', // Page title
            'Admin Menu Width', // Menu title
            'manage_options',   // Capability
            'camw-settings',    // Menu slug
            array( $this, 'render_settings_page' ) // Function to render the settings page
        );
    }

    public function register_settings() {
        register_setting(
            'camw_settings_group', // Option group
            'camw_menu_width',     // Option name
            array( $this, 'sanitize_width' )  // Sanitize callback
        );
    }

    public function render_settings_page() {
        // Render the settings page content here.
    }

    public function sanitize_width( $input ) {
        // Sanitize the input here.
        return $input;
    }
}