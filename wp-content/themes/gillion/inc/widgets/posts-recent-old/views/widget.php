<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */


?>

<?php if ( ! empty( $instance ) ) : ?>
	<?php
		$elements = gillion_option( 'post_elements' );
		echo wp_kses_post( $before_widget );
	?>
	<div class="wrap-recent-posts">
		<?php echo wp_kses_post( $title ); ?>
		<div class="sh-recent-posts-widgets">
			<?php
			$limit = ( $params['items_per_page'] > 0 ) ? intval( $params['items_per_page'] ) : 3;
			$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'ignore_sticky_posts' => 1 ) );
			if( $posts->have_posts() ) :
				while ( $posts->have_posts() ) : $posts->the_post(); ?>

					<div class="sh-recent-posts-widgets-item">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="sh-recent-posts-widgets-item-thumb">
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php the_post_thumbnail( 'thumbnail' ); ?>

									<div class="sh-mini-overlay">
										<div class="sh-mini-overlay-container">
											<div class="sh-table-full">
												<div class="sh-table-cell">
													<i class="icon-link"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="sh-recent-posts-widgets-count">
										<?php echo get_comments_number( '0', '1', '%' ); ?>
									</div>
								</a>
							</div>
							<div class="sh-recent-posts-widgets-item-content">
						<?php endif; ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<h6><?php echo get_the_title(); ?></h6>
							</a>
							<div class="sh-recent-posts-widgets-item-meta">
						        <?php esc_html_e( 'By', 'gillion' ); ?>
						        <a href="<?php echo esc_url( home_url('/') ); ?>/author/<?php the_author_meta('nickname'); ?>" class="post-meta-author">
						            <?php echo get_the_author(); ?>
						        </a>
							</div>
						<?php if ( has_post_thumbnail() ) : ?>
							</div>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php echo wp_kses_post( $after_widget ); wp_reset_postdata(); ?>
<?php endif; ?>
