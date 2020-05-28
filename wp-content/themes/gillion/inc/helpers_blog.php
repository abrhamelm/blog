<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


/**
 * Post Gallery Layout
 */
add_filter( 'post_gallery', 'gillion_post_gallery', 10, 2 );
function gillion_post_gallery( $string, $attr ){

    // Disable if enhanced post gallery option is off
    if( gillion_option( 'enhanced_post_gallery', 'on' ) != 'on' ) :
        return ;
    endif;


    $justify_height_class = ( isset( $attr['gillion_justify_height'] ) && $attr['gillion_justify_height'] ) ? $attr['gillion_justify_height'] : 'medium';
    $style = ( isset( $attr['gillion_style'] ) && $attr['gillion_style'] ) ? $attr['gillion_style'] : 'justify';
    $columns = ( isset( $attr['columns'] ) && $attr['columns'] >= 1 && $attr['columns'] <= 4 ) ? $attr['columns'] : '3';
    $gallery_id = 'gallery-'.gillion_rand(6);

    if( $style == 'grid' ) :
        $size = 'post-thumbnail';
    elseif( $style == 'masonry' ) :
        $size = 'gillion-masonry';
    elseif( $style == 'slider' ) :
        $size = 'gillion-landscape-large';
    else :
        $size = 'large';
    endif;

    if( $style == 'justify' ) :
        if( $justify_height_class == 'xsmall' ) { $justify_height = '120'; }
        elseif( $justify_height_class == 'small' ) { $justify_height = '150'; }
        elseif( $justify_height_class == 'large' ) { $justify_height = '230'; }
        elseif( $justify_height_class == 'xlarge' ) { $justify_height = '280'; }
        else { $justify_height = '180'; }
        $data_justify = ' data-justify="'.$justify_height.'"';
    else :
        $data_justify = '';
    endif;

    $output = '<div class="post-content-gallery '.esc_attr( $style ).' columns'.esc_attr( $columns ).'"'.$data_justify.'>';
    $posts = get_posts( array( 'include' => $attr['ids'], 'post_type' => 'attachment', 'orderby' => $attr['orderby'] ) );


    if( $style == 'slider' ) :
        $output .= '<div class="post-gallery-pagination sh-heading-font">1/'.count( $posts ).'</div>
        <div class="post-gallery-list">';
    endif;

        foreach( $posts as $post ) :
            $post_link = '';
            if( isset( $post->ID ) && is_array( wp_get_attachment_image_src( $post->ID, 'full' ) ) ) :
                $post_link_var = wp_get_attachment_image_src( $post->ID, 'full' );
                if( isset( $post_link_var[0] ) ) :
                    $post_link = $post_link_var[0];
                endif;
            endif;

            $post_image = '';
            if( isset( $post->ID ) && is_array( wp_get_attachment_image_src( $post->ID, $size ) ) ) :
                $post_image_var = wp_get_attachment_image_src( $post->ID, $size );
                if( isset( $post_image_var[0] ) ) :
                    $post_image = $post_image_var[0];
                endif;
            endif;

            $output .= '
            <div class="post-content-gallery-item">
                <a href="'.esc_url( $post_link ).'" data-rel="lightcase:'.$gallery_id.'" data-lc-title="'.$post->post_excerpt.'">
                    <img src="'.esc_url( $post_image ).'" alt="'.$post->post_excerpt.'" />
                    <div class="post-content-gallery-item-caption">'.$post->post_excerpt.'</div>
                </a>
            </div>';
        endforeach;

    if( $style == 'slider' ) :
        $output .= '</div>';
    endif;

    $output .= '</div>';
    return $output;
}


/**
 * Post Gallery Options
 */
