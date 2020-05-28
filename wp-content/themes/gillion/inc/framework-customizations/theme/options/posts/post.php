<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'post-settings' => array(
        'type'     => 'box',
        'title'    => esc_html__('Post Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

			'source' => array(
				'type'  => 'addable-box',
				'label' => esc_html__( 'Source', 'gillion' ),
				'desc'  => esc_html__( 'Enter your source (will appear in single post page)', 'gillion' ),
				'box-options' => array(
					'name' => array( 'type' => 'text' ),
					'url' => array( 'label' => 'URL', 'type' => 'text' ),
				),
				'template' => '{{- name }} ({{- url }})', // box title
				'limit' => 0,
				'add-button-text' => esc_html__( 'Add a New Source', 'gillion' ),
				'sortable' => true,
			),

			'via' => array(
				'type'  => 'addable-box',
				'label' => esc_html__( 'Via', 'gillion' ),
				'desc'  => esc_html__( 'Enter your via (will appear in single post page)', 'gillion' ),
				'box-options' => array(
					'name' => array( 'type' => 'text' ),
					'url' => array( 'label' => 'URL', 'type' => 'text' ),
				),
				'template' => '{{- name }} ({{- url }})', // box title
				'limit' => 0,
				'add-button-text' => esc_html__( 'Add a New Via', 'gillion' ),
				'sortable' => true,
			),

			'blockquote_style' => array(
			    'type'  => 'radio',
			    'value' => 'default',
			    'label' => esc_html__('Blockquote Style', 'gillion'),
			    'desc'  => esc_html__('Choose blockquote style', 'gillion'),
			    'choices' => array(
					'default'  => esc_html__( 'Default (from theme settings)', 'gillion' ),
					'style1'  => esc_html__( 'Standard with icon in background', 'gillion' ),
                    'style2' => esc_html__( 'With icon in left side', 'gillion' ),
			    ),
			    'inline' => false,
			),

        )
    ),

    'page_settings' => array(
        'title'   => esc_html__( 'Page Settings', 'gillion' ),
        'type'    => 'box',
        'priority' => 'high',
        'options' => array(
            'general_tab' => array(
                'title'   => esc_html__( 'General', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

					/*'post_featured' => array(
                        'type' => 'switch',
                        'label' => esc_html__( 'Featured posts', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable featured post', 'gillion' ),
                        'value' => 'off',
                        'left-choice' => array(
                            'value' => 'off',
                            'label' => esc_html__('Off', 'gillion'),
                        ),
                        'right-choice' => array(
                            'value' => 'on',
                            'label' => esc_html__('On', 'gillion'),
                        ),
                    ),*/

                    'post_layout' => array(
					    'type'  => 'radio',
					    'value' => 'default',
					    'label' => esc_html__('Post Layout', 'gillion'),
					    'desc'  => esc_html__('Choose post layout', 'gillion'),
					    'choices' => array(
                            'default' => esc_html__( 'Default (from theme settings)', 'gillion' ),
					        'standard' => esc_html__( 'Standard (without sidebar)', 'gillion' ),
                            'standard-mini' => esc_html__( 'Standard Mini (without sidebar)', 'gillion' ),
					        'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
					        'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
					    ),
					    'inline' => false,
					),

					'post_style' => array(
					    'type'  => 'radio',
					    'value' => 'default',
					    'label' => esc_html__('Post Style', 'gillion'),
					    'desc'  => esc_html__('Choose post style', 'gillion'),
					    'choices' => array(
							'default'  => esc_html__( 'Default (from theme settings)', 'gillion' ),
                            'standard' => esc_html__( 'Standard', 'gillion' ),
							'toptitle' => esc_html__( 'Standard (with title in the top)', 'gillion' ),
					        'slider'   => esc_html__( 'Slider (will disable titlebar)', 'gillion' ),
					    ),
					    'inline' => false,
					),

				),
            ),

            'review_tab' => array(
                'title'   => esc_html__( 'Review', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

					'review_score' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Review Average Score', 'gillion'),
						'desc'  => esc_html__('Add a average score of your review', 'gillion'),
						'fw-storage' => 'post-meta',
					),

					'review_color' => array(
                        'type'  => 'rgba-color-picker',
                        'label' => esc_html__('Review Score Color', 'gillion'),
                        'desc'  => esc_html__('Add custom review color', 'gillion'),
                        'value' => '',
                    ),

					'review_color2' => array(
                        'type'  => 'rgba-color-picker',
                        'label' => esc_html__('Review Score Color 2', 'gillion'),
                        'desc'  => esc_html__('Add custom review second color to create a gradient', 'gillion'),
                        'value' => '',
                    ),

					'review_pros' => array(
						'type'  => 'addable-option',
					    'label' => esc_html__('Review Pros', 'gillion'),
					    'desc'  => esc_html__('Add multiple pros', 'gillion'),
					    'option' => array( 'type' => 'text' ),
					    'add-button-text' => esc_html__('Add', 'gillion'),
					    'sortable' => true,
					),

					'review_cons' => array(
						'type'  => 'addable-option',
					    'label' => esc_html__('Review Cons', 'gillion'),
					    'desc'  => esc_html__('Add multiple cons', 'gillion'),
					    'option' => array( 'type' => 'text' ),
					    'add-button-text' => esc_html__('Add', 'gillion'),
					    'sortable' => true,
					),

                    'review_criteria' => array(
					    'type'  => 'addable-box',
					    'label' => esc_html__('Review Criteria', 'gillion'),
					    'desc'  => esc_html__('Add multiple review criteria', 'gillion'),
					    'box-options' => array(
					        'name' => array( 'type' => 'text' ),
					        'score' => array( 'name' => 'Score (0-10)', 'type' => 'text' ),
					    ),
					    'template' => '{{- name }} ({{- score }})', // box title
					    'limit' => 0,
					    'add-button-text' => esc_html__('Add a Criteria', 'gillion'),
					    'sortable' => true,
					),

					'review_verdict' => array(
					    'type'  => 'textarea',
					    'label' => esc_html__('Review Final Verdict', 'gillion'),
					    'desc'  => esc_html__('Add review final verdict', 'gillion'),
					),

					'review_layout' => array(
                        'type'  => 'radio',
                        'value' => 'left',
                        'label' => esc_html__('Review Box', 'gillion'),
                        'desc'  => esc_html__('Choose review layout', 'gillion'),
                        'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'gillion' ),
                            'left' => esc_html__( 'Left', 'gillion' ),
                            'right' => esc_html__( 'Right', 'gillion' ),
                            'full' => esc_html__( 'Full', 'gillion' ),
                            'full bottom' => esc_html__( 'Full (bottom position)', 'gillion' ),
                        ),
                    ),

                ),
            ),

			'header_tab' => array(
                'title'   => esc_html__( 'Header', 'gillion' ),
                'type'    => 'tab',
                'options' => array(


                    'header' => array(
                        'type' => 'switch',
                        'label' => esc_html__( 'Header', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable header', 'gillion' ),
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

					'header_sticky' => array(
                        'type'  => 'select',
                        'label' => esc_html__('Header Sticky', 'gillion'),
                        'desc'  => esc_html__('Enable or disable sticky header', 'gillion'),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => 'default',
                        'inline' => false,
                    ),

					'header_bottom_border' => array(
                        'type' => 'switch',
                        'label' => esc_html__( 'Header Bottom Border', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable header bottom border', 'gillion' ),
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

					'topbar_status' => array(
                        'type'  => 'select',
                        'label' => esc_html__('Header Topbar', 'gillion'),
                        'desc'  => esc_html__('Enable or disable header topbar', 'gillion'),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => 'default',
                        'inline' => false,
                    ),

                    'header_layout' => array(
                        'type'  => 'select',
                        'value' => 'default',
                        'label' => esc_html__('Header Layout', 'gillion'),
                        'desc'  => esc_html__('Choose main header layout', 'gillion'),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
							'2' => esc_html__( 'Standard', 'gillion' ),
							'1' => esc_html__( 'Menu Center', 'gillion' ),
							'4' => esc_html__( 'Logo/menu center (icons in menu area)', 'gillion' ),
							'5' => esc_html__( 'Logo/menu center (icons in logo area)', 'gillion' ),
							'3' => esc_html__( 'With Ad place', 'gillion' ),
                        ),
                    ),

                    'header_style' => array(
                        'type'  => 'multi-picker',
                        'label' => false,
                        'desc'  => false,
                        'value' => array(
                            'header_style' => 'default',
                            'manual' => array(
                                'description' => '',
                                'breadcrumbs' => true,
                                'scroll_button' => true,
                            ),
                        ),
                        'picker' => array(
                            'header_style' => array(
                                'type'  => 'select',
                                'value' => '1',
								'label' => esc_html__('Above Content', 'gillion'),
                                'desc'  => esc_html__('Enable or disable header above content', 'gillion'),
                                'choices' => array(
                                    'default' => esc_html__( 'Default', 'gillion' ),
                                    'light' => esc_html__( 'Light Text Large', 'gillion' ),
                                    'light_mobile_off' => esc_html__( 'Light Text Large (default mobile version)', 'gillion' ),
									'dark' => esc_html__( 'Dark Text Large', 'gillion' ),
									'dark_mobile_off' => esc_html__( 'Dark Text Large (default mobile version)', 'gillion' ),
                                ),
                            ),
                        ),
                        'choices' => array(
                            'light' => array(
                                'description' => array(
                                    'type'  => 'text',
                                    'value' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'gillion'),
                                    'label' => esc_html__('Description', 'gillion'),
                                    'desc'  => esc_html__('Enter this page description', 'gillion'),
                                ),

                                'breadcrumbs' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Breadcrumbs', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable dreadcrumbs', 'gillion' ),
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

                                'scroll_button' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Scroll Down Button', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable scroll down button', 'gillion' ),
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
                            ),
							'light_mobile_off' => array(
                                'description' => array(
                                    'type'  => 'text',
                                    'value' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'gillion'),
                                    'label' => esc_html__('Description', 'gillion'),
                                    'desc'  => esc_html__('Enter this page description', 'gillion'),
                                ),

                                'breadcrumbs' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Breadcrumbs', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable dreadcrumbs', 'gillion' ),
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

                                'scroll_button' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Scroll Down Button', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable scroll down button', 'gillion' ),
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

                            ),
							'dark' => array(
                                'description' => array(
                                    'type'  => 'text',
                                    'value' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'gillion'),
                                    'label' => esc_html__('Description', 'gillion'),
                                    'desc'  => esc_html__('Enter this page description', 'gillion'),
                                ),

                                'breadcrumbs' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Breadcrumbs', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable dreadcrumbs', 'gillion' ),
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

                                'scroll_button' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Scroll Down Button', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable scroll down button', 'gillion' ),
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

                            ),
							'dark_mobile_off' => array(
                                'description' => array(
                                    'type'  => 'text',
                                    'value' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'gillion'),
                                    'label' => esc_html__('Description', 'gillion'),
                                    'desc'  => esc_html__('Enter this page description', 'gillion'),
                                ),

                                'breadcrumbs' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Breadcrumbs', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable dreadcrumbs', 'gillion' ),
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

                                'scroll_button' => array(
                                    'type' => 'switch',
                                    'label' => esc_html__( 'Scroll Down Button', 'gillion' ),
                                    'desc' => esc_html__( 'Enable or disable scroll down button', 'gillion' ),
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

                            ),
                        ),
                    ),

                    'titlebar' => array(
                        'type'  => 'select',
                        'label' => esc_html__('Titlebar', 'gillion'),
                        'desc'  => esc_html__('Enable or disable titlebar', 'gillion'),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => '',
                        'inline' => false,
                    ),

                    'titlebar_background' => array(
                        'label' => esc_html__( 'Titlebar Background Image', 'gillion' ),
                        'desc'  => esc_html__( 'Upload titlebar background image', 'gillion' ),
                        'type'  => 'upload'
                    ),

                    'titlebar_background_parallax' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'Titlebar Parallax Background', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable parallax background', 'gillion' ),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => '',
                        'inline' => false,
                    ),

					'transparent_everything' => array(
                        'type' => 'switch',
                        'label' => esc_html__( 'Transparent body/header/titlebar', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable transparent body/header/titlebar', 'gillion' ),
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

                ),
            ),

            'footer_tab' => array(
                'title'   => esc_html__( 'Footer', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

					'instagram_widgets' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'Instagram Widget', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable footer widgets', 'gillion' ),
                        'choices' => array(
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => 'on',
                        'inline' => false,
                    ),

                    'footer_widgets' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'Footer Widgets', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable footer widgets', 'gillion' ),
                       'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => '',
                        'inline' => false,
                    ),

                    'copyright_bar' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'FooterCopyrights', 'gillion' ),
                        'desc' => esc_html__( 'Enable or disable footer copyrights', 'gillion' ),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
                            'on' => esc_html__( 'On', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
                        'value' => '',
                        'inline' => false,
                    ),


                ),
            ),

            'colors_tab' => array(
                'title'   => esc_html__( 'Colors', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

                    'accent_color' => array(
                        'type'  => 'color-picker',
                        'label' => esc_html__('Accent Color', 'gillion'),
                        'desc'  => esc_html__('Set custom accent color for this page or leave blank for default', 'gillion'),
                        'value' => '',
                    ),

                    'accent_hover_color' => array(
                        'type'  => 'rgba-color-picker',
                        'label' => esc_html__('Accent Hover Color', 'gillion'),
                        'desc'  => esc_html__('Select page accent color on hover or leave blank for default', 'gillion'),
                        'value' => '',
                    ),

                    'header_nav_active_color' => array(
                        'type'  => 'rgba-color-picker',
                        'label' => esc_html__('Active Navigation Color', 'gillion'),
                        'desc'  => esc_html__('Select active navigation color or leave blank for default', 'gillion'),
                        'value' => '',
                    ),

                ),
            ),
        ),
    ),

    'post-format-0' => array(
        'type'     => 'box',
        'title'    => esc_html__('Image Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'hide-image' => array(
                'type' => 'switch',
                'label' => esc_html__( 'Hide Featured Image', 'gillion' ),
                'desc' => esc_html__( 'Enable this if you want to hide featured image inside the blog post', 'gillion' ),
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

        )
    ),

    'post-format-gallery' => array(
        'type'     => 'box',
        'title'    => esc_html__('Gallery Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'post-gallery' => array(
                'type'  => 'multi-upload',
                'label' => esc_html__( 'Gallery', 'gillion' ),
                'desc'  => esc_html__( 'Upload images to your gallery', 'gillion' ),
                'images_only' => true,
            ),

        )
    ),


    'post-format-quote' => array(
        'type'     => 'box',
        'title'    => esc_html__('Quote Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'post-quote' => array(
                'type'  => 'textarea',
                'label' => esc_html__( 'Quote', 'gillion' ),
                'desc'  => esc_html__( 'Enter quote', 'gillion' ),
            ),

            'post-quote-author' => array(
                'type' => 'text',
                'label' => esc_html__( 'Quote Author', 'gillion' ),
                'desc' => esc_html__( 'Enter quote author', 'gillion' ),
            ),

        )
    ),


    'post-format-link' => array(
        'type'     => 'box',
        'title'    => esc_html__('Link Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'post-url-title' => array(
                'type' => 'text',
                'label' => esc_html__( 'URL Title', 'gillion' ),
                'desc' => esc_html__( 'Enter URL title', 'gillion' ),
            ),

            'post-url' => array(
                'type' => 'text',
                'label' => esc_html__( 'URL', 'gillion' ),
                'desc' => esc_html__( 'Dont forget to add http://', 'gillion' ),
            ),

        )
    ),


    'post-format-video' => array(
        'type'     => 'box',
        'title'    => esc_html__('Video Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'post-video' => array(
                'type' => 'text',
                'label' => esc_html__( 'Video URL', 'gillion' ),
                'desc' => esc_html__( 'Enter WordPress supported link (like Youtube or Vimeo)', 'gillion' ),
            ),

			'post-video-file' => array(
				'label' => esc_html__( 'Video File URL', 'gillion' ),
				'desc'  => esc_html__( 'Enter video file URL (MP4 or WebM)', 'gillion' ),
				'help' => esc_html__( 'Please note that not all WordPress installation supports media file upload by default', 'gillion' ),
				'type'  => 'upload',
				'images_only' => false,
			),

        )
    ),


    'post-format-audio' => array(
        'type'     => 'box',
        'title'    => esc_html__('Audio Settings', 'gillion'),
        'priority' => 'high',
        'options'  => array(

            'post-audio' => array(
                'type' => 'text',
                'label' => esc_html__( 'Audio URL', 'gillion' ),
                'desc' => esc_html__( 'Enter WordPress supported link (like Soundcloud)', 'gillion' ),
            ),

			'post-audio-file' => array(
				'label' => esc_html__( 'Audio File URL', 'gillion' ),
				'desc'  => esc_html__( 'Enter audio file URL (MP3 or OGG)', 'gillion' ),
				'help' => esc_html__( 'Please note that not all WordPress installation supports media file upload by default', 'gillion' ),
				'type'  => 'upload',
				'images_only' => false,
			),

        )
    ),


	'post-media-copyrights-section' => array(
        'type'     => 'box',
        'title'    => esc_html__('Media Copyrights Settings', 'jevelin'),
        'priority' => 'low',
        'options'  => array(

            'post-copyrights' => array(
                'type' => 'wp-editor',
				'teeny'  => true,
				'reinit' => true,
				'size'   => 'large',
                'label' => esc_html__( 'Copyrights Text', 'jevelin' ),
                'desc' => esc_html__( 'Enter copyrights text for your main featured image, video or media', 'jevelin' ),
            ),

        )
    ),

);
