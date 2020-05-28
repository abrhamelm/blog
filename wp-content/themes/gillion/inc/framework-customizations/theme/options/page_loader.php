<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$page_loader_options = array(
	'page_loader' => array(
		'type'  => 'radio',
		'value' => 'off',
		'label' => esc_html__('Enable Page Loader', 'gillion'),
		'desc'  => esc_html__('Choose page loader status', 'gillion'),
		'choices' => array(
			'off' => esc_html__( 'Off', 'gillion' ),
			'on1' => esc_html__( 'On - On every page', 'gillion' ),
			'on2' => esc_html__( 'On - Only on first load', 'gillion' ),
		),
	),

	'page_loader_style' => array(
		'type'  => 'radio',
		'value' => 'cube-folding',
		'label' => esc_html__('Page Loader Style', 'gillion'),
		'desc'  => esc_html__('Choose page loader style', 'gillion'),
		'choices' => array(
			'cube-folding' => esc_html__( 'Cube folding', 'gillion' ),
			'cube-grid' => esc_html__( 'Cube grid', 'gillion' ),
			'spinner' => esc_html__( 'Dots', 'gillion' ),
		),
	),

	'page_loader_accent_color' => array(
		'type'  => 'color-picker',
		'label' => esc_html__('Page Loader Accent Color', 'gillion'),
		'desc'  => esc_html__('Select page loader accent color', 'gillion'),
	),

	'page_loader_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Page Loader Background Color', 'gillion'),
		'desc'  => esc_html__('Select page loader background color', 'gillion'),
	),
);

$options = array(
	'page_loader' => array(
		'title'   => esc_html__( 'Page Loader', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'lightbox-box' => array(
				'title'   => esc_html__( 'Page Loader Settings', 'gillion' ),
				'type'    => 'box',
				'options' => $page_loader_options
			),
		)
	)
);
