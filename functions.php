<?php
/**
 * ajy functions and definitions
 *
 * @package ajy
 */

// ** IN THIS FILE **//
/**
 * 1. Set up theme, init stuff
 * 2. Enqueue scripts and styles
 * 3. reference the functions in the inc/ directory */

// 1. Set up theme, init stuff

/**
* Set the content width based on the theme's design and stylesheet. This affects oembed sizes.
*/
if ( ! isset( $content_width ) ) { $content_width = 640; /* pixels */ }

if ( ! function_exists( 'ajy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ajy_setup() {

	// Make theme available for translation - see underscores
	//load_theme_textdomain( 'ajy', get_template_directory() . '/languages' );
  
	add_theme_support( 'automatic-feed-links' ); //add default posts and comments rss feed links to <head>
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'menus' ); //needed because I'm not calling register_nav_menu(), I handle it through widgets
  // add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
  // add_theme_support( 'custom-background', apply_filters( 'ajy_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // ajy_setup
add_action( 'after_setup_theme', 'ajy_setup' );

// 2. Enqueue Scripts and Styles

function ajy_scripts() {
  //because I'm not familiar enough with this yet...
  //wp_enqueue_style( $handle, $src, $deps, $ver, $media );
  //wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
  
	wp_enqueue_style( 'ajy-style', get_template_directory_uri() . '/css/style.css', false, '20130720', 'screen' );
  //aaron look - _s script
	wp_enqueue_script( 'ajy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130720', true );
  //added by aaron
  wp_enqueue_script( 'ajy-modernizr', get_template_directory_uri() . '/js/ajy.modernizr.js', array('jquery'), '20130720', false ); //modernizr
  //foundation scripts - uncomment as needed.
  wp_enqueue_script( 'ajy-foundation', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.js', array('jquery'), '20130720', true ); //required for any of the below
  //wp_enqueue_script( 'ajy-foundation-placeholder', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.placeholder.js', array('jquery','ajy-foundation'), '20130720', true );
  wp_enqueue_script( 'ajy-foundation-forms', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.forms.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-section', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.section.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-reveal', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.reveal.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-tooltips', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.tooltips.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-joyride', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.joyride.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-orbit', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.orbit.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-alerts', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.alerts.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-cookie', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.cookie.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-dropdown', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.dropdown.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-topbar', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.topbar.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-clearing', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.clearing.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-magellan', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.magellan.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-interchange', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.interchange.js', array('jquery','ajy-foundation'), '20130720', true );
  //wp_enqueue_script( 'ajy-foundation-abide', get_template_directory_uri() . '/foundation/javascripts/foundation/foundation.abide.js', array('jquery','ajy-foundation'), '20130720', true );
  
  //my main script
  wp_enqueue_script( 'ajy', get_template_directory_uri() . '/js/ajy.js', array('jquery', 'ajy-modernizr'), '20130720', false );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ajy_scripts' );

//** 3. REQUIRE FUNCTIONS FROM INC/ DIRECTORY **//

require get_template_directory() . '/inc/cleanup.php'; // clean up the <head>
require get_template_directory() . '/inc/widget-areas.php'; // register widget areas
require get_template_directory() . '/inc/template-tags.php'; // custom template tags for this theme
require get_template_directory() . '/inc/shortcodes.php'; // add shortcodes
