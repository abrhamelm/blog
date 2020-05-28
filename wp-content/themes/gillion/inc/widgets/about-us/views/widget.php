<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
$image_size = ( isset( $atts['image_size'] ) && $atts['image_size'] ) ? $atts['image_size'] : 'large';
?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php if( isset( $atts['image']['attachment_id']) ) :
		$url = ( $atts['url'] ) ? $atts['url'] : '';
	?>

		<a href="<?php echo esc_url( $url ); ?>">
			<img src="<?php echo gillion_get_small_thumb( $atts['image']['attachment_id'], esc_attr( $image_size ) ); ?>" alt="<?php echo esc_attr( $atts['title'] ); ?>" />
		</a>

	<?php endif; ?>

	<?php if( isset($atts['quote']) && $atts['quote'] ) : ?>
		<p class="widget-quote"><?php echo do_shortcode( wp_kses_post( $atts['quote'] ) ); ?></p>
	<?php endif; ?>


		<?php if( isset($atts['description_large']) && $atts['description_large'] ) : ?>
			<p class="widget-description"><?php echo wp_kses_post( $atts['description_large'] ); ?></p>
		<?php endif; ?>

	<?php if( isset($atts['description']) && $atts['description'] ) : ?>
		<p class="widget-quote-description"><?php echo wp_kses_post( $atts['description'] ); ?></p>
	<?php endif; ?>

	<?php if( isset($atts['learn_more_url']) && $atts['learn_more_url'] ) : ?>
		<a href="<?php echo esc_url( $atts['learn_more_url'] ); ?>" class="widget-learn-more">
			<?php esc_html_e('Learn more', 'gillion'); ?>
		</a>
	<?php endif; ?>

<?php

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

    foreach( $atts['social_custom'] as $social ) :
        $o.= '<a href="'.esc_url( ltrim( $social['link'] ) ).'" '.$new_tab.' class="sh-widget-socialv2-item social-media-wordpress">
            <i class="'.esc_attr( $social['icon'] ).'"></i>
        </a>';
    endforeach;

	if( $o ) :
    	echo '<div class="sh-widget-socialv2-list">';
	    	echo do_shortcode( $o );
	    	echo '<div class="sh-clear"></div>';
	    echo '</div>';
	endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
