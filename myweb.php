<?php

/**
 * Plugin Name: MyWeb
 * Plugin URI: https://wordpress.org/plugins/MyWeb
 * Description: MyWeb plugin is the fastest plugin to help you make your website more accessible.
 * Version: 1.2
 * Author: MyWeb website development
 * Author URI: https://www.myweb.co.il
 * Text Domain: myweb
 * Domain Path: /languages
 * License: GPL2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MYWEB_VERSION', '1.2' );
define( 'MYWEB_AC__FILE__', __FILE__ );
define( 'MYWEB_AC_BASE', plugin_basename( MYWEB_AC__FILE__ ) );
define( 'MYWEB_AC_URL', plugins_url( '/', MYWEB_AC__FILE__ ) );
define( 'MYWEB_AC_ASSETS_PATH', plugin_dir_path( MYWEB_AC__FILE__ ) . 'public/assets/' );
define( 'MYWEB_AC_LANG_PATH', plugin_basename(dirname( MYWEB_AC__FILE__ )) . '/lang/' );
define( 'MYWEB_AC_ASSETS_URL', MYWEB_AC_URL . 'public/assets/' );
define( 'MYWEB_AC_CUSTOMIZER_OPTIONS', 'myweb_ac_customizer_options' );
define( 'MYWEB_REMOTE_API_URL', 'http://phpstack-490434-1547168.cloudwaysapps.com/' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-myweb-activator.php
 */
function activate_myweb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-myweb-activator.php';
	Myweb_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-myweb-deactivator.php
 */
function deactivate_myweb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-myweb-deactivator.php';
	Myweb_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_myweb' );
register_deactivation_hook( __FILE__, 'deactivate_myweb' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-myweb.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_myweb() {

	$plugin = new Myweb();
	$plugin->run();

}
run_myweb();
