<?php
	$pipit_admin_data = pipit_get_admin_data();
	$main_layout = $pipit_admin_data['shop_layout'];

	$content_column_class = 'col-md-9';
	$sidebar_column_class = 'col-md-3';

	if ( $main_layout == 'full_width' ) {
		$content_column_class = 'col-md-12';
	} elseif ( $main_layout == 'left_sidebar' ) {
		$content_column_class .= ' col-md-push-3';
		$sidebar_column_class .= ' col-md-pull-9 left-column';
	}

	if ( is_product() ) {
		$content_column_class = 'col-md-12';
	}
?>

<?php get_header(); ?>
	
	<div class="<?php echo esc_attr( $content_column_class ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php woocommerce_content(); ?>

			</main>
		</div>
	</div>
	
	<?php if ( $main_layout != 'full_width' && ! is_product() ) : ?>

		<div class="<?php echo esc_attr( $sidebar_column_class ); ?>">
			<?php get_sidebar(); ?>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
