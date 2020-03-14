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


<div class="header2-mainnav menubar">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> 
                <div class="navbar ts-mainnav"> 
                    <?php get_template_part( 'includes/main-nav' ); ?> 
                </div> 
            </div><!-- End of row -->
        </div><!-- End of container -->
        <?php if(isset($themewing_options['enable_saerch']) && $themewing_options['enable_saerch']){ ?>
            <div class="head-search">
                <div class="search">
                    <?php echo esc_attr(get_search_form());?>
                </div>
            </div>
        <?php } ?>
    </div><!-- End of menubar -->  
</div><!-- End of menubar -->  
