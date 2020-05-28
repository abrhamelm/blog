<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$blog_options = array(

	'pagination' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Pagination', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable pagination', 'gillion' ),
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

	'blog-items' => array(
		'type'  => 'slider',
		'value' => 12,
		'properties' => array(
			'min' => 1,
			'max' => 30,
		),
		'label' => esc_html__('Posts Per Page', 'gillion'),
		'desc'  => esc_html__('Choose how many posts will be displayed per page', 'gillion'),
	),

	'blog_tag_cloud' => array(
		'type'  => 'slider',
		'value' => 10,
		'properties' => array(
			'min' => 1,
			'max' => 40,
		),
		'label' => esc_html__('Tag Cloud', 'gillion'),
		'desc'  => esc_html__('Choose blog tag cloud widget limit', 'gillion'),
	),

	'blog_bookmarks' => array(
		'type'  => 'radio',
		'value' => 'style_title',
		'label' => esc_html__('Post Bookmarks', 'gillion'),
		'desc'  => esc_html__('Enable or disable post bookmarks and change their location', 'gillion'),
		'choices' => array(
			'disabled' => esc_html__( 'Disabled', 'gillion' ),
			'style_title' => esc_html__( 'Enabled in title (on hover)', 'gillion' ),
			'style_meta' => esc_html__( 'Enabled in post meta', 'gillion' ),
		),
		'inline' => false,
	),

	'categories-blog-style' => array(
		'type'  => 'radio',
		'value' => 'masonry masonry-shadow',
		'label' => esc_html__( 'Blog Style', 'gillion' ),
		'desc'  => esc_html__( 'Choose blog style for category and main posts pages', 'gillion' ),
		'choices' => array(
			'masonry' => esc_html__( 'Masonry', 'gillion' ),
			'masonry blog-style-masonry-card' => esc_html__( 'Masonry card', 'gillion' ),
			'grid' => esc_html__( 'Grid', 'gillion' ),
			'left-small' => esc_html__( 'Left', 'gillion' ),
			'left' => esc_html__( 'Left (large)', 'gillion' ),
			'left-right' => esc_html__( 'Left/right mix', 'gillion' ),
			'left-right blog-style-left-right-small' => esc_html__( 'Left/right mix (small without description)', 'gillion' ),
			'left-right blog-style-left-right-large' => esc_html__( 'Left/right mix (large)', 'gillion' ),
			'large' => esc_html__( 'Large (title at the top)', 'gillion' ),
			'large large-title-bellow' => esc_html__( 'Large (title bellow the image)', 'gillion' ),
			'large large-centered' => esc_html__( 'Large (centered)', 'gillion' ),
		),
		'inline' => false,
	),

	'post_desc' => array(
		'type'  => 'slider',
		'value' => 45,
		'properties' => array(
			'min' => 0,
			'max' => 200,
		),
		'label' => esc_html__('Description Length', 'gillion'),
		'desc'  => esc_html__('Choose post description preview words length (Excerpt)', 'gillion'),
	),

	'global_post_meta_order' => array(
        'type'  => 'radio',
        'value' => 'bottom',
        'label' => esc_html__( 'Post Meta and Description Order', 'gillion' ),
        'desc'  => esc_html__( 'Choose global post meta (information) and description (excerpt) order', 'gillion' ),
        'choices' => array(
			'bottom' => esc_html__( '1. Description 2. Meta data', 'gillion' ),
			'top' => esc_html__( '1. Meta data 2. Description', 'gillion' ),
        ),
        'inline' => false,
    ),




		'blog_meta_settings' => array( 'type'  => 'html-full', 'value' => '', 'label' => false, 'html'  =>
			'<h3 class="hndle sh-custom-group-divder"><span>'.
				esc_html__( 'Blog Meta Details', 'gillion' )
			.'</span></h3>',
		),

	'blog_meta_author' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Author (without image) + Date', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable meta author (without image) + date in posts where it is used', 'gillion' ),
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

	'blog_meta_authorfull' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Author (with image) + Date', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable meta author (with image) + date in posts where it is used', 'gillion' ),
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

	'blog_meta_comments' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Comments Count', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable meta comments in posts where it is used', 'gillion' ),
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

	'blog_meta_pageviews' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Page Views', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable meta page views in posts where it is used', 'gillion' ),
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

	'blog_meta_readtime' => array(
		'type' => 'switch',
		'label' => esc_html__( 'Read Time', 'gillion' ),
		'desc' => esc_html__( 'Enable or disable read time in posts where it is used', 'gillion' ),
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












);

$options = array(
	'blog' => array(
		'title'	=> esc_html__( 'Blog', 'gillion' ),
		'type'	=> 'tab',
		'icon'	=> 'fa fa-phone',
		'options' => array(
			'blog-box' => array(
				'title'   => esc_html__( 'Blog Settings', 'gillion' ),
				'type'    => 'box',
				'options' => $blog_options
			),
		)
	)
);
