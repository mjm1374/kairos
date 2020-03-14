<?php 
/**
* Template Name: Page With sidebar
*/
get_header();?>

<div class="main-content">
	<?php get_template_part( 'header-banner-title' ); ?>
    <div class="container">

        <div class="row">
			<div id="content" class="col-sm-8">
				<div class="main-content-inner">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
											
						<?php get_template_part('content', 'page'); ?>
											
					<?php endwhile; endif; ?>
				</div>	
			</div>
			<?php get_sidebar(); ?>	

<?php get_footer(); ?>