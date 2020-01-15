<?php

function pipit_register_required_plugins() {
  
  $plugins = array(
    array(
      'name'     => 'Redux Framework',
      'slug'     => 'redux-framework',
      'required' => true,
    ),
    array(
      'name' => 'Pipit Essentials',
      'slug' => 'pipit-essentials',
      'source' => get_template_directory() . '/inc/plugins/pipit-essentials.zip',
      'required' => true,
      'version' => '1.0',
    ),
    array(
      'name'     => 'Contact Form 7',
      'slug'     => 'contact-form-7',
      'required' => false,
    ),
    array(
      'name'     => 'WooSidebars',
      'slug'     => 'woosidebars',
      'required' => false,
    ),
  );

  $config = array(
    'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
    'is_automatic' => true,                    // Automatically activate plugins after installation or not.
  );

  tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'pipit_register_required_plugins' );
