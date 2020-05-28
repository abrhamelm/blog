<?php
if ( class_exists( 'woocommerce' ) ) :

    /**
     * Woocommerce - Thumnail class
     */
    add_action( 'woocommerce_before_shop_loop_item_title', function(){
        echo '<div class="post-thumbnail">';
    }, 9 );
    add_action( 'woocommerce_before_shop_loop_item_title', function(){
        do_action( 'woocommerce_after_shop_loop_item' );
        echo '<a href="'.esc_url( get_permalink() ).'" class="post-overlay"></a>
        </div>';
    }, 11 );


    /**
     * Woocommerce - change default pagination
     */
    if( !function_exists('woocommerce_pagination') ) :
        remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
        function woocommerce_pagination() {
            gillion_pagination();
        }
        add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);
    endif;


    /**
     * Woocommerce - change image sizes
     */
    if( !function_exists('gillion_woocommerce_image_sizes') ) :
        function gillion_woocommerce_image_sizes() {
            global $pagenow;

            if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
                return;
            }
            $catalog = array(
                'width'     => '585',
                'height'    => '640',
                'crop'      => 1
            );
            $single = array(
                'width'     => '1024',
                'height'    => '1024',
                'crop'      => 0
            );
            $thumbnail = array(
                'width'     => '150',
                'height'    => '150',
                'crop'      => 1
            );

            // Image sizes
            update_option( 'shop_catalog_image_size', $catalog );
            update_option( 'shop_single_image_size', $single );
            update_option( 'shop_thumbnail_image_size', $thumbnail );
        }
        add_action( 'after_switch_theme', 'gillion_woocommerce_image_sizes', 1 );
    endif;


    /* WooCommerce - related products */
    if ( ! function_exists( 'gillion_woocommerce_setup' ) ) :
    	function gillion_woocommerce_setup() {

            if( gillion_option( 'wc_related' ) == false ) :
                remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
            endif;

            add_filter( 'loop_shop_columns', 'gillion_wc_loop_shop_columns', 1, 10 );
            add_filter( 'loop_shop_per_page', 'gillion_wc_loop_shop_items', 1, 20 );

    	}
    	add_action( 'init', 'gillion_woocommerce_setup' );
    endif;


    /* WooCommerce - change columns  */
    if( !function_exists('gillion_wc_loop_shop_columns') ) :
        function gillion_wc_loop_shop_columns() {
            return gillion_option( 'wc_columns' , 4 );
        }
    endif;


    /* WooCommerce - change product limit*/
    if( !function_exists('gillion_wc_loop_shop_items') ) :
        function gillion_wc_loop_shop_items() {
            return gillion_option( 'wc_items', 12 );
        }
    endif;


    /* WooCommerce - placeholders */
    /*add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
    function custom_override_checkout_fields( $fields ) {
        $fields['billing']['billing_first_name']['autofocus'] = '';
        $fields['billing']['billing_first_name']['placeholder'] = esc_html__( 'First Name', 'gillion' );
        $fields['billing']['billing_last_name']['placeholder'] = esc_html__( 'Last Name', 'gillion' );
        $fields['billing']['billing_company']['placeholder'] = esc_html__( 'Company name', 'gillion' );
        $fields['billing']['billing_city']['placeholder'] = esc_html__( 'Town / City', 'gillion' );
        $fields['billing']['billing_state']['placeholder'] = esc_html__( 'State', 'gillion' );
        $fields['billing']['billing_postcode']['placeholder'] = esc_html__( 'Postcode', 'gillion' );
        $fields['billing']['billing_phone']['placeholder'] = esc_html__( 'Phone ', 'gillion' );
        $fields['billing']['billing_email']['placeholder'] = esc_html__( 'Email address', 'gillion' );
        return $fields;
    }*/


    /* WooCommerce - Loop Layout */
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 12 );


    /* WooCommerce - Wishlist Trigger */
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_wishlist', 20 );
    function woocommerce_template_loop_product_wishlist( $id ) {
        if( gillion_option( 'wishlist', true ) == true ) :
            $product_id = ( $id > 0 ) ? $id : get_the_ID();
            $user_id = get_current_user_id();
            if( $user_id > 0 ) :
            	$wishlist = get_user_meta( $user_id, 'sh_wishlist', false );
            	$status = ( in_array( intval( $product_id ), $wishlist ) ) ? 'remove' : 'add'; ?>

            	<div class="sh-product-wishlist-add sh-product-wishlist-add-trigger" data-id="<?php echo intval( $product_id ); ?>" data-status="<?php echo esc_attr( $status ); ?>">
                    <i class="icon icon-heart"></i>
                </div>

            <?php else : ?>

                <div class="sh-product-wishlist-add sh-product-wishlist-add-guest" href="#login-register" data-status="add">
                    <i class="icon icon-heart"></i>
                </div>

            <?php endif;
        endif;
    }


    /* WooCommerce - Wishlist Page */
    add_filter( 'query_vars', 'add_query_vars', 0 );
	function add_query_vars( $vars ) {
        $vars[] = 'wishlist';
        return $vars;
    }



    function gillion_add_my_account_endpoint() {
        add_rewrite_endpoint( 'wishlist', EP_ROOT | EP_PAGES );
    }
    add_action( 'init', 'gillion_add_my_account_endpoint' );
    function gillion_account_menu_items( $items = array() ) {
        if( gillion_option( 'wishlist', true ) == true ) :
            $new_items = array();
            foreach( $items as $key=>$name ) :
                $new_items[$key] = $name;
                if( $key == 'edit-account' ) :
                    $new_items['wishlist'] = __( 'Wishlist', 'gillion' );
                endif;
            endforeach;
            return ( count( $new_items ) > count( $items ) ) ? $new_items : $items;
        else :
            return $items;
        endif;
    }
    add_filter( 'woocommerce_account_menu_items', 'gillion_account_menu_items', 10, 1 );
    add_action( 'woocommerce_account_wishlist_endpoint', function() {
        if( gillion_option( 'wishlist', true ) == true ) : ?>

        <p><?php esc_attr_e( 'My wishlist', 'gillion' ); ?></p>
        <div class="woocommerce woocommerce-wishlist columns-3">
            <ul class="products columns-3">
                <?php
                    $style = '';
                    $wishlist_page = intval( str_replace( 'page/', '', get_query_var('wishlist') ) );
                    $page = ( $wishlist_page > 0 ) ? $wishlist_page : 1;
                    $items = array_reverse( get_user_meta( get_current_user_id(), 'sh_wishlist', false ) );

                    if( count( $items ) > 0 ) :
                        $products = new WP_Query( array(
                            'post_type' => 'product',
                            'post__in' => $items,
                            'posts_per_page' => 9,
                            'paged' => $page,
                            'orderby' => 'post__in',
                        ));
                        $count = ( isset( $products->post_count ) && $products->post_count > 0 ) ? intval( $products->post_count ) : '0';
                        $style = ( $count ) ? ' style="display: none;"' : '';

                        if( $products->have_posts() ) :
                            while ( $products->have_posts() ) : $products->the_post();
                                wc_get_template_part( 'content', 'product' );
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        gillion_pagination( $products, 1, 0, 1 );
                    endif;
                ?>
            </ul>
        </div>
        <ul class="woocommerce-wishlist-not-found woocommerce-error" role="alert"<?php echo ( $style ); ?>>
        	<li><?php esc_attr_e( 'At the moment there are no items added to your wishlist', 'gillion' ); ?></li>
        </ul>

    <?php endif; });

