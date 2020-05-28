<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/* Set variables */
$id = $atts['id'];
$client_id = $atts['client_id'];
$access_token = $atts['access_token'];
$count = $atts['count'];
$cache_name = 'instagram_'.$client_id.'_'.$count.'_'.$access_token;
$feed = array();

if( !$client_id && $access_token ) :
	$client_id = (int)$access_token;
endif;
?>

<?php echo wp_kses_post( $before_widget ); ?>

	<?php
	if( $atts['title'] ) :
		echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>';
	endif;


	echo '<div class="sh-widget-instagram-list">';
	/* Get Instagram feed */
	if( $client_id && $access_token ) :
		if ( false === ( $feed = get_transient( esc_attr( $cache_name ) ) ) ) {
			$url = 'https://api.instagram.com/v1/users/' . $client_id . '/media/recent/?access_token=' . $access_token . '&count=' . $count;
			$response = wp_remote_get( $url );
			$body = json_decode( $response['body'] );
			$feed = $body->data;
			set_transient( esc_attr( $cache_name ), $feed, 2 * 'HOURS_IN_SECONDS' );
		}

		if ( count($feed) ) {
			foreach ( $feed as $data ) {
				$alt = ( isset( $data->caption->text ) ) ? $data->caption->text : '';
				echo '
				<a href="' . esc_url( $data->link ) . '" target="_blank" class="sh-widget-instagram-item">
					<img src="' . esc_url( $data->images->thumbnail->url ) . '" alt="'.esc_attr( $alt ).'" />
					<div class="sh-widget-instagram-item-overlay">
						<i class="icon icon-arrow-right-circle"></i>
					</div>
				</a>';
			}
		}
	endif;

	echo '</div>';
	?>

<?php echo wp_kses_post( $after_widget ); ?>
