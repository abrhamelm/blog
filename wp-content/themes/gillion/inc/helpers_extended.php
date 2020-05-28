<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Extended Helper functions
 */


 /**
  * Check If Gutenberg is being used
  */
if ( ! function_exists( 'gillion_is_gutenberg_page' ) ) :
    function gillion_is_gutenberg_page() {
        if ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) {
            // The Gutenberg plugin is on.
            return true;
        }

        if( function_exists( 'get_current_screen' ) ) :
            $current_screen = get_current_screen();
            if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) :
                // Gutenberg page on 5+.
                return true;
            endif;
        endif;

        return false;
    }
endif;


/**
 * Override toolbar margin
 */
if ( ! function_exists( 'gillion_override_toolbar_margin' ) ) :
    add_action( 'wp_head', 'gillion_override_toolbar_margin', 11 );
    function gillion_override_toolbar_margin() {
        if ( is_admin_bar_showing() ) { ?>
            <style type="text/css" media="screen">
                html { margin-top: 0px !important; }
                #page-container { padding-top: 32px !important; }
                @media (max-width: 782px) {
                    #page-container { padding-top:46px !important; }
                }
            </style>
        <?php }
    }
endif;


/**
 * Popover
 */
if ( ! function_exists( 'gillion_sticky_post' ) ) :
    function gillion_sticky_post() {
        if( is_sticky( get_the_ID() ) ) :
            echo '<i class="post-sticky icon-pin"></i>';
        endif;
    }
endif;


/**
 * Blog Overlay
 */
if ( ! function_exists( 'gillion_blog_overlay' ) ) :
    function gillion_blog_overlay( $image = '', $link = '1', $lightbox = '1', $gallery = '0', $custom_link = '', $openlightbox = '0' ) {
        if( $custom_link ) :
            $url = $custom_link;
        else :
            $url = get_permalink();
        endif;

        if( $gallery == 1 ) : ?>
            <span class="post-overlay"></span>
        <?php else : ?>
            <a href="<?php echo esc_url($url); ?>"<?php echo ( $openlightbox == 1 ) ? ' data-rel="lightcase"' : ''; ?> class="post-overlay"></a>
        <?php endif;

    }
endif;


/**
 * Blog Lightbox
 */
if ( ! function_exists( 'gillion_ligtbox' ) ) :
    function gillion_ligtbox( $image = '', $id = '' ) { ?>

        <a href="<?php echo esc_url( $image ); ?>" class="post-lightbox" data-rel="lightcase:post_gallery_<?php echo intval( $id ); ?>"></a>

    <?php }
endif;


/**
 * Share
 */
if ( ! function_exists( 'gillion_share' ) ) :
    function gillion_share( $location = '' ) {

        if( $location == 'portfolio' ) :
            echo '<div class="sh-portfolio-single-share">';
        endif;

            echo '
            <div class="sh-social-share">
                <div class="sh-social-share-button sh-noselect">
                    <i class="icon-share"></i>
                    <span>'.esc_html__( 'Share', 'gillion' ).'</span>
                </div>
                <div class="sh-social-share-networks"></div>
            </div>';

        if( $location == 'portfolio' ) :
            echo '</div>';
        endif;

    }
endif;


/**
 * Page Switch
 */
if ( ! function_exists( 'gillion_page_switch' ) ) :
    function gillion_page_switch( $prev_post = '', $content = '', $next_post = '' ) {

        echo '
        <div class="sh-page-switcher">
            <a href="#" class="sh-page-switcher-button sh-page-switcher-button-next">
                <i class="ti-arrow-left"></i>
            </a>
            <a href="#" class="sh-page-switcher-button sh-page-switcher-button-prev">
                <i class="ti-arrow-right"></i>
            </a>
        </div>';

    }
endif;


/**
 * Export categories
 */
if ( ! function_exists( 'gillion_show_categories' ) ) :
    function gillion_show_categories( $id = '', $limit = 6 ) {
        $i = 0;
        $o = '';

        if( is_single() ) :
            $limit_categories = 9999999;
        else :
            $limit_categories = 6;
        endif;

        if( $limit > 0 ) :
            $limit_categories = $limit;
        endif;

        if( !$id ) {
            $id = get_the_ID();
        }

        $categories = get_the_category( $id );
        if( $categories ) :
            foreach( $categories as $category ) :
                if( $i <= $limit_categories ) :
                    $o.= '<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>';

                    if( gillion_option('global_categories', 'style1') == 'style2' ) :
                        return wp_kses_post( $o );
                    endif;

                    $i++;
                    if( $i < count($categories) ) :
                        $o.= ', ';
                    endif;
                endif;
            endforeach;
        endif;

        if( $i > $limit_categories ) :
            $o.= '...';
        endif;

        return wp_kses_post( $o );
    }
endif;


/**
 * Export categories
 */
if ( ! function_exists( 'gillion_post_categories' ) ) :
    function gillion_post_categories( $id = '', $limit = '', $icon = '' ) {
        $categories = gillion_show_categories( $id, $limit );
        if( $categories ) :
            echo '<div class="post-categories-container">'.$icon.'
                <div class="post-categories">'.$categories.'</div>
            </div>';
        endif;
    }
endif;


/**
 * Export categories position
 */
if ( ! function_exists( 'gillion_post_categories_position' ) ) :
    function gillion_post_categories_position( $position = 'title', $id = '', $limit = '' ) {
        if( $position == gillion_option( 'global_categories_position', 'title' ) || $position == 'any' ) :

            $icon = '';
            if( gillion_option( 'global_categories', 'style1' ) == 'style2' ) :
                if( get_post_format() == 'gallery' ) :
                    $icon = '<a href="'.esc_url( get_permalink() ).'" class="post-format-icon"><i class="ti-gallery"></i></a>';
                elseif( get_post_format() == 'video' ) :
                    $icon = '<a href="'.esc_url( get_permalink() ).'" class="post-format-icon"><i class="ti-control-play"></i></a>';
                elseif( get_post_format() == 'audio' ) :
                    $icon = '<a href="'.esc_url( get_permalink() ).'" class="post-format-icon"><i class="ti-headphone"></i></a>';
                endif;
            endif;

            echo gillion_post_categories( $id, $limit, $icon );
        endif;
    }
endif;


/**
 * Navigation - search
 */
if ( ! function_exists( 'gillion_nav_wrap_search' ) ) :
    function gillion_nav_wrap_search() {

        $elements = gillion_option( 'header_elements' );
        if( isset($elements['search']) && $elements['search'] == true ) :
            return '
            <li class="menu-item sh-nav-search sh-nav-special">
                <a href="#"><i class="icon icon-magnifier"></i></a>
            </li>';
        endif;

    }
endif;


/**
 * Navigation - Side Menu
 */
