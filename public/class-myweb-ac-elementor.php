<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Myweb_AC_Elementor {

	public function is_toolbar_active( $is_active ) {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$is_active = false;
		}

		return $is_active;
	}

	public function __construct() {
		add_filter( 'myweb_ac_frontend_is_toolbar_active', [ $this, 'is_toolbar_active' ] );
	}
}