add_action('print_media_templates', function() { ?>
    <script type="text/html" id="tmpl-custom-gallery-setting">
        <label class="setting">
            <span><?php _e('Style', 'gillion'); ?></span>
            <select data-setting="gillion_style">
                <option value="justify">Justify</option>
                <option value="masonry">Masonry</option>
                <option value="grid">Grid</option>
                <option value="slider">Slider</option>
            </select>
        </label>
        <label class="setting">
            <span><?php _e('Justify Style Height', 'gillion'); ?></span>
            <select data-setting="gillion_justify_height">
                <option value="xsmall">XSmall</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
                <option value="xlarge">XLarge</option>
            </select>
        </label>
        <label class="setting">
            <span style="font-style: italic; opacity: 0.8; text-align: left;">
                <?php _e("Notice: Justify and Slider styles doesn't work with column option. Masonry and Grid styles work only with columns 1-4", 'gillion'); ?>
            </span>
        </label>
    </script>
    <script>
        jQuery(document).ready(function() {
            _.extend(wp.media.gallery.defaults, {
                gillion_style: 'justify',
                gillion_justify_height: 'medium',
            });

            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
            template: function(view){
              return wp.media.template('gallery-settings')(view)
                   + wp.media.template('custom-gallery-setting')(view);
            }
            });
        });
    </script>
<?php });


/**
 * Create Custom Random Function
 */
