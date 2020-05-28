<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$lightbox_options = array(
	'lightbox_transition' => array(
		'type'  => 'radio',
		'value' => 'elastic',
		'label' => esc_html__('Transition', 'gillion'),
		'desc'  => esc_html__('Choose lightbox transition', 'gillion'),
		'choices' => array(
			'none' => esc_html__( 'None', 'gillion' ),
			'elastic' => esc_html__( 'Elastic', 'gillion' ),
			'fade' => esc_html__( 'Fade', 'gillion' ),
			'fadeInline' => esc_html__( 'Fade inline', 'gillion' ),
		),
	),

	'lightbox_opacity' => array(
		'type'  => 'slider',
		'value' => 88,
		'properties' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => esc_html__('Background Opacity', 'gillion'),
		'desc'  => esc_html__('Choose lightbox background opacity', 'gillion'),
	),
);


$options = array(
	'lightbox' => array(
		'title'   => esc_html__( 'Lightbox', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'lightbox-box' => array(
				'title'   => esc_html__( 'Lightbox Options', 'gillion' ),
				'type'    => 'box',
				'options' => $lightbox_options
			),
		)
	)
);
