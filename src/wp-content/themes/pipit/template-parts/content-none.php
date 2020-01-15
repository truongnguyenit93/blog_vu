<section class="no-results not-found">
	<header class="archive-header">
		<h1 class="archive-title"><?php esc_html_e( 'Nothing Found', 'pipit' ); ?></h1>
		<div class="archive-description">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( apply_filters( 'pipit_no_post', esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pipit' ) ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php echo esc_html( apply_filters( 'pipit_search_no_result', esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pipit' ) ) ); ?></p>

			<?php else : ?>

				<p><?php echo esc_html( apply_filters( 'pipit_no_result', esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pipit' ) ) ); ?></p>

			<?php endif; ?>
		</div>
		<?php get_search_form(); ?>
	</header>
</section>
