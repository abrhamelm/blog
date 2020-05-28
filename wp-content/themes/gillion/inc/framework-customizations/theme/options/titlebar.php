<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$titlebar_options = array(
	'titlebar' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Titlebar', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable titlebar', 'gillion' ),
		'value' => 'on',
		'left-choice' => array(
			'value' => 'off',
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => 'on',
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'titlebar_layout' => array(
		'type'  => 'radio',
		'label' => esc_html__('Titlebar Layout', 'gillion'),
		'desc'  => esc_html__('Choose titlebar layout', 'gillion'),
		'choices' => array(
			'side' => esc_html__( 'Side', 'gillion' ),
			'center' => esc_html__( 'Center', 'gillion' ),
		),
		'value' => 'side',
		'inline' => false,
	),

	'titlebar_height' => array(
		'type'  => 'select',
		'label' => esc_html__('Titlebar Height', 'gillion'),
		'desc'  => esc_html__('Choose titlebar height', 'gillion'),
		'choices' => array(
			'small' => esc_html__( 'Small', 'gillion' ),
			'medium' => esc_html__( 'Medium', 'gillion' ),
			'large' => esc_html__( 'Large', 'gillion' ),
		),
		'value' => 'small',
	),

	'titlebar_breadcrumbs' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Titlebar Breadcrumbs', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable breadcrumbs', 'gillion' ),
		'value' => 'on',
		'left-choice' => array(
			'value' => 'off',
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => 'on',
			'label' => esc_html__('On', 'gillion'),
		),
	),


	'titlebar_background' => array(
		'label' => esc_html__( 'Titlebar Background Image', 'gillion' ),
		'desc'  => esc_html__( 'Upload a background image for titlebar', 'gillion' ),
		'type'  => 'upload'
	),

	'titlebar_background_parallax' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Parallax Background', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable parallax background', 'gillion' ),
		'value' => 'off',
		'left-choice' => array(
			'value' => 'off',
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => 'on',
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'titlebar-background-color' => array(
		'type'  => 'color-picker',
		'value' => '#fbfbfb',
		'label' => esc_html__('Titlebar Background Color', 'gillion'),
		'desc'  => esc_html__('Select titlebar background color', 'gillion'),
	),

	'titlebar-title-color' => array(
		'type'  => 'color-picker',
		'label' => esc_html__('Titlebar Title Color', 'gillion'),
		'desc'  => esc_html__('Select titlebar title color', 'gillion'),
	),

	'titlebar-breadcrumbs-color' => array(
		'type'  => 'color-picker',
		'label' => esc_html__('Titlebar Breadcrumbs Color', 'gillion'),
		'desc'  => esc_html__('Select titlebar breadcrumbs color', 'gillion'),
	),

	'titlebar-home-title' => array(
		'type'  => 'text',
		'label' => esc_html__('Home Title', 'gillion'),
		'desc'  => esc_html__('Enter main title of home page', 'gillion'),
		'value' => 'Home',
	),

	'titlebar-post-title' => array(
		'type'  => 'text',
		'label' => esc_html__('Post Title', 'gillion'),
		'desc'  => esc_html__('Enter main title of post pages', 'gillion'),
		'value' => 'Blog Post',
	),

	'titlebar-readlater-title' => array(
		'type'  => 'text',
		'label' => esc_html__('Read It Later Page Title', 'gillion'),
		'desc'  => esc_html__('Enter read it later page title', 'gillion'),
		'value' => 'Your read it later bookmarks',
	),

	'titlebar-404-title' => array(
		'type'  => 'text',
		'label' => esc_html__('404 Title', 'gillion'),
		'desc'  => esc_html__('Enter main title of 404 page', 'gillion'),
		'value' => 'Page could not be found',
	),
);

$options = array(
	'titlebar' => array(
		'title'   => esc_html__( 'Titlebar', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'titlebar-box' => array(
				'title'   => esc_html__( 'Titlebar Settings', 'gillion' ),
				'type'    => 'box',
				'options' => $titlebar_options
			),
		)
	)
);
