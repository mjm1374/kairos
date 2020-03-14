<?php
get_header();
?>
<?php get_template_part( 'header-banner-title' ); ?>
<div class="main-content">
  <div class="container">
    <div class="in-main-content">
      <div class="row">
        <div id="content" class="col-sm-12">
          <div class="main-content-inner wooshop clearfix">
            <?php if ( have_posts() ) :?>
                <?php woocommerce_content(); ?>
            <?php endif; ?>
          </div> <!-- close .main-content-inner -->
        </div> <!-- close .col-sm-12 -->
      </div><!--/.row -->


<?php get_footer(); ?>
