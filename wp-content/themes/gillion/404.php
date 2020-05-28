<?php
/**
 * 404 page
 */

if( gillion_option( '404_status', true ) == false ) {
	wp_redirect( esc_url( home_url('/') ) ); exit;
}

$default_title = esc_html__( 'Oops, This Page Could Not Be Found!', 'gillion' );
$default_text = esc_html__( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'gillion' );
$default_button = esc_html__( 'Reload', 'gillion' );

$wpbakery_page_id = gillion_option( '404_wpbakery_page' );
get_header(); ?>

	<?php if( $wpbakery_page_id > 0 && get_post_type( $wpbakery_page_id ) == 'page' ) : ?>

		<?php
			/* Footer Builder Output */
			if( class_exists( 'Vc_Manager' ) ) :
				ob_start();

				Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $wpbakery_page_id );
				$page_css = ob_get_contents();
				ob_end_clean();

				if( $page_css ) :
					echo $page_css;
				else :
					$page_custom_css = get_post_meta( $wpbakery_page_id, '_wpb_shortcodes_custom_css', true );
					if( !empty( $page_custom_css ) ) :
						echo '<style type="text/css">';
						echo $page_custom_css;
						echo '</style>';
					endif;
				endif;

				$the_post = get_post( $wpbakery_page_id );
				echo do_shortcode(  apply_filters( 'the_content', $the_post->post_content ) );
			endif;
		?>

	<?php else : ?>

		<div class="sh-404-page" style="">
			<div class="row">
				<div class="col-md-6 col-sm-6 sh-404-left">
					<div class="sh-ratio">
						<div class="sh-ratio-container sh-ratio-container-1_1">
							<div class="sh-ratio-content">

								<h2 class="sh-404-title"><?php esc_html_e( '404', 'gillion' ); ?></h2>
								<div class="sh-404-overay"></div>

							</div>
						</div>
					</div>
					<div class="sh-404-shadow"></div>
				</div>
				<div class="col-md-6 col-sm-6 sh-404-right">
					<div class="sh-404-container">

						<h1><?php echo esc_attr( gillion_option( '404_title', $default_title ) ); ?></h1>
						<div class="sh-404-description"><?php echo esc_attr( gillion_option( '404_text', $default_text ) ); ?></div>

						<div id="sidebar">
							<?php if ( is_active_sidebar( '404-widgets' ) ) : ?>
								<?php dynamic_sidebar( '404-widgets' ); ?>
							<?php else : ?>
								<aside id="no-widgets-found" class="widget widget_recent_entries">
									<h3 class="widget-title">
										<?php if( current_user_can( 'manage_options' ) ) : ?>
											<a href="<?php echo admin_url(); ?>/widgets.php"><?php esc_html_e( 'Please assign your widgets', 'gillion' ) ?></a>
										<?php endif; ?>
									</h3>
								</aside>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
