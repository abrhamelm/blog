<?php
/*
Element: Button
*/

class vcSeperator extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_seperator', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Seperator V2', 'gillion'),
                'base' => 'vcg_seperator',
                'description' => __('Simple seperator with simple options', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'color',
            			'heading' => __( 'Color', 'gillion' ),
                        'description' => __( 'Select separator color', 'gillion' ),
            			'type' => 'colorpicker',
                        'value' => '',
            		),

                    array(
                        'param_name' => 'alignment',
                        'heading' => __( 'Alignment', 'gillion' ),
                        'description' => __( 'Select separator alignment', 'gillion' ),
                        'value' => array(
                            'Left' => 'left',
                            'Center' => 'center',
                            'Right' => 'right',
                        ),
                        'type' => 'dropdown',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'border_height',
                        'heading' => __( 'Border height', 'gillion' ),
                        'description' => __( 'Select border width (pixels)', 'gillion' ),
                        'value' => array(
                            '1px' => '1px',
                            '2px' => '2px',
                            '3px' => '3px',
                            '4px' => '4px',
                            '5px' => '5px',
                            '6px' => '6px',
                            '7px' => '7px',
                            '8px' => '8px',
                            '9px' => '9px',
                            '10px' => '10px',
                        ),
                        'type' => 'dropdown',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'max_width',
                        'heading' => __( 'Element Max Width', 'gillion' ),
                        'description' => __( 'Enter separator max width', 'gillion' ),
                        'std' => '100%',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'class',
                        'heading' => __( 'Extra class name', 'gillion' ),
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
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


    public function _html( $atts ) {
        // Params extraction
        extract( shortcode_atts( array(
            'color' => '#ececec',
            'alignment' => 'left',
            'border_height' => '1px',
            'max_width' => '100%',
            'class' => '',
            'css' => 'none'
        ), $atts ) );

        // HTML
        $id = 'sh-list-'.gillion_rand();
        $element_class = array();
        $element_class[] = $id;
        $element_class[] = $class;
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        if( $alignment == 'left' ) :
            $margin = '';
        elseif( $alignment == 'right' ) :
            $margin = 'margin-left: auto';
        else :
            $margin = 'margin: 0 auto';
        endif;
        ob_start(); ?>

            <div class="vcg-seperator">
                <div class="vcg-seperator-line" style="<?php echo esc_attr( $margin ); ?>; background-color: <?php echo esc_attr( $color ); ?>; height: <?php echo esc_attr( $border_height ); ?>; max-width: <?php echo esc_attr( $max_width ); ?>;"></div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcSeperator();
