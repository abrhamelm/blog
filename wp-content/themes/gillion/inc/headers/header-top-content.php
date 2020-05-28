<?php
/*
** Header Top Conent
*/

$htc_template = ( gillion_option( 'header_top_template' ) != 'default' ) ? gillion_option( 'header_top_template' ) : 'default';
$htc_template_id = intval( $htc_template );
if( $htc_template_id > 0 && !in_array( get_post_type( get_the_ID() ), array( 'shufflehound_header', 'shufflehound_footer', 'shufflehound_temp' ) ) ) : ?>
    <?php if( is_numeric( $htc_template ) && get_post_status( $htc_template ) == 'publish' ) : ?>

        <div class="sh-header-top-content-template">
            <div class="container">
                <?php if( current_user_can( 'manage_options' ) ) : ?>
                    <a target="_blank" href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='.intval( $htc_template_id ).'&post_type=shufflehound_footer' ); ?>" class="sh-header-builder-edit">
                        <i class="ti-pencil"></i>
                        <?php esc_html_e( 'Edit Header Top Content', 'gillion' ); ?>
                    </a>
                <?php endif; ?>
                <?php
                /* Footer Builder Output */
                if( class_exists( 'Vc_Manager' ) ) :
                    ob_start();

                    Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $htc_template );
                    $footer_css = ob_get_contents();
                    ob_end_clean();

                    if( $footer_css ) :
                        echo $footer_css;
                    else :
                        $htc_custom_css = get_post_meta( $htc_template, '_wpb_shortcodes_custom_css', true );
                        if( !empty( $htc_custom_css ) ) :
                            echo '<style type="text/css">';
                            echo $htc_custom_css;
                            echo '</style>';
                        endif;
                    endif;

                    $the_post = get_post( $htc_template );
                    echo do_shortcode(  apply_filters( 'the_content', $the_post->post_content ) );
                endif;
                ?>
            </div>
        </div>

    <?php endif; ?>
<?php endif; ?>