function gillion_rand($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


/**
 * Count Text Read Time
 */
if ( ! function_exists( 'gillion_read_time' ) ) :
    function gillion_read_time( $string ) {
        $string = strip_tags($string);
        $string = preg_replace('/\s+/', ' ', trim($string));
        $words = explode(" ", $string);
        $words = count($words);

    	$min = floor($words / 200);
        $sec = floor($words % 200 / (200 / 60));
    	if( $min < 1 ) {
    		return '1 min <span>'.esc_html__( 'read', 'gillion' ).'</span>';
    	}
        if( $sec >= 20 ) {
            $min++;
        }
    	return $min . ' min <span>'.esc_html__( 'read', 'gillion' ).'</span>';
    }
endif;


/**
 * Update Post Views Count
 */
if ( ! function_exists( 'gillion_add_post_views' ) ) :
    function gillion_add_post_views( $id = '' ) {
        if( $id > 0 ) {

            if( get_post_status( $id ) == 'publish' && is_single() && !current_user_can('editor') && !current_user_can('administrator') ) :
                $count_key = 'gillion_post_views';
                $count_org = get_post_meta($id, $count_key, true);
                $count = $count_org;
                if( $count == '' ){
                    $count = 0;
                    delete_post_meta($id, $count_key);
                    add_post_meta($id, $count_key, '0');
                } else {
                    $count++;
                    update_post_meta($id, $count_key, $count);
                }
                return $count;
            endif;
        }
    }
endif;


/**
 * Get Post Views Count
 */
if ( ! function_exists( 'gillion_get_post_views' ) ) :
function gillion_get_post_views( $id ) {
    //$notice = ( ( ( get_post_status( $id ) != 'publish' ) || ( current_user_can('editor') || current_user_can('administrator') ) ) && is_single() ) ? ' (paused)' : '';
    $count = get_post_meta($id, 'gillion_post_views', true);
    return ( $count && $count > 0 ) ? $count : '0';
}
endif;


/*
 * Get/Update Post Views Count
 */
if ( ! function_exists( 'gillion_get_update_post_views' ) ) :
    add_action('wp_ajax_post_views_count', 'gillion_get_update_post_views');
    add_action('wp_ajax_nopriv_post_views_count', 'gillion_get_update_post_views');
    function gillion_get_update_post_views() {
        $id = (int)$_POST['post_id'];

        if( get_post_status( $id ) == 'publish' && !current_user_can('editor') && !current_user_can('administrator') ) :
            $count_key = 'gillion_post_views';
            $count_org = get_post_meta($id, $count_key, true);
            $count = $count_org;
            if( $count == '' ){
                $count = 0;
                delete_post_meta($id, $count_key);
                add_post_meta($id, $count_key, '0');
            } else {
                $count++;
                update_post_meta($id, $count_key, $count);
            }
            echo esc_attr( $count-1 );
        endif;

        wp_die();
    }
endif;


/*
 * Post Read Later
 */
if ( ! function_exists( 'gillion_post_readlater' ) ) :
    function gillion_post_readlater( $id ) {
        if( gillion_option( 'blog_bookmarks', 'style_title' ) != 'disabled' ) :
            if( $id > 0 && get_current_user_id() > 0 ) :
                $read_later_posts = get_user_meta( get_current_user_id(), 'gillion_read_it_later' );
                $read_later = ( in_array( $id, $read_later_posts ) ) ? 'remove' : 'add';

                if( $read_later == 'add' ) :
                    $icon = '<i class="fa fa-bookmark-o"></i>';
                else :
                    $icon = '<i class="fa fa-bookmark"></i>';
                endif;

                echo '&nbsp;<span class="post-read-later" data-type="'.esc_attr( $read_later ).'" data-id="'.esc_attr( get_the_ID() ).'">'.wp_kses_post( $icon ).'</span>';
            elseif( $id > 0 ) :
                $icon = '<i class="fa fa-bookmark-o"></i>';
                echo '&nbsp;<span class="post-read-later post-read-later-guest" href="#login-register" data-type="add" data-id="'.esc_attr( get_the_ID() ).'">'.wp_kses_post( $icon ).'</span>';
            endif;
        endif;
    }
endif;


/**
 * Get/Update Read Later Status for Post
 */
add_action('wp_ajax_read_later_trigger', 'gillion_get_update_read_later');
add_action('wp_ajax_nopriv_read_later_trigger', 'gillion_get_update_read_later');
function gillion_get_update_read_later() {

    $id = (int)$_POST['post_id'];
    $type = ( $_POST['type'] == 'remove' ) ? 'remove' : 'add';
    $posts = get_user_meta( get_current_user_id(), 'gillion_read_it_later' );

    if( is_string( get_post_status( $id ) ) ) :
        if( $type == 'add' ) :

            if( !in_array( $id, $posts ) ) :
                add_user_meta( get_current_user_id(), 'gillion_read_it_later', $id );
                $review = gillion_post_review_score( $id );
                $review_content = '';
                if( $review > 0 ) :
                    $color_out = '';
                    $color = gillion_post_option( $id, 'review_color' );
                    $color2 = gillion_post_option( $id, 'review_color2' );
                    if( $color == 'rgba(255,255,255,0)' && $color2 == 'rgba(255,255,255,0)' ) :
                        $color_out = '';
                    elseif( $color && $color2 ) :
                        $color_out = ' style="background-color: '.esc_attr( $color ).'; background: linear-gradient(to bottom, '.esc_attr( $color ).' 0%,'.esc_attr( $color2 ).' 100%);"';
                    elseif( $color ) :
                        $color_out = ' style="background-color: '.esc_attr( $color ).'"';
                    endif;

                    $review_content = '<span class="sh-read-later-review"'.wp_kses_post( $color_out ).'">
                        <div class="sh-read-later-review-score">
                            '.wp_kses_post( $review ).'
                        </div>
                    </span>';
                endif;

                echo json_encode( array(
                    'commit' => 'add',
                    'post_id' => $id,
                    'body' => '<li class="sh-read-later-item menu-item" data-id="'.esc_attr( $id ).'">
                    				<a href="'.get_permalink( $id ).'">
                                        <div class="sh-read-later-thumbnail" style="background-image: url('.gillion_thumbnail_url( $id, 'gillion-square-micro' ).');">
                    						<span class="sh-read-later-delete">
                    							<i class="icon icon-close"></i>
                    						</span>
                                            '.$review_content.'
                    					</div>
                    					<div class="sh-read-later-content">
                    						<h5 class="sh-read-later-link" data-href="'.get_permalink( $id ).'">'.get_the_title( $id ).'</h5>
                    					</div>
                    				</a>
                    			</li>'
                ));
            endif;

        elseif( $type == 'remove' ) :

            if( in_array( $id, $posts ) ) :
                delete_user_meta( get_current_user_id(), 'gillion_read_it_later', $id );
                echo json_encode( array(
                    'commit' => 'remove',
                    'post_id' => $id
                ));
            endif;

        endif;
    endif;

    wp_die();
}


/**
 * Remove Read Later Status for Post
 */
add_action('wp_ajax_read_latter_delete', 'gillion_read_latter_delete');
add_action('wp_ajax_nopriv_read_latter_delete', 'gillion_read_latter_delete');
function gillion_read_latter_delete() {
    $id = (int)$_POST['post_id'];
    delete_user_meta( get_current_user_id(), 'gillion_read_it_later', $id );
    echo '1';
    wp_die();
}


/**
 * Get Review Rating for Post
 */
if ( ! function_exists( 'gillion_post_review_score' ) ) :
    function gillion_post_review_score( $id ) {
        $score = gillion_post_option( $id, 'review_score' );
        if( $score > 0 ) :
            $score_int = intval( $score );
            $score_point = $score - $score_int;
            return number_format( $score_int, 0 ).'<span>.'.( $score_point * 10 ).'</span>';
        endif;
    }
endif;


/**
 * Get Review Rating for Post
 */
if ( ! function_exists( 'gillion_post_review' ) ) :
    function gillion_post_review( $id ) {
        $score = gillion_post_review_score( $id );
        if( $score ) {
            $color_out = '';
            $color = gillion_post_option( $id, 'review_color' );
            $color2 = gillion_post_option( $id, 'review_color2' );
            if( $color == 'rgba(255,255,255,0)' && $color2 == 'rgba(255,255,255,0)' ) :
                $color_out = '';
            elseif( $color && $color2 ) :
                $color_out = ' style="background-color: '.esc_attr( $color ).'; background: linear-gradient(to bottom, '.esc_attr( $color ).' 0%,'.esc_attr( $color2 ).' 100%);"';
            elseif( $color ) :
                $color_out = ' style="background-color: '.esc_attr( $color ).'"';
            endif;

            $large = '';
            if( gillion_option( 'global_review', 'style1' ) == 'style2' ) :
                $percent = (float)strip_tags( $score ) * 10;
                $min = 124;
            	$offset = $min - ( 1.24 * $percent );

                $store = ( $color ) ? 'stroke: '.gillion_hex2rgba( $color, '0.6' ).';' : '';

                $large = '
                <div class="post-review-svg">
                    <div class="sh-pie" data-score="'.number_format( (float)($percent / 10), 1, '.', '').'" data-offset="'.$offset.'">
            			<svg width="46" height="46" class="sh-pie-svg">
            				<circle r="21" cx="23" cy="23" fill="transparent" stroke-dasharray="128" stroke-dashoffset="0"
            				style="'.$store.'stroke-dashoffset: '.$min.'px;"></circle>
            			</svg>
            		</div>
                </div>';
            endif;

            echo $large.'
            <div class="post-review post-review-standard"'.wp_kses_post( $color_out ).'>
                <div class="post-review-score">
                    '.wp_kses_post( $score ).'
                </div>
            </div>';
        }
    }
endif;


/**
 * Get Review Rating Items for Post
 */
if ( ! function_exists( 'gillion_post_review_items' ) ) :
    function gillion_post_review_items( $id ) {
        $items = gillion_post_option( $id, 'review_criteria' );
        if( count($items) > 0 ) :
            return $items;
        endif;
    }
endif;


/**
 * Blog - meta
 */
if ( ! function_exists( 'gillion_post_meta' ) ) :
function gillion_post_meta( $layout = '' ) {

    /* Set single post meta from theme settings */
    $is_single_post = 0;
    if( $layout == 10 ) :
        $layout = gillion_option( 'blog_meta_single_post', '50' );
        $is_single_post++;
    endif;


    /* Get elements */
    $elements = gillion_option( 'post_elements' );
    $id = get_the_ID();

    /* Slider posts */
    if( $layout == 1 ) :
        $items = array( 'authorfull', 'comments', 'views' );

    /* Widget mini posts */
    elseif( $layout == 2 ) :
        $items = array( 'comments', 'views' );

    /* Widget slider mini posts */
    elseif( $layout == 3 ) :
        $items = array( 'added', 'comments', 'views' );

    /* Large layout */
    elseif( $layout == 4 ) :
        $items = array( 'added', 'comments', 'views' );

    /* Large layout */
    elseif( $layout == 5 ) :
        $items = array( 'added', 'comments' );

    /* Cover layout */
    elseif( $layout == 6 ) :
        $items = array( 'author', 'comments' );

    /* Cover layout */
    elseif( $layout == 7 ) :
        $items = array( 'author', 'readtime' );

    /* Large Cover layout */
    elseif( $layout == 8 ) :
        $items = array( 'authorfull', 'comments', 'readtime' );

    /* Header Posts */
    elseif( $layout == 9 ) :
        $items = array( 'added2' );

    /* Single Posts */
    elseif( $layout == 10 ) :
        $items = array( 'authorfull', 'comments', 'readtime', 'views' );

    /* Presets */
    elseif( $layout == 50 ) : $items = array( 'authorfull', 'comments', 'readtime', 'views' );
    elseif( $layout == 51 ) : $items = array( 'authorfull', 'comments', 'readtime' );
    elseif( $layout == 52 ) : $items = array( 'authorfull', 'comments', 'views' );
    elseif( $layout == 53 ) : $items = array( 'authorfull', 'comments' );
    elseif( $layout == 54 ) : $items = array( 'authorfull' );
    elseif( $layout == 55 ) : $items = array( 'author' );
    elseif( $layout == 56 ) : $items = array( 'author', 'comments' );
    elseif( $layout == 80 ) : $items = array( 'added', 'readtime' );
    elseif( $layout == 100 ) : $items = array( 'views', 'comments' );
    elseif( $layout == 500 ) : $items = array();

    /* Masonry and grid posts */
    else :
        $items = array( 'author', 'comments', 'readtime' );
    endif;


    /* Enable/disable meta information from theme settings */
    if( !$is_single_post ) :
        // remove author (without image) + date if needed
        if( gillion_option( 'blog_meta_author', 'on' ) == 'off' ) :
            $items = array_diff( $items, array( 'author' ) );
        endif;

        // remove author (with image) + date if needed
        if( gillion_option( 'blog_meta_authorfull', 'on' ) == 'off' ) :
            $items = array_diff( $items, array( 'authorfull' ) );
        endif;

        // remove comments if needed
        if( gillion_option( 'blog_meta_comments', 'on' ) == 'off' ) :
            $items = array_diff( $items, array( 'comments' ) );
        endif;

        // remove page views if needed
        if( gillion_option( 'blog_meta_pageviews', 'on' ) == 'off' ) :
            $items = array_diff( $items, array( 'views' ) );
        endif;

        // remove read time if needed
        if( gillion_option( 'blog_meta_readtime', 'on' ) == 'off' ) :
            $items = array_diff( $items, array( 'readtime' ) );
        endif;
    endif;
?>

    <div class="post-meta-content">
        <?php if( array_search( 'author', $items ) !== false || array_search( 'authorfull', $items ) !== false ) :
            if( get_the_author() ) :
                $author_id = get_the_author_meta( 'ID' );
                $author = get_the_author();
            else :
                global $post;
                $author_id = $post->post_author;
                $author = get_the_author_meta( 'display_name', $author_id );
            endif;
        ?>
            <span class="post-auhor-date<?php echo ( array_search( 'authorfull', $items ) !== false ) ? ' post-auhor-date-full' : ''; ?>">
                <?php if( array_search( 'authorfull', $items ) !== false ) : ?>
                    <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                        <?php echo get_avatar( $author_id, 28, '','', array( 'class' => 'post-author-image') ); ?>
                    </a>
                <?php endif; ?>
                <span>
                <a href="<?php echo get_author_posts_url( $author_id ); ?>" class="post-author"><?php
                    echo esc_attr( $author );
                ?></a></span><?php if( !defined('FW') || ( isset($elements['date']) && $elements['date'] == true ) ) :
                    echo ',';
                endif; ?>

                <?php if( !defined('FW') || ( isset($elements['date']) && $elements['date'] == true ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-date">
                        <?php if( $layout == 2 ) : ?>
                            <i class="icon icon-calendar"></i>
                        <?php endif; ?>
                        <?php if( gillion_option( 'post_date_format', 'friendly' ) == 'friendly' ) : ?>
                            <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', 'gillion' ); ?>
                        <?php else : ?>
                            <?php echo get_the_date(); ?>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </span>
        <?php endif; ?>

        <?php /* Date Only */ ?>
        <?php if( array_search( 'added', $items ) !== false ) : ?>
            <?php if( !defined('FW') || ( isset($elements['date']) && $elements['date'] == true ) ) : ?>
                <span class="post-auhor-date">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-date">
                        <?php if( gillion_option( 'post_date_format', 'friendly' ) == 'friendly' ) : ?>
                            <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', 'gillion' ); ?>
                        <?php else : ?>
                            <?php echo get_the_date(); ?>
                        <?php endif; ?>
                    </a>
                </span>
            <?php endif; ?>
        <?php endif; ?>

        <?php /* Date Only with Icon */ ?>
        <?php if( array_search( 'added2', $items ) !== false ) : ?>
            <?php if( !defined('FW') || ( isset($elements['date']) && $elements['date'] == true ) ) : ?>
                <span class="post-auhor-date">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-date">
                        <i class="icon icon-clock"></i>
                        <?php if( gillion_option( 'post_date_format', 'friendly' ) == 'friendly' ) : ?>
                            <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', 'gillion' ); ?>
                        <?php else : ?>
                            <?php echo get_the_date(); ?>
                        <?php endif; ?>
                    </a>
                </span>
            <?php endif; ?>
        <?php endif; ?>

        <?php /* Comments */ ?>
        <?php if( ( !defined('FW') && comments_open() ) || ( isset($elements['comments']) && $elements['comments'] == true && comments_open() ) && ( array_search( 'comments', $items ) !== false ) ) : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="post-comments">
                <i class="icon icon-bubble"></i>
                <?php echo esc_attr( get_comments_number( '0', '1', '%' ) ); ?>
            </a>
        <?php endif; ?>

        <?php /* Read time */ ?>
        <?php if( array_search( 'readtime', $items ) !== false ) : ?>
            <span class="post-readtime">
                <i class="icon icon-clock"></i>
                <?php echo gillion_read_time( get_post_field( 'post_content', get_the_ID() ) ); ?>
            </span>
        <?php endif; ?>

        <?php /* Views */ ?>
        <?php if( array_search( 'views', $items ) !== false && gillion_option( 'post_view_count', 'default' ) != 'off' ) : ?>
            <span class="post-views">
                <i class="icon icon-eye"></i>
                <?php echo gillion_get_post_views( get_the_ID() ); ?>
            </span>
        <?php endif; ?>

        <?php /* Read Later */ ?>
        <?php if( gillion_option( 'blog_bookmarks', 'style_title' ) != 'disabled'  ) : ?>
            <?php if( gillion_option( 'blog_bookmarks', 'style_title' ) == 'style_title' ) : ?>
                <span class="responsive-post-read-later">
                    <?php gillion_post_readlater( get_the_ID() ); ?>
                </span>
            <?php else : ?>
                <span class="desktop-post-read-later">
                    <?php gillion_post_readlater( get_the_ID() ); ?>
                </span>
            <?php endif; ?>
        <?php else : ?>
            <span class="placeholder-post-read-later"></span>
        <?php endif; ?>
    </div>

<?php }
endif;


/**
 * Blog - meta one
 */
 if ( ! function_exists( 'gillion_url_host' ) ) :
function gillion_url_host( $url ) {
    if( $url ) {
        $url = esc_url( $url );
        $parse = parse_url($url);
        if( isset($parse['host']) ) :
            return esc_url( 'http://'.$parse['host'] );
        endif;
    }
}
endif;


/**
 * Get Review Rating for Post
 */
if ( ! function_exists( 'gillion_post_single_review' ) ) :
    function gillion_post_single_review( $id, $score, $review_layout ) {

        $pros = gillion_post_option( $id, 'review_pros' );
        $cons = gillion_post_option( $id, 'review_cons' );
        $criteria = gillion_post_option( $id, 'review_criteria' );
        $verdict = gillion_post_option( $id, 'review_verdict' );
        $color = ( gillion_post_option( $id, 'review_color' ) ) ? gillion_post_option( $id, 'review_color' ) : '#363636';
        $color2 = gillion_post_option( $id, 'review_color2' );
        if( $color && $color2 ) :
            $color_out = ' style="background-color: '.esc_attr( $color ).'; background: linear-gradient(to bottom, '.esc_attr( $color ).' 0%,'.esc_attr( $color2 ).' 100%);"';
        elseif( $color ) :
            $color_out = ' style="background-color: '.esc_attr( $color ).'"';
        endif;
    ?>
        <div class="post-content-review post-content-review-<?php echo esc_attr( $review_layout ); ?>">
            <div class="post-content-review-score" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'post-thumbnail' ) ); ?> );">
                <h4>
                    <?php echo wp_kses_post( $score ); ?>
                    <div><?php esc_html_e( 'Score', 'gillion' ); ?></div>
                </h4>
                <div class="post-content-review-score-pattern"<?php echo wp_kses_post( $color_out ); ?>></div>
            </div>
            <?php if( $verdict || count($pros) || count($cons) || count($criteria) ) : ?>
                <div class="post-content-review-details">
                    <?php if( count( $pros ) > 0 || count( $cons ) > 0 ) : ?>
                        <div class="post-content-review-pros-cons">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h4><?php esc_html_e( 'Pros', 'gillion' ); ?></h4>
                                    <ul class="post-content-review-pros">
                                        <?php foreach( $pros as $item ) : ?>
                                            <li class="post-content-review-item"><?php echo wp_kses_post( $item ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h4><?php esc_html_e( 'Cons', 'gillion' ); ?></h4>
                                    <ul class="post-content-review-cons">
                                        <?php foreach( $cons as $item ) : ?>
                                            <li class="post-content-review-item"><?php echo wp_kses_post( $item ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="post-content-review-progressbar">
                        <?php foreach( $criteria as $item ) :
                            $item_score = ( isset( $item['score'] ) ) ? $item['score'] : 0;
                            if( $item_score > 10) {
                                $item_score = 10;
                            }
                            $item_score = (float)$item_score * 10;
                        ?>
                            <div class="post-content-review-progressbar-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-10 col-xs-10"><?php echo esc_attr( $item['name'] ); ?></div>
                                    <div class="col-md-6 col-sm-2 col-xs-2 text-right"><?php echo esc_attr( $item['score'] ); ?></div>
                                </div>

                                <div class="post-content-review-progressbar-graph">
                                    <div class="post-content-review-progressbar-graph-fill" style="background-color: <?php echo esc_attr( $color ); ?>; width: <?php echo esc_attr( $item_score ); ?>%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if( $verdict ) : ?>
                        <div class="post-content-review-verdict">
                            <h4><?php esc_html_e( 'Final Verdict', 'gillion' ); ?></h4>
                            <p><?php echo esc_attr( $verdict ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php
    }
endif;


/**
 * Mini Post Style
 */
if ( ! function_exists( 'gillion_post_mini_layout' ) ) :
    function gillion_post_mini_layout( $size = '', $layout = 'layout1' ) {
        $size_class = ( $size ) ? ' blog-mini-post-large' : ' blog-mini-post-small';
        $meta = ( $layout == 'layout1' ) ? 7 : 2;
    ?>
        <div class="blog-mini-post<?php echo esc_attr( $size_class ); ?> blog-mini-post-<?php echo esc_attr( $layout ); ?>">
            <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="blog-mini-post-thumb sh-post-review-mini" <?php if( $layout == 'layout1') : ?> style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'gillion-square-small' ) ); ?>);"<?php endif; ?>>
                <?php echo gillion_post_review( get_the_ID() ); ?>
                <div class="post-overlay-small"></div>
            </a>
            <div class="blog-mini-post-content">
                <div class="blog-mini-post-content-container">
                    <a href="<?php echo get_permalink( get_the_ID() ); ?>">
                        <h5 class="post-title">
                            <?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
                        </h5>
                    </a>
                    <div class="post-meta">
                        <?php gillion_post_meta( $meta ); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php }
