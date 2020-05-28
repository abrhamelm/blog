<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Helper functions
 */



add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
    return'<a href="/wp-login.php?action=lostpassword" class="login-forgot-password">'
        . esc_attr( 'Forgot Password', 'gillion' ) .
    '</a>';
}




 /**
  * Change default Unyson Framework path
  */
 add_filter(
     'fw_framework_customizations_dir_rel_path',
     'gillion_fw_customizations_dir_rel_path'
 );
 function gillion_fw_customizations_dir_rel_path($rel_path) {
     /**
      * Make the directory name shorter. Instead of
      * {theme}/framework-customizations/theme/options/post.php
      * will be
      * {theme}/fw/theme/options/post.php
      */
     return '/inc/framework-customizations';
}


/**
 * Load footer items
 */
function gillion_get_footers() {
    $layout_choices = array(
    	'default' => esc_html__( 'Default (from theme settings)', 'gillion' ),
    );

    global $post;
    $post2 = $post;
    $footers = new WP_Query( array(
        'post_type' => 'shufflehound_footer',
        'post_status' => 'publish',
        'posts_per_page' => 20
    ));
    if( $footers->have_posts() ) :
        while( $footers->have_posts() ) : $footers->the_post();

    		$footer_id = get_the_ID();
            $layout_choices[ $footer_id ] = get_the_title().' (from WPbakery page builder)';

        endwhile;
    endif;

    wp_reset_postdata();
    $post = $post2;
    return $layout_choices;
}




/**
 * Load page items
 */
function gillion_get_page_templates( $default = 'default' ) {
    if( $default == 'disabled' ) :
        $layout_choices = array(
        	'disabled' => esc_html__( 'Disabled', 'gillion' ),
        );
    else :
        $layout_choices = array(
        	'default' => esc_html__( 'Default', 'gillion' ),
        );
    endif;

    global $post;
    $post2 = $post;
    $footers = new WP_Query( array(
        'post_type' => 'shufflehound_temp',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ));
    if( $footers->have_posts() ) :
        while( $footers->have_posts() ) : $footers->the_post();

    		$footer_id = get_the_ID();
            $layout_choices[ $footer_id ] = get_the_title();

        endwhile;
    endif;

    wp_reset_postdata();
    $post = $post2;
    return $layout_choices;
}



/**
 * Load page items
 */
function gillion_get_pages() {
    $layout_choices = array(
    	'disabled' => esc_html__( 'Disabled', 'gillion' ),
    );

    global $post;
    $post2 = $post;
    $footers = new WP_Query( array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ));
    if( $footers->have_posts() ) :
        while( $footers->have_posts() ) : $footers->the_post();

    		$footer_id = get_the_ID();
            $layout_choices[ $footer_id ] = get_the_title();

        endwhile;
    endif;

    wp_reset_postdata();
    $post = $post2;
    return $layout_choices;
}




/**
 * Load Instagram Widget template
 */
add_filter( 'wpiw_template_part', 'gillion_instagram_class' );
function gillion_instagram_class( $array ) {
    return 'inc/templates/instagram-widget.php';
}

/**
 * Render template
 */
function gillion_render_css() {
    ob_start();
    get_template_part( 'inc/templates/render-css' );
    return ob_get_clean();
}


/**
 * Render template - mini
 */
function gillion_render_css_mini() {
    ob_start();
    get_template_part( 'inc/templates/render-css-mini' );
    return ob_get_clean();
}


/**
 * Allowed_html
 */
function gillion_allowed_html() {
    return array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'i' => array(),
        'style' => array(),
        'b' => array(
            'data' => array()
        ),
    );
}


/**
 * Allowed_html 2
 */
function gillion_allowed_html_form() {
    return array(
        'p' => array(),
        'sup' => array(),
        'div' => array(
            'class' => array(),
            'id' => array(),
            'style' => array()
        ),
        'form' => array(
            'data-fw-form-id' => array(),
            'data-fw-ext-forms-type' => array(),
            'id' => array(),
            'class' => array(),
            'action' => array(),
            'method' => array(),
            'style' => array(),
        ),
        'label' => array(
            'for' => array(),
        ),
        'input' => array(
            'type' => array(),
            'name' => array(),
            'placeholder' => array(),
            'value' => array(),
            'id' => array(),
            'class' => array(),
            'required' => array(),
        ),
        'select' => array(
            'type' => array(),
            'name' => array(),
            'placeholder' => array(),
            'value' => array(),
            'required' => array(),
            'id' => array(),
            'class' => array(),
        ),
        'option' => array(
            'value' => array(),
            'selected' => array(),
        ),
        'textarea' => array(
            'name' => array(),
            'placeholder' => array(),
            'id' => array(),
            'required' => array(),
        ),
    );
}


