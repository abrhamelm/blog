<?php
$logo = gillion_option_image('logo');
if( !$logo ) :
	$logo = get_template_directory_uri().'/img/logo.png';
endif;

$copyrights = '';
$dev = 'https://shufflehound.com';
if( gillion_option( 'copyright_deveveloper_all', true ) == true ) :
	$copyrights = '<span class="developer-copyrights '.(( gillion_option('copyright_deveveloper', true) == false ) ? ' sh-hidden' : '' ).'">
		'.esc_html__( 'WordPress Theme built by', 'gillion' ).' <a href="'.esc_attr( $dev ).'" target="_blank"><strong>'.esc_html__( 'Shufflehound', 'gillion' ).'</strong>.</a>
		</span>';
endif;
?>
<footer class="amp-wp-footer">
	<div class="amp-wp-footer-container">
		<div class="amp-wp-footer-logo">
			<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
				<span class="amp-wp-footer-logo-img" style="background-image: url( <?php echo esc_url( $logo ); ?> );"></span>
			</a>
		</div>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<div class="amp-wp-footer-nav">
				<?php wp_nav_menu( array(
					'theme_location' => 'footer',
					'depth' => 1,
					'container_class' => 'sh-nav-container',
					'menu_class' => 'sh-nav'
				)); ?>
			</div>
		<?php endif; ?>

		<div class="amp-wp-footer-copyrights">
			<?php echo do_shortcode( wp_kses_post( $copyrights ) ); ?>
			<span><?php echo wp_kses_post( gillion_remove_p( gillion_option('copyright_text') ) ); ?></span>
		</div>

		<a href="#top" class="amp-wp-back-to-top">
			<?php esc_html_e( 'Back to top', 'amp' ); ?>
		</a>
	</div>
</footer>