endif;


/**
 * Generic Post Style
 */
 if ( ! function_exists( 'gillion_post_generic_layout' ) ) :
     function gillion_post_generic_layout() { ?>

         <div class="blog-mini-post-generic sh-widget-posts-slider-item sh-widget-posts-slider-item-large sh-widget-posts-slider-style1">
             <div class="post-thumbnail">
                 <?php echo the_post_thumbnail( 'gillion-landscape-small' ); ?>

                 <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                 <?php echo gillion_post_review( get_the_ID() ); ?>
                 <?php echo gillion_post_categories_position( 'image' ); ?>
             </div>
             <a href="<?php echo get_permalink( get_the_ID() ); ?>">
                 <h5 class="post-title">
                     <?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
                 </h5>
             </a>
             <?php gillion_post_meta_excerpt( 6 ); ?>
         </div>

    <?php }
endif;


/**
 * Header Post Style
 */
if ( ! function_exists( 'gillion_post_header_style' ) ) :
    function gillion_post_header_style() {
        $thumb_size = ( gillion_option( 'header_width' ) != 'full' ) ? 'gillion-square-small' : 'gillion-square';
        $thumb_size = ( function_exists( 'gillion_showcase_categories_image_size' ) ) ? gillion_showcase_categories_image_size( $thumb_size ) : $thumb_size;
    ?>

        <div class="post-item post-header-item"
        data-i="<?php echo esc_url( the_post_thumbnail_url( $thumb_size ) ); ?>"
        data-t="<?php the_title(); ?>"
        data-l="<?php echo esc_url( get_permalink() ); ?>"
        data-d="<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', 'gillion' ); ?>"></div>

        <?php /*
        <div class="post-item post-header-item">
            <div class="post-container">
                <div class="post-thumbnail">
                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="sh-ratio">
                            <div class="sh-ratio-container">
                                <div class="sh-ratio-content" data-lazy-background="<?php echo esc_url( the_post_thumbnail_url( 'gillion-square-small' ) ); ?>"></div>
                            </div>
                        </div>
                        <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                        <?php echo gillion_post_review( get_the_ID() ); ?>
                    <?php endif; ?>
                </div>
                <div class="post-content-container">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
                        <h4>
                            <?php gillion_sticky_post(); ?>
                            <?php the_title(); ?>
                        </h4>
                    </a>
                    <div class="post-meta">
                        <?php gillion_post_meta( 9 ); ?>
                    </div>
                </div>
            </div>
        </div>*/?>

    <?php }
