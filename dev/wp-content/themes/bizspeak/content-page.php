<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package themewing
 */
?>

<div id="content" class="col-sm-12">	
	<div class="page-content-inner">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	            <header class="entry-header">
	                <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
	                <div class="featured-image">
	                    <a href="<?php  esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); } ?></a>
	                </div>
	            </header>
	        <?php } //.entry-thumbnail ?>  
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'bizspeak' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</div><!-- .col-sm-12 -->

