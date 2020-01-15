<?php

require_once( get_template_directory() . '/inc/widgets/widget_about.php' );
require_once( get_template_directory() . '/inc/widgets/widget_facebook.php' );
require_once( get_template_directory() . '/inc/widgets/widget_instagram.php' );
require_once( get_template_directory() . '/inc/widgets/widget_flickr.php' );
require_once( get_template_directory() . '/inc/widgets/widget_500px.php' );
require_once( get_template_directory() . '/inc/widgets/widget_dribbble.php' );
require_once( get_template_directory() . '/inc/widgets/widget_top-stories.php' );
require_once( get_template_directory() . '/inc/widgets/widget_top-reviews.php' );
require_once( get_template_directory() . '/inc/widgets/widget_top-authors.php' );
require_once( get_template_directory() . '/inc/widgets/widget_categories.php' );

function pipit_register_widgets() {
  register_widget( 'Pipit_About_Widget' );
  register_widget( 'Pipit_Facebook_Widget' );
  register_widget( 'Pipit_Instagram_Widget' );
  register_widget( 'Pipit_Flickr_Widget' );
  register_widget( 'Pipit_500px_Widget' );
  register_widget( 'Pipit_Dribbble_Widget' );
  register_widget( 'Pipit_Top_Stories_Widget' );
  register_widget( 'Pipit_Top_Reviews_Widget' );
  register_widget( 'Pipit_Top_Authors_Widget' );
  register_widget( 'Pipit_Categories_Widget' );
}
add_action( 'widgets_init', 'pipit_register_widgets' );
