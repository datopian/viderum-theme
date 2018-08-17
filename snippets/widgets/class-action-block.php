<?php
/**
 * Template for Action_Block widget
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

/**
 * Action Block widget class
 */
class Action_Block extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'widget_viderum_action_block', // Base ID
			esc_html__( 'Action Block', 'viderum' ), // Name
			array(
				'description' => esc_html__( 'Action Block with a title and buttons.', 'viderum' ),
			) // Args
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] );
			echo esc_html( $instance['title'] );
			echo wp_kses_post( $args['after_title'] );
		}

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu,
		);

		/**
		 * Filters the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 * @since 4.4.0 Added the `$instance` parameter.
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param WP_Term  $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 * @param array    $instance      Array of settings for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

		echo wp_kses_post( $args['after_widget'] );

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title    = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		?>
		<p class="nav-menu-widget-no-menus-message"
		<?php

		if ( ! empty( $menus ) ) {
			echo ' style="display:none" ';
		}

		?>
		   >
				<?php

				if ( $wp_customize instanceof WP_Customize_Manager ) {
					$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
				} else {
					$url = admin_url( 'nav-menus.php' );
				}

				// translators: The no-menus-have-been-created notice within the Call to Action widget.
				echo sprintf( esc_html__( 'No menus have been created yet. <a href="%s">Create some</a>.', 'viderum' ), esc_attr( $url ) );

				?>
		</p>
		<div class="nav-menu-widget-form-controls"
		<?php

		if ( empty( $menus ) ) {
			echo ' style="display:none" ';
		}

		?>
			 >
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Call to Action title:', 'viderum' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'WordPress menu:', 'viderum' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="
				<?php

				if ( ! $nav_menu ) {
					echo 'display: none;';
				}

				?>
				   ">
					<button type="button" class="button"><?php esc_html_e( 'Edit Menu' ); ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;

	}

}
