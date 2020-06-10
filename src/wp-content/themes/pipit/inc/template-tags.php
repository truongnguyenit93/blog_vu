<?php

if ( ! function_exists( 'pipit_hero' ) ) :
function pipit_hero() {

	$pipit_admin_data = pipit_get_admin_data();

	if ( is_front_page() ) {
		$hero_style = $pipit_admin_data['hero_home_style'];
		$hero_type = $pipit_admin_data['hero_home_type'];
		$bg_image = isset( $pipit_admin_data['hero_home_bg_image'] ) && pipit_redux_image_set( $pipit_admin_data['hero_home_bg_image'] ) ? esc_url( $pipit_admin_data['hero_home_bg_image']['url'] ) : '';
		$bg_video = isset( $pipit_admin_data['hero_home_bg_video'] ) ? $pipit_admin_data['hero_home_bg_video'] : '';
		$bg_slider = array();
		$slides = isset( $pipit_admin_data['hero_home_bg_slider'] ) && $pipit_admin_data['hero_home_bg_slider'] != '' ? explode( ',', $pipit_admin_data['hero_home_bg_slider'] ) : array();
		foreach ( $slides as $slide ) {
			$image = wp_get_attachment_image_src( $slide, 'full' );
			$bg_slider[] = $image[0];
		}
	} elseif ( is_singular( 'post' ) || is_page() ) {
		$hero_style = pipit_compare_options( $pipit_admin_data['hero_single_style'], rwmb_meta( 'pipit_hero_style' ) );
		$hero_type = rwmb_meta( 'pipit_hero_type' ) == '' ? 'image' : rwmb_meta( 'pipit_hero_type' );
		if ( rwmb_meta('pipit_hero_bg_image') && sizeof( rwmb_meta('pipit_hero_bg_image') ) == 1 ) {
			$bg_image = rwmb_meta('pipit_hero_bg_image');
			foreach ( $bg_image as $i ) {
				$bg_image = $i['full_url'];
			}
		} else {
			$bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$bg_image = $bg_image[0];
		}
		$bg_video = rwmb_meta( 'pipit_hero_bg_video' );
		$bg_slider = array();
		$slides = rwmb_meta( 'pipit_hero_bg_slider' );
		if ( ! empty( $slides ) ) {
			foreach ( $slides as $slide ) {
				$bg_slider[] = $slide['full_url'];
			}
		}
	} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$hero_style = $pipit_admin_data['hero_shop_style'];
		$hero_type = $pipit_admin_data['hero_shop_type'];
		$bg_image = isset( $pipit_admin_data['hero_shop_bg_image'] ) && pipit_redux_image_set( $pipit_admin_data['hero_shop_bg_image'] ) ? esc_url( $pipit_admin_data['hero_shop_bg_image']['url'] ) : '';
		$bg_video = isset( $pipit_admin_data['hero_shop_bg_video'] ) ? $pipit_admin_data['hero_shop_bg_video'] : '';
		$bg_slider = array();
		$slides = isset( $pipit_admin_data['hero_shop_bg_slider'] ) && $pipit_admin_data['hero_shop_bg_slider'] != '' ? explode( ',', $pipit_admin_data['hero_shop_bg_slider'] ) : array();
		foreach ( $slides as $slide ) {
			$image = wp_get_attachment_image_src( $slide, 'full' );
			$bg_slider[] = $image[0];
		}
	} ?>

	<div id="hero" class="<?php echo esc_attr( $hero_type . ' ' . $hero_style ); ?>"<?php echo ( $hero_type == 'image' || $hero_type == 'video' ) && $bg_image != '' ? ' style="background-image: url(' . esc_url( $bg_image ) . ')"' : ''; ?><?php echo ( $hero_type == 'video' && $bg_video != '' ) ? ' data-vide-bg="' . esc_url( $bg_video ) . '" data-vide-options="posterType: none"' : ''; ?>>
		<div id="hero-mask"></div>
			
		<?php if ( $hero_type == 'slider' && $bg_slider ) : ?>
			<div id="hero-slider">
				<?php foreach ( $bg_slider as $image ) : ?>
					<div class="slider-item" style="background-image: url(<?php echo esc_url( $image ); ?>)"></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="hero-content" data-0="opacity:1; transform: translate(-50%,-50%);" data-200="opacity:0; transform: translateY(-50%,-60%);">
			<?php if ( is_front_page() ) : ?>
				
				<?php if ( isset( $pipit_admin_data['hero_home_title'] ) && $pipit_admin_data['hero_home_title'] != '' ) : ?>
					<h1 class="hero-title">
						<?php echo esc_html( $pipit_admin_data['hero_home_title'] ); ?>
					</h1>
				<?php endif; ?>
				<?php if ( isset( $pipit_admin_data['hero_home_description'] ) && $pipit_admin_data['hero_home_description'] != '' ) : ?>
					<div class="hero-description">
						<?php echo esc_html( $pipit_admin_data['hero_home_description'] ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( is_singular( 'post' ) || is_page() ) : ?>

				<h1 class="hero-title">
					<?php
						if ( rwmb_meta( 'pipit_hero_title' ) != '' ) {
							echo rwmb_meta( 'pipit_hero_title' );
						} else {
							the_title();
						}
					?>
				</h1>
				<?php if ( rwmb_meta( 'pipit_hero_description' ) != '' ) : ?>
					<div class="hero-description">
						<?php echo rwmb_meta( 'pipit_hero_description' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( class_exists( 'WooCommerce' ) && is_shop() ) : ?>

				<?php if ( isset( $pipit_admin_data['hero_shop_title'] ) && $pipit_admin_data['hero_shop_title'] != '' ) : ?>
					<h1 class="hero-title">
						<?php echo esc_html( $pipit_admin_data['hero_shop_title'] ); ?>
					</h1>
				<?php endif; ?>
				<?php if ( isset( $pipit_admin_data['hero_shop_description'] ) && $pipit_admin_data['hero_shop_description'] != '' ) : ?>
					<div class="hero-description">
						<?php echo esc_html( $pipit_admin_data['hero_shop_description'] ); ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>
		</div>
	</div>

	<?php
}
endif;

if ( ! function_exists( 'pipit_posted_on' ) ) :
function pipit_posted_on() {

	$time_string = '<time datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	echo '<span class="entry-date"><a href="' . esc_url( get_the_permalink() ) . '">' . $time_string . '</a></span>';
}
endif;

if ( ! function_exists( 'pipit_categories_link' ) ) :
function pipit_categories_link( $sep = ' ' ) {

	echo '<span class="categories-link">';
	echo get_the_category_list( $sep );
	echo '</span>';
}
endif;

if ( ! function_exists( 'pipit_tags_link' ) ) :
function pipit_tags_link( $sep = ' ' ) {

	echo get_the_tag_list( '', ', ', '' );
}
endif;

if ( ! function_exists( 'pipit_comments_link' ) ) :
function pipit_comments_link() {

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( '<i class="fa fa-comment-o"></i> 0', '<i class="fa fa-comment-o"></i> 1', '<i class="fa fa-comment-o"></i> %' );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'pipit_entry_like' ) ) :
function pipit_entry_like() {

	$like_button_text = '0';
	$like_count = get_post_meta( get_the_ID(), 'pipit_like', true );

	if ( $like_count != '' ) {
		$like_button_text = $like_count; 
	} ?>
	
	<span class="entry-like">
		<a href="#" class="like-toggle" title="<?php esc_html_e( 'Click to like this post.', 'pipit' ); ?>" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
			<i class="fa fa-heart-o"></i>
			<span class="like-count"><?php echo esc_html( $like_button_text ); ?></span>
		</a>
	</span>
	<?php
}
endif;

