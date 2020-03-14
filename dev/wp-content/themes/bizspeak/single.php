<?php
/**
 * The Template for displaying all single posts.
 *
 * @package themewing
 */

get_header();


$column= 'col-sm-8 main-content-inner';

if ( is_active_sidebar( 'sidebar' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
	$column= 'col-sm-8 main-content-inner';
}else{
	$column= 'col-sm-12 main-content-inner';
}

?>
<div class="main-content">

	<?php get_template_part( 'header-banner-title' ); ?>

	<div class="container">

		<div class="row">

		<div id="content" class="<?php echo esc_attr($column); ?>">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content'); ?>

				<?php if (isset($themewing_options['post_nav_en']) && $themewing_options['post_nav_en'] ) { 
		            themewing_content_nav( 'nav-below' ); 
		        }?>

		        <?php if (isset($themewing_options['post_related']) && $themewing_options['post_related'] ) { 
			   		get_template_part('includes/related-posts');
			   	}?>

				<?php if (isset($themewing_options['blog_single_comment_en']) && $themewing_options['blog_single_comment_en'] ) { 

					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				}?>



			<?php endwhile; // end of the loop. ?>
		</div> <!-- close .main-content-inner -->
      <?php if ( is_active_sidebar( 'sidebar' ) ) {get_sidebar();} ?>

<?php get_footer(); ?>