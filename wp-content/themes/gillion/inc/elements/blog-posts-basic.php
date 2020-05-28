<?php
/*
Element: Blog Posts
*/

class vcBlogPosts extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_posts', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Blog Posts Basic', 'gillion'),
                'base' => 'vcg_blog_posts',
                'description' => __('Gillion basic blog posts', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'style',
                        'heading' => __( 'Posts Style', 'gillion' ),
                        'description' => __( 'Choose posts style', 'gillion' ),
                        'value' => array(
                            esc_html__( 'Grid', 'gillion' ) => 'grid',
                            esc_html__( 'Masonry', 'gillion' ) => 'masonry',
                            esc_html__( 'Masonry Card', 'gillion' ) => 'masonry blog-style-masonry-card',
                            esc_html__( 'Left', 'gillion' ) => 'left-small',
                            esc_html__( 'Left (mini)', 'gillion' ) => 'left-mini',
                            esc_html__( 'Left (large)', 'gillion' ) => 'left',
							esc_html__( 'Left/Right Mix', 'gillion' ) => 'left-right',
							esc_html__( 'Left/Right Mix (small without description)', 'gillion' ) => 'left-right blog-style-left-right-small',
							esc_html__( 'Left/Right Mix (large)', 'gillion' ) => 'left-right blog-style-left-right-large',
                            esc_html__( 'Large (title at the top)', 'gillion' ) => 'large',
							esc_html__( 'Large (title bellow the image)', 'gillion' ) => 'large large-title-bellow',
							esc_html__( 'Large (centered)', 'gillion' ) => 'large large-centered',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'columns',
                        'heading' => __( 'Posts Columns', 'gillion' ),
                        'value' => array(
                            esc_html__('2 Columns', 'gillion') => '2',
                            esc_html__('3 Columns', 'gillion') => '3',
                            esc_html__('4 Columns', 'gillion') => '4',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'limit',
                        'heading' => __( 'Posts Limit', 'gillion' ),
                        'description' => __( 'Choose posts limit', 'gillion' ),
                        'value' => '2',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'offset',
                        'heading' => __( 'Posts Offset', 'gillion' ),
                        'description' => __( 'Enter posts offset number (will be disabled if specific posts will be entered)', 'gillion' ),
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
                        'param_name' => 'order2',
                        'heading' => __( 'Order', 'gillion' ),
                        'value' => array(
                            __('Descending', 'gillion') => 'DESC',
                            __('Ascending', 'gillion') => 'ASC',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'std' => 'desc',
                    ),
                    array(
                        'param_name' => 'pagination',
                        'heading' => __( 'Load More', 'gillion' ),
                        'description' => __( 'Enable or disable load more button. Notice: It will disable categories, specific posts and order options when enabled', 'gillion' ),
                        'value' => array(
                            esc_html__('Disabled', 'gillion') => 'disabled',
                            esc_html__('Enabled', 'gillion') => 'load_more',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'group' => __( 'Load More', 'gillion' ),
                    ),

                    array(
                        'param_name' => 'title',
                        'heading' => __( 'Title', 'gillion' ),
                        'description' => __( 'Enter blog posts title', 'gillion' ),
                        'value' => 'Blog Posts',
                        'type' => 'textfield',
                        'holder' => 'div',
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
                        'param_name' => 'lines',
                        'heading' => __( 'Hide Post Seperators', 'gillion' ),
                        'description' => __( 'Choose to enable or disable post seperator lines', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'group' => __( 'Styling', 'gillion' ),
                    ),

                    array(
                        'param_name' => 'page_blog_description',
                        'heading' => __( 'Blog Posts Description', 'gillion' ),
                        'value' => array(
                            esc_html__('Default', 'gillion') => 'default',
                            esc_html__('Off', 'gillion') => 'off',
                        ),
                        'std' => 'default',
                        'type' => 'dropdown',
                        'group' => __( 'Styling', 'gillion' ),
                    ),

                ),
            )
        );

    }


    public function _html( $atts ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $title_border_color = ( isset( $atts['title_border_color'] ) ) ? $atts['title_border_color'] : '';
        $post_title_hover_color = ( isset( $atts['post_title_hover_color'] ) && $atts['post_title_hover_color'] ) ? $atts['post_title_hover_color'] : '';
        $pagination = ( isset( $atts['pagination'] ) ) ? $atts['pagination'] : 'disabled';
        $atts['posts'] = ( isset( $atts['posts'] ) ) ? $atts['posts'] : '';
        $style = ( isset( $atts['style'] ) ) ? $atts['style'] : 'grid';
        $atts['columns'] = ( isset( $atts['columns'] ) ) ? $atts['columns'] : '2';
        $limit = ( isset( $atts['limit'] ) ) ? $atts['limit'] : 2;
        $atts['dots'] = ( isset( $atts['dots'] ) ) ? $atts['dots'] : true;
        $atts['categories'] = ( isset( $atts['categories'] ) ) ? $atts['categories'] : '';
        $atts['lines'] = ( isset( $atts['lines'] ) ) ? $atts['lines'] : false;
        $atts['title'] = ( isset( $atts['title'] ) ) ? $atts['title'] : 'Blog Posts';
        $offset = ( isset( $atts['offset'] ) ) ? intval( $atts['offset'] ) : 0;
        $order  = ( isset( $atts['order2'] ) ) ? $atts['order2'] : 'desc';
        $order_by = ( isset( $atts['order_by'] ) ) ? $atts['order_by'] : 'date';
        $page_blog_description = ( isset( $atts['page_blog_description'] ) ) ? $atts['page_blog_description'] : 'default';
        $categories_ids = [];


        $rand = gillion_rand();
        ob_start();

            if( $style != 'grid' ) :
                $atts['columns'] = '';
            endif;

            if( $atts['posts'] ) :
                $specific_posts = explode(',', $atts['posts']); $i=0;
                foreach( $specific_posts as $specific_post ) {
                    $specific_posts[$i] = intval( $specific_post );
                    $i++;
                }
            else :
                $specific_posts = array();
            endif;

            $id = 'blog-posts-'.esc_attr( $rand );
            $class = array();
            $class[] = 'sh-blog-standard-posts';
            $class[] = $id;

            $class2 = array();
            $class2[] = 'sh-group';
            $class2[] = 'blog-list';
            $class2[] = 'blog-style-'.$style;
            $class2[] = 'blog-style-'.$style.'-element';
            $class2[] = ( $atts['columns'] > 0 ) ? 'blog-style-columns'.$atts['columns'] : '';
            $class2[] = ( $atts['lines'] == true ) ? 'blog-dividing-line-off' : '';
            $class2[] = ( $page_blog_description == 'off' ) ? 'sh-posts-description-off' : '';


            if( $pagination == 'load_more' ) :
                $posts = new WP_Query( array(
                    'post_type' => 'post',
                    'category_name' => $atts['categories'],
                    'posts_per_page' => $limit,
                    'offset' => $offset,
                    'post_status' => 'publish',
                ));

                // Get categories IDs
                $categories = explode( ',', $atts['categories'].',aaa' );
                if( is_array( $categories ) ) :
                    foreach( $categories  as $cat ) :

                        $category_data = get_term_by( 'name', trim( $cat ), 'category' );
                        if( isset( $category_data->term_id ) && $category_data->term_id > 0 ) :
                            $categories_ids[] = $category_data->term_id;
                        else :

                            $category_data = get_term_by( 'slug', trim( $cat ), 'category' );
                            if( isset( $category_data->term_id ) && $category_data->term_id > 0 ) :
                                $categories_ids[] = $category_data->term_id;
                            endif;

                        endif;

                    endforeach;
                endif;
            elseif( count( $specific_posts ) > 0 ) :
                $posts = new WP_Query( array(
                    'post_type' => 'post',
                    'post__in' => $specific_posts,
                    'posts_per_page' => $limit,
                    'order' => $order,
                    'orderby' => $order_by,
                    'post_status' => 'publish',
                ));
            else :
                $posts = new WP_Query( array(
                    'post_type' => 'post',
                    'category_name' => $atts['categories'],
                    'posts_per_page' => $limit,
                    'offset' => $offset,
                    'order' => $order,
                    'orderby' => $order_by,
                    'post_status' => 'publish',
                ));
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

            <?php if( isset($atts['title']) && $atts['title'] ) : ?>
                <div class="sh-blog-fancy-title-container sh-blog-fancy-title-container-sides">
                    <h2 class="sh-blog-fancy-title"<?php echo ( $title_border_color ) ? ' style="border-color: '.$title_border_color.';"' : ''; ?>>
                        <?php echo esc_attr( $atts['title'] ); ?>
                    </h2>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr( implode( " ", $class ) ); ?>">
                <div class="<?php echo esc_attr( implode( " ", $class2 ) ); ?>">
                    <?php
                        if( $posts->have_posts() ) :
                            set_query_var( 'style', $style );
                            while ( $posts->have_posts() ) : $posts->the_post();

                                if( get_post_format() ) :
                                    get_template_part( 'content', 'format-'.get_post_format() );
                                else :
                                    get_template_part( 'content' );
                                endif;

                            endwhile;
                        else :

                            get_template_part( 'content', 'none' );

                        endif;
                    ?>
                </div>

                <?php if( $pagination == 'load_more' ) : ?>
                    <div class="sh-load-more"
    				data-categories="<?php echo esc_attr( implode( ',', $categories_ids ) ); ?>"
    				data-post-style="<?php echo esc_attr( $style ); ?>"
    				data-posts-per-page="<?php echo esc_attr( $limit ); ?>"
    				data-paged="2"
                    data-offset="<?php echo esc_attr( $offset ); ?>"
                    data-id="<?php echo esc_attr( $id ); ?>">
    					<?php esc_html_e( 'Load more', 'gillion' ); ?>
    				</div>
                <?php endif; ?>

            </div>

        <?php  wp_reset_postdata();
        return ob_get_clean();
    }

}
new vcBlogPosts();