/**
 * Allowed_html 3
 */
function gillion_allowed_html_icon_option() {
    return array(
        'i' => array(
            'class' => array(),
            'data-value' => array(),
            'data-group' => array()
        ),
    );
}


/**
 * Get page ID
 */
function gillion_page_id( $loop = 0 ) {

    $GLOBALS['pagenow'];
    if( function_exists( 'is_shop' ) && is_shop() == true ) {
        $post_id = get_option( 'woocommerce_shop_page_id' );
    } elseif( is_search() || is_singular('product') || is_archive() || is_404() || $GLOBALS['pagenow'] === 'wp-signup.php' ) {
        $post_id = '';
    } elseif( get_the_ID() > 0 && $loop == 0 ) {
        $post_id = get_the_ID();
    } else {
        global $wp_query;
        $post_id = $wp_query->get_queried_object_id();
    }

    return $post_id;
}


/**
 * Get theme options
 */
/*if( version_compare( PHP_VERSION, '7.0.0' ) <= 0 ) :
    define( 'gillion_options', '' );
else :
    define( 'gillion_options', get_option( 'gillion_settings' ) );
endif;*/

if ( ! function_exists( 'gillion_option' ) ) :
    function gillion_option( $id = NULL, $default = NULL) {

        if( is_customize_preview() && function_exists('fw_get_db_customizer_option') ) :

            $customizer_option = fw_get_db_customizer_option( $id );
            if( $customizer_option ) :
                return $customizer_option;
            elseif( !empty( $default ) ) :
                return $default;
            endif;

        elseif( function_exists('fw_get_db_settings_option') ) :

            if( in_array( $id, array( 'accent_color', 'accent_hover_color', 'header_nav_active_color', 'footer_hover_color') ) ) :

                if( $id == 'accent_color' && gillion_post_option( gillion_page_id(), 'accent_color' ) ) :
                    return gillion_post_option( gillion_page_id(), 'accent_color' );
                elseif( $id == 'accent_hover_color' && gillion_post_option( gillion_page_id(), 'accent_hover_color' ) ) :
                    return gillion_post_option( gillion_page_id(), 'accent_hover_color' );
                elseif( $id == 'header_nav_active_color' && gillion_post_option( gillion_page_id(), 'header_nav_active_color' ) ) :
                    return gillion_post_option( gillion_page_id(), 'header_nav_active_color' );
                elseif( $id == 'footer_hover_color' && gillion_post_option( gillion_page_id(), 'footer_hover_color' ) ) :
                    return gillion_post_option( gillion_page_id(), 'footer_hover_color' );
                else :
                    return fw_get_db_settings_option($id);
                endif;

            else :

                /*if( is_array( constant( 'gillion_options' ) ) ) :
                    $options = constant( 'gillion_options' );
                    $option = ( isset( $options[$id] ) ) ? $options[$id] : '';
                    unset( $options );
                else :*/
                    $option = fw_get_db_settings_option( $id );
                //endif;

                //return $option;
                if( !empty( $option ) ) :
                    return $option;
                elseif( $option === false ) :
                    return $option;
                elseif( !empty( $default ) ) :
                    return $default;
                elseif( $default === false ) :
                    return $default;
                else :
                    return false;
                endif;
            endif;

        elseif( !empty( $default ) ) :
            return $default;
        else :
            return false;
        endif;

    }
endif;


/**
 * Get theme options value
 */
if ( ! function_exists( 'gillion_option_value' ) ) :
    function gillion_option_value( $id = NULL, $key = NULL, $default = '' ) {

        if( $id && $key && function_exists('fw_get_db_settings_option') ) :
            $val = gillion_option( $id );
            if( isset( $val[$key] ) ) :
                return esc_attr( $val[$key] );
            elseif( $default ) :
                return esc_attr( $default );
            endif;
        elseif( $default ) :
            return esc_attr( $default );
        else :
            return false;
        endif;

    }
endif;


/**
 * Get theme options image
 */
