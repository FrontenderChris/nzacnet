<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

?>
		</div><!--.mb-container-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
			<?php get_sidebar( 'footer' ); ?>
			<div id="bottom-footer" class="sub-footer-wrapper clearfix">
				<div class="mb-container">
					<div class="site-info">
						<span class="copy-info"><?php echo esc_html( get_theme_mod( 'mantranews_copyright_text', esc_html__( '2018 mantranews', 'mantranews' ) ) ); ?>© All rights reserved</span>
						<span class="sep"> | </span>
						Designed and developed by Troy & Chris
					</div><!-- .site-info -->
					<nav id="footer-navigation" class="sub-footer-navigation" >
						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'fallback_cb' => false, 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
					</nav>
				</div>
			</div><!-- .sub-footer-wrapper -->
	</footer><!-- #colophon -->
	<div id="mb-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
