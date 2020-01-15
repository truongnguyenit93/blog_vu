<?php

class Pipit_500px_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_500px_widget',
			esc_html__( 'Mondo: 500px', 'pipit' ),
			array( 'description' => esc_html__( 'Displays 500px feed.', 'pipit' ), )
		);
	}

	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = $instance['count'];

		$return = null;

		if ( strpos( $before_widget, 'class' ) === false ) {
	    $before_widget = str_replace( '>', 'class="widget-with-thumbnails"', $before_widget );
	  } else {
	    $before_widget = str_replace( 'class="', 'class="widget-with-thumbnails ', $before_widget );
	  }

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$pipit_admin_data = pipit_get_admin_data();

		if ( isset( $pipit_admin_data['500px_consumer_key'] ) && $pipit_admin_data['500px_consumer_key'] != '' && isset( $pipit_admin_data['500px_username'] ) && $pipit_admin_data['500px_username'] != '' ) {

			$consumer_key = $pipit_admin_data['500px_consumer_key'];
			$username = $pipit_admin_data['500px_username'];

			if ( ( $response = get_transient( $this->id ) ) === false ) {
	  		$response = wp_remote_get( 'https://api.500px.com/v1/photos?consumer_key=' . $consumer_key . '&feature=user&username=' . $username . '&sort=created_at&image_size=600&rpp=' . $count );
	  		
				set_transient( $this->id, $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
	  	}

	  	if ( ! is_wp_error( $response ) ) {

	  		$_500px_feed = json_decode( $response['body'] );
				$main_data = array();
				$n = 0;

				if ( isset( $_500px_feed->photos ) ) {
					foreach ( $_500px_feed->photos as $d ) {
						$main_data[ $n ]['thumbnail'] = $d->images[0]->url;
						$main_data[ $n ]['link'] = $d->url;
						if ( isset( $d->name ) ) {
							$main_data[ $n ]['caption'] = $d->name;
						} else {
							$main_data[ $n ]['caption'] = '';
						}
						$n++;
					}

					foreach ( $main_data as $data ) {
						$return .= '<a href="' . esc_url( $data['link'] ) . '" class="thumbnail-link" target="_blank" title="' . esc_attr( $data['caption'] ) . '">';
						$return .= '<span class="mask"><i class="fa fa-500px"></i></span>';
						$return .= '<img src="' . esc_url( $data['thumbnail'] ) . '" alt="' . esc_attr( $data['caption'] ) . '" class="thumbnail">';
						$return .= '</a>';
					}
				}

	  	}

		} else {
			$return = esc_html__( 'Please configure 500px settings in Pipit Options > Social Media > 500px.', 'pipit' );
		}

		?>

		<div class="thumbnails clearfix">
			<?php echo $return; ?>
		</div>
		
		<?php
		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => '500px', 'count' => '6' );
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
