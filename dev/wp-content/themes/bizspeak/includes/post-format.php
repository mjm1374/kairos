<?php 
global $themewing_options; 
?>

<header class="page-header">

    <?php if(!is_single()) { ?>
    <h2 class="page-title">
        <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2>
    <?php } ?>

    <?php if ( 'post' == get_post_type() ) : ?>
        <ul class="entry-meta">

			<?php if (isset($themewing_options['blog_author']) && $themewing_options['blog_author'] ) { ?>
			    <li class="author"> <?php _e('By', 'bizspeak'); ?> <?php the_author_posts_link() ?></li>
			<?php } ?>   

            <?php if (isset($themewing_options['blog_category']) && $themewing_options['blog_category'] ) { ?>
                <li class="meta-category"><?php echo  get_the_category_list(', '); ?></li>
            <?php } ?>  

             <?php if (isset($themewing_options['blog_date']) && $themewing_options['blog_date'] ) { ?>
             <li class="publish-date">
               <?php _e('Posted on', 'bizspeak'); ?> <time class="entry-date" datetime="<?php esc_attr( the_time( 'c' ) ); ?>"><?php the_time('j M,  Y'); ?></time>
             </li> 
             <?php } ?>  

            <?php if (isset($themewing_options['blog_edit_en']) && $themewing_options['blog_edit_en']) {
           
                if ( is_user_logged_in() ) { ?>
                    <li class="edit-link">
                         <?php edit_post_link( __( 'Edit', 'bizspeak' ), '<span class="edit-link">', '</span>' ); ?>
                    </li>
                <?php } 
            } ?> 

            <?php if (isset($themewing_options['blog_comment']) && $themewing_options['blog_comment'] ){ ?> 
                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <li class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bizspeak' ), __( '1 Comment', 'bizspeak' ), __( '% Comments', 'bizspeak' ) ); ?>
                </li>
                <?php endif; ?>
            <?php } ?>    
        </ul><!-- .entry-meta -->
    <?php endif; ?>

</header><!-- .entry-header -->  

<?php if(has_post_format('audio')) : ?>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="featured-image">
                <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); ?></a>
            </div>
            <?php } ?>
                <div class="entry-audio">
                    <?php echo rwmb_meta( 'tw_postaudio' ); ?>
                </div> <!--/.audio-content -->
        </header>            

<?php elseif(has_post_format('link')) : ?> 

    <?php if ( has_post_thumbnail() ) { 
        $image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-size' );
        $style = 'background-image:url('.$image[0].');background-repeat:no-repeat;background-size: cover;width:100%;height:100%;';
    }else {
        $style = 'background-color:#333;';
    }
    $link = rwmb_meta( 'tw_postlink' );
    ?>   
    <header class="entry-header">
        <div class="entry-image">
            <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                <div class="entry-overlay">
                    <div style="<?php echo wp_kses_post($style); ?>"></div>
                </div>
                <div class="quote-link">
                    <h4><?php echo esc_url( rwmb_meta( 'tw_postlink' ) ); ?></h4>
                </div>

            </a>
        </div>
    </header>

 <?php elseif(has_post_format('quote')) : ?> 

    <?php if ( has_post_thumbnail() ) { 
        $image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-size' );
        $style = 'background-image:url('.$image[0].');background-repeat:no-repeat;background-size: cover;width:100%;height:100%;';
    }else {
        $style = 'background-color:#333;';
    }
    ?>    
    <header class="entry-header">

        <div class="entry-qoute">
             <div class="entry-image">
                <div class="entry-overlay">
                    <div style="<?php echo wp_kses_post($style); ?>"></div>
                </div>
                <div class="quote-link">
                    <p><i class="fa fa-quote-left"></i> <?php echo rwmb_meta( 'tw_postquoteintro' ); ?> <i class="fa fa-quote-right"></i></p>
                    <span> <?php echo esc_html( rwmb_meta( 'tw_postquoteauthor' ) ); ?></span>
                </div>
            </div>
        </div> 
    </header>


<?php elseif(has_post_format('video')) : ?>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="featured-image">
                <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); ?></a>
            </div>
            <?php } ?>

            <div class="entry-video">
                <?php $video_type = esc_html( rwmb_meta( 'tw_video_type' ) ); ?>
                <?php $video = esc_html( rwmb_meta( 'tw_postvideo' ) ); ?>

                <?php 
                if ($video_type == 1): ?>
                    <?php echo '<iframe height="450" src="http://www.youtube.com/embed/'.$video.'?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;hd=1&amp;autohide=1&amp;color=white" allowfullscreen></iframe>'; ?>
                <?php elseif ($video_type == 2): ?>
                    <?php echo '<iframe src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" height="450" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                <?php endif; ?>
            </div> 
        </header>
        
<?php elseif(has_post_format('gallery')) : ?>   
    <header class="entry-header">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-image">
            <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); ?></a>
        </div>
        <?php } ?>

        <div class="entry-content-gallery">
            <?php $gal_images = rwmb_meta('tw_postgallery','type=image_advanced'); ?>
            <?php if(count($gal_images) > 0) { ?>
            <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $gal_img = 1; ?>
                    <?php foreach( $gal_images as $gal_image ) { ?>
                    <div class="item <?php if($gal_img == 1) echo 'active'; ?>">
                        <?php $images = wp_get_attachment_image_src( $gal_image['ID'], 'full-size' ); ?>
                        <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt=" <?php echo esc_attr(the_title_attribute()); ?> ">
                    </div>
                    <?php $gal_img++ ?>
                    <?php } ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <?php } ?>
        </div><!--/.gallery-->  
    </header>
   
<?php elseif(has_post_format('aside')) : ?>   

    <?php if ( has_post_thumbnail() ) { ?>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
            <div class="featured-image">
                <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); } ?></a>
            </div>
        </header>
    <?php } //.entry-thumbnail ?>   

<?php elseif(has_post_format('image')) : ?>   

    <?php if ( has_post_thumbnail() ) { ?>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
            <div class="featured-image">
                <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); } ?></a>
            </div>
        </header>
    <?php } //.entry-thumbnail ?>    

<?php elseif(has_post_format('standard')) : ?>   

    <header class="entry-header">
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-image">
            <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); ?></a>
        </div>
        <?php } ?>
    </header>
              
<?php else : ?> 

    <header class="entry-header">
        <?php if ( has_post_thumbnail()) { ?>
            <div class="featured-image">
                <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full-size', array('class' => 'img-responsive')); ?></a>
            </div>
        <?php } ?>
    </header>
    
<?php endif; ?>  