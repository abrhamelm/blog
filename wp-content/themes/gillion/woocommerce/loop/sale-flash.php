<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ( $product->is_in_stock() && $product->is_on_sale() ) {
	if( $product->is_type( 'variable' ) ) :
		$regular_price = $product->get_variation_regular_price();
		$sale_price = $product->get_variation_sale_price();
	else :
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();
	endif;

	$percentage_val = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
	$percentage = ( $percentage_val > 0 && $percentage_val >= gillion_option( 'wc_sale_percentage', 0 ) && gillion_option( 'wc_sale_percentage', 0 ) > 0 ) ? ' - '.$percentage_val.'%' : '';
	echo apply_filters( 'woocommerce_sale_flash', '<div class="product-tag-container"><span class="product-tag-button onsale">' . esc_html__( 'Sale', 'gillion' ) . $percentage . '</span></div>', $post, $product );
} else if( ! $product->is_in_stock() ) {
	echo apply_filters( 'woocommerce_sale_flash', '<div class="product-tag-container"><span class="product-tag-button outofstock">' . esc_html__( 'Out of stock', 'gillion' ) . '</span></div>', $post, $product );
} else if( gillion_option( 'wc_new', true ) == true && ( time() - ( 60 * 60 * 24 * (int) gillion_option( 'wc_new_duration', 2 ) ) ) < get_the_time( 'U' ) ) {
	echo apply_filters( 'woocommerce_sale_flash', '<div class="product-tag-container"><span class="product-tag-button newproduct">' . esc_html__( 'New', 'gillion' ) . '</span></div>', $post, $product );
}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
