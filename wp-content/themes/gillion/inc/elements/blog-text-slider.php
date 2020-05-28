<?php
/*
Element: Blog Posts Categories
*/

class vcBlogTextSlider extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_text_slider', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Blog Text Slider', 'gillion'),
                'base' => 'vcg_blog_text_slider',
                'description' => __('Text Slider', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'limit',
                        'heading' => __( 'Posts Limit', 'gillion' ),
                        'description' => __( 'Choose posts limit', 'gillion' ),
                        'value' => '4',
                        'type' => 'textfield',
                    ),

                    array(
                        'param_name' => 'posts',
                        'heading' => __( 'Show Only Specific Posts', 'gillion' ),
                        'description' => __( 'Enter post IDs with comma, like: 1,2,3,4,5', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                    ),

                    array(
                        'param_name' => 'categories',
                        'heading' => __( 'Show Only Specific Categories', 'gillion' ),
                        'description' => __( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'gillion' ),
                        'value' => '',
                        'type' => 'exploded_textarea',
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
                    ),

                    array(
                        'param_name' => 'order',
                        'heading' => __( 'Order', 'gillion' ),
                        'value' => array(
                            __('Ascending', 'gillion') => 'asc',
                            __('Descending', 'gillion') => 'desc',
                        ),
                        'type' => 'dropdown',
                    ),

                    array(
                        'param_name' => 'title',
                        'heading' => __( 'Title', 'gillion' ),
                        'description' => __( 'Enter title', 'gillion' ),
                        'value' => 'Trending Articles',
                        'type' => 'textfield',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'style',
                        'heading' => __( 'Style', 'gillion' ),
                        'value' => array(
                            esc_html__('Style 1', 'gillion') => 'style1',
                            esc_html__('Style 2', 'gillion') => 'style2',
                            esc_html__('Style 3', 'gillion') => 'style3',
                            esc_html__('Style 4', 'gillion') => 'style4',
                            esc_html__('Style 5', 'gillion') => 'style5',
                            esc_html__('Style 6 (with load more button instead of next/prev arrows)', 'gillion') => 'style6',
                        ),
                        'type' => 'dropdown',
                        'group' => __( 'Styling', 'gillion' ),
                        'admin_label' => true,
                    ),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Color', 'gillion' ),
            			'param_name' => 'color',
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'uppercase',
                        'heading' => __( 'Uppercase Post Titles', 'gillion' ),
                        'description' => __( 'Choose to enable or disable uppercase post titles', 'gillion' ),
                        'value' => true,
                        'type' => 'checkbox',
                        'group' => __( 'Styling', 'gillion' ),
                    ),

                ),
            )
        );

    }


    public function _html( $atts ) {

        // Params extraction
        extract( shortcode_atts( array(
            'limit' => '4',
            'posts' => '',
            'categories' => '',
            'order_by' => 'date',
            'order' => 'asc',
            'title' => 'Trending Articles',
            'style' => 'style1',
            'color' => '',
            'uppercase' => false,
        ), $atts ) );

        // HTML
        if( $posts ) :
            $specific_posts = explode(',', $posts ); $i=0;
            foreach( $specific_posts as $specific_post ) {
                $specific_posts[$i] = intval( $specific_post );
                $i++;
            }
        else :
            $specific_posts = array();
        endif;

        $id = 'blog-textslider-'.gillion_rand();
        ob_start(); ?>

            <style media="screen">
                .<?php echo esc_attr( $id ); ?>.blog-textslider-style1 .blog-textslider-title {
                    background-color: <?php echo ( $color ) ? $color : gillion_option('accent_color'); ?>;
                }

                .<?php echo esc_attr( $id ); ?>.blog-textslider-style2 .blog-textslider-title,
                .<?php echo esc_attr( $id ); ?>.blog-textslider-style3 .blog-textslider-title,
                .<?php echo esc_attr( $id ); ?>.blog-textslider-style4 .blog-textslider-title {
                    border-color: <?php echo ( $color ) ? $color : gillion_option('accent_color'); ?>;
                	color: <?php echo ( $color ) ? $color : gillion_option('accent_color'); ?>;
                }
            </style>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    "use strict";
                    if( $.isFunction( $.fn.sh_carousel ) ) {
                        jQuery('.<?php echo $id; ?> .blog-textslider-posts').sh_carousel();
                    }
                });
            </script>
            <div class="blog-textslider <?php echo $id; ?> blog-textslider-<?php echo $style; ?> sh-table">
                <?php if( $title ) : ?>
                    <div class="sh-table-cell">
                        <div class="blog-textslider-title sh-heading-font<?php echo ( $style == 'style5' || $style == 'style6' ) ? ' sh-heading-color sh-heading-weight' : ''; ?>">
                            <?php echo ( $title ); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="sh-table-cell" style="width: 100%;">
                    <div class="blog-textslider-posts">
                        <?php
                        if( count( $specific_posts ) > 0 ) :
                            $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post__in' => $specific_posts, 'orderby' => 'post__in' ) );
                        else :
                            $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $categories, 'orderby' => $order_by, 'order' => $order ) );
                        endif;

                        if( $posts->have_posts() ) : $i=0;
                            while ( $posts->have_posts() ) : $posts->the_post(); $i++; ?>

                                <div class="blog-textslider-post<?php echo ( $uppercase == true) ? ' sh-uppercase' : ''; echo ( $style == 'style5' ) ? ' sh-heading-font' : ''; ?>">
                                    <?php if( $style == 'style5' ) : ?>
                                        <div class="sh-table">
                                            <div class="sh-table-cell">
                                                <div class="blog-textslider-post-thumnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);"></div>
                                            </div>
                                            <div class="sh-table-cell" style="width: 100%;">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-textslider-post-title">
                                                    <?php the_title(); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php elseif(  $style == 'style6' ) : ?>
                                        <div class="sh-table">
                                            <div class="sh-table-cell">
                                                <div class="blog-textslider-post-thumnail" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-micro' ) ); ?>);"></div>
                                            </div>
                                            <div class="sh-table-cell" style="width: 100%;">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-textslider-post-title sh-post-title-font">
                                                    <?php the_title(); ?>
                                                </a>
                                            </div>
                                            <div class="sh-table-cell">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-textslider-post-load-more sh-accent-color-background sh-accent-color-background-hover">
                                                    <?php esc_attr_e( 'Read more', 'gillion' ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                            <?php endwhile;
                        endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        <?php
        return ob_get_clean();
    }

}
new vcBlogTextSlider();