if ( ! function_exists( 'pipit_entry_share' ) ) :
function pipit_entry_share() { ?>

	<?php echo apply_filters( 'pipit_before_post_sharer', '<span class="entry-share clearfix">' ); ?>
<!--		<a class="popup twitter" href="--><?php //echo esc_url( 'http://twitter.com/share?text=' . urlencode( get_the_title() ) . '&amp;url=' . urlencode( get_the_permalink() ) ); ?><!--"><i class="fa fa-twitter"></i></a>-->
<!--		<a class="popup facebook " href="--><?php //echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ); ?><!--"><i class="fa fa-facebook"></i></a>-->
<!--		<a class="popup google" href="--><?php //echo esc_url( 'https://plus.google.com/share?url=' . get_the_permalink() ); ?><!--"><i class="fa fa-google-plus"></i></a>-->
	<?php echo apply_filters( 'pipit_after_post_sharer', '</span>' ); ?>

	<?php
}
endif;

if ( ! function_exists( 'pipit_entry_meta' ) ) :
function pipit_entry_meta() {

	pipit_posted_on();
	pipit_categories_link( ', ' );
	pipit_comments_link();
	pipit_entry_like();
}
endif;

if ( ! function_exists( 'pipit_entry_footer' ) ) :
function pipit_entry_footer() {
	
//	if ( ! is_single() ) {
//		echo '<a class="button read-more" href="' . esc_url( get_the_permalink() ) . '">' . esc_html( apply_filters( 'pipit_readmore_button_text', esc_html__( 'Đọc ', 'pipit' ) ) ) . '</a>';
//	}
	pipit_entry_share();
}
endif;

