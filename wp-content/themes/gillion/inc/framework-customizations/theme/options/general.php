<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$demo_content = ( isset( $customizer_mode ) ) ? '' : '<div class="fw-backend-option-design-default sh-demo-content-title">
	<div class="fw-backend-option-label">
		<label for="fw-option-responsive_layout">'.esc_html__( 'Demo Content', 'gillion' ).'</label>
	</div>
</div>
<div class="sh-demo-content-link">
	<a href="'.admin_url( 'tools.php?page=fw-backups-demo-content' ).'">'.esc_html__( ' Click here', 'gillion' ).'</a>
	'.esc_html__( 'to install a demo content', 'gillion' ).'
</div>';

$google_api = 'https://developers.google.com/maps/documentation/javascript/get-api-key';
$general_options = array(
	/*'demo_content' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => $demo_content,
	),*/


    'global_page_layout' => array(
        'type'  => 'radio',
        'value' => 'default',
        'label' => esc_html__( 'Page Layout', 'gillion' ),
        'desc'  => esc_html__( 'Choose main page layout', 'gillion' ),
        'choices' => array(
			'default' => esc_html__( 'Default (without sidebar)', 'gillion' ),
			'default default-nopadding' => esc_html__( 'Default (without sidebar and extra padding)', 'gillion' ),
			'default default-content-after-posts' => esc_html__( 'Default Inversed (without sidebar and content at the bottom)', 'gillion' ),
			'full' => esc_html__( 'Full Width (without sidebar)', 'gillion' ),
			'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
			'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
        ),
        'inline' => false,
    ),

	'categories-page-layout' => array(
		'type'  => 'radio',
		'value' => 'sidebar-right',
		'label' => esc_html__( 'Categories Page Layout', 'gillion' ),
		'desc'  => esc_html__( 'Choose categories page layout', 'gillion' ),
		'choices' => array(
			'default' => esc_html__( 'Default (without sidebar)', 'gillion' ),
			'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
			'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
		),
		'inline' => false,
	),

	'author-page-layout' => array(
		'type'  => 'radio',
		'value' => 'sidebar-right',
		'label' => esc_html__( 'Author Page Layout', 'gillion' ),
		'desc'  => esc_html__( 'Choose author page layout', 'gillion' ),
		'choices' => array(
			'default' => esc_html__( 'Default (without sidebar)', 'gillion' ),
			'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
			'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
		),
		'inline' => false,
	),


	'page_layout' => array(
		'type'  => 'multi-picker',
		'label' => false,
		'desc'  => false,
		'value' => array(
			'page_layout' => 'full',
		),
		'picker' => array(
			'page_layout' => array(
				'label'   => esc_html__('Boxed Layout', 'gillion'),
				'desc'    => esc_html__('Choose main page layout. Boxed layout will not work together with left header', 'gillion'),
				'type'    => 'radio',
				'choices' => array(
					'full' => esc_html__('Disabled', 'gillion'),
					'boxed' => esc_html__('Enabled', 'gillion'),
				),
			)
		),
		'choices' => array(
			'boxed' => array(
				'border_style' => array(
					'label'   => esc_html__('Border Style', 'gillion'),
					'desc'    => esc_html__('Choose content border style', 'gillion'),
					'type'    => 'radio',
					'choices' => array(
						'none' => esc_html__('None', 'gillion'),
						'shadow' => esc_html__('Shadow', 'gillion'),
						'line' => esc_html__('Line', 'gillion'),
					),
					'value' => 'shadow'
				),


				'page_background_color' => array(
					'label' => esc_html__('Page Background Color', 'gillion'),
					'desc'  => esc_html__('Select page background color, useful for specific page option', 'gillion'),
					'type'  => 'color-picker',
					'value' => ''
				),

				'page_background_image' => array(
					'label' => esc_html__( 'Page Background Image', 'gillion' ),
					'desc'  => esc_html__( 'Select page background image', 'gillion' ),
					'type'  => 'upload',
					'images_only' => true,
				),

				'content_background_color' => array(
					'label' => esc_html__('Content Background Color', 'gillion'),
					'desc'  => esc_html__('Select content background color', 'gillion'),
					'type'  => 'color-picker',
					'value' => '#ffffff'
				),

				'specific_pages' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__('Specific Pages Only', 'gillion'),
					'desc'  => esc_html__('Enter page and post IDs with comas, for examle: 1,2,3,4,5', 'gillion'),
				),

				'margin_top' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__('Top margin', 'gillion'),
					'desc'  => esc_html__('Enter top margin', 'gillion'),
				),

				'footer_width' => array(
					'label' => esc_html__( 'Footer Width', 'gillion' ),
					'desc'  => esc_html__( 'Enable or disable full footer width', 'gillion' ),
					'type'  => 'switch',
					'value' => 'boxed',
					'left-choice' => array(
						'value' => 'boxed',
						'label' => esc_html__('Boxed', 'gillion'),
					),
					'right-choice' => array(
						'value' => 'full',
						'label' => esc_html__('Full', 'gillion'),
					),
				),

				'page_radius' => array(
					'label' => esc_html__( 'Page Radius', 'gillion' ),
					'desc'  => esc_html__( 'Enable or disable page radius', 'gillion' ),
					'type'  => 'switch',
					'value' => false,
					'left-choice' => array(
						'value' => false,
						'label' => esc_html__('Off', 'gillion'),
					),
					'right-choice' => array(
						'value' => '8px',
						'label' => esc_html__('On', 'gillion'),
					),
				),

			),
		),
	),

	'content_width' => array(
		'label'   => esc_html__( 'Content Width', 'gillion' ),
		'desc'    => esc_html__( 'Choose content width', 'gillion' ),
		'type'    => 'radio',
		'choices' => array(
			'1000' => esc_html__('1000px', 'gillion'),
			'1100' => esc_html__('1100px', 'gillion'),
			'1200' => esc_html__('1200px', 'gillion'),
			'1400' => esc_html__('1400px', 'gillion'),
			'1600' => esc_html__('1600px', 'gillion'),
		),
		'value' => '1200'
	),




		'general_title1' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
			'<h3 class="hndle sh-custom-group-divder"><span>
				'.esc_html__( 'Back to Top Button', 'gillion' ).'
			</span></h3>',
		),

	'back_to_top' => array(
		'type'  => 'select',
		'value' => '1',
		'label' => esc_html__('Style', 'gillion'),
		'desc'  => esc_html__('Choose style for "Back to top" button or disable it', 'gillion'),
		'choices' => array(
			'disabled' => esc_html__( 'Disabled', 'gillion' ),
			'1' => esc_html__( 'Style 1', 'gillion' ),
		),
	),

	'back_to_top_radius' => array(
		'label' => esc_html__('Border Radius', 'gillion'),
		'desc'  => esc_html__( 'Choose "Back to top" button radius', 'gillion' ),
		'type'  => 'select',
		'value' => '8px',
		'choices' => array(
			'0px' => esc_html__( 'None (0px)', 'gillion' ),
			'8px' => esc_html__( 'Small (8px)', 'gillion' ),
			'100%' => esc_html__( 'Full (100%)', 'gillion' ),
		),
	),




		'general_title2' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  =>
			'<h3 class="hndle sh-custom-group-divder"><span>
				'.esc_html__( 'Miscellaneous', 'gillion' ).'
			</span></h3>',
		),

	'enhanced_post_gallery' => array(
		'label' => esc_html__( 'Enhanced Post Gallery', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable enhanced gillion post gallery. Should be disabled for Jetpack carousel to work in posts', 'gillion' ),
		'type'  => 'switch',
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

	'page_comments' => array(
		'label' => esc_html__( 'Comments', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable post comments and page comments', 'gillion' ),
		'type'  => 'switch',
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

	'rtl' => array(
		'label' => esc_html__( 'RTL Support', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable RTL (Right to Left) support', 'gillion' ),
		'type'  => 'switch',
		'value' => false,
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'smooth-scrooling' => array(
		'label' => esc_html__( 'Smooth Scrolling', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable smooth scrolling for webkit browers like Chrome', 'gillion' ),
		'type'  => 'switch',
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

	'responsive_layout' => array(
		'label' => esc_html__( 'Responsive Layout', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable responsive layout for mobile devices', 'gillion' ),
		'type'  => 'switch',
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

	'crispy_images' => array(
		'label' => esc_html__( 'Crispy Images', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable crispy images effect', 'gillion' ),
		'type'  => 'switch',
		'value' => false,
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'white_borders' => array(
		'label' => esc_html__( 'White Frame', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable white frame around the page', 'gillion' ),
		'type'  => 'switch',
		'value' => false,
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('Off', 'gillion'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('On', 'gillion'),
		),
	),

	'theme_options_stored' => array(
	    'type'  => 'radio',
	    'value' => 'file',
	    'label' => esc_html__('Themes Options Stored In', 'jevelin'),
	    'desc'  => esc_html__('Choose how theme options are stored', 'jevelin'),
	    'choices' => array(
	        'file' => esc_html__( 'Stored in CSS file (inside wp-content/uploads) - faster', 'jevelin' ),
	        'inline' => esc_html__( 'Generated on fly in HTML HEAD tag as dynamic CSS - slower', 'jevelin' ),
	    ),
	),

);


$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'Layouts', 'gillion' ),
				'type'    => 'box',
				'options' => $general_options
			),
		)
	)
);
