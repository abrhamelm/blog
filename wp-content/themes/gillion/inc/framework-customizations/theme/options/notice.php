<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'notice-page' => array(
		'title'   => esc_html__( 'Notice', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'404-page-box' => array(
				'title'   => esc_html__( 'Notice Settings', 'gillion' ),
				'type'    => 'box',
				'options' => array(

					'notice_status' => array(
						'type' => 'switch',
						'label' => esc_html__( 'Notice', 'gillion' ),
						'desc' => esc_html__( 'Enable or disable notice above header', 'gillion' ),
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

					'notice_text' => array(
						'type'   => 'wp-editor',
						'teeny'  => true,
						'reinit' => true,
						'size'   => 'large',
						'label'  => esc_html__( 'Notice Text', 'gillion' ),
						'desc'   => esc_html__( 'Enter notice text', 'gillion' ).'
							<script>jQuery(document).ready(function ($) { setTimeout(function(){ $("#textarea_dynamic_id-tmce").trigger("click"); }, 1); });</script>',
						'editor_height' => 110,
						'value' => 'By using our website, you agree to the use of our cookies.'
					),

					'notice_close' => array(
					    'type'  => 'radio',
					    'value' => 'enable',
					    'label' => esc_html__('Close Button', 'gillion'),
					    'desc'  => esc_html__('Select if this notice can be closed', 'gillion'),
					    'choices' => array(
					        'disable' => esc_html__( 'Disable', 'gillion' ),
					        'enable' => esc_html__( 'Enable (remember close action)', 'gillion' ),
					        'enable2' => esc_html__( 'Enable (do not remember close action)', 'gillion' ),
					    ),
					),

					'notice_more_url' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Learn More URL', 'gillion'),
						'desc'  => esc_html__('Enter learn more URL', 'gillion'),
					),

				)
			),
		)
	)
);