if ( ! function_exists( 'gillion_option_image' ) ) :
    function gillion_option_image( $id = NULL ) {

        if( is_customize_preview() && function_exists('fw_get_db_customizer_option') ) :
            $url = fw_get_db_customizer_option( $id );
            if( isset( $url['url'] ) ) :
                return esc_url( $url['url'] );
            endif;
        elseif( function_exists('fw_get_db_settings_option') ) :
            $url = fw_get_db_settings_option( $id );
            if( isset( $url['url'] ) ) :
                return esc_url( $url['url'] );
            endif;
        else :
            return false;
        endif;

    }
endif;


/**
 * Get post thumbnail
 */
if ( ! function_exists( 'gillion_thumbnail_url' ) ) :
    function gillion_thumbnail_url( $id, $size = 'large' ) {
        if( isset( $id ) && $id > 0) :

            $thumb_id = get_post_thumbnail_id($id);
            if( $thumb_id > 0 ) :
                $thumb = wp_get_attachment_image_src( $thumb_id, $size );
                if( isset($thumb['0']) && $thumb['0'] ) :
                    return esc_url( $thumb['0'] );
                endif;
            else :
                return false;
            endif;

        else :
            return false;
        endif;
    }
endif;


/**
 * Get post thumbnail by id
 */
if ( ! function_exists( 'gillion_image_by_id' ) ) :
    function gillion_image_by_id( $id = '', $size = 'large' ) {
        if( $id > 0) :

            $thumb = wp_get_attachment_image_src( $id, $size );
            if( isset($thumb['0']) && $thumb['0'] ) :
                return esc_url( $thumb['0'] );
            endif;

        endif;
    }
endif;



/**
 * Get theme options thumbnail
 */
if ( ! function_exists( 'gillion_get_thumb' ) ) :
    function gillion_get_thumb( $id, $size = 'large' ) {
        if( isset( $id ) && $id > 0) :

            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size );
            if( isset($thumb['0']) && $thumb['0'] ) :
                return esc_url( $thumb['0'] );
            endif;

        else :
            return false;
        endif;
    }
endif;


/**
 * Get theme options thumbnail
 */
if ( ! function_exists( 'gillion_get_small_thumb' ) ) :
    function gillion_get_small_thumb( $id, $size = 'post-thumbnail' ) {
        if( isset( $id ) && $id > 0) :

            $thumb = wp_get_attachment_image_src( $id, $size );
            if( isset($thumb['0']) && $thumb['0'] ) :
                return esc_url( $thumb['0'] );
            endif;

        else :
            return false;
        endif;
    }
endif;


/**
 * Get post options
 */
if ( ! function_exists( 'gillion_post_option' ) ) :
    function gillion_post_option( $id = NULL, $name = NULL, $default = NULL) {

        if( function_exists('fw_get_db_post_option') && $id > 0 && $name ) :
            return fw_get_db_post_option( $id, $name, $default );
        elseif( !empty( $default ) ) :
            return $default;
        else :
            return false;
        endif;

    }
endif;


/**
 * Get post options
 */
if ( ! function_exists( 'gillion_term_option' ) ) :
    function gillion_term_option( $id = NULL, $taxonomy = '', $name = NULL, $default = NULL) {

        if( function_exists('fw_get_db_term_option') && $id > 0 && $taxonomy && $name ) :
            return fw_get_db_term_option( $id, $taxonomy, $name );
        elseif( !empty( $default ) ) :
            return $default;
        else :
            return false;
        endif;

    }
endif;


/**
 * Get post options
 */
if ( ! function_exists( 'gillion_term_option_image' ) ) :
    function gillion_term_option_image( $id = NULL, $taxonomy = '', $name = NULL ) {

        if( function_exists('fw_get_db_term_option') && $id > 0 && $taxonomy && $name ) :
            $image = fw_get_db_term_option( $id, $taxonomy, $name );

            if( isset( $image['url'] ) && $image['url'] ) :
                return $image['url'];
            endif;

        endif;

    }
endif;


/**
 * Get option image
 */
if ( ! function_exists( 'gillion_get_image' ) ) :
    function gillion_get_image( $id = NULL ) {

        if( isset( $id['url'] ) ) :
            return esc_url( $id['url'] );
        elseif( isset( $id[0] ) ) :
            return esc_url( $id[0] );
        else :
            return false;
        endif;

    }
endif;


/**
 * Get option image size
 */
