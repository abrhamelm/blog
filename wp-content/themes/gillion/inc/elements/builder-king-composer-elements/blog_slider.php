<?php
/**
 * KingComposer Builder - Blog Slider Element Output
 */
if( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

$dots = ( isset( $atts['dots'] ) && $atts['dots'] == 'off' ) ? 'false' : 'true';
$id = 'kc-css-'.esc_attr( $atts['_id'] );
$style = ( isset( $atts['style'] ) ) ? $atts['style'] : 'style1';

$limit = ( $atts['limit'] ) ? $atts['limit'] : 3;
if( $atts['posts'] ) :
    $specific_posts = explode(',', $atts['posts']); $i=0;
    foreach( $specific_posts as $specific_post ) {
        $specific_posts[$i] = intval( $specific_post );
        $i++;
    }
else :
    $specific_posts = array();
endif;
$categories_query = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : array();


if( count( $specific_posts ) > 0 ) :
    $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post__in' => $specific_posts, 'orderby' => 'post__in' ) );
else :
    $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $categories_query ) );
endif;
?>

<?php if( $style == 'style2' ) : ?>

    <script type="text/javascript">
    jQuery(document).ready(function ($) {

        /* Blog Slider */
        $('.<?php echo esc_js( $id ); ?> .blog-slider-list').slick({
            dots: <?php echo esc_js( $dots ); ?>,
            arrows: true,
            fade: false,
            swipe: true,
            swipeToSlide: true,
            speed: 1100,
            useTransform: true,

            centerMode: true,
            centerPadding: '29%',
            slidesToShow: 1,

            prevArrow: '<div class="slick-prev"></div>',
            nextArrow: '<div class="slick-next"></div>',
            appendDots: $('.<?php echo esc_js( $id ); ?> .blog-slider-dots'),

            responsive: [
                {
                  breakpoint: 1400,
                  settings: {
                    centerPadding: '23%',
                  }
                },
                {
                  breakpoint: 1200,
                  settings: {
                    centerPadding: '15%',
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    centerPadding: '5%',
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    centerPadding: '0%',
                  }
                }
              ]
         });
         $('.<?php echo esc_js( $id ); ?> .blog-slider-list').on('setPosition', function(event, slick, currentSlide, nextSlide){
             var slider_info = $('.blog-slider .blog-slider-item.slick-active');
             $('.<?php echo esc_js( $id ); ?> .blog-slider-list .slick-prev').html( '<i class="icon icon-arrow-left-circle"></i><p class="sh-heading-font">' + slider_info.prev().find('.post-categories').html() + '</p><h5>' + slider_info.prev().find('h2').html() + '</h5>' ).fadeIn('slow');
             $('.<?php echo esc_js( $id ); ?> .blog-slider-list .slick-next').html( '<i class="icon icon-arrow-right-circle"></i><p class="sh-heading-font">' + slider_info.next().find('.post-categories').html() + '</p><h5>' + slider_info.next().find('h2').html() + '</h5>' ).fadeIn('slow');
         });

    });
    </script>

    <div class="blog-slider blog-slider-style2 <?php echo esc_attr( $id ); ?>" style="position: relative;">
        <div class="blog-slider-list">
            <?php
            if( count($posts) > 0 ) :
                while ( $posts->have_posts() ) : $posts->the_post(); ?>

                	<div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                        <div class="blog-slider-container">
                    		<div class="blog-slider-content">

                			    <?php gillion_post_categories(); ?>
                    			<a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <h2 class="post-title"><?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?></h2>
                                </a>
                                <div class="post-meta">
                                    <?php gillion_post_meta( 1 ); ?>
                                </div>

                    		</div>
                        </div>
                	</div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        <div class="blog-slider-dots"></div>
    </div>


<?php elseif( $style == 'style3' ) : ?>

    <script type="text/javascript">
    jQuery(document).ready(function ($) {

        /* Blog Slider */
        $('.<?php echo esc_js( $id ); ?> .blog-slider-list').slick({
            dots: <?php echo esc_js( $dots ); ?>,
            arrows: false,
            fade: true,
            swipe: true,
            swipeToSlide: true,
            speed: 500,
            cssEase: 'cubic-bezier(0.445, 0.05, 0.55, 0.95)',
            appendDots: $('.<?php echo esc_js( $id ); ?> .blog-slider-dots'),
         });

    });
    </script>

    <div class="blog-slider blog-slider-style3 <?php echo esc_attr( $id ); ?>" style="position: relative;">
        <div class="blog-slider-list">
            <?php
            if( count($posts) > 0 ) :
                while ( $posts->have_posts() ) : $posts->the_post(); ?>

                	<div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                        <div class="blog-slider-container">
                    		<div class="blog-slider-content">

                                <div class="blog-slider-content-icon">
                                    <i class="<?php
                                        $format = get_post_format();
                                        if( $format == 'gallery' ) :
                                            echo 'icon icon-grid';
                                        elseif( $format == 'video' ) :
                                            echo 'icon icon-control-play';
                                        elseif( $format == 'audio' ) :
                                            echo 'icon icon-volume-2';
                                        elseif( $format == 'link' ) :
                                            echo 'icon icon-link';
                                        elseif( $format == 'quote' ) :
                                            echo 'ti-quote-left';
                                        else :
                                            echo 'icon icon-pencil';
                                        endif;
                                    ?>"></i>
                                </div>
                                <div class="blog-slider-content-details">
                    			    <?php gillion_post_categories(); ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                        			    <h2 class="post-title"><?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?></h2>
                                    </a>
                                    <div class="post-meta">
                                        <?php gillion_post_meta( 1 ); ?>
                                    </div>
                                </div>

                    		</div>
                        </div>
                	</div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        <div class="blog-slider-dots"></div>
    </div>
