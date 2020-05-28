<?php
/*
Element: Blog Posts Categories
*/

class vcWooCommerceSpotlight extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_woocommerce_spotlight', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }
        vc_map(
            array(
                'name' => __('WooCommerce Spotlight', 'gillion'),
                'base' => 'vcg_woocommerce_spotlight',
                'description' => __('WooCommerce spotlight products', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'title_new',
                        'heading' => __( 'New Products Title', 'gillion' ),
                        'description' => __( 'Enter new products title', 'gillion' ),
                        'value' => __( 'New Arrivals', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'title_featured',
                        'heading' => __( 'Featured Products Title', 'gillion' ),
                        'description' => __( 'Enter featured products title (featured products can be selected by going to the product list page and clicking on product star icon)', 'gillion' ),
                        'value' => __( 'Featured', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'title_top',
                        'heading' => __( 'Top Selling Products Title', 'gillion' ),
                        'description' => __( 'Enter new products title', 'gillion' ),
                        'value' => __( 'Top Selling', 'gillion' ),
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
            'title_new' => __( 'New Arrivals', 'gillion' ),
            'title_featured' => __( 'Featured', 'gillion' ),
            'title_top' => __( 'Top Selling', 'gillion' )
        ), $atts ) );

        // HTML
        $rand = gillion_rand( 5 );
        ob_start(); ?>

<div class="vcg-woocommerce-spotlight">

    <!-- Tabs -->
    <div class="vcg-woocommerce-spotlight-tabs sh-heading-font">
        <ul class="nav nav-tab" role="tablist">
            <li role="presentation" class=" active">
                <a href="#spot-<?php echo esc_attr( $rand ); ?>-1" role="tab" data-toggle="tab">
                    <?php echo esc_attr( $title_new ); ?>
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#spot-<?php echo esc_attr( $rand ); ?>-2" role="tab" data-toggle="tab">
                    <?php echo esc_attr( $title_featured ); ?>
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#spot-<?php echo esc_attr( $rand ); ?>-3" role="tab" data-toggle="tab">
                    <?php echo esc_attr( $title_top ); ?>
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="spot-<?php echo esc_attr( $rand ); ?>-1">
            <?php echo do_shortcode( '[recent_products per_page="4"]' ); ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="spot-<?php echo esc_attr( $rand ); ?>-2">
            <?php echo do_shortcode( '[featured_products per_page="4"]' ); ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="spot-<?php echo esc_attr( $rand ); ?>-3">
            <?php echo do_shortcode( '[best_selling_products per_page="4"]' ); ?>
        </div>
    </div>

</div>


        <?php return ob_get_clean();
    }

}
new vcWooCommerceSpotlight();
