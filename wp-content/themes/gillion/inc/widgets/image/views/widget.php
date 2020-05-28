<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( isset( $atts['title'] ) && $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php if( isset( $atts['image']['attachment_id']) ) :
		$url = ( $atts['url'] ) ? $atts['url'] : '';
		$class = ( isset( $atts['blackandwhite'] ) && $atts['blackandwhite'] == true ) ? 'blackandwhite' : '';
	?>

		<a href="<?php echo esc_url( $url ); ?>">
			<img src="<?php echo gillion_get_small_thumb( $atts['image']['attachment_id'], 'large' ); ?>" class="<?php echo esc_attr( $class ); ?>" />
		</a>

	<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
