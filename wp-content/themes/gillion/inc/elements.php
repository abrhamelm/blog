<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Auto verify Gillion theme King Composer licence
 */
define('KC_LICENSE', 'l483kg4m-jxbv-ju7k-or7h-yhgd-q3jl1ec3fqyi');
global $kc;
if( isset( $kc ) ) :
	$kc->add_content_type( array( 'pages', 'posts' ) );
endif;


/**
 * Add Custom Elements
 */
add_action('init', 'gillion_elements', 99 );
function gillion_elements() {
    if( function_exists('kc_add_map') ) :
        kc_add_map(
            array(
				'blog_standard_posts' => array (
					'name' => 'Blog Standard Posts',
					'description' => '',
					'category' => 'blog-posts',
					'icon' => 'fa-map-o',
					'is_container' => false,
					'params' => array (
						'general' => array(
							array (
								'name' => 'limit',
								'label' => 'Posts Limit',
								'value' => '3',
								'type' => 'number_slider',
								'admin_label' => true,
								'description' => 'Choose posts limit',
								'options' => array (
									'min' => '0',
									'max' => '50',
									'unit' => '',
									'ratio' => '1',
								),
								'level' => true,
							),
							array (
								'name' => 'style',
								'label' => 'Style',
								'value' => 'grid',
								'type' => 'dropdown',
								'admin_label' => true,
								'description' => 'Choose main style',
								'options' => array (
									'grid' => 'Grid',
								),
								'level' => true,
							),
							array (
								'name' => 'categories',
								'label' => 'Categories',
								'value' => '',
								'type' => 'post_taxonomy',
								'admin_label' => false,
								'description' => '',
								'level' => true,
							),
							array (
								'name' => 'order_by',
								'label'   => esc_html__('Order By', 'gillion'),
								'value' => 'date',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'date' => esc_html__('Date', 'gillion'),
									'name' => esc_html__('Name', 'gillion'),
									'author' => esc_html__('Author', 'gillion'),
									'rand' => esc_html__('Random', 'gillion'),
									'comment_count' => esc_html__('Comment Count', 'gillion'),
								),
								'level' => true,
							),
							array (
								'name' => 'order',
								'label'   => esc_html__('Order', 'gillion'),
								'value' => 'desc',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'asc' => esc_html__('Ascending', 'gillion'),
									'desc' => esc_html__('Descending', 'gillion'),
								),
								'level' => true,
							),
						),
						'title' => array(
							array (
								'name' => 'title',
								'label' => 'Title',
								'value' => '',
								'type' => 'text',
								'admin_label' => true,
							),
        					array(
        						'name'		=> 'css_custom',
        						'type'		=> 'css',
        						'options'	=> array(
        							array(
        								"screens" => "any,1024,999,767,479",
        								'Typography' => array(
        									array('property' => 'color', 'label' => 'Title Color', 'selector' => 'h2.sh-blog-fancy-title'),
											array('property' => 'background-color', 'label' => 'Line Color', 'selector' => 'h2.sh-blog-fancy-title:after'),
        								),
        							)
        						)
        					)
        				),
						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),
					),
				),


				'blog_posts' => array (
					'name' => 'Blog Fancy Posts',
					'description' => '',
					'category' => 'blog-posts',
					'icon' => 'fa-map-o',
					'is_container' => false,
					'params' => array (
						'general' => array(
							array (
								'name' => 'limit',
								'label' => 'Posts Limit',
								'value' => '3',
								'type' => 'number_slider',
								'admin_label' => true,
								'description' => 'Choose posts limit',
								'options' => array (
									'min' => '0',
									'max' => '50',
									'unit' => '',
									'ratio' => '1',
								),
								'level' => true,
							),
							array (
								'name' => 'style',
								'label' => 'Style',
								'value' => 'cover',
								'type' => 'dropdown',
								'admin_label' => true,
								'description' => 'Choose main style',
								'options' => array (
									'cover' => 'Cover',
									'coverbig' => 'Cover Big',
									'mini1' => 'Mini 1',
									'mini2' => 'Mini 2',
									'fancy1' => 'Fancy 1',
									'fancy2' => 'Fancy 2',
									'fancy3' => 'Fancy 3',
								),
								'level' => true,
							),
							array (
								'name' => 'columns',
								'label' => 'Columns',
								'value' => 'columns3',
								'type' => 'dropdown',
								'admin_label' => false,
								'description' => 'Choose post column count',
								'options' => array (
									'columns2' => 'columns2',
									'columns3' => 'columns3',
								),
								'relation' => array (
									'parent' => 'style',
									'show_when' => 'cover',
								),
								'level' => true,
							),
							array (
								'name' => 'columns2',
								'label' => 'Columns',
								'value' => 'columns4',
								'type' => 'dropdown',
								'admin_label' => false,
								'description' => 'Choose post column count',
								'options' => array (
									'columns2' => 'columns2',
									'columns3' => 'columns3',
									'columns4' => 'columns4',
								),
								'relation' => array (
									'parent' => 'style',
									'show_when' => 'mini1',
								),
								'level' => true,
							),
							array (
								'name' => 'columns3',
								'label' => 'Columns',
								'value' => 'columns4',
								'type' => 'dropdown',
								'admin_label' => false,
								'description' => 'Choose post column count',
								'options' => array (
									'columns3' => 'columns3',
									'columns4' => 'columns4',
								),
								'relation' => array (
									'parent' => 'style',
									'show_when' => 'mini2',
								),
								'level' => true,
							),
							array (
								'name' => 'carousel',
								'label' => 'Carousel',
								'value' => 'disabled',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'disabled' => esc_html__('Disabled', 'gillion'),
									'sides' => esc_html__('Enabled in sides', 'gillion'),
									'title' => esc_html__('Enabled in title', 'gillion'),
								),
								'relation' => array (
									'parent' => 'style',
									'show_when' => 'cover,coverbig,mini1',
								),
								'level' => true,
							),
							array (
								'name' => 'alignment',
								'label' => 'Alignment',
								'value' => 'left',
								'type' => 'select',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'left' => esc_html__('Left', 'gillion'),
									'center' => esc_html__('Center', 'gillion'),
								),
								'relation' => array (
									'parent' => 'style',
									'show_when' => 'cover,coverbig',
								),
								'level' => true,
							),

							array(
								'name' => 'posts',
								'post_type'   => 'post',
								'type' => 'autocomplete',
								'label' => esc_html__( 'Show Only Specific Posts', 'gillion' ),
								'admin_label' => false,
							),

							array (
								'name' => 'categories',
								'label' => 'Categories',
								'value' => '',
								'type' => 'post_taxonomy',
								'admin_label' => false,
								'description' => '',
								'level' => true,
							),
							array (
								'name' => 'order_by',
								'label'   => esc_html__('Order By', 'gillion'),
								'value' => 'date',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'date' => esc_html__('Date', 'gillion'),
									'name' => esc_html__('Name', 'gillion'),
									'author' => esc_html__('Author', 'gillion'),
									'rand' => esc_html__('Random', 'gillion'),
									'comment_count' => esc_html__('Comment Count', 'gillion'),
								),
								'level' => true,
							),
							array (
								'name' => 'order',
								'label'   => esc_html__('Order', 'gillion'),
								'value' => 'desc',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'asc' => esc_html__('Ascending', 'gillion'),
									'desc' => esc_html__('Descending', 'gillion'),
								),
								'level' => true,
							),
						),
						'title' => array(
							array (
								'name' => 'title',
								'label' => 'Title',
								'value' => '',
								'type' => 'text',
								'admin_label' => true,
							),
							array (
								'name' => 'title_style',
								'label'   => esc_html__('Title Style', 'gillion'),
								'value' => 'style1',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'style1' => esc_html__('Style 1', 'gillion'),
									'style2' => esc_html__('Style 2', 'gillion'),
								),
								'level' => true,
							),
        					array(
        						'name'		=> 'css_custom',
        						'type'		=> 'css',
        						'options'	=> array(
        							array(
        								"screens" => "any,1024,999,767,479",
        								'Typography' => array(
        									array('property' => 'color', 'label' => 'Title Color', 'selector' => 'h2.sh-blog-fancy-title'),
											array('property' => 'background-color', 'label' => 'Line Color', 'selector' => 'h2.sh-blog-fancy-title:after'),
											array('property' => 'color', 'label' => 'Button Color', 'selector' => '.sh-blog-fancy-title-container .slick-arrow i'),
											array('property' => 'color', 'label' => 'Button Color', 'selector' => '.sh-blog-fancy-title-container .slick-arrow:hover i'),
        								),
        							)
        						)
        					)
        				),
						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),
					),
				),


				'blog_posts_categories' => array (
					'name' => 'Blog Posts Categories',
					'description' => '',
					'category' => 'blog-posts',
					'icon' => 'fa-map-o',
					'is_container' => false,
					'params' => array (
						'general' => array(
							array (
								'name' => 'style',
								'label' => 'Style',
								'value' => 'style1',
								'type' => 'dropdown',
								'admin_label' => false,
								'description' => 'Choose categories style',
								'options' => array (
									'style1' => 'Style 1',
									'style2' => 'Style 2',
								),
								'level' => true,
							),
							array (
								'name' => 'categories',
								'label' => 'Categories',
								'value' => '',
								'type' => 'post_taxonomy',
								'admin_label' => false,
								'description' => '',
								'level' => true,
							),
							array (
								'name' => 'limit',
								'label' => 'Posts Limit',
								'value' => '3',
								'type' => 'number_slider',
								'admin_label' => true,
								'description' => 'Choose posts limit',
								'options' => array (
									'min' => '0',
									'max' => '50',
									'unit' => '',
									'ratio' => '1',
								),
								'level' => true,
							),

							array (
								'name' => 'order',
								'label'   => esc_html__('Order', 'gillion'),
								'value' => 'asc',
								'type' => 'radio',
								'admin_label' => false,
								'description' => '',
								'options' => array (
									'asc' => esc_html__('Ascending', 'gillion'),
									'desc' => esc_html__('Descending', 'gillion'),
								),
								'level' => true,
							),
						),
						'title' => array(
							array (
								'name' => 'title',
								'label' => 'Title',
								'value' => 'Categories',
								'type' => 'text',
								'admin_label' => true,
							),
        					array(
        						'name'		=> 'css_custom',
        						'type'		=> 'css',
        						'options'	=> array(
        							array(
        								"screens" => "any,1024,999,767,479",
        								'Typography' => array(
        									array('property' => 'color', 'label' => 'Title Color', 'selector' => '.sh-categories-title h2'),
											array('property' => 'background-color', 'label' => 'Line Color', 'selector' => '.sh-categories-line-container:after'),
        								),
        							)
        						)
        					)
        				),
						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),
					),
				),


				'blog_categories' => array (
					'name' => 'Blog Categories',
					'description' => '',
					'category' => 'blog-posts',
					'icon' => 'fa-map-o',
					'is_container' => false,
					'params' => array (
						'general' => array(
							array (
								'name' => 'categories',
								'label' => 'Categories',
								'value' => '',
								'type' => 'post_taxonomy',
								'admin_label' => false,
								'description' => '',
								'level' => true,
							),
							array (
								'name' => 'limit',
								'label' => 'Categories Limit',
								'value' => '3',
								'type' => 'number_slider',
								'admin_label' => true,
								'description' => 'Choose posts limit',
								'options' => array (
									'min' => '0',
									'max' => '50',
									'unit' => '',
									'ratio' => '1',
								),
								'level' => true,
							),
						),
						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),
					),
				),


				'blog_slider' => array (
					'name' => 'Blog Slider',
					'description' => '',
					'category' => 'blog-posts',
					'icon' => 'fa-map-o',
					'is_container' => false,
					'params' => array (
						'general' => array(
							array (
								'name' => 'style',
								'label' => 'Style',
								'value' => 'style1',
								'type' => 'dropdown',
								'admin_label' => true,
								'description' => 'Choose categories style',
								'options' => array (
									'style1' => 'Style 1',
									'style2' => 'Style 2',
									'style3' => 'Style 3',
									'style4' => 'Style 4',
								),
								'level' => true,
							),
							array (
								'name' => 'categories',
								'label' => 'Categories',
								'value' => '',
								'type' => 'post_taxonomy',
								'admin_label' => false,
								'description' => '',
								'level' => true,
							),

							array(
								'name' => 'posts',
								'post_type'   => 'post',
								'type' => 'autocomplete',
								'label' => esc_html__( 'Show Only Specific Posts', 'gillion' ),
								'admin_label' => false,
								/*'name' => 'posts',
								'label' => 'Show Only Specific Posts',
								'type' => 'text',
								'description' => 'Enter ids with comma like this: 0, 1, 2, 3',*/
							),

							array (
								'name' => 'limit',
								'label' => 'Posts Limit',
								'value' => '3',
								'type' => 'number_slider',
								'admin_label' => true,
								'description' => 'Choose posts limit',
								'options' => array (
									'min' => '0',
									'max' => '50',
									'unit' => '',
									'ratio' => '1',
								),
								'level' => true,
							),

							array (
								'name' => 'dots',
								'label' => 'Slider Dots',
								'value' => 'on',
								'type' => 'dropdown',
								'description' => 'Choose to enable or disable slider dots',
								'options' => array (
									'off' => 'Off',
									'on' => 'On',
								),
							),

						),
						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),
					),
				),


            )
        );

	endif;
}
