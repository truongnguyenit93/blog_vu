<?php

class Pipit_Top_Authors_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_top_authors_widget',
			esc_html__( 'Mondo: Top Authors', 'pipit' ),
			array( 'description' => esc_html__( 'Top authors list.', 'pipit' ), )
		);
	}

	public function widget( $args, $instance ) {

		extract( $args );
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? $instance['count'] : '';

		if ( strpos( $before_widget, 'class' ) === false ) {
	    $before_widget = str_replace( '>', 'class="widget-posts-list"', $before_widget );
	  } else {
	    $before_widget = str_replace( 'class="', 'class="widget-posts-list ', $before_widget );
	  }

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$args = array(
			'who' => 'authors',
			'number' => $count,
			'orderby' => 'post_count',
			'order' => 'DESC'
		);
		$users = get_users( $args );
		$item_class = 'thumbnail-link'; ?>

		<ul class="posts">
	  	<?php foreach ( $users as $user ) : ?>

			<?php $post_count = count_user_posts( $user->ID ); ?>
			<li class="clearfix">
				<a class="<?php echo esc_attr( $item_class ); ?>" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>" rel="bookmark">
					<?php echo get_avatar( get_the_author_meta( 'email', $user->ID ), '70', null, get_the_author_meta( 'display_name', $user->ID ), array( 'class' => 'attachment-thumbnail' ) ); ?>
				</a>
				<div class="entry-content">
					<a class="entry-title" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>" rel="bookmark"><?php echo esc_html( $user->display_name ); ?></a>
					<span class="entry-meta label"><?php printf( _n( '%d post', '%d posts', esc_html( $post_count ), 'pipit' ), esc_html( number_format_i18n( $post_count ) ), esc_html( number_format_i18n( $post_count ) ) ); ?></span>
				</div>
			</li>

			<?php endforeach; ?>
		</ul>
		
		<?php

		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => 'Top Authors', 'count' => '6' );
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
