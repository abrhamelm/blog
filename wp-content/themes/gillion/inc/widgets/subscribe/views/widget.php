<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php
		if( function_exists( 'mc4wp_show_form' ) ) :
			if( isset($atts['form_id']) && $atts['form_id'] > 0 ) :
				echo do_shortcode( '[mc4wp_form id="'.esc_attr( $atts['form_id'] ).'"]' );
			else :
				mc4wp_show_form();
			endif;
		elseif( current_user_can('administrator') ) :
			echo '<i>'.esc_html__('Please install/enable MailChimp for WordPress plugin to use this widget', 'gillion').'</i>';
		endif;
	?>

	<?php if( function_exists( 'mc4wp_show_form' ) && isset($atts['description']) && $atts['description'] ) : ?>
		<p class="widget-quote-description"><?php echo wp_kses_post( $atts['description'] ); ?></p>
	<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
