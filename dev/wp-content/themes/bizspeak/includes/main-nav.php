<?php
global $themewing_options;
?>

<nav class="main-navigation">
	<div class="site-navigation">
				<div class="site-navigation-inner">
					<div class="navbar-header">
						<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only"><?php _e('Toggle navigation', 'bizspeak'); ?></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</button>
					  </div>

						<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
							'menu_class' => 'nav navbar-nav main-menu',
							'fallback_cb' => '',
							'menu_id' => 'main-menu',
							'walker' => new wp_bootstrap_navwalker()
						)
					); ?>
				</div> <!-- .site-navigation-inner -->

	</div> <!-- .site-navigation -->
</nav> <!-- .navigation -->
	