<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package themewing
 */

get_header(); ?>
<div class="main-content">

	<?php get_template_part( 'header-banner-title' ); ?>

	<div class="container">

		<div class="row">

			<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
			<div id="content" class="main-content-inner col-sm-8">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title">
							<?php
								if ( is_category() ) :
									single_cat_title();

								elseif ( is_tag() ) :
									single_tag_title();

								elseif ( is_author() ) :
									/* Queue the first post, that way we know
									 * what author we're dealing with (if that is the case).
									*/
									the_post();
									printf( __( 'Author: %s', 'bizspeak' ), '<span class="vcard">' . esc_html( get_the_author() ) . '</span>' );
									/* Since we called the_post() above, we need to
									 * rewind the loop back to the beginning that way
									 * we can run the loop properly, in full.
									 */
									rewind_posts();

								elseif ( is_day() ) :
									printf( __( 'Day: %s', 'bizspeak' ), '<span>' . esc_html( get_the_date() ) . '</span>' );

								elseif ( is_month() ) :
									printf( __( 'Month: %s', 'bizspeak' ), '<span>' . esc_html( get_the_date( 'F Y' ) ) . '</span>' );

								elseif ( is_year() ) :
									printf( __( 'Year: %s', 'bizspeak' ), '<span>' . esc_html( get_the_date( 'Y' ) ) . '</span>' );

								elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
									_e( 'Asides', 'bizspeak' );

								elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
									_e( 'Images', 'bizspeak');

								elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
									_e( 'Videos', 'bizspeak' );

								elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
									_e( 'Quotes', 'bizspeak' );

								elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
									_e( 'Links', 'bizspeak' );

								else :
									_e( 'Archives', 'bizspeak' );

								endif;
							?>
						</h1>
						<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', esc_attr ($term_description) );
							endif;
						?>
					</header><!-- .page-header -->

					<?php /* Start the Loop */
					while ( have_posts() ) : the_post();

						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
						
					endwhile;

				else : 
					get_template_part( 'no-results', 'archive' );

				endif;

				themewing_content_nav( 'nav-below' ); ?>

			</div><!-- .content-padder -->
			<?php get_sidebar(); ?>

<?php get_footer(); ?>