if ( ! function_exists( 'gillion_nav_wrap_sidemenu' ) ) :
    function gillion_nav_wrap_sidemenu() {

        $elements = gillion_option( 'header_elements' );
        if( isset($elements['sidemenu']) && $elements['sidemenu'] == true ) :
            return '
            <li class="menu-item sh-nav-menu sh-nav-special">
                <a href="#">
                    <i class="'.gillion_option( 'header_side_menu_icon', 'icon icon-energy' ).' sh-nav-menu-icon-closed" data-attr-closed="'.gillion_option( 'header_side_menu_icon', 'icon icon-energy' ).'" data-attr-opened="ti-close"></i>
                </a>
            </li>';
        endif;
    }
endif;


/**
 * WooCommerce - Navigation update
 */
if( !function_exists( 'gillion_header_wc_header_add_to_cart_fragment' ) ) :
    add_filter( 'woocommerce_add_to_cart_fragments', 'gillion_header_wc_header_add_to_cart_fragment' );
    function gillion_header_wc_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        ?>

            <span class="sh-header-cart-count cart-icon sh-group">
                <span><?php echo WC()->cart->cart_contents_count; ?></span>
            </span>

        <?php
        $fragments['span.sh-header-cart-count'] = ob_get_clean();
        return $fragments;
    }
endif;


/**
 * WooCommerce - Navigation cart
 */
if ( ! function_exists( 'gillion_nav_wrap_cart' ) ) :
    function gillion_nav_wrap_cart( $title = NULL ) {
        $o = '';

        $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
        if ( $myaccount_page_id && gillion_option( 'wishlist', true ) == true ) :
            if ( class_exists( 'WooCommerce' ) && gillion_option( 'header_elements_shop_wishlist', false ) == true ) :

                $o.= '
                <li class="menu-item sh-nav-cart sh-nav-cart-wishlist sh-nav-special">
                    <a href="'.get_permalink( $myaccount_page_id ).'/wishlist/">
                        <div>
                            <i class="icon-heart"></i>
                        </div>
                    </a>
                </li>';

            endif;
        endif;

        if ( class_exists( 'WooCommerce' ) && gillion_option( 'header_elements_shop', false ) == true ) {
            $cart = '';
            if ( gillion_get_the_widget( 'WC_Widget_Cart', 'title= ' ) ) {
                $cart = '
                <ul class="sub-menu">
                    <li class="menu-item menu-item-cart">
                        '.gillion_get_the_widget( 'WC_Widget_Cart', 'title= ' ).'
                    </li>
                </ul>';
            }

            $o.= '
            <li class="menu-item sh-nav-cart sh-nav-special">
                <a href="'.wc_get_cart_url().'">
                    <div>
                        <i class="icon-bag"></i>
                        <span class="sh-header-cart-count cart-icon sh-group">
                            <span>'.WC()->cart->cart_contents_count.'</span>
                        </span>
                    </div>
                </a>
                '.$cart.'
            </li>';
        }

        return $o;
    }
endif;


/**
 * Show social media
 */
