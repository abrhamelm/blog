<?php
/*
Element: Blog Posts Categories
*/

class vcHeading extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_heading', array( $this, '_html' ) );
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
                'name' => __('Heading V2', 'gillion'),
                'base' => 'vcg_heading',
                'description' => __('Title with various options', 'gillion'),
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
            			'type' => 'colorpicker',
            			'heading' => __( 'Title Color', 'gillion' ),
            			'param_name' => 'title_color',
            			'description' => __( 'Enter title color for your element.', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Title Hover Color', 'gillion' ),
            			'param_name' => 'title_hover_color',
            			'description' => __( 'Enter title hover color for your element.', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text alignment', 'gillion' ),
            			'param_name' => 'align',
            			'value' => array(
            				__( 'Center', 'gillion' ) => 'center',
            				__( 'Left', 'gillion' ) => 'left',
            				__( 'Right', 'gillion' ) => 'right',
            			),
            			'description' => __( 'Select text alignment.', 'gillion' ),
                        'admin_label' => true,
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Font Size', 'gillion' ),
            			'param_name' => 'size',
            			'value' => $sizes,
            			'std' => '24px',
            			'description' => __( 'Select title font size.', 'gillion' ),
                        'admin_label' => true,
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Heading font', 'gillion' ),
            			'param_name' => 'font',
                        'value' => array(
            				__( 'Default (heading font)', 'gillion' ) => 'default',
            				__( 'Body font', 'gillion' ) => 'body',
            				__( 'Categories font', 'gillion' ) => 'categories',
                            __( 'Additional font', 'gillion' ) => 'additional',
            			),
            			'std' => 'default',
            			'description' => __( 'Select title font weight.', 'gillion' ),
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Font Weight', 'gillion' ),
            			'param_name' => 'weight',
                        'value' => array(
            				__( 'Default (from theme settings)', 'gillion' ) => 'default',
                            __( 'Light', 'gillion' ) => '300',
            				__( 'Regular', 'gillion' ) => '400',
                            __( 'Semi-Bold', 'gillion' ) => '600',
            				__( 'Bold', 'gillion' ) => '700',
                            __( 'Extra bold', 'gillion' ) => '900',
            			),
            			'std' => 'default',
            			'description' => __( 'Select title font weight.', 'gillion' ),
                        'admin_label' => false,
            		),

                    array(
            			'type' => 'dropdown',
            			'heading' => __( 'Text Transform', 'gillion' ),
            			'param_name' => 'transform',
                        'value' => array(
            				__( 'None', 'gillion' ) => 'none',
                            __( 'Lowercase', 'gillion' ) => 'lowercase',
            				__( 'Uppercase', 'gillion' ) => 'uppercase',
            				__( 'Capitalize', 'gillion' ) => 'capitalize',
            			),
            			'std' => 'none',
            			'description' => __( 'Select title text transform.', 'gillion' ),
                        'admin_label' => false,
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
                        'param_name' => 'line_height',
                        'heading' => __( 'Line Height', 'gillion' ),
                        'description' => __( 'Enter text line height in px, em or %', 'gillion' ),
                        'value' => '',
                        'type' => 'textfield',
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
            		),

                    array(
            			'type' => 'iconpicker',
            			'heading' => __( 'Icon', 'gillion' ),
            			'param_name' => 'icon',
            			'description' => __( 'Add icon on the left side of title', 'gillion' ),
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Max Width', 'gillion' ),
            			'param_name' => 'max_width',
            			'description' => __( 'Enter max width in px, em or %', 'gillion' ),
            		),

                    array(
                        'param_name' => 'link',
                        'heading' => __( 'Link', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'link_target',
                        'heading' => __( 'Link Target', 'gillion' ),
                        'value' => array(
                            __('Same window', 'gillion') => '_self',
                            __('New window', 'gillion') => '_blank',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'animation_style',
                        'heading' => __( 'Animation Style', 'text-domain' ),
                        'param_name' => 'animation',
                        'description' => __( 'Choose your animation style', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Animation',
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


    public function _html( $atts/*, $content*/ ) {
        $atts = ( isset( $atts ) && is_array( $atts ) ) ? $atts : array();

        $title = ( isset( $atts['title'] ) ) ? $atts['title'] : 'Title';
        $font = ( isset( $atts['font'] ) ) ? $atts['font'] : '';
        $weight = ( isset( $atts['weight'] ) ) ? $atts['weight'] : '';
        $transform = ( isset( $atts['transform'] ) ) ? $atts['transform'] : '';
        $align = ( isset( $atts['align'] ) ) ? $atts['align'] : 'center';
        $size  = ( isset( $atts['size'] ) ) ? $atts['size'] : '24px';
        $title_color  = ( isset( $atts['title_color'] ) ) ? $atts['title_color'] : '';
        $title_hover_color  = ( isset( $atts['title_hover_color'] ) ) ? $atts['title_hover_color'] : '';
        $icon = ( isset( $atts['icon'] ) ) ? $atts['icon'] : '';
        $max_width = ( isset( $atts['max_width'] ) ) ? $atts['max_width'] : '';
        $max_width = ( is_numeric( $max_width ) ) ? $max_width.'px' : $max_width;
        $line_height = ( isset( $atts['line_height'] ) ) ? $atts['line_height'] : '';
        $text_shadow = ( isset( $atts['text_shadow'] ) ) ? $atts['text_shadow'] : 'none';
        $animation = ( isset( $atts['animation'] ) ) ? $atts['animation'] : '';
        $link = ( isset( $atts['link'] ) ) ? $atts['link'] : '';
        $link_target = ( isset( $atts['link_target'] ) ) ? $atts['link_target'] : '_self';

        $title_style = array();
        $title_style[] = ( $title_color ) ? 'color: '.$title_color : '';
        $title_style[] = ( $weight && $weight != 'default' ) ? 'font-weight: '.$weight : '';
        $title_style[] = ( $transform && $transform != 'none' ) ? 'text-transform: '.$transform : '';
        $title_style[] = ( $max_width ) ? 'max-width: '.$max_width : '';
        $title_style[] = ( $max_width ) ? 'margin: 0 auto' : '';
        $title_style[] = ( $line_height ) ? 'line-height: '.esc_attr( $line_height ).'!important' : '';
        $title_style[] = ( $text_shadow && $text_shadow != 'none' ) ? 'text-shadow: '.esc_attr( $text_shadow ) : '';

        $id = 'vcg-heading-'.gillion_rand();
        $css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $class = array();
        $class[] = $id;
        $class[] = $css_class;

        $animation_classes = $this->getCSSAnimation( $animation );
        ob_start();
        ?>

            <?php if( ( $font && $font != 'default' ) || $title_hover_color ) : ?>
                <style media="screen">
                    <?php if( $font && $font != 'default' ) : ?>
                        .<?php echo esc_attr( $id ); ?> *:not(i) { <?php
                            if( $font == 'body' ) :
                                echo 'font-family: "'.gillion_option_value('body','family').'"';
                            elseif( $font == 'categories' ) :
                                echo 'font-family: "'.gillion_option_value('categories_font','family').'"';
                            elseif( $font == 'additional' ) :
                                echo 'font-family: "'.gillion_option_value('additional_font','family').'"';
                            endif;
                        ?> }
                    <?php endif; ?>

                    <?php if( $title_hover_color ) : ?>
                        .<?php echo esc_attr( $id ); ?> *:hover {
                            color: <?php echo esc_attr( $title_hover_color ); ?>!important;
                        }
                    <?php endif; ?>
                </style>
            <?php endif; ?>

            <div class="vcg-heading <?php echo implode( ' ', $class ); ?>">
                <?php echo ( $link ) ? '<a href="'. esc_url( $link ) .'" target="'.$link_target.'">' : ''; ?>
                    <h3 class="vcg-heading-content vcg-heading-align-<?php echo esc_attr( $align ); ?> size-<?php echo esc_attr( $size ); ?> <?php echo esc_attr( $animation_classes ); ?>" style="<?php echo implode( '; ', $title_style ); ?>">
                        <?php if( $icon ) : ?>
                            <i class="<?php echo esc_attr( $icon ); ?>"></i>
                        <?php endif; ?>
                        <?php echo ( $title ); ?>
                    </h3>
                <?php echo ( $link ) ? '</a>' : ''; ?>
            </div>

        <?php return ob_get_clean();
    }

}
new vcHeading();