if ( ! function_exists( 'gillion_get_image_size' ) ) :
    function gillion_get_image_size( $id, $size = 'large' ) {
        if( isset( $id['attachment_id'] ) && $id['attachment_id'] ) :

            $url = $id['attachment_id'];
            $thumb = wp_get_attachment_image_src( $url, $size );

            if( isset($thumb['0']) && $thumb['0'] ) :
                return esc_url( $thumb['0'] );
            else :
                return $id['url'];
            endif;

        else :
            return false;
        endif;
    }
endif;


/**
 * Get picker value
 */
if ( ! function_exists( 'gillion_get_picker_value' ) ) :
    function gillion_get_picker_value( $atts = NULL, $var = NULL ) {

        if( isset($atts[key($atts)]) ) :
            return $atts[key($atts)];
        else :
            return $var;
        endif;

    }
endif;


/**
 * Get picker
 */
if ( ! function_exists( 'gillion_get_picker' ) ) :
    function gillion_get_picker( $atts = NULL ) {

        if( is_array($atts) ) :
            $key = key($atts);
            if( isset($atts[$atts[$key]]) ) :
                return $atts[$atts[key($atts)]];
            else :
                return false;
            endif;
        endif;
    }
endif;


/**
 * Get font option
 */
if ( ! function_exists( 'gillion_font_option' ) ) :
    function gillion_font_option( $id ) {
        $option = gillion_option( $id );
        $o = '';

        if( isset($option['family']) && $option['family'] ) :
            $o.= 'font-family: "'.$option['family'].'"; ';
        endif;

        if( isset($option['color']) && $option['color'] ) :
            $o.= 'color: '.$option['color'].'; ';
        endif;

        if( isset($option['letter-spacing']) && $option['letter-spacing'] ) :
            $o.= 'letter-spacing: '.$option['letter-spacing'].'px; ';
        endif;

        if( isset($option['variation']) && $option['variation'] && $option['variation'] != '100' ) :
            if( $option['variation'] == 'regular' ) :
                $o.= 'font-weight: 400; ';
            else :
                $o.= 'font-weight: '.$option['variation'].'; ';
            endif;
        /*elseif( isset($option['weight']) && $option['weight'] ) :
            $o.= 'font-weight: '.$option['weight'].'; ';*/
        endif;

        if( isset($option['size']) && $option['size'] ) :
            $o.= 'font-size: '.$option['size'].'px; ';
        endif;

        if( isset($option['line-height']) && $option['line-height'] ) :
            $o.= 'line-height: '.$option['line-height'].'px; ';
        endif;

        return $o;

    }
endif;


/**
 * Get font
 */
if ( ! function_exists( 'gillion_get_font' ) ) :
    function gillion_get_font( $option ) {
        $o = '';

        if( isset($option['family']) && $option['family'] ) :
            $o.= 'font-family: "'.$option['family'].'"; ';
        endif;

        if( isset($option['color']) && $option['color'] ) :
            $o.= 'color: '.$option['color'].'; ';
        endif;

        if( isset($option['letter-spacing']) && $option['letter-spacing'] ) :
            $o.= 'letter-spacing: '.$option['letter-spacing'].'px; ';
        endif;

        if( isset($option['variation']) && $option['variation'] && $option['variation'] != '100' ) :
            if( $option['variation'] == 'regular' ) :
                $o.= 'font-weight: 400; ';
            else :
                $o.= 'font-weight: '.$option['variation'].'; ';
            endif;
        /*elseif( isset($option['weight']) && $option['weight'] ) :
            $o.= 'font-weight: '.$option['weight'].'; ';*/
        endif;

        if( isset($option['size']) && $option['size'] ) :
            $o.= 'font-size: '.$option['size'].'px; ';
        endif;

        if( isset($option['line-height']) && $option['line-height'] ) :
            $o.= 'line-height: '.$option['line-height'].'px; ';
        endif;

        return $o;

    }
endif;


/**
 * Minify output
 */
if ( ! function_exists( 'gillion_compress' ) ) :
	function gillion_compress($buf){
        return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
	}
endif;


/**
 * Count sidebar items
 */
if ( ! function_exists( 'gillion_count_sidebar' ) ) :
	function gillion_count_sidebar( $sidebar_id ) {
	    $the_sidebars  = wp_get_sidebars_widgets();

	    if( isset( $the_sidebars[$sidebar_id] ) && count( $the_sidebars[$sidebar_id] ) > 0 ) :
	        return count( $the_sidebars[$sidebar_id] );
	    endif;
	}
endif;


/**
 * Set excerpt lenght
 */
