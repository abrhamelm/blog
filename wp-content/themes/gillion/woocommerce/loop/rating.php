<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

echo wc_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.
$rating_count = $product->get_rating_count();
if( $rating_count ) :
	echo '<span class="star-rating-count">('.$rating_count.')</span>';
else :
	echo '<div class="star-rating"><span style="width:0%">Rated <strong class="rating">4.00</strong> out of 5</span></div>';
	echo '<span class="star-rating-count">(0)</span>';
endif;
