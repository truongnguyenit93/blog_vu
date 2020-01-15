<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = $pipit_admin_data['main_layout'];
	
	$masonry_layouts = array( 'masonry', 'masonry_big' );
	$masonry_column_class = 'col-md-6';

	if ( $main_layout == 'masonry_big' && pipit_is_first_post() ) {
		$masonry_column_class = 'col-md-12';
	}
?>

<?php if ( in_array( $main_layout, $masonry_layouts ) ) : ?>
	<div class="masonry-item <?php echo esc_attr( $masonry_column_class ); ?>">
<?php endif; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( rwmb_meta( 'pipit_pf_video_data' ) != '' ) : ?>
			<div class="entry-media">
				<?php echo rwmb_meta( 'pipit_pf_video_data' ); ?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="entry-meta">
				<?php pipit_entry_meta(); ?>
			</div>
		</header>

		<div class="entry-content">
			<?php
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pipit' ),
					'after'  => '</div>',
				) );
			?>
		</div>

		<footer class="entry-footer">
			<?php pipit_entry_footer(); ?>
		</footer>
	</article>

<?php if ( in_array( $main_layout, $masonry_layouts ) ) : ?>
	</div>
<?php endif; ?>
