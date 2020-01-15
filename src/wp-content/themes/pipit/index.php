<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = isset( $pipit_admin_data['main_layout'] ) ? $pipit_admin_data['main_layout'] : 'classic';
	$sidebar = $pipit_admin_data['sidebar'];
	$masonry_layouts = array( 'masonry', 'masonry_big' );

	$content_column_class = 'col-md-8';
	$sidebar_column_class = 'col-md-4';

	if ( $sidebar == 'no_sidebar' ) {
		$content_column_class = 'col-md-12';
	} elseif ( $sidebar == 'left_sidebar' ) {
		$content_column_class .= ' col-md-push-4';
		$sidebar_column_class .= ' col-md-pull-8 left-column';
	}

	$layout_mapping = array(
		'classic' => 'regular',
		'box' => 'box',
		'list' => 'list',
		'masonry' => 'regular',
		'list_big' => 'list',
		'masonry_big' => 'regular',
	);
?>

<?php get_header(); ?>
	
	<div class="<?php echo esc_attr( $content_column_class ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php if ( in_array( $main_layout, $masonry_layouts ) ) : ?>
					<div id="masonry-container" class="row">
						<div class="grid-sizer col-md-6"></div>
				<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/' . $layout_mapping[ $main_layout ] . '/content', get_post_format() ); ?>
					
				<?php endwhile; ?>

				<?php if ( in_array( $main_layout, $masonry_layouts ) ) : ?>
					</div>
				<?php endif; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

			</main>
		</div>
	</div>
	
	<?php if ( $sidebar != 'no_sidebar' ) : ?>

		<div class="<?php echo esc_attr( $sidebar_column_class ); ?>">
			<?php get_sidebar(); ?>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
