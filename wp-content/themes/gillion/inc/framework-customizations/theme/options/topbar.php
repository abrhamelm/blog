<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$header_options = array(
	'topbar_status' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Topbar', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable header topbar', 'gillion' ),
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


    'title_styling_top_bar' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Topbar Styling', 'gillion').'</span></h3>',
	),

	'header_top_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#313131',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select top bar background color', 'gillion'),
	),

	'header_top_background_image' => array(
		'label' => esc_html__( 'Background Image', 'gillion' ),
		'desc'  => esc_html__( 'Upload a topbar background image', 'gillion' ),
		'type'  => 'upload'
	),

	'header_top_nav_size' => array(
		'type'  => 'text',
		'value' => '13px',
		'attr'  => array( 'style' => 'max-width: 70px' ),
		'label' => esc_html__('Font Size', 'gillion'),
		'desc'  => wp_kses( __( 'Enter your top bar navigation size (in px)', 'gillion' ), gillion_allowed_html() ),
	),

	'header_top_nav_font_weight' => array(
		'type'  => 'select',
		'value' => 'default',
		'label' => esc_html__('Font Weight', 'gillion'),
		'desc'  => esc_html__('Choose custom font weight', 'gillion'),
		'choices' => array(
			'default' => esc_html__( 'Default', 'gillion' ),
			'300' => esc_html__( 'Light', 'gillion' ),
			'400' => esc_html__( 'Regular', 'gillion' ),
			'500' => esc_html__( 'Medium', 'gillion' ),
			'700' => esc_html__( 'Bold', 'gillion' ),
			'800' => esc_html__( 'Extra Bold', 'gillion' ),
			'900' => esc_html__( 'Black', 'gillion' ),
		),
		'attr'  => array( 'style' => 'width: 162px' ),
	),

	'header_top_color' => array(
		'type'  => 'color-picker',
		'value' => '#fff',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select top bar color', 'gillion'),
	),

	'header_top_hover_color' => array(
		'type'  => 'color-picker',
		'value' => '#b1b1b1',
		'label' => esc_html__('Text Hover Color', 'gillion'),
		'desc'  => esc_html__('Select top bar hover color', 'gillion'),
	),
);

$options = array(
	'topbar' => array(
		'title'   => esc_html__( 'Topbar', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'topbar-box' => array(
				'title'   => esc_html__( 'Topbar', 'gillion' ),
				'type'    => 'box',
				'options' => $header_options
			),
		)
	)
);
