<?php

function pipit_shortcode_tweet( $atts, $content = null ) {

  ob_start(); ?>
  
  <span class="tweetable-text" data-url="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo do_shortcode( $content ); ?></span>

  <?php

  return ob_get_clean();
}
add_shortcode( 'tweet', 'pipit_shortcode_tweet' );
