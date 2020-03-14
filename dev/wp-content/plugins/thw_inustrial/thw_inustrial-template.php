<?php get_header(); ?>

<?php get_template_part( 'header-banner-title' ); ?>

<?php while( have_posts() ): the_post(); ?>

<!-- Main container start -->
<section id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">

                <div class="practice-single">

                    <div class="practice-content">

                        <p><?php the_content(); ?></p>

                    </div><!-- End practice content -->
                </div><!-- End practice single -->
            </div><!-- Practice content col end -->

        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Main container end -->
    <?php

    if ( is_singular( 'thw_inustrial' ) ) {
        $key = "_post_views_count";
        $id = $post->ID;
        $postview = get_post_meta( $id, $key,true);

        if($postview == ''){
            $postview = 0;
            add_post_meta( $id, $key, 0);
        }
        else{
            $postview = (int)$postview+1;
            update_post_meta( $id, $key, $postview);
        }
    }
 
    ?>
<?php endwhile; ?>

<?php get_footer();