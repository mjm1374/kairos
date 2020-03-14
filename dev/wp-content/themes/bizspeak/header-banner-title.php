<?php
if (!is_home()) {
?>
<div id="banner-area">
	<!-- Subpage title start -->
	<div class="banner-title-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
				    <?php themewing_breadcrumb(); ?>
			  	</div><!-- Subpage title end -->
		  	</div>
	  	</div>
  	</div>
</div><!-- Banner area end -->
<?php } ?>
<div class="page-title-intro">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			            	<?php
	            	if( is_home() && get_option( 'page_for_posts' ) )
	            	{
	            		echo get_the_title( get_option( 'page_for_posts' ) );
	            	}
	            	elseif (is_archive()) {
	            		global $wp_query;
	            		echo esc_html($wp_query->queried_object->name);
	            	}
	            	else
	            	{ ?>
	            		<h2><?php the_title(); ?></h2>
	            	<?php }
            	?>
			   
		  	</div><!-- Subpage title end -->
	  	</div>
  	</div>
</div>
