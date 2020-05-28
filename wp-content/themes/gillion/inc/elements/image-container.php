<?php
/*
Element: Button
*/

class vcImageContainer extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_image_container', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Image Container', 'gillion'),
                'base' => 'vcg_image_container',
                'description' => __('Image with additional information', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
                        'param_name' => 'image',
                        'heading' => __( 'Image', 'gillion' ),
                        'value' => __( 'Choose image', 'gillion' ),
                        'type' => 'attach_image',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'title',
                        'heading' => __( 'Title', 'gillion' ),
                        'value' => '<b>Custom</b> Title',
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'description',
                        'heading' => __( 'Description', 'gillion' ),
                        'value' => __( 'I am description', 'gillion' ),
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'param_name' => 'url',
                        'heading' => __( 'URL (link)', 'gillion' ),
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
        /* Get Values */
        extract( shortcode_atts( array(
           'title' => '<b>Custom</b> Title',
           'description' => 'I am description',
           'image' => '',
           'url' => '',
           'css' => 'none'
        ), $atts ));
        $image = ( $image > 0 ) ? wp_get_attachment_image_src( $image , 'full' ) : '';

        /* Set Classes */
        $class = array();
        $class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
        ob_start();
        ?>

            <div class="vcg-image-container <?php echo implode( ' ', $class ); ?>">
                <?php if( isset( $image[0] ) ) : ?>
                    <div class="post-thumbnail">
                        <img src="<?php echo esc_url( $image[0] ); ?>" alt="" />
    					<?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ), '', '', '', $url ); ?>
    				</div>
                <?php endif; ?>

                <div class="vcg-image-container-content">
                    <div class="vcg-image-container-content-left">
                        <a href="<?php echo esc_url( $url ); ?>">
                            <h3><?php echo ( $title ); ?></h3>
                        </a>
                        <p class="sh-heading-font"><?php echo esc_attr( $description ); ?></p>
                    </div>
                    <div class="vcg-image-container-content-right">
                        <span class="vcg-image-container-share">
                            <i class="icon icon-share"></i>
                            <div class="vcg-image-container-social" data-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo strip_tags( $title ); ?>"></div>
                        </span>
                    </div>
                </div>
            </div>

        <?php return ob_get_clean();
    }

}
new vcImageContainer();
