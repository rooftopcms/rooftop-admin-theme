<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.rooftopcms.com
 * @since             1.0.0
 * @package           Rooftop_Admin_Theme
 *
 * @wordpress-plugin
 * Plugin Name:       Rooftop Admin Theme
 * Plugin URI:        rooftop-admin-theme
 * Description:       rooftop-admin-theme handles some basic tweaks to the Wordpress Admin UI, and adds some Rooftop specific features.
 * Version:           1.2.3
 * Author:            RooftopCMS
 * Author URI:        https://www.rooftopcms.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       rooftop-admin-theme
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rooftop-admin-theme-activator.php
 */
function activate_Rooftop_Admin_Theme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rooftop-admin-theme-activator.php';
	Rooftop_Admin_Theme_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rooftop-admin-theme-deactivator.php
 */
function deactivate_Rooftop_Admin_Theme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rooftop-admin-theme-deactivator.php';
	Rooftop_Admin_Theme_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Rooftop_Admin_Theme' );
register_deactivation_hook( __FILE__, 'deactivate_Rooftop_Admin_Theme' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rooftop-admin-theme.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Rooftop_Admin_Theme() {

	$plugin = new Rooftop_Admin_Theme();
	$plugin->run();

}
run_Rooftop_Admin_Theme();
