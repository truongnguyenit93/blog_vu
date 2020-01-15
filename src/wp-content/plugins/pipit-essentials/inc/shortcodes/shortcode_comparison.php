<?php

function pipit_shortcode_comparison( $atts, $content = null ) {

  $atts = wp_parse_args( $atts, array(
    'original' => null,
    'alt_original' => null,
    'modified' => null,
    'alt_modified' => null
  ) );

  ob_start(); ?>
  
  <div class="comparison cd-image-container">
    <img src="<?php echo esc_url( $atts['original'] ); ?>" alt="<?php echo esc_attr( $atts['alt_original'] ); ?>">
    
    <span class="cd-image-label" data-type="original">
      <?php echo esc_html( apply_filters( 'pipit_comparison_original_label', esc_html__( 'Original', 'pipit' ) ) ); ?>
    </span>

    <div class="cd-resize-img">
      <img src="<?php echo esc_url( $atts['modified'] ); ?>" alt="<?php echo esc_attr( $atts['alt_modified'] ); ?>">
      <span class="cd-image-label" data-type="modified">
        <?php echo esc_html( apply_filters( 'pipit_comparison_modified_label', esc_html__( 'Modified', 'pipit' ) ) ); ?>
      </span>
    </div>

    <span class="cd-handle"></span>
  </div>

  <?php

  return ob_get_clean();
}
add_shortcode( 'comparison', 'pipit_shortcode_comparison' );
