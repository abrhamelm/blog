<?php
/**
 * KingComposer Builder - Blog Fancy Posts Element Output
 */
if( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

$id = 'kc-css-'.esc_attr( $atts['_id'] );
$css_class = array();
$css_class[] = $id;
$css_class[] = 'kc-css-class';
$css_class[] = 'sh-blog-fancy';
$style = ( isset( $atts['style'] ) ) ? $atts['style'] : 'cover';
$elements = gillion_option( 'post_elements' );

/* Limit Posts */
if( $atts['posts'] ) :
    $specific_posts = explode(',', $atts['posts']); $i=0;
    foreach( $specific_posts as $specific_post ) {
        $specific_posts[$i] = intval( $specific_post );
        $i++;
    }
else :
    $specific_posts = array();
endif;

/* Set columns */
$columns = '';
if( $style == 'cover' && isset( $atts['columns'] ) && $atts['columns'] ) :
    $columns = $atts['columns'];
elseif( $style == 'coverbig' && isset( $atts['columns'] ) && $atts['columns'] ) :
    $columns = $atts['columns'];
elseif( $style == 'mini1' && isset( $atts['columns2'] ) && $atts['columns2'] ) :
    $columns = $atts['columns2'];
elseif( $style == 'mini2' && isset( $atts['columns3'] ) && $atts['columns3'] ) :
    $columns = $atts['columns3'];
endif;

/* Set carousel */
$class = array();
$carousel_columns = '';
if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' ) ) :
	if( $atts['carousel'] == 'sides' ) :
		$class[] = 'blog-fancy-carousel-sides slider-arrows-sides';
	else :
		$class[] = 'blog-fancy-carousel-title slider-arrows-sides';
	endif;
	$carousel_columns = str_replace("columns","", $columns );
endif;

/* Set post content style */
if( $style == 'cover' ) :
	$set_style = ( $columns == 'columns3' ) ? 'cover-small' : 'cover-large';
elseif( $style == 'mini1' ) :
	$set_style = 'grid-simple';
else :
	$set_style = $style;
endif;

/* Set blog style */
$style_class = $style;
if( $style_class == 'coverbig' ) :
    $set_style = 'cover-large';
    $style_class = 'cover';
    $class[] = ( $style_class ) ? 'blog-style-'.esc_attr( $style_class ).' blog-style-coverbig columns2' : '';
else :
    $class[] = ( $style_class ) ? 'blog-style-'.esc_attr( $style_class ) : '';
endif;

$class[] = ( $columns ) ? $columns : '';


/* Alignment */
if( $style == 'cover' || $style == 'coverbig' ) :
    if( $atts['alignment'] == 'center' ) :
        $class[] = 'blog-style-cover-center';
    endif;
endif;
?>


<?php if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' ) ) : ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";

        <?php if( $atts['carousel'] == 'sides' ) : ?>
            $('.<?php echo esc_attr($id); ?> .blog-fancy-carousel-sides').not('.slick-initialized').slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 300,
                slidesToShow: <?php echo intval($carousel_columns); ?>,
                slidesToScroll: <?php echo intval($carousel_columns); ?>,
                adaptiveHeight: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="icon icon-arrow-left-circle"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="icon icon-arrow-right-circle"></i></button>',
            });
        <?php else : ?>
            $('.<?php echo esc_attr($id); ?> .blog-fancy-carousel-title').not('.slick-initialized').each( function() {
                var fancy_carousel_columns = parseInt( $(this).attr('data-columns') );
                var fancy_carousel_slider = $(this);
                $(this).slick({
                    dots: false,
                    arrows: true,
                    infinite: false,
                    speed: 1100,
                    slidesToShow: <?php echo intval($carousel_columns); ?>,
                    slidesToScroll: <?php echo intval($carousel_columns); ?>,
                    appendArrows: $(fancy_carousel_slider).parent().find('.widget-slide-arrows'),
                    prevArrow: '<button type="button" class="slick-prev"><i class="icon icon-arrow-left-circle"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="icon icon-arrow-right-circle"></i></button>',
                    responsive: [
                        {
                          breakpoint: 1026,
                          settings: {
                              slidesToShow: <?php echo ( $carousel_columns == 1 ) ? 1 : 2; ?>,
                              slidesToScroll: <?php echo ( $carousel_columns == 1 ) ? 1 : 2; ?>,
                          }
                        },
                        {
                          breakpoint: 768,
                          settings: {
                              slidesToShow: 1,
                              slidesToScroll: 1,
                          }
                        }
                    ],
                    zIndex: 100,
                    useTransform: true
                });
            });
        <?php endif; ?>

    });
</script>
<?php endif; ?>