if ( ! function_exists( 'pipit_social_links' ) ) :
function pipit_social_links() {

	$pipit_admin_data = pipit_get_admin_data();

	$data = array(
		array( 'class' => 'twitter', 'option' => 'twitter_url', 'icon' => 'twitter' ),
		array( 'class' => 'facebook', 'option' => 'facebook_url', 'icon' => 'facebook' ),
		array( 'class' => 'youtube', 'option' => 'youtube_url', 'icon' => 'youtube' ),
		array( 'class' => 'pinterest', 'option' => 'pinterest_url', 'icon' => 'pinterest' ),
		array( 'class' => 'dribbble', 'option' => 'dribbble_url', 'icon' => 'dribbble' ),
		array( 'class' => 'instagram', 'option' => 'instagram_url', 'icon' => 'instagram' ),
		array( 'class' => 'linkedin', 'option' => 'linkedin_url', 'icon' => 'linkedin' ),
		array( 'class' => 'tumblr', 'option' => 'tumblr_url', 'icon' => 'tumblr' ),
		array( 'class' => 'google-plus', 'option' => 'google_plus_url', 'icon' => 'google-plus' ),
		array( 'class' => 'behance', 'option' => 'behance_url', 'icon' => 'behance' ),
		array( 'class' => 'flickr', 'option' => 'flickr_url', 'icon' => 'flickr' ),
		array( 'class' => 'github', 'option' => 'github_url', 'icon' => 'github-alt' ),
		array( 'class' => 'slideshare', 'option' => 'slideshare_url', 'icon' => 'slideshare' ),
		array( 'class' => 'codepen', 'option' => 'codepen_url', 'icon' => 'codepen' ),
		array( 'class' => 'reddit', 'option' => 'reddit_url', 'icon' => 'reddit' ),
		array( 'class' => 'soundcloud', 'option' => 'soundcloud_url', 'icon' => 'soundcloud' ),
		array( 'class' => 'steam', 'option' => 'steam_url', 'icon' => 'steam' ),
		array( 'class' => 'twitch', 'option' => 'twitch_url', 'icon' => 'twitch' ),
		array( 'class' => 'vine', 'option' => 'vine_url', 'icon' => 'vine' ),
		array( 'class' => 'vk', 'option' => 'vk_url', 'icon' => 'vk' ),
		array( 'class' => 'rss', 'option' => 'rss_url', 'icon' => 'rss' ),
	); ?>

	<?php echo apply_filters( 'pipit_before_social_icons', '<ul class="social-links">' ); ?>
		<?php foreach ( $data as $d ) : ?>
			
			<?php if ( isset( $pipit_admin_data[ $d['option'] ] ) && $pipit_admin_data[ $d['option'] ] != '' ) : ?>
				<li class="<?php echo esc_attr( $d['class'] ); ?>">
					<a href="<?php echo esc_url( $pipit_admin_data[ $d['option'] ] ); ?>" target="_blank">
						<i class="fa fa-<?php echo esc_attr( $d['icon'] ); ?>"></i>
					</a>
				</li>
			<?php endif; ?>

		<?php endforeach; ?>
	<?php echo apply_filters( 'pipit_after_social_icons', '</ul>' ); ?>

	<?php
}
endif;

