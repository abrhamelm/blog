<?php
/**
 * Post format - Standard
 */

if( !isset($style) ) :
	$style = gillion_post_option( get_queried_object_id(), 'page-blog-style' );
endif;
$author = gillion_post_option( get_the_ID(), 'post-quote-author' );
$quote_text = gillion_post_option( get_the_ID(), 'post-quote' );
if( $quote_text ) :
	$quote = $quote_text;
else :
	$quote = strip_tags( get_the_content() );
endif;

/* Layout for masonry style */
if( $style == 'masonry' || $style == 'masonry blog-style-masonry-card' || $style == 'grid' || $style == 'grid-simple' ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">

			<div class="post-quote-link">
				<div class="sh-ratio">
					<div class="sh-ratio-container<?php echo ( $style == 'grid' ) ? ' sh-ratio-container-130' : ''; ?>">
						<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'large' ) ); ?>); ">

							<div class="post-quote-link-content">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
									<h2>" <?php echo esc_attr( $quote ); ?> "</h2>
								</a>
								<?php if( $author ) : ?>
									<p>- <?php echo esc_attr( $author ); ?></p>
								<?php endif; ?>
							</div>
							<div class="post-quote-link-meta">
								<div class="row">
									<div class="col-md-9">
										<div class="post-meta">
											<?php gillion_post_meta( 5 ); ?>
										</div>
									</div>
									<div class="col-md-3 text-right post-quote-link-icon">
										<i class="ti-quote-left"></i>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<?php echo gillion_post_review( get_the_ID() ); ?>
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

						<?php echo gillion_post_review( get_the_ID() ); ?>
						<div class="post-cover-container">
							<a href="#post-media<?php the_ID(); ?>" data-rel="lightcase-post" class="post-button post-button-disabled">
								<div class="post-button-icon"><i class="ti-quote-right"></i></div>
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
	/* Layout for minimalistic style */
	elseif( $style == 'left' || $style == 'left-mini' || $style == 'left-right' || $style == 'left-right blog-style-left-right-large' || $style == 'left-right blog-style-left-right-small' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<div class="post-container">
			<div class="row">
				<div class="col-md-12">

					<div class="post-quote-link">
						<div class="sh-ratio">
							<div class="sh-ratio-container">
								<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>); ">

									<div class="post-quote-link-content">
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
											<h2>" <?php echo esc_attr( $quote ); ?> "</h2>
										</a>
										<?php if( $author ) : ?>
											<p>- <?php echo esc_attr( $author ); ?></p>
										<?php endif; ?>
									</div>
									<div class="post-quote-link-meta">
										<div class="post-meta">
											<?php gillion_post_meta( 0, 1, 0, 0 ); ?>
										</div>
									</div>

								</div>
							</div>
						</div>

						<?php echo gillion_post_review( get_the_ID() ); ?>
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

			<div class="post-quote-link">
				<div class="sh-ratio">
					<div class="sh-ratio-container">
						<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>); ">

							<div class="post-quote-link-content">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
									<h2>" <?php echo gillion_post_option( get_the_ID(), 'post-quote' ); ?> "</h2>
								</a>
								<p>- <?php echo gillion_post_option( get_the_ID(), 'post-quote-author' ); ?></p>
							</div>
							<div class="post-quote-link-meta">
								<div class="row">
									<div class="col-md-6">
										<div class="post-meta">
											<?php gillion_post_meta( 5 ); ?>
										</div>
									</div>
									<div class="col-md-6 text-right post-quote-link-icon">
										<i class="ti-quote-left"></i>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<?php echo gillion_post_review( get_the_ID() ); ?>
			</div>

			<?php gillion_post_share(); ?>

		</div>
	</article>

<?php
	/* Layout for single post style */
	else :

?>

	<div class="post-quote-link">
		<div class="sh-ratio">
			<div class="sh-ratio-container">
				<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>); ">

					<div class="post-quote-link-content">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
							<h2>" <?php echo esc_attr( $quote ); ?> "</h2>
						</a>
						<?php if( $author ) : ?>
							<p>- <?php echo esc_attr( $author ); ?></p>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>

		<?php echo gillion_post_review( get_the_ID() ); ?>
	</div>

<?php endif; ?>
