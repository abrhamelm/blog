<?php
/*
Element: Blog Posts Categories
*/

class vcTextBlock extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_textblock', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        $sizes = array(
            __( '12px', 'gillion' ) => '12px',
            __( '13px', 'gillion' ) => '13px',
            __( '14px', 'gillion' ) => '14px',
            __( '15px', 'gillion' ) => '15px',
            __( '16px', 'gillion' ) => '16px',
            __( '18px', 'gillion' ) => '18px',
            __( '21px', 'gillion' ) => '21px',
            __( '24px', 'gillion' ) => '24px',
            __( '27px', 'gillion' ) => '27px',
            __( '30px', 'gillion' ) => '30px',
            __( '36px', 'gillion' ) => '36px',
            __( '40px', 'gillion' ) => '40px',
            __( '46px', 'gillion' ) => '46px',
            __( '60px', 'gillion' ) => '60px',
            __( '86px', 'gillion' ) => '86px',
        );

        vc_map(
            array(
                'name' => __('Text Block V2', 'gillion'),
                'base' => 'vcg_textblock',
                'description' => __('A block of text with WYSIWYG editor', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'content',
                        'heading' => __( 'Content', 'gillion' ),
                        'description' => __( 'Enter your content', 'gillion' ),
                        'value' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'gillion' ),
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Font', 'gillion' ),
            			'param_name' => 'text_font',
                        'value' => array(
            				__( 'Default (body font)', 'gillion' ) => 'default',
            				__( 'Heading font', 'gillion' ) => 'heading',
            				__( 'Categories font', 'gillion' ) => 'categories',
            			),
            			'std' => 'default',
            			'description' => __( 'Select title font weight.', 'gillion' ),
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Font Weight', 'gillion' ),
            			'param_name' => 'text_weight',
                        'value' => array(
                            __( 'Light', 'gillion' ) => '300',
            				__( 'Regular', 'gillion' ) => '400',
                            __( 'Semi-Bold', 'gillion' ) => '600',
            				__( 'Bold', 'gillion' ) => '700',
                            __( 'Extra bold', 'gillion' ) => '900',
            			),
            			'std' => '400',
            			'description' => __( 'Select text font weight.', 'gillion' ),
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Heading Font Weight', 'gillion' ),
            			'param_name' => 'heading_weight',
                        'value' => array(
                            __( 'Light', 'gillion' ) => '300',
            				__( 'Regular', 'gillion' ) => '400',
            				__( 'Bold', 'gillion' ) => '700',
                            __( 'Extra bold', 'gillion' ) => '900',
            			),
            			'std' => '700',
            			'description' => __( 'Select text heading and strong/bold text font weight.', 'gillion' ),
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'line_height',
                        'heading' => __( 'Line Height', 'gillion' ),
                        'description' => __( 'Enter text line height', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                        'group' => __( 'Styling', 'gillion' ),
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
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Shadow', 'gillion' ),
            			'param_name' => 'text_shadow',
                        'value' => array(
                            __( 'None (default)', 'gillion' ) => 'none',
            				__( 'Small shadow', 'gillion' ) => '0px 2px 6px rgba(0,0,0,0.15)',
            				__( 'Medium shadow ', 'gillion' ) => '0px 3px 10px rgba(0,0,0,0.15) ',
                            __( 'Large shadow', 'gillion' ) => '0px 7px 20px rgba(0,0,0,0.15)',
            			),
            			'std' => 'none',
            			'description' => __( 'Select text shadow', 'gillion' ),
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
                        'param_name' => 'max_width',
                        'heading' => __( 'Max Width', 'gillion' ),
                        'description' => __( 'Enter max width for this element', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
                        'group' => __( 'Styling', 'gillion' ),
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

        $text_font = ( isset( $atts['text_font'] ) ) ? $atts['text_font'] : '';
        $text_weight = ( isset( $atts['text_weight'] ) ) ? $atts['text_weight'] : '400';
        $heading_weight = ( isset( $atts['heading_weight'] ) ) ? $atts['heading_weight'] : '700';
        $text_transform = ( isset( $atts['text_transform'] ) ) ? $atts['text_transform'] : 'none';
        $line_height = ( isset( $atts['line_height'] ) ) ? $atts['line_height'] : '';
        $text_shadow = ( isset( $atts['text_shadow'] ) ) ? $atts['text_shadow'] : 'none';
        $max_width = ( isset( $atts['max_width'] ) ) ? $atts['max_width'] : '';

        $id = 'vcg-text-block-'.gillion_rand();
        $css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $class = array();
        $class[] = $id;
        $class[] = $css_class;
        $class[] = ( isset( $atts['el_class'] ) ) ? $atts['el_class'] : '';
        ob_start();
        ?>

            <div class="vcg-text-block <?php echo implode( ' ', $class ); ?>">
                <?php if( $text_font && $text_font != 'default' ) : ?>
                    <style media="screen">
                        .<?php echo esc_attr( $id ); ?> p { <?php
                            if( $text_font == 'heading' ) :
            					echo 'font-family: "'.gillion_option_value('styling_headings','family').'"';
        					elseif( $text_font == 'categories' ) :
                                echo 'font-family: "'.gillion_option_value('categories_font','family').'"';
        					endif;
                        ?> }
                    </style>
                <?php endif; ?>

                <style media="screen">
                    <?php if( $text_weight && $text_weight != '400' ) : ?>
                            .<?php echo esc_attr( $id ); ?> {
                                font-weight: <?php echo esc_attr( $text_weight ); ?>;
                            }
                    <?php endif; ?>

                    <?php if( $heading_weight && $heading_weight != '700' ) : ?>
                            .<?php echo esc_attr( $id ); ?> h1,
                            .<?php echo esc_attr( $id ); ?> h2,
                            .<?php echo esc_attr( $id ); ?> h3,
                            .<?php echo esc_attr( $id ); ?> h4,
                            .<?php echo esc_attr( $id ); ?> h5,
                            .<?php echo esc_attr( $id ); ?> h6,
                            .<?php echo esc_attr( $id ); ?> strong {
                                font-weight: <?php echo esc_attr( $heading_weight ); ?>;
                            }
                    <?php endif; ?>

                    <?php if( $text_transform && $text_transform != 'none' ) : ?>
                            .<?php echo esc_attr( $id ); ?> {
                                text-transform: <?php echo esc_attr( $text_transform ); ?>;
                            }
                    <?php endif; ?>

                    <?php if( $line_height ) : ?>
                        .<?php echo esc_attr( $id ); ?>,
                        .<?php echo esc_attr( $id ); ?> * {
                            line-height: <?php echo esc_attr( $line_height ); ?>;
                        }
                    <?php endif; ?>

                    <?php if( $text_shadow && $text_shadow != 'none' ) : ?>
                        .<?php echo esc_attr( $id ); ?> {
                            text-shadow: <?php echo esc_attr( $text_shadow ); ?>;
                        }
                    <?php endif; ?>

                    <?php if( $max_width ) : ?>
                        .<?php echo esc_attr( $id ); ?> {
                            max-width: <?php echo ( is_numeric( $max_width ) ) ? esc_attr( $max_width ).'px' : $max_width; ?>;
                        }
                    <?php endif; ?>
                </style>

                <div class="vcg-text-block-content">
                    <?php echo do_shortcode( $content ); ?>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcTextBlock();
