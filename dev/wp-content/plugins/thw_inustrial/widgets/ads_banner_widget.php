<?php
/**
 * Plugin Name: Ads Banner Image Widget
 */

add_action( 'widgets_init', 'themewing_ads_banner_load_widget' );

function themewing_ads_banner_load_widget() {
	register_widget( 'themewing_ads_banner_widget' );
}

class themewing_ads_banner_widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'themewing_ads_banner_widget', 'description' => __('A widget that displays Banner Image widget', 'themewing_ads_banner_widget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'themewing_ads_banner_widget' );
		parent::__construct( 'themewing_ads_banner_widget', __('Themewing Ads Image', 'themewing_ads_banner_widget'), $widget_ops, $control_ops );
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title 				= apply_filters('widget_title', $instance['title'] );
		$ads_banner_link 	= $instance['ads_banner_link'];
		$ads_banner_img 	= $instance['ads_banner_img'];

		echo $before_widget;

		if ( $title )
			echo $before_title . esc_attr($title) . $after_title;

		?>

		<div class="bizspeak-ads-banner-image">
			<?php

				if($ads_banner_img && $ads_banner_link)
				{
					echo '<a href="'.esc_url($ads_banner_link).'" target="_blank"><img style="width:300px;" src="'.esc_url( $ads_banner_img ).'" alt="'.$title.'"></a>';
				}else{

					if ( !empty($ads_banner_img) )
					{
						echo '<img style="width:300px;" src="'.esc_url( $ads_banner_img ).'" alt="'.esc_attr($title).'">';
					}
					echo '<div class="alert alert-danger" role="alert">' . __( 'Insert Image URL from Media Manager', 'themewing' ).'</div>';
				}
			?>
		</div>

		<?php echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['ads_banner_link'] 	= strip_tags( $new_instance['ads_banner_link'] );
		$instance['ads_banner_img'] 	= strip_tags( $new_instance['ads_banner_img'] );

		return $instance;
	}


	function form( $instance )
	{

		$defaults = array(  'title' => '',
			'ads_banner_link' => '#',
			'ads_banner_img' => ''
			);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title : ', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<!-- image link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_banner_link') ); ?>"><?php _e( 'Ads Banner Image Link', 'themewing' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('ads_banner_link'));?>" name="<?php echo esc_attr($this->get_field_name('ads_banner_link')); ?>" value="<?php echo esc_url( $instance['ads_banner_link'] ); ?>">
		</p>

		<!-- image url path -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ads_banner_img' )); ?>"><?php _e( 'Insert Banner Image URL (image path)', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'ads_banner_img' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ads_banner_img' )); ?>" value="<?php echo esc_url( $instance['ads_banner_img'] ); ?>" style="width:96%;" /><br />
			<small><?php _e( 'Insert Image URL from Media Manager', 'themewing' ); ?></small>
		</p>

		<?php
	}
}