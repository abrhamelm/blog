<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$woocommerce_options = array(
    /*'wc_sort' => array(
        'type' => 'switch',
        'label' => esc_html__( 'WooCommerce Sort', 'gillion' ),
        'desc' => esc_html__( 'Enable or disable WooCommerce product sorting dropdown', 'gillion' ),
        'value' => true,
        'left-choice' => array(
            'value' => false,
            'label' => esc_html__('Off', 'gillion'),
        ),
        'right-choice' => array(
            'value' => true,
            'label' => esc_html__('On', 'gillion'),
        ),
    ),*/

    'wishlist' => array(
        'type' => 'switch',
        'label' => esc_html__( 'Wishlist', 'gillion' ),
        'desc' => esc_html__( 'Enable or disable wishlist functionality', 'gillion' ),
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

	'wc_sort_sale' => array(
		'type' => 'switch',
		'label' => esc_html__( 'WooCommerce Sort by Sale', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable opaction to sort by sale', 'gillion' ),
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

    'wc_columns' => array(
        'type'  => 'radio',
        'value' => '4',
        'label' => esc_html__('WooCommerce Columns', 'gillion'),
        'desc'  => esc_html__('Choose WooCommerce product column count', 'gillion'),
        'choices' => array(
            '2' => esc_html__( '2 columns', 'gillion' ),
            '3' => esc_html__( '3 columns', 'gillion' ),
            '4' => esc_html__( '4 columns', 'gillion' ),
        ),
        'inline' => false,
    ),

    /*'wc_layout_single' => array(
        'type'  => 'radio',
        'value' => 'default',
        'label' => esc_html__('WooCommerce Layout for Product Page', 'gillion'),
        'desc'  => esc_html__('Choose WooCommerce layout for Product Page', 'gillion'),
        'choices' => array(
            'default' => esc_html__( 'Default', 'gillion' ),
            'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
            'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
        ),
        'inline' => false,
    ),*/

    'wc_items' => array(
        'type'  => 'slider',
        'value' => 12,
        'properties' => array(
            'min' => 1,
            'max' => 40,
        ),
        'label' => esc_html__('Items Per Page', 'gillion'),
        'desc'  => esc_html__('Choose WooCommerce products per page', 'gillion'),
    ),

    'wc_related' => array(
        'type' => 'switch',
        'label' => esc_html__( 'Related Products', 'gillion' ),
        'desc' => esc_html__( 'Enable or disable "Related Products" in single product page', 'gillion' ),
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

	'wc_new' => array(
        'type' => 'switch',
        'label' => esc_html__( 'New Tag', 'gillion' ),
        'desc' => esc_html__( 'Enable or disable new tag (shows 2 days after publishing)', 'gillion' ),
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

	'wc_new_duration' => array(
        'type'  => 'slider',
        'value' => 2,
        'properties' => array(
            'min' => 0,
            'max' => 100,
        ),
        'label' => esc_html__('New Tag Show Duration', 'gillion'),
        'desc'  => esc_html__('Enter duration in days', 'gillion'),
    ),

	'wc_sale_percentage' => array(
        'type'  => 'slider',
        'value' => 15,
        'properties' => array(
            'min' => 0,
            'max' => 100,
        ),
        'label' => esc_html__('Sale Tag Show Starting Percentage', 'gillion'),
        'desc'  => esc_html__('Enable and set starting percentage attribute on sale tag (0 to disable)', 'gillion'),
    ),

	'wc_labels' => array(
        'type' => 'switch',
        'label' => esc_html__( 'Show Labels', 'gillion' ),
        'desc' => esc_html__( 'Enable or disable to show labels instead of the input placeholder', 'gillion' ),
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
	'woocommerce' => array(
		'title'   => esc_html__( 'WooCommerce', 'gillion' ),
		'type'    => 'tab',
		'icon'	  => 'fa fa-phone',
		'options' => array(
			'woocommerce-box' => array(
				'title'   => esc_html__( 'WooCommerce Settings', 'gillion' ),
				'type'    => 'box',
				'options' => $woocommerce_options
			),
		)
	)
);