if ( ! function_exists( 'gillion_social_media' ) ) :
    function gillion_social_media( $location = '' ) {

        if( gillion_option('social_newtab') == true ) :
            $new_tab = ' target = "_blank" ';
        else :
            $new_tab = '';
        endif;
        $o = '';


        $elements = gillion_option( 'header_elements' );
        if( isset($elements['social']) && $elements['social'] == true ) :

            if( gillion_option('social_facebook') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_facebook') ) ).'" '.$new_tab.' class="social-media-facebook">
                    <i class="fa fa-facebook"></i>
                </a>';
            endif;

            if( gillion_option('social_twitter') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_twitter') ) ).'" '.$new_tab.' class="social-media-twitter">
                    <i class="fa fa-twitter"></i>
                </a>';
            endif;

            if( gillion_option('social_googleplus') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_googleplus') ) ).'" '.$new_tab.' class="social-media-gplus">
                    <i class="fa fa-google-plus"></i>
                </a>';
            endif;

            if( gillion_option('social_instagram') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_instagram') ) ).'" '.$new_tab.' class="social-media-instagram">
                    <i class="fa fa-instagram"></i>
                </a>';
            endif;

            if( gillion_option('social_pinterest') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_pinterest') ) ).'" '.$new_tab.' class="social-media-pinterest">
                    <i class="fa fa-pinterest"></i>
                </a>';
            endif;

            if( gillion_option('social_tumblr') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_tumblr') ) ).'" '.$new_tab.' class="social-media-tumblr">
                    <i class="fa fa-tumblr"></i>
                </a>';
            endif;

            if( gillion_option('social_youtube') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_youtube') ) ).'" '.$new_tab.' class="social-media-youtube">
                    <i class="fa fa-youtube"></i>
                </a>';
            endif;

            if( gillion_option('social_dribbble') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_dribbble') ) ).'" '.$new_tab.' class="social-media-dribbble">
                    <i class="fa fa-dribbble"></i>
                </a>';
            endif;

            if( gillion_option('social_linkedIn') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_linkedIn') ) ).'" '.$new_tab.' class="social-media-linkedin">
                    <i class="fa fa-linkedin"></i>
                </a>';
            endif;

            if( gillion_option('social_skype') ) :
                $o.= '<a href="skype:'.esc_attr( ltrim( gillion_option('social_skype') ) ).'?chat" '.$new_tab.' class="social-media-skype">
                    <i class="fa fa-skype"></i>
                </a>';
            endif;

            if( gillion_option('social_spotify') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_spotify') ) ).'" '.$new_tab.' class="social-media-spotify">
                    <i class="fa fa-spotify"></i>
                </a>';
            endif;

            if( gillion_option('social_soundcloud') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_soundcloud') ) ).'" '.$new_tab.' class="social-media-soundcloud">
                    <i class="fa fa-soundcloud"></i>
                </a>';
            endif;

            if( gillion_option('social_flickr') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_flickr') ) ).'" '.$new_tab.' class="social-media-flickr">
                    <i class="fa fa-flickr"></i>
                </a>';
            endif;

            if( gillion_option('social_wordpress') ) :
                $o.= '<a href="'.esc_url( ltrim( gillion_option('social_wordpress') ) ).'" '.$new_tab.' class="social-media-wordpress">
                    <i class="fa fa-wordpress"></i>
                </a>';
            endif;

            if( is_array( gillion_option('social_custom') ) ) :
                foreach( gillion_option('social_custom') as $social ) :
                    $o.= '<a href="'.esc_url( ltrim( $social['link'] ) ).'" '.$new_tab.' class="social-media-wordpress">
                        <i class="'.esc_attr( $social['icon'] ).'"></i>
                    </a>';
                endforeach;
            endif;
        endif;

        $o.= gillion_header_login( $elements );

        if( $location != 'footer' ) :
            $o.= '<div class="sh-clear"></div>';
        endif;

        return $o;
    }

endif;




/**
 * Header Login Button
 */
if ( ! function_exists( 'gillion_header_login' ) ) :
    function gillion_header_login( $elements ) {
        if( isset($elements['login']) && $elements['login'] == true ) :

            if( !is_user_logged_in() ) :
                return '<a href="#login-register" class="sh-login-popup sh-login-popup-trigger">'.esc_html__('Log in','gillion').'</a>';
            else :
                return '<a href="'.wp_logout_url( get_permalink() ).'" class="sh-login-popup">'.esc_html__('Log out','gillion').'</a>';
            endif;

        endif;
    }
endif;


/**
 * Navigation - Side Menu
 */
if ( ! function_exists( 'gillion_nav_wrap_share' ) ) :
    function gillion_nav_wrap_share() {

        if( gillion_option('social_newtab') == true ) :
            $new_tab = ' target = "_blank" ';
        else :
            $new_tab = '';
        endif;
        $o = array();

        if( gillion_option('social_facebook') ) :
            $o[]= '<li class="sh-share-item sh-share-item-facebook menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_facebook') ) ).'" '.$new_tab.'>
                    <i class="fa fa-facebook"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_twitter') ) :
            $o[]= '<li class="sh-share-item sh-share-item-twitter menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_twitter') ) ).'" '.$new_tab.'>
                    <i class="fa fa-twitter"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_googleplus') ) :
            $o[]= '<li class="sh-share-item sh-share-item-googleplus menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_googleplus') ) ).'" '.$new_tab.'>
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_instagram') ) :
            $o[]= '<li class="sh-share-item sh-share-item-instagram menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_instagram') ) ).'" '.$new_tab.'>
                    <i class="fa fa-instagram"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_youtube') ) :
            $o[]= '<li class="sh-share-item sh-share-item-youtube menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_youtube') ) ).'" '.$new_tab.'>
                    <i class="fa fa-youtube"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_pinterest') ) :
            $o[]= '<li class="sh-share-item sh-share-item-pinterest menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_pinterest') ) ).'" '.$new_tab.'>
                    <i class="fa fa-pinterest"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_tumblr') ) :
            $o[]= '<li class="sh-share-item sh-share-item-tumblr menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_tumblr') ) ).'" '.$new_tab.'>
                    <i class="fa fa-tumblr"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_dribbble') ) :
            $o[]= '<li class="sh-share-item sh-share-item-dribbble menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_dribbble') ) ).'" '.$new_tab.'>
                    <i class="fa fa-dribbble"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_linkedIn') ) :
            $o[]= '<li class="sh-share-item sh-share-item-linkedin menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_linkedIn') ) ).'" '.$new_tab.'>
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_skype') ) :
            $o[]= '<li class="sh-share-item sh-share-item-skype menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_skype') ) ).'" '.$new_tab.'>
                    <i class="fa fa-skype"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_spotify') ) :
            $o[]= '<li class="sh-share-item sh-share-item-spotify menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_spotify') ) ).'" '.$new_tab.'>
                    <i class="fa fa-spotify"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_soundcloud') ) :
            $o[]= '<li class="sh-share-item sh-share-item-soundcloud menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_soundcloud') ) ).'" '.$new_tab.'>
                    <i class="fa fa-soundcloud"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_flickr') ) :
            $o[]= '<li class="sh-share-item sh-share-item-flickr menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_flickr') ) ).'" '.$new_tab.'>
                    <i class="fa fa-flickr"></i>
                </a>
            </li>';
        endif;

        if( gillion_option('social_wordpress') ) :
            $o[]= '<li class="sh-share-item sh-share-item-wordpress menu-item">
                <a href="'.esc_url( ltrim( gillion_option('social_wordpress') ) ).'" '.$new_tab.'>
                    <i class="fa fa-wordpress"></i>
                </a>
            </li>';
        endif;

        if( is_array( gillion_option('social_custom') ) ) :
            foreach( gillion_option('social_custom') as $social ) :
                $o[]= '<li class="sh-share-item sh-share-item-wordpress menu-item">
                    <a href="'.esc_url( ltrim( $social['link'] ) ).'" '.$new_tab.' class="social-media-wordpress">
                        <i class="'.esc_attr( $social['icon'] ).'"></i>
                    </a>
                </li>';
            endforeach;
        endif;

    $output = '';
    if( count( $o ) ) :
        foreach( $o as $icon ) :
            $output.= $icon;
        endforeach;
    endif;


        if( gillion_option( 'header_elements_social_share', 'on' ) == 'on'  ) :
            return '
            <li class="menu-item menu-item-has-children sh-nav-share sh-nav-special">
            	<a href="#">
            		<div>
            			<i class="icon icon-share"></i>
            		</div>
            	</a>
            	<ul class="sub-menu sh-nav-share-ul">
            		'.$output.'
            	</ul>
            </li>';
        endif;

    }
endif;

/**
 * Navigation - Login Menu
 */
if ( ! function_exists( 'gillion_nav_wrap_login' ) ) :
    function gillion_nav_wrap_login() {
        $elements = gillion_option( 'header_elements' );
        if( isset($elements['login_icon']) && $elements['login_icon'] == true ) :
            if( !is_user_logged_in() ) :
                return '
                <li class="menu-item sh-nav-login sh-nav-special">
                	<a href="#login-register" class="sh-login-popup-trigger">
                		<i class="icon icon-login"></i>
                	</a>
                </li>';
            else :
                return '
                <li class="menu-item sh-nav-login sh-nav-special">
                	<a href="'.wp_logout_url( get_permalink() ).'">
                		<i class="icon icon-logout"></i>
                	</a>
                </li>';
            endif;
        endif;
    }
endif;


/**
 * Navigation - Side Menu
 */
