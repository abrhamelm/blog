<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
// Functions
if( ! function_exists( 'gillion_facebook_followers' ) ) :
	function gillion_facebook_followers( $fbid = '', $app_id = '', $app_secret = '' ) {
		if( $fbid && $app_id && $app_secret ) :

			$url = 'https://graph.facebook.com/'. $fbid . '?fields=fan_count&access_token='. $app_id . '|' . $app_secret;
			$instagram_data = json_decode( wp_remote_retrieve_body( wp_remote_get( $url ) ) );
			$followers = isset( $instagram_data->fan_count ) ? $instagram_data->fan_count : false;

			if( is_numeric( $followers ) ) :
				return $followers;
			else :
				$followers = false;
			endif;
		endif;
	}
endif;

if( ! function_exists( 'gillion_twitter_followers' ) ) :
function gillion_twitter_followers( $twitter_username = ''/*, $twitter_consumer_key = '', $twitter_consumer_secret = '', $twitter_access_token = '', $twitter_access_token_secret = ''*/ ) {
		$data = file_get_contents( 'https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$twitter_username );
		$parsed =  json_decode( $data, true );
		$followers = ( isset( $parsed[0]['followers_count'] ) ) ? $parsed[0]['followers_count'] : false;
		return $followers;
	}
endif;

if( ! function_exists( 'gillion_instagram_followers' ) ) :
	function gillion_instagram_followers( $client_id = '', $access_token = '' ) {
		$client_id = (( !$client_id && $access_token )) ? (int)$access_token : $client_id;

		if( $client_id && $access_token ) :
			$instagram = "https://api.instagram.com/v1/users/$client_id/?access_token=$access_token";
			$instagram_data = json_decode( wp_remote_retrieve_body( wp_remote_get( $instagram ) ) );
			$instagram_follows = $instagram_data->data->counts->followed_by;

			if( is_numeric( $instagram_follows ) ) :
				return $instagram_follows;
			else :
				$followers = false;
			endif;
		endif;
	}
endif;

if( ! function_exists( 'gillion_youtube_followers' ) ) :
	function gillion_youtube_followers( $youtube_channel_id = '', $google_api_key = '' ) {
		$cache_name = esc_attr( 'youtube_x_'.$youtube_channel_id.'_'.$google_api_key );
		if( $youtube_channel_id && $google_api_key ) :

			$url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$youtube_channel_id."&key=".$google_api_key;
			$followers = json_decode( wp_remote_retrieve_body( wp_remote_get( $url ) ) );

			if( isset( $followers->items[0]) ) :
				$followers = intval( $followers->items[0]->statistics->subscriberCount );
			else :
				$followers = false;
			endif;

			if( is_numeric( $followers ) ) :
				return $followers;
			endif;
		endif;
	}
endif;


// Variables
$title = ( isset( $atts['title'] ) && $atts['title'] ) ? $atts['title'] : '';
$style = ( isset( $atts['style'] ) && $atts['style'] ) ? $atts['style'] : 'style1';
$demo_mode = ( isset( $atts['demo_mode'] ) ) ? $atts['demo_mode'] : '';

$facebook_username = ( isset( $atts['facebook_username'] ) ) ? $atts['facebook_username'] : '';
$facebook_app_id = ( isset( $atts['facebook_app_id'] ) ) ? $atts['facebook_app_id'] : '';
$facebook_app_secret = ( isset( $atts['facebook_app_secret'] ) ) ? $atts['facebook_app_secret'] : '';
$facebook_key = 'facebook-'.$facebook_app_id.'-'.$facebook_app_secret;

$twitter_username = ( isset( $atts['twitter_username'] ) ) ? $atts['twitter_username'] : '';
$twitter_consumer_key = ( isset( $atts['twitter_consumer_key'] ) ) ? $atts['twitter_consumer_key'] : '';
$twitter_consumer_secret = ( isset( $atts['twitter_consumer_secret'] ) ) ? $atts['twitter_consumer_secret'] : '';
$twitter_access_token = ( isset( $atts['twitter_access_token'] ) ) ? $atts['twitter_access_token'] : '';
$twitter_access_token_secret = ( isset( $atts['twitter_access_token_secret'] ) ) ? $atts['twitter_access_token_secret'] : '';
$twitter_key = 'twitter-'.$twitter_username;

$instagram_username = ( isset( $atts['instagram_username'] ) ) ? $atts['instagram_username'] : '';
$instagram_access_token = ( isset( $atts['instagram_access_token'] ) ) ? $atts['instagram_access_token'] : '';
$instagram_client_id = ( isset( $atts['instagram_client_id'] ) ) ? $atts['instagram_client_id'] : '';
$instagram_key = 'instagram-'.$instagram_access_token;

$youtube_channel_id = ( isset( $atts['youtube_channel_id'] ) ) ? $atts['youtube_channel_id'] : '';
$youtube_api_key = ( isset( $atts['youtube_api_key'] ) ) ? $atts['youtube_api_key'] : '';
$youtube_key = 'youtube-'.$youtube_channel_id.'-'.$youtube_api_key;


// Start
echo wp_kses_post( $before_widget );
if( $title ) :
	echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $title ).'</h3></div>';
