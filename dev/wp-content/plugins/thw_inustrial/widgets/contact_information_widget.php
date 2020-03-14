<?php
/**
 * Plugin Name: COntact Information
 */

add_action( 'widgets_init', 'themewing_contact_information_load_widget' );

function themewing_contact_information_load_widget() {
	register_widget( 'bizspeak_contact_information_widget' );
}


class bizspeak_contact_information_widget extends WP_Widget{

	function __construct() {
		$widget_ops = array( 'classname' => 'bizspeak_contact_information_widget', 'description' => __('A widget that displays Contact Information widget', 'bizspeak_contact_information_widget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bizspeak_contact_information_widget' );
		parent::__construct( 'bizspeak_contact_information_widget', __('Themewing Contact Information', 'bizspeak_contact_information_widget'), $widget_ops, $control_ops );
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

 function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$address 			= $instance['address'];
		$email_id 			= $instance['email_id'];
		$mobile_numner 		= $instance['mobile_numner'];
		$contactinfo 		= $instance['contactinfo'];

		echo $before_widget;

		if ( $title ) {
			echo $before_title . esc_attr($title) . $after_title;
		}
		?>

		<div class="footer-about-us">
			<?php if( $contactinfo ) { ?>
				<div class="about-intro"><?php echo esc_textarea($contactinfo);?></div>
			<?php } ?>
			<?php if( $address ) { ?>
				<h4><i class="fa fa-map-marker">&nbsp;</i><?php _e('Head Office','themewing');?></h4>
				<p><?php echo esc_textarea($address);?></p>
			<?php } ?>

			<?php if( isset($mobile_numner) || isset($email_id) ) { ?>
				<div class="row">
					<?php if( $email_id ) { ?>
					<div class="col-md-6">
						<h4><i class="fa fa-envelope-o">&nbsp;</i> <?php _e('Email','themewing');?></h4>
						<p><?php echo sanitize_email($email_id);?></p>
					</div>
					<?php } ?>
					<?php if( $mobile_numner ) { ?>
					<div class="col-md-6">
						<h4><i class="fa fa-phone">&nbsp;</i> <?php _e('Phone No','themewing');?></h4>
						<p><?php echo esc_attr($mobile_numner);?></p>
					</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>

		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['address'] 			= strip_tags( $new_instance['address'] );
		$instance['email_id'] 			= strip_tags( $new_instance['email_id'] );
		$instance['mobile_numner'] 		= strip_tags( $new_instance['mobile_numner'] );
		$instance['contactinfo'] 		= strip_tags( $new_instance['contactinfo'] );

		return $instance;
	}


	function form( $instance )
	{

		$defaults = array(
			'title' 			=> '',
			'address' 			=> '',
			'email_id' 			=> '',
			'mobile_numner' 	=> '',
			'contactinfo' 		=> '',
			);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<!-- Widget Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<!-- Contact Info -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contactinfo' )); ?>"><?php _e( 'Contact Info', 'themewing' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'contactinfo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'contactinfo' )); ?>" style="width:95%;" rows="6"><?php echo esc_textarea( $instance['contactinfo'] ); ?></textarea>
		</p>

		<!-- Contact Address -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php _e( 'Contact Address', 'themewing' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" style="width:95%;" rows="6"><?php echo esc_textarea( $instance['address'] ); ?></textarea>
		</p>

		<!-- Mobile Number -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'mobile_numner' )); ?>"><?php _e( 'Mobile Number', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'mobile_numner' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mobile_numner' )); ?>" value="<?php echo esc_attr( $instance['mobile_numner'] ); ?>" style="width:96%;" />
		</p>

		<!-- Email Id -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'email_id' )); ?>"><?php _e( 'Email ID', 'themewing' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'email_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_id' )); ?>" value="<?php echo sanitize_email($instance['email_id']); ?>" style="width:96%;" />
		</p>

	<?php
	}
}