if ( ! function_exists( 'gillion_nav_wrap_readlater' ) ) :
    function gillion_nav_wrap_readlater( $mobile = 0 ) {
        if( gillion_option( 'blog_bookmarks', 'style_title' ) != 'disabled'  ) :
            ob_start("gillion_compress");
                if( is_user_logged_in() ) :
                	$read_later_posts2 = get_user_meta( get_current_user_id(), 'gillion_read_it_later' );
                    if( is_array( $read_later_posts2 ) ) :
                        $read_later_posts2 = array_reverse( $read_later_posts2 );
                    else :
                        $read_later_posts2 = array();
                    endif;
                else :
                    $read_later_posts2 = array();
                endif;

                if( count( $read_later_posts2 ) > 0 ) :
                    $read_later_posts = array();
                    foreach( $read_later_posts2 as $post_id ) :
                        if( get_post_status( $post_id ) == 'publish' ) :
                            $read_later_posts[] = $post_id;
                        endif;
                    endforeach;
                endif;

                if( !isset( $read_later_posts ) ) :
                    $read_later_posts = array();
                endif;
            ?>
            <li class="menu-item menu-item-has-children sh-nav-readmore sh-nav-special">
            	<a href="<?php echo home_url( '/' ); ?>?read-it-later">
            		<div>
            			<i class="ti-bookmark"></i>
            			<span class="sh-read-later-total"><?php echo count($read_later_posts); ?></span>
            		</div>
            	</a>
                <?php if( $mobile == 0 ) : ?>
                	<ul class="sub-menu sh-read-later-list sh-read-later-list-init">
                        <?php if( is_user_logged_in() ) : ?>
                    		<?php foreach( $read_later_posts as $id ) :
                                    if( is_string( get_post_status( $id ) ) ) :
                    				    $review = gillion_post_review_score( $id );
                    			?>
                    			<li class="sh-read-later-item menu-item" data-id="<?php echo esc_attr( $id ); ?>">
                    				<a href="<?php echo get_permalink( $id ); ?>">
                    					<div class="sh-read-later-thumbnail" data-lazy-background="<?php echo gillion_thumbnail_url( $id, 'gillion-square-micro' ); ?>">
                    						<span class="sh-read-later-delete">
                    							<i class="icon icon-close"></i>
                    						</span>
                    						<?php if( $review > 0 ) :
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
                                            ?>
                    							<span class="sh-read-later-review"<?php echo wp_kses_post( $color_out ); ?>>
                    								<div class="sh-read-later-review-score">
                    									<?php echo wp_kses_post( $review ); ?>
                    								</div>
                    							</span>
                    						<?php endif; ?>
                    					</div>
                    					<div class="sh-read-later-content">
                    						<h5 class="sh-read-later-link" data-href="<?php echo get_permalink( $id ); ?>"><?php echo get_the_title( $id ); ?></h5>
                    					</div>
                    				</a>
                    			</li>
                    		<?php endif; endforeach; ?>
                        <?php else : ?>
                            <li class="sh-read-later-item menu-item text-center">
                                <a href="<?php echo home_url( '/' ); ?>?read-it-later">
                                    <?php esc_html_e( 'Login to add posts to your read later list', 'gillion' ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                	</ul>
                <?php endif; ?>
            </li>
    <?php ob_end_flush();
endif;
    }
endif;












/**
 * Navigation - social
 */
if ( ! function_exists( 'gillion_nav_wrap_social' ) ) :
    function gillion_nav_wrap_social() {

        $elements = gillion_option( 'header_elements' );
        if( isset($elements['social']) && $elements['social'] == true ) :
            return '
            <li class="menu-item sh-nav-social sh-nav-special">
                '.gillion_social_media().'
            </li>';
        endif;

    }
endif;


/**
 * Show search form
 */
if ( !function_exists( 'gillion_search_form' ) ) {
    function gillion_search_form( $form ) {

        $form = '
            <form method="get" class="search-form" action="' . esc_url( home_url('/') ) . '">
                <div>
                    <label>
                        <input type="search" class="sh-sidebar-search search-field" placeholder="'.esc_html__( 'Search here...', 'gillion' ).'" value="" name="s" title="' . esc_html__( 'Search text', 'gillion' ) . '" required />
                    </label>
                    <button type="submit" class="search-submit">
                        <i class="icon-magnifier"></i>
                    </button>
                </div>
            </form>';
        return $form;
    }
    add_filter( 'get_search_form', 'gillion_search_form' );
}


/**
 * Get logo height
 */
if ( !function_exists( 'gillion_logo_height' ) ) {
    function gillion_logo_height( $type = NULL ) {
        $logo_sizes_val = gillion_option( 'header_logo_sizes' );
        $logo_sizes_atts = gillion_get_picker( $logo_sizes_val );

        if( $type == 'responsive' ) :

            if( isset($logo_sizes_atts['responsive_height']) && $logo_sizes_atts['responsive_height'] > 0 ) :
                return intval( $logo_sizes_atts['responsive_height'] ).'px';
            else :
                return 'auto';
            endif;

        elseif( $type == 'sticky' ) :

            if( isset($logo_sizes_atts['sticky_height']) && $logo_sizes_atts['sticky_height'] > 0 ) :
                return intval( $logo_sizes_atts['sticky_height'] ).'px';
            else :
                return 'auto';
            endif;

        else :

            if( isset($logo_sizes_atts['standard_height']) && $logo_sizes_atts['standard_height'] > 0 ) :
                return intval( $logo_sizes_atts['standard_height'] ).'px';
            else :
                return 'auto';
            endif;

        endif;
    }
}


/**
 * Header Logo
 */
if( !function_exists('gillion_header_logo') ) :
    function gillion_header_logo() {

        $standard_logo = gillion_option_image('logo');

        /* Use Gillion Logo if Logo is not uploaded */
        if( !$standard_logo ) :
            $standard_logo = get_template_directory_uri().'/img/logo.png';
        endif;

        $sticky_logo = ( gillion_option_image('logo_sticky') ) ? gillion_option_image('logo_sticky') : $standard_logo;
        $light_logo = ( gillion_option_image('logo_light') ) ? gillion_option_image('logo_light') : $standard_logo;

        if( gillion_logo_height() && gillion_logo_height() != 'auto' ) :
            $height = ' height="'.str_replace("px", "", gillion_logo_height() ).'"';
        else :
            $height = '';
        endif;
    ?>
        <div class="header-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-container sh-table-small">
                <div class="sh-table-cell">

                    <img class="sh-standard-logo" src="<?php echo esc_url( $standard_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo esc_attr( $height ); ?> />
                    <img class="sh-sticky-logo" src="<?php echo esc_url( $sticky_logo ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"<?php echo esc_attr( $height ); ?> />
                    <img class="sh-light-logo" src="<?php echo esc_url( $light_logo ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"<?php echo esc_attr( $height ); ?> />

                </div>
            </a>
        </div>

    <?php }
endif;


/**
 * Get excerpt
 */
if ( !function_exists( 'gillion_get_excerpt' ) ) {
    function gillion_get_excerpt( $count, $string ){

        $excerpt = $string;
        $excerpt = strip_tags($excerpt);
        $excerpt = wp_trim_words($excerpt, $count);

        return $excerpt;

    }
}


/**
 * Get posts count
 */
if ( !function_exists( 'gillion_count_posts' ) ) :
    function gillion_count_posts() {

        $post_count = 1;
        $post_ok = false;
        $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1, 'fields' => 'ids', 'order' => 'ASC' ) );
        if( $posts->have_posts() ) :
            $current_post = $posts->post_count;
            foreach ( $posts->posts as $id ) :

                if( $id == get_the_ID() ) :
                    $post_ok = true;
                elseif( $post_ok == false ) :
                    $post_count++;
                endif;

            endforeach;
            return '<strong>'.$post_count.'</strong> / '.$posts->post_count.'';
        endif;

    }
endif;


/**
 * Convert color code to rgb or rgba
 */
