<?php if( is_cart() || is_checkout() ) :
    if( is_wc_endpoint_url( 'order-received' ) ) :
        $step = 'step1 step2 step3';
    elseif( is_checkout() ) :
        $step = 'step1 step2';
    elseif( is_cart() && WC()->cart->get_cart_contents_count() != 0 ) :
        $step = 'step1';
    endif;
?>
    <div class="woocommerce-header woocommerce-header <?php echo esc_attr( $step ); ?> sh-heading-font">
        <div class="woocommerce-header-content">
            <div class="woocommerce-header-item woocommerce-header-item-cart">
                <?php if( !is_cart() ) : ?>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="woocommerce-header-icon">
                        <i class="icon icon-eyeglass"></i>
                        <span>1</span>
                    </a>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="woocommerce-header-title">
                        <?php esc_attr_e( 'Cart Overview', 'gillion' ); ?>
                    </a>
                <?php else : ?>
                    <div class="woocommerce-header-icon">
                        <i class="icon icon-eyeglass"></i>
                        <span>1</span>
                    </div>
                    <span class="woocommerce-header-title">
                        <?php esc_attr_e( 'Cart Overview', 'gillion' ); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="woocommerce-header-item woocommerce-header-item-checkout">
                <div class="woocommerce-header-icon">
                    <i class="icon icon-list"></i>
                    <span>2</span>
                </div>
                <span class="woocommerce-header-title">
                    <?php esc_attr_e( 'Checkout Details', 'gillion' ); ?>
                </span>
            </div>
            <div class="woocommerce-header-item woocommerce-header-item-complate">
                <div class="woocommerce-header-icon">
                    <i class="icon icon-check"></i>
                    <span>3</span>
                </div>
                <span class="woocommerce-header-title">
                    <?php esc_attr_e( 'Complete', 'gillion' ); ?>
                </span>
            </div>
        </div>
    </div>
<?php endif; ?>
