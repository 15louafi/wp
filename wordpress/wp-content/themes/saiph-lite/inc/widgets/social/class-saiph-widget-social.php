<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Saiph_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'Social links', 'saiph-lite' ) );

		parent::__construct( false, __( 'Saiph Social', 'saiph-lite' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		if ( empty( $params['widget-title'] ) ) {
			$params['widget-title'] = '';
		}
		
		$title = $before_title . $params['widget-title'] . $after_title;
		unset( $params['widget-title'] );

		$filepath = dirname( __FILE__ ) . '/views/widget.php';

		$instance      = $params;
		$before_widget = str_replace( 'class="', 'class="widget_social_links ', $before_widget );

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );

		$sanitized = array();
		foreach ($instance as $key => $value) {
			if($key == 'widget-title'){
				$sanitized['widget-title'] = esc_attr($value);
			} else {
				$sanitized[$key] = esc_url_raw($value);
			}
		}

		return $sanitized;
	}

	function form( $instance ) {

		$titles = array(
			'widget-title' => __( 'Social Title:', 'saiph-lite' ),
			'google'       => __( 'Google URL:', 'saiph-lite' ),
			'facebook'     => __( 'Facebook URL:', 'saiph-lite' ),
			'twitter'      => __( 'Twitter URL:', 'saiph-lite' ),
			'dribbble'     => __( 'Dribbble URL:', 'saiph-lite' ),
			'vimeo-square' => __( 'Vimeo URL:', 'saiph-lite' ),
			'youtube'      => __( 'Youtube URL:', 'saiph-lite' ),
			'linkedin'     => __( 'Linkedin URL:', 'saiph-lite' ),
			'instagram'    => __( 'Instagram URL:', 'saiph-lite' )
		);

		$instance = wp_parse_args( (array) $instance, $titles );

		foreach ( $instance as $key => $value ) {
			?>
			<p>
				<label><?php echo $titles[ $key ] ?></label>
				<input class="widefat widget_social_link widget_link_field"
					name="<?php echo $this->get_field_name( $key ) ?>" type="text"
					value="<?php echo ( $instance[ $key ] === $titles[ $key ] ) ? '' : $instance[ $key ]; ?>" />
			</p>
			<?php
		}
	}
}
