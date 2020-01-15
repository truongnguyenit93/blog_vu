<?php
  $pipit_admin_data = pipit_get_admin_data();
  $hero = pipit_compare_options( $pipit_admin_data['hero_single_enable'], rwmb_meta( 'pipit_hero_enable' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && $hero != '1' ) : ?>
		<div class="entry-media">
			<?php the_post_thumbnail( 'pipit_full_750' ); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pipit' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article>
