<?php
/**
 * Load VC Elements
 */
if( defined( 'WPB_VC_VERSION' ) ) :
    add_action( 'vc_before_init', 'gillion_vc_before_init_actions' );
    function gillion_vc_before_init_actions() {
        require_once( get_template_directory().'/inc/elements/blog-slider.php' );
        require_once( get_template_directory().'/inc/elements/blog-posts.php' );
        require_once( get_template_directory().'/inc/elements/blog-posts-basic.php' );
        require_once( get_template_directory().'/inc/elements/blog-posts-categories.php' );
        require_once( get_template_directory().'/inc/elements/blog-categories.php' );
        require_once( get_template_directory().'/inc/elements/blog-text-slider.php' );
        require_once( get_template_directory().'/inc/elements/text-block.php' );
        require_once( get_template_directory().'/inc/elements/heading.php' );
        require_once( get_template_directory().'/inc/elements/empty-space.php' );
        require_once( get_template_directory().'/inc/elements/text-separator.php' );
        require_once( get_template_directory().'/inc/elements/button.php' );
        require_once( get_template_directory().'/inc/elements/list.php' );
        require_once( get_template_directory().'/inc/elements/icon.php' );
        require_once( get_template_directory().'/inc/elements/seperator.php' );
        require_once( get_template_directory().'/inc/elements/single-image.php' );
        require_once( get_template_directory().'/inc/elements/image-gallery.php' );
        require_once( get_template_directory().'/inc/elements/image-container.php' );
        require_once( get_template_directory().'/inc/elements/social-networks.php' );
        require_once( get_template_directory().'/inc/elements/footer-widgets.php' );
        require_once( get_template_directory().'/inc/elements/footer-widgets-title.php' );
        require_once( get_template_directory().'/inc/elements/author.php' );

        require_once( get_template_directory().'/inc/elements/single-comments.php' );
        require_once( get_template_directory().'/inc/elements/single-content.php' );
        require_once( get_template_directory().'/inc/elements/single-post-media.php' );
        require_once( get_template_directory().'/inc/elements/single-post-meta.php' );
        require_once( get_template_directory().'/inc/elements/single-title.php' );


        /* WooCommerce Elements */
        if ( class_exists( 'woocommerce' ) ) :
            require_once( get_template_directory().'/inc/elements/woocommerce-products.php' );
            require_once( get_template_directory().'/inc/elements/woocommerce-categories.php' );
            require_once( get_template_directory().'/inc/elements/woocommerce-spotlight.php' );
        endif;
    }
endif;


/**
 * Supported Post Types
 */
$list = array(
    'page',
    'posts',
    'shufflehound_footer',
);
vc_set_default_editor_post_types( $list );


/**
 * Custom Dir
 */
if( function_exists( 'vc_set_shortcodes_templates_dir' ) ) :
    $dir = get_template_directory() . '/inc/elements/standard';
    vc_set_shortcodes_templates_dir( $dir );
endif;


/**
 * Add new tab
 */
add_filter( 'vc_get_all_templates', 'gillion_add_template_tab' );
function gillion_add_template_tab( $data ) {

    $sh_templates = gillion_get_templates();
    $category_templates = array();
    foreach ( $sh_templates as $template_id => $template_data ) {
        $category_templates[] = array(
            'unique_id' => $template_id,
            'name' => $template_data['name'],
            'type' => 'sh_templates',
            'image' => isset( $template_data['image_path'] ) ? $template_data['image_path'] : false,
            'custom_class' => isset( $template_data['custom_class'] ) ? $template_data['custom_class'] : false,
            'category' => isset( $template_data['category'] ) ? $template_data['category'] : false,
        );
    }

    $newCategory = array(
        'category'        => 'sh_templates',
        'category_name'   => esc_html__( 'Gillion Templates', 'gillion' ),
        'category_weight' => 1,
        'templates'       => $category_templates,
    );
    $data[] = $newCategory;

    return $data;
}


