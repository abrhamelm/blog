<?php
/**
 * Footer
 */
$page_layout_val = gillion_option('page_layout');
$page_layout = ( isset( $page_layout_val['page_layout'] ) ) ? esc_attr($page_layout_val['page_layout']) : 'line';
$page_layout_atts = gillion_get_picker( $page_layout_val );
wp_reset_postdata();

$footer_template = ( gillion_option( 'footer_template' ) != 'default' ) ? gillion_option( 'footer_template' ) : 'default';
$footer_template_id = intval( str_replace( 'footer-', '', $footer_template ) );
?>

		<?php if( gillion_post_option( get_the_ID(), 'page_layout' ) != 'full' ) : ?>
			</div>
		<?php endif; ?>
		</div>

		<?php
			/* Include footer instagram feed */
			get_template_part('inc/templates/footer-instagram' );
		?>

	<?php if( $page_layout == 'boxed' && $page_layout_atts['footer_width'] == 'full' ) : ?>
		</div></div>
	<?php endif; ?>

		<?php if( !in_array( get_post_type( get_the_ID() ), array( 'shufflehound_header', 'shufflehound_footer', 'shufflehound_temp' ) ) ) : ?>
			<?php if( is_numeric( $footer_template ) && get_post_status( $footer_template ) == 'publish' ) : ?>

				<div class="sh-footer-template">
					<div class="container">
						<?php if( current_user_can( 'manage_options' ) ) : ?>
							<a target="_blank" href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='.intval( $footer_template_id ).'&post_type=shufflehound_footer' ); ?>" class="sh-header-builder-edit">
								<i class="ti-pencil"></i>
								<?php esc_html_e( 'Edit Footer', 'gillion' ); ?>
							</a>
						<?php endif; ?>
						<?php
						/* Footer Builder Output */
						if( class_exists( 'Vc_Manager' ) ) :
							ob_start();

							Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $footer_template );
							$footer_css = ob_get_contents();
							ob_end_clean();

							if( $footer_css ) :
								echo $footer_css;
							else :
								$footer_custom_css = get_post_meta( $footer_template, '_wpb_shortcodes_custom_css', true );
								if( !empty( $footer_custom_css ) ) :
									echo '<style type="text/css">';
									echo $footer_custom_css;
									echo '</style>';
								endif;
							endif;

							$the_post = get_post( $footer_template );
							echo do_shortcode(  apply_filters( 'the_content', $the_post->post_content ) );
						endif;
						?>
					</div>
				</div>

			<?php else : ?>

				<footer class="sh-footer">
					<?php
						if( gillion_footer_enabled() == 'on' ) :
							/* Inlcude theme footer widgets */
							get_template_part('inc/templates/footer-widgets' );
						endif;

						if( gillion_copyrights_enabled() == 'on' ) :
							/* Inlcude theme footer copyrights */
							get_template_part('inc/templates/footer-copyrights' );
						endif;
					?>
				</footer>

			<?php endif; ?>
		<?php endif; ?>


		<?php if( $page_layout != 'boxed' || $page_layout_atts['footer_width'] != 'full' ) : ?>
			</div>
		<?php endif; ?>


		<?php if( gillion_post_option( get_the_ID(), 'back_to_top' ) != 'none' ) :

			/* Inlcude back to top button HTML */
			get_template_part('inc/templates/back_to_top' );

			/* Inlcude login popup */
			get_template_part('inc/templates/login_popup' );
		endif; ?>

	<?php if( $page_layout != 'boxed' || $page_layout_atts['footer_width'] != 'full' ) : ?>
		</div>
	<?php endif; ?>

	<?php wp_reset_postdata(); wp_footer(); ?>
</body>
</html>
