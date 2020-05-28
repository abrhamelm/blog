<?php
/**
 * Comments
 */
if ( post_password_required() || ( defined('FW') && gillion_option( 'page_comments', false ) == false ) ) { return; }
?>

<div class="sh-comments">
	<?php if ( have_comments() ) : ?>

		<h3 class="sh-comments-position" id="comments"></h3>
		<div class="sh-blog-fancy-title-container">
			<h2 class="post-single-title">
				<?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'gillion' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			</h2>
		</div>

		<ol class="sh-comment-list">
			<?php

			function gillion_light_comment($comment, $args, $depth) {
				$GLOBALS['comment'] = $comment;
				extract($args, EXTR_SKIP);

				if ( 'div' == $args['style'] ) {
					$tag = 'div';
					$add_below = 'comment';
				} else {
					$tag = 'li';
					$add_below = 'div-comment';
				}
			?>
				<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?>>
				<h6 class="sh-comment-position" id="comment-<?php comment_ID() ?>"></h6>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
					<div class="comment-column-left">
						<div class="comment-thumb"><?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
					</div>
					<div class="comment-column-right">

						<?php printf( '<span class="sh-comment-author">%s</span>', get_comment_author_link() ); ?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'gillion' ); ?></em>
						<?php endif; ?>

						<div class="sh-comment-content">
							<?php comment_text(); ?>
						</div>

						<div class="reply post-meta">
							<span class="sh-comment-date">
								<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
									<?php
										echo human_time_diff( strtotime( $comment->comment_date_gmt ), current_time('timestamp') ) . ' '.esc_html__( 'ago', 'gillion' );
									?>
								</a>
							</span>

							<i class="icon icon-action-redo sh-reply-link"></i>
							<span class="sh-reply-edit">
								<?php edit_comment_link( esc_html__( 'Edit', 'gillion' ), '  ', '' ); ?>
							</span>

							<?php if( comments_open() ) : ?>
								<i class="icon icon-note sh-reply-link sh-comment-date-reply"></i>
								<span class="sh-reply-link-button">
									<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
								</span>
							<?php endif; ?>
						</div>

					</div>
				</div>

			<?php }
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 70,
					'max_depth' => '5',
					'callback' => 'gillion_light_comment',

				) );
			?>
		</ol><!-- .comment-list -->


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="comment-navigation grey-light"><?php paginate_comments_links(); ?></div>
		<?php endif; // check for comment navigation ?>

	<?php endif; ?>


	<div class="sh-comment-form">
		<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="sh-comments-disabled"><?php esc_html_e( 'Comments are closed.', 'gillion' ); ?></p>
		<?php endif; ?>

		<?php comment_form(array(
			'label_submit' => esc_html__( 'Send a comment', 'gillion' ),
			'comment_notes_after' => '',
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="sh-comment-form-column"><label>' . esc_html__( 'Name ', 'gillion' ) . ' <span>*</span></label>
					<p class="comment-form-author">
						<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required />
					</p></div>',

				'email' =>
					'<div class="sh-comment-form-column"><label>' . esc_html__( 'Email ', 'gillion' ) . ' <span>*</span></label>
					<p class="comment-form-email">
						<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" required />
					</p></div>',

				'url' =>
					'<div class="sh-comment-form-column"><label>' . esc_html__( 'Website ', 'gillion' ) . ' <span>*</span></label>
					<p class="comment-form-url">
						<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
					</p></div>'
				)
			),
			'comment_field' =>  '<label>' . esc_html__( 'Your comment ', 'gillion' ) . ' <span>*</span></label>
			<p class="comment-form-comment">
				<textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
			</p>',
			'submit_field' => '<div class="sh-comments-required-notice">' . esc_html__( 'Required fields are marked', 'gillion' ) . ' <span>*</span></div><p class="form-submit">%1$s %2$s</p>',
		)); ?>
	</div>
</div>
