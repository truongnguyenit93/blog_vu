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

				<header class="archive-header">
					<h1 class="archive-title"><?php printf( esc_html( apply_filters( 'pipit_search_title', esc_html__( 'Kết quả tìm kiếm: %s', 'pipit' ) ) ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'search' ); ?>

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
