<?php
global $themewing_options;
?>

<div class="logo-header-inner col-md-4 col-sm-3">
	<div>
		<?php if ( isset($themewing_options['logo_type']) && $themewing_options['logo_type'] ){

			$logo=esc_attr($themewing_options['logo_type']);

		    switch ($logo) {

		        case 'logo_image':

		        if (!empty($themewing_options['logo_img']['url']))
		        	{ ?>

		        	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img class="entry-logo img-responsive" src="<?php echo esc_url($themewing_options['logo_img']['url']); ?>" alt="<?php _e('logo', 'bizspeak'); ?>" title="<?php _e('logo', 'bizspeak'); ?>"></a>

			        <?php } else { ?>

						<div class="logo-branding">
						   <h2 class="logo-text"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
							<h4 class="logo-slogan"><?php bloginfo( 'description' ); ?></h4>
						</div>

			        <?php }

		            break;

		        case 'logo_name':

		        	if ( isset($themewing_options['logo_text']) && $themewing_options['logo_text'] ||
		        		isset($themewing_options['logo_slogan']) && $themewing_options['logo_slogan'] ) { ?>

						<div class="logo-branding">
						   <h2 class="logo-text"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo sanitize_text_field($themewing_options['logo_text']) ?></a></h2>
							<h4 class="logo-slogan"><?php echo esc_attr($themewing_options['logo_slogan']); ?></h4>
						</div>

		        	<?php }else { ?>

						<div class="logo-branding">
						   <h2 class="logo-text"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
							<h4 class="logo-slogan"><?php esc_attr(bloginfo( 'description' )); ?></h4>
						</div>

		        	<?php }

		            break;

		        default:
		        	 ?>
						<div class="logo-branding">
						   <h2 class="logo-text"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
							<h4 class="logo-slogan"><?php esc_attr(bloginfo( 'description' )); ?></h4>
						</div>
		        	<?php
		            break;
		    }

			}else { ?>

				<div class="logo-branding">
				   <h2 class="logo-text"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<h4 class="logo-slogan"><?php esc_attr(bloginfo( 'description' )); ?></h4>
				</div>
		<?php } ?>
	</div>
</div>

<?php if ( !empty($themewing_options['top_supports_en']) || !empty($themewing_options['top_time_en']) ) { ?>
<div class="col-md-8 col-sm-9">
	<ul class="top-info">
		<?php if (isset($themewing_options['top_supports_en'])) { ?>
		<?php if ( $themewing_options['top_supports_text'] || $themewing_options['top_supports_number'] ) { ?>
		<li>
			<div class="info-box"><span class="info-icon"><i class="fa fa-phone">&nbsp;</i></span>
				<div class="info-box-content">
					<?php if ( isset($themewing_options['top_supports_text']) ) { ?>
					<p class="info-box-title"><?php echo wp_kses_post($themewing_options['top_supports_text']);?></p>
					<?php }?>
					<?php if ( isset($themewing_options['top_supports_number']) ) { ?>
					<p class="info-box-subtitle"><?php echo wp_kses_post($themewing_options['top_supports_number']);?></p>
					<?php }?>
				</div>
			</div>
		</li>
		<?php }?>
		<?php }?>
		<?php if (isset($themewing_options['top_time_en'])) { ?>
		<?php if ( $themewing_options['top_time_text'] || $themewing_options['top_time_date'] ) { ?>
		<li>
			<div class="info-box"><span class="info-icon"><i class="fa fa-compass">&nbsp;</i></span>
				<div class="info-box-content">
					<?php if ( isset($themewing_options['top_time_text']) ) { ?>
					<p class="info-box-title"><?php echo wp_kses_post($themewing_options['top_time_text']);?></p>
					<?php }?>
					<?php if ( isset($themewing_options['top_time_date']) ) { ?>
					<p class="info-box-subtitle"><?php echo wp_kses_post($themewing_options['top_time_date']);?></p>
					<?php }?>
				</div>
			</div>
		</li>
		<?php }?>
		<?php }?>
	</ul>
</div>
<?php }?>


