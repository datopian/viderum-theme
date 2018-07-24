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
                'hero_title', __( 'Hero title', 'viderum' ), array( $this, 'hero_title_callback' ), 'viderum-setting-admin', 'setting_section_id'
        );

        add_settings_field(
                'hero_description', __( 'Hero description', 'viderum' ), array( $this, 'hero_description_callback' ), 'viderum-setting-admin', 'setting_section_id'
        );

        add_settings_field(
                'hero_link', __( 'Hero button link', 'viderum' ), array( $this, 'hero_link_callback' ), 'viderum-setting-admin', 'setting_section_id'
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
    public function sanitize($input) {
        $new_input = array();

        if ( isset( $input[ 'hero_title' ] ) ) {
            $new_input[ 'hero_title' ] = sanitize_text_field( $input[ 'hero_title' ] );
        }

        if ( isset( $input[ 'hero_description' ] ) ) {
            $new_input[ 'hero_description' ] = sanitize_textarea_field( $input[ 'hero_description' ] );
        }

        if ( isset( $input[ 'hero_link' ] ) ) {
            $new_input[ 'hero_link' ] = sanitize_text_field( $input[ 'hero_link' ] );
        }

        if ( isset( $input[ 'ga_tracking_id' ] ) ) {
            $new_input[ 'ga_tracking_id' ] = sanitize_text_field( $input[ 'ga_tracking_id' ] );
        }

        if ( isset( $input[ 'gsc_verification_id' ] ) ) {
            $new_input[ 'gsc_verification_id' ] = sanitize_text_field( $input[ 'gsc_verification_id' ] );
        }

        return $new_input;

    }

    /**
     * Print the Section text
     */
    public function section_description() {
        printf( '<p>%s</p>', esc_html__( 'A list of customizable theme-specific settings', 'viderum' ) );

    }

    /*
     * Hero title input
     */

    public function hero_title_callback() {
        printf(
                '<input class="large-text" type="text" id="hero_title" name="viderum_settings[hero_title]" value="%s" />', isset( $this->options[ 'hero_title' ] ) ? esc_attr( $this->options[ 'hero_title' ] ) : ''
        );

    }

    /**
     * Hero description textarea
     */
    public function hero_description_callback() {
        printf(
                '<textarea class="large-text" id="hero_description" name="viderum_settings[hero_description]" rows="10">%s</textarea>', isset( $this->options[ 'hero_description' ] ) ? esc_textarea( $this->options[ 'hero_description' ] ) : ''
        );

    }

    public function hero_link_callback() {

        $wp_pages = get_posts(
                array(
                    'post_type' => 'page',
                    'nopaging' => 1,
                    'order' => 'ASC',
                    'orderby' => 'title',
                )
        );

        if ( $wp_pages ) :

            ?>
            <select name="viderum_settings[hero_link]" id="hero_link">
                <option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
                <?php foreach ( $wp_pages as $page ) : ?>
                    <option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $this->options[ 'hero_link' ], $page->ID ); ?>>
                        <?php echo esc_html( $page->post_title ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php

        else:
            printf( "<p>%s</p>", __( 'No pages available for selection', 'viderum' ) );
        endif;

    }

    /**
     * Google Analytics tracking ID input
     */
    public function google_analytics_tracking_id_callback() {
        printf(
                '<input type="text" id="ga_tracking_id" name="viderum_settings[ga_tracking_id]" value="%s" />', isset( $this->options[ 'ga_tracking_id' ] ) ? esc_attr( $this->options[ 'ga_tracking_id' ] ) : ''
        );

    }

    /**
     * Google Search Console verification ID input
     */
    public function google_search_console_verification_id_callback() {
        printf(
                '<input type="text" id="gsc_verification_id" name="viderum_settings[gsc_verification_id]" value="%s" />', isset( $this->options[ 'gsc_verification_id' ] ) ? esc_attr( $this->options[ 'gsc_verification_id' ] ) : ''
        );

    }

}

if ( is_admin() ) {
    $viderum_settings = new Viderum_Theme_Settings();
}
