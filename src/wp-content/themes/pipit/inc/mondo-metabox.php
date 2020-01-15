<?php

function pipit_register_meta_boxes( $meta_boxes ) {

  $prefix = 'pipit_';

  $meta_boxes[] = array(
    'id' => 'general_settings',
    'title' => esc_html__( 'General Settings', 'pipit' ),
    'pages' => array( 'post', 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name'     => esc_html__( 'Sidebar', 'pipit' ),
        'id'       => "{$prefix}sidebar",
        'type'     => 'select',
        'options'  => array(
          'right_sidebar' => esc_html__( 'Right Sidebar', 'pipit' ),
          'left_sidebar' => esc_html__( 'Left Sidebar', 'pipit' ),
          'no_sidebar' => esc_html__( 'No Sidebar', 'pipit' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Select an Item', 'pipit' ),
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'hero_settings',
    'title' => esc_html__( 'Hero Settings', 'pipit' ),
    'pages' => array( 'post', 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Enable?', 'pipit' ),
        'id'   => "{$prefix}hero_enable",
        'type' => 'checkbox',
        'std'  => 0,
      ),
      array(
        'name'     => esc_html__( 'Hero Style', 'pipit' ),
        'id'       => "{$prefix}hero_style",
        'type'     => 'select',
        'options'  => array(
          'half' => esc_html__( 'Half Screen', 'pipit' ),
          'full' => esc_html__( 'Full Screen', 'pipit' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Select an Item', 'pipit' ),
      ),
      array(
        'name'     => esc_html__( 'Hero Type', 'pipit' ),
        'id'       => "{$prefix}hero_type",
        'type'     => 'select',
        'options'  => array(
          'image' => esc_html__( 'Image', 'pipit' ),
          'video' => esc_html__( 'Video', 'pipit' ),
          'slider' => esc_html__( 'Slider', 'pipit' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Select an Item', 'pipit' ),
      ),
      array(
        'name'             => esc_html__( 'Background Image', 'pipit' ),
        'id'               => "{$prefix}hero_bg_image",
        'type'             => 'image_advanced',
        'max_file_uploads' => 1,
      ),
      array(
        'name'  => esc_html__( 'Background Video', 'pipit' ),
        'id'    => "{$prefix}hero_bg_video",
        'type'  => 'text',
      ),
      array(
        'name'             => esc_html__( 'Background Slider', 'pipit' ),
        'id'               => "{$prefix}hero_bg_slider",
        'type'             => 'image_advanced',
        'max_file_uploads' => 10,
      ),
      array(
        'name'  => esc_html__( 'Title', 'pipit' ),
        'id'    => "{$prefix}hero_title",
        'type'  => 'text',
      ),
      array(
        'name'  => esc_html__( 'Description', 'pipit' ),
        'id'    => "{$prefix}hero_description",
        'type'  => 'text',
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'feature_settings',
    'title' => esc_html__( 'Featured Post', 'pipit' ),
    'pages' => array( 'post', 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Feature this post?', 'pipit' ),
        'id'   => "{$prefix}featured_post",
        'type' => 'checkbox',
        'std'  => 0,
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'review_settings',
    'title' => esc_html__( 'Review Settings', 'pipit' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name'       => esc_html__( 'Score', 'pipit' ),
        'id'         => "{$prefix}review_score",
        'type'       => 'text',
        'desc'       => esc_html__( 'Score | Label', 'pipit' ),
        'clone'      => true,
        'sort_clone' => true,
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'format_settings',
    'title' => esc_html__( 'Post Format Settings', 'pipit' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Audio Format', 'pipit' ),
        'id'   => 'heading_id',
      ),
      array(
        'name' => esc_html__( 'Audio Embed', 'pipit' ),
        'id'   => "{$prefix}pf_audio_data",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 4,
      ),
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Video Format', 'pipit' ),
        'id'   => 'heading_id',
      ),
      array(
        'name' => esc_html__( 'Video Embed', 'pipit' ),
        'id'   => "{$prefix}pf_video_data",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 4,
      ),
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Gallery Format', 'pipit' ),
        'id'   => 'heading_id',
      ),
      array(
        'name'             => esc_html__( 'Gallery Images', 'pipit' ),
        'id'               => "{$prefix}pf_gallery_data",
        'type'             => 'image_advanced',
        'max_file_uploads' => 10,
      ),
    )
  );

  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'pipit_register_meta_boxes' );
