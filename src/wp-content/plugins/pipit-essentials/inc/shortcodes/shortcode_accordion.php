<?php

function pipit_shortcode_accordion( $atts, $content = null ) {

  ob_start(); ?>
  
  <div class="accordion">
    <?php echo do_shortcode( $content ); ?>
  </div>

  <?php

  return ob_get_clean();
}
add_shortcode( 'accordion', 'pipit_shortcode_accordion' );

function pipit_shortcode_accordion_item( $atts, $content = null ) {

  $atts = wp_parse_args( $atts, array(
    'title' => null,
    'open' => false
  ) );

  $open = filter_var( $atts['open'], FILTER_VALIDATE_BOOLEAN );

  ob_start(); ?>

  <section class="accordion-item<?php echo esc_attr( $open ? ' open' : '' ); ?>">
    <h4 class="accordion-title"><?php echo esc_html( $atts['title'] ); ?></h4>
    <div class="accordion-content"><?php echo do_shortcode( $content ); ?></div>
  </section>

  <?php

  return ob_get_clean();
}
add_shortcode( 'accordion_item', 'pipit_shortcode_accordion_item' );
