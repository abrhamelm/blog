<?php
/*
Element: Button
*/

class vcButton extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_button', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Button V2', 'gillion'),
                'base' => 'vcg_button',
                'description' => __('Simple button with simple options', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'text',
                        'heading' => __( 'Text', 'gillion' ),
                        'value' => __( 'Text inside the button', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'link',
                        'heading' => __( 'URL (link)', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Alignment', 'gillion' ),
            			'param_name' => 'alignment',
                        'value' => array(
            				__( 'Left', 'gillion' ) => 'left',
            				__( 'Center', 'gillion' ) => 'center',
            				__( 'Right', 'gillion' ) => 'right',
            			),
            			'std' => 'left',
                        'admin_label' => false,
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Shape', 'gillion' ),
            			'param_name' => 'shape',
                        'value' => array(
            				__( 'Rounded', 'gillion' ) => 'rounded',
            				__( 'Round', 'gillion' ) => 'round',
            				__( 'Square', 'gillion' ) => 'square',
            			),
            			'std' => 'rounded',
            			'description' => __( 'Select button shape.', 'gillion' ),
                        'admin_label' => false,
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'width',
                        'heading' => __( 'Width', 'gillion' ),
            			'description' => __( 'Set fixed width for button', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                        /*"dependency" => array(
                            "element" => "style",
                            "value" => array( "left", "right", "center" )
                        )*/
                    ),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Font Weight', 'gillion' ),
            			'param_name' => 'text_weight',
                        'value' => array(
                            __( 'Light', 'gillion' ) => '300',
            				__( 'Regular', 'gillion' ) => '400',
            				__( 'Bold', 'gillion' ) => '700',
                            __( 'Extra bold', 'gillion' ) => '900',
            			),
            			'std' => '400',
            			'description' => __( 'Select text font weight.', 'gillion' ),
                        'admin_label' => false,
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'font_size',
                        'heading' => __( 'Font Size', 'gillion' ),
                        'description' => __( 'Enter font size', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                    ),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Underline', 'gillion' ),
            			'param_name' => 'underline',
                        'value' => array(
                            __( 'Disabled', 'gillion' ) => 'disabled',
            				__( '1px', 'gillion' ) => '1px',
            				__( '2px', 'gillion' ) => '2px',
                            __( '3px', 'gillion' ) => '3px',
                            __( '4px', 'gillion' ) => '4px',
                            __( '5px', 'gillion' ) => '5px',
            			),
            			'std' => 'disabled',
            			'description' => __( 'Choose text underline', 'gillion' ),
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Transformation', 'gillion' ),
            			'param_name' => 'text_transform',
                        'value' => array(
                            __( 'None (default)', 'gillion' ) => 'none',
            				__( 'Uppercase ', 'gillion' ) => 'uppercase',
            				__( 'Lowercase ', 'gillion' ) => 'lowercase ',
                            __( 'Capitalize', 'gillion' ) => 'capitalize',
            			),
            			'std' => 'none',
            			'description' => __( 'Select text trasnformation.', 'gillion' ),
                        'admin_label' => false,
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Shadow', 'gillion' ),
            			'param_name' => 'text_shadow',
                        'value' => array(
                            __( 'None (default)', 'gillion' ) => 'none',
            				__( 'Small shadow', 'gillion' ) => '0px 2px 6px rgba(0,0,0,0.15)',
            				__( 'Medium shadow ', 'gillion' ) => '0px 3px 10px rgba(0,0,0,0.2)',
                            __( 'Large shadow', 'gillion' ) => '0px 7px 20px rgba(0,0,0,0.25)',
            			),
            			'std' => 'none',
            			'description' => __( 'Select text shadow', 'gillion' ),
                        'admin_label' => false,
                        //'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'icon_image',
                        'heading' => __( 'Icon Image', 'gillion' ),
                        'value' => __( 'Upload Icon Image', 'gillion' ),
                        'type' => 'attach_image',
                        'admin_label' => false,
                    ),

                    array(
                        'param_name' => 'padding',
                        'heading' => __( 'Custom Padding', 'jevelin' ),
                        'description' => __( 'Here you can set custom button padding (<b>top right bottom left</b>). For example: <b>5px 15px 5px 15px</b>', 'jevelin' ),
                        'type' => 'textfield',
                    ),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Extra class name', 'gillion' ),
            			'param_name' => 'el_class',
            			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Text Color', 'gillion' ),
            			'param_name' => 'text_color',
                        'value' => '#ffffff',
                        'group' => __( 'Colors', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Text Color (hover)', 'gillion' ),
            			'param_name' => 'text_color_hover',
                        'value' => '',
                        'group' => __( 'Colors', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Background Color', 'gillion' ),
            			'param_name' => 'background_color',
                        'value' => '#505050',
                        'group' => __( 'Colors', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Background Color (for gradient effect)', 'gillion' ),
            			'param_name' => 'background_color2',
                        'value' => '',
                        'group' => __( 'Colors', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Background Color (hover)', 'gillion' ),
            			'param_name' => 'background_color_hover',
                        'value' => '',
                        'group' => __( 'Colors', 'gillion' ),
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
        $text = ( isset( $atts['text'] ) ) ? $atts['text'] : __( 'Text inside the button', 'gillion' );
        $underline = ( isset( $atts['underline'] ) ) ? $atts['underline'] : 'disabled';
        $font_size = ( isset( $atts['font_size'] ) ) ? $atts['font_size'] : '';
        $icon_image = ( isset( $atts['icon_image'] ) ) ? $atts['icon_image'] : '';
        $font_size = ( is_numeric( $font_size ) ) ? $font_size.'px' : $font_size;
        $link = ( isset( $atts['link'] ) ) ? esc_url( $atts['link'] ) : '';
        $alignment = ( isset( $atts['alignment'] ) ) ? $atts['alignment'] : 'left ';
        $shape = ( isset( $atts['shape'] ) ) ? $atts['shape'] : 'rounded';
        $width = ( isset( $atts['width'] ) ) ? $atts['width'] : '';
        $font_weight = ( isset( $atts['text_weight'] ) ) ? $atts['text_weight'] : '';
        $text_transform = ( isset( $atts['text_transform'] ) ) ? $atts['text_transform'] : '';
        $text_shadow = ( isset( $atts['text_shadow'] ) ) ? $atts['text_shadow'] : '';
        $text_color = ( isset( $atts['text_color'] ) ) ? $atts['text_color'] : '';
        $text_color_hover = ( isset( $atts['text_color_hover'] ) ) ? $atts['text_color_hover'] : '';
        $background_color = ( isset( $atts['background_color'] ) ) ? $atts['background_color'] : '';
        $background_color2 = ( isset( $atts['background_color2'] ) ) ? $atts['background_color2'] : '';
        $background_color_hover = ( isset( $atts['background_color_hover'] ) ) ? $atts['background_color_hover'] : '';
        $padding = ( isset( $atts['padding'] ) ) ? $atts['padding'] : '';
        $vc_css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';


        /* Set Classes and Styles */
        $class = array(); $css = array();
        $class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $vc_css, ' ' ), $this->settings['base'], $atts );
        $class[] = 'vcg-button-shape-'.$shape;
        $class[] = 'vcg-button-alignment-'.$alignment;
        $class[] = $id;
        $css[] = ( $padding ) ? 'padding: '.$padding.'; line-height: normal' : '';
        $css[] = ( $font_weight ) ? 'font-weight: '.$font_weight : '';
        $css[] = ( $text_transform ) ? 'text-transform: '.$text_transform : '';
        $css[] = ( $text_shadow ) ? 'text-shadow: '.$text_shadow : '';
        $css[] = ( $text_color ) ? 'color: '.$text_color.'!important' : '';
        $css[] = ( $background_color ) ? 'background-color: '.$background_color : '';
        $css[] = ( $background_color && $background_color2 ) ? 'background-image: linear-gradient(to right, '.$background_color.' , '.$background_color2.')' : '';
        $css[] = ( $width ) ? 'width: '.$width : '';
        $css[] = ( $font_size ) ? 'font-size: '.$font_size : '';
        ob_start();
        ?>

            <div class="vcg-button">
                <?php if( $background_color_hover ) : ?>
                    <style media="screen">
                        .<?php echo esc_attr( $id ); ?>:hover {
                            background-color: <?php echo $background_color_hover; ?>!important
                        }
                    </style>
                <?php endif; ?>
                <?php if( $text_color_hover ) : ?>
                    <style media="screen">
                        .<?php echo esc_attr( $id ); ?>:hover {
                            color: <?php echo $text_color_hover; ?>!important
                        }
                    </style>
                <?php endif; ?>
                <?php if( $underline != 'disabled' && $underline ) : ?>
                    <style media="screen">
                        .<?php echo esc_attr( $id ); ?> span {
                            border-bottom: <?php echo $underline; ?> solid <?php echo $text_color ? $text_color : ''; ?> ;
                        }
                    </style>
                <?php endif; ?>


                <a href="<?php echo $link; ?>" class="vcg-button-container <?php echo implode( ' ', $class ); ?>" style="<?php echo implode( '; ', array_filter($css) ); ?>">
                    <?php if( $icon_image ) : ?>
                        <span class="vcg-button-icon-image" style="background-image: url(<?php echo gillion_image_by_id( $icon_image ); ?>);"></span>
                    <?php endif; ?>
                    <span>
                        <?php echo esc_attr( $text ); ?>
                    </span>
                </a>
            </div>

        <?php return ob_get_clean();
    }

}
new vcButton();
