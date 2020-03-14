<?php 
global $themewing_options; 
?>

<div class="entry-blog">

    <?php if ( is_single() ) : ?>

    <div class="entry-summary entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-summary -->

    <?php else : ?>

    <div class="entry-content">
        <?php 
        $continue_reading_en ='';
        $continue_reading = esc_html__('Continue Reading','bizspeak');


        if( isset($themewing_options['blog_continue_en']) && $themewing_options['blog_continue_en'] ){

            if ( isset($themewing_options['blog_continue']) && $themewing_options['blog_continue'] ){
                $continue_reading = $themewing_options['blog_continue'];
             }
            $continue_reading_en = '<span class="readmore-blog">'.$continue_reading.'<i class="fa fa-angle-double-right">&nbsp;</i></span>';

        }

        if (isset($themewing_options['post_charlenght']) && $themewing_options['post_charlenght'] ) {

            if (isset($themewing_options['post_charlenght_limit']) && $themewing_options['post_charlenght_limit'] ) {
               $post_charlenght_limit = $themewing_options['post_charlenght_limit'];
                echo themewing_excerpt_max_charlength( esc_attr($post_charlenght_limit) );
            }else {
               echo themewing_excerpt_max_charlength(250); 
            }
            echo '<span class="fixed-char"><a class="readmore-blog" href="'.get_permalink().'">'.$continue_reading.'<i class="fa fa-angle-double-right">&nbsp;</i></a></span>';
        }else {
        
         echo themewing_excerpt_max_charlength(250);  
         echo '<span class="fixed-char"><a class="readmore-blog" href="'.get_permalink().'">'.$continue_reading.'<i class="fa fa-angle-double-right">&nbsp;</i></a></span>'; 
        }
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'bizspeak' ),
            'after'  => '</div>',
        ) ); ?>
        
    </div><!-- .entry-content -->


    <?php endif; ?>

    <?php if (isset($themewing_options['blog_tag']) && $themewing_options['blog_tag'] ) { ?>
       
        <?php if ( is_single() ): ?>
            <div class="meta-tag"><?php the_tags('', ' ', '<br />'); ?> </div> 
        <?php endif; ?>
    <?php } ?>  
</div> <!--/.entry-blog --> 


 
