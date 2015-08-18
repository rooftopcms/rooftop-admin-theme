<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://errorstudio.co.uk
 * @since             1.0.0
 * @package           Justified_Admin_Theme
 *
 * @wordpress-plugin
 * Plugin Name:       Justified Admin Theme
 * Plugin URI:        justified-admin-theme
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Error
 * Author URI:        http://errorstudio.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       justified-admin-theme
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-justified-admin-theme-activator.php
 */
function activate_justified_admin_theme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-justified-admin-theme-activator.php';
	Justified_Admin_Theme_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-justified-admin-theme-deactivator.php
 */
function deactivate_justified_admin_theme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-justified-admin-theme-deactivator.php';
	Justified_Admin_Theme_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_justified_admin_theme' );
register_deactivation_hook( __FILE__, 'deactivate_justified_admin_theme' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-justified-admin-theme.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_justified_admin_theme() {

	$plugin = new Justified_Admin_Theme();
	$plugin->run();

}
run_justified_admin_theme();
