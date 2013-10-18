<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ajy
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('header-widget-area') ) : else : ?>
    <?php endif; ?>
	</div><!-- #secondary -->
