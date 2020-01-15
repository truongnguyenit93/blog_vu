<?php

class Pipit_Top_Reviews_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'pipit_top_reviews_widget',
			esc_html__( 'Mondo: Top Reviews', 'pipit' ),
			array( 'description' => esc_html__( 'Top reviews list.', 'pipit' ), )
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
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'pipit_review_score',
					'value' => 'a:0:{}',
					'compare' => '!='
				),
				array(
					'key' => 'pipit_review_score',
					'compare' => 'EXISTS'
				)
			)
		);

		function cmp( $a, $b ) {

	    if ( $a['total'] == $b['total'] ) {
	      return 0;
	    }

	    return ( $a['total'] > $b['total'] ) ? -1 : 1;
		}

		$tops = new WP_Query( $args );
		$data = array();

		if ( $tops->have_posts() ) {
			while ( $tops->have_posts() ) {
				$tops->the_post();

				$scores = rwmb_meta( 'pipit_review_score', array(), get_the_ID() );
				$total = 0;

				foreach ( $scores as $score ) {
					$score_data = explode( '|', $score );
					$total += $score_data[0];
				}

				$data[] = array(
					'ID' => get_the_ID(),
					'total' => round( ( $total / count( $scores ) ), 1 )
				);
			}

			usort( $data, 'cmp' );
		}

		wp_reset_postdata(); ?>

		<ul class="posts">
	  	<?php foreach ( $data as $d ) : ?>
			
			<?php $item_class = has_post_thumbnail( $d['ID'] ) ? 'thumbnail-link' : 'thumbnail-link no-thumbnail'; ?>
			<li class="clearfix">
				<a class="<?php echo esc_attr( $item_class ); ?>" href="<?php echo esc_url( get_permalink( $d['ID'] ) ); ?>" rel="bookmark">
					<?php if ( has_post_thumbnail( $d['ID'] ) ) : ?>
						<?php echo get_the_post_thumbnail( $d['ID'], 'thumbnail' ); ?>
					<?php endif; ?>
				</a>
				<div class="entry-content">
					<a class="entry-title" href="<?php echo esc_url( get_permalink( $d['ID'] ) ); ?>" rel="bookmark"><?php echo get_the_title( $d['ID'] ); ?></a>
					<span class="entry-meta label"><?php echo esc_html( $d['total'] ); ?></span>
				</div>
			</li>

			<?php endforeach; ?>
		</ul>
		
		<?php

		echo $after_widget;
	}

	public function form( $instance ) {

		$defaults = array( 'title' => 'Top Reviews', 'count' => '6' );
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
