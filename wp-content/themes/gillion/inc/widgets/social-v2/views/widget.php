<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<?php echo wp_kses_post( $before_widget ); ?>

    <?php
    if( $atts['title'] ) :
    	echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
    endif;

    echo '<div class="sh-widget-socialv2-list">';

    if( $atts['social_newtab'] == true ) :
        $new_tab = ' target = "_blank" ';
    else :
        $new_tab = '';
    endif;
    $o = '';

    if( $atts['social_twitter'] ) :
        $o.= '<a href="'.esc_url( ltrim( $atts['social_twitter'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-twitter">
            <i class="fa fa-twitter"></i>
        </a>';
    endif;

    if( $atts['social_facebook'] ) :
        $o.= '<a href="'.esc_url( ltrim( $atts['social_facebook'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-facebook">
            <i class="fa fa-facebook"></i>
        </a>';
    endif;

    if( $atts['social_instagram'] ) :
        $o.= '<a href="'.esc_url( ltrim( $atts['social_instagram'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-instagram">
            <i class="fa fa-instagram"></i>
        </a>';
    endif;

    if( $atts['social_pinterest'] ) :
        $o.= '<a href="'.esc_url( ltrim( $atts['social_pinterest'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-pinterest">
            <i class="fa fa-pinterest"></i>
        </a>';
    endif;

    if( $atts['social_flickr'] ) :
        $o.= '<a href="'.esc_url( ltrim( $atts['social_flickr'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-flickr">
            <i class="fa fa-flickr"></i>
        </a>';
    endif;

    foreach( $atts['social_custom'] as $social ) :
        $o.= '<a href="'.esc_url( ltrim( $social['link'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-wordpress">
            <i class="'.esc_attr( $social['icon'] ).'"></i>
        </a>';
    endforeach;

    $o.= '<div class="sh-clear"></div>';
    echo do_shortcode( $o );
    echo '</div>';

    ?>

<?php echo wp_kses_post( $after_widget ); ?>
