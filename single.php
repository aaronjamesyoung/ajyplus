<?php
/**
 * The Template for displaying all single posts.
 *
 * @package ajy
 */

get_header(); ?>

  <section id="content" class="site-content" role="main">

  <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'content', 'single' ); ?>

    <?php ajy_content_nav( 'nav-below' ); ?>

    <?php
      // If comments are open or we have at least one comment, load up the comment template
      if ( comments_open() || '0' != get_comments_number() )
        comments_template();
    ?>

  <?php endwhile; // end of the loop. ?>

  </section><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
