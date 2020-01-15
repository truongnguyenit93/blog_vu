<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title bordered-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'pipit' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style' => 'ol',
					'short_ping' => true,
					'callback' => 'pipit_comment',
					'avatar_size' => 60
				) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pipit' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'pipit' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'pipit' ) ); ?></div>

			</div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pipit' ); ?></p>
	<?php endif; ?>

	<?php 
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

  	$fields = array(
  		'author' => '<div class="row comment-author-inputs"><div class="col-md-4 input"><p class="comment-form-author">' .
      '<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name (required)', 'pipit' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p></div>',

  		'email' => '<div class="col-md-4 input"><p class="comment-form-email">' .
      '<input id="email" name="email" type="text" placeholder="' . esc_html__( 'E-mail (required)', 'pipit' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></p></div>',

  		'url' => '<div class="col-md-4 input"><p class="comment-form-url">' .
      '<input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'pipit' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></p></div></div>'
  	);

		$comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_html__( 'Comment', 'pipit' ) . '" rows="8" aria-required="true">' .
    '</textarea></p>';

		$comment_args = array( 'comment_field' => $comment_field, 'fields' => $fields, 'class_submit' => 'button', 'comment_notes_before' => '', 'comment_notes_after' => '' );
	?>

	<?php comment_form( $comment_args ); ?>

</div>
