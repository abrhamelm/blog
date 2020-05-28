<?php
/*
Element: Button
*/

class vcList extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_list', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('List', 'gillion'),
                'base' => 'vcg_list',
                'description' => __('Simple list with simple options', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'content',
                        'heading' => __( 'Content', 'gillion' ),
                        'description' => __( 'Enter your content', 'gillion' ),
                        'value' => __( 'I am list', 'gillion' ),
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

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
                        'param_name' => 'class',
                        'heading' => __( 'Extra class name', 'gillion' ),
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Icon Color', 'gillion' ),
            			'param_name' => 'icon_color',
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
        // Params extraction
        extract( shortcode_atts( array(
            'icon' => '',
            'class' => '',
            'icon_color' => '',
            'css' => 'none'
        ), $atts ) );

        // HTML
        $id = 'sh-list-'.gillion_rand();
        $element_class = array();
        $element_class[] = $id;
        $element_class[] = $class;
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
        ob_start(); ?>

            <div class="vcg-list">
                <?php if( $icon ) : ?>
                    <div class="vcg-list-icon">
                        <i class="<?php echo esc_attr( $icon ); ?>"<?php echo ( $icon_color ) ? 'style="color: '.esc_attr( $icon_color ).';"' : ''; ?>></i>
                    </div>
                <?php endif; ?>

                <div class="vcg-list-content">
                    <?php echo $content; ?>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcList();
