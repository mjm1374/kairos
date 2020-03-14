<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package themewing
 */

get_header(); ?>

<div class="main-content">

	<?php get_template_part( 'header-banner-title' ); ?>

	<div class="container">

		<div class="row">

			<div id="content" class="col-sm-8">

				<div class="main-content-inner">

					<?php if ( have_posts() ) : ?>

						<header class="search-header">
							<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'bizspeak' ), '<span class="span-search">' . esc_attr( get_search_query() ) . '</span>' ); ?></h2>
						</header><!-- .page-header -->

						<?php // start the loop. ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>

						<?php themewing_content_nav( 'nav-below' ); ?>

					<?php else : ?>

						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; // end of loop. ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
<?php get_footer(); ?>