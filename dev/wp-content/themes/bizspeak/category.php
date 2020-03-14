<?php
/**
 * @package themewing
 */

get_header(); ?>

<div class="main-content">
	<?php get_template_part( 'header-banner-title' ); ?>
	<div class="container">

		<div class="row">

			<div id="content" class="main-content-inner col-sm-8">

			<?php if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile; 

				else :
				get_template_part( 'no-results', 'index' ); 
			
			endif;
			themewing_content_nav( 'nav-below' ); ?>

		</div> <!-- close .main-content-inner -->

		<?php get_sidebar(); ?>

<?php get_footer(); ?>