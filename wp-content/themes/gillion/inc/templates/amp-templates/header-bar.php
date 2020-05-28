<?php
$logo = gillion_option_image('logo');
if( !$logo ) :
	$logo = get_template_directory_uri().'/img/logo.png';
endif;
?>
<header id="top" class="amp-wp-header">
	<div>
		<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
			<span class="amp-wp-header-logo-img" style="background-image: url( <?php echo esc_url( $logo ); ?> );"></span>
			<span class="amp-site-title">
				<?php echo esc_html( wptexturize( $this->get( 'blog_name' ) ) ); ?>
			</span>
		</a>
	</div>
</header>
