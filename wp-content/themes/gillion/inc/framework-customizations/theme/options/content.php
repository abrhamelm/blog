<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$header_options = array(

	'border_radius_images' => array(
        'type'  => 'radio',
        'value' => 'enabled',
        'label' => esc_html__( 'Images', 'gillion' ),
        'desc'  => esc_html__( 'Enable or disable image border radius', 'gillion' ),
        'choices' => array(
			'disabled' => esc_html__( 'Disabled', 'gillion' ),
			'enabled' => esc_html__( 'Enabled', 'gillion' ),
        ),
        'inline' => false,
    ),


	'content_title10' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
		'<h3 class="hndle sh-custom-group-divder"><span>
			'.esc_html__( 'Titles & Tabs', 'gillion' ).'
		</span></h3>',
	),

	'global_title' => array(
        'type'  => 'radio',
        'value' => 'style1',
        'label' => esc_html__( 'Title Style', 'gillion' ),
        'desc'  => esc_html__( 'Choose global section title style', 'gillion' ),
        'choices' => array(
			'style1' => esc_html__( 'Line in middle', 'gillion' ),
			'style2' => esc_html__( 'Line under title', 'gillion' ),
        ),
        'inline' => false,
    ),

	'global_title_transform' => array(
		'type'  => 'select',
        'value' => 'none',
		'label' => esc_html__( 'Title Transform', 'gillion' ),
		'desc' => esc_html__( 'Choose section title transform', 'gillion' ),
		'choices' => array(
			'none' => esc_html__( 'None', 'gillion' ),
			'uppercase' => esc_html__( 'Uppercase (transforms all characters to uppercase)', 'gillion' ),
			'lowercase' => esc_html__( 'Lowercase (transforms all characters to lowercase)', 'gillion' ),
			'capitalize' => esc_html__( 'Capitalize (transforms the first character of each word to uppercase)', 'gillion' ),
        ),
	),

	'global_tabs_transform' => array(
		'type'  => 'select',
        'value' => 'default',
		'label' => esc_html__( 'Title Tabs Transform', 'gillion' ),
		'desc' => esc_html__( 'Choose section title tabs transform', 'gillion' ),
		'choices' => array(
			'default' => esc_html__( 'Default', 'gillion' ),
			'none' => esc_html__( 'None', 'gillion' ),
			'uppercase' => esc_html__( 'Uppercase (transforms all characters to uppercase)', 'gillion' ),
			'lowercase' => esc_html__( 'Lowercase (transforms all characters to lowercase)', 'gillion' ),
			'capitalize' => esc_html__( 'Capitalize (transforms the first character of each word to uppercase)', 'gillion' ),
        ),
	),

	'global_title_weight' => array(
		'type'  => 'select',
        'value' => 'default',
		'label' => esc_html__( 'Title Font Weight', 'gillion' ),
		'desc' => esc_html__( 'Choose section title weight', 'gillion' ),
		'choices' => array(
			'default' => esc_html__( 'Default (from heading settings)', 'gillion' ),
			'100' => esc_html__( '100 - Extra Light', 'gillion' ),
			'300' => esc_html__( '300 - Light', 'gillion' ),
			'400' => esc_html__( '400 - Regular', 'gillion' ),
			'600' => esc_html__( '600 - SemiBold', 'gillion' ),
			'700' => esc_html__( '700 - Bold', 'gillion' ),
			'800' => esc_html__( '800 - Extra Bold', 'gillion' ),
			'900' => esc_html__( '900 - Black', 'gillion' ),
        ),
	),

	'global_title_font_size' => array(
		'type'  => 'text',
		'value' => '',
		'attr'  => array( 'style' => 'max-width: 70px' ),
		'label' => esc_html__('Title Font Size', 'gillion'),
		'desc'  => wp_kses( __( 'Enter section title font size (with <b>px</b>)', 'gillion' ), gillion_allowed_html() ),
	),

    'global_section_tabs' => array(
        'type'  => 'radio',
        'value' => 'default',
        'label' => esc_html__( 'Tabs Style', 'gillion' ),
        'desc'  => esc_html__( 'Choose global section tabs style', 'gillion' ),
        'choices' => array(
			'default' => esc_html__( 'Default', 'gillion' ),
			'style1' => esc_html__( 'With background color for active item', 'gillion' ),
			'style2' => esc_html__( 'Simple with bold for active item', 'gillion' ),
			'style3' => esc_html__( 'With border line and shadow for active item', 'gillion' ),
        ),
        'inline' => false,
    ),




        'content_title2' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
            '<h3 class="hndle sh-custom-group-divder"><span>
                '.esc_html__( 'Carousels', 'gillion' ).'
            </span></h3>',
        ),

    'global_carousel_buttons' => array(
        'type'  => 'radio',
        'value' => 'style1',
        'label' => esc_html__( 'Buttons Style', 'gillion' ),
        'desc'  => esc_html__( 'Choose global carousel buttons style', 'gillion' ),
        'choices' => array(
            'style1' => esc_html__( '2 round circles with arrows', 'gillion' ),
            'style2' => esc_html__( '1 round box with arrows', 'gillion' ),
        ),
        'inline' => false,
    ),

    'global_carousel_buttons_position' => array(
        'type'  => 'radio',
        'value' => 'title',
        'label' => esc_html__( 'Buttons Position in Widgets', 'gillion' ),
        'desc'  => esc_html__( 'Choose global carousel position in widgets', 'gillion' ),
        'choices' => array(
            'title' => esc_html__( 'In title', 'gillion' ),
            'bottom' => esc_html__( 'Below content', 'gillion' ),
        ),
        'inline' => false,
    ),




		'content_title5' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
	        '<h3 class="hndle sh-custom-group-divder"><span>
	            '.esc_html__( 'Reviews', 'gillion' ).'
	        </span></h3>',
	    ),

    'global_review' => array(
        'type'  => 'radio',
        'value' => 'style1',
        'label' => esc_html__( 'Icon Style', 'gillion' ),
        'desc'  => esc_html__( 'Choose global review icon style', 'gillion' ),
        'choices' => array(
			'style1' => esc_html__( 'Standard', 'gillion' ),
			'style2' => esc_html__( 'Transparent', 'gillion' ),
        ),
        'inline' => false,
    ),




		'content_title6' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
			'<h3 class="hndle sh-custom-group-divder"><span>
				'.esc_html__( 'Slider/Gallery Icon', 'gillion' ).'
			</span></h3>',
		),

	'global_slider_icon_style' => array(
        'type'  => 'radio',
        'value' => 'title',
        'label' => esc_html__( 'Style', 'gillion' ),
        'desc'  => esc_html__( 'Choose post categories style', 'gillion' ),
        'choices' => array(
			'style1' => esc_html__('Bullets in circle', 'gillion'),
			'style2' => esc_html__('Bullets without circle', 'gillion'),
        ),
        'inline' => false,
    ),




        'content_title3' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
            '<h3 class="hndle sh-custom-group-divder"><span>
                '.esc_html__( 'Instagram Widgets', 'gillion' ).'
            </span></h3>',
        ),

    'global_instagram_widget_columns' => array(
        'type'  => 'radio',
        'value' => 'columns2',
        'label' => esc_html__( 'Image Columns', 'gillion' ),
        'desc'  => esc_html__( 'Choose global Instagram widget image columns in sidebar', 'gillion' ),
        'choices' => array(
			'columns2' => esc_html__( '2 columns ', 'gillion' ),
			'columns3' => esc_html__( '3 columns', 'gillion' ),
        ),
        'inline' => false,
    ),

	'global_instagram_widget_button' => array(
		'label' => esc_html__( 'Button', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable instagram widget button in sidebar', 'gillion' ),
		'type'  => 'switch',
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

);

$options = array(
	'content' => array(
		'title'   => esc_html__( 'Content', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'ad-box' => array(
				'title'   => esc_html__( 'Border Radius', 'gillion' ),
				'type'    => 'box',
				'options' => $header_options
			),
		)
	)
);