/**
 * Add new content
 */
add_filter( 'vc_templates_render_category', 'gillion_add_template_content' );
function gillion_add_template_content( $category ) {

    if ( 'sh_templates' === $category['category'] ) :
        $templates = gillion_get_templates();
        $output = ''; $i = 0;
        $categories = array(
            'all'         => esc_html__( 'All', 'gillion' ),
            'sliders'     => esc_html__( 'Sliders', 'gillion'),
            'posts'       => esc_html__( 'Posts', 'gillion' ),
            'basicposts'  => esc_html__( 'Basic Posts', 'gillion' ),
            'categories'  => esc_html__( 'Categories', 'gillion' ),
            'textslider'  => esc_html__( 'Text Slider', 'gillion' ),
            'subscribe'   => esc_html__( 'Subscribe', 'gillion' ),
            'whitespaces' => esc_html__( 'Whitespaces', 'gillion' ),
        );


        $output .= '<div class="sortable_templates"><ul>';
        foreach( $categories as $key => $value ) : $i++;
            $active = ( $i == 1 ) ? 'class="active"' : '';

            $count = 0;
            if( $key == 'all' ) :
                foreach( $templates as $template ) :
                    $count++;
                endforeach;
            else :
                foreach( $templates as $template ) :
                    if( strtolower( $template['category'] ) == $key ) :
                        $count++;
                    endif;
                endforeach;
            endif;
            $output .= '<li '.$active.' data-sort="'.$key.'">'.$value.' <span class="count">'.$count.'</span></li>';
        endforeach;
        $output .= '</ul></div>';


        $category['output'] = '
        <div id="sh-templates-content">
            <div class="sh-categories-container vc_column vc_col-md-2">
                '.$output.'
                <div class="sh-categories-notice">* Slider and posts preview images are just examples of layouts, no new posts will be added</div>
            </div>
            <div class="sh-templates-container vc_column vc_col-md-10">
                <div class="vc_ui-template-list vc_templates-list-default_templates vc_ui-list-bar">';
                    if ( ! empty( $category['templates'] ) ) {
                        foreach ( $category['templates'] as $template ) {
                            $category['output'] .= gillion_get_template_item( $template );
                        }
                    }
                    $category['output'] .= '
                </div>
            </div>
        </div>';
    endif;

    return $category;
}


/**
 * Add new item
 */
function gillion_get_template_item( $template ) {
	$name = ( isset( $template['name'] ) ) ? esc_html( $template['name'] ) : esc_html( __( 'Error loading title', 'gillion' ) );
	$template_id = esc_attr( $template['unique_id'] );
	$template_id_hash = md5( $template_id );
    $template_type = ( isset( $template['type'] ) ) ? $template['type'] : 'custom';
	$template_name = esc_html( substr( $name, 3 ) );
	$template_name_lower = esc_attr( vc_slugify( $template_name ) );
	$template_sort_name = esc_attr( isset( $template['category'] ) ? $template['category'] : '' );
	$template_class = esc_attr( vc_slugify( $template_sort_name ) );
    $template_alt = esc_attr( 'Add this template', 'gillion' );
    $image_ext = ( $template_class == 'categories' || $template_class == 'subscribe' ) ? 'jpg' : 'png';

	$output = '
	<div class="sh-template vc_ui-template vc_templates-template-type-default_templates '.$template_class.'"
		data-template_id="'.$template_id.'"
		data-template_id_hash="'.$template_id_hash.'"
		data-category="'.$template_type.'"
		data-template_unique_id="'.$template_id.'"
		data-template_name="'.$template_name_lower.'"
		data-template_type="default_templates"
		data-vc-content=".vc_ui-template-content">
		<div class="sh-template-container vc_ui-list-bar-item">

            <div class="sh-template-preview">
                <div class="sh-ratio">
                    <div class="sh-ratio-container">
                        <div class="sh-ratio-content" style="background-image: url(' . esc_url( get_template_directory_uri().'/img/templates/'.$template_class.'/'.$template_name.'.'.$image_ext ) . ');"></div>
                    </div>
                </div>
            </div>

            <div class="sh-template-information">
        		<button type="button" class="sh-template-title vc_ui-list-bar-item-trigger sh-heading-font" title="'.$template_alt.'" data-template-handler="" data-vc-ui-element="template-title">
                    '.$template_name.'
                </button>
                <span class="sh-template-categories">' . esc_html( $template_sort_name ) . '</span>
            </div>

            <div class="vc_ui-list-bar-item-actions">
                <button type="button" class="sh-template-add vc_general vc_ui-control-button" title="'.$template_alt.'" data-template-handler="">
                    <i class="vc-composer-icon vc-c-icon-add"></i>
                </button>
            </div>

            <div class="sh-template-loading">
                <div class="loader-item">
                    <div class="loader loader-8"></div>
                </div>
            </div>

		</div>
		<div class="vc_ui-template-content" data-js-content></div>
	</div>';


	return $output;
}


