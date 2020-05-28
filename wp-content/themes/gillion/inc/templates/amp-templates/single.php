<?php
$this->load_parts( [ 'html-start' ] );

$score = gillion_post_review_score( get_the_ID() );
$review_layout = gillion_post_option( get_the_ID(), 'review_layout' );
$post_format = get_post_format();
?>

<?php $this->load_parts( [ 'header' ] ); ?>

<article class="amp-wp-article">
	<div class="amp-wp-article-categories">
		<?php gillion_post_categories(); ?>
	</div>

	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title"><?php echo esc_html( $this->get( 'post_title' ) ); ?></h1>
		<div class="">
			<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', [ 'meta-author', 'meta-time' ] ) ); ?>
		</div>
	</header>




	<?php if( $post_format == 'audio' ) :
	$audio_url  = gillion_post_option( get_the_ID(), 'post-audio' );
	$audio_content = wp_oembed_get( $audio_url, [ 'width' => 900, 'height' => 450 ] ); ?>
		<?php if( $audio_url && $audio_content ) :
			$ampEmbedder = new \AMP_Content(
		        $audio_content,
		        apply_filters(
		            'amp_content_embed_handlers',
		            array(
		                'AMP_Twitter_Embed_Handler' => array(),
		                'AMP_YouTube_Embed_Handler' => array(),
		                'AMP_Instagram_Embed_Handler' => array(),
		                'AMP_Vine_Embed_Handler' => array(),
		                'AMP_Facebook_Embed_Handler' => array(),
		                'AMP_Gallery_Embed_Handler' => array(),
		            )
		        ),
				apply_filters(
		            'amp_content_sanitizers',
		            array(
		                'AMP_Style_Sanitizer' => array(),
		                'AMP_Img_Sanitizer' => array(),
		                'AMP_Video_Sanitizer' => array(),
		                'AMP_Audio_Sanitizer' => array(),
		                'AMP_Iframe_Sanitizer' => array(
		                    'add_placeholder' => true,
		                ),
		            )
		        ),
		        array(
		            'content_max_width' => $this->get('content_max_width'),
		        )
		    );
		?>

			<div class="amp-wp-article-media">
				<?php echo ( $ampEmbedder->get_amp_content() ); ?>
			</div>

		<?php endif; ?>
	<?php elseif( $post_format == 'video' ) :
	$video_url  = gillion_post_option( get_the_ID(), 'post-video' );
	$video_content = wp_oembed_get( $video_url, [ 'width' => 900, 'height' => 600 ] ); ?>
		<?php if( $video_url && $video_content ) :
			$ampEmbedder = new \AMP_Content(
				$video_content,
				apply_filters(
					'amp_content_embed_handlers',
					array(
						'AMP_Twitter_Embed_Handler' => array(),
						'AMP_YouTube_Embed_Handler' => array(),
						'AMP_Instagram_Embed_Handler' => array(),
						'AMP_Vine_Embed_Handler' => array(),
						'AMP_Facebook_Embed_Handler' => array(),
						'AMP_Gallery_Embed_Handler' => array(),
					)
				),
				apply_filters(
					'amp_content_sanitizers',
					array(
						'AMP_Style_Sanitizer' => array(),
						'AMP_Img_Sanitizer' => array(),
						'AMP_Video_Sanitizer' => array(),
						'AMP_Audio_Sanitizer' => array(),
						'AMP_Iframe_Sanitizer' => array(
							'add_placeholder' => true,
						),
					)
				),
				array(
					'content_max_width' => $this->get('content_max_width'),
				)
			);
		?>

			<div class="amp-wp-article-media">
				<?php echo ( $ampEmbedder->get_amp_content() ); ?>
			</div>

		<?php endif; ?>
	<?php else : ?>
		<?php $this->load_parts( [ 'featured-image' ] ); ?>
	<?php endif; ?>




	<div class="amp-wp-article-content">
		<?php /* Review */
		if( $score && $review_layout != 'hidden' && $review_layout != 'full bottom' ) :
			gillion_post_single_review( get_the_ID(), $score, $review_layout );
		endif;
		?>

			<?php echo $this->get( 'post_amp_content' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php if( $score && $review_layout == 'full bottom' ) :
			gillion_post_single_review( get_the_ID(), $score, $review_layout );
		endif; ?>
	</div>

	<footer class="amp-wp-article-footer">
		<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', [ 'meta-taxonomy' ] ) ); ?>
	</footer>


	<?php if( gillion_option( 'single_related_posts', 'on' ) == 'on' ) : ?>
		<div class="amp-wp-article-related-posts">
			<h2>
				<?php esc_attr_e( 'Related posts', 'gillion' ); ?>
			</h2>
			<div class="amp-wp-article-related-posts-list">
				<?php
				$categories = array();
				foreach( get_the_category( get_the_ID() ) as $category ) :
					$categories[] = $category->term_id;
				endforeach;

				$args = array(
					'post__not_in' => array( get_the_ID() ),
					'posts_per_page' => 3,
					'ignore_sticky_posts' => 1,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $categories,
							'operator' => 'IN',
						),
						array(
	                         'taxonomy' => 'post_format',
	                         'field' => 'slug',
	                         'terms' => array( 'post-format-quote', 'post-format-link' ),
	                         'operator' => 'NOT IN'
	                     )
					),
					'orderby' => 'rand'
				);
				$query = new WP_Query( $args );

				if( $query->post_count < 3 ) :
					$args = array(
						'post__not_in' => array( get_the_ID() ),
						'posts_per_page' => 3,
						'ignore_sticky_posts' => 1,
						'orderby' => 'rand'
					);
					$query = new WP_Query( $args );
				endif;

				if( $query->have_posts() ) :
					set_query_var( 'style', 'grid-simple' );
					while( $query->have_posts() ) : $query->the_post();
						$permalink = ( function_exists( 'amp_get_permalink' ) ) ? amp_get_permalink( get_the_ID() ) : get_permalink();
					?>

						<div class="amp-wp-article-related-posts-item">
							<a href="<?php echo esc_url( $permalink ); ?>">
								<div class="sh-ratio">
									<div class="sh-ratio-container">
										<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-landscape-small' ) ); ?>);"></div>
									</div>
								</div>

								<h3>
									<?php the_title(); ?>
								</h3>

								<div class="amp-wp-article-related-posts-meta">
									<div class="amp-wp-meta">
										<?php echo get_the_author(); ?>
									</div>
									<div class="amp-wp-meta">
										<?php if( gillion_option( 'post_date_format', 'friendly' ) == 'friendly' ) : ?>
				                            <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', 'gillion' ); ?>
				                        <?php else : ?>
				                            <?php echo get_the_date(); ?>
				                        <?php endif; ?>
									</div>
								</div>
							</a>
						</div>

					<?php endwhile; ?>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<footer class="amp-wp-article-footer">
			<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', [ 'meta-comments-link' ] ) ); ?>
		</footer>



	</div>
</article>

<?php $this->load_parts( [ 'footer' ] ); ?>

<?php
$this->load_parts( [ 'html-end' ] );
