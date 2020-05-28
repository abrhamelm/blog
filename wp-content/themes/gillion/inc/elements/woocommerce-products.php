<?php
/*
Element: Blog Posts Categories
*/

class vcWooCommerceProducts extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_woocommerce_products', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }
        vc_map(
            array(
                'name' => __('WooCommerce Products (dynamic)', 'gillion'),
                'base' => 'vcg_woocommerce_products',
                'description' => __('Gillion WooCommerce products', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'posts_per_page',
                        'heading' => __( 'Show Posts', 'gillion' ),
                        'description' => __( 'Choose how many posts will be shown. Notice: Currently this element works only when using one instance per page', 'gillion' ),
                        'value' => '4',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'load_more',
                        'heading' => __( 'Load More Posts Per Page', 'gillion' ),
                        'description' => __( 'Choose how many items will be loaded', 'gillion' ),
                        'value' => '4',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                ),
            )
        );

    }


    public function _html( $atts, $content ) {

        // Params extraction
        extract( shortcode_atts( array(
            'posts_per_page' => '4',
            'load_more' => '4'
        ), $atts ) );

        // HTML
        ob_start(); ?>

            <div class="vcg-woocommerce-products">
                <div class="woocommerce columns-4">
                    <ul class="products columns-4">
                    	<?php
                    		$products = new WP_Query( array(
                    			'post_type' => 'product',
                    			'posts_per_page' => intval( $posts_per_page ),
                                'paged' => 1,
                    		));
                    		if( $products->have_posts() ) :
                    			while ( $products->have_posts() ) : $products->the_post();
                    				wc_get_template_part( 'content', 'product' );
                    			endwhile;
                    		endif;
                    		wp_reset_postdata();
                    	?>
                    </ul>
                    <div class="sh-load-more sh-load-more-product sh-heading-font" data-posts-per-page="<?php echo intval( $load_more ); ?>" data-paged="2">
                        <?php echo esc_html_e( 'Load more', 'gillion' ); ?>
                    </div>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcWooCommerceProducts();
