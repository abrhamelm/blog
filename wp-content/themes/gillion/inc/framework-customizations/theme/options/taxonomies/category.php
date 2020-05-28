<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'image' => array(
        'label' => esc_html__( 'Image', 'gillion' ),
        'desc'  => esc_html__( 'Upload a image', 'gillion' ),
        'type'  => 'upload',
        'images_only' => true,
    ),

	'icon' => array(
		'type'  => 'icon',
		'label' => esc_html__('Icon', 'gillion'),
		'desc'  => esc_html__('Choose your media icon', 'gillion'),
		'set' => 'gillion-icons',
	),
);