/**
 * Recet templates
 */
add_filter( 'vc_load_default_templates', 'gillion_reset_templates' );
function gillion_reset_templates( $data ) {
    return array();
}


/**
 * Add templates
 */
function gillion_add_templates() {
	$templates = gillion_get_templates();
    foreach( $templates as $key => $template ) :
        $templates[$key]['disabled'] = 1;
    endforeach;

	return array_map( 'vc_add_default_templates', $templates );
}
gillion_add_templates();


/**
 * Get templates
 */
function gillion_get_templates(){

    /* Example Slider Posts */
    $slider_post1 = get_post_type( 57 );
    $slider_post2 = get_post_type( 406 );
    $slider_post3 = get_post_type( 81 );
    $slider_post4 = get_post_type( 85 );
    $slider_posts = ( $slider_post1 == 'post' && $slider_post2 == 'post' && $slider_post3 == 'post' && $slider_post4 == 'post' ) ? ' posts="57,406,81,85"' : '';


    /* Example Container Posts */
    $container_post1 = get_post_type( 81 );
    $container_post2 = get_post_type( 59 );
    $container_post3 = get_post_type( 406 );
    $container_post4 = get_post_type( 77 );
    $container_post5 = get_post_type( 55 );
    $container_post6 = get_post_type( 83 );
    $container_posts = ( $container_post1 == 'post' && $container_post2 == 'post' && $container_post3 == 'post' && $container_post4 == 'post'  && $container_post5 == 'post'  && $container_post6 == 'post' ) ? ' posts="81,59,406,77,55,83"' : '';


    /* Templates */
    $templates = array(
        /* Sliders */
        array(
            'name' => 'BB '.esc_html__( 'Boxed Slider', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507729956682{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style6"'.$slider_posts.' limit="4" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Boxed Slider With List', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507735505661{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style4"'.$slider_posts.' limit="8" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Carousel Slider', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1507733830322{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style2"'.$slider_posts.' limit="4" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Full-Width Slider', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1507734126312{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider'.$slider_posts.' limit="4" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Full-Width Slider II', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1507736611599{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style3"'.$slider_posts.' limit="4" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Grid Slider', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507734274037{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style5"'.$slider_posts.' limit="6" meta="53" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Grid Slider + Small Carousel', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507719215355{margin-bottom: 20px !important;}"][vc_column][vcg_blog_posts_fancy style="mini2" limit="8" carousel="withoutarrows"][/vc_column][/vc_row][vc_row css=".vc_custom_1507720085911{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style5"'.$slider_posts.' meta="53"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Grid Slider II', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507735345066{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style8"'.$slider_posts.' limit="8" meta="53" dots="true"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'BB '.esc_html__( 'Side Content Slider', 'gillion' ),
            'category' => 'Sliders',
            'content' => '[vc_row css=".vc_custom_1507736265449{margin-bottom: 80px !important;}"][vc_column][vcg_blog_slider style="style7"'.$slider_posts.' limit="4" meta="53" dots="true"][/vc_column][/vc_row]',
        ),


        /* Posts */
        array(
            'name' => 'CC '.esc_html__( 'Basic + Cover Style', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848626182{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="fancy1"'.$container_posts.' title="Basic + Cover Style"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Basic + Cover Style II', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848631064{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="fancy2"'.$container_posts.' limit="5" title="Basic + Cover Style II"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Card Style + Multi-Row', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848667186{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="card"'.$container_posts.' title="Card Style"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Cover Style', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848671388{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy'.$container_posts.'][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Cover Style Carousel', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848671388{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy'.$container_posts.' limit="6" carousel="sides"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Cover Style Centered', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848684738{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy'.$container_posts.' alignment="center" title="Cover Style Centered"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Cover Style II', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848675709{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy'.$container_posts.' style="coverbig" limit="2" title="Cover Style II"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Cover Style II Full', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1508848680696{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="coverbig"'.$container_posts.' limit="2" title=""][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Simple Carousel', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848696775{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="mini1"'.$container_posts.' limit="8" carousel="title" title="Simple Carousel"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Simple Round', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848688522{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="round"'.$container_posts.' limit="5" title="Simple Round"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CC '.esc_html__( 'Simple Small Carousel', 'gillion' ),
            'category' => 'Posts',
            'content' => '[vc_row css=".vc_custom_1508848692913{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_fancy style="mini2"'.$container_posts.' limit="8" carousel="title" title="Simple Small Carousel "][/vc_column][/vc_row]',
        ),


        /* Basic Posts */
        array(
            'name' => 'CD '.esc_html__( 'Basic Large', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848656313{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts'.$container_posts.' title="Basic Large"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Basic Large + Multi-Row', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848662872{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts'.$container_posts.' limit="4" title="Basic Large + Multi-Row"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Basic Posts', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts'.$container_posts.' columns="3" limit="3" title="Basic Posts"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Basic Posts + Multi-Row', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts'.$container_posts.' columns="3" limit="6" title="Basic Posts + Multi-Row"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Basic Small', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848651648{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts'.$container_posts.' columns="4" limit="4" title="Basic Small"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Card Posts', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts style="masonry blog-style-masonry-card" columns="3" limit="3" '.$container_posts.' order2="DESC" title="Card Posts"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Left Posts', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts style="left-small" columns="3" limit="3" '.$container_posts.' order2="DESC" title="Left Posts"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Small Left Posts', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts style="left-mini" columns="3" limit="3" '.$container_posts.' order2="DESC" title="Small Left Posts"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'CD '.esc_html__( 'Mix Posts', 'gillion' ),
            'category' => 'BasicPosts',
            'content' => '[vc_row css=".vc_custom_1508848635910{margin-bottom: 80px !important;}"][vc_column css=".vc_custom_1508773347606{}"][vcg_blog_posts style="left-right" columns="3" '.$container_posts.' order2="DESC" title="Mix Posts"][/vc_column][/vc_row]',
        ),



        /* Categories */
        array(
            'name' => 'GG '.esc_html__( 'Category Container', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773364579{margin-bottom: 80px !important;}"][vc_column][vcg_blog_categories][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GG '.esc_html__( 'Category Container + Filter', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773409021{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_categories style="style2" limit="4" title="Category Container + Filter"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GG '.esc_html__( 'Category Container + Filter II', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773418135{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_categories style="style2" image_radious="100%" limit="4" title="Category Container + Filter II"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GG '.esc_html__( 'Category Container + Filter III', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_categories style="style5" limit="5"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GG '.esc_html__( 'Category Container + List', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773371680{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_categories style="style1 sh-categories-style3"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GG '.esc_html__( 'Category Container + List II', 'gillion' ),
            'category' => 'Categories',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_posts_categories][/vc_column][/vc_row]',
        ),


        /* Categories */
        array(
            'name' => 'GT '.esc_html__( 'Text Slider I', 'gillion' ),
            'category' => 'TextSlider',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_text_slider][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GT '.esc_html__( 'Text Slider II', 'gillion' ),
            'category' => 'TextSlider',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_text_slider style="style2"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GT '.esc_html__( 'Text Slider III', 'gillion' ),
            'category' => 'TextSlider',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_text_slider style="style3"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GT '.esc_html__( 'Text Slider IV', 'gillion' ),
            'category' => 'TextSlider',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_text_slider style="style4"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'GT '.esc_html__( 'Text Slider With Image', 'gillion' ),
            'category' => 'TextSlider',
            'content' => '[vc_row css=".vc_custom_1508773379782{margin-bottom: 80px !important;}"][vc_column][vcg_blog_text_slider style="style5"][/vc_column][/vc_row]',
        ),


        /* Subscribe */
        array(
            'name' => 'SS '.esc_html__( 'Subscribe', 'gillion' ),
            'category' => 'Subscribe',
            'content' => '[vc_row css=".vc_custom_1507741266570{margin-right: 0px !important;margin-bottom: 80px !important;margin-left: 0px !important;padding-top: 40px !important;padding-right: 5% !important;padding-bottom: 60px !important;padding-left: 5% !important;background: #f6f6f6 url(https://cdn.gillion.shufflehound.com/templates/wp-content/uploads/sites/10/2017/02/Image_home_2.jpg?id=587) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 10px !important;}"][vc_column][vc_row_inner][vc_column_inner][vcg_heading title="Subscribe to get updated!" size="36px"][vcg_textblock css=".vc_custom_1503405267538{margin-top: 15px !important;margin-bottom: 30px !important;}"]
<p style="text-align: center;"><span style="font-size: 15px; color: #8d8d8d;">Nullam cursus, metus in venenatis convallis, nulla erat cursus diam, vitae luctus arcu justo vitae elit. Pellentesque ut magna diam. Nulla aliquet consequat sapien porta sagittis. Nunc aliquam varius nisl, nec lacinia nibh dictum nec. Donec non dapibus mauris, eget iaculis ipsum.</span></p>
[/vcg_textblock][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1507741251085{margin-bottom: 0px !important;}"][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner width="1/2"][vcg_textblock]
<p style="text-align: center;">[mc4wp_form]</p>
[/vcg_textblock][/vc_column_inner][vc_column_inner width="1/4"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'SS '.esc_html__( 'Subscribe + Social Icons', 'gillion' ),
            'category' => 'Subscribe',
            'content' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1507742228007{margin-bottom: 80px !important;}"][vc_column width="1/2" css=".vc_custom_1507741952216{margin-bottom: 0px !important;border-right-width: 1px !important;border-right-color: #f2f2f2 !important;border-right-style: solid !important;}"][vcg_heading title="Subscribe For Updates" align="left" size="36px" css=".vc_custom_1507742699727{margin-bottom: 12px !important;}"][vcg_textblock css=".vc_custom_1507742624451{margin-right: 50px !important;margin-bottom: 30px !important;}"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vcg_textblock][vcg_textblock][mc4wp_form][/vcg_textblock][/vc_column][vc_column width="1/2"][vcg_social_networks font_size="36px" icon_color="#999999" facebook="#" twitter="#" googleplus="#" tumblr="#" pinterest="#"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'SS '.esc_html__( 'Subscribe II', 'gillion' ),
            'category' => 'Subscribe',
            'content' => '[vc_row equal_height="yes" content_placement="middle" css=".vc_custom_1508862564964{padding-top: 40px !important;padding-right: 40px !important;padding-bottom: 40px !important;padding-left: 40px !important;background: #383838 url(https://cdn.gillion.shufflehound.com/templates/wp-content/uploads/sites/10/2017/10/Sub_img.jpg?id=1392) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 10px !important;}"][vc_column width="1/3"][vcg_textblock text_font="heading" text_weight="700" line_height="105%" css=".vc_custom_1507747799139{margin-top: -34px !important;margin-left: -30px !important;}"]
<p style="text-align: center;"><span style="font-size: 36px; color: #ffffff;">Subscribe</span></p>
<p style="text-align: center;"><span style="font-size: 24px; color: #ffffff;">&amp; Stay updated</span></p>
[/vcg_textblock][/vc_column][vc_column width="2/3"][vc_column_text][mc4wp_form][/vc_column_text][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'SS '.esc_html__( 'Subscribe III', 'gillion' ),
            'category' => 'Subscribe',
            'content' => '[vc_row full_width="stretch_row" equal_height="yes" content_placement="middle" css=".vc_custom_1507744405580{margin-bottom: 80px !important;padding-top: 135px !important;padding-bottom: 135px !important;background-color: #f9f9f9 !important;}"][vc_column width="1/2" css=".vc_custom_1507743949196{margin-bottom: 0px !important;border-right-width: 0px !important;border-right-color: #f2f2f2 !important;}"][vcg_heading title="Subscribe For Updates" align="left" size="30px" css=".vc_custom_1507744243031{margin-bottom: 12px !important;}"][vcg_textblock css=".vc_custom_1507743930964{margin-right: 50px !important;margin-bottom: 30px !important;}"]<span style="color: #858585;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur <span style="font-size: 18px;">adipiscing</span> elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</span>[/vcg_textblock][/vc_column][vc_column width="1/2"][vc_column_text][mc4wp_form][/vc_column_text][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'SS '.esc_html__( 'Subscribe IV', 'gillion' ),
            'category' => 'Subscribe',
            'content' => '[vc_row full_width="stretch_row" css=".vc_custom_1508861188327{padding-top: 65px !important;padding-bottom: 85px !important;background: #414549 url(https://cdn.gillion.shufflehound.com/templates/wp-content/uploads/sites/10/2017/10/Sub_img.jpg?id=1392) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="4/6"][vcg_heading title="Subscribe to get latest updates" size="36px" weight="300" transform="uppercase" title_color="#ffffff" icon="fa fa-envelope-o"][vc_empty_space][vc_column_text css=".vc_custom_1508860938739{padding-right: 16% !important;padding-left: 16% !important;}"][mc4wp_form][/vc_column_text][vcg_textblock text_font="categories"]
<p style="text-align: center; margin-bottom: 0px;"><span style="color: #d7ccbf; font-size: 16px;">If you"re like me, you"ve had at least one nightmare where your</span></p>
<p style="text-align: center;"><span style="color: #d7ccbf; font-size: 16px;">motorcycle gets stolen. The closest encounter I"ve had </span></p>
[/vcg_textblock][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]',
        ),


        /* Whitespaces */
        array(
            'name' => 'W1 '.esc_html__( 'Whitespace 15px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="15px"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'W2 '.esc_html__( 'Whitespace 30px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="30px"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'W3 '.esc_html__( 'Whitespace 50px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="50px"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'W4 '.esc_html__( 'Whitespace 80px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="80px"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'W5 '.esc_html__( 'Whitespace 100px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="100px"][/vc_column][/vc_row]',
        ),

        array(
            'name' => 'W6 '.esc_html__( 'Whitespace 120px', 'gillion' ),
            'category' => 'Whitespaces',
            'content' => '[vc_row][vc_column][vc_empty_space height="120px"][/vc_column][/vc_row]',
        ),

    );
    return $templates;
}


/**
 * Add VC Options
 */
require_once ( trailingslashit( get_template_directory() ) . '/inc/vc-options.php' );


/**
 * Add VC Icons
 */
function gillion_vc_icons_data() {
     require_once ( 'icons-vc.php' );
     if( function_exists( 'gillion_vc_icons' ) ) :
         return gillion_vc_icons();
     endif;
}
add_filter( 'vc_iconpicker-type-gillion_vc_icons', 'gillion_vc_icons_data' );
