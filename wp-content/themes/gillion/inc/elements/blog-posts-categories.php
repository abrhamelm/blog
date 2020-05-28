<?php
/*
Element: Blog Posts Categories
*/

class vcBlogPostsCategories extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_posts_categories', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => esc_html__('Blog Posts Categories', 'gillion'),
                'base' => 'vcg_blog_posts_categories',
                'description' => esc_html__('Gillion posts organized by categories', 'gillion'),
                'category' => esc_html__('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'style',
                        'heading' => esc_html__( 'Posts Style', 'gillion' ),
                        'description' => esc_html__( 'Choose slider style', 'gillion' ),
                        'value' => array(
                            esc_html__('Style 1 (grid layout categories posts)', 'gillion') => 'style1',
                            esc_html__('Style 2 (left slide with right posts scrollbar - large titles)', 'gillion') => 'style2',
                            esc_html__('Style 3 (left slide with right posts scrollbar - small titles)', 'gillion') => 'style2 style4',
                            esc_html__('Style 4 (small grid layout categories posts)', 'gillion') => 'style1 sh-categories-style3',
                            esc_html__('Style 5 (grid layout categories posts)', 'gillion') => 'style5',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'image_radious',
                        'heading' => __( 'Posts Image Radius', 'gillion' ),
                        'description' => __( 'Choose small posts image radius', 'gillion' ),
                        'value' => array(
                            esc_html__('8px (standard)', 'gillion') => '8px',
                            esc_html__('100%  (full circle)', 'gillion') => '100%',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        "dependency" => array(
                            "element" => "style",
                            "value" => array( "style2" )
                        )
                    ),

                    array(
                        'param_name' => 'limit',
                        'heading' => esc_html__( 'Posts Limit', 'gillion' ),
                        'description' => esc_html__( 'Choose posts limit', 'gillion' ),
                        'value' => '3',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'categories',
                        'heading' => esc_html__( 'Show Only Specific Categories', 'gillion' ),
                        'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)). By default will get most popular categories', 'gillion' ),
                        'value' => '',
                        'type' => 'exploded_textarea',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'order',
                        'heading' => esc_html__( 'Order', 'gillion' ),
                        'value' => array(
                            esc_html__('Ascending', 'gillion') => 'asc',
                            esc_html__('Descending', 'gillion') => 'desc',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'title',
                        'heading' => esc_html__( 'Title', 'gillion' ),
                        'description' => esc_html__( 'Enter categories title (works for style 2, style 3, style 4)', 'gillion' ),
                        'value' => 'Categories',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array( 'style2', 'style2 style4', 'style1 sh-categories-style3', 'style5' )
                        ),
                        'group' => __( 'Title', 'gillion' ),
                    ),

                    array(
            			'param_name' => 'title_border_color',
            			'type' => 'colorpicker',
            			'heading' => __( 'Title Border Color', 'gillion' ),
                        'description' => __( 'Choose title border color for section title style - line under title', 'gillion' ),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array( 'style2', 'style2 style4', 'style1 sh-categories-style3', 'style5' )
                        ),
                        'group' => __( 'Title', 'gillion' ),
            		),

                    array(
            			'param_name' => 'post_title_hover_color',
            			'type' => 'colorpicker',
            			'heading' => __( 'Post Title Hover Color', 'gillion' ),
                        'description' => __( 'Choose title hover color', 'gillion' ),
                        'group' => __( 'Title', 'gillion' ),
            		),

                ),
            )
        );

    }


    public function _html( $atts ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $atts['style'] = ( isset( $atts['style'] ) ) ? $atts['style'] : 'style1';
        $atts['limit'] = ( isset( $atts['limit'] ) ) ? $atts['limit'] : 3;
        $atts['order'] = ( isset( $atts['order'] ) ) ? $atts['order'] : 'asc';
        $atts['title'] = ( isset( $atts['title'] ) ) ? $atts['title'] : 'Categories';
        $atts['categories'] = ( isset( $atts['categories'] ) ) ? $atts['categories'] : implode( ",", array_slice( get_categories( array( 'fields' => 'id=>name', 'orderby' => 'count', 'order' => 'DESC', 'limit' => $atts['limit'] ) ) , 0, $atts['limit']) );
        $atts['image_radious'] = ( isset( $atts['image_radious'] ) ) ? $atts['image_radious'] : '8px';
        $title_border_color = ( isset( $atts['title_border_color'] ) ) ? $atts['title_border_color'] : '';
        $post_title_hover_color = ( isset( $atts['post_title_hover_color'] ) && $atts['post_title_hover_color'] ) ? $atts['post_title_hover_color'] : '';
        $rand = gillion_rand();
        ob_start();

            $id = 'blog-posts-categories-'.$rand;
            $css_class = array();
            $css_class[] = 'sh-categories';
            $css_class[] = $id;

            if( $atts['image_radious'] == '100%' ) :
                $css_class[] = 'sh-categories-round';
            endif;

            $categories = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : '';
            $categories = explode( ",", $categories );
            if( isset( $atts['order'] ) && $atts['order'] == 'desc' ) :
                $categories = array_reverse( $categories );
            endif;
            ?>

            <?php if( $post_title_hover_color ) : ?>
                <style media="screen">
                    .<?php echo esc_attr( $id ); ?> .post-title:hover {
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

            <?php if( $atts['style'] == 'style2' || $atts['style'] == 'style2 style4' ) : ?>

                <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?> sh-categories-<?php echo esc_attr( $atts['style'] ); ?>">
                    <?php if( count($categories) > 0 ) : ?>

                        <div class="sh-categories-tabs">
                            <div class="sh-categories-title">
                                <h2<?php echo ( $title_border_color ) ? ' style="border-color: '.$title_border_color.';"' : ''; ?>>
                                    <?php echo esc_attr( $atts['title'] ); ?>
                                </h2>
                            </div>
                            <div class="sh-categories-line" style="width: 99%;">
                                <div class="sh-categories-line-container"></div>
                            </div>
                            <div class="sh-categories-names">
                                <!-- Tabs -->
                                <ul class="nav nav-tab sh-tabs-stying sh-heading-font" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#<?php echo 'tab-'. esc_attr($rand) .'-0'; ?>" role="tab" data-toggle="tab">
                                            <?php esc_attr_e( 'All', 'gillion' ); ?>
                                        </a>
                                    </li>
                                    <?php $i = 0;
                                    foreach( $categories as $category ) :
                                        $i++; $id = 'tab-'. esc_attr($rand) .'-'.$i;
                                    ?>
                                        <li role="presentation">
                                            <a href="#<?php echo esc_attr( $id ); ?>" role="tab" data-toggle="tab">
                                                <?php echo esc_attr( $category ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="tab-content">
                            <?php /* All - posts */ ?>
                            <div role="tabpanel" class="tab-pane fade in active" id="<?php echo 'tab-'. esc_attr($rand) .'-0'; ?>">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php
                                            $cat_query = '';
                                            foreach( $categories as $category ) :
                                                $cat_details = term_exists( $category, 'category' );
                                                if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                                                    $cat_query.= $cat_details['term_id'].',';
                                                endif;
                                            endforeach;

                                            $limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6;
                                            $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'cat' => $cat_query ) );

                                            if( $cat_query ) :
                                                if( $posts->have_posts() ) : $j = 0;
                                                    while ( $posts->have_posts() ) : $posts->the_post(); $j++; ?>

                                                        <?php if ( $j == 1 ) :
                                                            set_query_var( 'style', 'cover-large' );
                                                            if( get_post_format() ) :
                                                                get_template_part( 'content', 'format-'.get_post_format() );
                                                            else :
                                                                get_template_part( 'content' );
                                                            endif;
                                                            ?>

                                                            </div>
                                                            <div class="col-md-5 sh-categories-list">
                                                        <?php else :

                                                            gillion_post_mini_layout( 'large' );

                                                        endif; ?>

                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <?php $i = 0;
                            foreach( $categories as $category ) :
                                $i++; $id = 'tab-'. esc_attr($rand) .'-'.$i;
                            ?>
                                <div role="tabpanel" class="tab-pane fade" id="<?php echo esc_attr( $id ); ?>">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <?php
                                                $cat_details = term_exists( $category, 'category' );
                                                if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                                                    $cat_query = 'cat';
                                                    $cat_id = $cat_details['term_id'];
                                                else :
                                                    $cat_query = 'category_name';
                                                    $cat_id = $category;
                                                endif;

                                                $limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6;
                                                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, $cat_query => $cat_id ) );
                                                if( $posts->have_posts() ) : $j = 0;
                                                    while ( $posts->have_posts() ) : $posts->the_post(); $j++;
                                                ?>

                                                    <?php if ( $j == 1 ) :
                                                        set_query_var( 'style', 'cover-large' );
                                                        if( get_post_format() ) :
                                                            get_template_part( 'content', 'format-'.get_post_format() );
                                                        else :
                                                            get_template_part( 'content' );
                                                        endif;
                                                        ?>

                                                        </div>
                                                        <div class="col-md-5 sh-categories-list">
                                                    <?php else :

                                                        gillion_post_mini_layout( 'large' );

                                                    endif; ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php endif; ?>
                </div>

            <?php elseif( $atts['style'] == 'style5' ) :
                $limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6; ?>

                <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?> sh-categories-<?php echo esc_attr( $atts['style'] ); ?>">
                    <?php if( count($categories) > 0 ) : ?>

                        <div class="sh-categories-tabs">
                            <div class="sh-categories-title">
                                <h2<?php echo ( $title_border_color ) ? ' style="border-color: '.$title_border_color.';"' : ''; ?>>
                                    <?php echo esc_attr( $atts['title'] ); ?>
                                </h2>
                            </div>
                            <div class="sh-categories-line" style="width: 99%;">
                                <div class="sh-categories-line-container"></div>
                            </div>
                            <div class="sh-categories-names">
                                <!-- Tabs -->
                                <ul class="nav nav-tab sh-tabs-stying sh-heading-font" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#<?php echo 'tab-'. esc_attr($rand) .'-0'; ?>" role="tab" data-toggle="tab">
                                            <?php esc_attr_e( 'All', 'gillion' ); ?>
                                        </a>
                                    </li>

                                    <?php $i = 0;
                                    foreach( $categories as $category ) :
                                        $i++; $id = 'tab-'. esc_attr($rand) .'-'.$i;
                                    ?>
                                        <li role="presentation">
                                            <a href="#<?php echo esc_attr( $id ); ?>" role="tab" data-toggle="tab">
                                                <?php echo esc_attr( $category ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="tab-content">
                            <?php /* All - posts */ ?>
                            <div role="tabpanel" class="tab-pane fade in active" id="<?php echo 'tab-'. esc_attr($rand) .'-0'; ?>">
                                <div class="row">
                                    <?php
                                        $cat_query = '';
                                        foreach( $categories as $category ) :
                                            $cat_details = term_exists( $category, 'category' );
                                            if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                                                $cat_query.= $cat_details['term_id'].',';
                                            endif;
                                        endforeach;

                                    if( $cat_query ) :
                                        $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'cat' => $cat_query ) );
                                    ?>

                                        <div class="col-md-6 col-sm-6">
                                            <?php if( $posts->have_posts() ) : $j = 0; $l = 0;
                                                while ( $posts->have_posts() ) : $posts->the_post(); $j++;
                                                    if( $j % 2 != 0 ) : $l++;
                                                        if( $l == 1 ) :
                                                            gillion_post_generic_layout();
                                                        else :
                                                            gillion_post_mini_layout( '', 'layout1' );
                                                        endif;
                                                    endif;
                                                endwhile;
                                                wp_reset_postdata();
                                            endif; ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <?php if( $posts->have_posts() ) : $j = 0; $l = 0;
                                                while ( $posts->have_posts() ) : $posts->the_post(); $j++;
                                                    if( $j % 2 == 0 ) : $l++;
                                                        if( $l == 1 ) :
                                                            gillion_post_generic_layout();
                                                        else :
                                                            gillion_post_mini_layout( '', 'layout1' );
                                                        endif;
                                                    endif;
                                                endwhile;
                                                wp_reset_postdata();
                                            endif; ?>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>


                            <?php $i = 0;
                            foreach( $categories as $category ) :
                                $i++; $id = 'tab-'. esc_attr($rand) .'-'.$i;
                            ?>
                                <div role="tabpanel" class="tab-pane fade" id="<?php echo esc_attr( $id ); ?>">
                                    <div class="row">
                                        <?php
                                            $cat_details = term_exists( $category, 'category' );
                                            if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                                                $cat_query = 'cat';
                                                $cat_id = $cat_details['term_id'];
                                            else :
                                                $cat_query = 'category_name';
                                                $cat_id = $category;
                                            endif;

                                            $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, $cat_query => $cat_id ) );
                                        ?>

                                        <div class="col-md-6">
                                            <?php if( $posts->have_posts() ) : $j = 0; $l = 0;
                                                while ( $posts->have_posts() ) : $posts->the_post(); $j++;
                                                    if( $j % 2 != 0 ) : $l++;
                                                        if( $l == 1 ) :
                                                            gillion_post_generic_layout();
                                                        else :
                                                            gillion_post_mini_layout( '', 'layout1' );
                                                        endif;
                                                    endif;
                                                endwhile;
                                                wp_reset_postdata();
                                            endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if( $posts->have_posts() ) : $j = 0; $l = 0;
                                                while ( $posts->have_posts() ) : $posts->the_post(); $j++;
                                                    if( $j % 2 == 0 ) : $l++;
                                                        if( $l == 1 ) :
                                                            gillion_post_generic_layout();
                                                        else :
                                                            gillion_post_mini_layout( '', 'layout1' );
                                                        endif;
                                                    endif;
                                                endwhile;
                                                wp_reset_postdata();
                                            endif; ?>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php endif; ?>
                </div>

            <?php else : ?>

                <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?> sh-categories-<?php echo esc_attr( $atts['style'] ); ?> row">
                    <?php
                    if( count($categories) > 0 ) :
                        $mini_layout = ( $atts['style'] == 'style1' ) ? 'layout1' : 'layout2';
                        set_query_var( 'style', 'cover-small' );
                        set_query_var( 'custom_thumb', 'post-thumbnail' );
                        foreach( $categories as $category ) : ?>

                            <div class="col-md-4 blog-style-cover">
                                <div class="sh-categories-tabs">
                                    <div class="sh-categories-title">
                                        <h2>
                                            <?php echo esc_attr( $category ); ?>
                                        </h2>
                                    </div>
                                    <div class="sh-categories-line" style="width: 99%;">
                                        <div class="sh-categories-line-container"></div>
                                    </div>
                                </div>

                                <?php
                                $cat_details = term_exists( $category, 'category' );
                                if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                                    $cat_query = 'cat';
                                    $cat_id = $cat_details['term_id'];
                                else :
                                    $cat_query = 'category_name';
                                    $cat_id = $category;
                                endif;

                                $limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6;
                                $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, $cat_query => $cat_id ) );
                                if( $posts->have_posts() ) : $i = 0;
                                    while ( $posts->have_posts() ) : $posts->the_post(); $i++;
                                        if( $i == 1 ) :

                                            if( get_post_format() ) :
                                                get_template_part( 'content', 'format-'.get_post_format() );
                                            else :
                                                get_template_part( 'content' );
                                            endif;

                                        else :

                                            gillion_post_mini_layout( '', $mini_layout );

                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                endif; ?>

                            </div>

                        <?php endforeach;
                        set_query_var( 'style', '' );
                    endif;
                    ?>
                </div>

            <?php endif; wp_reset_postdata();


        //var_dump( $atts );
        return ob_get_clean();
    }

}
new vcBlogPostsCategories();
