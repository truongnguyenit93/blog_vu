<?php

class Pipit_Top_Stories_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_top_stories_widget',
			esc_html__( 'Mondo: Top Stories', 'pipit' ),
			array( 'description' => esc_html__( 'Top stories list.', 'pipit' ), )
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
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'orderby' => array(
				'meta_value_num' => 'DESC',
				'post_date' => 'DESC'
			),
			'meta_key' => 'pipit_like',
			'meta_query' => array(
				'key' => 'pipit_like',
				'value' => '0',
				'compare' => '>'
			)
		);

		$tops = new WP_Query( $args ); ?>

		<ul class="posts">
			<?php if ( $tops->have_posts() ) : ?>
		  	<?php while ( $tops->have_posts() ) : $tops->the_post(); ?>

				<?php
					$like_count = get_post_meta( get_the_ID(), 'pipit_like', true );
					$item_class = has_post_thumbnail() ? 'thumbnail-link' : 'thumbnail-link no-thumbnail';
				?>
				<li class="clearfix">
					<a class="<?php echo esc_attr( $item_class ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						<?php endif; ?>
					</a>
					<div class="entry-content">
						<a class="entry-title" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
						<span class="entry-meta label"><?php printf( _n( '%d like', '%d likes', esc_html( $like_count ), 'pipit' ), esc_html( number_format_i18n( $like_count ) ), esc_html( number_format_i18n( $like_count ) ) ); ?></span>
					</div>
				</li>

				<?php endwhile; ?>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</ul>
		
		<?php

		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => 'Top Stories', 'count' => '6' );
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
