<?php
/*
Element: Button
*/

class vcSocialNetworks extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_social_networks', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Social Networks', 'gillion'),
                'base' => 'vcg_social_networks',
                'description' => __('Links to your social networks', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Facebook', 'gillion' ),
            			'param_name' => 'facebook',
            			'description' => __( 'Enter URL to your Facebook profile', 'gillion' ),
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Twitter', 'gillion' ),
            			'param_name' => 'twitter',
            			'description' => __( 'Enter URL to your Twitter profile', 'gillion' ),
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Tumblr', 'gillion' ),
            			'param_name' => 'tumblr',
            			'description' => __( 'Enter URL to your Tumblr profile', 'gillion' ),
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Pinterest', 'gillion' ),
            			'param_name' => 'pinterest',
            			'description' => __( 'Enter URL to your Pinterest profile', 'gillion' ),
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
            			'std' => 'center',
                        'admin_label' => false,
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'textfield',
            			'heading' => __( 'Font Size', 'gillion' ),
            			'param_name' => 'font_size',
            			'description' => __( 'Enter icon font size', 'gillion' ),
                        'std' => '18px',
                        'group' => __( 'Styling', 'gillion' ),
            		),

                    array(
            			'type' => 'colorpicker',
            			'heading' => __( 'Icon Color', 'gillion' ),
            			'param_name' => 'icon_color',
                        'value' => '',
                        'group' => __( 'Styling', 'gillion' ),
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
        $facebook = ( isset( $atts['facebook'] ) ) ? $atts['facebook'] : '';
        $twitter = ( isset( $atts['twitter'] ) ) ? $atts['twitter'] : '';
        $tumblr = ( isset( $atts['tumblr'] ) ) ? $atts['tumblr'] : '';
        $pinterest = ( isset( $atts['pinterest'] ) ) ? $atts['pinterest'] : '';

        $alignment = ( isset( $atts['alignment'] ) ) ? $atts['alignment'] : 'center';
        $font_size = ( isset( $atts['font_size'] ) ) ? $atts['font_size'] : '18px';
        $icon_color = ( isset( $atts['icon_color'] ) ) ? $atts['icon_color'] : '';
        $vc_css = ( isset( $atts['css'] ) ) ? $atts['css'] : 'none';

        /* Set Classes and Styles */
        $class = array(); $css = array();
        $class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $vc_css, ' ' ), $this->settings['base'], $atts );
        $class[] = $id;
        $class[] = ( $alignment ) ? 'vcg-social-networks-alignment-'.$alignment : '';
        $css[] = ( $font_size ) ? 'font-size: '.$font_size : '';
        $css[] = ( $icon_color ) ? 'color: '.$icon_color : '';
        ob_start();
        ?>

            <div class="vcg-social-networks <?php echo implode( ' ', $class ); ?>">
                <style media="screen">
                    .<?php echo esc_attr( $id ); ?> i {
                        <?php echo implode( ';', $css ); ?>
                    }
                </style>

                <div class="vcg-social-networks-container">
                    <?php if( $facebook ) : ?>
                        <a href="<?php echo esc_url( $facebook ); ?>" target = "_blank"  class="vcg-social-networks-item">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php endif; ?>

                    <?php if( $twitter ) : ?>
                        <a href="<?php echo esc_url( $twitter ); ?>" target = "_blank"  class="vcg-social-networks-item">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if( $tumblr ) : ?>
                        <a href="<?php echo esc_url( $tumblr ); ?>" target = "_blank"  class="vcg-social-networks-item">
                            <i class="fa fa-tumblr"></i>
                        </a>
                    <?php endif; ?>

                    <?php if( $pinterest ) : ?>
                        <a href="<?php echo esc_url( $pinterest ); ?>" target = "_blank"  class="vcg-social-networks-item">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcSocialNetworks();
