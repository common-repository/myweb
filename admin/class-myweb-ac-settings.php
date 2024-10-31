<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Myweb_AC_Settings {

	public $menu_slug = null;

	const PAGE_ID = 'myweb-ac';
	const SETTINGS_PAGE = 'toplevel_page_accessibility-settings';
	const TOOLBAR_PAGE = 'accessibility_page_accessibility-toolbar';
	const FIELD_TEXT     = 'text';
	const FIELD_SELECT   = 'select';
	const FIELD_CHECKBOX_LIST = 'checkbox_list';
	const FIELD_TEXT_AREA = 'textarea';

	protected $_fields = array();

	protected $_sections = array();
	protected $_defaults = array();
	protected $_pages    = array();


	/**
	 * Setup Toolbar fields
	 *
	 * @param array $sections
	 *
	 * @return array
	 */
	public function section_ac_toolbar( $sections = array() ) {
		$fields = array();

		$fields[] = array(
			'id' => 'myweb_ac_toolbar',
			'title' => __( 'Display Toolbar', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'options' => array(
				'enable' => __( 'Show on all devices', 'myweb' ),
				'visible-desktop' => __( 'Visible Desktop', 'myweb' ),
				'visible-tablet' => __( 'Visible Tablet', 'myweb' ),
				'visible-phone' => __( 'Visible Phone', 'myweb' ),
				'hidden-desktop' => __( 'Hidden Desktop', 'myweb' ),
				'hidden-tablet' => __( 'Hidden Tablet', 'myweb' ),
				'hidden-phone' => __( 'Hidden Phone', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$toolbar_options_classes = 'myweb-ac-toolbar-button';

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_title',
			'title' => __( 'Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'desc' => __( 'Title top of the toolbar (recommended).', 'myweb' ),
			'class' => $toolbar_options_classes,
			'std' => __( 'Accessibility Tools', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_resize_font',
			'title' => __( 'Resize Font', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_resize_font_add_title',
			'title' => __( 'Increase Text', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row no-border',
			'std' => __( 'Increase Text', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_resize_font_less_title',
			'title' => __( 'Decrease Text', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Decrease Text', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_grayscale',
			'title' => __( 'Grayscale', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_grayscale_title',
			'title' => __( 'Grayscale Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Grayscale', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_high_contrast',
			'title' => __( 'High Contrast', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_high_contrast_title',
			'title' => __( 'High Contrast Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'High Contrast', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_negative_contrast',
			'title' => __( 'Negative Contrast', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_negative_contrast_title',
			'title' => __( 'Negative Contrast Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Negative Contrast', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_light_bg',
			'title' => __( 'Light Background', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_light_bg_title',
			'title' => __( 'Light Background Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Light Background', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_links_underline',
			'title' => __( 'Links Underline', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_links_underline_title',
			'title' => __( 'Links Underline Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Links Underline', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_readable_font',
			'title' => __( 'Readable Font', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'class' => $toolbar_options_classes,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_readable_font_title',
			'title' => __( 'Readable Font Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => __( 'Readable Font', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_sitemap_title',
			'title' => __( 'Sitemap Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes,
			'std' => __( 'Sitemap', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_sitemap_link',
			'title' => __( 'Sitemap Link', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'placeholder' => 'http://your-domain.com/sitemap',
			'desc' => __( 'Link for sitemap page in your website. Leave blank to disable.', 'myweb' ),
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => '',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_help_title',
			'title' => __( 'Help Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes,
			'std' => __( 'Help', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_help_link',
			'title' => __( 'Help Link', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'placeholder' => 'http://your-domain.com/help',
			'desc' => __( 'Link for help page in your website. Leave blank to disable.', 'myweb' ),
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => '',
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_feedback_title',
			'title' => __( 'Feedback Title', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'class' => $toolbar_options_classes,
			'std' => __( 'Feedback', 'myweb' ),
		);

		$fields[] = array(
			'id' => 'myweb_ac_toolbar_button_feedback_link',
			'title' => __( 'Feedback Link', 'myweb' ),
			'type' => self::FIELD_TEXT,
			'placeholder' => 'http://your-domain.com/feedback',
			'desc' => __( 'Link for feedback page in your website. Leave blank to disable.', 'myweb' ),
			'class' => $toolbar_options_classes . ' myweb-settings-child-row',
			'std' => '',
		);

		$fields[] = array(
			'id' => 'myweb_ac_statement',
			'title' => __( 'Statement popup', 'myweb' ),
			'desc' => __( 'Text inside statement popup', 'myweb' ),
			'type' => self::FIELD_TEXT_AREA,
			'std' => 'This Website is committed to ensuring digital accessibility for people with disabilities. We are continually improving the user experience for everyone, and applying the relevant accessibility standards.
			<b>Conformance status</b>
			The Web Content Accessibility Guidelines (WCAG) defines requirements for designers and developers to improve accessibility for people with disabilities. It defines three levels of conformance: Level A, Level AA, and Level AAA.  This website is non conformant with another standard. Non conformantmeans that the content does not conform the accessibility standard.
			<b>Accessibility Statement</b>',
		);

		$sections[] = array(
			'id' => 'section-ac-toolbar',
			'page' => self::TOOLBAR_PAGE,
			'title' => __( 'Toolbar Settings', 'myweb' ),
			'intro' => '',
			'fields' => $fields,
		);

		$sections[] = array(
			'id' => 'section-ac-styles',
			'page' => self::TOOLBAR_PAGE,
			'title' => __( 'Style Settings', 'myweb' ),
			'intro' => sprintf( __( 'For style settings of accessibility tools go to > Customize > <a href="%s">Accessibility</a>.', 'myweb' ), $this->get_admin_url( 'customizer' ) ),
			'fields' => array(),
		);

		return $sections;
	}

	public function section_ac_settings( $sections ) {
		$fields = array();

		$fields[] = array(
			'id' => 'myweb_ac_focusable',
			'title' => __( 'Add Outline Focus', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'desc' => __( 'Add outline to elements on keyboard focus.', 'myweb' ),
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'disable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_skip_to_content_link',
			'title' => __( 'Skip to Content link', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'desc' => __( 'Add skip to content link when using keyboard.', 'myweb' ),
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_remove_link_target',
			'title' => __( 'Remove target attribute from links', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'desc' => __( 'This option will reset all your target links to open in the same window or tab.', 'myweb' ),
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'disable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_add_role_links',
			'title' => __( 'Add landmark roles to all links', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'desc' => __( 'This option will add <code>role="link"</code> to all links on the page.', 'myweb' ),
            'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		$fields[] = array(
			'id' => 'myweb_ac_save',
			'title' => __( 'Sitewide Accessibility', 'myweb' ),
			'desc' => __( 'Consistent accessibility throughout your site visit. Site remembers you and stays accessible.', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'options' => array(
				'enable' => __( 'Enable', 'myweb' ),
				'disable' => __( 'Disable', 'myweb' ),
			),
			'std' => 'enable',
		);

		
		$fields[] = array(
			'id' => 'myweb_ac_save_expiration',
			'title' => __( 'Remember user for', 'myweb' ),
			'type' => self::FIELD_SELECT,
			'desc' => __( 'Define how long your toolbar settings will be remembered', 'myweb' ),
			'options' => array(
				'1' => __( '1 Hour', 'myweb' ),
				'6' => __( '6 Hours', 'myweb' ),
				'12' => __( '12 Hours', 'myweb' ),
				'24' => __( '1 Day', 'myweb' ),
				'48' => __( '2 Days', 'myweb' ),
				'72' => __( '3 Days', 'myweb' ),
				'168' => __( '1 Week', 'myweb' ),
				'720' => __( '1 Month', 'myweb' ),
			),
			'std' => '12',
		);

		$sections[] = array(
			'id' => 'section-ac-settings',
			'page' => self::SETTINGS_PAGE,
			'title' => __( 'General Settings', 'myweb' ),
			'intro' => '',
			'fields' => $fields,
		);

		return $sections;
	}

	public function print_js() {
		// TODO: Maybe need to move to other file
		?>
		<script>
			jQuery( document ).ready( function( $ ) {
				var $acToolbarOption = $( 'table.form-table #myweb_ac_toolbar' ),
					$acToolbarButtons = $( 'tr.myweb-ac-toolbar-button' );
				
				$acToolbarOption.on( 'change', function() {
					if ( 'disable' !== $( this ).val() ) {
						$acToolbarButtons.fadeIn( 'fast' );
					} else {
						$acToolbarButtons.hide();
					}
				} );
				$acToolbarOption.trigger( 'change' );
			} );
		</script>
		<?php
	}

	public function get_settings_sections() {
		$sections  = array();
		$sections = $this->section_ac_toolbar( $sections );
		$sections = $this->section_ac_settings( $sections );
		$this->_sections = $sections;
		return $this->_sections;
	}

	public function add_settings_section( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'id' => '',
			'title' => '',
		) );

		foreach ( $this->_sections as $section ) {
			if ( $args['id'] !== $section['id'] ) {
				continue;
			}
			if ( empty( $section['intro'] ) ) {
				return;
			}
			printf( '<p>%s</p>', $section['intro'] );
			break;
		}
	}

	public function add_settings_field( $args = array() ) {
		if ( empty( $args ) ) {
			return;
		}

		$args = wp_parse_args( $args, array(
			'id' => '',
			'std' => '',
			'type' => self::FIELD_TEXT,
		) );

		if ( empty( $args['id'] ) || empty( $args['type'] ) ) {
			return;
		}

		$field_callback = 'render_' . $args['type'] . '_field';
		if ( method_exists( $this, $field_callback ) ) {
			call_user_func( array( $this, $field_callback ), $args );
		}
	}

	public function render_select_field( $field ) {
		$options = array();
		foreach ( $field['options'] as $option_key => $option_value ) {
			$options[] = sprintf(
				'<option value="%1$s"%2$s>%3$s</option>',
				esc_attr( $option_key ),
				selected( get_option( $field['id'], $field['std'] ), $option_key, false ),
				$option_value
			);
		}
		?>
        <select id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>">
			<?php echo implode( '', $options ); ?>
        </select>
		<?php if ( ! empty( $field['sub_desc'] ) ) echo $field['sub_desc']; ?>
		<?php if ( ! empty( $field['desc'] ) ) : ?>
            <p class="description"><?php echo $field['desc']; ?></p>
		<?php endif; ?>
		<?php
	}

	public function render_text_field( $field ) {
		if ( empty( $field['classes'] ) )
			$field['classes'] = array( 'regular-text' );
		?>
        <input type="text" class="<?php echo implode( ' ', $field['classes'] ); ?>" id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>" value="<?php echo esc_attr( get_option( $field['id'], $field['std'] ) ); ?>"<?php echo ! empty( $field['placeholder'] ) ? ' placeholder="' . $field['placeholder'] . '"' : ''; ?> />
		<?php if ( ! empty( $field['sub_desc'] ) ) echo $field['sub_desc']; ?>
		<?php if ( ! empty( $field['desc'] ) ) : ?>
            <p class="description"><?php echo $field['desc']; ?></p>
		<?php endif; ?>
		<?php
	}

	public function render_textarea_field( $field ) {
		if ( empty( $field['classes'] ) )
			$field['classes'] = array( 'regular-text' );
		?>
        <textarea class="<?php echo implode( ' ', $field['classes'] ); ?>" id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>" value=""<?php echo ! empty( $field['placeholder'] ) ? ' placeholder="' . $field['placeholder'] . '"' : ''; ?> ><?php echo esc_attr( get_option( $field['id'], $field['std'] ) ); ?></textarea>
		<?php if ( ! empty( $field['sub_desc'] ) ) echo $field['sub_desc']; ?>
		<?php if ( ! empty( $field['desc'] ) ) : ?>
            <p class="description"><?php echo $field['desc']; ?></p>
		<?php endif; ?>
		<?php
	}

	public function admin_init() {
		foreach ( $this->get_settings_sections() as $section_key => $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				array( &$this, 'add_settings_section' ),
				$section['page']
			);

			if ( empty( $section['fields'] ) ) {
				continue;
			}

			foreach ( $section['fields'] as $field ) {
				add_settings_field(
					$field['id'],
					$field['title'],
					array( &$this, 'add_settings_field' ),
					$section['page'],
					$section['id'],
					$field
				);

				$sanitize_callback = array( $this, 'field_html' );
				if ( ! empty( $field['type'] ) && self::FIELD_CHECKBOX_LIST === $field['type'] ) {
					$sanitize_callback = array( $this, 'field_checkbox_list' );
				}
				if ( ! empty( $field['sanitize_callback'] ) ) {
					$sanitize_callback = $field['sanitize_callback'];
				}

				register_setting( $section['page'], $field['id'], $sanitize_callback );
			}
		}
	}

	public static function field_html( $input ) {
		return stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
	}

	public static function field_checkbox_list( $input ) {
		if ( empty( $input ) ) {
			$input = array();
		}

		return $input;
	}

	public function display_settings_page() {
		$screen = get_current_screen();
		$screen_id = $screen->id;
		if ( false !== strpos( $screen_id, 'toolbar' ) ) {
			$screen_id = self::TOOLBAR_PAGE;
		}
		?>
		<div class="wrap">
			<h2><?php echo $this->_page_title; ?></h2>
			<?php settings_errors( $screen_id ); ?>
			<form method="post" action="options.php">
				<?php
				settings_fields( $screen_id );
				do_settings_sections( $screen_id );

				submit_button();
				?>
			</form>

		</div><!-- /.wrap -->
		<?php
	}

	public function admin_menu() {
		$this->menu_slug = add_menu_page(
			__( 'Accessibility', 'myweb' ),
			__( 'Accessibility', 'myweb' ),
			'manage_options',
			'accessibility-settings',
			array( &$this, 'display_settings_page' ),
			'dashicons-admin-appearance'
		);
		add_submenu_page(
			'accessibility-settings',
			__( 'Accessibility Settings', 'myweb' ),
			__( 'Settings', 'myweb' ),
			'manage_options',
			'accessibility-settings',
			array( &$this, 'display_settings_page' )
		);
		add_submenu_page(
			'accessibility-settings',
			__( 'Accessibility Toolbar', 'myweb' ),
			__( 'Toolbar', 'myweb' ),
			'manage_options',
			'accessibility-toolbar',
			array( &$this, 'display_settings_page' )
		);
		add_submenu_page(
			'accessibility-settings',
			__( 'Customize', 'myweb' ),
			__( 'Customize', 'myweb' ),
			'manage_options',
			'/customize.php?autofocus[section]=accessibility'
		);
	}

	public function plugin_action_links( $links, $plugin_file ) {
		if ( MYWEB_AC_BASE === $plugin_file ) {
			$settings = '<a href="' . $this->get_admin_url( 'general' ) . '" aria-label="' . esc_attr__( 'Set Accessibility settings', 'myweb' ) . '">' . __( 'Settings', 'myweb' ) . '</a>';
			$toolbar = '<a href="' . $this->get_admin_url( 'toolbar' ) . '" aria-label="' . esc_attr__( 'Set Accessibility Toolbar Settings', 'myweb' ) . '">' . __( 'Toolbar', 'myweb' ) . '</a>';
			$customizer = '<a href="' . $this->get_admin_url( 'customizer' ) . '" aria-label="' . esc_attr__( 'Customize Toolbar', 'myweb' ) . '" target="_blank">' . __( 'Customize', 'myweb' ) . '</a>';
			array_unshift( $links, $customizer );
			array_unshift( $links, $toolbar );
			array_unshift( $links, $settings );
		}
		return $links;
	}

	private function get_admin_url( $type ) {
		switch ( $type ) {
			case 'customizer':
				return admin_url( 'customize.php?autofocus[section]=accessibility' );
				break;
			case 'general':
				return admin_url( 'admin.php?page=accessibility-settings' );
				break;
			case 'toolbar':
				return admin_url( 'admin.php?page=accessibility-toolbar' );
				break;
		}
	}

	private function get_default_values() {
		if ( empty( $this->_defaults ) ) {
			if ( empty( $this->_sections ) ) {
				$this->get_settings_sections();
			}
			$defaults = array();
			foreach ( $this->_sections as $section ) {
				foreach ( $section['fields'] as $field ) {
					$defaults[ $field['id'] ] = isset( $field['std'] ) ? $field['std'] : '';
				}
			}
			$this->_defaults = $defaults;
		}
	}

	public function get_default_title_text( $option ) {
		$this->get_default_values();
		$default = isset( $this->_defaults[ $option ] ) ? $this->_defaults[ $option ] : '';

		return get_option( $option, $default );
	}

	public function get_default_statement_text( $option ) {
		return get_option( $option, $default );
	}

	public function __construct() {
		$this->_page_title = __( 'Wordpress Accessibility', 'myweb' );
		$this->_page_menu_title = __( 'Wordpress Accessibility', 'myweb' );
		$this->_menu_parent = 'themes.php';

		add_action( 'admin_menu', array( &$this, 'admin_menu' ), 20 );
		add_action( 'admin_init', array( &$this, 'admin_init' ), 20 );
		add_action( 'admin_footer', array( &$this, 'print_js' ) );
		add_filter( 'plugin_action_links_' . MYWEB_AC_BASE, [ $this, 'plugin_action_links' ], 10, 2 );
	}
}