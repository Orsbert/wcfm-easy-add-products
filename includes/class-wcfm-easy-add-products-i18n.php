<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://orsbert.com
 * @since      1.0.0
 *
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/includes
 * @author     Orsbert Ayesigye <hello@orsbert.com>
 */
class Wcfm_Easy_Add_Products_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wcfm-easy-add-products',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