if ( ! function_exists( 'gillion_new_excerpt_length' ) ) :
	function gillion_new_excerpt_length( $length ) {
	    return gillion_option( 'post_desc', 45 );
	}
    add_filter('excerpt_length', 'gillion_new_excerpt_length', 9999 );
endif;


/**
 * Remove tags
 */
if ( ! function_exists( 'gillion_remove_tag' ) ) :
	function gillion_remove_tag( $excerpt ) {
        $o = str_replace( array("<p>", "</p>"), "", $excerpt );
        echo wp_kses_post( $o );
	}
endif;


/**
 * Remove p tags
 */
if ( ! function_exists( 'gillion_remove_p' ) ) :
	function gillion_remove_p( $text ) {
        $text = preg_replace('/\<[\/]{0,1}p[^\>]*\>/i', '', $text);
        return $text;
	}
endif;


/**
 * Replace p with span
 */
if ( ! function_exists( 'gillion_replace_p' ) ) :
    function gillion_replace_p( $text ) {
        $text = str_replace( '<p', '<span', $text );
        $text = str_replace( '</p','</span',$text);
        return $text;
    }
endif;


/**
 * Get page content structure (not wrapper structure)
 */
if ( ! function_exists( 'gillion_page_layout' ) ) :
    function gillion_page_layout( $loop = 0 ) {
        $page_layout1 = esc_attr( gillion_post_option( gillion_page_id( $loop ), 'page_layout', 'global_default' ) );
        $page_layout2 = esc_attr( gillion_option( 'global_page_layout', 'default' ) );
        return ( isset($page_layout1) && $page_layout1 && $page_layout1 != 'global_default' ) ? $page_layout1 : ( ( isset($page_layout2) && $page_layout2 ) ? $page_layout2 : 'default' );
    }
endif;


/**
 * Convert color code to rgb or rgba
 */
if ( !function_exists( 'gillion_hex2rgba' ) ) {
    function gillion_hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if already rgb
        if (strpos($color, 'rgba(') !== false) :
            if( $opacity ) :
                return str_replace( ',1)', ','.$opacity.')', $color );
            else :
                return $color;
            endif;
        endif;

        //Return default if no color provided
        if(empty($color))
            return $default;

        //Sanitize $color if "#" is provided
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return $default;
            }

            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }

            //Return rgb(a) color string
            return $output;
    }
}


/**
 * Get header layout
 */
if ( ! function_exists( 'gillion_header_layout' ) ) :
    function gillion_header_layout() {
        $header_layout1 = esc_attr( gillion_post_option( gillion_page_id(), 'header_layout', '1' ) );
        $header_layout2 = esc_attr( gillion_option( 'header_layout', '1' ) );

        if( !is_search() && !is_singular('product') && !is_archive() && !is_home() && !is_404() && !function_exists('is_bbpress') ) :
            $layout = ( isset($header_layout1) && $header_layout1 && $header_layout1 != 'default' ) ? $header_layout1 : ( ( isset($header_layout2) && $header_layout2 ) ? $header_layout2 : '1' );
        else :
            $layout = $header_layout2;
        endif;

        return ( !function_exists( 'gillion_header_showcase' ) ) ? $layout : gillion_header_showcase( $layout );
    }
endif;


/**
 * Get header style
 */
if ( ! function_exists( 'gillion_header_style' ) ) :
    function gillion_header_style() {
        $header_style_val = gillion_post_option( gillion_page_id(), 'header_style' );
        return ( isset( $header_style_val['header_style'] ) ) ? esc_attr($header_style_val['header_style']) : 'default';
    }
endif;


/**
 * Get desktop header style
 */
if ( ! function_exists( 'gillion_header_desktop_style' ) ) :
    function gillion_header_desktop_style() {
        $get_header_style = gillion_header_style();
        if( $get_header_style == 'light' || $get_header_style == 'light_mobile_off' ) :
            return ' primary-desktop-light';
        elseif( $get_header_style == 'dark' || $get_header_style == 'dark_mobile_off' ) :
            return ' primary-desktop-dark';
        endif;
    }
endif;


/**
 * Get mobile header style
 */
if ( ! function_exists( 'gillion_header_mobile_style' ) ) :
    function gillion_header_mobile_style() {
        $get_header_style = gillion_header_style();
        if( $get_header_style == 'light' ) :
            return ' primary-desktop-light';
        elseif( $get_header_style == 'dark' ) :
            return ' primary-desktop-dark';
        endif;
    }
endif;


/**
 * Determine if left header needs to be included
 */