if ( ! function_exists( 'pipit_featured_posts' ) ) :
function pipit_featured_posts() {

	$args = array(
    'meta_key' => 'pipit_featured_post',
    'meta_value' => '1',
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'post_type' => array( 'post', 'page' )
  );
  $featured_posts = new WP_Query( $args ); ?>

  <?php if ( $featured_posts->have_posts() ) : ?>

  	<div id="featured-posts">

	  	<?php while ( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>

	  		<?php
	  			$bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'pipit_full_750' );
					$css = 'background-image: url(' . esc_url( $bg_image[0] ) . ');';
	  		?>

	  		<article class="featured-post" style="<?php echo esc_attr( $css ); ?>">
	  			<a class="permalink" href="<?php echo esc_url( get_permalink() ); ?>"></a>
	  			
					<div class="entry-content">
						<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					</div>
	  		</article>

		  <?php endwhile; ?>
		  
		 </div>

  <?php endif;

  wp_reset_postdata();
}
endif;

if ( ! function_exists( 'pipit_entry_review' ) ) :
function pipit_entry_review() {

	$scores = rwmb_meta( 'pipit_review_score' ); ?>

	<?php if ( count( $scores ) != 0 && $scores != '' ) : ?>

		<?php
			$total = 0;
			foreach ( $scores as $score ) {
				$data = explode( '|', $score );
				$total += $data[0];
			}
		?>
		
		<div id="review-score">
			<span class="total-score"><?php echo esc_html( round( ( $total / count( $scores ) ), 1 ) ); ?></span>

			<div class="bars">
			<?php foreach ( $scores as $score ) : ?>
				
				<?php $data = explode( '|', $score ); ?>
				
				<div class="bar">
					<span class="bar-label"><?php echo esc_html( $data[1] ); ?></span>
					<span class="bar-score"><?php echo esc_html( $data[0] ); ?></span>
					<div class="bar-track">
						<div class="bar-progress" style="width: <?php echo esc_attr( $data[0] * 10 ); ?>%;"></div>
					</div>
				</div>

			<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
}
endif;