endif;


/**
 * Update Post Share
 */
if ( ! function_exists( 'gillion_post_share' ) ) :
    function gillion_post_share( $size = '') { ?>
        <div class="post-readmore sh-table">
        	<div class="sh-table-cell post-readmore-text">
        		<a href="<?php echo esc_url( get_permalink() ); ?>">
        			<h6><?php esc_html_e( 'Read more', 'gillion'); ?></h6>
        		</a>
        	</div>
        	<div class="sh-table-cell post-readmore-line">
        		<div class="post-readmore-line-content"></div>
        	</div>
        	<div class="sh-table-cell">
        		<div class="post-content-share post-content-share-side" data-url="<?php echo esc_url( get_permalink() ); ?>" data-title="<?php echo esc_attr( get_the_title() ); ?>"></div>
        	</div>
        </div>

    <?php }
endif;


add_filter('widget_tag_cloud_args', 'gillion_tag_widget_limit');
function gillion_tag_widget_limit( $args ) {
    $limit = gillion_option( 'blog_tag_cloud', 10 );

	if( isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag' && $limit > 0 ) :
	    $args['number'] = $limit;
	endif;

	return $args;
}


add_action( 'wp_ajax_nopriv_gillon_ajax_dynamic_content', 'gillon_quick_read' );
add_action( 'wp_ajax_gillon_ajax_dynamic_content', 'gillon_quick_read' );
function gillon_quick_read() {
    // function
    die();
}


/**
 * Post excerpt and meta data
 */
if( ! function_exists( 'gillion_post_meta_excerpt' ) ) :
function gillion_post_meta_excerpt( $meta = '', $style = '' ) {
$position = gillion_option( 'global_post_meta_order', 'bottom' ); ?>

    <?php if( $position == 'top' ) : ?>
        <div class="post-meta">
            <?php gillion_post_meta( $meta ); ?>
        </div>
    <?php endif; ?>

    <?php if( $style != 'grid-simple' ) : ?>
        <div class="post-content">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>

    <?php if( $position == 'bottom' ) : ?>
        <div class="post-meta">
            <?php gillion_post_meta( $meta ); ?>
        </div>
    <?php endif; ?>

<?php }
endif;


/**
** Read it later page
**/
if ( ! function_exists( 'gillion_readlater_page_var' ) ) :
    function gillion_readlater_page_var( $vars ) {
        array_push( $vars, 'read-it-later' );
        return $vars;
    }
    add_action( 'query_vars', 'gillion_readlater_page_var' );
endif;

if ( ! function_exists( 'gillion_readlater_page_template' ) ) :
    function gillion_readlater_page_template( $template ){
        if( !is_admin() && is_home() && isset( $_GET['read-it-later'] ) ) :
            $new_template = trailingslashit( get_template_directory() ) . '/page-readlater.php';
            if( file_exists( $new_template ) ) :
                $template = $new_template;
            endif;
        endif;
        return $template;
    }
    add_filter('template_include', 'gillion_readlater_page_template', 1000, 1);
endif;