if ( !function_exists( 'gillion_hex2rgba' ) ) {
    function gillion_hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

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
 * Show breadcrumbs tree
 */
if ( !function_exists( 'gillion_breadcrumbs' ) ) {
    function gillion_breadcrumbs( $args = array() ) {
        // Do not display on the homepage

        // Set default arguments
        $defaults = array(
            'separator_icon'      => '&gt;',
            'breadcrumbs_id'      => 'breadcrumbs',
            'breadcrumbs_classes' => 'breadcrumb-trail breadcrumbs',
            'home_title'          =>  esc_html__( 'Home', 'gillion' ),
        );
        // Parse any arguments added
        $args = apply_filters( 'ct_ignite_breadcrumbs_args', wp_parse_args( $args, $defaults ) );
        // Set variable for adding separator markup
        $separator = '<span class="separator"> ' . esc_attr( $args['separator_icon'] ) . ' </span>';
        // Get global post object
        global $post;
        /***** Begin Markup *****/
        // Open the breadcrumbs
        $html = '<div id="' . esc_attr( $args['breadcrumbs_id'] ) . '" class="' . esc_attr( $args['breadcrumbs_classes']) . '">';
        // Add Homepage link & separator (always present)
        $html .= '<span class="item-home"><a class="bread-link bread-home" href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( $args['home_title'] ) . '">' . esc_attr( $args['home_title'] ) . '</a></span>';

        if ( !is_front_page() ) {
            $html .= $separator;
        }
        // Post

        if ( is_front_page() ) {
            //return;
        } elseif ( is_singular( 'post' ) ) {
            // Get post category info
            $category = get_the_category();
            // Get category values
            $category_values = array_values( $category );
            // Get last category post is in
            $last_category = end( $category_values );
            // Get parent categories
            $cat_parents = rtrim( (string)get_category_parents( $last_category->term_id, true, ',' ), ',' );
            // Convert into array
            $cat_parents = explode( ',', $cat_parents );
            // Loop through parent categories and add to breadcrumb trail
            foreach ( $cat_parents as $parent ) {
                $html .= '<span class="item-cat">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</span>';
                $html .= $separator;
            }
            // add name of Post
            $html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></span>';
        } // Page
        elseif ( is_singular( 'page' ) ) {
            // if page has a parent page
            if ( $post->post_parent ) {
                // Get all parents
                $parents = get_post_ancestors( $post->ID );
                // Sort parents into the right order
                $parents = array_reverse( $parents );
                // Add each parent to markup
                foreach ( $parents as $parent ) {
                    $html .= '<span class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . get_permalink( $parent ) . '" title="' . get_the_title( $parent ) . '">' . get_the_title( $parent ) . '</a></span>';
                    $html .= $separator;
                }
            }
            // Current page
            $html .= '<span class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></span>';
        } // Attachment
        elseif ( is_singular( 'attachment' ) ) {
            // Get the parent post ID
            $parent_id = $post->post_parent;
            // Get the parent post title
            $parent_title = get_the_title( $parent_id );
            // Get the parent post permalink
            $parent_permalink = get_permalink( $parent_id );
            // Add markup
            $html .= '<span class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . esc_attr( $parent_title ) . '</a></span>';
            $html .= $separator;
            // Add name of attachment
            $html .= '<span class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></span>';
        } // Custom Post Types
        elseif ( is_singular() ) {
            // Get the post type
            $post_type = get_post_type();
            // Get the post object
            $post_type_object = get_post_type_object( $post_type );
            // Get the post type archive
            $post_type_archive = get_post_type_archive_link( $post_type );
            // Add taxonomy link and separator
            $html .= '<span class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></span>';
            $html .= $separator;
            // Add name of Post
            $html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . $post->post_title . '">' . $post->post_title . '</span></span>';
        } // Category
        elseif ( is_category() ) {
            // Get category object
            $parent = get_queried_object()->category_parent;
            // If there is a parent category...
            if ( $parent !== 0 ) {
                // Get the parent category object
                $parent_category = get_category( $parent );
                // Get the link to the parent category
                $category_link = get_category_link($parent);
                // Output the markup for the parent category item
                $html .= '<span class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_attr( $parent_category->name ) . '</a></span>';
                $html .= $separator;
            }
            // Add category markup
            $html .= '<span class="item-current item-cat"><span class="bread-current bread-cat" title="' . $post->ID . '">' . single_cat_title( '', false ) . '</span></span>';
        } // Tag
        elseif ( is_tag() ) {
            // Add tag markup
            $html .= '<span class="item-current item-tag"><span class="bread-current bread-tag">' . single_tag_title( '', false ) . '</span></span>';
        } // Author
        elseif ( is_author() ) {
            // Add author markup
            $html .= '<span class="item-current item-author"><span class="bread-current bread-author">' . get_queried_object()->display_name . '</span></span>';
        } // Day
        elseif ( is_day() ) {
            // Add day markup
            $html .= '<span class="item-current item-day"><span class="bread-current bread-day">' . get_the_date() . '</span></span>';
        } // Month
        elseif ( is_month() ) {
            // Add month markup
            $html .= '<span class="item-current item-month"><span class="bread-current bread-month">' . get_the_date( 'F Y' ) . '</span></span>';
        } // Year
        elseif ( is_year() ) {
            // Add year markup
            $html .= '<span class="item-current item-year"><span class="bread-current bread-year">' . get_the_date( 'Y' ) . '</span></span>';
        } // Custom Taxonomy
        elseif ( is_archive() ) {
            // get the name of the taxonomy
            $custom_tax_name = get_queried_object()->name;
            // Add markup for taxonomy
            $html .= '<span class="item-current item-archive"><span class="bread-current bread-archive">' . esc_attr($custom_tax_name) . '</span></span>';
        } // Search
        elseif ( is_search() ) {
            // Add search markup
            $html .= '<span class="item-current item-search"><span class="bread-current bread-search">'. esc_html__( 'Search results for', 'gillion' ) .': ' . get_search_query() . '</span></span>';
        } // 404
        elseif ( is_404() ) {
            // Add 404 markup
            $html .= '<span>' . esc_html__( 'Error 404', 'gillion' ) . '</span>';
        } elseif( is_home() && isset( $_GET['read-it-later'] ) ) {
            // Add read later markup
            $html .= '<span>' . esc_html__( 'Read It Later', 'gillion' ) . '</span>';
        } else {
            $html .= '<span class="item-current"><span class="bread-current">' . esc_attr( get_the_title( gillion_page_id() ) ) . '</span></span>';
        }


        // Close breadcrumb container
        $html .= '</div>';
        apply_filters( 'ct_ignite_breadcrumbs_filter', $html );
        return ( $html );
    }
}


/**
 * Admin panel - load styles and scripts in theme options
 */
if( !function_exists('gillion_admin_enqueue_styles') && is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'fw-settings' ) :

    function gillion_admin_enqueue_styles() {
        wp_enqueue_style( 'gillion-theme-options', get_template_directory_uri() . '/css/admin/theme-options.css' );
        wp_enqueue_script( 'gillion-jquery-cookie', get_template_directory_uri() . '/js/plugins/jquery.cookie.js', array( 'jquery' ) );
        wp_enqueue_script( 'gillion-theme-options', get_template_directory_uri() . '/js/admin/theme-options.js', array( 'jquery' ) );
    }
    add_action( 'admin_enqueue_scripts', 'gillion_admin_enqueue_styles' );

endif;


/**
 * Admin panel - load custom styles for revolution slider plugin
 */
if( !function_exists('gillion_admin_enqueue_styles_revslider') && is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'revslider' ) :

    function gillion_admin_enqueue_styles_revslider() {
        wp_enqueue_style( 'gillion-theme-options', get_template_directory_uri() . '/css/admin/revslider.css' );
    }
    add_action( 'admin_enqueue_scripts', 'gillion_admin_enqueue_styles_revslider' );

endif;


/**
 * Admin panel - load styles in posts
 */
global $pagenow;
if( !function_exists('gillion_admin_enqueue_styles') && is_admin() &&
( ( isset( $_GET['post'] ) && $_GET['post'] > 0 ) || ( isset( $_GET['post_id'] ) && $_GET['post_id'] > 0 ) || ( $pagenow == 'post-new.php' ) ) ) :

    function gillion_admin_enqueue_styles() {
        wp_enqueue_style( 'gillion-theme-options', get_template_directory_uri() . '/css/admin/theme-options-editor.css' );
        wp_enqueue_style( 'gillion-theme-vc', get_template_directory_uri() . '/css/admin/vc.css' );
        wp_enqueue_script( 'gillion-theme-options', get_template_directory_uri() . '/js/admin/vc.js', array( 'jquery' ) );
    }
    add_action( 'admin_enqueue_scripts', 'gillion_admin_enqueue_styles' );

endif;


/**
 * Admin panel - load icons
 */
if ( ! function_exists( 'gillion_admin_styling' ) ) :
    function gillion_load_custom_wp_admin_style() {
        wp_enqueue_style( 'gillion-simple-icons', get_template_directory_uri() . '/css/plugins/simple-line-icons.css', false, '1.0.0' );
        wp_enqueue_style( 'gillion-themify-icons', get_template_directory_uri() . '/css/plugins/themify-icons.css', false, '1.0.0' );
        wp_enqueue_style( 'gillion-pixeden-icons', get_template_directory_uri() . '/css/plugins/pe-icon-7-stroke.css', false, '1.0.0' );
    }
    add_action( 'admin_enqueue_scripts', 'gillion_load_custom_wp_admin_style' );
endif;


/**
 * Admin panel - Customizer Styling
 */
function gillion_customizer_styles() { ?>
	<style>
        .fw-backend-option {
            opacity: 1!important;
        }

        .fw-backend-customizer-option .button.wp-color-result > .color-alpha {
            height: 28px!important;
        }

        .customize-control h3.sh-custom-group-divder {
            font-size: 24px!important;
            margin-bottom: 0px!important;
            line-height: 1.1!important;
        }

        <?php /* Fix for Unyson Framework 2.7.9 color picker issue */
        if( is_admin() && defined( 'FW' ) && defined('WP_PLUGIN_DIR') ) :
            $unyson = get_plugin_data( WP_PLUGIN_DIR. '/unyson/unyson.php' );
            if( isset( $unyson['Version'] ) && $unyson['Version'] == '2.7.9' ) : ?>

                .fw-backend-option-input-type-rgba-color-picker .wp-color-result span {
                    border: 1px solid rgba(16, 16, 16, 0.32)!important;
                }

                .fw-backend-option-input-type-rgba-color-picker .wp-color-result{
                    display: block;
                    width: 152px!important;
                    max-width: 152px!important;
                    height: 19px !important;
                    position: relative;
                }

                .fw-backend-option-input-type-rgba-color-picker .iris-palette {
                    height: 19.5784px!important;
                    width: 19.5784px!important;
                }

            <?php elseif( isset( $unyson['Version'] ) && version_compare( $unyson['Version'], '2.7.9', '>' ) ) : ?>

                .wp-picker-container input[type=text].wp-color-picker {
                    display: inline-block!important;
                }

                .wp-picker-container .wp-color-result {
                    vertical-align: top;
                }

            <?php endif;
        endif; ?>
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'gillion_customizer_styles', 999 );


/**
 * Admin panel - TinyMCE Styling
 */
function gillion_tiny_mce_styling( $mceInit ) {
    $guttenberg_body = ( gillion_is_gutenberg_page() ) ? ' .wp-block-freeform.block-library-rich-text__tinymce' : '';
    $body_font = gillion_option_value('styling_body','family');
    $body_color = gillion_option_value('styling_body','color');
    $single_content_size = gillion_option('styling_single_content_size', '15');
    ob_start(); ?>

    html body <?php echo esc_attr( $guttenberg_body ); ?> {
        font-family: <?php echo esc_attr( $body_font ); ?>;
        color: <?php echo esc_attr( $body_color ); ?>;
        font-size: <?php echo esc_attr( $single_content_size ); ?>px;
    }

    <?php if( isset( $headings ) ) : ?>
        body <?php echo esc_attr( $guttenberg_body ); ?> h1,
    	body <?php echo esc_attr( $guttenberg_body ); ?> h2,
    	body <?php echo esc_attr( $guttenberg_body ); ?> h3,
    	body <?php echo esc_attr( $guttenberg_body ); ?> h4,
    	body <?php echo esc_attr( $guttenberg_body ); ?> h5,
    	body <?php echo esc_attr( $guttenberg_body ); ?> h6 {
    		<?php echo wp_kses_post( $headings ); ?>
    	}
    <?php endif; ?>

    <?php
    $styles = gillion_compress( ob_get_clean() );
    if( !isset( $mceInit['content_style'] ) ) :
        $mceInit['content_style'] = $styles . ' ';
    else :
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    endif;

    return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'gillion_tiny_mce_styling' );


/**
 * Admin panel - TinyMCE Fonts
 */
function gillion_tiny_mce_fonts( $mce_css ) {

    $fonts_url = '';
    $enqueue_fonts = array();
    $google_fonts = function_exists('fw_get_google_fonts') ? fw_get_google_fonts() : '';
	$typography1 = gillion_option('styling_body');
	$typography2 = gillion_option('styling_headings');

	if( isset($google_fonts[$typography1['family']]) ) :
	    $enqueue_fonts[$typography1['family']] = $google_fonts[$typography1['family']];
	endif;
	if( isset($google_fonts[$typography2['family']]) ) :
	    $enqueue_fonts[$typography2['family']] = $google_fonts[$typography2['family']];
	endif;

	if( count( $enqueue_fonts) ) :
		$font_families = array();
		foreach ( $enqueue_fonts as $font => $styles ) :
		    $font_families[] = str_replace( ' ', '+', esc_attr($font) ) . ':' . implode( ',', $styles['variants'] );
		endforeach;

		$subset = gillion_option( 'google_fonts_subset', 'gillion' );
		if( count( $subset ) < 1 ) :
			$subset = array( 'latin' );
		endif;

		if( count($font_families) > 0 ) {
			$fonts_args = array(
				'family' => implode( '%7C', $font_families ),
				'subset' => implode( ',', array_keys($subset) ),
			);
			$fonts_url = esc_url( add_query_arg( $fonts_args, 'https://fonts.googleapis.com/css' ) );
		}
	endif;

    if( $fonts_url ) :
        $mce_css.= ', '.str_replace( ',', '%2C', $fonts_url );
    endif;
    return $mce_css;

}
add_filter( 'mce_css', 'gillion_tiny_mce_fonts' );


/**
 * Admin panel - styling
 */
if ( ! function_exists( 'gillion_admin_styling' ) ) :
    add_action('admin_head', 'gillion_admin_styling');
    function gillion_admin_styling() { ?>
        <?php
            /*
            * Gutenberg - Page Settings option reset to default fix
            */
        ?>
        <script type="text/javascript">
            <?php if( gillion_is_gutenberg_page() ) : ?>

                var GuttenbergPageSettingsFixAdded = 0;
                jQuery( function($) {

                    // while content is loading
                    function GuttenbergPageSettingsFix(){
                        if( document.readyState != "complete" ) {
                            if( $('#fw-options-box-page_settings ul.ui-tabs-nav.ui-widget-header > li').length ) {
                                $('#fw-options-box-page_settings ul.ui-tabs-nav.ui-widget-header > li').each( function() {
                                    $(this).find('a').trigger( 'click' );
                                });
                                $('#fw-options-box-page_settings ul.ui-tabs-nav.ui-widget-header > li:first-child > a').trigger( 'click' );
                                GuttenbergPageSettingsFixAdded++;
                                // console.log( 'tabs ready' );
                            }

                            if( GuttenbergPageSettingsFixAdded == 0 ) {
                                setTimeout( GuttenbergPageSettingsFix, 15 );
                            }
                        }
                    }
                    GuttenbergPageSettingsFix();


                    // when content is loaded
                    jQuery( window ).load( function() {
                        if( GuttenbergPageSettingsFixAdded == 0 ) {
                            $('#fw-options-box-page_settings ul.ui-tabs-nav.ui-widget-header > li').each( function() {
                                $(this).find('a').trigger( 'click' );
                            });
                            $('#fw-options-box-page_settings ul.ui-tabs-nav.ui-widget-header > li:first-child > a').trigger( 'click' );
                            // console.log( 'tabs ready' );
                            GuttenbergPageSettingsFixAdded++;
                        }
                    });
                });
            <?php endif; ?>
        </script>


        <script type="text/javascript">
            /* Visual Composer 5.2 Version undefined vc_js function fix */
            function vc_js() { }
            function htmlDecode(value) {
               return (typeof value === 'undefined') ? '' : jQuery('<div/>').html(value).text();
            }

            jQuery(function($){

                /* Post format meta box show */
                <?php if( gillion_is_gutenberg_page() ) : ?>

                    jQuery( window ).load( function() {
                        var post_format = $('.editor-post-format .editor-post-format__content select option:selected').val();
                        if( post_format != 0 ) {
                            $('#fw-options-box-post-format-0').hide();
                            $('#fw-options-box-post-format-gallery').hide();
                            $('#fw-options-box-post-format-quote').hide();
                            $('#fw-options-box-post-format-link').hide();
                            $('#fw-options-box-post-format-video').hide();
                            $('#fw-options-box-post-format-audio').hide();
                            $('#fw-options-box-post-format-'+post_format).show();

                            if( post_format == 'standard' ) {
                                $('#fw-options-box-post-format-0').show();
                            }
                        }

                        $('.editor-post-format .editor-post-format__content select').on( 'change', function() {
                            var post_format_change = $(this).find('option:selected').val();
                            $('#fw-options-box-post-format-0').hide();
                            $('#fw-options-box-post-format-gallery').hide();
                            $('#fw-options-box-post-format-quote').hide();
                            $('#fw-options-box-post-format-link').hide();
                            $('#fw-options-box-post-format-video').hide();
                            $('#fw-options-box-post-format-audio').hide();
                            $('#fw-options-box-post-format-'+ post_format_change ).show();

                            if( post_format_change == 'standard' ) {
                                $('#fw-options-box-post-format-0').show();
                            }
                        });
                    });

                <?php else : ?>

                    var post_format = $('input[name=post_format]:checked', '#post-formats-select').val();
                    if( post_format != 0 ) {
                        $('#fw-options-box-post-format-'+post_format).show();
                    } else {
                        $('#fw-options-box-post-format-0').show();
                    }

                    $('input[name=post_format]').on( 'change', function() {
                        var post_format_change = $(this).val();

                        $('#fw-options-box-post-format-0').hide();
                        $('#fw-options-box-post-format-gallery').hide();
                        $('#fw-options-box-post-format-quote').hide();
                        $('#fw-options-box-post-format-link').hide();
                        $('#fw-options-box-post-format-video').hide();
                        $('#fw-options-box-post-format-audio').hide();
                        $('#fw-options-box-post-format-'+ post_format_change ).show();
                    });

                <?php endif; ?>


                var timeoutId;
                $(document).on('widget-updated widget-added', function(){
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                        fwEvents.trigger('fw:options:init', { $elements: $('#widgets-right .fw-theme-admin-widget-wrap') });
                    }, 100);
                });

                $('.mega-menu-column-new-row').parent().parent().remove();


                /* Fix Visual Composer frontend Unyson compatibility issue */
                if( $('body').hasClass('vc_editor') ) {
                    $('.fw-options-tab').each( function() {
                        $(this).html( $(this).attr( 'data-fw-tab-html' ));
                    });
                }

                $(window).load(function() {
                    $('body').removeClass( 'sh-adminbody-loading' );
                });
            });
        </script>
        <style type="text/css">
            <?php /* Fix for Unyson Framework 2.7.9 color picker issue */
            if( is_admin() && defined( 'FW' ) && defined('WP_PLUGIN_DIR') ) :
            	$unyson = get_plugin_data( WP_PLUGIN_DIR. '/unyson/unyson.php' );
            	if( isset( $unyson['Version'] ) && $unyson['Version'] == '2.7.9' ) : ?>

                    .fw-backend-option-input-type-rgba-color-picker .wp-color-result span {
                        border: 1px solid rgba(16, 16, 16, 0.32)!important;
                    }

                    .fw-backend-option-input-type-rgba-color-picker .wp-color-result{
                    	display: block;
                        width: 152px!important;
                        max-width: 152px!important;
                    	height: 19px !important;
                    	position: relative;
                    }

                    .fw-backend-option-input-type-rgba-color-picker .iris-palette {
                        height: 19.5784px!important;
                        width: 19.5784px!important;
                    }

                <?php elseif( isset( $unyson['Version'] ) && version_compare( $unyson['Version'], '2.7.9', '>' ) ) : ?>

                    .wp-picker-container input[type=text].wp-color-picker {
                        display: inline-block!important;
                    }

                    .wp-picker-container .wp-color-result {
                        vertical-align: top;
                    }

                <?php endif;
            endif; ?>

            .notice.fw-brz-dismiss {
                display: none!important;
            }

            div[class^="wpb_vcg_"].wpb_content_element .wpb_vc_param_value {
                display: none!important;
            }

            .widget-inside .fw-backend-option-type-multi-picker .fw-backend-option {
                padding-left: 0px!important;
                padding-right: 0px!important;
            }

            .fw-extensions-list .not-compatible,
            #fw-extensions-list-available .toggle-not-compat-ext-btn-wrapper {
                display: none!important;
            }

            .sh-demo-install-descr {
                padding-top: 4px;
                padding-bottom: 4px;
            }

            #fw-options-box-post-format-gallery,
            #fw-options-box-post-format-quote,
            #fw-options-box-post-format-link,
            #fw-options-box-post-format-video,
            #fw-options-box-post-format-audio,
            .mega-menu-column-new-row {
                display: none;
            }

            .fw-options-box-page-builder-box,
            .fw-options-box-page-builder-box * {
                -webkit-transform: translate3d(0, 0, 0);
                -webkit-perspective: 1000;
                -webkit-backface-visibility:hidden;
                -webkit-transform-style: preserve-3d;
                transform-style: preserve-3d;
            }

            #setting-error-tgmpa {
                display: block!important;
            }

            #sh_post_thumbs {
                width: 100px;
                max-width: 100px;
            }

            .sh_post_thumbs img {
                width: 100px;
                height: auto;
            }

            <?php
                if( !isset( $_GET['vc_action'] ) && !isset( $_GET['action'] ) && !isset( $_GET['post'] ) ) :
                $accent_color = gillion_option('accent_color');
                    if( $accent_color ) :
            ?>

                .sh-revslider-button2 {
                    background-color: <?php echo esc_attr( $accent_color ); ?>!important;
                }

            <?php endif; endif; ?>

            body.post-new-php #setting-error-tgmpa,
            body.post-php #setting-error-tgmpa {
                display: none!important;
            }


            <?php if( gillion_option('amp_mode') != 'all' && gillion_option('amp_mode') != 'disabled' ) : ?>
                #theme_support_standard,
                #theme_support_transitional,
                label[for="theme_support_standard"],
                label[for="theme_support_transitional"] {
                    opacity: 0.5;
                    cursor: default;
                }

                #amp-settings:before {
                    display: block;
                    content: "Gillion AMP optimized mode is enabled (supports only reader mode). You can disable it under Gillion Settings > AMP > AMP Mode (by setting it to All)";
                    color: red;
                }
            <?php endif; ?>
        </style>
    <?php }