if ( ! function_exists( 'gillion_header_page_container' ) ) :
    function gillion_header_page_container() {
        $get_header_layout = gillion_header_layout();

        if( gillion_post_option( gillion_page_id(), 'header', 'on' ) != 'off' ) :
            if( $get_header_layout == 'left-1' || $get_header_layout == 'left-2' ) :
                return 'sh-header-in-side';
            endif;
        endif;
    }
endif;


/**
 * Determine if right header needs to be included
 */
if ( ! function_exists( 'gillion_header_right' ) ) :
    function gillion_header_right() {
        $get_header_layout = gillion_header_layout();
        if( gillion_post_option( gillion_page_id(), 'header', 'on' ) != 'off' ) :
            if( $get_header_layout == 6 || $get_header_layout == 7 ) :
                return true;
            endif;
        endif;
    }
endif;



/**
 * Get header classes
 */
if ( ! function_exists( 'gillion_header_classes' ) ) :
	function gillion_header_classes( $id, $side = NULL ) {
        wp_reset_postdata();
	    $o = '';

	    if( gillion_option( 'header_nav_uppercase' ) == true ) :
	        $o.= ' sh-nav-uppercase';
	    endif;

        $sticky1 = gillion_post_option( gillion_page_id(), 'header_sticky', 'default' );
        $sticky2 = gillion_option( 'header_sticky', false );
        $sticky3 = ( isset($sticky1) && ( $sticky1 == 'on' || $sticky1 == 'off' )) ? $sticky1 : ( ( isset($sticky2) && $sticky2 == false ) ? 'off' : 'on' );
	    if( $sticky3 == 'on' ) :
	        $o.= ' sh-sticky-header';
	    endif;

	    if( $side == 1 ) :
	        echo 'sh-header-side sh-header-'.esc_attr( $id.$o );
	    else :
	        echo 'sh-header sh-header-'.esc_attr( $id.$o );
	    endif;

        $header_bottom_border = gillion_post_option( gillion_page_id(), 'header_bottom_border' );
        $page = (get_query_var('page')) ? get_query_var('page') : 1;
        $page = (get_query_var('paged')) ? get_query_var('paged') : $page;

        if( $header_bottom_border == 'off' && $page == 1 ) :
            echo ' sh-header-disabled-border';
        endif;
	}
endif;


/**
 * Get footer status
 */
if ( ! function_exists( 'gillion_footer_enabled' ) ) :
    function gillion_footer_enabled() {
        if( defined('FW') ) :
            $footer1 = gillion_post_option( gillion_page_id(), 'footer_widgets', 'on' );
            $footer2 = gillion_option( 'footer_widgets', 'on' );
            $footer3 = gillion_count_sidebar('footer-widgets1');

            if( is_category() || is_404() || is_search() ) :
                return $footer2;
            endif;

            return ( $footer3 > 0 ? ( ( isset($footer1) && ( $footer1 == 'on' || $footer1 == 'off' )) ? $footer1 : ( (isset($footer2) && $footer2 ) ? $footer2 : false) ) : false );
        else :
            return 'off';
        endif;
    }
endif;


/**
 * Get footer copyrights status
 */
if ( ! function_exists( 'gillion_copyrights_enabled' ) ) :
    function gillion_copyrights_enabled() {
        if( defined('FW') ) :
            $copyright1 = gillion_post_option( gillion_page_id(), 'copyright_bar', 'on' );
            $copyright2 = gillion_option( 'copyright_bar', 'on' );

            return ( isset($copyright1) && ( $copyright1 == 'on' || $copyright1 == 'off' )) ? $copyright1 : ( ( isset($copyright2) && $copyright2 ) ? $copyright2 : false );
        else :
            return 'on';
        endif;
    }
endif;


/**
 * Set excerpt more
 */
if ( ! function_exists( 'gillion_new_excerpt_more' ) ) :
	function gillion_new_excerpt_more( $more ) {
        return '...';
	}
	add_filter( 'excerpt_more', 'gillion_new_excerpt_more' );
endif;


/**
 * Set excerpt lenght
 */
if ( ! function_exists( 'gillion_new_excerpt_length' ) ) :
	function gillion_new_excerpt_length($length) {
	    return 30;
	}
	add_filter('excerpt_length', 'gillion_new_excerpt_length');
endif;


/**
 * Show navigation not assigned
 */
