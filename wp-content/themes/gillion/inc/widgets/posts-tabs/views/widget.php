<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
echo wp_kses_post( $before_widget );

$hash = gillion_rand(20);
$limit = ( isset( $params['items_per_page'] ) && $params['items_per_page'] > 0 ) ? intval( $params['items_per_page'] ) : 4;
$title_style = gillion_option( 'global_title', 'style1' ); ?>

<div class="sh-widget-poststab">
	<!-- Nav tabs -->
	<?php if( $title_style == 'style2' ) : ?>
		<div class="sh-widget-title-styling">
			<div class="sh-table">
				<div class="sh-table-cell">
					<h3 class="widget-title">Today's pick</h3>
				</div>
				<div class="sh-table-cell">
	<?php endif; ?>

	<div class="sh-widget-poststab-title">
		<ul class="nav nav-tabs sh-tabs-stying" role="tablist">
			<li class="active">
				<a href="#wtabs_<?php echo esc_attr( $hash ); ?>1" role="tab" data-toggle="tab">
					<h4 class="widget-title widget-tab-title">
						<?php if( isset( $atts['tab_latest'] ) && $atts['tab_latest'] ) :
							echo esc_attr( $atts['tab_latest'] );
						else :
							esc_html_e( 'Latest', 'gillion' );
						endif; ?>
					</h4>
				</a>
			</li>
			<li>
				<a href="#wtabs_<?php echo esc_attr( $hash ); ?>2" role="tab" data-toggle="tab">
					<h4 class="widget-title widget-tab-title">
						<?php if( isset( $atts['tab_popular'] ) && $atts['tab_popular'] ) :
							echo esc_attr( $atts['tab_popular'] );
						else :
							esc_html_e( 'Popular', 'gillion' );
						endif; ?>
					</h4>
				</a>
			</li>
		</ul>
	</div>

	<?php if( $title_style == 'style2' ) : ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="wtabs_<?php echo esc_attr( $hash ); ?>1">

			<?php
			$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'ignore_sticky_posts' => 1 ) );
			if( $posts->have_posts() ) : ?>

				<div class="sh-widget-posts-slider">
					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

							<div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1">
								<a href="<?php echo get_permalink( get_the_ID() ); ?>" class="sh-widget-posts-slider-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);"></a>
								<div class="sh-widget-posts-slider-content">
									<a href="<?php echo get_permalink( get_the_ID() ); ?>">
										<h5 class="post-title">
											<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
										</h5>
									</a>
									<div class="post-meta">
										<?php gillion_post_meta( 5 ); ?>
									</div>
								</div>
							</div>

					<?php endwhile; ?>
				</div>

			<?php endif; ?>

		</div>
		<div role="tabpanel" class="tab-pane" id="wtabs_<?php echo esc_attr( $hash ); ?>2">

			<?php
			$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'ignore_sticky_posts' => 1, 'meta_key' => 'gillion_post_views', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) );
			if( $posts->have_posts() ) : ?>

				<div class="sh-widget-posts-slider">
					<?php while ( $posts->have_posts() ) : $posts->the_post();?>

							<div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1">
								<a href="<?php echo get_permalink( get_the_ID() ); ?>" class="sh-widget-posts-slider-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);"></a>
								<div class="sh-widget-posts-slider-content">
									<a href="<?php echo get_permalink( get_the_ID() ); ?>">
										<h5 class="post-title">
											<?php the_title(); ?>
											<?php gillion_post_readlater( get_the_ID() ); ?>
										</h5>
									</a>
									<div class="post-meta">
										<?php gillion_post_meta( 5 ); ?>
									</div>
								</div>
							</div>

					<?php endwhile; ?>
				</div>

			<?php endif; ?>

		</div>
	</div>
</div>

<?php echo wp_kses_post( $after_widget ); wp_reset_postdata(); ?>
