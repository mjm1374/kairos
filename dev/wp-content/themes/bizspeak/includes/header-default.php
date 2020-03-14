<?php 

global $themewing_options;

?>

<header id="masthead" class="site-header">
    <div class="container">
        <div class="row">
            <?php get_template_part( 'includes/logo' ); ?> 
        </div><!-- end row -->
    </div>       
</header><!-- #masthead -->     
<div class="menubar navbar ts-mainnav"> 
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php get_template_part( 'includes/main-nav' ); ?>           
            </div> 
        </div><!-- End of row -->
        <?php if(isset($themewing_options['enable_saerch']) && $themewing_options['enable_saerch']){ ?>
            <div class="head-search">
                <?php echo esc_attr(get_search_form());?>
            </div>
        <?php } ?>
    </div><!-- End of container -->
</div><!-- End of menubar -->   


