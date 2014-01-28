<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ajy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width" />
  
  <title><?php wp_title( '|', true, 'right' ); ?></title>
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon.png" />
	<?php if (is_search()) { ?>
  <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
      <?php if(is_front_page()) { ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <?php } else { ?>
      <h4 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h4>
      <?php } ?>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
    
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('header-widget-area') ) : else : ?>
    <?php endif; ?>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<h1 class="menu-toggle"><?php _e( 'Menu', 'ajy' ); ?></h1>
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'ajy' ); ?>"><?php _e( 'Skip to content', 'ajy' ); ?></a></div>

			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('nav-widget-area') ) : else : ?>
      <?php endif; ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="main" class="site-main">