if ( ! function_exists( 'pipit_about_author' ) ) :
function pipit_about_author() {

	$website = get_the_author_meta( 'user_url' );
	$facebook = get_the_author_meta( 'facebook' );
	$twitter = get_the_author_meta( 'twitter' );
	$instagram = get_the_author_meta( 'instagram' );
	$google = get_the_author_meta( 'google' );
	$linkedin = get_the_author_meta( 'linkedin' ); ?>
	
	<div id="about-author" class="clearfix">
		<div class="author-image">
			<?php echo get_avatar( get_the_author_meta( 'email' ), '90', null, get_the_author_meta( 'display_name' ) ); ?>
		</div>
		<div class="author-info">
			<h4 class="author-name">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
			</h4>
			<p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
			<?php if ( $facebook != '' || $twitter != '' || $instagram != '' || $google != '' || $linkedin != '' ) : ?>
				<div class="author-meta">
					<?php if ( $website != '' ) : ?>
						<a href="<?php echo esc_url( $website ); ?>" target="_blank"><i class="fa fa-globe"></i></a>
					<?php endif; ?>
					<?php if ( $facebook != '' ) : ?>
						<a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<?php endif; ?>
					<?php if ( $twitter != '' ) : ?>
						<a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
					<?php endif; ?>
					<?php if ( $instagram != '' ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
					<?php endif; ?>
					<?php if ( $google != '' ) : ?>
						<a href="<?php echo esc_url( $google ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php endif; ?>
					<?php if ( $linkedin != '' ) : ?>
						<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<?php
}
endif;

if ( ! function_exists( 'pipit_related_posts' ) ) :
function pipit_related_posts() {

	$tags = wp_get_post_tags( get_the_ID() );

	if ( $tags ) {
		$tag_ids = array();
		foreach ( $tags as $tag ) {
			$tag_ids[] = $tag->term_id;
		}

		$args = array(
			'tag__in' => $tag_ids,
      'post__not_in' => array( get_the_ID() ),
      'posts_per_page' => 2,
      'orderby' => 'rand'
		);

		$related_posts = new WP_Query( $args ); ?>

		<?php if ( $related_posts->have_posts() ) : ?>
			<div id="related-posts">
				<h3 class="bordered-title"><?php echo esc_html( apply_filters( 'pipit_related_posts_title', esc_html__( 'You might also like', 'pipit' ) ) ); ?></h3>

				<div class="row">
					<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>

						<?php
							$css = '';
							$media_class = 'entry-media';

							if ( has_post_thumbnail() ) {
								$bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'pipit_full_750' );
								$css = 'background-image: url(' . esc_url( $bg_image[0] ) . ');';
								$media_class .= ' with-bg';
							}
						?>

						<div class="col-sm-6 column">
							<article class="related-post">
								<div class="<?php echo esc_attr( $media_class ); ?>" style="<?php echo esc_attr( $css ); ?>">
									<a class="permalink" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"></a>
									<?php pipit_categories_link(); ?>
									<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
								</div>
							</article>
						</div>

					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		<?php
	}
}
endif;

if ( ! function_exists( 'pipit_media_feed' ) ) :
function pipit_media_feed() {

	$pipit_admin_data = pipit_get_admin_data();
  $feed = $pipit_admin_data['media_feed_type'];
  $main_data = pipit_get_media_feed( array( 'feed' => $feed, 'count' => 8, 'transient' => 'pipit_media_feed_' . $feed ) ); ?>
  
  <div id="media-feed">
    <?php if ( ! empty( $main_data ) ) : ?>
      <div class="feed-items clearfix">
        <?php foreach ( $main_data as $data ) : ?>
          <a class="feed-item" href="<?php echo esc_url( $data['link'] ); ?>" title="<?php echo esc_attr( $data['caption'] ); ?>" target="_blank">
          	<span class="mask"><i class="fa fa-<?php echo esc_attr( $feed ); ?>"></i></span>
          	<img src="<?php echo esc_url( $data['thumbnail'] ); ?>" alt="<?php echo esc_attr( $data['caption'] ); ?>">
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php

  die();
}
add_action( 'wp_ajax_pipit_media_feed', 'pipit_media_feed' );
add_action( 'wp_ajax_nopriv_pipit_media_feed', 'pipit_media_feed' );
endif;

if ( ! function_exists( 'pipit_comment' ) ) :
function pipit_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'pipit' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'pipit' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-wrapper clearfix" itemscope itemtype="https://schema.org/Comment">
			<div class="comment-author-avatar vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>

			<div class="comment-content">
				<div class="comment-author-name vcard" itemprop="author">
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div>

				<div class="comment-metadata">
					<time datetime="<?php comment_time( 'c' ); ?>" itemprop="datePublished">
						<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'pipit' ), get_comment_date(), get_comment_time() ); ?>
					</time>
					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
					<?php edit_comment_link( esc_html__( 'Edit', 'pipit' ), ' <span class="edit-link">', '</span>' ); ?>
				</div>

				<div class="comment-body" itemprop="comment">
					<?php comment_text(); ?>
				</div>

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'pipit' ); ?></p>
				<?php endif; ?>
			</div>
		</article>

	<?php
	endif;
}
endif;
