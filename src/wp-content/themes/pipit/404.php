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

				<section class="error-404 not-found">
					<header class="archive-header">
						<h1 class="archive-title"><?php echo esc_html( apply_filters( 'pipit_404_title', esc_html__( 'Oops! That page can&rsquo;t be found.', 'pipit' ) ) ); ?></h1>
						<div class="archive-description">
							<p><?php echo esc_html( apply_filters( 'pipit_404_message', esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'pipit' ) ) ); ?></p>
						</div>
						<?php get_search_form(); ?>
					</header>
				</section>

			</main>
		</div>
	</div>

	<?php if ( $sidebar != 'no_sidebar' ) : ?>

		<div class="<?php echo esc_attr( $sidebar_column_class ); ?>">
			<?php get_sidebar(); ?>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
