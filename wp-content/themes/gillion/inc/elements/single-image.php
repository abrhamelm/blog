<?php
/*
Element: Button
*/

class vcSingleImage extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_single_image', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Single Image V2', 'gillion'),
                'base' => 'vcg_single_image',
                'description' => __('Responsive image element', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'image',
                        'heading' => __( 'Images', 'gillion' ),
                        'value' => __( 'Choose images', 'gillion' ),
                        'type' => 'attach_image',
                        'admin_label' => false,
                    ),

                    array(
                        'param_name' => 'image_size',
                        'heading' => __( 'Image Size', 'gillion' ),
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
            			'type' => 'dropdown',
            			'heading' => __( 'Alignment', 'gillion' ),
            			'param_name' => 'align',
            			'value' => array(
            				__( 'Center', 'gillion' ) => 'center',
            				__( 'Left', 'gillion' ) => 'left',
            				__( 'Right', 'gillion' ) => 'right',
            			),
                        'std' => 'center',
            			'description' => __( 'Select image alignment.', 'gillion' ),
                        'admin_label' => true,
            		),

                    array(
                        'param_name' => 'border_radius',
                        'heading' => __( 'Border Radius', 'gillion' ),
                        'description' => __( 'Choose border radius', 'gillion' ),
                        'value' => array(
                            __('0px', 'gillion') => '0px',
                            __('1px', 'gillion') => '1px',
                            __('2px', 'gillion') => '2px',
                            __('3px', 'gillion') => '3px',
                            __('4px', 'gillion') => '4px',
                            __('5px', 'gillion') => '5px',
                            __('6px', 'gillion') => '6px',
                            __('7px', 'gillion') => '7px',
                            __('8px', 'gillion') => '8px',
                            __('9px', 'gillion') => '9px',
                            __('10px', 'gillion') => '10px',
                            __('15px', 'gillion') => '15px',
                            __('20px', 'gillion') => '20px',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'group' => __( 'Border', 'gillion' ),
                    ),

                    array(
            			'param_name' => 'border_color',
            			'heading' => __( 'Border Color', 'gillion' ),
                        'description' => __( 'Choose slider style', 'gillion' ),
            			'type' => 'colorpicker',
                        'group' => __( 'Border', 'gillion' ),
            		),

                    array(
                        'param_name' => 'border_size',
                        'heading' => __( 'Border Size', 'gillion' ),
                        'description' => __( 'Choose border size', 'gillion' ),
                        'value' => array(
                            __('1px', 'gillion') => '1px',
                            __('2px', 'gillion') => '2px',
                            __('3px', 'gillion') => '3px',
                            __('4px', 'gillion') => '4px',
                            __('5px', 'gillion') => '5px',
                            __('6px', 'gillion') => '6px',
                            __('7px', 'gillion') => '7px',
                            __('8px', 'gillion') => '8px',
                            __('9px', 'gillion') => '9px',
                            __('10px', 'gillion') => '10px',
                            __('15px', 'gillion') => '15px',
                            __('20px', 'gillion') => '20px',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'group' => __( 'Border', 'gillion' ),
                    ),

                    array(
                        'param_name' => 'border_style',
                        'heading' => __( 'Border Style', 'gillion' ),
                        'description' => __( 'Choose border style', 'gillion' ),
                        'value' => array(
                            __('Solid', 'gillion') => 'solid',
                            __('Dashed', 'gillion') => 'dashed',
                            __('Dotted', 'gillion') => 'dotted',
                            __('Double', 'gillion') => 'double',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'group' => __( 'Border', 'gillion' ),
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
                        'admin_label' => false,
                    ),

                    array(
                        'param_name' => 'shadow',
                        'heading' => __( 'Shadow', 'gillion' ),
                        'description' => __( 'Select image shadow', 'gillion' ),
                        'value' => array(
                            __('Disabled', 'gillion') => 'disabled',
                            __('Shadow 1', 'gillion') => 'shadow1',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                    ),

                    array(
                        'param_name' => 'tag',
                        'heading' => __( 'Tag', 'gillion' ),
                        'description' => __( 'Select iamge tag', 'gillion' ),
                        'value' => array(
                            __('Disabled', 'gillion') => 'disabled',
                            __('New', 'gillion') => 'new',
                            __('Trending', 'gillion') => 'trending',
                            __('Soon', 'gillion') => 'soon',
                            __('Plus 3', 'gillion') => 'plus3',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                    ),

                    array(
                        'param_name' => 'stretch',
                        'heading' => __( 'Stretch image outside column borders', 'gillion' ),
                        'description' => __( 'Use when column is', 'gillion' ),
                        'value' => array(
                            __('Disabled', 'gillion') => 'disabled',
                            __('Left column to left page border', 'gillion') => 'left',
                            __('Right column to right page border', 'gillion') => 'right',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                    ),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Extra class name', 'gillion' ),
            			'param_name' => 'el_class',
            			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
            		),

                    array(
                        'param_name' => 'overlay',
                        'heading' => __( 'Overlay', 'gillion' ),
                        'value' => array(
                            __( 'Disabled', 'gillion' ) => 'disabled',
                            __( 'Style1', 'gillion' ) => 'style1',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'group' => __( 'Overlay', 'gillion' ),
                    ),

                    array (
                        'param_name' => 'overlay_icon',
                        'heading' => 'Overlay Icon',
                        'description' => 'Select overlay icon besides text',
                        'value' => '',
                        'type' => 'iconpicker',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'std' => '',
                        'group' => __( 'Overlay', 'gillion' ),
                        'settings' => array (
                            'emptyIcon' => true,
                            'type' => 'gillion_vc_icons',
                        ),
                    ),

                    array(
                        'param_name' => 'overlay_text',
                        'heading' => __( 'Overlay Text', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => false,
                        'group' => __( 'Overlay', 'gillion' ),
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
            'image' => '',
            'image_size' => 'large',
            'align' => 'center',
            'shadow' => 'disabled',
            'border_radius' => '0px',
            'border_size' => '1px',
            'border_style' => 'solid',
            'border_color' => '',
            'link' => '',
            'link_target' => '_self',
            'tag' => 'disabled',
            'stretch' => 'disabled',
            'overlay' => 'disabled',
            'overlay_icon' => '',
            'overlay_text' => '',
            'class' => '',
            'css' => 'none',
        ), $atts ) );

        // HTML
        $id = 'sh-single-image-'.gillion_rand();
        $element_class = array();
        $element_class[] = $id;
        $element_class[] = $class;
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        if( $shadow != 'disabled' ) :
            $element_class[] = 'vcg-single-image-'.$shadow;
        endif;
        ob_start(); ?>

            <div class="vcg-single-image<?php echo ( $stretch != 'disabled' ) ? ' vcg-single-image-stretch-'.$stretch : ''; ?> vcg-single-image-align-<?php echo esc_attr( $align ); ?>">
                <div class="vcg-single-image-container <?php echo implode( ' ', $element_class ); ?>">
                    <?php
                    $image = wp_get_attachment_image_src( $image, $image_size );
                    if( isset( $image[0] ) && $image[0] ) : ?>
                        <?php echo ( $link ) ? '<a href="'. esc_url( $link ) .'" target="'.$link_target.'">' : ''; ?>

                            <div class="vcg-single-image-source" style="border-radius: <?php echo esc_attr( $border_radius ); ?>; <?php echo ( $border_color ) ? 'border: '.$border_size.' '.$border_style.' '.$border_color.';' : ''; ?>">
                                <img src="<?php echo esc_url( $image[0] ) ; ?>" alt="" />

                                <?php if( $overlay != 'disabled' ) : ?>
                                    <div class="vcg-single-image-overlay">
                                        <span>
                                            <?php if( $overlay_icon ) : ?>
                                                <i class="<?php echo esc_attr( $overlay_icon ); ?>"></i>
                                            <?php endif; ?>
                                            <?php echo esc_attr( $overlay_text ); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php echo ( $link ) ? '</a>' : ''; ?>
                    <?php endif; ?>

                    <?php if( $tag != 'disabled' ) : ?>
                        <div class="vcg-single-image-tag vcg-single-image-tag-<?php echo ( $tag == 'plus3') ? 'trending vcg-single-image-tag-number' :  esc_attr( $tag ); ?>">
                            <?php if( $tag == 'new' ) : ?>
                                <span>NEW</span>
                            <?php elseif( $tag == 'trending' ) : ?>
                                <span>
                                    <i class="ti-bolt-alt"></i>
                                </span>
                            <?php elseif( $tag == 'plus3' ) : ?>
                                <span>
                                    +3
                                </span>
                            <?php else : ?>
                                <span>
                                    <i class="ti-timer"></i>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcSingleImage();
