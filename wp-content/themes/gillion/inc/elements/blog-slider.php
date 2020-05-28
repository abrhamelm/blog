<?php
/*
Element: Blog Slider
*/

class vcBlogSlider extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_slider', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Blog Slider', 'gillion'),
                'base' => 'vcg_blog_slider',
                'description' => __('Gillion blog posts slider', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'style',
                        'heading' => __( 'Post Style', 'gillion' ),
                        'description' => __( 'Choose slider style', 'gillion' ),
                        'value' => array(
                            __('Style 1 (single slide)', 'gillion') => 'style1',
                            __('Style 2 (carousel)', 'gillion') => 'style2',
                            __('Style 3 (single slide without arrows)', 'gillion') => 'style3',
                            __('Style 4 (single slide with side list)', 'gillion') => 'style4',
                            __('Style 5 (grid slide with 3 posts)', 'gillion') => 'style5',
                            __('Style 6 (single slide without arrows in center)', 'gillion') => 'style6',
                            __('Style 7 (single slide with side content)', 'gillion') => 'style7',
                            __('Style 8 (grid slide with 4 posts)', 'gillion') => 'style8',
                            __('Style 9 (mosaic slide with 4 posts)', 'gillion') => 'style9',
                            __('Style 10 (carousel - centered)', 'gillion') => 'style2 style10',
                            __('Style 11 (minimalistic)', 'gillion') => 'style11',
                            __('Style 12 (mosaic slide with 5 posts)', 'gillion') => 'style12',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'limit',
                        'heading' => __( 'Posts Limit', 'gillion' ),
                        'description' => __( 'Choose posts limit', 'gillion' ),
                        'value' => '3',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'exclude_latest_posts',
                        'heading' => __( 'Exclude Latest Posts', 'gillion' ),
                        'description' => __( 'Choose how many latest posts will be excluded. Notice: will work only if "Show Only Specific Posts" or "Categories" option is not used', 'gillion' ),
                        'value' => '0',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'posts',
                        'heading' => __( 'Show Only Specific Posts', 'gillion' ),
                        'description' => __( 'Enter post IDs with comma, like: 1,2,3,4,5. It will overwrite categories option', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'categories',
                        'heading' => __( 'Show Only Specific Categories', 'gillion' ),
                        'description' => __( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'gillion' ),
                        'value' => '',
                        'type' => 'exploded_textarea',
                        'holder' => 'div',
                        'class' => '',
                    ),


                    /* Autoplay */
                    array(
                        'param_name' => 'autoplay',
                        'heading' => __( 'Autoplay', 'gillion' ),
                        'description' => __( 'Choose to enable or disable slider autoplay', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'group' => 'Autoplay',
                    ),

                    array(
                        'param_name' => 'autoplay_speed',
                        'heading' => __( 'Autoplay Speed (s)', 'gillion' ),
                        'description' => __( 'Choose Autoplay Speed (1-10 seconds interval)', 'gillion' ),
                        'value' => '6',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'group' => 'Autoplay',
                    ),


                    /* Styling */
                    array(
                        'param_name' => 'meta',
                        'heading' => __( 'Information Fields', 'gillion' ),
                        'description' => __( 'Choose slider information fields', 'gillion' ),
                        'value' => array(
                            __('Author, Date + Comments + Read time', 'gillion') => '51',
                            __('Author, Date + Comments + Read time + Page Views', 'gillion') => '50',
                            __('Author, Date + Comments + Page Views', 'gillion') => '52',
                            __('Author, Date + Comments', 'gillion') => '53',
                            __('Author, Date', 'gillion') => '54',
                            __('Author (without image), Date', 'gillion') => '55',
                            __('Author (without image), Date + Comments', 'gillion') => '56',
                            __('None', 'gillion') => 'none',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        'group' => 'Styling',
                    ),

                    array(
                        'param_name' => 'dots',
                        'heading' => __( 'Slider Dots', 'gillion' ),
                        'description' => __( 'Choose to enable or disable slider dots', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'class' => '',
                        'group' => 'Styling',
                    ),

                    array(
                        'param_name' => 'uppercase',
                        'heading' => __( 'Uppercase Title', 'gillion' ),
                        'description' => __( 'Choose to enable or disable uppercase title', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'group' => 'Styling',
                    ),

                ),
            )
        );

    }


    public function _html( $atts ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $atts['style'] = ( isset( $atts['style'] ) ) ? $atts['style'] : 'style1';
        $atts['limit'] = ( isset( $atts['limit'] ) ) ? $atts['limit'] : 3;
        $atts['dots'] = ( isset( $atts['dots'] ) ) ? $atts['dots'] : true;
        $atts['uppercase'] = ( isset( $atts['uppercase'] ) ) ? $atts['uppercase'] : false;
        $atts['autoplay'] = ( isset( $atts['autoplay'] ) ) ? $atts['autoplay'] : true;
        $atts['autoplay_speed'] = ( isset( $atts['autoplay_speed'] ) ) ? $atts['autoplay_speed'] : 6;
        $atts['posts'] = ( isset( $atts['posts'] ) ) ? $atts['posts'] : '';
        $atts['meta'] = ( isset( $atts['meta'] ) ) ? $atts['meta'] : '51';
        $atts['categories'] = ( isset( $atts['categories'] ) ) ? $atts['categories'] : '';
        $atts['exclude_latest_posts'] = ( isset( $atts['exclude_latest_posts'] ) && $atts['exclude_latest_posts'] > 0 ) ? $atts['exclude_latest_posts'] : 0;
        ob_start();

            $class = ( isset( $atts['meta'] ) && $atts['meta'] == 'none' ) ? ' blog-slider-content-without-meta' : '';
            $dots = ( isset( $atts['dots'] ) && $atts['dots'] == 'off' ) ? 'false' : 'true';
            $autoplay = ( isset( $atts['autoplay'] ) && $atts['autoplay'] == 'off' ) ? 'false' : 'true';
            $autoplay_speed = ( isset( $atts['autoplay_speed'] ) && ( $atts['autoplay_speed'] >= 1 && $atts['autoplay_speed'] <= 10 ) ) ? ( $atts['autoplay_speed'] * 1000 ) : 6000;
            $id = 'blog-slider-'.gillion_rand();
            $style = ( isset( $atts['style'] ) ) ? $atts['style'] : 'style1';
            $class.= ( isset( $atts['uppercase'] ) && $atts['uppercase'] ) ? ' blog-slider-uppercase-title' : '';

            $limit = (isset( $atts['limit'] ) && $atts['limit'] ) ? $atts['limit'] : 3;
            if( isset( $atts['posts']) && $atts['posts'] ) :
                $specific_posts = explode(',', $atts['posts']); $i=0;
                foreach( $specific_posts as $specific_post ) {
                    $specific_posts[$i] = intval( $specific_post );
                    $i++;
                }
            else :
                $specific_posts = array();
            endif;


            if( isset( $atts['categories'] ) && $atts['categories'] ) :
                $categories = $atts['categories'];
            else :
                $categories = '';
            endif;


            /* Exclude X latest posts */
            if( isset( $atts['exclude_latest_posts'] ) && $atts['exclude_latest_posts'] > 0 ) :
                $get_latest_posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => intval( $atts['exclude_latest_posts'] ), 'orderby' => 'date', 'ignore_sticky_posts' => 1, 'fields' => 'ids' ) );
                $exclude = $get_latest_posts->posts;
            else :
                $exclude = array();
            endif;


            if( count( $specific_posts ) > 0 ) :
                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post__in' => $specific_posts, 'orderby' => 'post__in', 'ignore_sticky_posts' => 1 ) );
            elseif( $categories ) :
                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $categories, 'ignore_sticky_posts' => 1 ) );
            else :
                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post__not_in' => $exclude, 'ignore_sticky_posts' => 1 ) );
            endif;
        ?>

            <script type="text/javascript">
            jQuery(document).ready(function ($) {

                <?php /* Slider Settings */ ?>
                <?php if( $style != 'style4' ) : ?>
                    if( $.isFunction( $.fn.slick ) ) {
                        <?php if( $style != 'style5' && $style != 'style8' && $style != 'style9' && $style != 'style12' ) : ?>
                        $('.<?php echo esc_js( $id ); ?> .blog-slider-list').slick({
                        <?php else : ?>
                        $('.<?php echo esc_js( $id ); ?>').slick({
                        <?php endif; ?>

                            /* rtl: <?php ( gillion_option( 'rtl' ) ? 'true' : 'false' ); ?>, */

                            autoplay: <?php echo esc_js( $autoplay ); ?>,
                            autoplaySpeed: <?php echo esc_js( $autoplay_speed ); ?>,

                            dots: <?php echo esc_js( $dots ); ?>,
                            arrows: <?php echo ( in_array( $style, array( 'style1', 'style2', 'style2 style10', 'style5', 'style8', 'style9', 'style11' ) ) ) ? 'true' : 'false'; ?>,
                            swipe:  <?php echo ( !in_array( $style, array( 'style1', 'style6') ) ) ? 'true' : 'false'; ?>,
                            swipeToSlide: true,
                            cssEase: 'cubic-bezier(0.445, 0.05, 0.55, 0.95)',
                            appendDots: $('.<?php echo esc_js( $id ); ?> .blog-slider-dots'),
                            fade: <?php echo ( in_array( $style, array( 'style3', 'style11' ) ) ) ? 'true' : 'false'; ?>,
                            speed: <?php echo ( in_array( $style, array( 'style2', 'style2 style10' ) ) ) ? '1100' : '500'; ?>,
                            slidesToScroll: <?php echo ( in_array( $style, array( 'style1', 'style6', 'style7') ) ) ? '1' : '0'; ?>,

                            <?php if( in_array( $style, array( 'style1', 'style2', 'style2 style10', 'style6', 'style7' ) ) ) : ?>
                                slidesToShow: 1,
                                prevArrow: '<div class="slick-prev"></div>',
                                nextArrow: '<div class="slick-next"></div>',
                            <?php endif; ?>

                            <?php if( in_array( $style, array( 'style5', 'style8', 'style9', 'style11' ) ) ) : ?>
                                prevArrow: '<div class="slick-prev"><i class="icon icon-arrow-left-circle"></i></div>',
                                nextArrow: '<div class="slick-next"><i class="icon icon-arrow-right-circle"></i></div>',
                            <?php endif; ?>

                            <?php if( $style == 'style2' || $style == 'style2 style10' ) : ?>
                                useTransform: true,
                                centerMode: true,
                                centerPadding: '29%',
                                responsive: [
                                    {
                                        breakpoint: 1400,
                                        settings: { centerPadding: '23%', }
                                    },
                                    {
                                        breakpoint: 1200,
                                        settings: { centerPadding: '15%', }
                                    },
                                    {
                                        breakpoint: 768,
                                        settings: { centerPadding: '5%', }
                                    },
                                    {
                                        breakpoint: 600,
                                        settings: { centerPadding: '0%', }
                                    }
                                  ]
                            <?php endif; ?>
                        });
                    }
                <?php else : ?>

                    jQuery('body.vc_editor .<?php echo esc_js( $id ); ?>').addClass( 'loaded' );
                    jQuery(window).load( function(){
                        jQuery('.<?php echo esc_js( $id ); ?>').addClass( 'loaded' );

                        <?php if( $autoplay == 'true' ) : ?>
                            jQuery(function($){
                                var tabs = $('.<?php echo esc_js( $id ); ?> .tab-content > .tab-pane');
                                var counter = 0;
                                var blog_style4 = window.setInterval( activateTab, <?php echo esc_js( $autoplay_speed ); ?> );
                                function activateTab(){
                                    if( $('.<?php echo esc_js( $id ); ?> .tab-content > .tab-pane.active').next().length ) {
                                        var next = $('.<?php echo esc_js( $id ); ?> .tab-content > .tab-pane.active').next();
                                    } else {
                                        var next = $('.<?php echo esc_js( $id ); ?> .tab-content > .tab-pane:first-child');
                                    }

                                    $('.<?php echo esc_js( $id ); ?> .tab-content > .tab-pane.active').removeClass('active').hide();
                                    next.addClass('active').show();
                                }

                                tabs.on('hover', function() {
                                    clearTimeout(blog_style4);
                                    blog_style4 = window.setInterval( activateTab, <?php echo esc_js( $autoplay_speed ); ?> );
                                });
                            });
                        <?php endif; ?>
                    });

                <?php endif; ?>


                <?php /* Slider Controls */ ?>
                <?php if( in_array( $style, array( 'style2', 'style2 style10' ) ) ) : ?>

                    $('.<?php echo esc_js( $id ); ?> .blog-slider-list').on('setPosition', function(event, slick, currentSlide, nextSlide){
                        var slider_info = $('.<?php echo esc_attr( $id ); ?> .blog-slider-item.slick-active');
                        $('.<?php echo esc_js( $id ); ?> .blog-slider-list .slick-prev').html( '<i class="icon icon-arrow-left-circle"></i><p class="sh-heading-font">' + slider_info.prev().find('.post-categories').html() + '</p><h5>' + slider_info.prev().find('h2').html() + '</h5>' ).fadeIn('slow');
                        $('.<?php echo esc_js( $id ); ?> .blog-slider-list .slick-next').html( '<i class="icon icon-arrow-right-circle"></i><p class="sh-heading-font">' + slider_info.next().find('.post-categories').html() + '</p><h5>' + slider_info.next().find('h2').html() + '</h5>' ).fadeIn('slow');
                    });

                <?php elseif( in_array( $style, array( 'style1', 'style6' ) ) ) : ?>

                    $('.<?php echo esc_attr( $id ); ?> .blog-slider-list').on('setPosition', function(event, slick, currentSlide, nextSlide){
                        var slider_info_prev = $('.<?php echo esc_attr( $id ); ?> .blog-slider-item.slick-active').prev();
                        var slider_info_next = $('.<?php echo esc_attr( $id ); ?> .blog-slider-item.slick-active').next();
                        $('.<?php echo esc_attr( $id ); ?> .blog-slider-list .slick-prev').html( '<i class="icon icon-arrow-left-circle"></i><p class="sh-heading-font">' + slider_info_prev.find('.post-categories').html() + '</p><h5>' + slider_info_prev.find('h2').html() + '</h5>' ).fadeIn('slow');
                        $('.<?php echo esc_attr( $id ); ?> .blog-slider-list .slick-next').html( '<i class="icon icon-arrow-right-circle"></i><p class="sh-heading-font">' + slider_info_next.find('.post-categories').html() + '</p><h5>' + slider_info_next.find('h2').html() + '</h5>' ).fadeIn('slow');
                    });

                <?php elseif( $style == 'style7') : ?>

                    $('.<?php echo esc_attr( $id ); ?> .blog-basic-slider-item-prev').on('click', function() {
                        $('.<?php echo esc_attr( $id ); ?> .blog-slider-list').slick('slickPrev');
                    });
                    $('.<?php echo esc_attr( $id ); ?> .blog-basic-slider-item-next').on('click', function() {
                        $('.<?php echo esc_attr( $id ); ?> .blog-slider-list').slick('slickNext');
                    });

                <?php endif; ?>

            });
            </script>


            <?php if( $style == 'style2' || $style == 'style2 style10' ) : ?>


                <div class="blog-slider blog-slider-<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $id.$class ); ?>" style="position: relative;">
                    <div class="blog-slider-list">
                        <?php
                        if( $posts->have_posts() ) :
                            while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'large' ) ); ?> );">
                                    <div class="blog-slider-container">
                                        <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                            <?php gillion_post_categories_position( 'any' ); ?>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                <h2 class="post-title"><?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?></h2>
                                            </a>
                                            <div class="post-meta">
                                                <?php if( $atts['meta'] > 0 ) : ?>
                                                    <?php gillion_post_meta( $atts['meta'] ); ?>
                                                <?php endif; ?>
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


            <?php elseif( $style == 'style3' || $style == 'style11' ) :
                $style_class = ( $style == 'style3' ) ? ' blog-slider-style3 ' : ' blog-slider-style3 blog-slider-style11 ';
            ?>


                <div class="blog-slider <?php echo esc_attr( $style_class.$id.$class ); ?>" style="position: relative;">
                    <div class="blog-slider-list">
                        <?php
                        if( $posts->have_posts() ) :
                            while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                                    <div class="blog-slider-container">
                                        <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                            <div class="blog-slider-content-icon">
                                                <i class="<?php
                                                    $format = get_post_format();
                                                    if( $format == 'gallery' ) :
                                                        echo 'ti-image';
                                                    elseif( $format == 'video' ) :
                                                        echo 'ti-control-play';
                                                    elseif( $format == 'audio' ) :
                                                        echo 'ti-headphone';
                                                    elseif( $format == 'link' ) :
                                                        echo 'ti-link';
                                                    elseif( $format == 'quote' ) :
                                                        echo 'ti-quote-left';
                                                    else :
                                                        echo 'icon icon-pencil';
                                                    endif;
                                                ?>"></i>
                                            </div>
                                            <div class="blog-slider-content-details">
                                                <?php gillion_post_categories_position( 'any' ); ?>
                                                <a href="<?php echo get_the_permalink(); ?>">
                                                    <h2 class="post-title"><?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?></h2>
                                                </a>
                                                <div class="post-meta">
                                                    <?php if( $atts['meta'] > 0 ) : ?>
                                                        <?php gillion_post_meta( $atts['meta'] ); ?>
                                                    <?php endif; ?>
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


                <?php $hash = gillion_rand(20); ?>
                <div class="blog-slider blog-slider-style4 <?php echo esc_attr( $id.$class ); ?>">
                    <div class="blog-slider-list tab-content">

                        <?php if( $posts->have_posts() ) : $i = 0; ?>
                            <?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

                                <div class="blog-slider-item tab-pane<?php echo ( $i == 1 ) ? ' active' : ''; ?>" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );" role="tabpanel" id="slide_<?php echo esc_attr( $hash.$i ); ?>">
                                    <div class="blog-slider-container">
                                        <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                            <?php gillion_post_categories_position( 'any' ); ?>
                                            <a href="<?php echo get_the_permalink(); ?>">
                                                <h2 class="post-title"><?php the_title(); ?></h2>
                                            </a>
                                            <div class="post-meta">
                                                <?php if( $atts['meta'] > 0 ) : ?>
                                                    <?php gillion_post_meta( $atts['meta'] ); ?>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                    <div class="blog-slider-mini-list">
                        <div class="sh-widget-posts-slider">
                            <?php if( $posts->have_posts() ) : $i = 0; ?>
                                <?php while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

                                    <div class="sh-widget-posts-slider-item sh-widget-posts-slider-style1">
                                        <div class="sh-widget-posts-slider-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?>);"></div>
                                        <div class="sh-widget-posts-slider-content">
                                            <?php gillion_post_categories_position( 'any' ); ?>
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


            <?php elseif( $style == 'style5' ) : ?>


                <div class="blog-slider blog-slider-style5 <?php echo esc_attr( $id.$class ); ?>">
                    <div class="blog-grid-list">
                        <?php if( $posts->have_posts() ) : $j = 0; $n = 0;
                            while ( $posts->have_posts() ) : $posts->the_post(); $j++; $n++;
                                $size = ( $j == 1 ) ? 'large' : 'small'; ?>

                                <div class="blog-grid-<?php echo esc_attr( $size ); ?> blog-grid-item<?php echo esc_attr( $j ); ?>">
                                    <div class="blog-grid-item-container blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'large' ) ); ?> );">

                                        <div class="blog-slider-container">
                                            <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                                <div class="blog-slider-content-details">
                                                    <?php gillion_post_categories_position( 'any' ); ?>
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <h2 class="post-title"><?php the_title(); ?></h2>
                                                    </a>
                                                    <div class="post-meta">
                                                        <?php if( $atts['meta'] > 0 ) : ?>
                                                            <?php gillion_post_meta( $atts['meta'] ); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <?php if( $j == 3 && $n != $posts->post_count ) : $j = 0 ?>
                                    </div><div class="blog-grid-list">
                                <?php endif; ?>

                            <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>


            <?php elseif( $style == 'style6' ) : ?>


                <div class="blog-slider blog-slider-style6 <?php echo esc_attr( $id.$class ); ?>" style="position: relative;">
                    <div class="blog-slider-list">
                        <?php

                        if( $posts->have_posts() ) :
                            while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                                    <div class="blog-slider-container">
                                        <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                            <div class="blog-slider-content-details">
                                                <?php gillion_post_categories_position( 'any' ); ?>
                                                <a href="<?php echo get_the_permalink(); ?>">
                                                    <h2 class="post-title"><?php the_title(); ?></h2>
                                                </a>
                                                <div class="post-meta">
                                                    <?php if( $atts['meta'] > 0 ) : ?>
                                                        <?php gillion_post_meta( $atts['meta'] ); ?>
                                                    <?php endif; ?>
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


            <?php elseif( $style == 'style7' ) : ?>


                <div class="blog-slider blog-slider-style7 <?php echo esc_attr( $id.$class ); ?>">
                    <div class="blog-slider-list">
                        <?php

                        if( $posts->have_posts() ) :
                            while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <div class="blog-basic-slider-item">
                                    <div class="blog-basic-slider-item-container" style="padding: 0 15px;">
                                        <div class="row<?php echo esc_attr( $class ); ?>">
                                            <div class="col-md-8 col-sm-7 blog-basic-slider-item-thumbnail post-thumbnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                                                <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-5">
                                                <div class="blog-slider-content-details">
                                                    <div class="blog-basic-slider-item-controls">
                                                        <span>
                                                            <i class="blog-basic-slider-item-prev icon icon-arrow-left-circle"></i>
                                                        </span>
                                                        <span>
                                                            <i class="blog-basic-slider-item-next icon icon-arrow-right-circle"></i>
                                                        </span>
                                                    </div>

                                                    <?php gillion_post_categories_position( 'any' ); ?>
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <h2 class="post-title"><?php the_title(); ?></h2>
                                                    </a>
                                                    <div class="post-content">
                                						<?php the_excerpt(); ?>
                                					</div>
                                                    <div class="post-meta">
                                                        <?php if( $atts['meta'] > 0 ) : ?>
                                                            <?php gillion_post_meta( $atts['meta'] ); ?>
                                                        <?php endif; ?>
                                                    </div>
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


            <?php elseif( $style == 'style8' || $style == 'style9' || $style == 'style12' ) :
                $items_per_page = ( $style == 'style12' ) ? 5 : 4;
                $style = ( $style == 'style12' ) ? 'style9 blog-slider-'.$style : $style;
            ?>

                <div class="blog-slider-container-<?php echo esc_attr( $style ); ?>">
                    <div class="blog-slider blog-slider-<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $id.$class ); ?>">
                        <div class="blog-grid-list">
                            <?php if( $posts->have_posts() ) : $j = 0; $n = 0;
                                while ( $posts->have_posts() ) : $posts->the_post(); $j++; $n++;
                                if( $style == 'style8' ) :
                                    $size = ( $j == 1 || $j == 4 ) ? 'large' : 'small';

                                elseif( $style == 'style9' ) :
                                    if( $j == 1 ) :
                                        $size = 'large';
                                    elseif( $j == 2 || $j == 3) :
                                        $size = 'small';
                                    else :
                                        $size = 'medium';
                                    endif;

                                elseif( $style == 'style9 blog-slider-style12' ) :
                                    $size = ( $j == 3 ) ? 'large' : 'small';
                                endif; ?>

                                <?php if( $j == 1 && $style == 'style9 blog-slider-style12' ) : ?>
                                    <div class="blog-grid-small-container">
                                <?php endif; ?>
                                <?php if( $j == 3 && $style == 'style9 blog-slider-style12' ) : ?>
                                    </div>
                                <?php endif; ?>

                                    <div class="blog-grid-<?php echo esc_attr( $size ); ?> blog-grid-item<?php echo esc_attr( $j ); ?>">
                                        <div class="blog-grid-item-container blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'large' ) ); ?> );">

                                            <div class="blog-slider-container">
                                                <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                                    <div class="blog-slider-content-details">
                                                        <?php gillion_post_categories_position( 'any' ); ?>
                                                        <a href="<?php echo get_the_permalink(); ?>">
                                                            <h2 class="post-title"><?php the_title(); ?></h2>
                                                        </a>
                                                        <?php if( $size != 'small' ) : ?>
                                                            <div class="post-meta">
                                                                <?php if( $atts['meta'] > 0 ) : ?>
                                                                    <?php gillion_post_meta( $atts['meta'] ); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <?php if( $j == $items_per_page && $n != $posts->post_count ) : $j = 0 ?>
                                        </div><div class="blog-grid-list">
                                    <?php endif; ?>

                                <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </div>
                    </div>
                </div>

            <?php else : ?>

                <div class="blog-slider blog-slider-style1 <?php echo esc_attr( $id.$class ); ?>" style="position: relative;">
                    <div class="blog-slider-list">
                        <?php

                        if( $posts->have_posts() ) :
                            while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                <div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
                                    <div class="blog-slider-container">
                                        <div class="blog-slider-content<?php echo esc_attr( $class ); ?>">

                                            <div class="blog-slider-content-icon">
                                                <i class="<?php
                                                    $format = get_post_format();
                                                    if( $format == 'gallery' ) :
                                                        echo 'ti-image';
                                                    elseif( $format == 'video' ) :
                                                        echo 'ti-control-play';
                                                    elseif( $format == 'audio' ) :
                                                        echo 'ti-headphone';
                                                    elseif( $format == 'link' ) :
                                                        echo 'ti-link';
                                                    elseif( $format == 'quote' ) :
                                                        echo 'ti-quote-left';
                                                    else :
                                                        echo 'icon icon-pencil';
                                                    endif;
                                                ?>"></i>
                                            </div>
                                            <div class="blog-slider-content-details">
                                                <?php gillion_post_categories_position( 'any' ); ?>
                                                <a href="<?php echo get_the_permalink(); ?>">
                                                    <h2 class="post-title"><?php the_title(); ?></h2>
                                                </a>
                                                <div class="post-meta">
                                                    <?php if( isset( $atts['meta'] ) && $atts['meta'] > 0 ) : ?>
                                                        <?php gillion_post_meta( $atts['meta'] ); ?>
                                                    <?php endif; ?>
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


            <?php endif; wp_reset_postdata();


        //var_dump( $atts );
        return ob_get_clean();
    }

}
new vcBlogSlider();
