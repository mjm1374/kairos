<?php
/**
 * @package themewing
 */
global $themewing_options; 
get_header();
?>

<div class="main-content">

	<?php get_template_part( 'header-banner-title' ); ?>

	<div class="container">
		<div class="row">
            <?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
               <div id="content" class="col-sm-8">
            <?php } else { ?>
               <div id="content" class="col-lg-12 col-md-12 col-sm-12">
            <?php } ?>
				<div class="main-content-inner">
					<?php if ( have_posts() ) :
						/* Start the Loop */

						while ( have_posts() ) : the_post();

							get_template_part( 'content', get_post_format() );

						endwhile;

						else :

						get_template_part( 'no-results', 'index' );

					    endif; 
						themewing_content_nav( 'nav-below' );
					?>
				</div> <!-- close .main-content-inner -->
			</div> <!-- close .col-sm-8 -->
         <?php if ( is_active_sidebar( 'sidebar' ) ) {get_sidebar();} ?>

<?php get_footer(); ?>