<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$header_options = array(
	'header_banner' => array(
		'label' => esc_html__( 'Header - Banner', 'gillion' ),
		'desc'  => esc_html__( 'Upload a header banner', 'gillion' ),
		'type'  => 'upload',
		'images_only' => true,
	),

	'header_banner_url' => array(
		'label' => esc_html__( 'Header - Banner URL', 'gillion' ),
		'desc'  => esc_html__( 'Enter your header banner URL', 'gillion' ),
		'type'  => 'text',
	),

	'header_banner_code' => array(
		'label' => esc_html__( 'Header - Banner Code', 'gillion' ),
		'desc'  => esc_html__( 'Enter your header banner code if any. This will replace above set banner image', 'gillion' ),
		'type'  => 'textarea',
	),
);

$options = array(
	'ad' => array(
		'title'   => esc_html__( 'Ads', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'ad-box' => array(
				'title'   => esc_html__( 'Ads/Banners', 'gillion' ),
				'type'    => 'box',
				'options' => $header_options
			),
		)
	)
);
