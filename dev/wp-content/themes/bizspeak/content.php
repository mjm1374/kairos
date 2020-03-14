<?php
/**
 * @package themewing
 */

global $themewing_options; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php get_template_part( 'includes/post-format' ); ?>

    <?php get_template_part( 'includes/entry-blog' ); ?>

</article><!-- #post-## -->
