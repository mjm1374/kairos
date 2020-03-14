<?php
/**
 * The template for displaying search forms in themewing
 *
 * @package themewing
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<div class="search">
   		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'bizspeak' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'bizspeak' ); ?>">
		<i class="fa fa-search"></i>
	</div>
</form>