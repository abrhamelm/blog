<?php
/**
 * Post format - Standard
 */

if( !isset($style) ) :
	$style = gillion_post_option( get_queried_object_id(), 'page-blog-style' );
endif;

/* Layout for masonry style */
if( $style == 'masonry' || $style == 'masonry blog-style-masonry-card' || $style == 'grid' || $style == 'grid-simple' ) :
	$meta = ( $style == 'grid-simple' ) ? '7' : '';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">

			<?php
			$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
			if( gillion_option( 'global_categories_position', 'title' ) == 'image' ) : ?>

				<div class="post-thumbnail">
					<?php if( $style == 'grid' || $style == 'grid-simple' ) : ?>
						<div class="sh-ratio">
							<div class="sh-ratio-container">
								<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>);"></div>
							</div>
						</div>
					<?php else : ?>
						<?php echo the_post_thumbnail( 'large' ); ?>
					<?php endif; ?>

					<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
					<?php echo gillion_post_review( get_the_ID() ); ?>
					<?php echo gillion_post_categories_position( 'image' ); ?>
				</div>

			<?php elseif( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
				<div class="post-gallery">
					<div class="post-gallery-pagination sh-heading-font">1/<?php echo count( $gallery ); ?></div>
					<div class="post-gallery-list">
						<?php
							if( is_array($gallery) && count($gallery) > 0 ) : $i= 0;
								foreach( $gallery as $image ) : $i++; ?>

									<div class="post-gallery-item">
										<div class="sh-ratio">
											<div class="sh-ratio-container">
												<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, 'gillion-landscape-small' ); ?>);">
													<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ), 1, 1, 1 ); ?>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach;
							endif;
						?>
					</div>
					<?php echo gillion_post_review( get_the_ID() ); ?>
					<?php echo gillion_post_categories_position( 'image' ); ?>
				</div>
			<?php endif; ?>

			<div class="post-content-container">
				<?php echo gillion_post_categories_position(); ?>

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<?php echo ( $style != 'grid-simple' ) ? '<h2>' : '<h4>'; ?>
						<?php gillion_sticky_post(); ?>
						<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
					<?php echo ( $style != 'grid-simple' ) ? '</h2>' : '</h4>'; ?>
				</a>

				<?php gillion_post_meta_excerpt( $meta, $style ); ?>
			</div>

		</div>
	</article>



<?php
	/* Layout for card style */
	elseif( $style == 'card' ) :
?>


	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>  style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-landscape-large' ) ); ?>);">
		<div class="post-container">

			<div class="post-content-container">
				<?php gillion_post_categories(); ?>

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2>
						<?php gillion_sticky_post(); ?>
						<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
					</h2>
				</a>

				<?php gillion_post_meta_excerpt(); ?>
			</div>

		</div>
	</article>


<?php
	/* Layout for cover style */
	elseif( $style == 'cover-small' || $style == 'cover-large' ) :
		$meta = ( $style == 'cover-small' ) ? '6' : '8';
		$thumb = ( $style == 'cover-small' ) ? 'gillion-portrait' : 'large';
		$thumb = ( isset( $custom_thumb ) && $custom_thumb ) ? $custom_thumb : $thumb;
		$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
?>

	<article id="post-<?php echo esc_attr( $style ); ?>-<?php the_ID(); ?>" <?php post_class('post-item post-style-cover'); ?>>
		<div class="post-container">
			<div class="sh-ratio">
				<div class="sh-ratio-container">
					<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( $thumb ) ); ?>);">



						<div class="post-gallery">
							<div class="post-gallery-list post-gallery-list-background">
								<?php
									if( is_array($gallery) && count($gallery) > 0 ) : $i= 0;
										foreach( $gallery as $image ) : $i++; ?>

											<div class="post-gallery-item">
												<div class="sh-ratio">
													<div class="sh-ratio-container">
														<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, $thumb); ?>);">
															<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ), 1, 1, 1 ); ?>
														</div>
													</div>
												</div>
											</div>

										<?php endforeach;
									endif;
								?>
							</div>
						</div>




						<?php echo gillion_post_review( get_the_ID() ); ?>
						<?php if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
							<div class="post-gallery-pagination post-gallery-pagination-inside-cover sh-heading-font">1/<?php echo count($gallery); ?></div>
						<?php endif; ?>
						<div class="post-cover-container">

							<?php if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
								<div class="post-gallery-buttons">
									<button type="button" class="slick-prev post-cover-gallery-prev"><i class="icon icon-arrow-left-circle"></i></button>
									<button type="button" class="slick-next post-cover-gallery-next"><i class="icon icon-arrow-right-circle"></i></button>
								</div>
							<?php endif; ?>

							<?php gillion_post_categories(); ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
								<h2>
									<?php gillion_sticky_post(); ?>
									<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
								</h2>
							</a>
							<div class="post-meta">
								<?php gillion_post_meta( $meta ); ?>
							</div>
						</div>
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-cover-link"></a>

					</div>
				</div>
			</div>
		</div>
	</article>

