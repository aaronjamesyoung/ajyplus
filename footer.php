<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package ajy
 */
?>

	</div><!-- .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-widgets">
      <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widget-area') ) : else : ?>
      <?php endif; ?>
      <div class="site-info widget">
        <p>
          Copyright &copy; <?php echo date('Y'); ?><span><?php bloginfo('name'); ?></span>
        </p>
        <p>
          Design by <span><a href="http://ajy.co">Aaron James Young</a></span>
        </p>
      </div><!-- .site-info -->
    </div>
	</footer><!-- #colophon -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
