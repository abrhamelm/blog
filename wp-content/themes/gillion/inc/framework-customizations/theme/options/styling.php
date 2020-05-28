<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$styling_options = array(

	'styling_body_background' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select body background color', 'gillion'),
	),

	'accent_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#f63a4c',
		'label' => esc_html__('Accent Color', 'gillion'),
		'desc'  => esc_html__('Select page accent color', 'gillion'),
	),

	'accent_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#dd3562',
		'label' => esc_html__('Accent Hover Color', 'gillion'),
		'desc'  => esc_html__('Select page accent color on hover', 'gillion'),
	),

	'link_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#2b2b2b',
		'label' => esc_html__('Link Color', 'gillion'),
		'desc'  => esc_html__('Select page link color', 'gillion'),
	),

	'link_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#1c1c1c',
		'label' => esc_html__('Link Hover Color', 'gillion'),
		'desc'  => esc_html__('Select page link color on hover', 'gillion'),
	),

	'styling_meta_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#8d8d8d',
		'label' => esc_html__('Meta Color', 'gillion'),
		'desc'  => esc_html__('Select meta information color (author, date added, comments count)', 'gillion'),
	),


	'title_styling_categories' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Categories', 'gillion').'</span></h3>',
	),

	'styling_meta_categories_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#d79c6a',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select meta categories color', 'gillion'),
	),

	'styling_meta_categories_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#d68a46',
		'label' => esc_html__('Text Hover Color', 'gillion'),
		'desc'  => esc_html__('Select meta categories hover color', 'gillion'),
	),

	'styling_meta_categories_slider_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__('Text Color (Inside Slider)', 'gillion'),
		'desc'  => esc_html__('Select meta categories color in slider', 'gillion'),
	),

	'styling_meta_categories_slider_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__('Text Hover Color (Inside Slider)', 'gillion'),
		'desc'  => esc_html__('Select meta categories hover color in slider', 'gillion'),
	),



	'title_styling_general' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Fonts', 'gillion').'</span></h3>',
	),

	'styling_body' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'family'    => 'Open Sans',
			'subset'    => 'latin',
			'variation' => 'regular',
			'size'      => 14,
			'line-height' => 0,
			'letter-spacing' => 0,
			'color'     => '#616161'
		),
		'components' => array(
			'family'         => true,
			'size'           => true,
			'line-height'    => true,
			'letter-spacing' => true,
			'color'          => true
		),
		'label' => esc_html__('Body', 'gillion'),
		'desc'  => esc_html__('Choose body/paragraph font settings', 'gillion'),
	),

	'styling_headings' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'family'    => 'Montserrat',
			'subset'    => 'latin',
			'variation' => '700',
			'color'     => '#2b2b2b'
		),
		'components' => array(
			'family'         => true,
			'size'           => false,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => true
		),
		'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
		'label' => esc_html__('Headings', 'gillion'),
		'desc'  => esc_html__('Choose font settings for all headings', 'gillion'),
	),

	'categories_font' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'family'    => 'Montserrat',
			'subset'    => 'latin',
			'variation' => '700',
		),
		'components' => array(
			'family'         => true,
			'size'           => false,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => false
		),
		'label' => esc_html__('Meta Categories', 'gillion'),
		'desc'  => esc_html__('Choose font for meta categories', 'gillion'),
	),

	'additional_font' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'family'    => 'Montserrat',
			'subset'    => 'latin',
			'variation' => '700',
		),
		'components' => array(
			'family'         => true,
			'size'           => false,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => false
		),
		'label' => esc_html__('Additional Font', 'gillion'),
		'desc'  => esc_html__('Choose additional font (can be used for other options)', 'gillion'),
	),

	'accent_element_font' => array(
		'type'  => 'select',
		'value' => 'heading',
		'label' => esc_html__('Accent Elements', 'gillion'),
		'desc'  => esc_html__('Choose accent element font', 'gillion'),
		'choices' => array(
			'heading' => esc_html__( 'Heading (default)', 'gillion' ),
			'body' => esc_html__( 'Body', 'gillion' ),
			'meta' => esc_html__( 'Meta Categories', 'gillion' ),
		),
		'attr'  => array( 'style' => 'width: 162px' ),
	),

	'post_title_font' => array(
		'type'  => 'select',
		'value' => 'heading',
		'label' => esc_html__('Post Title Font', 'gillion'),
		'desc'  => esc_html__('Choose post title font', 'gillion'),
		'choices' => array(
			'heading' => esc_html__( 'Heading (default)', 'gillion' ),
			'body' => esc_html__( 'Body', 'gillion' ),
			'meta' => esc_html__( 'Meta Categories', 'gillion' ),
			'additional' => esc_html__( 'Additional Font', 'gillion' ),
		),
		'attr'  => array( 'style' => 'width: 162px' ),
	),

	'meta_font' => array(
		'type'  => 'select',
		'value' => 'default',
		'label' => esc_html__('Post Meta Font', 'gillion'),
		'desc'  => esc_html__('Choose post meta font for author, comments count, read time etc', 'gillion'),
		'choices' => array(
			'default' => esc_html__( 'Default', 'gillion' ),
			'heading' => esc_html__( 'Heading', 'gillion' ),
			'body' => esc_html__( 'Body', 'gillion' ),
			'meta' => esc_html__( 'Meta Categories', 'gillion' ),
			'additional' => esc_html__( 'Additional Font', 'gillion' ),
		),
		'attr'  => array( 'style' => 'width: 162px' ),
	),

	'widget_title_font' => array(
		'type'  => 'select',
		'value' => 'heading',
		'label' => esc_html__('Widget Title Font', 'gillion'),
		'desc'  => esc_html__('Choose widget title font', 'gillion'),
		'choices' => array(
			'heading' => esc_html__( 'Heading (default)', 'gillion' ),
			'body' => esc_html__( 'Body', 'gillion' ),
			'meta' => esc_html__( 'Meta Categories', 'gillion' ),
			'additional' => esc_html__( 'Additional Font', 'gillion' ),
		),
		'attr'  => array( 'style' => 'width: 162px' ),
	),

	'google_fonts_subset' => array(
		'type'  => 'checkboxes',
		'value' => array(
			'latin' => true,
		),
		'label' => esc_html__('Character Sets', 'gillion'),
		'desc'  => esc_html__('Select the character sets you want to use for fonts (will be used only if available)', 'gillion'),
		'choices' => array(
			'greek' => esc_html__('Greek ', 'gillion'),
			'greek-ext' => esc_html__('Greek Extended', 'gillion'),
			'latin' => esc_html__('Latin', 'gillion'),
			'vietnamese' => esc_html__('Vietnamese', 'gillion'),
			'cyrillic-ext' => esc_html__('Cyrillic Extended', 'gillion'),
			'latin-ext' => esc_html__('Latin Extended', 'gillion'),
			'cyrillic' => esc_html__('Cyrillic ', 'gillion'),
		),
		'inline' => true,
	),


	'title_styling_headings' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Headings', 'gillion').'</span></h3>',
	),

	'styling_h1' => array(
		'type'  => 'slider',
		'value' => 30,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 1', 'gillion'),
		'desc'  => esc_html__('Select heading 1 font size (pixels)', 'gillion'),
	),

	'styling_h2' => array(
		'type'  => 'slider',
		'value' => 24,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 2', 'gillion'),
		'desc'  => esc_html__('Select heading 2 font size (pixels)', 'gillion'),
	),

	'styling_h3' => array(
		'type'  => 'slider',
		'value' => 21,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 3', 'gillion'),
		'desc'  => esc_html__('Select heading 3 font size (pixels)', 'gillion'),
	),

	'styling_h4' => array(
		'type'  => 'slider',
		'value' => 18,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 4', 'gillion'),
		'desc'  => esc_html__('Select heading 4 font size (pixels)', 'gillion'),
	),

	'styling_h5' => array(
		'type'  => 'slider',
		'value' => 16,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 5', 'gillion'),
		'desc'  => esc_html__('Select heading 5 font size (pixels)', 'gillion'),
	),

	'styling_h6' => array(
		'type'  => 'slider',
		'value' => 14,
		'properties' => array(
			'min' => 5,
			'max' => 65,
		),
		'label' => esc_html__('Heading 6', 'gillion'),
		'desc'  => esc_html__('Select heading 6 font size (pixels)', 'gillion'),
	),

	'styling_widget_font_weight' => array(
		'type'  => 'select',
		'value' => 'default',
		'label' => esc_html__('Widget Font Weight', 'gillion'),
		'desc'  => esc_html__('Choose custom font weight for widget and other secondary page titles', 'gillion'),
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

	'styling_headings_line' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Headings Vertical Accent Line', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable headings vertical accent line', 'gillion' ),
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


	'title_styling_posts' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Blog Posts', 'gillion').'</span></h3>',
	),

	'post_title_uppercase' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Post Title Uppercase (everywhere)', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable uppercase post title transformation', 'gillion' ),
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

	'styling_single_content_size' => array(
		'type'  => 'slider',
		'value' => 15,
		'properties' => array(
			'min' => 10,
			'max' => 30,
		),
		'label' => esc_html__('Post Content Size (opened page)', 'gillion'),
		'desc'  => esc_html__('Select post page content font size (pixels)', 'gillion'),
	),

	'meta_size' => array(
		'type'  => 'slider',
		'value' => 11,
		'properties' => array(
			'min' => 8,
			'max' => 16,
		),
		'label' => esc_html__( 'Post Meta Size', 'gillion' ),
		'desc'  => esc_html__( 'Select post meta informaation font size (pixels)', 'gillion' ),
	),


	'title_styling_header' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Header', 'gillion').'</span></h3>',
	),

	'header_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#fff',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select header background color', 'gillion'),
	),

	'header_background_image' => array(
		'label' => esc_html__( 'Background Image', 'gillion' ),
		'desc'  => esc_html__( 'Upload a header background image', 'gillion' ),
		'type'  => 'upload'
	),

	'header_text_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#8d8d8d',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select header text color', 'gillion'),
	),

	'header_border_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => 'rgba( 0,0,0,0.08 )',
		'label' => esc_html__('Border Color', 'gillion'),
		'desc'  => esc_html__('Select header border color', 'gillion'),
	),



	'title_styling_nav' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Navigation', 'gillion').'</span></h3>',
	),

	'header_nav_size' => array(
		'type'  => 'text',
		'value' => '12px',
		'attr'  => array( 'style' => 'max-width: 70px' ),
		'label' => esc_html__('Font Size', 'gillion'),
		'desc'  => wp_kses( __( 'Enter your navigation size (in px)', 'gillion' ), gillion_allowed_html() ),
	),

	'header_uppercase' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Text Uppercase', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable uppercase navigation text transformation', 'gillion' ),
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

	'header_nav_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => 'rgba(61,61,61,0.69)',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select navigation color', 'gillion'),
	),

	'header_nav_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => 'rgba(61,61,61,0.80)',
		'label' => esc_html__('Text Hover Color', 'gillion'),
		'desc'  => esc_html__('Select navigation color on hover', 'gillion'),
	),

	'header_nav_active_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#505050',
		'label' => esc_html__('Active Text Color', 'gillion'),
		'desc'  => esc_html__('Select active navigation color', 'gillion'),
	),

	'header_nav_active_line_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__('Active Text Bottom Line Color', 'gillion'),
		'desc'  => esc_html__('Select active bottom line color', 'gillion'),
	),

	'header_nav_icon_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#b5b5b5',
		'label' => esc_html__('Active Icon Color', 'gillion'),
		'desc'  => esc_html__('Select navigation icons color', 'gillion'),
	),

	'header_nav_icon_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#8d8d8d',
		'label' => esc_html__('Active Icon Hover Color', 'gillion'),
		'desc'  => esc_html__('Select navigation icons hover color', 'gillion'),
	),

	'header_nav_active_background_color' => array(
		'type'  => 'rgba-color-picker',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select active navigation background color (optional)', 'gillion'),
		'value' => ''
	),


	'title_styling_nav_mobile' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Navigation Mobile', 'gillion').'</span></h3>',
	),

	'header_mobile_nav_size' => array(
		'type'  => 'text',
		'value' => '13px',
		'attr'  => array( 'style' => 'max-width: 70px' ),
		'label' => esc_html__('Font Size', 'gillion'),
		'desc'  => wp_kses( __( 'Enter your navigation size (in px)', 'gillion' ), gillion_allowed_html() ),
	),

	'header_mobile_uppercase' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Text Uppercase', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable uppercase navigation text transformation for mobile header', 'gillion' ),
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

	'title_styling_menu' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Dropdown/Menu', 'gillion').'</span></h3>',
	),

	'menu_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select menu background color', 'gillion'),
	),

	'menu_font_size' => array(
		'type'  => 'text',
		'value' => '13px',
		'attr'  => array( 'style' => 'max-width: 70px' ),
		'label' => esc_html__('Font Size', 'gillion'),
		'desc'  => wp_kses( __( 'Enter your menu font size (in px)', 'gillion' ), gillion_allowed_html() ),
	),

	'menu_link_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#8d8d8d',
		'label' => esc_html__('Link Color', 'gillion'),
		'desc'  => esc_html__('Select menu link color', 'gillion'),
	),

	'menu_link_hover_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#505050',
		'label' => esc_html__('Link Hover and Active Color', 'gillion'),
		'desc'  => esc_html__('Select menu link hover and active color', 'gillion'),
	),

	'menu_link_border_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#eaeaea',
		'label' => esc_html__('Link Border Color', 'gillion'),
		'desc'  => esc_html__('Select menu link border color', 'gillion'),
	),


	'title_styling_sidebar' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Sidebar', 'gillion').'</span></h3>',
	),

	'sidebar_headings' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'size'     => '18',
			'color'     => '#505050'
		),
		'components' => array(
			'family'         => false,
			'size'           => true,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => true
		),
		'label' => esc_html__('Headings', 'gillion'),
		'desc'  => esc_html__('Choose default sidebar heading font settings', 'gillion'),
	),

	'sidebar_border_color' => array(
		'type'  => 'rgba-color-picker',
		'label' => esc_html__('Border Color', 'gillion'),
		'desc'  => esc_html__('Select sidebar border color', 'gillion'),
		'value' => '#f0f0f0'
	),


	'title_footer' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Footer', 'gillion').'</span></h3>',
	),

	'footer_background_image' => array(
		'label' => esc_html__( 'Background Image', 'gillion' ),
		'desc'  => esc_html__( 'Upload a footer widgets background image. Note: Image will appear only when background color transparency will be set', 'gillion' ),
		'type'  => 'upload'
	),

	'footer_widgets_bottom_border_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '',
		'label' => esc_html__('Widgets Footer Top Border Color', 'gillion'),
		'desc'  => esc_html__("Select footer's top border color", 'gillion'),
	),

	'footer_bottom_border_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#2c2c2c',
		'label' => esc_html__('Copyright Footer Top Border Color', 'gillion'),
		'desc'  => esc_html__("Select footer's top border color", 'gillion'),
	),


	'title_footer_styling' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Widgets Footer', 'gillion').'</span></h3>',
	),

	'footer_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#1e1e1e',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select footer background color', 'gillion'),
	),


	'footer_headings' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'size'     => '20',
			'color'     => '#ffffff'
		),
		'components' => array(
			'family'         => false,
			'size'           => true,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => true
		),
		'label' => esc_html__(' Headings', 'gillion'),
		'desc'  => esc_html__('Choose default footer heading font settings', 'gillion'),
	),

	'footer_text_color' => array(
		'type'  => 'color-picker',
		'value' => '#c7c7c7',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select footer text color', 'gillion'),
	),

	'footer_link_color' => array(
		'type'  => 'color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Link Color', 'gillion'),
		'desc'  => esc_html__('Select footer link color', 'gillion'),
	),

	'footer_hover_color' => array(
		'type'  => 'color-picker',
		'value' => '#f63a4c',
		'label' => esc_html__('Hover Color', 'gillion'),
		'desc'  => esc_html__('Select footer color on hover', 'gillion'),
	),

	'footer_icon_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Icon Color', 'gillion'),
		'desc'  => esc_html__('Select footer icon color', 'gillion'),
	),

	'footer_border_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => 'rgba(255,255,255,0.10)',
		'label' => esc_html__('Border Color', 'gillion'),
		'desc'  => esc_html__('Select footer border color', 'gillion'),
	),

	'footer_border_color2' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Border Color 2', 'gillion'),
		'desc'  => esc_html__('Select footer border color 2 for section title style - line under title', 'gillion'),
	),

	'footer_padding' => array(
		'type'  => 'text',
		'value' => '100px 0px 100px 0px',
		'label' => esc_html__( 'Padding', 'gillion' ),
		'desc'  => esc_html__( 'Change footer padding (top, right, bottom, and left)', 'gillion' ),
	),


	'title_copyright_styling' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Copyright Footer', 'gillion').'</span></h3>',
	),

	'copyright_background_color' => array(
		'type'  => 'rgba-color-picker',
		'value' => '#1e1e1e',
		'label' => esc_html__('Background Color', 'gillion'),
		'desc'  => esc_html__('Select copyright background color', 'gillion'),
	),

	'copyright_text_color' => array(
		'type'  => 'color-picker',
		'value' => '#b4b4b4',
		'label' => esc_html__('Text Color', 'gillion'),
		'desc'  => esc_html__('Select copyright text color', 'gillion'),
	),

	'copyright_link_color' => array(
		'type'  => 'color-picker',
		'value' => '#ffffff',
		'label' => esc_html__('Link Color', 'gillion'),
		'desc'  => esc_html__('Select copyright link color', 'gillion'),
	),

	'copyright_hover_color' => array(
		'type'  => 'color-picker',
		'value' => '#b4b4b4',
		'label' => esc_html__('Link Hover Color', 'gillion'),
		'desc'  => esc_html__('Select copyright link color on hover', 'gillion'),
	),


	/*'additional_styling' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Adittional Styling', 'gillion').'</span></h3>',
	),

	'additional_font1' => array(
		'type'  => 'typography-v2',
		'value'      => array(
			'family'    => 'Open Sans',
			'subset'    => 'latin',
			'variation' => 'regular',
		),
		'components' => array(
			'family'         => true,
			'size'           => false,
			'line-height'    => false,
			'letter-spacing' => false,
			'color'          => false
		),
		'label' => esc_html__('Adittional Font 1', 'gillion'),
		'desc'  => esc_html__('Used adittional font for WoocCmmerce sale popover', 'gillion'),
	),*/

);


$options = array(
	'styling' => array(
		'title'   => esc_html__( 'Styling', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'styling-box' => array(
				'title'   => esc_html__( 'General', 'gillion' ),
				'type'    => 'box',
				'options' => $styling_options
			),
		)
	)
);
