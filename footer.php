<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Alloy
*/

?>

</div><!-- #content -->
<footer class="mve-footer">
<div class="inner flex">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer widgets') ) : ?>
		<?php endif; // Custom widget Area End ?>
	</div>
</footer>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="sa-inner">
	  <div class="sa-col">
	    <?php echo get_bloginfo('name'); ?>
	  </div>
	  <a href="//studioalloy.nl" target="_blank" class="sa-credits">
	      <div class="sa-linkback">
	         <p>Studio Alloy</p>
	        <span>design & code</span>
	    </div>
	    <img src="//studioalloy.nl/img/alloy-logo-bw.svg">
	  </a>
	  </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
