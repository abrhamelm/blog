<?php
/**
 * Post format - Audio
 */

if( !isset($style) ) :
	$style = gillion_post_option( get_queried_object_id(), 'page-blog-style' );
endif;
$thumbnail = gillion_thumbnail_url( get_the_ID(), 'large' );

/* Layout for masonry style */
if( $style == 'masonry' || $style == 'masonry blog-style-masonry-card' || $style == 'grid' || $style == 'grid-simple' ) :
	$meta = ( $style == 'grid-simple' ) ? '7' : '3';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">

			<?php if( gillion_post_option( get_the_ID(), 'post-audio' ) && gillion_option( 'global_categories_position', 'title' ) != 'image'  ) : ?>
				<div class="post-media-play">
					<div class="post-media-play-overlay" style="<?php if( $thumbnail ) : ?>background-image: url( <?php echo esc_url($thumbnail); ?> );<?php endif; ?>">
						<div class="post-media-play-content">

							<div class="post-button">
								<div class="post-button-icon"><i class="icon icon-volume-2"></i></div>
								<div class="post-button-text"><?php esc_html_e( 'PLAY', 'gillion' ); ?></div>
							</div>

						</div>
					</div>
					<div class="post-meta-video">
						<div class="ratio-container">
							<div class="ratio-content">
								<?php echo wp_oembed_get( gillion_post_option( get_the_ID(), 'post-audio' ) ); ?>
							</div>
						</div>
					</div>
					<?php echo gillion_post_review( get_the_ID() ); ?>
				</div>
			<?php else : ?>
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
?>

	<article id="post-<?php echo esc_attr( $style ); ?>-<?php the_ID(); ?>" <?php post_class('post-item post-style-cover'); ?>>
		<div class="post-container">
			<div class="sh-ratio">
				<div class="sh-ratio-container">
					<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( $thumb ) ); ?>);">

						<div id="post-media<?php the_ID(); ?>" style="display: none;">
							<div class="post-meta-video">
								<div class="ratio-container">
									<div class="ratio-content">
										<?php echo wp_oembed_get( gillion_post_option( get_the_ID(), 'post-audio' ) ); ?>
									</div>
								</div>
							</div>
						</div>

						<?php echo gillion_post_review( get_the_ID() ); ?>
						<div class="post-cover-container">
							<a href="#post-media<?php the_ID(); ?>" data-rel="lightcase-post" class="post-button">
								<div class="post-button-icon"><i class="icon icon-volume-2"></i></div>
								<div class="post-button-text"><?php esc_html_e( 'PLAY', 'gillion' ); ?></div>
							</a>

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
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">
			<div class="row">
				<div class="col-md-6 col-sm-6 post-container-left">

					<?php if( gillion_post_option( get_the_ID(), 'post-audio' ) ) : ?>
						<div class="post-media-play">
							<div class="post-media-play-overlay" style="<?php if( $thumbnail ) : ?>background-image: url( <?php echo esc_url($thumbnail); ?> );<?php endif; ?>">
								<div class="post-media-play-content">

									<div class="post-button">
										<div class="post-button-icon"><i class="icon icon-volume-2"></i></div>
										<div class="post-button-text"><?php esc_html_e( 'PLAY', 'gillion' ); ?></div>
									</div>

								</div>
							</div>
							<div class="post-meta-video">
								<div class="ratio-container">
									<div class="ratio-content">
										<?php echo wp_oembed_get( gillion_post_option( get_the_ID(), 'post-audio' ) ); ?>
									</div>
								</div>
							</div>
							<?php echo gillion_post_review( get_the_ID() ); ?>
						</div>
					<?php else : ?>
						<div class="post-thumbnail">
							<div class="post-thumbnail-content">
								<?php echo the_post_thumbnail( 'large' ); ?>
							</div>

							<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
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

			<?php if( gillion_post_option( get_the_ID(), 'post-audio' ) ) : ?>
				<div class="post-media-play">
					<div class="post-media-play-overlay" style="<?php if( $thumbnail ) : ?>background-image: url( <?php echo esc_url($thumbnail); ?> );<?php endif; ?>">
						<div class="post-media-play-content">

							<div class="post-button">
								<div class="post-button-icon"><i class="icon icon-volume-2"></i></div>
								<div class="post-button-text"><?php esc_html_e( 'PLAY', 'gillion' ); ?></div>
							</div>

						</div>
					</div>
					<div class="post-meta-video">
						<div class="ratio-container">
							<div class="ratio-content">
								<?php echo wp_oembed_get( gillion_post_option( get_the_ID(), 'post-audio' ) ); ?>
							</div>
						</div>
					</div>
					<?php echo gillion_post_review( get_the_ID() ); ?>
				</div>
			<?php else : ?>
				<div class="post-thumbnail">
					<?php echo the_post_thumbnail( 'large' ); ?>
					<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
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

		$audio_url  = gillion_post_option( get_the_ID(), 'post-audio' );
		$audio_file = gillion_post_option( get_the_ID(), 'post-audio-file' );
		$audio_file_url = ( isset( $audio_file['url'] ) && $audio_file['url'] ) ? $audio_file['url'] : '';
		$audio_content = wp_oembed_get( $audio_url );
?>

	<?php if( $audio_url && $audio_content ) : ?>

		<div class="post-media-play">
			<div class="post-meta-video">
				<div class="ratio-container">
					<div class="ratio-content">
						<?php echo ( $audio_content ); ?>
					</div>
				</div>
			</div>
			<?php echo gillion_post_review( get_the_ID() ); ?>
		</div>

	<?php elseif( $audio_file_url ) : ?>

		<audio id="post-player">
			<source src="<?php echo ( $audio_file_url ); ?>" type="audio/mp3" />
		</audio>
		<script type="text/javascript">
			const player = new Plyr('#post-player', { 'settings': [] });
		</script>

	<?php endif; ?>

<?php endif; ?>