endif;

if( !function_exists( 'gillion_add_admin_body_classes' ) ) :
    add_filter('admin_body_class', 'gillion_add_admin_body_classes');
    function gillion_add_admin_body_classes( $classes ) {
        $classes.= ' sh-adminbody-loading';
        return $classes;
    }
endif;



/**
 * Admin panel - link to theme options
 */
if ( !function_exists( 'gillion_theme_options_link' ) && current_user_can('manage_options') && defined('FW')) :
    add_action( 'admin_bar_menu', 'gillion_theme_options_link', 999 );
    function gillion_theme_options_link( $wp_admin_bar ) {
        $args = array(
            'id'    => 'gillion-options',
            'title' => 'Gillion Settings',
            'href'  => get_admin_url().'/themes.php?page=fw-settings',
        );
        $wp_admin_bar->add_node( $args );
    }
endif;


/**
 * Admin panel - add column
 */
global $pagenow;
if (( $pagenow == 'edit.php' ) && !isset($_GET['post_type']) ) {

    add_filter('manage_posts_columns', 'gillion_posts_columns', 5);
    add_action('manage_posts_custom_column', 'gillion_posts_custom_columns', 5, 2);

    function gillion_posts_columns($defaults){
        $defaults['sh_post_thumbs'] = esc_html__('Image', 'gillion');
        return $defaults;
    }

    function gillion_posts_custom_columns($column_name, $id){
        if($column_name === 'sh_post_thumbs'){
            echo the_post_thumbnail( 'thumbnail' );
        }
    }

}


