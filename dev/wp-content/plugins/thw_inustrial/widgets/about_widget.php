<?php
/**
 * Plugin Name: About Me Widget
 */

add_action( 'widgets_init', 'themewing_about_load_widget' );

function themewing_about_load_widget() {
	register_widget( 'bizspeak_about_widget' );
}

class bizspeak_about_widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'bizspeak_about_widget', 'description' => __('A widget that displays an About widget', 'bizspeak_about_widget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bizspeak_about_widget' );
		parent::__construct( 'bizspeak_about_widget', __('Themewing About Me', 'bizspeak_about_widget'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title 				= apply_filters('widget_title', $instance['title'] );
		$image 				= $instance['image'];
		$description 		= $instance['description'];
		$about_link 		= $instance['about_link'];
		$about_link_btn 	= $instance['about_link_btn'];
		$facebook_url 		= $instance['facebook_url'];
		$twitter_url 		= $instance['twitter_url'];
		$gplus_url 			= $instance['gplus_url'];
		$linkedin_url 		= $instance['linkedin_url'];
		$pinterest_url 		= $instance['pinterest_url'];
		$instagram_url 		= $instance['instagram_url'];
		$delicious_url 		= $instance['delicious_url'];
		$tumblr_url 		= $instance['tumblr_url'];
		$stumbleupon_url 	= $instance['stumbleupon_url'];
		$dribble_url 		= $instance['dribble_url'];

		echo $before_widget;

		if ( $title )
			echo $before_title . esc_attr($title) . $after_title;

		?>

			<div class="bizspeak-about-widget">

				<?php if($image) { ?>
				<div class="bizspeak-about-img">
					<img class="img-responsive" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr ($title); ?>" />
				</div>
				<?php } ?>

				<?php if($description) { ?>
				<div class="bizspeak-about-intro"><?php echo esc_textarea($description); ?></div>
				<?php } ?>

				<?php if($about_link_btn) {
					echo '<a class="about-widget-btn" href="'.esc_url($about_link).'" target="_blank">'.esc_attr( $about_link_btn ).'</a>';
				} ?>
				<?php if( $instagram_url || $dribble_url || $stumbleupon_url || $facebook_url || $twitter_url || $gplus_url || $linkedin_url || $pinterest_url || $delicious_url || $tumblr_url) { ?>
					<ul class="bizspeak-about-social">
						<?php if( $facebook_url ) { ?>
							<li><a class="facebook" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<?php } ?>
						<?php if( $twitter_url ) { ?>
							<li><a class="twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
						<?php } ?>
						<?php if( $gplus_url ) { ?>
							<li><a class="g-plus" href="<?php echo esc_url( $gplus_url ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php } ?>
						<?php if( $linkedin_url ) { ?>
							<li><a class="linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<?php } ?>
						<?php if( $pinterest_url ) { ?>
							<li><a class="pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<?php } ?>
						<?php if( $instagram_url ) { ?>
							<li><a class="instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<?php } ?>
						<?php if( $delicious_url ) { ?>
							<li><a class="delicious" href="<?php echo esc_url( $delicious_url ); ?>" target="_blank"><i class="fa fa-delicious"></i></a></li>
						<?php } ?>
						<?php if( $tumblr_url ) { ?>
							<li><a class="tumblr" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
						<?php } ?>
						<?php if( $stumbleupon_url ) { ?>
							<li><a class="stumbleupon" href="<?php echo esc_url( $stumbleupon_url ); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>
						<?php } ?>
						<?php if( $dribble_url ) { ?>
							<li><a class="dribble" href="<?php echo esc_url( $dribble_url ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>

		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['image'] 				= strip_tags( $new_instance['image'] );
		$instance['description'] 		= $new_instance['description'];
		$instance['about_link'] 		= strip_tags ( $new_instance['about_link'] );
		$instance['about_link_btn'] 	= strip_tags ( $new_instance['about_link_btn'] );
		$instance['facebook_url'] 		= strip_tags( $new_instance['facebook_url'] );
		$instance['twitter_url'] 		= strip_tags( $new_instance['twitter_url'] );
		$instance['gplus_url'] 			= strip_tags( $new_instance['gplus_url'] );
		$instance['linkedin_url'] 		= strip_tags( $new_instance['linkedin_url'] );
		$instance['pinterest_url'] 		= strip_tags( $new_instance['pinterest_url'] );
		$instance['instagram_url'] 		= strip_tags( $new_instance['instagram_url'] );
		$instance['delicious_url'] 		= strip_tags( $new_instance['delicious_url'] );
		$instance['tumblr_url'] 		= strip_tags( $new_instance['tumblr_url'] );
		$instance['stumbleupon_url'] 	= strip_tags( $new_instance['stumbleupon_url'] );
		$instance['dribble_url'] 		= strip_tags( $new_instance['dribble_url'] );


		return $instance;
	}


	function form( $instance ) {

		$defaults = array(
			'title' 			=> '',
			'image' 			=> '',
			'description' 		=> '',
			'about_link' 		=> '',
			'about_link_btn' 	=> '',
			'facebook_url' 		=> '',
			'twitter_url' 		=> '',
			'gplus_url' 		=> '',
			'linkedin_url' 		=> '',
			'pinterest_url' 	=> '',
			'instagram_url' 	=> '',
			'delicious_url' 	=> '',
			'tumblr_url' 		=> '',
			'stumbleupon_url' 	=> '',
			'dribble_url' 		=> ''
			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:96%;" />
		</p>

		<!-- image url -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php _e( 'Insert Image URL', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" value="<?php echo esc_url( $instance['image'] ); ?>" style="width:96%;" /><br />
			<small><?php _e( 'Insert Image URL from Media Manager', 'themewing' ); ?></small>
		</p>

		<!-- About description -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php _e( 'Description', 'themewing' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" style="width:95%;" rows="6"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>

		<!-- About Button Name -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'about_link_btn' )); ?>"><?php _e( 'Button Name', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'about_link_btn' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'about_link_btn' )); ?>" value="<?php echo esc_attr( $instance['about_link_btn'] ); ?>" style="width:96%;" />
		</p>

		<!-- About Button URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'about_link' )); ?>"><?php _e( 'Button URL', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'about_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'about_link' )); ?>" value="<?php echo esc_url( $instance['about_link'] ); ?>" style="width:96%;" />
		</p>

		<!-- Widget Facebook URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>"><?php _e( 'Facebook URL', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_url' )); ?>" value="<?php echo esc_url( $instance['facebook_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Twitter URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>"><?php _e( 'Twitter URL', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_url' )); ?>" value="<?php echo esc_url( $instance['twitter_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Google Plus URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'gplus_url' )); ?>"><?php _e('Google Plus URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'gplus_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gplus_url' )); ?>" value="<?php echo esc_url( $instance['gplus_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Linkedin URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>"><?php _e('Linkedin URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin_url' )); ?>" value="<?php echo esc_url( $instance['linkedin_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Pinterest URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest_url' )); ?>"><?php _e('Pinterest URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'pinterest_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_url' )); ?>" value="<?php echo esc_url( $instance['pinterest_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Instagram URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram_url' )); ?>"><?php _e('Instagram URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'instagram_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram_url' )); ?>" value="<?php echo esc_url( $instance['instagram_url'] ); ?>" style="width:95%;" />
		</p>


		<!-- Widget Delicious URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'delicious_url' )); ?>"><?php _e('Delicious URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'delicious_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'delicious_url' )); ?>" value="<?php echo esc_url( $instance['delicious_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Tumblr URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tumblr_url' )); ?>"><?php _e('Tumblr URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'tumblr_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr_url' )); ?>" value="<?php echo esc_url( $instance['tumblr_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Stumbleupon URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'stumbleupon_url' )); ?>"><?php _e('Stumbleupon URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'stumbleupon_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'stumbleupon_url' )); ?>" value="<?php echo esc_url( $instance['stumbleupon_url'] ); ?>" style="width:95%;" />
		</p>

		<!-- Widget Dribble URL -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'dribble_url' )); ?>"><?php _e('Dribble URL: ', 'themewing'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dribble_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribble_url' )); ?>" value="<?php echo esc_url( $instance['dribble_url'] ); ?>" style="width:95%;" />
		</p>

	<?php
	}
}

?>