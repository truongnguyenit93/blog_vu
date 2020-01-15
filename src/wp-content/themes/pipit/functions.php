<?php

define( 'PIPIT_VERSION', '1.2' );
define( 'PIPIT_TRANSIENTS_MINUTE', '5' );

if ( ! function_exists( 'pipit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pipit_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Pipit, use a find and replace
	 * to change 'pipit' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pipit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'pipit' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'video',
		'gallery',
	) );

	/*
	 * Enable support for WooCommerce.
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * Add custom image sizes.
	 */
	add_image_size( 'pipit_full_750', 750 );
	add_image_size( 'pipit_full_1140', 1140 );
}
endif;
add_action( 'after_setup_theme', 'pipit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pipit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pipit_content_width', 640 );
}
add_action( 'after_setup_theme', 'pipit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pipit_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'pipit' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title bordered-title">',
		'after_title'   => '</h4>',
	) );
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'pipit' ),
			'id'            => 'sidebar-shop',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title bordered-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'pipit_widgets_init' );

/**
 * Register Google Fonts.
 */
function pipit_fonts_url() {

    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'pipit' ) ) {
      $font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,600,700|Open Sans Condensed:400,700&subset=latin,latin-ext' ), '//fonts.googleapis.com/css' );
    }

    return esc_url( $font_url );
}

/**
 * Enqueue scripts and styles.
 */
function pipit_scripts() {

	wp_enqueue_style( 'pipit-google-fonts', pipit_fonts_url(), array(), PIPIT_VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style( 'pipit-style', get_stylesheet_uri(), array(), PIPIT_VERSION );
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'pipit-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array(), PIPIT_VERSION );
	}

	wp_enqueue_script( 'pipit-script', get_template_directory_uri() . '/js/pipit.min.js', array( 'jquery' ), PIPIT_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$pipit_admin_data = pipit_get_admin_data();

	$retina_logo = isset( $pipit_admin_data['retina_logo'] ) && pipit_redux_image_set( $pipit_admin_data['retina_logo'] ) ? $pipit_admin_data['retina_logo']['url'] : '';
	$retina_logo_light = isset( $pipit_admin_data['retina_logo_light'] ) && pipit_redux_image_set( $pipit_admin_data['retina_logo_light'] ) ? $pipit_admin_data['retina_logo_light']['url'] : '';

	$pipit_passing_options = array(
		'site_url' => esc_url( site_url() ),
		'admin_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'like_nonce' => wp_create_nonce( 'pipit_like_nonce' ),
		'like_title' => esc_html__( 'Click to like this post.', 'pipit' ),
		'unlike_title' => esc_html__( 'You have already liked this post. Click again to unlike it.', 'pipit' ),
		'disable_sticky_sidebar' => $pipit_admin_data['disable_sticky_sidebar'],
		'enable_media_feed' => $pipit_admin_data['enable_media_feed'],
		'retina_logo' => esc_url( $retina_logo ),
		'retina_logo_light' => esc_url( $retina_logo_light )
	);
	wp_localize_script( 'pipit-script', 'mondoParams', $pipit_passing_options );
}
add_action( 'wp_enqueue_scripts', 'pipit_scripts' );

function pipit_admin_scripts() {

  wp_enqueue_style( 'pipit-admin', get_template_directory_uri() . '/css/admin.css', array(), PIPIT_VERSION );
}
add_action( 'admin_enqueue_scripts', 'pipit_admin_scripts' );

/**
 * TGM Plugin Activation.
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/mondo-tgmpa.php';

/**
 * Redux framework.
 */
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {

	require_once get_template_directory() . '/inc/mondo-config.php';

	function pipit_remove_dashboard_widget() {

	 	remove_meta_box( 'redux_dashboard_widget', 'dashboard', 'side' );
	}
	add_action( 'wp_dashboard_setup', 'pipit_remove_dashboard_widget', 20 );
}

/**
 * Custom walker for the primary menu.
 */
require get_template_directory() . '/inc/mondo-walker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Metabox framework.
 */
require get_template_directory() . '/inc/meta-box/meta-box.php';
require get_template_directory() . '/inc/mondo-metabox.php';

/**
 * WooCommerce custom functions.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/mondo-woocommerce.php';
}
