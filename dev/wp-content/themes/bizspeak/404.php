<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>
<div class="main-content">
	<div class="container">
	    <div class="row">
		    <div id="content" class="main-content-inner col-sm-12">
			    <div class="404-content">	
					<header class="page-header">
						<h2 class="page-title"><?php _e( 'Oops! Something went wrong here', 'bizspeak' ); ?></h2>
						<p><?php _e( 'Nothing could be found at this location', 'bizspeak' ); ?></p>
					</header><!-- .page-header -->
					<div class="page-content 404page">
						<a class="common-btn common-btns" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php _e( 'Homepage', 'bizspeak' ); ?></a>
					</div><!-- .page-content -->
				</div>
			</div>
<?php get_footer(); ?>