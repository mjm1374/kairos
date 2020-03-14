<?php
/**
 * The sidebar containing the main widget area
 *
 * @package themewing
 */
?>

<div class="sidebar col-sm-4">

	<?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
	<div class="sidebar-inner sidebar">

		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php esc_attr( get_search_form() ); ?>
			</aside>

			<aside id="archives" class="widget widget_archive">
				<h3 class="widget-title"><?php _e( 'Archives', 'bizspeak' ); ?></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget widget_meta">
				<h3 class="widget-title"><?php _e( 'Meta', 'bizspeak' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; ?>

	</div> <!-- close .sidebar-padder -->
</div> <!-- close .sidebar -->
