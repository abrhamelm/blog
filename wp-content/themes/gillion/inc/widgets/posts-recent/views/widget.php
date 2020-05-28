<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
if( isset( $atts['posts'] ) && $atts['posts'] ) :
    $specific_posts = explode(',', $atts['posts']); $i=0;
    foreach( $specific_posts as $specific_post ) {
        $specific_posts[$i] = intval( $specific_post );
        $i++;
    }
else :
    $specific_posts = array();
endif;

$position = gillion_option( 'global_carousel_buttons_position', 'title' );
$per_slide = ( isset( $atts['per_slide'] ) && $atts['per_slide'] > 0 ) ? intval( $atts['per_slide'] ) : 3;
?>
<?php echo wp_kses_post( $before_widget ); ?>

	<?php if( $atts['title'] ) : ?>
		<div class="widget-slide-arrows-container<?php echo ( in_array( $atts['style'], array( 'style1 style4' ) ) ) ? ' not-slider' : ''; ?>">
			<?php echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>'; ?>
            <?php if( $position == 'title' ) : ?>
    			<div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
            <?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
	$limit = ( isset( $atts['limit'] ) && $atts['limit'] > 0 ) ? intval( $atts['limit'] ) : 6;
    if( isset( $atts['review_only'] ) && $atts['review_only'] == 'on' ) :
        $posts = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'meta_key'     => 'fw:opt:review_score',
        	'meta_value'   => '0',
        	'meta_compare' => '>'
        ));
	elseif( count( $specific_posts ) > 0 ) :
	    $posts = new WP_Query( array( 'post_type' => 'post', 'post__in' => $specific_posts, 'orderby' => 'post__in' ) );
	else :
	    $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit ) );
	endif;

	if( $posts->have_posts() ) : $i = 0; $j = 0; ?>
		<?php if( $atts['style'] == 'style1' || $atts['style'] == 'style1 style5' ) : ?>

			<div class="sh-widget-posts-slider sh-widget-posts-slider-init">
				<div class="sh-widget-posts-slider-group">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; $j++; ?>

                        <?php if( $j == 1 && $atts['style'] == 'style1 style5'  ) : ?>
                            <div class="sh-widget-posts-slider-item sh-widget-posts-slider-item-large sh-widget-posts-slider-style1">
                                <div href="<?php echo get_permalink( get_the_ID() ); ?>" class="post-thumbnail">
                                    <?php echo the_post_thumbnail( 'gillion-landscape-small' ); ?>
                                    <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                                    <?php echo gillion_post_review( get_the_ID() ); ?>
                                </div>
								<a href="<?php echo get_permalink( get_the_ID() ); ?>">
									<h5 class="post-title">
										<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
									</h5>
								</a>
								<?php gillion_post_meta_excerpt( 6 ); ?>
    						</div>
                        <?php else : ?>
    						<div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1">
    							<a href="<?php echo get_permalink( get_the_ID() ); ?>" class="sh-widget-posts-slider-thumbnail sh-post-review-mini" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);">
                                    <?php echo gillion_post_review( get_the_ID() ); ?>
                                    <div class="post-overlay-small"></div>
                                </a>
    							<div class="sh-widget-posts-slider-content">
    								<a href="<?php echo get_permalink( get_the_ID() ); ?>">
    									<h5 class="post-title">
    										<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
    									</h5>
    								</a>
    								<div class="post-meta">
    									<?php gillion_post_meta( 2 ); ?>
    								</div>
    							</div>
    						</div>
                        <?php endif; ?>

						<?php if( $i%$per_slide==0 && $i != $posts->post_count ) : $j = 0; ?>
						</div><div class="sh-widget-posts-slider-group">
						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			</div>

        <?php elseif( $atts['style'] == 'style1 style4' ) : ?>

            <div class="sh-widget-posts-slider">
				<div class="sh-widget-posts-slider-group">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

						<div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1 style4">
							<a href="<?php echo get_permalink( get_the_ID() ); ?>" class="sh-widget-posts-slider-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);"></a>
							<div class="sh-widget-posts-slider-content">
								<a href="<?php echo get_permalink( get_the_ID() ); ?>">
									<h5 class="post-title">
										<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
									</h5>
								</a>
								<div class="post-meta">
									<?php gillion_post_meta( 80 ); ?>
								</div>
							</div>
						</div>

					<?php endwhile; ?>
				</div>
			</div>

		<?php else : ?>

			<div class="sh-widget-posts-slider sh-widget-posts-slider-group-<?php echo esc_attr( $atts['style'] ); ?> sh-widget-posts-slider-init">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

					<div class="sh-widget-posts-slider-item sh-widget-posts-slider-style2">
						<div class="sh-ratio">
							<div class="sh-ratio-container">
								<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-landscape-small' ) ); ?>);">
									<div class="sh-widget-posts-slider-content">

										<a href="<?php echo get_permalink( get_the_ID() ); ?>">
											<h5 class="post-title">
												<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
											</h5>
										</a>
										<div class="post-meta">
											<?php gillion_post_meta( 3 ); ?>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile; ?>
			</div>

		<?php endif; ?>
	<?php endif; ?>

    <?php if( $position == 'bottom' ) : ?>
        <div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
    <?php endif; ?>

<?php echo wp_kses_post( $after_widget ); wp_reset_postdata(); ?>
