<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = $pipit_admin_data['main_layout'];
	$sidebar = $pipit_admin_data['sidebar'];

	$content_column_class = 'col-md-8';
	$sidebar_column_class = 'col-md-4';

	if ( $sidebar == 'no_sidebar' ) {
		$content_column_class = 'col-md-12';
	} elseif ( $sidebar == 'left_sidebar' ) {
		$content_column_class .= ' col-md-push-4';
		$sidebar_column_class .= ' col-md-pull-8 left-column';
	}
?>

<?php get_header(); ?>
	
	<div class="<?php echo esc_attr( $content_column_class ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>
				
				<?php if ( ! is_author() ) : ?>

					<header class="archive-header">
						<?php
							the_archive_title( '<h1 class="archive-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header>

				<?php else : ?>

					<?php pipit_about_author(); ?>
					
				<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/regular/content', get_post_format() ); ?>

				<?php endwhile; ?>

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
