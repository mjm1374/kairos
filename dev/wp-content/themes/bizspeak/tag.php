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

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php themewing_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>

			</div> <!-- close .main-content-inner -->
			
			<?php get_sidebar(); ?>

<?php get_footer(); ?>