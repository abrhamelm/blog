<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Page Settings
 */
global $pagenow;
if( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) :
    if( ! function_exists( 'sh_page_settings_style' ) ) :
        add_action('admin_head', 'sh_page_settings_style');
        function sh_page_settings_style() {
            $theme_name = shufflehound_theme();
            $theme_color = ( $theme_name == 'jevelin' ) ? '#294cff' : '#8d39ed';
            $theme_color2 = ( $theme_name == 'jevelin' ) ? '#dee3ff' : '#cb9eff';
        ?>

            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet" />
            <style media="screen">
                .fw-options-tabs-wrapper .fw-backend-option a,
                .fw-options-tabs-wrapper .fw-backend-option input[type=checkbox]:checked:before,
                .fw-options-tabs-wrapper .fw-option-type-switch .adaptive-switch.switch-right .switch-switcher label.switch-label {
                    color: <?php echo esc_attr( $theme_color ); ?>!important;
                }

                .fw-options-tabs-wrapper .ui-state-default.ui-tabs-active .fw-wp-link,
                .fw-options-tabs-wrapper .fw-backend-option input[type=radio]:checked:before,
                .fw-options-tabs-wrapper .fw-backend-option .fw-option-type-slider .irs-single,
                .fw-options-tabs-wrapper .fw-option-type-switch .adaptive-switch.switch-right .switch-dot span {
                	background-color: <?php echo esc_attr( $theme_color ); ?>!important;
                }


                <?php if( $theme_name == 'gillion' && get_post_type() == 'post' ) : ?>
                    .fw-options-tabs-wrapper .ui-state-default:nth-child(1) .fw-wp-link:before {
                        content: "\e642";
                    }

                    .fw-options-tabs-wrapper .ui-state-default:nth-child(2) .fw-wp-link:before {
                        content: "\e60a";
                    }

                    .fw-options-tabs-wrapper .ui-state-default:nth-child(3) .fw-wp-link:before {
                        content: "\e63c";
                    }

                    .fw-options-tabs-wrapper .ui-state-default:nth-child(4) .fw-wp-link:before {
                        content: "\e6c0";
                    }

                    .fw-options-tabs-wrapper .ui-state-default:nth-child(5) .fw-wp-link:before {
                        content: "\e6c8";
                    }

                    .fw-options-tabs-wrapper .ui-state-default:nth-child(6) .fw-wp-link:before {
                        content: "\e6e0";
                    }
                <?php endif; ?>
            </style>

        <?php }
    endif;
endif;