<?php elseif( $style == 'style4' ) : ?>

    <script type="text/javascript">
        jQuery(window).load( function(){
            jQuery('.<?php echo esc_js( $id ); ?>').addClass( 'loaded' );
        });
    </script>

    <?php $hash = gillion_rand(20); ?>
    <div class="blog-slider blog-slider-style4 <?php echo esc_attr( $id ); ?>">
        <div class="blog-slider-list tab-content">

            <?php if( count($posts) > 0 ) : $i = 0; ?>
                <?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

                    <div class="blog-slider-item tab-pane<?php echo ( $i == 1 ) ? ' active' : ''; ?>" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );" role="tabpanel" id="slide_<?php echo esc_attr( $hash.$i ); ?>">
                        <div class="blog-slider-container">
                    		<div class="blog-slider-content">

                			    <?php gillion_post_categories(); ?>
                    			<a href="<?php echo get_the_permalink(); ?>">
                                    <h2 class="post-title"><?php the_title(); ?></h2>
                                </a>
                                <div class="post-meta">
                                    <?php gillion_post_meta( 1 ); ?>
                                </div>

                    		</div>
                        </div>
                	</div>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>
        <div class="blog-slider-mini-list">
            <div class="sh-widget-posts-slider">
                <?php if( count($posts) > 0 ) : $i = 0; ?>
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

                        <div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1">
							<div class="sh-widget-posts-slider-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>);"></div>
							<div class="sh-widget-posts-slider-content">
                                <?php gillion_post_categories(); ?>
								<a href="#slide_<?php echo esc_attr( $hash.$i ); ?>" aria-controls="home" role="tab" data-toggle="tab">
									<h5 class="post-title">
										<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
									</h5>
								</a>
							</div>
						</div>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php else : ?>

    <script type="text/javascript">
    jQuery(document).ready(function ($) {

        /* Blog Slider */
        $('.<?php echo esc_js( $id ); ?> .blog-slider-list').slick({
            dots: <?php echo esc_js( $dots ); ?>,
            arrows: true,
            fade: false,
            swipe: false,
            swipeToSlide: true,
            speed: 500,
            cssEase: 'cubic-bezier(0.445, 0.05, 0.55, 0.95)',
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<div class="slick-prev"></div>',
            nextArrow: '<div class="slick-next"></div>',
            appendDots: $('.<?php echo esc_js( $id ); ?> .blog-slider-dots'),
         });
         $('.<?php echo esc_attr( $id ); ?> .blog-slider-list').on('setPosition', function(event, slick, currentSlide, nextSlide){
             var slider_info_prev = $('.blog-slider .blog-slider-item.slick-active').prev();
             var slider_info_next = $('.blog-slider .blog-slider-item.slick-active').next();
             $('.<?php echo esc_attr( $id ); ?> .blog-slider-list .slick-prev').html( '<i class="icon icon-arrow-left-circle"></i><p class="sh-heading-font">' + slider_info_prev.find('.post-categories').html() + '</p><h5>' + slider_info_prev.find('h2').html() + '</h5>' ).fadeIn('slow');
             $('.<?php echo esc_attr( $id ); ?> .blog-slider-list .slick-next').html( '<i class="icon icon-arrow-right-circle"></i><p class="sh-heading-font">' + slider_info_next.find('.post-categories').html() + '</p><h5>' + slider_info_next.find('h2').html() + '</h5>' ).fadeIn('slow');
         });

    });
    </script>

    <div class="blog-slider blog-slider-style1 <?php echo esc_attr( $id ); ?>" style="position: relative;">
        <div class="blog-slider-list">
            <?php

            if( count($posts) > 0 ) :
                while ( $posts->have_posts() ) : $posts->the_post(); ?>

                	<div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                        <div class="blog-slider-container">
                    		<div class="blog-slider-content">

                                <div class="blog-slider-content-icon">
                                    <i class="<?php
                                        $format = get_post_format();
                                        if( $format == 'gallery' ) :
                                            echo 'icon icon-grid';
                                        elseif( $format == 'video' ) :
                                            echo 'icon icon-control-play';
                                        elseif( $format == 'audio' ) :
                                            echo 'icon icon-volume-2';
                                        elseif( $format == 'link' ) :
                                            echo 'icon icon-link';
                                        elseif( $format == 'quote' ) :
                                            echo 'ti-quote-left';
                                        else :
                                            echo 'icon icon-pencil';
                                        endif;
                                    ?>"></i>
                                </div>
                                <div class="blog-slider-content-details">
                    			    <?php gillion_post_categories(); ?>
                        			<a href="<?php echo get_the_permalink(); ?>">
                                        <h2 class="post-title"><?php the_title(); ?></h2>
                                    </a>
                                    <div class="post-meta">
                                        <?php gillion_post_meta( 1 ); ?>
                                    </div>
                                </div>

                    		</div>
                        </div>
                	</div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        <div class="blog-slider-dots"></div>
    </div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
