<?php
/**
 * Template snippet for custom theme settings
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

/**
 * Theme class used to implement custom theme settings.
 */
class Viderum_Theme_Settings {

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @var [type]
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'viderum_settings_page_init' ) );

	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// Theme settings page will be added under "Settings".
		add_theme_page(
			get_bloginfo( 'name' ), get_bloginfo( 'name' ), 'edit_theme_options', 'viderum-settings', array( $this, 'viderum_settings_page' )
		);

	}

	/**
	 * Options page callback
	 */
	public function viderum_settings_page() {

		// Set class property.
		$this->options = get_option( 'viderum_settings' );

		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Viderum Settings', 'viderum' ); ?></h1>
			<form method="post" action="options.php">
				<?php

				// Print out all hidden setting fields.
				settings_fields( 'viderum_option_group' );
				do_settings_sections( 'viderum-setting-admin' );
				submit_button();

				?>
			</form>
		</div>
		<?php

	}

	/**
	 * Register and add settings
	 */
	public function viderum_settings_page_init() {
		register_setting(
			'viderum_option_group', 'viderum_settings', array( $this, 'sanitize' )
		);

		add_settings_section(
			'setting_section_id', false, array( $this, 'section_description' ), 'viderum-setting-admin'
		);

		add_settings_field(
			'ga_tracking_id', __( 'Google Analytics Tracking ID', 'viderum' ), array( $this, 'google_analytics_tracking_id_callback' ), 'viderum-setting-admin', 'setting_section_id'
		);

		add_settings_field(
			'gsc_verification_id', __( 'Google Search Console ID', 'viderum' ), array( $this, 'google_search_console_verification_id_callback' ), 'viderum-setting-admin', 'setting_section_id'
		);

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input - Contains all settings fields as array keys.
	 */
	public function sanitize( $input ) {
		$new_input = array();

		if ( isset( $input['ga_tracking_id'] ) ) {
			$new_input['ga_tracking_id'] = sanitize_text_field( $input['ga_tracking_id'] );
		}

		if ( isset( $input['gsc_verification_id'] ) ) {
			$new_input['gsc_verification_id'] = sanitize_text_field( $input['gsc_verification_id'] );
		}

		return $new_input;

	}

	/**
	 * Print the Section text
	 */
	public function section_description() {
		printf( '<p>%s</p>', esc_html__( 'A list of customizable theme-specific settings', 'viderum' ) );

	}

	/**
	 * Google Analytics tracking ID input
	 */
	public function google_analytics_tracking_id_callback() {
		printf(
			'<input type="text" id="ga_tracking_id" name="viderum_settings[ga_tracking_id]" value="%s" />', isset( $this->options['ga_tracking_id'] ) ? esc_attr( $this->options['ga_tracking_id'] ) : ''
		);

	}

	/**
	 * Google Search Console verification ID input
	 */
	public function google_search_console_verification_id_callback() {
		printf(
			'<input type="text" id="gsc_verification_id" name="viderum_settings[gsc_verification_id]" value="%s" />', isset( $this->options['gsc_verification_id'] ) ? esc_attr( $this->options['gsc_verification_id'] ) : ''
		);

	}

}

if ( is_admin() ) {
	$viderum_settings = new Viderum_Theme_Settings();
}
