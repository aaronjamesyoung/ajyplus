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
  //Note:
  //wp_enqueue_style( $handle, $src, $deps, $ver, $media );
  //wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
  
	wp_enqueue_style( 'ajy-style', get_template_directory_uri() . '/css/style.css', false, '20131123', 'screen' );
  //added by aaron
  wp_enqueue_script( 'ajy-modernizr', get_template_directory_uri() . '/js/ajy.modernizr.js', array('jquery'), '20131123', false ); //modernizr

  //foundation scripts - uncomment as needed.
  //EITHER: just use this script...
  wp_enqueue_script( 'ajy-foundation-complete', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation.min.js', array('jquery'), '20131123', true );
  
  // ...OR: Customize the imports here
  //First one is required:
  //wp_enqueue_script( 'ajy-foundation', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.js', array('jquery'), '20131123', true ); //required for any of the below
  //Pick and choose these as needed
  //wp_enqueue_script( 'ajy-foundation-abide', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.abide.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-accordion', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.accordion.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-alert', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.alert.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-clearing', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.clearing.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-dropdown', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.dropdown.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-interchange', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.interchange.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-joyride', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.joyride.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-magellan', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.magellan.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-offcanvas', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.offcanvas.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-orbit', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.orbit.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-reveal', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.reveal.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-tab', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.tab.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-tooltip', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.tooltip.js', array('jquery','ajy-foundation'), '20131123', true );
  //wp_enqueue_script( 'ajy-foundation-topbar', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/foundation/foundation.topbar.js', array('jquery','ajy-foundation'), '20131123', true );
  
  //additional foundation scripts
  //Cookie script... optional with Joyride
  //wp_enqueue_script( 'ajy-foundation-jquery-cookie', get_template_directory_uri() . '/foundation-5/bower_components/foundation/js/vendor/jquery.cookie.js', array('jquery','ajy-foundation','ajy-foundation-joyride'), '20131123', true );
  


  //my main script
  wp_enqueue_script( 'ajy', get_template_directory_uri() . '/js/ajy.js', array('jquery', 'ajy-modernizr'), '20131123', true ); //move this to the footer

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
