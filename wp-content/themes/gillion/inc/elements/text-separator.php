<?php
/*
Element: Blog Posts Categories
*/

class vcTextSeparator2 extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_text_seperator', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        $sizes = array(
            __( '12px', 'gillion' ) => '12px',
            __( '15px', 'gillion' ) => '15px',
            __( '18px', 'gillion' ) => '18px',
            __( '20px', 'gillion' ) => '20px',
            __( '21px', 'gillion' ) => '21px',
            __( '24px', 'gillion' ) => '24px',
            __( '27px', 'gillion' ) => '27px',
            __( '30px', 'gillion' ) => '30px',
            __( '36px', 'gillion' ) => '36px',
            __( '40px', 'gillion' ) => '40px',
            __( '46px', 'gillion' ) => '46px',
        );

        vc_map(
            array(
                'name' => __('Separator with Text V2', 'gillion'),
                'base' => 'vcg_text_seperator',
                'description' => __('Horizontal separator line with heading', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'title',
                        'heading' => __( 'Title', 'gillion' ),
                        'description' => __( 'Enter title', 'gillion' ),
                        'value' => 'Title',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Separator alignment', 'gillion' ),
            			'param_name' => 'align',
            			'value' => array(
            				__( 'Center', 'gillion' ) => 'center',
            				__( 'Left', 'gillion' ) => 'left',
            				__( 'Right', 'gillion' ) => 'right',
            			),
            			'description' => __( 'Select separator alignment.', 'gillion' ),
                        'admin_label' => true,
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Font Size', 'gillion' ),
            			'param_name' => 'size',
            			'value' => $sizes,
            			'std' => '24px',
            			'description' => __( 'Select title font size.', 'gillion' ),
            			'param_holder_class' => 'vc_colored-dropdown',
                        'admin_label' => true,
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Font Weight', 'gillion' ),
            			'param_name' => 'weight',
                        'value' => array(
            				__( 'Default (from theme settings)', 'gillion' ) => 'default',
                            __( 'Light', 'gillion' ) => '300',
            				__( 'Regular', 'gillion' ) => '400',
            				__( 'Bold', 'gillion' ) => '700',
                            __( 'Extra bold', 'gillion' ) => '900',
            			),
            			'std' => '24px',
            			'description' => __( 'Select title font weight.', 'gillion' ),
            			'param_holder_class' => 'vc_colored-dropdown',
                        'admin_label' => true,
            		),

                    /*array(
            			'type' => 'dropdown',
            			'heading' => __( 'Color', 'gillion' ),
            			'param_name' => 'color',
            			'value' => getVcShared( 'colors' ),
                        //'value' => array_merge( getVcShared( 'colors' ), array( __( 'Custom color', 'gillion' ) => 'custom' ) ),
            			'std' => 'grey',
            			'description' => __( 'Select color of separator.', 'gillion' ),
            			'param_holder_class' => 'vc_colored-dropdown',
            		),*/

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Title Color', 'gillion' ),
            			'param_name' => 'title_color',
            			'description' => __( 'Enter title color for your element.', 'gillion' ),
            		),

            		array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Line Color', 'gillion' ),
            			'param_name' => 'line_color',
            			'description' => __( 'Line color for your element.', 'gillion' ),
            			/*'dependency' => array(
            				'element' => 'color',
            				'value' => array( 'custom' ),
            			),*/
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Extra class name', 'gillion' ),
            			'param_name' => 'el_class',
            			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
            		),

            		array(
            			'type' => 'hidden',
            			'param_name' => 'layout',
            			'value' => 'separator_with_text',
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


    public function _html( $atts/*, $content*/ ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $title = ( isset( $atts['title'] ) ) ? $atts['title'] : 'Title';
        $weight = ( isset( $atts['weight'] ) ) ? $atts['weight'] : '';
        $align = ( isset( $atts['align'] ) ) ? $atts['align'] : 'center';
        $size  = ( isset( $atts['size'] ) ) ? $atts['size'] : '24px';
        $line_color  = ( isset( $atts['line_color'] ) ) ? $atts['line_color'] : '';
        $title_color  = ( isset( $atts['title_color'] ) ) ? $atts['title_color'] : '';

        $line_style = array();
        $line_style[] = ( $line_color ) ? 'border-color: '.$line_color : '';
        $title_style = array();
        $title_style[] = ( $title_color ) ? 'color: '.$title_color : '';
        $title_style[] = ( $weight && $weight != 'default' ) ? 'font-weight: '.$weight : '';

        $css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $class = array();
        $class[] = $css_class;
        ob_start();
        ?>

            <div class="text-seperator2 text-seperator2-align-<?php echo esc_attr( $align ); ?> <?php echo implode( ' ', $class ); ?>">
                <div class="text-seperator2-holder">
                    <div class="text-seperator2-line" style="<?php echo implode( ';', $line_style ); ?>"></div>
                </div>
                <div class="text-seperator2-content">
                    <h3 class="text-seperator2-content-heading size-<?php echo esc_attr( $size ); ?>" style="<?php echo implode( ';', $title_style ); ?>">
                        <?php echo ( $title ); ?>
                    </h3>
                </div>
                <div class="text-seperator2-holder">
                    <div class="text-seperator2-line" style="<?php echo implode( ';', $line_style ); ?>"></div>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcTextSeparator2();
