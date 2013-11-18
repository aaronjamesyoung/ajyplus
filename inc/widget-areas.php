<?php
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @package ajy
 */

function ajy_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header', 'ajy' ),
		'id'            => 'header-widget-area',
    'description'   => 'These are widgets for the header.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
  
  register_sidebar( array(
		'name'          => __( 'Navigation', 'ajy' ),
		'id'            => 'nav-widget-area',
    'description'   => 'These are widgets for the navigation area.',
		'before_widget' => '', //no wrapper
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
  
  register_sidebar( array(
		'name'          => __( 'Sidebar', 'ajy' ),
		'id'            => 'sidebar-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
  
  register_sidebar( array(
		'name'          => __( 'Footer', 'ajy' ),
		'id'            => 'footer-widget-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'ajy_widgets_init' );
