<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = $pipit_admin_data['main_layout'];

	$post_class = 'list-item';
	$post_class .= has_post_thumbnail() ? '' : ' no-image';
	$image_size = 'thumbnail';

	if ( $main_layout == 'list_big' && pipit_is_first_post() ) {
		$post_class = '';
		$image_size = 'pipit_full_750';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $post_class ) ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-media">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail( $image_size ); ?>
			</a>
		</div>
	<?php endif; ?>
	
	<div class="entry-wrapper">
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
	</div>
</article>
