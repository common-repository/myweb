<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.myweb.co.il
 * @since      1.0.0
 *
 * @package    Myweb
 * @subpackage Myweb/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Myweb
 * @subpackage Myweb/includes
 * @author     MyWeb website development <neetaagrawal19@gmail.com>
 */
class Myweb {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Myweb_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	public $settings;
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MYWEB_VERSION' ) ) {
			$this->version = MYWEB_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'myweb';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Myweb_Loader. Orchestrates the hooks of the plugin.
	 * - Myweb_i18n. Defines internationalization functionality.
	 * - Myweb_Admin. Defines all hooks for the admin area.
	 * - Myweb_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-myweb-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-myweb-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-myweb-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-myweb-ac-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-myweb-ac-customizer.php';
		$this->settings = new Myweb_AC_Settings();
		$this->customizer = new Myweb_AC_Customizer();
		if ( false === get_option( MYWEB_AC_CUSTOMIZER_OPTIONS, false ) ) {
			$customizer_fields = $this->customizer->get_customizer_fields();
			$options = array();
			$mods = get_theme_mods();
			foreach ( $customizer_fields as $field ) {
				if ( isset( $mods[ $field['id'] ] ) ) {
					$options[ $field['id'] ] = $mods[ $field['id'] ];
				} else {
					$options[ $field['id'] ] = $field['std'];
				}
			}
			update_option( MYWEB_AC_CUSTOMIZER_OPTIONS, $options );
		}
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-myweb-public.php';

		$this->loader = new Myweb_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Myweb_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Myweb_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Myweb_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Myweb_Public( $this->get_plugin_name(), $this->get_version(), $this->get_settings() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'elementor/init', $plugin_public, 'add_elementor_support' );
		$this->loader->add_action( 'init', $plugin_public, 'apiCallandSetTextUrl' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'print_skip_to_content_link',30 );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'print_toolbar',30 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Myweb_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	public function get_settings() {
		return $this->settings;
	}

}