/**
 * Shortcode Options
*/
if ( !function_exists( 'gillion_shortcode_options' ) && defined('FW')) :
    function gillion_shortcode_options($data,$shortcode){

        $atts = shortcode_parse_atts( $data['atts_string'] );
        $atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

        return $atts;
    }
endif;


























if( defined( 'WPB_VC_VERSION' ) ) :
    /**
     * Visual Composer - Add new custom font to Font Family selection in icon box module
    */
    function onepro_add_new_icon_set_to_iconbox( ) {
        $param = WPBMap::getParam( 'vc_icon', 'type' );
        $param['value'][__( 'Elegant Icons', 'gillion' )] = 'elegant_icons';
        vc_update_shortcode_param( 'vc_icon', $param );
    }
    add_filter( 'init', 'onepro_add_new_icon_set_to_iconbox', 40 );


    /**
     * Visual Composer - Add font picker setting to icon box module when you select your font family from the dropdown
    */
    function onepro_add_font_picker() {
        vc_add_param( 'vc_icon', array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'gillion' ),
                'param_name' => 'elegant_icons',
                'settings' => array(
                    'emptyIcon' => true,
                    'type' => 'elegant_icons',
                    'iconsPerPage' => 20,
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'elegant_icons',
                ),
                'group' => esc_html__( 'Icon', 'gillion' ),
            )
        );
    }
    add_filter( 'vc_after_init', 'onepro_add_font_picker', 40 );


    /**
     * Visual Composer - Add icons
    */
    function onepro_vc_iconpicker_type_elegant_icons( $icons ) {
        $icons['elegant_icons'] = array(
            array( "icon_mobile" => "Mobile" ),
            array( "icon_pin_alt" => "Pin" ),
            array( "icon_mail_alt" => "Mail" ),
            array( "icon_ol" => "Ordered List" ),
            array( "icon_stop" => "Stop" ),
            array( "icon_pause" => "Pause" ),
        );
        return $icons;
    }
    add_filter( 'vc_iconpicker-type-elegant_icons', 'onepro_vc_iconpicker_type_elegant_icons', 40 );
endif;

/**
 * Extracts the vimeo id from a vimeo url.
*/
function gillion_getVimeoId($url) {
    if (preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m)) {
        return $m[1];
    }
    return false;
}


/**
 * Extracts the youtube id from a youtube url.
*/
function gillion_getYoutubeId($url) {
    $parts = parse_url($url);
    if (isset($parts['host'])) {
        $host = $parts['host'];
        if (
            false === strpos($host, 'youtube') &&
            false === strpos($host, 'youtu.be')
        ) {
            return false;
        }
    }
    if (isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        }
        else if (isset($qs['vi'])) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return false;
}


/**
 * Add Social Media for Author
 */
if ( ! function_exists( 'gillion_user_socialmedia' ) ) :
    function gillion_user_socialmedia( $social ) {
        $social['public_email'] = 'Public Email';
        $social['facebook'] = 'Facebook';
        $social['twitter'] = 'Twitter';
        $social['instagram'] = 'Instagram';
        $social['linkedin'] = 'LinkedIn';
        $social['pinterest'] = 'Pinterest';
        $social['tumblr'] = 'Tumblr';
        $social['youtube'] = 'Youtube';
        return $social;
    }
    add_filter('user_contactmethods','gillion_user_socialmedia',10,1);
endif;
