<?php
/**
 * Unyson Demo Installation Method
 */
if ( ! function_exists( 'gillion_remote_demos' ) ) :
	function gillion_remote_demos($demos) {
	    $demos_array = array(
	        'basic-full-visualcomposer' => array(
	            'title' => esc_html__('Basic', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/basic.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/',
	        ),

            'lifestyle-full' => array(
	            'title' => esc_html__('Lifestyle', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/lifestyle.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/lifestyle/',
	        ),

            'tech-full' => array(
	            'title' => esc_html__('Tech', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/tech.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/tech/',
	        ),

            'foodie-full' => array(
	            'title' => esc_html__('Foodie', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/foodie.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/foodie/',
	        ),

            'personal-full' => array(
	            'title' => esc_html__('Personal', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/personal.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/personal/',
	        ),

            'clean-full' => array(
	            'title' => esc_html__('Clean', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/clean.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/clean/',
	        ),

            'fashion-full' => array(
	            'title' => esc_html__('Fashion', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/fashion.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/fashion/',
	        ),

            'travel-full' => array(
	            'title' => esc_html__('Travel', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/travel.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/travel/',
	        ),

            'gizmo-news-full' => array(
	            'title' => esc_html__('Gizmo News', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/gizmo-news.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/gizmo-news/',
	        ),

			'shop-full' => array(
	            'title' => esc_html__('Shop', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/shop.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/shop/',
	        ),

			'magazine-full' => array(
	            'title' => esc_html__('Magazine', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/magazine.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/magazine/',
	        ),

			'news-full' => array(
	            'title' => esc_html__('News', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/news.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/news/',
	        ),

			'journal-full' => array(
	            'title' => esc_html__('Journal', 'gillion'),
	            'screenshot' => 'http://api.shufflehound.com/gillion/files/journal.jpg',
	            'preview_link' => 'https://gillion.shufflehound.com/journal/',
	        ),
	    );
		$demos_array = array_reverse( $demos_array );

	    $download_url = 'http://shufflehound.com/gillion/';

	    foreach ($demos_array as $id => $data) {
	        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
	            'url' => $download_url,
	            'file_id' => $id,
	        ));
	        $demo->set_title($data['title']);
	        $demo->set_screenshot($data['screenshot']);
	        $demo->set_preview_link($data['preview_link']);

	        $demos[ $demo->get_id() ] = $demo;

	        unset($demo);
	    }

	    return $demos;
	}
	add_filter('fw:ext:backups-demo:demos', 'gillion_remote_demos');
endif;
