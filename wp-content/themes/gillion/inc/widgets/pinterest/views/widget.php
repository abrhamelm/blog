<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
$url = isset( $atts['board_url'] ) ? $atts['board_url'] : '';
$height = ( isset( $atts['height'] ) && intval( $atts['height'] ) > 0 ) ? intval( $atts['height'] ) : '240';

$type_url = trim( trim( $url ), '/' );
$type_url = str_replace( 'http://', '', $type_url );
$type_url = str_replace( 'https://', '', $type_url );
$type_url = str_replace( '://', '', $type_url );
if( is_numeric( strpos( $type_url, "pinterest.com/pin/") ) ) :
	$type = 'Pin';
elseif( substr_count( $type_url, '/') == 2 ) :
	$type = 'Board';
else :
	$type = 'User';
endif;
$type = 'embed' . $type;
?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
		if( $atts['title'] ) :
			echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
		endif;
	?>

	<?php if( $url ) : ?>
		<a data-pin-do="<?php echo esc_attr( $type ); ?>" data-pin-board-width="400" data-pin-scale-height="<?php echo intval( $height ); ?>" data-pin-scale-width="80" href="<?php echo esc_url( $url ); ?>"></a>
		<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
	<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
