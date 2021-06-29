<?php

/**
 * Fired during plugin activation
 *
 * @link       https://orsbert.com
 * @since      1.0.0
 *
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/includes
 * @author     Orsbert Ayesigye <hello@orsbert.com>
 */
class Wcfm_Easy_Add_Products_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// create table if none exists

		global $wpdb;
		$table_slugs_saved = $wpdb->prefix . "wcfm_amp_slugs_saved";
		$table_slugs_data = $wpdb->prefix . "wcfm_amp_slugs_data";
		$my_products_db_version = '1.0.0';
		$charset_collate = $wpdb->get_charset_collate();

		if ( $wpdb->get_var("SHOW TABLES LIKE '{$table_slugs_saved}'") != $table_slugs_saved ) {

			// amp_slugs_saved
			$sql1 = "CREATE TABLE $table_slugs_saved (
				slug VARCHAR(225) NOT NULL,
				`slug_data_id` TEXT NOT NULL,
				PRIMARY KEY  (slug)
			) $charset_collate;";
			
			// amp_slugs_data
			$sql2 = "CREATE TABLE $table_slugs_data (
				data_id VARCHAR(225) NOT NULL,
				`slugs` TEXT NOT NULL,
				`sizes` TEXT NOT NULL,
				PRIMARY KEY  (data_id)
			) $charset_collate;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql1);
			dbDelta($sql2);
			add_option('my_db_version', $my_products_db_version);
		}

	}


}
