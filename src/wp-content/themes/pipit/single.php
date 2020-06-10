<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = $pipit_admin_data['main_layout'];
	$sidebar = pipit_compare_options( $pipit_admin_data['sidebar'], rwmb_meta( 'pipit_sidebar' ) );

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
	
	<div class="<?php echo esc_attr( $content_column_class ); ?> mobile-plr-0">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content-single', get_post_format() );

					pipit_entry_review();

					if ( $pipit_admin_data['disable_author_section'] != '1' ) {
						pipit_about_author();
					}

					if ( $pipit_admin_data['disable_related_posts'] != '1' ) {
						pipit_related_posts();
					}

					// the_post_navigation();

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
			?>

			</main>
		</div>
	</div>
	
	<?php if ( $sidebar != 'no_sidebar' ) : ?>

		<div class="<?php echo esc_attr( $sidebar_column_class ); ?>">
			<?php get_sidebar(); ?>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
