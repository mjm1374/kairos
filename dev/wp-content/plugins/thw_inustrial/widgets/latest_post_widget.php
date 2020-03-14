<?php
/**
 * Plugin Name: Latest Posts Widget
 */

add_action( 'widgets_init', 'themewing_latest_news_load_widget' );

function themewing_latest_news_load_widget() {
	register_widget( 'bizspeak_latest_news_widget' );
}

class bizspeak_latest_news_widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'bizspeak_latest_news_widget', 'description' => __('A widget that display latest posts from all categories', 'bizspeak_latest_news_widget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bizspeak_latest_news_widget' );
		parent::__construct( 'bizspeak_latest_news_widget', __('Themewing Latest Posts', 'bizspeak_latest_news_widget'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings.
		$title 			= apply_filters('widget_title', $instance['title'] );
		$categories 	= $instance['categories'];
		$post_count 	= $instance['post_count'];


		$query = array(
			'posts_per_page' => $post_count,
			'order' => 'DESC',
			'nopaging' => 0,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'cat' => $categories
			);

		$args = new WP_Query($query);
		if ($args->have_posts()) :

			echo $before_widget;

		if ( $title )
			echo $before_title . esc_html($title) . $after_title;
		?>
		<div class="latest-post-wrap">
			<?php  while ($args->have_posts()) : $args->the_post(); ?>
				<div class="latest-post">
					<p class="post-meta">
						<i class="fa fa-calendar"></i>
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" > <?php echo esc_html( get_the_date('l, M d, Y') ); ?></time>
					</p>
					<h4 class="latest-post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a></h4>
					<div class="clearfix"></div>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	<?php endif; ?>

	<?php

	echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] 			= strip_tags( $new_instance['title'] );
	$instance['categories'] 	= $new_instance['categories'];
	$instance['post_count'] 	= strip_tags( $new_instance['post_count'] );

	return $instance;
}


function form( $instance ) {

	$defaults = array(
		'title' => __('Blog Posts', 'themewing'),
		'post_count' => 4,
		'categories' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'themewing'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		<!-- Post Category -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php _e('Filter by Categories', 'themewing'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Count of Latest Posts -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>"><?php _e('Count of Latest Post', 'themewing'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_count' )); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" size="3" />
		</p>


		<?php
	}
}

?>