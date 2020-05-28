<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
$ad = ( isset( $atts['advertise']['type'] ) ) ? $atts['advertise']['type'] : 'image';
$ad_atts = gillion_get_picker( $atts['advertise'] );
?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php if( $ad == 'image' && isset($ad_atts['ad_image']) ) : ?>

		<a href="<?php echo esc_url( $ad_atts['ad_url'] ); ?>">
			<img src="<?php echo gillion_get_small_thumb( $ad_atts['ad_image']['attachment_id'], 'large' ); ?>" />
		</a>

	<?php elseif( $ad == 'code' ) : ?>

		<?php echo do_shortcode( $ad_atts['ad_code'] ); ?>

	<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
