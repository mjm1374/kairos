<?php
if ( ! function_exists( 'themewing_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function themewing_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'bizspeak' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'bizspeak' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<div class="pull-left author-comment">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>

			<div class="media-body">
				<div class="media-body-wrap">

					<div class="comment-area">
						<h5 class="media-heading"><?php printf( __( '%s <span class="says">says:</span>', 'bizspeak' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
						<div class="comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'bizspeak' ), esc_attr( get_comment_date() ), esc_attr( get_comment_time() ) ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'bizspeak' ), '<span class="edit-link">', '</span>' ); ?>
						</div>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bizspeak' ); ?></p>
					<?php endif; ?>

					<div class="comment-content">
						<?php esc_attr( comment_text() ); ?>
					</div><!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth' 	=> $depth,
								'max_depth' => $args['max_depth'],
								'before' 	=> '<footer class="reply comment-reply">',
								'after' 	=> '</footer><!-- .reply -->'
							)
						)
					); ?>

				</div>
			</div><!-- .media-body -->

		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for themewing_comment()