<?php
	/* Layout for left and mix style */
	elseif( $style == 'left' || $style == 'left-mini' || $style == 'left-right' || $style == 'left-right blog-style-left-right-large' || $style == 'left-right blog-style-left-right-small' ) :
		$thumb = ( $style == 'left-right blog-style-left-right-small' ) ? 'post-thumbnail' : 'gillion-square';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">
			<div class="row">
				<div class="col-md-6 col-sm-6 post-container-left">

					<?php
					$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
					if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
						<div class="post-gallery">
							<div class="post-gallery-pagination sh-heading-font">1/<?php echo count( $gallery ); ?></div>
							<div class="post-gallery-list">
								<?php
									if( is_array($gallery) && count($gallery) > 0 ) :
										foreach( $gallery as $image ) : ?>

											<div class="post-gallery-item">
												<div class="sh-ratio">
													<div class="sh-ratio-container">
														<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, $thumb); ?>);">
															<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ), 1, 1, 1 ); ?>
														</div>
													</div>
												</div>
											</div>

										<?php endforeach;
									endif;
								?>
							</div>
							<?php echo gillion_post_review( get_the_ID() ); ?>
						</div>
					<?php endif; ?>

				</div>
				<div class="col-md-6 col-sm-6 post-container-right">

					<div class="post-content-container">
						<?php gillion_post_categories(); ?>

						<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
							<h2>
								<?php gillion_sticky_post(); ?>
								<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
							</h2>
						</a>

						<?php gillion_post_meta_excerpt(); ?>
					</div>

				</div>
			</div>
		</div>
	</article>


	<?php
		/* Layout for left and mix style */
		elseif( $style == 'left-small' ) :
	?>

		<article id="post-<?php echo esc_attr( $style ); ?>-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
			<div class="post-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>);">
				<?php
				$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
				if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
					<div class="post-gallery">
						<div class="post-gallery-pagination sh-heading-font">1/<?php echo count( $gallery ); ?></div>
						<div class="post-gallery-list">
							<?php
								if( is_array($gallery) && count($gallery) > 0 ) :
									foreach( $gallery as $image ) : ?>

										<div class="post-gallery-item">
											<div class="sh-ratio">
												<div class="sh-ratio-container">
													<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, 'gillion-square'); ?>);">
														<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ), 1, 1, 1 ); ?>
													</div>
												</div>
											</div>
										</div>

									<?php endforeach;
								endif;
							?>
						</div>
						<?php echo gillion_post_review( get_the_ID() ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="post-container">
				<div class="post-container-content">

					<?php gillion_post_categories(); ?>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
						<h2>
							<?php gillion_sticky_post(); ?>
							<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
						</h2>
					</a>
					<div class="post-meta">
						<?php gillion_post_meta(); ?>
					</div>

				</div>
			</div>
		</article>

<?php
	/* Layout for large style */
	elseif( $style == 'large' || $style == 'large large-title-bellow' || $style == 'large large-centered' ) :
		if( !isset( $featured ) ) {
			$featured = 0;
		}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">

			<?php if( $style != 'large large-title-bellow') : ?>
				<?php gillion_post_categories(); ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2>
						<?php gillion_sticky_post(); ?>
						<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
					</h2>
				</a>
				<div class="post-meta">
					<?php gillion_post_meta(); ?>
				</div>
			<?php endif; ?>

			<?php
			$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
			if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
				<div class="post-gallery">
					<div class="post-gallery-pagination sh-heading-font">1/<?php echo count( $gallery ); ?></div>
					<div class="post-gallery-list">
						<?php
							if( is_array($gallery) && count($gallery) > 0 ) : $i= 0;
								foreach( $gallery as $image ) : $i++; ?>

									<div class="post-gallery-item">
										<div class="sh-ratio">
											<div class="sh-ratio-container" style="padding-bottom: 56%;">
												<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, 'gillion-landscape-large'); ?>);">
													<?php echo gillion_ligtbox( gillion_get_image_size($image, 'full'), get_the_ID() ); ?>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach;
							endif;
						?>
					</div>
					<?php echo gillion_post_review( get_the_ID() ); ?>
				</div>
			<?php endif; ?>

			<?php if( $style == 'large large-title-bellow') : ?>
				<?php gillion_post_categories(); ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2>
						<?php gillion_sticky_post(); ?>
						<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
					</h2>
				</a>
				<div class="post-meta">
					<?php gillion_post_meta(); ?>
				</div>
			<?php endif; ?>

			<div class="post-content-container">
				<div class="post-content">
					<?php the_excerpt(); ?>
				</div>
			</div>

			<?php gillion_post_share(); ?>

		</div>
	</article>

<?php
	/* Layout for single post style */
	else :

?>

	<?php
	$gallery = gillion_post_option( get_the_ID(), 'post-gallery' );
	if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
		<div class="post-gallery">
			<div class="post-gallery-pagination sh-heading-font">1/<?php echo count( $gallery ); ?></div>
			<div class="post-gallery-list">
				<?php
					if( is_array($gallery) && count($gallery) > 0 ) : $i= 0;
						foreach( $gallery as $image ) : $i++; ?>

							<div class="post-gallery-item">
								<div class="sh-ratio">
									<div class="sh-ratio-container" style="padding-bottom: 56%;">
										<div class="sh-ratio-content" style="background-image: url( <?php echo gillion_get_image_size($image, 'gillion-landscape-large'); ?>);">
											<?php echo gillion_ligtbox( gillion_get_image_size($image, 'full'), get_the_ID() ); ?>
										</div>
									</div>
								</div>
							</div>

						<?php endforeach;
					endif;
				?>
			</div>
			<?php echo gillion_post_review( get_the_ID() ); ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
