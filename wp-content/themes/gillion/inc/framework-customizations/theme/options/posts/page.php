<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

    'page_settings' => array(
        'title'   => esc_html__( 'Page Settings', 'gillion' ),
        'type'    => 'box',
        'options' => array(
            'general_tab' => array(
                'title'   => esc_html__( 'General', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

                    'page_layout' => array(
                        'type'  => 'radio',
                        'value' => 'global_default',
                        'label' => esc_html__( 'Page Layout', 'gillion' ),
                        'desc'  => esc_html__( 'Choose main page layout', 'gillion' ),
                        'choices' => array(
							'global_default' => esc_html__( 'Global Default (from theme settings)', 'gillion' ),
                            'default' => esc_html__( 'Default (without sidebar)', 'gillion' ),
							'default default-nopadding' => esc_html__( 'Default (without sidebar and extra padding)', 'gillion' ),
							'default default-content-after-posts' => esc_html__( 'Default Inversed (without sidebar and content at the bottom)', 'gillion' ),
                            'full' => esc_html__( 'Full Width (without sidebar)', 'gillion' ),
                            'sidebar-left' => esc_html__( 'Sidebar Left', 'gillion' ),
                            'sidebar-right' => esc_html__( 'Sidebar Right', 'gillion' ),
                        ),
                        'inline' => false,
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

            'blog_tab' => array(
                'title'   => esc_html__( 'Blog', 'gillion' ),
                'type'    => 'tab',
                'options' => array(

                    'page_blog_notice' => array(
                        'type'  => 'html-full',
                        'value' => '',
                        'label' => false,
                        'html'  => '<i>Use only if page template is set to <b>Blog</b></i>',
                    ),

					'page_blog_title' => array(
                        'type'  => 'text',
						'label' => esc_html__( 'Blog Custom Title', 'gillion' ),
                    ),

                    'page-blog-style' => array(
                        'type'  => 'radio',
                        'value' => 'masonry masonry-shadow',
                        'label' => esc_html__( 'Blog Style', 'gillion' ),
                        'desc'  => esc_html__( 'Choose blog style', 'gillion' ),
                        'choices' => array(
                            'masonry' => esc_html__( 'Masonry', 'gillion' ),
							'masonry blog-style-masonry-card' => esc_html__( 'Masonry Card', 'gillion' ),
                            'grid' => esc_html__( 'Grid', 'gillion' ),
							'left-small' => esc_html__( 'Left', 'gillion' ),
							'left-mini' => esc_html__( 'Left (mini)', 'gillion' ),
                            'left' => esc_html__( 'Left (large)', 'gillion' ),
							'left-right' => esc_html__( 'Left/Right Mix', 'gillion' ),
							'left-right blog-style-left-right-small' => esc_html__( 'Left/Right Mix (small without description)', 'gillion' ),
							'left-right blog-style-left-right-large' => esc_html__( 'Left/Right Mix (large)', 'gillion' ),
                            'large' => esc_html__( 'Large (title at the top)', 'gillion' ),
							'large large-title-bellow' => esc_html__( 'Large (title bellow the image)', 'gillion' ),
							'large large-centered' => esc_html__( 'Large (centered)', 'gillion' ),
                        ),
                        'inline' => false,
                    ),

					'page_blog_featured' => array(
						'type' => 'switch',
						'label' => esc_html__( 'Blog Featured Post', 'gillion' ),
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

					'page_blog_featured_style' => array(
                        'type'  => 'radio',
                        'value' => 'large',
                        'label' => esc_html__( 'Blog Featured Post Style', 'gillion' ),
                        'desc'  => esc_html__( 'Choose blog featured post style', 'gillion' ),
                        'choices' => array(
                            'large' => esc_html__( 'Large (title at the top)', 'gillion' ),
							'large large-title-bellow' => esc_html__( 'Large (title bellow the image)', 'gillion' ),
							'large large-centered' => esc_html__( 'Large (centered)', 'gillion' ),
                        ),
                        'inline' => false,
                    ),

					'page_blog_pagination_alignment' => array(
                        'type'  => 'radio',
                        'value' => 'left',
                        'label' => esc_html__( 'Blog Pagination Alignment', 'gillion' ),
                        'desc'  => esc_html__( 'Choose blog pagination alignment', 'gillion' ),
                        'choices' => array(
                            'left' => esc_html__( 'Left', 'gillion' ),
                            'center' => esc_html__( 'Center', 'gillion' ),
                            'right' => esc_html__( 'Right', 'gillion' ),
                        ),
                        'inline' => false,
                    ),

					'page_blog_order' => array(
                        'type'  => 'radio',
                        'value' => 'DESC',
                        'label' => esc_html__( 'Blog Posts Order', 'gillion' ),
                        'desc'  => esc_html__( 'Choose blog posts order', 'gillion' ),
                        'choices' => array(
                            'DESC' => esc_html__( 'Latest posts', 'gillion' ),
                            'ASC' => esc_html__( 'Oldest posts', 'gillion' ),
                            'rand' => esc_html__( 'Random posts', 'gillion' ),
                        ),
                        'inline' => false,
                    ),

					'page_blog_offset' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'Blog Posts Offset', 'gillion' ),
                        'desc' => esc_html__( 'Choose blog posts offset', 'gillion' ),
                        'choices' => array(
							'0' => esc_html__( 'No offset', 'gillion' ),
							'1' => esc_html__( '1 posts', 'gillion' ),
							'2' => esc_html__( '2 posts', 'gillion' ),
							'3' => esc_html__( '3 posts', 'gillion' ),
							'4' => esc_html__( '4 posts', 'gillion' ),
							'5' => esc_html__( '5 posts', 'gillion' ),
							'6' => esc_html__( '6 posts', 'gillion' ),
							'7' => esc_html__( '7 posts', 'gillion' ),
                            '8' => esc_html__( '8 posts', 'gillion' ),
                            '9' => esc_html__( '9 posts', 'gillion' ),
							'10' => esc_html__( '10 posts', 'gillion' ),
							'11' => esc_html__( '11 posts', 'gillion' ),
							'12' => esc_html__( '12 posts', 'gillion' ),
							'13' => esc_html__( '13 posts', 'gillion' ),
							'14' => esc_html__( '14 posts', 'gillion' ),
							'15' => esc_html__( '15 posts', 'gillion' ),
							'16' => esc_html__( '16 posts', 'gillion' ),
                        ),
                        'value' => 'default',
                        'inline' => false,
                    ),

                    'page_blog_category' => array(
                        'type'  => 'multi-select',
                        'label' => esc_html__('Blog Category', 'gillion'),
                        'desc'  => esc_html__('Start typing to add your blog categories one by one', 'gillion'),
                        'population' => 'taxonomy',
                        'source' => 'category',
						'prepopulate' => 200,
				        'limit' => 50,
                    ),

					'page_blog_posts_per_page' => array(
                        'type' => 'select',
                        'label' => esc_html__( 'Blog Posts Per Page', 'gillion' ),
                        'desc' => esc_html__( 'Choose how many posts will be disaplayed per page', 'gillion' ),
                        'choices' => array(
                            'default' => esc_html__( 'Default (from theme options)', 'gillion' ),
							'3' => esc_html__( '3 posts', 'gillion' ),
							'4' => esc_html__( '4 posts', 'gillion' ),
							'5' => esc_html__( '5 posts', 'gillion' ),
							'6' => esc_html__( '6 posts', 'gillion' ),
							'7' => esc_html__( '7 posts', 'gillion' ),
                            '8' => esc_html__( '8 posts', 'gillion' ),
                            '9' => esc_html__( '9 posts', 'gillion' ),
							'10' => esc_html__( '10 posts', 'gillion' ),
							'11' => esc_html__( '11 posts', 'gillion' ),
							'12' => esc_html__( '12 posts', 'gillion' ),
							'13' => esc_html__( '13 posts', 'gillion' ),
							'14' => esc_html__( '14 posts', 'gillion' ),
							'15' => esc_html__( '15 posts', 'gillion' ),
							'16' => esc_html__( '16 posts', 'gillion' ),
                        ),
                        'value' => 'default',
                        'inline' => false,
                    ),

					'page_blog_pagination_type' => array(
                        'type'  => 'radio',
                        'value' => 'default',
                        'label' => esc_html__( 'Blog Pagination Type', 'gillion' ),
                        'desc'  => esc_html__( 'Choose blog pagination type', 'gillion' ),
                        'choices' => array(
                            'default' => esc_html__( 'Default per page', 'gillion' ),
                            'button' => esc_html__( 'Load More button (on click)', 'gillion' ),
                            'infinite' => esc_html__( 'Infinite loading (on scroll)', 'gillion' ),
                        ),
                        'inline' => false,
                    ),

					'page_blog_dividing_line' => array(
						'type' => 'switch',
						'label' => esc_html__( 'Blog Dividing Line', 'gillion' ),
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

					'page_blog_description' => array(
						'type'  => 'radio',
                        'value' => 'default',
						'label' => esc_html__( 'Blog Posts Description', 'gillion' ),
						'choices' => array(
                            'default' => esc_html__( 'Default', 'gillion' ),
                            'off' => esc_html__( 'Off', 'gillion' ),
                        ),
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

                    'footer_hover_color' => array(
                        'type'  => 'color-picker',
                        'value' => '',
                        'label' => esc_html__('Footer Hover Color', 'gillion'),
                        'desc'  => esc_html__('Select footer color on hover', 'gillion'),
                    ),

                ),
            ),
        ),
    ),
);
