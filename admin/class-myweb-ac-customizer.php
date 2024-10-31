<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Myweb_AC_Customizer {

	private $css_rules = array();
	private $css_code = '';

	public function get_customizer_fields() {
		$fields = array();

		$fields[] = array(
			'id' => 'ac_toolbar_icon',
			'title' => __( 'Toolbar Icon', 'myweb' ),
			'type' => 'select',
			'choices' => array(
				'wheelchair' => __( 'Wheelchair', 'myweb' ),
				'one-click' => __( 'One Click', 'myweb' ),
				'accessibility' => __( 'Accessibility', 'myweb' ),
			),
			'std' => 'wheelchair',
			'description' => __( 'Set Toolbar Icon', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_toolbar_position',
			'title' => __( 'Toolbar Position', 'myweb' ),
			'type' => 'select',
			'choices' => array(
				'left' => __( 'Left', 'myweb' ),
				'right' => __( 'Right', 'myweb' ),
			),
			'std' => is_rtl() ? 'right' : 'left',
			'description' => __( 'Set Toolbar Position', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_toolbar_distance_top',
			'title' => __( 'Offset from Top (Desktop)', 'myweb' ),
			'type' => 'text',
			'std' => '100px',
			'description' => __( 'Set Toolbar top offset (Desktop)', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_toolbar_distance_top_mobile',
			'title' => __( 'Offset from Top (Mobile)', 'myweb' ),
			'type' => 'text',
			'std' => '50px',
			'description' => __( 'Set Toolbar top offset (Mobile)', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_bg_toolbar',
			'title' => __( 'Toolbar Background', 'myweb' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#myweb-ac-toolbar .myweb-ac-toolbar-overlay',
			'change_type' => 'bg_color',
			'description' => __( 'Set Toolbar background color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_color_toolbar',
			'title' => __( 'Toolbar Color', 'myweb' ),
			'type' => 'color',
			'std' => '#333333',
			'selector' => '#myweb-ac-toolbar .myweb-ac-toolbar-overlay ul.myweb-ac-toolbar-items li.myweb-ac-toolbar-item a, #myweb-ac-toolbar .myweb-ac-toolbar-overlay p.myweb-ac-toolbar-title',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar text color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_toggle_button_bg_color',
			'title' => __( 'Toggle Button Background', 'myweb' ),
			'type' => 'color',
			'std' => '#1e73be',
			'description' => __( 'Set Toolbar toggle button background color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_toggle_button_bg_color_hover',
			'title' => __( 'Toggle Button Hover Background', 'myweb' ),
			'type' => 'color',
			'std' => '#1e73be',
			'description' => __( 'Set Toolbar toggle button hover background color', 'myweb-accessibility' ),
		);

		$fields[] = array(
			'id' => 'ac_toggle_button_color',
			'title' => __( 'Toggle Button Color', 'myweb' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#myweb-ac-toolbar .myweb-ac-toolbar-toggle a',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar toggle button icon color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_bg_active',
			'title' => __( 'Active Background', 'myweb' ),
			'type' => 'color',
			'std' => '#1e73be',
			'selector' => '#myweb-ac-toolbar .myweb-ac-toolbar-overlay ul.myweb-ac-toolbar-items li.myweb-ac-toolbar-item a.active',
			'change_type' => 'bg_color',
			'description' => __( 'Set Toolbar active background color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_color_active',
			'title' => __( 'Active Color', 'myweb' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#myweb-ac-toolbar .myweb-ac-toolbar-overlay ul.myweb-ac-toolbar-items li.myweb-ac-toolbar-item a.active',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar active text color', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_focus_outline_style',
			'title' => __( 'Focus Outline Style', 'myweb' ),
			'type' => 'select',
			'choices' => array(
				'solid' => __( 'Solid', 'myweb' ),
				'dotted' => __( 'Dotted', 'myweb' ),
				'dashed' => __( 'Dashed', 'myweb' ),
				'double' => __( 'Double', 'myweb' ),
				'groove' => __( 'Groove', 'myweb' ),
				'ridge' => __( 'Ridge', 'myweb' ),
				'outset' => __( 'Outset', 'myweb' ),
				'initial' => __( 'Initial', 'myweb' ),
			),
			'std' => 'solid',
			'description' => __( 'Set Focus outline style', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_focus_outline_width',
			'title' => __( 'Focus Outline Width', 'myweb' ),
			'type' => 'select',
			'choices' => array(
				'1px' => '1px',
				'2px' => '2px',
				'3px' => '3px',
				'4px' => '4px',
				'5px' => '5px',
				'6px' => '6px',
				'7px' => '7px',
				'8px' => '8px',
				'9px' => '9px',
				'10px' => '10px',
			),
			'std' => '1px',
			'description' => __( 'Set Focus outline width', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'ac_focus_outline_color',
			'title' => __( 'Focus Outline Color', 'myweb' ),
			'type' => 'color',
			'std' => '#FF0000',
			'description' => __( 'Set Focus outline color', 'myweb' ),
		);



		return $fields;
	}

	public function customize_ac( $wp_customize ) {
		$fields = $this->get_customizer_fields();

		$section_description = '<p>' . __( 'Use the control below to customize the appearance and layout of the Accessibility Toolbar', 'myweb' ) . '</p><p>' .
			sprintf( __( 'Additional Toolbar settings can be configured at the %s page.', 'myweb' ),
				'<a href="' . admin_url( 'admin.php?page=accessibility-toolbar' ) . '" target="blank">' . __( 'Accessibility Toolbar', 'myweb' ) . '</a>'
			) . '</p>';

		$wp_customize->add_section( 'accessibility', array(
			'title' => __( 'Accessibility', 'myweb' ),
			'priority'   => 30,
			'description' => $section_description,
		) );

		foreach ( $fields as $field ) {
			$customizer_id = MYWEB_AC_CUSTOMIZER_OPTIONS . '[' . $field['id'] . ']';
			$wp_customize->add_setting( $customizer_id, array(
				'default' => $field['std'] ? $field['std'] : null,
				'type' => 'option',
			) );
			switch ( $field['type'] ) {
				case 'color':
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field['id'], array(
						'label'    => $field['title'],
						'section'  => 'accessibility',
						'settings' => $customizer_id,
						'description' => isset( $field['description'] ) ? $field['description'] : null,
					) ) );
					break;
				case 'select':
				case 'text':
					$wp_customize->add_control( $field['id'], array(
						'label'    => $field['title'],
						'section'  => 'accessibility',
						'settings' => $customizer_id,
						'type'     => $field['type'],
						'choices'  => isset( $field['choices'] ) ? $field['choices'] : null,
						'description' => isset( $field['description'] ) ? $field['description'] : null,
					) );
					break;
			}
		}
	}

	public function get_custom_css_code() {
		$options = $this->get_customizer_options();
		$bg_color = $options['ac_toggle_button_bg_color']; // get_theme_mod( 'ac_toggle_button_bg_color', '#1e73be' );
		$bg_color_hover = $options['ac_toggle_button_bg_color_hover']; 
		if ( ! empty( $bg_color ) ) {
			$this->add_css_rule( '#myweb-ac-toolbar .myweb-ac-toolbar-toggle a', 'background-color', $bg_color );
			$this->add_css_rule( '#myweb-ac-toolbar .myweb-ac-toolbar-toggle a:hover, .myweb-ac-toolbar-open .myweb-ac-toolbar-toggle a', 'background-color', $bg_color_hover . ' !important' );
		}

		$outline_style = $options['ac_focus_outline_style']; //get_theme_mod( 'ac_focus_outline_style', 'solid' );
		if ( ! empty( $outline_style ) ) {
			$this->add_css_rule( 'body.myweb-ac-focusable a:focus', 'outline-style', $outline_style . ' !important' );
		}

		$outline_width = $options['ac_focus_outline_width']; // get_theme_mod( 'ac_focus_outline_width', '1px' );
		if ( ! empty( $outline_width ) ) {
			$this->add_css_rule( 'body.myweb-ac-focusable a:focus', 'outline-width', $outline_width . ' !important' );
		}

		$outline_color = $options['ac_focus_outline_color']; //get_theme_mod( 'ac_focus_outline_color', '#FF0000' );
		if ( ! empty( $outline_color ) ) {
			$this->add_css_rule( 'body.myweb-ac-focusable a:focus', 'outline-color', $outline_color . ' !important' );
		}

		$distance_top = $options['ac_toolbar_distance_top']; //get_theme_mod( 'ac_toolbar_distance_top', '100px' );
		if ( ! empty( $distance_top ) ) {
			$this->add_css_rule( '#myweb-ac-toolbar', 'top', $distance_top . ' !important' );
		}

		$distance_top_mobile = $options['ac_toolbar_distance_top_mobile']; // get_theme_mod( 'ac_toolbar_distance_top_mobile', '50px' );
		if ( ! empty( $distance_top_mobile ) ) {
			$this->add_css_code( "@media (max-width: 767px) { .myweb-ac-toolbar-toggle { top: {$distance_top_mobile} !important; } }" );
		}

		$fields = $this->get_customizer_fields();
		foreach ( $fields as $field ) {
			if ( empty( $field['selector'] ) || empty( $field['change_type'] ) ) {
				continue;
			}

			$option = $options[ $field['id'] ];

			if ( 'color' === $field['change_type'] ) {
				$this->add_css_rule( $field['selector'], 'color', $option );
			} elseif ( 'bg_color' === $field['change_type'] ) {
				$this->add_css_rule( $field['selector'], 'background-color', $option );
			}
		}
	}

	private function get_customizer_options() {
		static $options = false;
		if ( false === $options ) {
			$options = get_option( MYWEB_AC_CUSTOMIZER_OPTIONS );
		}
		return $options;
	}

	private function add_css_rule( $selector, $rule, $value ) {
		if ( ! isset( $this->css_rules[ $selector ] ) ) {
			$this->css_rules[ $selector ] = array();
		}
		$this->css_rules[ $selector ][] = $rule . ': ' . $value . ';';
	}

	private function add_css_code( $code ) {
		$this->css_code .= "\n" . $code;
	}

	public function print_css_code() {
		$this->get_custom_css_code();
		$css = '';
		foreach ( $this->css_rules as $selector => $css_rules ) {
			$css .= "\n" . $selector . '{ ' . implode( "\t", $css_rules ) . '}';
		}
		echo '<style type="text/css">' . $css . $this->css_code . '</style>';
	}

	public function __construct() {
		add_filter( 'customize_register', array( &$this, 'customize_ac' ), 610 );
		add_filter( 'wp_head', array( &$this, 'print_css_code' ) );
	}
}