if ( ! function_exists( 'gillion_asign_menu' ) ) :
	function gillion_asign_menu() {
	    if( current_user_can( 'manage_options' ) ) : ?>
	    <div class="sh-nav-container">
	        <ul class="sh-nav">
	            <li class="menu-item">
	                <a href="<?php echo admin_url('nav-menus.php?action=edit'); ?>">
	                    <?php esc_html_e('Click here to asign menu','gillion'); ?>
	                </a>
	            </li>
	        </ul>
	    </div>
    <?php else : ?>
        <div class="sh-nav-container">
            <ul class="sh-nav">
                <li class="menu-item">
                    <a href="<?php echo admin_url('nav-menus.php?action=edit'); ?>">
                        <?php esc_html_e('Asign menu','gillion'); ?>
                    </a>
                </li>
            </ul>
        </div>
	<?php endif;
	}
endif;








/**
 * Text highlight
 */
if ( ! function_exists( 'gillion_editor_text_background' ) ) :
	add_filter( 'mce_buttons_2', 'gillion_editor_text_background' );
	function gillion_editor_text_background( $buttons ){
	    array_splice( $buttons, 2, 0, 'backcolor' );
        array_splice( $buttons, 1, 0, 'fontsizeselect' );
	    return $buttons;
	}
endif;


function gillion_customize_text_sizes($initArray){
    $initArray['fontsize_formats'] = '10px 12px 13px 14px 16px 18px 21px 24px 30px 36px 40px 48px 60px 80px 100px 120px';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'gillion_customize_text_sizes');



/**
 * Text dropcaps
 */
if ( ! function_exists( 'gillion_editor_dropcaps' ) ) :
	add_filter( 'mce_buttons_2', 'gillion_editor_dropcaps' );
	function gillion_editor_dropcaps( $buttons ) {

	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;

	}
endif;


/**
 * Text dropcaps init
 */
if ( ! function_exists( 'gillion_editor_dropcaps_init' ) ) :
	add_filter( 'tiny_mce_before_init', 'gillion_editor_dropcaps_init' );
	function gillion_editor_dropcaps_init( $settings ) {

	    $style_formats = array(
	        array(
	            'title' => esc_html__('Dropcaps','gillion'),
	            'inline' => 'span',
	            'classes' => 'sh-dropcaps',
	            'styles' => array(
	                'fontSize' => '18px',
	            )
	        ),

	        array(
	            'title' => esc_html__('Dropcaps Full Square','gillion'),
	            'inline' => 'span',
	            'classes' => 'sh-dropcaps-full-square',
                'styles' => array(
                    'fontSize' => '18px',
                )
	        ),

            array(
                'title' => esc_html__('Dropcaps Full Square With Border', 'gillion'),
                'inline' => 'span',
                'classes' => 'sh-dropcaps-full-square-border',
                'styles' => array(
                    'fontSize' => '18px',
                )
            ),

            array(
                'title' => esc_html__('Dropcaps Full Square With Tale', 'gillion'),
                'inline' => 'span',
                'classes' => 'sh-dropcaps-full-square-tale',
                'styles' => array(
                    'fontSize' => '18px',
                )
            ),

            array(
                'title' => esc_html__('Dropcaps Square With 1px Borde', 'gillion'),
                'inline' => 'span',
                'classes' => 'sh-dropcaps-square-border',
                'styles' => array(
                    'fontSize' => '18px',
                )
            ),

            array(
                'title' => esc_html__('Dropcaps Square With 2px Borde', 'gillion'),
                'inline' => 'span',
                'classes' => 'sh-dropcaps-square-border2',
                'styles' => array(
                    'fontSize' => '18px',
                )
            ),

            array(
                'title' => esc_html__('Dropcaps Cricle', 'gillion'),
                'inline' => 'span',
                'classes' => 'sh-dropcaps-circle',
                'styles' => array(
                    'fontSize' => '18px',
                )
            ),

	    );

	    $settings['style_formats'] = json_encode( $style_formats );
	    return $settings;

	}
endif;


/**
 * Get the widget
 */
if( !function_exists('gillion_get_the_widget') ) {
    function gillion_get_the_widget( $widget, $instance = '', $args = '' ){
        ob_start();
        the_widget($widget, $instance, $args);
        return ob_get_clean();
    }
}


/**
 * Add pixels if needed
 */
if ( !function_exists( 'gillion_addpx' ) ) :
    function gillion_addpx( $number ) {
        $number = $number;
        if( is_numeric($number) ) :
            return $number.'px';
        else :
            return $number;
        endif;
    }