endif;


// Check if demo mode
if( $demo_mode == false ) :

	// Get cached social counter variables & remove old
	$social_global = get_option( 'gillion_widget_social_counter' );

	// Cleanup
	if( is_array( $social_global ) ) :
		foreach( $social_global as $key => $item ) :
			if( isset( $item['created_at'] ) && isset( $item['count'] ) ) :

				if( time() - $item['created_at'] > ( 8 * 60 * 60 ) ) :
					unset( $social_global[$key] );
				endif;

			else :
				unset( $social_global[$key] );
			endif;
		endforeach;
	else :
		$social_global = array();
	endif;


	/*
	** Get Social Networks likes/followers
	*/
	// Facebook
	if( $facebook_username && $facebook_app_id && $facebook_app_secret ) :
		if( isset( $social_global[$facebook_key] ) && isset( $social_global[$facebook_key]['count'] ) ) :
			$facebook = $social_global[$facebook_key]['count'];
		else :
			$facebook = gillion_facebook_followers( $facebook_username, $facebook_app_id, $facebook_app_secret );
			if( is_numeric( $facebook ) ) :
				$social_global[$facebook_key] = array(
					'created_at' => time(),
					'count' => $facebook,
				);
			endif;
		endif;
	endif;


	// Twitter
	if( $twitter_username /*&& $twitter_consumer_key && $twitter_consumer_secret && $twitter_access_token && $twitter_access_token_secret*/ ) :
		if( isset( $social_global[$twitter_key] ) && isset( $social_global[$twitter_key]['count'] ) ) :
			$twitter = $social_global[$twitter_key]['count'];
		else :
			$twitter = gillion_twitter_followers( $twitter_username/*, $twitter_consumer_key, $twitter_consumer_secret, $twitter_access_token, $twitter_access_token_secret*/ );
			if( is_numeric( $twitter ) ) :
				$social_global[$twitter_key] = array(
					'created_at' => time(),
					'count' => $twitter,
				);
			endif;
		endif;
	endif;


	// Instagram
	if( $instagram_access_token ) :
		if( isset( $social_global[$instagram_key] ) && isset( $social_global[$instagram_key]['count'] ) ) :
			$instagram = $social_global[$instagram_key]['count'];
		else :
			$instagram = gillion_instagram_followers( $instagram_client_id, $instagram_access_token );
			if( is_numeric( $instagram ) ) :
				$social_global[$instagram_key] = array(
					'created_at' => time(),
					'count' => $instagram,
				);
			endif;
		endif;
	endif;


	// Youtube
	if( $youtube_channel_id && $youtube_api_key ) :
		if( isset( $social_global[$youtube_key] ) && isset( $social_global[$youtube_key]['count'] ) ) :
			$youtube = $social_global[$youtube_key]['count'];
		else :
			$youtube = gillion_youtube_followers( $youtube_channel_id, $youtube_api_key );
			if( is_numeric( $youtube ) ) :
				$social_global[$youtube_key] = array(
					'created_at' => time(),
					'count' => $youtube,
				);
			endif;
		endif;
	endif;


	// Update options
	update_option( 'gillion_widget_social_counter', $social_global );

