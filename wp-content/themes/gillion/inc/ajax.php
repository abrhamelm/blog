<?php
/**
 * Recemt posts
 */
add_action( 'wp_ajax_nopriv_load_more_posts', 'gillion_load_more_posts' );
add_action( 'wp_ajax_load_more_posts', 'gillion_load_more_posts' );

function gillion_load_more_posts() {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) :

        $categories = ( isset( $_POST['categories'] ) && $_POST['categories'] ) ? explode( ',', esc_attr( $_POST['categories'] ) ) : array();
        $post_style = ( isset( $_POST['post_style'] ) && $_POST['post_style'] ) ? esc_attr( $_POST['post_style'] ) : 'masonry';
        $posts_per_page = ( isset( $_POST['per_page'] ) && $_POST['per_page'] ) ? esc_attr( $_POST['per_page'] ) : '6';
        $paged = ( isset( $_POST['paged'] ) && $_POST['paged'] > 0 ) ? intval( $_POST['paged'] ) : '1';
        $offset = ( isset( $_POST['offset'] ) && $_POST['offset'] > 0 ) ? intval( $_POST['offset'] ) : '0';

        $posts_args = array(
        	'post_type' => 'post',
        	'paged' => $paged,
        	'category__in' => $categories,
        	'posts_per_page' => $posts_per_page,
            'post_status' => 'publish',
        );

        if( $offset ) :
            $posts_args['offset'] = ( $paged - 1 ) * $posts_per_page + $offset;
        endif;

        $posts = new WP_Query( $posts_args );
        if( isset( $posts->found_posts ) && $posts->found_posts > 0 ) :
            set_query_var( 'style', $post_style );
            while ( $posts->have_posts() ) : $posts->the_post();
                if( get_post_format() ) :
                    get_template_part( 'content', 'format-'.get_post_format() );
                else :
                    get_template_part( 'content' );
                endif;
            endwhile;
        else :
            echo 'done';
        endif;

    endif;
	die();
}


/**
 * Recemt products
 */
add_action( 'wp_ajax_nopriv_load_more_products', 'gillion_load_more_products' );
add_action( 'wp_ajax_load_more_products', 'gillion_load_more_products' );

function gillion_load_more_products() {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) :

        $posts_per_page = ( isset( $_POST['per_page'] ) && $_POST['per_page'] ) ? esc_attr( $_POST['per_page'] ) : '6';
        $paged = ( isset( $_POST['paged'] ) && $_POST['paged'] ) ? esc_attr( $_POST['paged'] ) : '1';

        $posts = new WP_Query( array(
            'post_type' => 'product',
            'paged' => $paged,
            'posts_per_page' => $posts_per_page,
            'post_status' => 'publish',
        ));

        if( isset( $posts->found_posts ) && $posts->found_posts > 0 ) :
            while ( $posts->have_posts() ) : $posts->the_post();
                wc_get_template_part( 'content', 'product' );
            endwhile;
        else :
            echo 'done';
        endif;

    endif;
    die();
}


/**
 * Wishlist
 */
add_action( 'wp_ajax_nopriv_wishlist_item', 'gillion_wishlist_item' );
add_action( 'wp_ajax_wishlist_item', 'gillion_wishlist_item' );

function gillion_wishlist_item() {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) :

        $user_id = get_current_user_id();
        if( $user_id > 0 ) :
            $id = ( isset( $_POST['product_id'] ) && $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : '';
            $status = ( isset( $_POST['status'] ) && $_POST['status'] ) ? esc_attr( $_POST['status'] ) : '';

            if( $id > 0 && in_array( $status, array( 'add', 'remove' ) ) ) :
                if( $status == 'add' ) :

                    $wishlist = get_user_meta( $user_id, 'sh_wishlist', false );
                    if( !in_array( $id, $wishlist ) ) :
                        add_user_meta( $user_id, 'sh_wishlist', $id );
                    endif;

                elseif( $status == 'remove' ) :
                    delete_user_meta( $user_id, 'sh_wishlist', $id );
                endif;
            endif;
            echo 'done';
        endif;

    endif;
    die();
}
