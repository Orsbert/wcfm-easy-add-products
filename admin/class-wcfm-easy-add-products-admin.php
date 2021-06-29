<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://orsbert.com
 * @since      1.0.0
 *
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wcfm_Easy_Add_Products
 * @subpackage Wcfm_Easy_Add_Products/admin
 * @author     Orsbert Ayesigye <hello@orsbert.com>
 */
class Wcfm_Easy_Add_Products_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcfm_Easy_Add_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcfm_Easy_Add_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wcfm-easy-add-products-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wcfm_Easy_Add_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wcfm_Easy_Add_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wcfm-easy-add-products-admin.js', array( 'jquery' ), $this->version, false );

	}

	// add plugin on admin menu
	public function amp_menu_option(){
		add_menu_page(
			'WFCM easy add products',
			'Easy add products',
			'manage_options',
			'wcfm-amp',
			'amp_admin_panel_page',
			'',
			200
		);

		
		
		function amp_admin_panel_page(){
			
			global $wpdb;

			$table_slugs_saved = $wpdb->prefix . "wcfm_amp_slugs_saved";
			$table_slugs_data = $wpdb->prefix . "wcfm_amp_slugs_data";

			// incase it is receiving data
			amp_update_options();

			$db_query = $wpdb->prepare(
				"SELECT * FROM $table_slugs_data"
			);

			$slugs_data = $wpdb->get_results($db_query);

			// echo "<br/><br/><br/>";
			
			// change to array to get un_shift functionality
			$slug_data = (array)$slug_data;

			// adding an empty column at the top
			array_unshift($slugs_data, (object)[
				'data_id'=> 'new',
				'product_slugs'=> '',
				'sizes'=> ''
			]);

			$content = '';

			// top part
			$content .= <<<EOT
				<div class='wrap'>
						<table class="amp_table">
							<thead>
								<tr>
									<th>Product category slug</th>
									<th>Sizes</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
			EOT;


			// table cells
			foreach ($slugs_data as $data) {

				// $product_slugs = implode($data['product_slugs'], ',');
				// $sizes = $data['sizes'];

				$content .= <<<EOT
							<tr>
								<form method='post'>
									<td>
										<input name='id' value='$data->data_id' type='hidden' >
										<input name='product_slugs' placeholder='boots,sneakers' value='$data->slugs'>
									</td>
									<td>
										<input name='sizes' placeholder='41|42|43' value='$data->sizes'>
									</td>
									<td>
										<input class='button' type='submit' value='save' name='amp_add_variable_form'>
									</td>
								<form/>
							<tr>
				EOT;
			}

			// bottom part
			$content .= <<<EOT
						</tbody>
					</table>
				</div>
			EOT;
			
			echo $content;
		}

		// update options
		function amp_update_options(){

			global $wpdb;

			$table_slugs_saved = $wpdb->prefix . "wcfm_amp_slugs_saved";
			$table_slugs_data = $wpdb->prefix . "wcfm_amp_slugs_data";

	
			if (isset($_POST['amp_add_variable_form'])){

				// validate data received
				if($_POST['product_slugs'] == null || $_POST['product_slugs'] == null){
					echo "<br/>
						<b>You have missing data</b>
					";
					return false;
				}


				$data_id = $_POST['id'];
				
				// is new
				if($data_id == 'new'){
					do {
						$new_id = rand(0, 10000);

						$result = $wpdb->query(
							"SELECT data_id FROM $table_slugs_data WHERE data_id = '$new_id'"
						);
						break;

					} while ($result->num_rows != 0);
	
					$data_id = $new_id;
				}

				$slug_data = json_encode([
					'slugs' => $_POST['product_slugs'],
					'sizes' => $_POST['sizes']
				]);

				// save slugs with their data id
				$slugs = explode(',', $_POST['product_slugs']);

				foreach ($slugs as $slug){

					$query_slugs_save = $wpdb->prepare(
						"REPLACE INTO $table_slugs_saved (slug,slug_data_id)
						VALUES
						('$slug', '$data_id')"
					);

					$success = $wpdb->query($query_slugs_save);

					if(!$success){
						echo '<br/><b>Error:</b> '.$wpdb->last_error .'.';
					}
		
				}
				
				// save the slug_data
				$query_slug_data = $wpdb->prepare(
					"REPLACE INTO `$table_slugs_data` (`data_id`,`slugs`,`sizes`)
					VALUES
					('$data_id','{$_POST['product_slugs']}','{$_POST['sizes']}')"
				);


				$wpdb->query($query_slug_data);

				if($success){
					echo '<br>
					<b>data has been saved</b>' ; 
				}
				else{
					echo '<br/><b>Error:</b> '.$wpdb->last_error .'.';
				}
	
			}
		}
		
	}


}

