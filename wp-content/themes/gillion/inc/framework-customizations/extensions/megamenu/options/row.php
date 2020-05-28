<?php if (!defined('FW')) die('Forbidden');

// MegaMenu row options
$options = array(

    /*'background_image' => array(
        'label' => esc_html__( 'Background Image', 'gillion' ),
        'desc'  => esc_html__( 'Upload a background image', 'gillion' ),
        'type'  => 'upload',
        'images_only' => true,
    ),*/

	'dynamic_elements' => array(
	    'type'  => 'radio',
	    'value' => 'none',
	    'label' => esc_html__('Dynamic Elements', 'gillion'),
	    'desc'  => esc_html__('Replace content with dynamic elements. Notice: Too many dynamic elements can decrease page loading time', 'gillion'),
	    'choices' => array(
            'none' => esc_html__( 'Off', 'gillion' ),
            'cat' => esc_html__( 'Categories', 'gillion' ),
	    ),
	    'inline' => false,
	),

    'categories' => array(
        'type'  => 'multi-select',
        'label' => esc_html__('Categories', 'gillion'),
        'desc'  => esc_html__('Choose which blog categories you want to show for dynamic element', 'gillion'),
        'population' => 'taxonomy',
        'source' => 'category',
        'prepopulate' => 200,
        'limit' => 50,
    ),

	'categories_order' => array(
		'type'  => 'radio',
	    'value' => 'default',
	    'label' => esc_html__('Categories Order', 'gillion'),
	    'desc'  => esc_html__('Choose categories order', 'gillion'),
	    'choices' => array(
            'default' => esc_html__( 'Default', 'gillion' ),
			'insert' => esc_html__( 'Custom Arrangement (entered order)', 'gillion' ),
	    ),
	    'inline' => false,
    ),

	'per_page' => array(
		'type'  => 'radio',
	    'value' => 'default',
	    'label' => esc_html__('Posts Per Page', 'gillion'),
	    'desc'  => esc_html__('Chosoe posts per page limit', 'gillion'),
	    'choices' => array(
            'default' => esc_html__( 'Default', 'gillion' ),
			'4' => esc_html__( '4 Posts', 'gillion' ),
			'5' => esc_html__( '5 Posts', 'gillion' ),
            '10' => esc_html__( '10 Posts', 'gillion' ),
	    ),
	    'inline' => false,
    ),

    'limit' => array(
        'label' => esc_html__( 'Posts Limit (max)', 'gillion' ),
        'desc'  => esc_html__( 'Enter posts limit, default is 8', 'gillion' ),
        'type'  => 'text',
    ),
);
