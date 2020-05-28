<?php
/*
Element: Blog Slider
*/

class vcBlogPostsFancy extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_posts_fancy', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Blog Posts', 'gillion'),
                'base' => 'vcg_blog_posts_fancy',
                'description' => __('Gillion blog posts', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'style',
                        'heading' => __( 'Posts Style', 'gillion' ),
                        'description' => __( 'Choose posts style', 'gillion' ),
                        'value' => array(
                            'Cover' => 'cover',
                            'Cover Big' => 'coverbig',
                            'Mini 1' => 'mini1',
                            'Mini 2' => 'mini2',
                            'Fancy 1' => 'fancy1',
                            'Fancy 2' => 'fancy2',
                            'Fancy 3' => 'fancy3',
                            'Round Simple' => 'round',
                            'Card Style' => 'card',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'columns',
                        'heading' => __( 'Posts Columns', 'gillion' ),
                        'description' => __( 'Choose post column count', 'gillion' ),
                        'value' => array(
                            esc_html__('Columns 3', 'gillion') => 'columns3',
                            esc_html__('Columns 2', 'gillion') => 'columns2',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "cover" )
                        )
                    ),

                    array(
                        'param_name' => 'columns2',
                        'heading' => __( 'Posts Columns', 'gillion' ),
                        'description' => __( 'Choose post column count', 'gillion' ),
                        'value' => array(
                            esc_html__('Columns 4', 'gillion') => 'columns4',
                            esc_html__('Columns 3', 'gillion') => 'columns3',
                            esc_html__('Columns 2', 'gillion') => 'columns2',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "mini1" )
                        )
                    ),

                    array(
                        'param_name' => 'columns3',
                        'heading' => __( 'Posts Columns', 'gillion' ),
                        'description' => __( 'Choose post column count', 'gillion' ),
                        'value' => array(
                            esc_html__('Columns 4', 'gillion') => 'columns4',
                            esc_html__('Columns 3', 'gillion') => 'columns3',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "mini2" )
                        )
                    ),

                    array(
                        'param_name' => 'alignment',
                        'heading' => __( 'Posts Content Alignment', 'gillion' ),
                        'description' => __( 'Choose posts content alignment (works for some of the post styles)', 'gillion' ),
                        'value' => array(
                            esc_html__('Left', 'gillion') => 'left',
                            esc_html__('Center', 'gillion') => 'center',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "cover", "coverbig" )
                        )
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
                        'param_name' => 'offset',
                        'heading' => __( 'Posts Offset', 'gillion' ),
                        'description' => __( 'Enter posts offset number (will be disabled when using specific posts only)', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'posts',
                        'heading' => __( 'Show Only Specific Posts', 'gillion' ),
                        'description' => __( 'Enter post IDs with comma, like: 1,2,3,4,5', 'gillion' ),
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

                    array(
                        'param_name' => 'order_by',
                        'heading' => __( 'Order By', 'gillion' ),
                        'value' => array(
                            esc_html__('Date', 'gillion') => 'date',
                            esc_html__('Name', 'gillion') => 'name',
                            esc_html__('Author', 'gillion') => 'author',
                            esc_html__('Random', 'gillion') => 'rand',
                            esc_html__('Comment Count', 'gillion') => 'comment_count',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'order',
                        'heading' => __( 'Order', 'gillion' ),
                        'value' => array(
                            esc_html__('Descending', 'gillion') => 'desc',
                            esc_html__('Ascending', 'gillion') => 'asc',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'std' => 'desc',
                    ),

                    array(
                        'param_name' => 'carousel',
                        'heading' => __( 'Carousel', 'gillion' ),
                        'value' => array(
                            esc_html__('Disabled', 'gillion') => 'disabled',
                            esc_html__('Enabled with arrows in sides', 'gillion') => 'sides',
                            esc_html__('Enabled with arrows in title', 'gillion') => 'title',
                            esc_html__('Enabled without arrows', 'gillion') => 'withoutarrows',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "cover", "coverbig", "mini1", "mini2" )
                        ),
                        'group' => __( 'Carousel', 'gillion' ),
                    ),

                    array(
                        'param_name' => 'autoplay',
                        'heading' => __( 'Autoplay', 'gillion' ),
                        'description' => __( 'Choose to enable or disable slider autoplay (if slider is enabled)', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'class' => '',
                        'group' => __( 'Carousel', 'gillion' ),
                        "dependency" => array(
                            "element" => "carousel",
                            "value" => array( "sides", "title", "withoutarrows" )
                        ),
                    ),

                    array(
                        'param_name' => 'autoplay_speed',
                        'heading' => __( 'Autoplay Speed (s)', 'gillion' ),
                        'description' => __( 'Choose autoplay speed (1-10 seconds interval)', 'gillion' ),
                        'value' => '6',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'group' => __( 'Carousel', 'gillion' ),
                        "dependency" => array(
                            "element" => "carousel",
                            "value" => array( "sides", "title", "withoutarrows" )
                        ),
                    ),

                    array(
                        'param_name' => 'title',
                        'heading' => __( 'Title', 'gillion' ),
                        'description' => __( 'Enter title', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'group' => __( 'Title', 'gillion' ),
                    ),

                    array(
            			'param_name' => 'title_border_color',
            			'type' => 'colorpicker',
            			'heading' => __( 'Title Border Color', 'gillion' ),
                        'description' => __( 'Choose title border color for section title style - line under title', 'gillion' ),
                        'value' => '',
                        'group' => __( 'Title', 'gillion' ),
            		),

                    array(
            			'param_name' => 'post_title_hover_color',
            			'type' => 'colorpicker',
            			'heading' => __( 'Post Title Hover Color', 'gillion' ),
                        'description' => __( 'Choose title hover color', 'gillion' ),
                        'group' => __( 'Title', 'gillion' ),
            		),

                    array(
                        'param_name' => 'disable_categories',
                        'heading' => __( 'Disable Categories', 'gillion' ),
                        'description' => __( 'Check to disable categories', 'gillion' ),
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

        $title_border_color = ( isset( $atts['title_border_color'] ) ) ? $atts['title_border_color'] : '';
        $post_title_hover_color = ( isset( $atts['post_title_hover_color'] ) && $atts['post_title_hover_color'] ) ? $atts['post_title_hover_color'] : '';
        $atts['style'] = ( isset( $atts['style'] ) ) ? $atts['style'] : 'cover';
        $atts['limit'] = ( isset( $atts['limit'] ) ) ? $atts['limit'] : 3;
        $atts['categories'] = ( isset( $atts['categories'] ) ) ? $atts['categories'] : array();
        $atts['title'] = ( isset( $atts['title'] ) ) ? $atts['title'] : '';
        $atts['posts'] = ( isset( $atts['posts'] ) ) ? $atts['posts'] : '';
        $atts['alignment'] = ( isset( $atts['alignment'] ) ) ? $atts['alignment'] : '';
        $atts['autoplay'] = ( isset( $atts['autoplay'] ) ) ? $atts['autoplay'] : true;
        $atts['autoplay_speed'] = ( isset( $atts['autoplay_speed'] ) ) ? $atts['autoplay_speed'] : 6;
        $offset = ( isset( $atts['offset'] ) ) ? intval( $atts['offset'] ) : 0;
        $disable_categories = ( isset( $atts['disable_categories'] ) && $atts['disable_categories'] ) ? $atts['disable_categories'] : false;

        if( $atts['style'] == 'cover' ) :
            $atts['columns'] = ( isset( $atts['columns'] ) ) ? $atts['columns'] : 'columns3';
        elseif( $atts['style'] == 'mini1' ) :
            $atts['columns2'] = ( isset( $atts['columns2'] ) ) ? $atts['columns2'] : 'columns4';
        elseif( $atts['style'] == 'mini2' ) :
            $atts['columns3'] = ( isset( $atts['columns3'] ) ) ? $atts['columns3'] : 'columns4';
        endif;
        ob_start();

            $id = 'blog-posts-fancy-'.gillion_rand();
            $css_class = array();
            $css_class[] = $id;
            $css_class[] = 'sh-blog-fancy';
            $style = ( isset( $atts['style'] ) ) ? $atts['style'] : 'cover';
            $elements = gillion_option( 'post_elements' );
            $autoplay = ( isset( $atts['autoplay'] ) && $atts['autoplay'] == 'off' ) ? 'false' : 'true';
            $autoplay_speed = ( isset( $atts['autoplay_speed'] ) && ( $atts['autoplay_speed'] >= 1 && $atts['autoplay_speed'] <= 10 ) ) ? ( $atts['autoplay_speed'] * 1000 ) : 6000;
            $position = gillion_option( 'global_carousel_buttons_position', 'title' );

            /* Limit Posts */
            if( isset( $atts['posts'] ) && $atts['posts'] ) :
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
            if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' || $atts['carousel'] == 'withoutarrows' ) ) :
                if( $atts['carousel'] == 'sides' || $atts['carousel'] == 'withoutarrows' ) :
                    $class[] = 'blog-fancy-carousel-sides slider-arrows-sides';
                elseif( $atts['carousel'] == 'title' ) :
                    $class[] = 'blog-fancy-carousel-title slider-arrows-sides';
                endif;
                $carousel_columns = str_replace("columns","", $columns );
            else :
                $class[] = 'blog-fancy-carousel-disabled';
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
            $class[] = ( $disable_categories ) ? 'blog-posts-disable-carousel' : '';


            /* Alignment */
            if( $style == 'cover' || $style == 'coverbig' ) :
                if( isset( $atts['alignment'] ) && $atts['alignment'] == 'center' ) :
                    $class[] = 'blog-style-cover-center';
                endif;
            endif;
            ?>

            <?php if( $post_title_hover_color ) : ?>
                <style media="screen">
                    .<?php echo esc_attr( $id ); ?> .post-title :hover,
                    .<?php echo esc_attr( $id ); ?> .post-title :hover * {
                        color: <?php echo esc_attr( $post_title_hover_color ); ?>
                    }

                    .<?php echo esc_attr( $id ); ?> .post-thumbnail .post-categories a:hover,
                    .<?php echo esc_attr( $id ); ?> .post-gallery .post-categories a:hover,
                    .<?php echo esc_attr( $id ); ?> .blog-slider-item .post-categories a:hover,
                    .<?php echo esc_attr( $id ); ?> .post-style-cover .post-categories a:hover,
                    .sh-post-categories-style2 .<?php echo esc_attr( $id ); ?> .post-format-icon:hover {
                        background-color: <?php echo esc_attr( $post_title_hover_color ); ?>
                    }
                </style>
            <?php endif; ?>

            <?php if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' || $atts['carousel'] == 'withoutarrows' ) ) : ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    "use strict";

                    if( $.isFunction( $.fn.slick ) ) {
                        <?php if( $atts['carousel'] == 'sides' || $atts['carousel'] == 'withoutarrows' ) : ?>
                            $('.<?php echo esc_attr($id); ?> .blog-fancy-carousel-sides').not('.slick-initialized').slick({
                                autoplay: <?php echo esc_js( $autoplay ); ?>,
                                autoplaySpeed: <?php echo esc_js( $autoplay_speed ); ?>,
                                dots: false,
                                arrows: <?php echo ( $atts['carousel'] == 'sides' ) ? 'true' : 'false'; ?>,
                                infinite: true,
                                speed: 300,
                                slidesToShow: <?php echo intval($carousel_columns); ?>,
                                slidesToScroll: 1,
                                swipeToSlide: 1,
                                adaptiveHeight: true,
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
                                <?php if( $atts['carousel'] == 'sides' ) : ?>
                                    prevArrow: '<button type="button" class="slick-prev"><i class="icon icon-arrow-left-circle"></i></button>',
                                    nextArrow: '<button type="button" class="slick-next"><i class="icon icon-arrow-right-circle"></i></button>',
                                <?php endif; ?>
                            });
                        <?php else : ?>
                            $('.<?php echo esc_attr($id); ?> .blog-fancy-carousel-title').not('.slick-initialized').each( function() {
                                var fancy_carousel_columns = parseInt( $(this).attr('data-columns') );
                                var fancy_carousel_slider = $(this);
                                $(this).slick({
                                    autoplay: <?php echo esc_js( $autoplay ); ?>,
                                    autoplaySpeed: <?php echo esc_js( $autoplay_speed ); ?>,
                                    dots: false,
                                    arrows: true,
                                    infinite: false,
                                    speed: 1100,
                                    slidesToShow: <?php echo intval($carousel_columns); ?>,
                                    slidesToScroll: 1,
                                    swipeToSlide: 1,
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
                    }

                });
            </script>
            <?php endif; ?>


            <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
                <?php if( isset($atts['title']) && $atts['title'] ) : ?>
                    <?php if( isset( $atts['carousel'] ) && ( $atts['carousel'] == 'sides' || $atts['carousel'] == 'title' ) ) :
                        $title_class = ( $atts['carousel'] == 'sides' ) ? ' sh-blog-fancy-title-container-sides' : '';
                    ?>
                        <div class="sh-blog-fancy-title-container<?php echo esc_attr( $title_class ); ?>">
                            <h2 class="sh-blog-fancy-title"<?php echo ( $title_border_color ) ? ' style="border-color: '.$title_border_color.';"' : ''; ?>>
                                <?php echo esc_attr( $atts['title'] ); ?>
                            </h2>
                            <?php if( $position == 'title' ) : ?>
                                <div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="sh-blog-fancy-title-container">
                            <h2 class="sh-blog-fancy-title">
                                <?php echo esc_attr( $atts['title'] ); ?>
                            </h2>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="<?php echo esc_attr( implode( " ", $class ) ); ?>">
                    <?php
                        set_query_var( 'style', $set_style );

                        $limit = ( isset( $atts['limit'] ) && is_numeric($atts['limit']) ) ? intval( $atts['limit'] ) : 6;
                        if( $style_class == 'fancy1' && $limit > 3 ) : $limit = 3; endif;
                        if( $style_class == 'fancy2' && $limit > 5 ) : $limit = 5; endif;
                        if( $style_class == 'fancy3' && $limit > 3 ) : $limit = 3; endif;
                        $categories_query = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : array();
                        $orderby = ( isset($atts['order_by']) && $atts['order_by'] ) ? esc_attr( $atts['order_by'] ) : 'post_date';
                        $order = ( isset($atts['order']) && $atts['order'] ) ? esc_attr( $atts['order'] ) : 'desc';

                        if( count( $specific_posts ) > 0 ) :
                            $posts = new WP_Query( array(
                                'post_type' => 'post',
                                'posts_per_page' => $limit,
                                'post__in' => $specific_posts,
                                'orderby' => 'post__in'
                            ));
                        else :
                            $posts = new WP_Query( array(
                                'post_type' => 'post',
                                'posts_per_page' => $limit,
                                'offset' => $offset,
                                'category_name' => $categories_query,
                                'orderby' => $orderby,
                                'order' => $order
                            ));
                        endif;

                        if( $posts->have_posts() ) : $i=0;
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


                                    <?php /* Create post structure */ if( $i == 1 ) : set_query_var( 'style', 'grid' ); ?>
                                        <div class="row">
                                            <div class="col-md-6 blog-style-left">

                                    <?php else : set_query_var( 'style', 'cover-small' ); ?>
                                    <?php endif; ?>

                                            <?php /* Load post data */
                                                if( get_post_format() ) :
                                                    get_template_part( 'content', 'format-'.get_post_format() );
                                                else :
                                                    get_template_part( 'content' );
                                                endif;
                                            ?>

                                        <?php if( $i == 1 ) : /* Create custom post data structure */ ?>

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
                                        if( $i == 3 ) : set_query_var( 'style', 'grid' );
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

                                <?php elseif( $style_class == 'round' ) : ?>

                                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                                		<div class="post-container">
                                            <div class="sh-ratio">
                    							<div class="sh-ratio-container post-thumbnail">
                    								<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square' ) ); ?>);">
                                                        <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                    								</div>
                                                </div>
                                				<?php echo gillion_post_review( get_the_ID() ); ?>
                    						</div>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
                                                <h4><?php echo get_the_title(); ?></h4>
                                            </a>
                                        </div>
                                    </article>

                                <?php elseif( $style_class == 'card' ) :
                                    set_query_var( 'style', 'card' ); ?>

                                    <?php
                                        if( get_post_format() ) :
                                            get_template_part( 'content', 'format-'.get_post_format() );
                                        else :
                                            get_template_part( 'content' );
                                        endif;
                                    ?>

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
                <?php if( $position == 'bottom' ) : ?>
                    <div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
                <?php endif; ?>
            </div>





        <?php  wp_reset_postdata();
        return ob_get_clean();
    }

}
new vcBlogPostsFancy();