endif;


/**
 * Woocommerce - if related page
 */
if( !function_exists('gillion_is_realy_woocommerce_page') ) :
    function gillion_is_realy_woocommerce_page () {
        if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
            return true;
        }
        $woocommerce_keys = array(
            "woocommerce_shop_page_id" ,
            "woocommerce_terms_page_id" ,
            "woocommerce_cart_page_id" ,
            "woocommerce_checkout_page_id" ,
            "woocommerce_pay_page_id" ,
            "woocommerce_thanks_page_id" ,
            "woocommerce_myaccount_page_id" ,
            "woocommerce_edit_address_page_id" ,
            "woocommerce_view_order_page_id" ,
            "woocommerce_change_password_page_id" ,
            "woocommerce_logout_page_id" ,
            "woocommerce_lost_password_page_id"
        );

        foreach ( $woocommerce_keys as $wc_page_id ) {
            if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                    return true ;
            }
        }
        return false;
    }
endif;


/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) :
    function woocommerce_template_loop_product_thumbnail() {
        global $post, $woocommerce;

        $image = ( has_post_thumbnail() ) ? gillion_thumbnail_url( $post->ID, 'shop_catalog' ) : woocommerce_placeholder_img_src();
        echo  '
        <div class="sh-ratio">
            <div class="sh-ratio-container" style="padding-bottom: 110%;">
                <div class="sh-ratio-content" style="background-image: url( '.esc_url( $image ).');"></div>
            </div>
        </div>';
    }
endif;
