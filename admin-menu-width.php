<?php
/*
Plugin Name: Admin Menu Width
Description: A plugin to set the width of the WordPress admin menu.
Version: 1.0.3
Author: Thomas W
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
*/

// WordPress Plugin Update Checker.
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/tweschke/admin-menu-width',
	__FILE__,
	'dmin-menu-width'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('your-token-here');



// Hook to add the settings page
add_action('admin_menu', 'camw_add_settings_page');

// Hook to register the settings
add_action('admin_init', 'camw_register_settings');

// Function to add the settings page to the admin menu
function camw_add_settings_page() {
    add_options_page(
        'Admin Menu Width', // Page title
        'Admin Menu Width', // Menu title
        'manage_options',   // Capability
        'camw-settings',    // Menu slug
        'camw_render_settings_page' // Function to render the settings page
    );
}

// Function to register settings
function camw_register_settings() {
    register_setting(
        'camw_settings_group', // Option group
        'camw_menu_width',     // Option name
        'camw_sanitize_width'  // Sanitize callback
    );
}

// Function to sanitize the input
function camw_sanitize_width($input) {
    $input = absint($input); // Ensure the input is an absolute integer
    return ($input > 36) ? $input : 160; // Minimum width of 36px to avoid issues
}

// Function to render the settings page
function camw_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Admin Menu Width</h1>
        <p>Set the width of the WordPress admin menu. Default is 160px. Minimum allowed width is 36px.</p>
        <form method="post" action="options.php">
            <?php 
            settings_fields('camw_settings_group'); 
            do_settings_sections('camw_settings_group'); 
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Menu Width (px):</th>
                    <td><input type="number" name="camw_menu_width" value="<?php echo esc_attr(get_option('camw_menu_width', '160')); ?>" min="36"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Hook to output custom admin styles
add_action('admin_head', 'camw_custom_admin_styles');

// Function to output custom styles based on the saved menu width
function camw_custom_admin_styles() {
    $menu_width = esc_attr(get_option('camw_menu_width', '160'));
    ?>
    <style>
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            width: <?php echo $menu_width; ?>px;
        }
        #adminmenu .wp-submenu {
            left: <?php echo $menu_width; ?>px;
        }
        #wpcontent, #wpfooter {
            margin-left: <?php echo $menu_width; ?>px;
        }
        #adminmenu a {
            white-space: normal;
        }
        #adminmenu .wp-submenu a {
            padding-left: 20px;
        }
        .folded #adminmenu, .folded #adminmenu .wp-submenu, .folded #adminmenuback, .folded #adminmenuwrap {
            width: 36px;
        }
        .folded #wpcontent, .folded #wpfooter {
            margin-left: 36px;
        }
    </style>
    <?php
}
?>
