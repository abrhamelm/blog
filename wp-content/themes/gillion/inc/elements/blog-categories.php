<?php
/*
Element: Blog Posts Categories
*/

class vcBlogCategories extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_blog_categories', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Blog Categories', 'gillion'),
                'base' => 'vcg_blog_categories',
                'description' => __('Links to categories', 'gillion'),
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
                        'value' => '3',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                    ),

                ),
            )
        );

    }


    public function _html( $atts ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $atts['limit'] = ( isset( $atts ) && isset( $atts['limit'] ) ) ? $atts['limit'] : 3;
        $atts['categories'] = ( isset( $atts['categories'] ) ) ? $atts['categories'] : implode( ",", array_slice( get_categories( array( 'fields' => 'id=>name', 'orderby' => 'count', 'order' => 'DESC', 'limit' => $atts['limit'] ) ) , 0, $atts['limit']) );
        ob_start();

            $id = 'blog-categories-'.gillion_rand();
            $css_class = array();
            $css_class[] = 'categories-list';
            $css_class[] = 'row';
            $css_class[] = $id;

            $categories = explode( ",", $atts['categories'] );
            ?>

            <?php if( is_array( $categories ) && count($categories) > 0 ) : ?>
            <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">

                <?php foreach( $categories as $category ) :
                    $category = get_term_by('name', $category, 'category');

                    if( isset( $category->term_id ) && $category->term_id > 0 ) :
                        $icon = gillion_term_option( $category->term_id, 'category', 'icon' );
                    ?>

                        <div class="col-md-4 col-sm-6 categories-list-item">
                            <div class="sh-ratio">
                                <div class="sh-ratio-container">
                                    <a href="<?php echo get_category_link( $category->term_id ); ?>" class="sh-ratio-content"
                                        style="background-image: url( <?php echo esc_url( gillion_term_option_image( $category->term_id, 'category', 'image' ) ); ?> );">

                                        <h4 class="categories-list-item-name"><?php echo esc_attr( $category->name ); ?></h4>
                                        <?php if( $icon ) : ?>
                                            <div class="categories-list-item-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
                                        <?php endif; ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
            <?php endif; wp_reset_postdata();


        //var_dump( $atts );
        return ob_get_clean();
    }

}
new vcBlogCategories();
