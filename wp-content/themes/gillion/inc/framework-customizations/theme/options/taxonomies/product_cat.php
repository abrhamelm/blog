<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'subtitle' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Subtitle', 'gillion'),
		'desc'  => esc_html__('Enter your custom subtitle', 'gillion'),
	),
);
