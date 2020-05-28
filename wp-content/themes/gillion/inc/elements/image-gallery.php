<?php
/*
Element: Button
*/

class vcImageGallery extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_image_gallery', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Image Gallery V2', 'gillion'),
                'base' => 'vcg_image_gallery',
                'description' => __('Responsive image gallery', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'images',
                        'heading' => __( 'Images', 'gillion' ),
                        'value' => __( 'Choose images', 'gillion' ),
                        'type' => 'attach_images',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'images_size',
                        'heading' => __( 'Images Size', 'gillion' ),
                        'description' => __( 'Choose slider style', 'gillion' ),
                        'value' => array(
                            __('Large', 'gillion') => 'large',
                            __('Full', 'gillion') => 'full',
                            __('Landscape', 'gillion') => 'gillion-landscape-small',
                            __('Portrait', 'gillion') => 'gillion-portrait',
                            __('Square', 'gillion') => 'gillion-square',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'dots',
                        'heading' => __( 'Dots', 'gillion' ),
                        'description' => __( 'Choose to enable or disable slider dots', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
                        'param_name' => 'autoplay',
                        'heading' => __( 'Autoplay', 'gillion' ),
                        'description' => __( 'Choose to enable or disable slider autoplay', 'gillion' ),
                        'value' => 'Yes',
                        'type' => 'checkbox',
                        'holder' => 'div',
                        'class' => '',
                    ),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Extra class name', 'gillion' ),
            			'param_name' => 'el_class',
            			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
            		),

            		array(
            			'type' => 'css_editor',
            			'heading' => __( 'CSS box', 'gillion' ),
            			'param_name' => 'css',
            			'group' => __( 'Design Options', 'gillion' ),
            		),

                ),
            )
        );

    }


    public function _html( $atts, $content ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        /* Get Values */
        $id = 'vcg-button-'.gillion_rand();
        $images = ( isset( $atts['images'] ) ) ? explode( ',', $atts['images'] ) : array();
        $images_size = ( isset( $atts['images_size'] ) ) ? $atts['images_size'] : 'large';
        $dots = ( isset( $atts['dots'] ) && $atts['dots'] ) ? 'true' : 'false';
        $autoplay = ( isset( $atts['autoplay'] ) && $atts['autoplay'] ) ? 'true' : 'false';
        $vc_css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';

        /* Set Classes and Styles */
        $class = array();
        $class[] = $id;
        $class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $vc_css, ' ' ), $this->settings['base'], $atts );
        ob_start();
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                "use strict";
                $('.<?php echo esc_attr($id); ?>').slick({
                    dots: <?php echo esc_attr( $dots ); ?>,
                    autoplay: <?php echo esc_attr( $autoplay ); ?>,
                    autoplaySpeed: 6000,
                    arrows: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    /*swipeToSlide: true,*/
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: { slidesToShow: 3, slidesToScroll: 3, }
                        },
                        {
                            breakpoint: 1000,
                            settings: { slidesToShow: 2, slidesToScroll: 2, }
                        },
                        {
                            breakpoint: 600,
                            settings: { slidesToShow: 1, slidesToScroll: 1, }
                        }
                      ]
                });
            });
        </script>

            <div class="vcg-image-gallery">
                <div class="vcg-image-gallery-container <?php echo implode( ' ', $class ); ?>">
                    <?php
                        foreach( $images as $image_id ) :
                        	$image = wp_get_attachment_image_src( $image_id, $images_size );
                            if( isset( $image[0] ) && $image[0] ) : ?>

                                <div class="vcg-image-gallery-image">
                            	    <img src="<?php echo esc_url( $image[0] ) ; ?>" alt="" />
                                </div>

                            <?php endif;
                        endforeach;
                    ?>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcImageGallery();
