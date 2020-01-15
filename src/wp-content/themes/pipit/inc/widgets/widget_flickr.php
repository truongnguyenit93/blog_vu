<?php

class Pipit_Flickr_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_flickr_widget',
			esc_html__( 'Mondo: Flickr', 'pipit' ),
			array( 'description' => esc_html__( 'Displays Flickr feed.', 'pipit' ), )
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

		if ( isset( $pipit_admin_data['flickr_api_key'] ) && $pipit_admin_data['flickr_api_key'] != '' && isset( $pipit_admin_data['flickr_user_id'] ) && $pipit_admin_data['flickr_user_id'] != '' ) {

			$api_key = $pipit_admin_data['flickr_api_key'];
			$user_id = $pipit_admin_data['flickr_user_id'];

			if ( ( $response = get_transient( $this->id ) ) === false ) {
	  		$response = wp_remote_get( 'https://api.flickr.com/services/rest/?method=flickr.people.getPhotos&api_key=' . $api_key . '&user_id=' . $user_id . '&safe_search=1&per_page=' . $count . '&format=json&nojsoncallback=?' );
	  		
				set_transient( $this->id, $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
	  	}

	  	if ( ! is_wp_error( $response ) ) {

	  		$flickr_feed = json_decode( $response['body'] );
				$main_data = array();
				$n = 0;

				if ( $flickr_feed->stat != 'fail' ) {
					foreach ( $flickr_feed->photos->photo as $d ) {
						$main_data[ $n ]['id'] = $d->id;
						$main_data[ $n ]['secret'] = $d->secret;
						$main_data[ $n ]['server'] = $d->server;
						$main_data[ $n ]['farm'] = $d->farm;
						if ( isset( $d->title ) ) {
							$main_data[ $n ]['title'] = $d->title;
						} else {
							$main_data[ $n ]['title'] = '';
						}
						$n++;
					}

					foreach ( $main_data as $data ) {
						$return .= '<a href="' . esc_url( 'http://www.flickr.com/photos/' . esc_attr( $user_id ) . '/' . esc_attr( $data['id'] ) ) . '" class="thumbnail-link" target="_blank" title="' . esc_attr( $data['title'] ) . '">';
						$return .= '<span class="mask"><i class="fa fa-flickr"></i></span>';
						$return .= '<img src="' . esc_url( 'http://farm' . esc_attr( $data['farm'] ) . '.static.flickr.com/' . esc_attr( $data['server'] ) . '/' . esc_attr( $data['id'] ) . '_' . esc_attr( $data['secret'] ) . '_q.jpg' ) . '" class="thumbnail" alt="' . esc_attr( $data['title'] ) . '">';
						$return .= '</a>';
					}
				}

	  	}

		} else {
			$return = esc_html__( 'Please configure Flickr settings in Pipit Options > Social Media > Flickr.', 'pipit' );
		}

		?>

		<div class="thumbnails clearfix">
			<?php echo $return; ?>
		</div>
		
		<?php
		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => 'Flickr', 'count' => '6' );
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
