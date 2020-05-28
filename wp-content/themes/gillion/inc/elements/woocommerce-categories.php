<?php
/*
Element: Blog Posts Categories
*/

class vcWooCommerceCategories extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_woocommerce_categories', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }
        vc_map(
            array(
                'name' => __('WooCommerce Categories', 'gillion'),
                'base' => 'vcg_woocommerce_categories',
                'description' => __('Link to WooCommerce categories', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'categories',
                        'heading' => __( 'Categories', 'gillion' ),
                        'description' => __( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)). By default will get most popular categories', 'gillion' ),
                        'value' => '',
                        'type' => 'exploded_textarea',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'limit',
                        'heading' => __( 'Limit', 'gillion' ),
                        'description' => __( 'Choose category limit', 'gillion' ),
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
            'categories' => '',
            'limit' => '4',
        ), $atts ) );

        // HTML
        if( !$categories ) :
            $categories = get_categories( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name', 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => 0, 'limit' => $limit ) );
        else :
            $categories = explode( ',', $categories );
        endif;
        ob_start(); ?>

            <div class="vcg-woocommerce-categories">
                <?php $i = 0;
                foreach( $categories as $name ) : $i++;
                    $category = get_term_by( 'name', $name, 'product_cat' );
                    if( isset( $category->term_taxonomy_id ) && $category->term_taxonomy_id > 0 ) :
                        $class = '';
                        if( $i == 2 ) :
                            $class = ' vcg-woocommerce-categories-item-wide';
                        elseif( $i == 3 ) :
                            $class = ' vcg-woocommerce-categories-item-small';
                        elseif( $i == 4 ) :
                            $class = ' vcg-woocommerce-categories-item-small2';
                        endif;

                        $id = $category->term_taxonomy_id;
                        $thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );
                        $image = wp_get_attachment_image_src( $thumbnail_id, 'large' ); ?>

                        <div class="vcg-woocommerce-categories-item<?php echo $class; ?>">
                            <a href="<?php echo get_category_link( $id ); ?>" class="vcg-woocommerce-categories-item-container">
                                <div class="vcg-woocommerce-categories-content sh-heading-font">
                                    <div class="vcg-woocommerce-categories-count">
                                        <?php echo intval( $category->count ); ?>
                                    </div>
                                    <div class="vcg-woocommerce-categories-subtitle">
                                        <?php echo esc_attr( gillion_term_option( $id, 'product_cat', 'subtitle' ) ); ?>
                                    </div>
                                    <h3><?php echo $name; ?></h3>
                                </div>
                                <div class="vcg-woocommerce-categories-item-background" style="background-image: url( <?php echo esc_url( $image[0] ); ?> );"></div>
                            </a>
                            <div class="vcg-woocommerce-categories-item-shadow"></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php return ob_get_clean();
    }

}
new vcWooCommerceCategories();
