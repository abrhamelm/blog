<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); } ?>
<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php if( $atts['name'] ) :
		$tabs = '';
		foreach( array_keys($atts['tabs']) as $tab ) :
			$tabs.= $tab.', ';
		endforeach;
	?>
		<div class="sh-widget-facebook-item">
			<?php if( isset( $atts['image']['attachment_id'] ) && $atts['image']['attachment_id'] ) : ?>
				<div class="sh-widget-facebook-overlay" style="background-image: url( <?php echo gillion_get_small_thumb( $atts['image']['attachment_id'], 'large' ); ?> );"></div>
			<?php endif; ?>

			<div class="fb-page"
				data-href="https://www.facebook.com/<?php echo esc_attr( $atts['name'] ); ?>/"
				data-tabs="<?php echo esc_attr( $tabs ); ?>"
				data-small-header="<?php echo esc_attr( $atts['small_header'] ); ?>"
				data-adapt-container-width="true"
				data-hide-cover="<?php echo esc_attr( $atts['hide_cover'] ); ?>"
				data-show-facepile="<?php echo esc_attr( $atts['show_facepile'] ); ?>">
			</div>
		</div>
	<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
