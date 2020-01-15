<?php

function pipit_shortcode_tab( $atts, $content = null ) {

  global $tab_content;
  $tab_content = '';

  ob_start(); ?>

  <div class="tab">
    <ul class="tab-titles clearfix"><?php echo do_shortcode( $content ); ?></ul>
    <?php echo do_shortcode( $tab_content ); ?>
  </div>

  <?php

  return ob_get_clean();
}
add_shortcode( 'tab', 'pipit_shortcode_tab' );

function pipit_shortcode_tab_item( $atts, $content = null ) {

  global $tab_content;

  $atts = wp_parse_args( $atts, array(
    'title' => null,
    'open' => false
  ) );

  $open = filter_var( $atts['open'], FILTER_VALIDATE_BOOLEAN );

  $tab_class = $open ? ' open' : '';
  $tab_content .= '<div class="tab-content' . esc_attr( $tab_class ) . '">' . do_shortcode( $content ) . '</div>';

  ob_start(); ?>

  <li class="tab-title<?php echo esc_attr( $open ? ' active' : '' ); ?>"><?php echo esc_html( $atts['title'] ); ?></li>

  <?php

  return ob_get_clean();
}
add_shortcode( 'tab_item', 'pipit_shortcode_tab_item' );
