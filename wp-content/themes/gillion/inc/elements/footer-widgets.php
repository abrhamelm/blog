<?php
/*
Element: Footer Widgets
*/

class vcj_footer_widgets extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcj_footer_widgets', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Footer Widgets Builder', 'gillion'),
                'base' => 'vcj_footer_widgets',
                'description' => __('Add widgets in WPbakery based footer', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array (
                        'param_name' => 'alignment',
                        'heading' => 'Widgets Alignment',
                        'description' => 'Choose widgets alignment',
                        'value' => array (
                            'Vertical (below each other)' => 'vertical',
                            'Horizontal (side by side)' => 'horizontal',
                        ),
                        'type' => 'dropdown',
                        'std' => 'vertical',
                    ),

                    array (
                        'param_name' => 'columns',
                        'heading' => 'Columns',
                        'description' => 'Choose widgets columns count (for horizontal algnment)',
                        'value' =>
                        array (
                            '1 Columns' => '1',
                            '2 Columns' => '2',
                            '3 Columns' => '3',
                            '4 Columns' => '4',
                            '5 Columns' => '5',
                        ),
                        'type' => 'dropdown',
                        'std' => '3',
                    ),

                    array (
                        'param_name' => 'preset',
                        'heading' => 'Color Preset',
                        'description' => 'Choose color preset, that can be overwritten by color options',
                        'value' =>
                        array (
                            'Dark Text' => 'dark',
                            'Light Text' => 'light',
                        ),
                        'type' => 'dropdown',
                        'std' => 'dark',
                    ),

                    array(
                        'param_name' => 'text_size',
                        'heading' => __( 'Text Font Size', 'gillion' ),
                        'description' => __( 'Enter text font size (Note: CSS measurement units allowed).', 'gillion' ),
                        'type' => 'textfield',
                        'std' => '',
                    ),

                    array(
                        'param_name' => 'heading_size',
                        'heading' => __( 'Heading Font Size', 'gillion' ),
                        'description' => __( 'Enter heading size (Note: CSS measurement units allowed).', 'gillion' ),
                        'type' => 'textfield',
                        'std' => '',
                    ),

                    array(
                        'param_name' => 'line_height',
                        'heading' => __( 'Line Height', 'gillion' ),
                        'description' => __( 'Enter line height (Note: CSS measurement units allowed).', 'gillion' ),
                        'type' => 'textfield',
                        'std' => '',
                    ),

                    array (
                        'param_name' => 'source',
                        'heading' => 'Widget Source',
                        'description' => 'Modify widgets <a href="'.admin_url( '/widgets.php' ).'" target="_blank">here</a>. If necessary, you can choose other widget source than footer widgets',
                        'value' =>
                        array (
                            'Footer 1 Widgets' => 'footer-widgets1',
                            'Footer 2 Widgets' => 'footer-widgets2',
                            'Footer 3 Widgets' => 'footer-widgets3',
                            'Blog Widgets' => 'blog-widgets',
                            'Page Widgets' => 'page-widgets',
                            'Shop Widgets' => 'woocommerce-widgets',
                            'WPbakery Page Builder Widgets' => 'vc-widgets',
                            '404 Widgets' => '404-widgets',
                            'Side Widgets' => 'side-widgets',
                        ),
                        'type' => 'dropdown',
                        'std' => 'footer_widgets',
                    ),

                    array (
                        'param_name' => 'heading_color',
                        'heading' => 'Heading Color',
                        'description' => 'Select heading color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'text_color',
                        'heading' => 'Text Color',
                        'description' => 'Select text color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'link_color',
                        'heading' => 'Link Color',
                        'description' => 'Select link color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'link_hover_color',
                        'heading' => 'Link Hover Color',
                        'description' => 'Select link hover color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'icon_color',
                        'heading' => 'Icon Color',
                        'description' => 'Select icon color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'border_color',
                        'heading' => 'Border Color',
                        'description' => 'Select border color',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

                    array (
                        'param_name' => 'border_color2',
                        'heading' => 'Border Color 2',
                        'description' => 'Select border color 2',
                        'type' => 'colorpicker',
                        'group' => 'Colors',
                    ),

            		array(
            			'param_name' => 'css',
            			'type' => 'css_editor',
            			'heading' => __( 'CSS box', 'gillion' ),
            			'group' => __( 'Design Options', 'gillion' ),
            		),

                ),
            )
        );

    }


    public function _html( $atts ) {
        // Params extraction
        extract( shortcode_atts( array(
            'columns' => '3',
            'alignment' => 'vertical',
            'css' => 'none',
            'text_size' => '',
            'heading_size' => '',
            'line_height' => '',
            'source' => 'footer-widgets1',
            'preset' => 'dark',
            'heading_color' => '',
            'text_color' => '',
            'link_color' => '',
            'link_hover_color' => '',
            'icon_color' => '',
            'border_color' => '',
            'border_color2' => '',
        ), $atts ) );


        // HTML
        $id = 'sh-footer-builder-widgets-'.gillion_rand();
        $element_class = array();
        $element_class[] = $id;
        $element_class[] = 'sh-footer-builder-widgets-'.$columns.'columns';
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


        // Preset
        if( $preset == 'light' ) :
            $colors = (object)array(
                'heading_color' => '#ffffff',
                'text_color' => '#e3e3e3',
                'link_color' => '#ffffff',
                'link_hover_color' => '#47c9e5',
                'icon_color' => '#f7f7f7',
                'border_color' => 'rgba(255,255,255,0.10)',
                'border_color2' => '#ffffff',
            );
        else :
            $colors = (object)array(
                'heading_color' => '#505050',
                'text_color' => '#8d8d8d',
                'link_color' => '#505050',
                'link_hover_color' => '#8d8d8d',
                'icon_color' => '#8d8d8d',
                'border_color' => '#ececec',
                'border_color2' => '#505050',
            );
        endif;


        // Colors
        if( $heading_color ) :
            $colors->heading_color = $heading_color;
        endif;

        if( $text_color ) :
            $colors->text_color = $text_color;
        endif;

        if( $link_color ) :
            $colors->link_color = $link_color;
        endif;

        if( $link_hover_color ) :
            $colors->link_hover_color = $link_hover_color;
        endif;

        if( $icon_color ) :
            $colors->icon_color = $icon_color;
        endif;

        if( $border_color ) :
            $colors->border_color = $border_color;
        endif;

        if( $border_color2 ) :
            $colors->border_color2 = $border_color2;
        endif;
        wp_reset_postdata();

        $the_sidebars = wp_get_sidebars_widgets();
        //echo count( $the_sidebars[ $source ] );

        //echo '/'.var_dump( $source );
        ob_start(); ?>

            <style media="screen">
                <?php if( $text_size ) : ?>
                    #<?php echo esc_attr( $id ); ?> {
                        font-size: <?php echo esc_attr( $text_size ); ?>;
                    }
                <?php endif; ?>

                <?php if( $line_height ) : ?>
                    #<?php echo esc_attr( $id ); ?> {
                        line-height: <?php echo esc_attr( $line_height ); ?>;
                    }
                <?php endif; ?>

                <?php if( $heading_size ) : ?>
                    #<?php echo esc_attr( $id ); ?> h3,
                    #<?php echo esc_attr( $id ); ?> h3.widget-title {
                        font-size: <?php echo esc_attr( $heading_size ); ?>;
                    }
                <?php endif; ?>

                #<?php echo esc_attr( $id ); ?> .widget-title,
                #<?php echo esc_attr( $id ); ?> h5,
                #<?php echo esc_attr( $id ); ?> h5.widget-title {
                    color: <?php echo esc_attr( $colors->heading_color ); ?>
                }

                #<?php echo esc_attr( $id ); ?> a,
            	#<?php echo esc_attr( $id ); ?> .post-views,
            	#<?php echo esc_attr( $id ); ?> li a,
            	#<?php echo esc_attr( $id ); ?> h6,
            	#<?php echo esc_attr( $id ); ?> .sh-widget-posts-slider-style1 h5,
            	#<?php echo esc_attr( $id ); ?> .sh-widget-posts-slider-style1 h5 span,
            	#<?php echo esc_attr( $id ); ?> .widget_about_us .widget-quote {
            		color: <?php echo esc_attr( $colors->link_color ); ?>!important;
            	}

                #<?php echo esc_attr( $id ); ?>,
                #<?php echo esc_attr( $id ); ?> .post-meta,
                #<?php echo esc_attr( $id ); ?> .post-meta span,
                #<?php echo esc_attr( $id ); ?> .sh-recent-posts-widgets-item-meta a {
            		color: <?php echo esc_attr( $colors->text_color ); ?>!important;
            	}

                #<?php echo esc_attr( $id ); ?> i:not(.icon-link):not(.icon-magnifier),
            	#<?php echo esc_attr( $id ); ?> .widget_recent_entries li:before {
            		color: <?php echo esc_attr( $colors->icon_color ); ?>!important;
            	}

                #<?php echo esc_attr( $id ); ?> ul li,
            	#<?php echo esc_attr( $id ); ?> ul li,
            	#<?php echo esc_attr( $id ); ?> .widget_product_categories ul.product-categories a,
            	#<?php echo esc_attr( $id ); ?> .sh-recent-posts-widgets .sh-recent-posts-widgets-item,
            	#<?php echo esc_attr( $id ); ?> .sh-widget-posts-slider-style1:not(:last-child),
            	#<?php echo esc_attr( $id ); ?> .widget_tag_cloud a,
            	.sh-title-style2 #<?php echo esc_attr( $id ); ?> .sh-widget-title-styling,
            	.sh-carousel-style2 #<?php echo esc_attr( $id ); ?> .sh-carousel-buttons-styling {
            		border-color: <?php echo esc_attr( $colors->border_color ); ?>;
            	}

                .sh-title-style2 #<?php echo esc_attr( $id ); ?> .sh-widget-title-styling h3 {
            		border-color: <?php echo esc_attr( $colors->border_color2 ); ?>;
            	}

            	#<?php echo esc_attr( $id ); ?> a:hover,
            	#<?php echo esc_attr( $id ); ?> li a:hover,
            	#<?php echo esc_attr( $id ); ?> h6:hover {
            		color: <?php echo esc_attr( $colors->link_hover_color ); ?>!important;
            	}

                .sh-footer-builder-widgets {
                    position: relative;
                    margin-bottom: -25px;
                }

                .sh-footer-builder-widgets > div {
                    display: inline-block;
                    width: 100%;
                    vertical-align: top;
                    padding: 0 15px;
                    margin-bottom: 25px;
                    margin-right: -4px;
                }

                <?php if( $alignment == 'vertical' ) : ?>
                    #<?php echo esc_attr( $id ); ?> > div {
                        display: block!important;
                        max-width: 500px;
                        width: 100%!important;
                    }
                <?php endif; ?>

                .sh-footer-builder-widgets-2columns > div {
                    width: 50%;
                }

                .sh-footer-builder-widgets-3columns > div {
                    width: 33.3%;
                }

                .sh-footer-builder-widgets-4columns > div {
                    width: 25%;
                }

                .sh-footer-builder-widgets-5columns > div {
                    width: 20%;
                }

                @media (max-width: 900px) {
                    .sh-footer-builder-widgets > div {
                        width: 100%;
                    }

                    .sh-footer-builder-widgets > div:not(:last-child) {
                        margin-bottom: 40px;
                    }
                }
            </style>

            <div<?php echo $id ? ' id="'.$id.'" ' : ''; ?> class="sh-footer-builder-widgets <?php echo implode( ' ', $element_class ); ?>">
                <?php
                    /* Show theme footer widgets */
                    if( is_active_sidebar( $source ) ) :
                        dynamic_sidebar( $source );
                    endif;
                ?>
            </div>

        <?php return ob_get_clean();
    }

}
new vcj_footer_widgets();
