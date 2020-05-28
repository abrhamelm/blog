<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
defined( 'ABSPATH' ) || exit;

?><div class="woocommerce-cart-empty"><?php

wc_print_notices();

/*
 * @hooked wc_empty_cart_message - 10
 */
?>

	<div class="woocommerce-cart-empty-notice sh-heading-font">
		<img src="<?php echo get_template_directory_uri(); ?>/img/empty-cart.png" alt="">
		<span class="woocommerce-cart-empty-title"><strong><?php esc_html_e( 'Your cart is currently empty!', 'gillion'); ?></strong></span>
		<span><?php esc_html_e( 'Add item to get started', 'gillion'); ?></span>
	</div>

<?php
//do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Return to shop', 'woocommerce' ) ?>
		</a>
	</p>
<?php endif; ?>

</div>