<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
    <?php if( isset($atts['title']) && $atts['title'] ) : ?>
		<?php if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' ) ) :
            $title_class = ( $atts['carousel'] == 'sides' ) ? ' sh-blog-fancy-title-container-sides' : '';
        ?>
			<div class="sh-blog-fancy-title-container<?php echo esc_attr( $title_class ); ?>">
				<h2 class="sh-blog-fancy-title">
					<?php echo esc_attr( $atts['title'] ); ?>
				</h2>
				<div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
			</div>
		<?php else : ?>
			<h2 class="sh-blog-fancy-title">
				<?php echo esc_attr( $atts['title'] ); ?>
			</h2>
		<?php endif; ?>
	<?php endif; ?>

	<div class="<?php echo esc_attr( implode( " ", $class ) ); ?>">
		<?php
			set_query_var( 'style', $set_style );

			$limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] ) : 6;
			if( $style_class == 'fancy1' && $limit > 3 ) : $limit = 3; endif;
			if( $style_class == 'fancy2' && $limit > 5 ) : $limit = 5; endif;
			if( $style_class == 'fancy3' && $limit > 3 ) : $limit = 3; endif;
			$categories_query = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : array();
			$orderby = ( isset($atts['order_by']) && $atts['order_by'] ) ? esc_attr( $atts['order_by'] ) : 'post_date';
			$order = ( isset($atts['order']) && $atts['order'] ) ? esc_attr( $atts['order'] ) : 'desc';

            if( count( $specific_posts ) > 0 ) :
			    $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post__in' => $specific_posts, 'orderby' => 'post__in' ) );
            else :
                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $categories_query, 'orderby' => $orderby, 'order' => $order ) );
            endif;

			if( count($posts) > 0 ) : $i=0;
				while ( $posts->have_posts() ) : $posts->the_post(); $i++;

					if( $style_class == 'mini2' ) : ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
							<div class="post-container">
								<div class="post-thumbnail-mini" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>);">
								</div>
								<div class="post-container-mini">
									<?php gillion_post_categories(); ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
										<h2>
											<?php gillion_sticky_post(); ?>
											<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
										</h2>
									</a>
								</div>
							</div>
						</article>

					<?php elseif( $style_class == 'fancy1' ) :  ?>


						<?php /* Create post structure */ if( $i == 1 ) : set_query_var( 'style', '' ); set_query_var( 'style_image', 'ratio' ); ?>
							<div class="row">
								<div class="col-md-6 blog-style-left">
									<article class="post-item">
						<?php else : set_query_var( 'style', 'cover-large' ); ?>
						<?php endif; ?>

								<?php /* Load post data */
									if( get_post_format() ) :
										get_template_part( 'content', 'format-'.get_post_format() );
									else :
										get_template_part( 'content' );
									endif;
								?>

							<?php if( $i == 1 ) : /* Create custom post data structure */ ?>
											<div class="post-content-container">
												<?php gillion_post_categories(); ?>

												<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
													<h2>
														<?php gillion_sticky_post(); ?>
														<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
													</h2>
												</a>

												<div class="post-content">
													<?php the_excerpt(); ?>
												</div>

												<div class="post-meta">
													<?php gillion_post_meta(); ?>
												</div>
											</div>
										</article>

									</div>
									<div class="col-md-6 blog-style-cover">
								<?php set_query_var( 'style_image', '' ); ?>
							<?php endif; ?>

						<?php /* Create post structure */
						if( $i == $posts->post_count ) : ?>
							</div></div>
						<?php endif; ?>


					<?php elseif( $style_class == 'fancy2' ) : ?>


						<?php /* Create post structure */ if( $i == 1 ) : ?>
							<div class="row">
								<div class="col-md-4 blog-style-cover">
									<article class="post-item">
						<?php endif; ?>

						<?php
							if( $i == 3 ) : set_query_var( 'style', 'masonry' );
							else : set_query_var( 'style', 'cover-small' );
							endif;
						?>

								<?php /* Load post data */
									if( get_post_format() ) :
										get_template_part( 'content', 'format-'.get_post_format() );
									else :
										get_template_part( 'content' );
									endif;
								?>

							<?php if( $i == 2 || $i == 3 ) : /* Create custom post data structure */ ?>
									</div>
									<div class="col-md-4 blog-style-cover">
							<?php endif; ?>

						<?php /* Create post structure */
						if( $i == $posts->post_count ) : ?>
							</div></div>
						<?php endif; ?>


					<?php elseif( $style_class == 'fancy3' ) : ?>


						<?php set_query_var( 'style_image', 'ratio' );  /* Create post structure */
						if( $i == 1 ) :  ?>
							<div class="row">
								<div class="col-md-6 blog-style-left">
						<?php endif; ?>


							<article class="post-item">
								<div class="post-content-container">
									<?php if( $i == 1 ) :  ?>

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

										<div class="row post-content-mix">
											<div class="col-md-6">
												<?php /* Load post data */
													if( get_post_format() ) :
														get_template_part( 'content', 'format-'.get_post_format() );
													else :
														get_template_part( 'content' );
													endif;
												?>
											</div>
											<div class="col-md-6">
												<div class="post-content">
													<?php the_excerpt(); ?>
												</div>
											</div>
										</div>

									<?php else : ?>

										<div class="row">
											<div class="col-md-4">
												<?php /* Load post data */
													if( get_post_format() ) :
														get_template_part( 'content', 'format-'.get_post_format() );
													else :
														get_template_part( 'content' );
													endif;
												?>
											</div>
											<div class="col-md-8">
												<?php gillion_post_categories(); ?>

												<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
													<h2>
														<?php gillion_sticky_post(); ?>
														<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
													</h2>
												</a>

												<div class="post-content">
													<?php the_excerpt(); ?>
												</div>
											</div>
										</div>

									<?php endif; ?>
								</div>
							</article>


							<?php if( $i == 1 ) : /* Create custom post data structure */ ?>
								</div>
								<div class="col-md-6 blog-style-left blog-style-left-custom">
							<?php endif; ?>

						<?php /* Create post structure */
						if( $i == $posts->post_count ) : ?>
							</div></div>
						<?php endif; ?>

						<?php set_query_var( 'style_image', '' ); ?>


					<?php else :
						if( get_post_format() ) :
							get_template_part( 'content', 'format-'.get_post_format() );
						else :
							get_template_part( 'content' );
						endif;
					endif;

				endwhile;
				wp_reset_postdata();
			endif;
		?>
	</div>
</div>
