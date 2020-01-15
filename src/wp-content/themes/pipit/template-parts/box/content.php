<?php
	$bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'pipit_full_1140' );
	$css = 'background-image: url(' . esc_url( $bg_image[0] ) . ');';
?>

<article id="post-<?php the_ID(); ?>" style="<?php echo esc_attr( $css ); ?>" <?php post_class( 'box-item' ); ?>>
	<div class="entry-wrapper">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="entry-meta">
				<?php pipit_entry_meta(); ?>
			</div>
		</header>

		<footer class="entry-footer">
			<?php pipit_entry_footer(); ?>
		</footer>
	</div>
</article>
