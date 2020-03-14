<?php global $themewing_options; ?>

<div class="social-buttons top-social unstyled">
	<ul>
		<?php if ( isset($themewing_options['btn_facebook']) && $themewing_options['btn_facebook'] ){?>	
			<li><a class="facebook" href="<?php echo esc_url( $themewing_options['btn_facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_twitter']) && $themewing_options['btn_twitter']){?>	
			<li><a class="twitter" href="<?php echo esc_url( $themewing_options['btn_twitter'] ); ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_gplus']) && $themewing_options['btn_gplus'] ){?>		
			<li><a class="g-plus" href="<?php echo esc_url( $themewing_options['btn_gplus'] ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_instagram']) && $themewing_options['btn_instagram'] ){?>	
			<li><a class="instagram" href="<?php echo esc_url( $themewing_options['btn_instagram'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
		<?php }?>		
		<?php if ( isset($themewing_options['btn_flickr']) && $themewing_options['btn_flickr'] ){?>	
			<li><a class="instagram" href="<?php echo esc_url( $themewing_options['btn_flickr'] ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_linkedin']) && $themewing_options['btn_linkedin'] ){?>
			<li><a class="linkedin" href="<?php echo esc_url( $themewing_options['btn_linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_pinterest']) && $themewing_options['btn_pinterest'] ){?>
			<li><a class="pinterest" href="<?php echo esc_url( $themewing_options['btn_pinterest'] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_delicious']) && $themewing_options['btn_delicious'] ){?>	
			<li><a class="delicious" href="<?php echo esc_url( $themewing_options['btn_delicious'] ); ?>" target="_blank"><i class="fa fa-delicious"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_tumblr']) && $themewing_options['btn_tumblr'] ){?>	
			<li><a class="tumblr" href="<?php echo esc_url( $themewing_options['btn_tumblr'] ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
		<?php }?>
		<?php if ( isset($themewing_options['btn_stumbleupon']) && $themewing_options['btn_stumbleupon'] ){?>	
			<li><a class="stumbleupon" href="<?php echo esc_url( $themewing_options['btn_stumbleupon'] ); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>
		<?php }?>	 
		
	</ul>	
</div>



