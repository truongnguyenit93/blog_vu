<?php
/*
Plugin Name: Pipit Essentials
Description: Add main functionalities to Pipit.
Version: 1.0
Author: MondoTheme
Author URI: http://themeforest.net/user/mondotheme
*/

define( 'PIPIT_ESSENTIALS_VERSION', '1.0' );
define( 'PIPIT_ESSENTIALS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PIPIT_ESSENTIALS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require PIPIT_ESSENTIALS_PLUGIN_DIR . '/inc/shortcodes/shortcode_tweet.php';
require PIPIT_ESSENTIALS_PLUGIN_DIR . '/inc/shortcodes/shortcode_comparison.php';
require PIPIT_ESSENTIALS_PLUGIN_DIR . '/inc/shortcodes/shortcode_accordion.php';
require PIPIT_ESSENTIALS_PLUGIN_DIR . '/inc/shortcodes/shortcode_tab.php';
require PIPIT_ESSENTIALS_PLUGIN_DIR . '/inc/shortcodes/shortcode_gap.php';

/*
 * This function removed unwanted <p> and <br> tags from shortcode output
 * It doesn't affect other plugin's shortcodes, but only affects this theme's custom shortcodes
 * The snippet is from bitfade and the gist is here https://gist.github.com/bitfade/4555047
 * You can read the discussion about this snippet from here http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848
 */
function pipit_the_content_filter( $content ) {

  // array of custom shortcodes requiring the fix 
  $block = join( '|', array( 'accordion', 'accordion_item', 'tab', 'tab_item', 'tweet', 'gap', 'comparison' ) );

  // opening tag
  $rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content );
    
  // closing tag
  $rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]", $rep );

  return $rep;
}
add_filter( 'the_content', 'pipit_the_content_filter' );
