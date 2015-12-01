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
<div class=" widget-footer">
	<div class="vc_row wpb_row vc_row-fluid">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer widgets') ) : ?>
		<?php endif; // Custom widget Area End ?>
	</div>
</div>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<a href="//studioalloy.nl" rel="Studio Alloy">door Studio Alloy</a>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
