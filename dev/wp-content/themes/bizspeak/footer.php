<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package themewing
 */
global $themewing_options;
?>
			</div><!--/.row -->
		</div><!-- /.container -->	
	</div><!-- /.main-content -->
		<div id="footer" class="footer">
			<?php if (is_active_sidebar( 'footer' ) ) : ?>
				<div id="footer-in" class="footer-in">
					<div class="container">
						<div class="row">
				    		<?php dynamic_sidebar('footer'); ?>
				    	</div>
			    	</div>
		    	</div>
			<?php endif; ?>	    	
			<footer id="copyright" class="copyright">
				<div class="container">
					<div class="row">
						<?php if( isset($themewing_options['copyright_en']) && $themewing_options['copyright_en'] ) { ?>
							<div class="col-sm-4 copyright-info">
								<?php  if( isset($themewing_options['copyright']) )  echo wp_kses_post($themewing_options['copyright']); ?>
							</div><!-- close .site-info -->
						 <?php } ?>

						<div class="col-sm-6 pull-right">
							<div class="footer-menu ">
								<?php if ( has_nav_menu( 'footer' ) ) : ?>
									<?php
										// footer Nav
										wp_nav_menu( array(
											'theme_location' => 'footer',
											'depth'          => 1,
											'menu_class' => 'nav footer-nav',
											'fallback_cb' => '',
										) );
									?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<?php if (isset($themewing_options['scroll_en']) && $themewing_options['scroll_en'] ) { ?>
					<div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix">
						<button class="btn btn-primary" title="<?php echo esc_attr__('Back to Top','bizspeak'); ?> ">
							<i class="fa fa-angle-double-up"></i>
						</button>
					</div>	
					<?php } ?>

				</div>
			</footer><!--/.footer-area -->
		</div>				    	
	</div><!--/.body-inner -->
	<?php wp_footer(); ?>
</body>
</html>