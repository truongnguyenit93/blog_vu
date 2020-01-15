<?php

class Pipit_Categories_Widget extends WP_Widget {

  function __construct() {
    
    parent::__construct(
      'pipit_categories_widget',
      esc_html__( 'Mondo: Categories', 'pipit' ),
      array( 'description' => esc_html__( 'Displays custom categories.', 'pipit' ), )
    );
  }

  public function widget( $args, $instance ) {

    extract( $args );
    $title = apply_filters( 'widget_title', $instance['title'] );

    $return = null;

    echo $before_widget;
    if ( ! empty( $title ) ) {
      echo $before_title . $title . $after_title;
    }

    $categories = get_categories();

    ob_start(); ?>

    <ul class="categories-list">

    <?php foreach ( $categories as $category ) : ?>

      <li class="category-item">
        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'pipit' ), $category->name ) ); ?>">
          <span class="category-item-name"><?php echo esc_html( $category->name ); ?></span>
          <span class="category-item-count-container"><span class="category-item-count-badge"><?php echo esc_html( $category->count ); ?></span></span>
        </a>
      </li>

    <?php endforeach; ?>

    </ul>

    <?php

    echo ob_get_clean();

    echo $after_widget;
  }

  public function form( $instance ) {

    $defaults = array( 'title' => 'Categories' );
    $instance = wp_parse_args( (array) $instance, $defaults );

    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'pipit' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>
    <?php 
  }

  public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

}
