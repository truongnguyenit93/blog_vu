<?php

function pipit_shortcode_gap( $atts, $content = null ) {

  $atts = wp_parse_args( $atts, array(
    'height' => '20'
  ) );

  $css = 'height: ' . $atts['height'] . 'px;';

  return '<div class="gap" style="' . esc_attr( $css ) . '"></div>';
}
add_shortcode( 'gap', 'pipit_shortcode_gap' );
