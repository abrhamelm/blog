<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$footer_options = array(

	'footer_template' => array(
	    'type'  => 'radio',
	    'value' => 'default',
	    'label' => esc_html__('Footer Template', 'jevelin'),
	    'desc'  => esc_html__('Select footer template', 'jevelin'),
	    'choices' => gillion_get_footers()
	),


	'footer_settings_title' => array(
	    'type'  => 'html-full',
	    'value' => '',
	    'label' => false,
	    'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Footer Settings', 'jevelin').'</span></h3>',
	),

	'footer_widgets' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Footer Widgets', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable footer widgets', 'gillion' ),
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

	'footer_width' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Footer Width', 'gillion' ),
		'desc' => esc_html__( 'Select footer width', 'gillion' ),
		'value' => 'default',
		'left-choice' => array(
			'value' => 'default',
			'label' => esc_html__('Default', 'gillion'),
		),
		'right-choice' => array(
			'value' => 'full',
			'label' => esc_html__('Full', 'gillion'),
		),
	),

	'footer_parallax' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Footer Parallax', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable whole footer to act as a parallax element', 'gillion' ),
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

	'instagram_title' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Footer Instagram Settings', 'gillion').'</span></h3>',
	),

	'footer_instagram_widgets' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Footer Instagram Section', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable footer Instagram widgets section', 'gillion' ),
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

	'footer_instagram_title' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Footer Instagram Title', 'gillion'),
		'desc'  => esc_html__('Enter instagram title above instagram footer widgets', 'gillion'),
	),

	'copyright_title' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Copyright Footer Settings', 'gillion').'</span></h3>',
	),

	'copyright_bar' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Copyright Bar', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable copyright bar', 'gillion' ),
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

	'copyright_logo' => array(
		'label' => esc_html__( 'Copyright Logo', 'gillion' ),
		'desc'  => esc_html__( 'Upload a footer logo image', 'gillion' ),
		'type'  => 'upload'
	),

	'copyright_align' => array(
		'type'  => 'radio',
		'value' => 'left',
		'label' => esc_html__('Copyright Alignment', 'gillion'),
		'desc'  => esc_html__('Choose main copyright alignment', 'gillion'),
		'choices' => array(
			'left' => esc_html__( 'Left (logo, copyrights in left and navigation on the right)', 'gillion' ),
			'left2' => esc_html__( 'Left (logo in left and copyrights, navigation on the right)', 'gillion' ),
			'center' => esc_html__( 'Center (everything center)', 'gillion' ),
		),
		'inline' => false,
	),

	'copyright_text' => array(
		'type'   => 'wp-editor',
		'teeny'  => true,
		'reinit' => true,
		'size'   => 'large',
		'label'  => esc_html__( 'Copyright Text', 'gillion' ),
		'desc'   => esc_html__( 'Enter some description about copyright for your website', 'gillion' ).'
			<script>jQuery(document).ready(function ($) { setTimeout(function(){ $("#textarea_dynamic_id-tmce").trigger("click"); }, 1); });</script>',
		'editor_height' => 110,
	),

	'copyright_deveveloper' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Developer Copyrights', 'gillion' ),
		'desc' => esc_html__( "Enable or disable theme developer's copyright", 'gillion' ),
		'value' => true,
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'copyright_deveveloper_all' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Invisible Developer Copyrights', 'jevelin' ),
		'desc' => esc_html__( 'Enable or disable invisible developer copyrights. Say thanks by leaving invisible developer copyrights on', 'jevelin' ),
		'value' => true,
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('Off', 'jevelin'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('On', 'jevelin'),
		),
	),

);


$options = array(
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'footer-box' => array(
				'title'   => esc_html__( 'Footer', 'gillion' ),
				'type'    => 'box',
				'options' => $footer_options
			),
		)
	)
);
