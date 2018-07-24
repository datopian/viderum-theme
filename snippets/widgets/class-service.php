<?php

/**
 * Template for Service widget
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */
class Service extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'widget_service', // Base ID
                esc_html__( 'Service', 'viderum' ), // Name
                array(
            'description' => esc_html__( 'Service item for landing page section.', 'viderum' ),
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
    public function widget($args, $instance) {

        echo wp_kses_post( $args[ 'before_widget' ] );

        echo '<div class="service-item">';
        if ( !empty( $instance[ 'title' ] ) ) {
            echo wp_kses_post( $args[ 'before_title' ] ) . wp_kses_post( apply_filters( 'widget_title', $instance[ 'title' ] ) ) . wp_kses_post( $args[ 'after_title' ] );
        }
        if ( !empty( $instance[ 'service_desc' ] ) ) {
            printf( '<p class="service-description">%s</p>', esc_html( apply_filters( 'widget_text', $instance[ 'service_desc' ] ) ) );
        }
        echo '<a href="' . ( isset( $instance[ 'service_link' ] ) ? esc_url( get_permalink( $instance[ 'service_link' ] ) ) : '#' ) . '" class="btn btn-lg btn-discover">' . __( 'More', 'viderum' ) . '</a>';
        echo '</div>';
        echo wp_kses_post( $args[ 'after_widget' ] );

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {

        $title = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $service_desc = !empty( $instance[ 'service_desc' ] ) ? $instance[ 'service_desc' ] : '';
        $service_link = !empty( $instance[ 'service_link' ] ) ? $instance[ 'service_link' ] : '';

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Name:', 'viderum' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'service_desc' ) ); ?>"><?php esc_attr_e( 'Description:', 'viderum' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'service_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'service_desc' ) ); ?>" class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea( $service_desc ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_url( $this->get_field_id( 'service_link' ) ); ?>"><?php esc_attr_e( 'Linked page:', 'viderum' ); ?></label>
            <?php

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
                <select name="<?php echo esc_attr( $this->get_field_name( 'service_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'service_link' ) ); ?>" class="widefat">
                    <option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ( $wp_pages as $page ) : ?>
                        <option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $service_link, $page->ID ); ?>>
                            <?php echo esc_html( $page->post_title ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php

            endif;

            ?>
        </p>
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
    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        $instance[ 'service_desc' ] = (!empty( $new_instance[ 'service_desc' ] ) ) ? strip_tags( $new_instance[ 'service_desc' ] ) : '';
        $instance[ 'service_link' ] = (!empty( $new_instance[ 'service_link' ] ) ) ? strip_tags( $new_instance[ 'service_link' ] ) : '';

        return $instance;

    }

}
