<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$social_options = array(
	'social_share' => array(
		'type'  => 'checkboxes',
		'value' => array(
			'twitter' => true,
			'facebook' => true,
			'pinterest' => true,
			'messenger' => true,
		),
		'label' => esc_html__('Post Social Share Icons', 'gillion'),
		'desc'  => esc_html__('Select social share icons you want to see', 'gillion'),
		'choices' => array(
			'email' => esc_html__('Email', 'gillion'),
			'twitter' => esc_html__('Twitter', 'gillion'),
			'facebook' => esc_html__('Facebook', 'gillion'),
			'linkedin' => esc_html__('Linkedin', 'gillion'),
			'pinterest' => esc_html__('Pinterest', 'gillion'),
			'whatsapp' => esc_html__('Whatsapp', 'gillion'),
			'viber' => esc_html__('Viber', 'gillion'),
			'messenger' => esc_html__('Messenger', 'gillion'),
			'vkontakte' => esc_html__('Vkontakte', 'gillion'),
			'telegram' => esc_html__('Telegram', 'gillion'),
			'line' => esc_html__('Line', 'gillion'),
		),
		'inline' => false,
	),


	'social_icons_title' => array(
		'type'  => 'html-full',
		'value' => '',
		'label' => false,
		'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Social Media Icons', 'gillion').'</span></h3>',
	),

	'social_newtab' => array(
		'label' => esc_html__( 'Links in new tab', 'gillion' ),
		'desc'  => esc_html__( 'Enable or disable social media link opening in new tab', 'gillion' ),
		'type'  => 'switch',
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

	'social_twitter' => array(
		'type'  => 'text',
		'value' => 'https://twitter.com/TheShufflehound',
		'label' => esc_html__('Twitter URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Twitter icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_facebook' => array(
		'type'  => 'text',
		'value' => 'https://www.facebook.com/people/@/shufflehound',
		'label' => esc_html__('Facebook URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Facebook icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_instagram' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Instagram URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Instagram icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_youtube' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Youtube URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the YouTube icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_pinterest' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Pinterest URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Pinterest icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_flickr' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Flickr URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Flickr icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_dribbble' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Dribbble URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Dribbble icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_linkedIn' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('LinkedIn URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the LinkedIn icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_skype' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Skype Name', 'gillion'),
		'desc'  => esc_html__('Enter your account name to show the Skype icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_spotify' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Spotify', 'gillion'),
		'desc'  => esc_html__('Enter your account name to show the Spotify icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_soundcloud' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('SoundCloud', 'gillion'),
		'desc'  => esc_html__('Enter your account name to show the SoundCloud icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_tumblr' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Tumblr URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the Tumblr icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_wordpress' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('WordPress URL', 'gillion'),
		'desc'  => esc_html__('Enter your custom link to show the WordPress icon. Leave blank to hide this icon', 'gillion'),
	),

	'social_custom' => array(
		'type' => 'addable-popup',
		'label' => esc_html__('Custom Social Media', 'gillion'),
		'desc'  => esc_html__('Add custom icons not included in above list for other social media links', 'gillion'),
		'template' => '{{- link }}',
		'popup-title' => null,
		'size' => 'small',
		'limit' => 10,
		'popup-options' => array(

			'icon' => array(
				'type'  => 'icon',
				'label' => esc_html__('Icon', 'gillion'),
				'desc'  => esc_html__('Choose your media icon', 'gillion'),
				'set' => 'gillion-icons',
			),

			'link' => array(
				'type'  => 'text',
				'label' => esc_html__('URL', 'gillion'),
				'desc'  => esc_html__('Enter your custom link to show the icon', 'gillion'),
			),

		),
	),
);

$options = array(
	'social' => array(
		'title'   => esc_html__( 'Social Media Icons', 'gillion' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social Share Icons', 'gillion' ),
				'type'    => 'box',
				'options' => $social_options
			),
		)
	)
);
