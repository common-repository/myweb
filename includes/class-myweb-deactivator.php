<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.myweb.co.il
 * @since      1.0.0
 *
 * @package    Myweb
 * @subpackage Myweb/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Myweb
 * @subpackage Myweb/includes
 * @author     MyWeb website development <neetaagrawal19@gmail.com>
 */
class Myweb_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		update_option('myweb_deactivated_plugin',1);
		$apiUrl = MYWEB_REMOTE_API_URL.'deactivate-plugin';
		$myweb_unique_id = get_option('myweb_unique_id');
		wp_remote_post($apiUrl, array(
			'body' =>array('unique_id' => $myweb_unique_id)
		) );
	}

}
