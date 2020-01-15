<?php

class Pipit_Dribbble_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_dribbble_widget',
			esc_html__( 'Mondo: Dribbble', 'pipit' ),
			array( 'description' => esc_html__( 'Displays Dribbble feed.', 'pipit' ), )
		);
	}

	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = $instance['count'];

		$return = null;

		if ( strpos( $before_widget, 'class' ) === false ) {
	    $before_widget = str_replace( '>', 'class="widget-with-thumbnails two-columns"', $before_widget );
	  } else {
	    $before_widget = str_replace( 'class="', 'class="widget-with-thumbnails two-columns ', $before_widget );
	  }

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$pipit_admin_data = pipit_get_admin_data();

		if ( isset( $pipit_admin_data['dribbble_access_token'] ) && $pipit_admin_data['dribbble_access_token'] != '' && isset( $pipit_admin_data['dribbble_username'] ) && $pipit_admin_data['dribbble_username'] != '' ) {

			$access_token = $pipit_admin_data['dribbble_access_token'];
			$username = $pipit_admin_data['dribbble_username'];

			if ( ( $response = get_transient( $this->id ) ) === false ) {
	  		$response = wp_remote_get( 'https://api.dribbble.com/v1/users/' . $username . '/shots?access_token=' . $access_token . '&per_page=' . $count );
	  		
				set_transient( $this->id, $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
	  	}

	  	if ( ! is_wp_error( $response ) ) {

	  		$dribbble_feed = json_decode( $response['body'] );
				$main_data = array();
				$n = 0;

				if ( $dribbble_feed ) {
					foreach ( $dribbble_feed as $d ) {
						$main_data[ $n ]['src'] = $d->images->normal;
						$main_data[ $n ]['link'] = $d->html_url;
						if ( isset( $d->title ) ) {
							$main_data[ $n ]['title'] = $d->title;
						} else {
							$main_data[ $n ]['title'] = '';
						}
						$n++;
					}

					foreach ( $main_data as $data ) {
						$return .= '<a href="' . esc_url( $data['link'] ) . '" class="thumbnail-link" target="_blank" title="' . esc_attr( $data['title'] ) . '">';
						$return .= '<span class="mask"><i class="fa fa-dribbble"></i></span>';
						$return .= '<img src="' . esc_url( $data['src'] ) . '" class="thumbnail" alt="' . esc_attr( $data['title'] ) . '">';
						$return .= '</a>';
					}
				}

	  	}

		} else {
			$return = esc_html__( 'Please configure Dribbble settings in Pipit Options > Social Media > Dribbble.', 'pipit' );
		}

		?>

		<div class="thumbnails clearfix">
			<?php echo $return; ?>
		</div>
		
		<?php
		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => 'Dribbble', 'count' => '4' );
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'pipit' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'pipit' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" />
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

}
