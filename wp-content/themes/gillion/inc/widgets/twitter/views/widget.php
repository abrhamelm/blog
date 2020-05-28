<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
$position = gillion_option( 'global_carousel_buttons_position', 'title' );
?>

<?php echo wp_kses_post( $before_widget ); ?>

<?php if( $atts['title'] ) : ?>
	<div class="widget-slide-arrows-container">
		<?php echo '<div class="sh-widget-title-styling"><h3 class="widget-title">'.esc_attr( $atts['title'] ).'</h3></div>'; ?>
		<?php if( $position == 'title' ) : ?>
			<div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
if( function_exists( 'getTweets' ) ) :
	$tweets_count = ( $atts['count'] > 0 ) ? intval( $atts['count'] ) : 4;
	$tweets = getTweets( false, $tweets_count, array( 'key' => '4BnMnmft4Jrt20sX13Xcrh86V' ) );

	if( isset( $tweets['error'] ) ) : ?>

		<?php if( current_user_can('edit_others_pages') ) : ?>
			<p><?php esc_html_e('Please make sure that your twitter account information is correct. Check ', 'gillion'); ?><a target="_blank" href="<?php echo admin_url( 'options-general.php?page=tdf_settings' ); ?>"><?php esc_html_e('here', 'gillion'); ?>.</a></p>
		<?php endif; ?>

	<?php elseif( count($tweets) > 0 ) :

		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$reg_exHash = "/#([a-z_0-9]+)/i";
		$reg_exUser = "/@([a-z_0-9]+)/i";

		echo '<div class="sh-widget-twitter-list">';
		foreach($tweets as $tweet) {

		    $tweet_text = $tweet["text"];
		    if(preg_match($reg_exUrl, $tweet_text, $url)) {
				$tweet_text = preg_replace($reg_exUrl, "<a href='{$url[0]}' target='_blank'>{$url[0]}</a> ", $tweet_text);
		    }

			if(preg_match($reg_exHash, $tweet_text, $hash)) {
				// make the hash tags hyper links    https://twitter.com/search?q=%23truth
				$tweet_text = preg_replace($reg_exHash, "<a href='https://twitter.com/search?q={$hash[0]}' target='_blank'>{$hash[0]}</a> ", $tweet_text);
				// swap out the # in the URL to make %23
				$tweet_text = str_replace("/search?q=#", "/search?q=%23", $tweet_text );
			}

			if(preg_match($reg_exUser, $tweet_text, $user)) {
				$tweet_text = preg_replace("/@([a-z_0-9]+)/i", "<a href='http://twitter.com/$1' target='_blank'>$0</a>", $tweet_text);
			}
			?>

		    <div class="sh-widget-twitter-item">
				<div class="sh-widget-twitter-icon"><i class="fa fa-twitter"></i></div>
		    	<p class="sh-widget-twitter-tittle">
					<?php echo wp_kses_post( $tweet_text ); ?>
				</p>

				<?php if( isset( $atts['images'] ) && $atts['images'] == 'on' ) : ?>
					<?php if( isset( $tweet['entities']['media']['0']['media_url_https'] ) ) :
						$image = $tweet['entities']['media']['0']['media_url_https'];
					?>
						<div class="post-thumbnail">
							<div class="sh-ratio">
								<div class="sh-ratio-container">
									<div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( $image ); ?>);">
										<?php echo gillion_blog_overlay( '', '', '' , '', $image, 1 ); ?>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<p class="sh-widget-twitter-meta">
					<span><?php echo human_time_diff( strtotime( $tweet['created_at'] ), current_time( 'timestamp' ) ).' '.esc_html__( 'ago','gillion' ); ?></span>
					<a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo intval( $tweet['id'] ); ?>">
						<i class="icon icon-refresh"></i>
					</a>
					<a href="https://twitter.com/intent/retweet?tweet_id=<?php echo intval( $tweet['id'] ); ?>">
						<i class="icon icon-action-redo"></i>
					</a>
					<a href="https://twitter.com/intent/favorite?tweet_id=<?php echo intval( $tweet['id'] ); ?>">
						<i class="icon icon-heart"></i>
					</a>
				</p>

				<a href="https://twitter.com/intent/user?user_id=<?php echo esc_attr( $tweet['user']['id'] ); ?>" target="_blank" class="sh-widget-twitter-follow">
					<?php esc_html_e( 'Follow', 'gillion' ); ?>
				</a>
		    </div>

		<?php }
		echo '</div>';

	endif;
elseif( current_user_can('edit_others_pages') ) : ?>

	<p><?php esc_html_e('Please install/activate', 'gillion'); ?> <i>oAuth Twitter Feed for Developers</i> <?php esc_html_e('plugin to use this widget', 'gillion'); ?>.</p>

<?php endif; ?>

<?php if( $position == 'bottom' ) : ?>
	<div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
<?php endif; ?>

<?php echo wp_kses_post( $after_widget ); ?>
