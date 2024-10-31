<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.myweb.co.il
 * @since      1.0.0
 *
 * @package    Myweb
 * @subpackage Myweb/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Myweb
 * @subpackage Myweb/includes
 * @author     MyWeb website development <neetaagrawal19@gmail.com>
 */
class Myweb_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$myweb_deactivated_plugin = get_option('myweb_deactivated_plugin');
		if(isset($myweb_deactivated_plugin)){
			$apiUrl = MYWEB_REMOTE_API_URL.'activate-plugin';
			$myweb_unique_id = get_option('myweb_unique_id');
			wp_remote_post($apiUrl, array(
				'body' =>array('unique_id' => $myweb_unique_id)
			) );
			delete_option('myweb_deactivated_plugin');
		}
	}

}
