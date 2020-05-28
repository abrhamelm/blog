<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$amp_options = array(
	'amp_post_accent_color' => array(
	    'type'  => 'color-picker',
	    'label' => esc_html__( 'Accent Color', 'gillion' ),
	),

    'amp_post_content_color' => array(
	    'type'  => 'color-picker',
	    'label' => esc_html__( 'Content Color', 'gillion' ),
	),

	'amp_post_heading_color' => array(
	    'type'  => 'color-picker',
	    'label' => esc_html__( 'Heading Color', 'gillion' ),
	),

    'amp_post_content_size' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Post Content Size', 'gillion' ),
		'desc'  => esc_html__( 'Enter post content size with PX', 'gillion' ),
	),

    'amp_logo_size_desktop' => array(
	    'type'  => 'slider',
	    'value' => 40,
	    'properties' => array(
	        'min' => 1,
	        'max' => 100,
	    ),
	    'label' => esc_html__( 'Logo Size (desktop)', 'gillion' ),
	),

    'amp_logo_size_mobile' => array(
	    'type'  => 'slider',
	    'value' => 22,
	    'properties' => array(
	        'min' => 1,
	        'max' => 100,
	    ),
	    'label' => esc_html__( 'Logo Size (mobile)', 'gillion' ),
	),

	'amp_mode' => array(
		'type'  => 'radio',
		'value' => 'optimised',
		'label' => esc_html__( 'AMP Mode', 'gillion' ),
		'desc'  => esc_html__( 'Advanced: Set to all modes if Standard or Transitional template mode is needed', 'gillion' ),
		'choices' => array(
			'optimised' => esc_html__( 'Optimized mode only', 'gillion' ),
			'all' => esc_html__( 'All modes', 'gillion' ),
			'disabled' => esc_html__( 'Disable all Gillion optimizations (not recommended)', 'gillion' ),
		),
		'inline' => false,
	),
);


$options = array(
	'amp' => array(
		'title'   => esc_html__( 'AMP', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'amp-box' => array(
				'title'   => esc_html__( 'AMP Options', 'gillion' ),
				'type'    => 'box',
				'options' => $amp_options
			),
		)
	)
);
