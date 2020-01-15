<?php

class Pipit_About_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_about_widget',
			esc_html__( 'Mondo: About', 'pipit' ),
			array( 'description' => esc_html__( 'About the author.', 'pipit' ), )
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
	}

	public function upload_scripts() {

    wp_enqueue_media();
    wp_enqueue_script( 'pipit_widget_upload', get_template_directory_uri() . '/js/upload-media.js', array( 'jquery' ) );
  }

	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$name = $instance['name'];
		$bg_image = $instance['bg_image'];
		$profile_image = $instance['profile_image'];
		$autograph_image = $instance['autograph_image'];
		$description = $instance['description'];

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$pipit_admin_data = pipit_get_admin_data();
		$css = $bg_image != '' ? 'background-image: url("' . esc_url( $bg_image ) . '");' : '';

		ob_start(); ?>

		<div class="profile" style="<?php echo esc_attr( $css ); ?>">
			<div class="profile-content">
				<?php if ( $profile_image != '' ) : ?>
					<img src="<?php echo esc_url( $profile_image ); ?>" class="profile-image" alt="<?php echo esc_attr( $name ); ?>">
				<?php endif; ?>
				<?php if ( $autograph_image != '' ) : ?>
					<div class="profile-name">
						<img src="<?php echo esc_url( $autograph_image ); ?>" class="profile-autograph" alt="<?php echo esc_attr( $name ); ?>">
					</div>
				<?php elseif ( $name != '' && $autograph_image == '' ) : ?>
					<div class="profile-name"><?php echo esc_html( $name ); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $description != '' ) : ?>
			<div class="bio">
				<?php echo wp_kses( $description, array(
					'a'      => array( 'href' => array() ),
					'span'   => array( 'style' => array() ),
					'i'      => array( 'class' => array(), 'style' => array() ),
					'em'     => array(),
					'strong' => array(),
					'br'     => array()
				) ); ?>
			</div>
		<?php endif; ?>

		<?php

		echo ob_get_clean();

		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array(
			'title' => 'About',
			'name' => 'First Last',
			'bg_image' => '',
			'profile_image' => '',
			'autograph_image' => '',
			'description' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'pipit' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'pipit' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" />
		</p>
		<p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'bg_image' ) ); ?>"><?php esc_html_e( 'Background Image:', 'pipit' ); ?></label>
      <input class="widefat image-url" id="<?php echo esc_attr( $this->get_field_id( 'bg_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bg_image' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['bg_image'] ); ?>" />
      <input class="upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload Image', 'pipit' ); ?>" />
	  </p>
	  <p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'profile_image' ) ); ?>"><?php esc_html_e( 'Profile Image:', 'pipit' ); ?></label>
      <input class="widefat image-url" id="<?php echo esc_attr( $this->get_field_id( 'profile_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'profile_image' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['profile_image'] ); ?>" />
      <input class="upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload Image', 'pipit' ); ?>" />
	  </p>
	  <p>
      <label for="<?php echo esc_attr( $this->get_field_name( 'autograph_image' ) ); ?>"><?php esc_html_e( 'Autograph Image:', 'pipit' ); ?></label>
      <input class="widefat image-url" id="<?php echo esc_attr( $this->get_field_id( 'autograph_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'autograph_image' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['autograph_image'] ); ?>" />
      <input class="upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload Image', 'pipit' ); ?>" />
	  </p>
	  <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'pipit' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="4"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['bg_image'] = ( ! empty( $new_instance['bg_image'] ) ) ? strip_tags( $new_instance['bg_image'] ) : '';
		$instance['profile_image'] = ( ! empty( $new_instance['profile_image'] ) ) ? strip_tags( $new_instance['profile_image'] ) : '';
		$instance['autograph_image'] = ( ! empty( $new_instance['autograph_image'] ) ) ? strip_tags( $new_instance['autograph_image'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? $new_instance['description'] : '';

		return $instance;
	}

}
