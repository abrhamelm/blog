<?php
/*
Element: Button
*/

class vcIcon extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_icon', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Icon', 'gillion'),
                'base' => 'vcg_icon',
                'description' => __('Add simple icon', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'icon',
                        'heading' => __( 'Icon', 'gillion' ),
                        'description' => __( 'Choose list icon', 'gillion' ),
                        'type' => 'iconpicker',
                        'admin_label' => true,
                        'settings' => array (
                            'emptyIcon' => true,
                            'type' => 'gillion_vc_icons',
                        ),
                    ),

                    array(
                        'param_name' => 'url',
                        'heading' => __( 'URL', 'gillion' ),
                        'type' => 'vc_link',
                    ),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Icon Size', 'gillion' ),
            			'param_name' => 'icon_size',
            			'description' => __( 'Enter icon size in px', 'gillion' ),
                        'value' => '18px',
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Icon Color', 'gillion' ),
            			'param_name' => 'icon_color',
                        'value' => '#ffffff',
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Icon Color (hover)', 'gillion' ),
            			'param_name' => 'icon_color_hover',
                        'value' => '',
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Extra class name', 'gillion' ),
            			'param_name' => 'class',
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
        // Params extraction
        extract( shortcode_atts( array(
            'icon' => '',
            'url' => array(),
            'icon_size' => '18px',
            'icon_color' => '',
            'icon_color_hover' => '',
            'class' => '',
            'css' => 'none',
        ), $atts ) );

        // HTML
        $id = 'vcg-icon-'.gillion_rand();
        $element_class = array();
        $element_class[] = $id;
        $element_class[] = $class;
        $element_class[] = 'vcg-icon';
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        // Link construct
        $url = ( $url == '||' ) ? '' : $url;
        $url = vc_build_link( $url );
        $a_link = $url['url'];
        $a_title = ( $url['title'] == '' ) ? '' : 'title="'.$url['title'].'"';
        $a_target = ( $url['target'] == '' ) ? '' : 'target="'.$url['target'].'"';

        // CSS
        $css = [];
        $css[] = ( $icon_color ) ? 'color: '.$icon_color : '';
        $css[] = ( $icon_size ) ? 'font-size: '.$icon_size : '';

        ob_start(); ?>

            <div class="<?php echo implode( ' ', $element_class ); ?>">
                <?php if( $icon_color_hover ) : ?>
                    <style media="screen">
                        .<?php echo esc_attr( $id ); ?>:hover i {
                            color: <?php echo $icon_color_hover; ?>!important
                        }
                    </style>
                <?php endif; ?>

                <?php if( $a_link ) : ?>
                    <a href="<?php echo esc_attr( $a_link ); ?>" <?php echo esc_attr( $a_title ); ?> <?php echo esc_attr( $a_target ); ?>>
                <?php endif; ?>

                    <?php if( $icon ) : ?>
                        <i class="<?php echo esc_attr( $icon ); ?>" style="<?php echo implode( '; ', array_filter($css) ); ?>"></i>
                    <?php endif; ?>

                <?php if( $a_link ) : ?>
                    </a>
                <?php endif; ?>
            </div>

        <?php return ob_get_clean();
    }

}
new vcIcon();
