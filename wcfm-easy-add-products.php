<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://orsbert.com
 * @since             1.0.0
 * @package           Wcfm_Easy_Add_Products
 *
 * @wordpress-plugin
 * Plugin Name:       WCFM - easy add products
 * Plugin URI:        https://plugins.orsbert.com/wcfm-easy-add-products
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Orsbert Ayesigye
 * Author URI:        https://orsbert.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcfm-easy-add-products
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCFM_EASY_ADD_PRODUCTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wcfm-easy-add-products-activator.php
 */
function activate_wcfm_easy_add_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcfm-easy-add-products-activator.php';
	Wcfm_Easy_Add_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wcfm-easy-add-products-deactivator.php
 */
function deactivate_wcfm_easy_add_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcfm-easy-add-products-deactivator.php';
	Wcfm_Easy_Add_Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wcfm_easy_add_products' );
register_deactivation_hook( __FILE__, 'deactivate_wcfm_easy_add_products' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wcfm-easy-add-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcfm_easy_add_products() {

	$plugin = new Wcfm_Easy_Add_Products();
	$plugin->run();

}
run_wcfm_easy_add_products();
