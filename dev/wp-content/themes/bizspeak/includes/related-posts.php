<?php 

$orig_post = $post;
global $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 4, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
		<div class="post-related">
			<div class="related-title themewing-title">
				<h2><?php _e('Related Post', 'bizspeak'); ?></h2>
			</div>

			<div class="row">
			<?php while( $my_query->have_posts() ) {
				$my_query->the_post();?>
					<div class="item-related col-sm-3">
						
						<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('x-small-size'); ?></a>
						<?php endif; ?>
						
						<h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
						<time class="entry-date" datetime="<?php esc_attr(the_time( 'c' )); ?>"><?php the_time('j M,  Y'); ?></time>
					</div>
			<?php } ?>
			</div>
		</div>
	<?php }
}
$post = $orig_post;
wp_reset_query();

?>