endif;


/**
 * Show pagination
 */
if ( !function_exists( 'gillion_pagination' ) ) {
    function gillion_pagination( $wp_query = NULL, $new = 1, $oldpagination = 0, $wishlist = 0 ) {
        if( !defined('FW') || gillion_option('pagination') != 'off' ) :

            $prev_arrow = esc_html__( 'Previous', 'gillion' );
            $next_arrow = esc_html__( 'Next', 'gillion' );

            if( !$wp_query ) :
                global $wp_query;
            endif;
            $total = $wp_query->max_num_pages;
            $big = 999999999; // need an unlikely integer
            if( $total > 1 )  {
                if( !$current_page = get_query_var('paged') ) :
                    $current_page = 1;
                endif;

                if( get_option('permalink_structure') ) {
                    $format = 'page/%#%/';
                } else {
                    $format = '&paged=%#%';
                }

                if( is_front_page() ) {
                    if( get_query_var('paged') ) :
                        $page = get_query_var('paged');
                    else :
                        $page = get_query_var('page');
                    endif;
                } else {
                    $page = get_query_var('paged');
                }

                if( $oldpagination == 1 ) :
                    $base = '%_%';
                    $page = ( get_query_var('page') ) ? get_query_var('page') : 1;
                    $format = '?page=%#%';
                else :
                    $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
                endif;

                if( $wishlist == 1 ) :
                    $wishlist_page = intval( str_replace( 'page/', '', get_query_var('wishlist') ) );
                    $page = ( $wishlist_page > 0 ) ? $wishlist_page : 1;
                endif;

                if( $new ) :
                    echo '<div class="sh-pagination sh-default-color">';

                        ob_start();
                        echo paginate_links(array(
                            'base'          => $base,
                            'format'        => $format,
                            'current'       => max( 1, $page ),
                            'total'         => $total,
                            'mid_size'      => 3,
                            'type'          => 'list',
                            'prev_text'     => $prev_arrow,
                            'next_text'     => $next_arrow,
                         ) );
                        $pagination = ob_get_contents();
                        ob_end_clean();

                        if( $oldpagination == 1 ) :
                            $pagination = str_replace( "class='page-numbers' href=''>1", "class='page-numbers' href='?page=1'>1", $pagination );
                        endif;
                        echo str_replace( 'page/1/', '', $pagination );

                    echo '</div>';
                else :
                    wp_link_pages( array() );
                endif;
            }

        endif;
    }
}


/**
 * Show page links
 */
if ( !function_exists( 'gillion_page_links' ) ) :
    function gillion_page_links() {
        echo '<div class="sh-page-links">';
        wp_link_pages();
        echo '</div>';
    }
endif;


/**
 * Add default font value
 */
if ( ! function_exists( 'gillion_typography_custom' ) ):
	function gillion_typography_custom($fonts) {

        $use_default = esc_html__('Use Default Font', 'gillion');
	    array_unshift($fonts, $use_default);
	    return $fonts;
	}
	add_filter('fw_option_type_typography_v2_standard_fonts', 'gillion_typography_custom');
endif;


/**
 * Get Host
 */
function gillion_gethost($Address) {
   $parseUrl = parse_url(trim($Address));
   return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
}


/**
** WooCommerce Sales Sorting Filter
** https://lakewood.media/woocommerce-add-sales-filter/
**/
if( class_exists( 'WooCommerce' ) ) :
    if( !function_exists( 'gillion_get_catalog_ordering_args' ) ) :
        add_filter( 'woocommerce_get_catalog_ordering_args', 'gillion_get_catalog_ordering_args' );
        function gillion_get_catalog_ordering_args( $args ) {
            if( gillion_option( 'wc_sort_sale' ) == 'on' ) :
                $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

                if ( 'on_sale' == $orderby_value ) {
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = 'DESC';
                    $args['meta_key'] = '_sale_price';
                }
            endif;
            return $args;
        }
    endif;

    if( !function_exists( 'gillion_catalog_orderby' ) ) :
        add_filter( 'woocommerce_default_catalog_orderby_options', 'gillion_catalog_orderby' );
        add_filter( 'woocommerce_catalog_orderby', 'gillion_catalog_orderby' );
        function gillion_catalog_orderby( $sortby ) {
            if( gillion_option( 'wc_sort_sale' ) == 'on' ) :
                $sortby['on_sale'] = 'Sort by on sale';
            endif;
            return $sortby;
        }
    endif;
endif;
