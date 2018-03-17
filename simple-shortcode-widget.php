<?php

/*
Plugin Name: Code Widget
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0.0
Author: Sharaz Ghouri
Author URI: http://URI_Of_The_Plugin_Author
Text Domain: code-widget
Domain Path: /languages/
License: A "Slug" license name e.g. GPL2
*/

define( 'CW_VERSION', '1.0.0' );
define( 'CW_TEXT_DOMAIN', 'code-widget' );
define( 'SSW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Adds Code_Widget.
 */
class Code_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		load_plugin_textdomain( CW_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) );
		parent::__construct(
			'cond-widget', // Base ID
			esc_html__( 'Code Widget', CW_TEXT_DOMAIN ), // Name
			array( 'description' => esc_html__( 'Any Text,Short Code,HTML,PHP Code .', CW_TEXT_DOMAIN ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo esc_html__( 'Hello, World!', CW_TEXT_DOMAIN );
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', CW_TEXT_DOMAIN );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', CW_TEXT_DOMAIN ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cw_type' ) ); ?>"><?php esc_attr_e( 'Widget Type:', CW_TEXT_DOMAIN ); ?></label>
        </p>
	<select class="widefat" name="<?php echo  esc_attr( $this->get_field_name( 'cw_type' ) )?>" id="<?php echo esc_attr( $this->get_field_id( 'cw_type' ) ); ?>" >
     <option value="short_code"> Short Code </option>
     <option value="php_code"> PHP Code </option>
     <option value="php_code"> Text </option>
     <option value="text_code"> HTML </option>
    </select>
        <p>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'cw_co    ntent' ); ?>"
                  name="<?php echo $this->get_field_name( 'cw_content' ); ?>"><?php echo 'Sharaz'; ?></textarea>
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
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Code_Widget

/**
 * Simple short code widget
 */
function register_code_widget() {
	register_widget( 'Code_Widget' );
}

add_action( 'widgets_init', 'register_code_widget' );