else :
	$facebook = 1423;
	$twitter = 727;
	$instagram = 386;

	$content_width = gillion_option( 'content_width', 1200 );
	if( $content_width >= 1200 ) :
		$youtube = 284;
	endif;
endif;



$items = array();
if( isset( $facebook ) && is_numeric( $facebook ) ) :
	$items[] = array(
		'id' => 'facebook',
		'title' => esc_html__( 'Like', 'gillion' ),
		'link' => 'https://facebook.com/'.$facebook_username.'/',
		'icon' => 'fa fa-facebook',
		'count' => $facebook,
	);
endif;

if( isset( $twitter ) && is_numeric( $twitter ) ) :
	$items[] = array(
		'id' => 'twitter',
		'title' => esc_html__( 'Follow', 'gillion' ),
		'link' => 'https://twitter.com/'.$twitter_username.'/',
		'icon' => 'fa fa-twitter',
		'count' => $twitter,
	);
endif;

if( isset( $instagram ) && is_numeric( $instagram ) ) :
	$link = ( $instagram_username ) ? 'https://instagram.com/'.esc_attr( $instagram_username ).'/' : 'https://www.instagram.com';
	$items[] = array(
		'id' => 'instagram',
		'title' => esc_html__( 'Follow', 'gillion' ),
		'link' => $link,
		'icon' => 'fa fa-instagram',
		'count' => $instagram,
	);
endif;

if( isset( $youtube ) && is_numeric( $youtube ) ) :
	$link = ( $youtube_channel_id ) ? 'https://youtube.com/channel/'.esc_attr( $youtube_channel_id ).'/' : 'https://www.youtube.com';
	$items[] = array(
		'id' => 'youtube',
		'title' => esc_html__( 'Subscribe', 'gillion' ),
		'link' => $link,
		'icon' => 'fa fa-youtube-play',
		'count' => $youtube,
	);
endif;

$columns = 3;
if( is_array( $items ) && count( $items ) >=4 ) :
	$columns = 4;
endif;
?>


<div class="sh-widget-connected-list sh-widget-connected-columns-<?php echo esc_attr( $columns ); ?> sh-widget-connected-<?php echo esc_attr( $style ); ?>">
	<?php foreach( $items as $item ) : ?>
		<?php if( is_numeric( $item['count'] ) ) : ?>
			<?php if( $style == 'style1' ) : ?>

				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" class="sh-widget-connected-item sh-widget-connected-<?php echo esc_attr( $item['id'] ); ?> sh-columns">
					<div class="sh-widget-connected-title">
						<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
						<?php echo esc_attr( $item['title'] ); ?>
					</div>
					<div class="sh-widget-connected-count">
						<span><?php echo esc_attr( $item['count'] ); ?></span>
					</div>
				</a>

			<?php else : ?>

				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" class="sh-widget-connected-item">
					<div class="sh-widget-connected-bubble sh-widget-connected-<?php echo esc_attr( $item['id'] ); ?>">
						<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>

						<div class="sh-widget-connected-bubble-count sh-widget-connected-<?php echo esc_attr( $item['id'] ); ?>">
							<?php echo esc_attr( $item['count'] ); ?>
						</div>
					</div>
					<div class="sh-widget-connected-title sh-heading-font">
						<?php echo esc_attr( $item['title'] ); ?>
					</div>
				</a>

			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</div>


<?php echo wp_kses_post( $after_widget ); ?>
