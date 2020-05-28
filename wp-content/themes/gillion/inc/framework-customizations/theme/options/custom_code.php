<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'custom' => array(
		'title'   => esc_html__( 'Custom Code', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'custom-box' => array(
				'title'   => esc_html__( 'Custom', 'gillion' ),
				'type'    => 'box',
				'options' => array(

					'custom_css'   => array(
						'label' => esc_html__( 'CSS Code', 'gillion' ),
						'desc'  => esc_html__( 'Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file.', 'gillion' ),
						'type'  => 'textarea',
					),

					'custom_js'   => array(
						'label' => esc_html__( 'JavaScript Code', 'gillion' ),
						'desc'  => esc_html__( 'Enter your JavaScript code', 'gillion' ),
						'type'  => 'textarea',
					),

					'google_analytics'   => array(
						'label' => esc_html__( 'Google Analytics ID', 'gillion' ),
						'desc'  => esc_html__( 'Enter your Google Analytics ID like UA-XXXXX-Y to enable Google Analytics statistics', 'gillion' ),
						'type'  => 'text',
						'attr'  => array( 'style' => 'max-width: 150px' ),
					),

				)
			),
		)
	)
);
