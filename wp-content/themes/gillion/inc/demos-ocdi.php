<?php
/**
 * OCDI Demo Installation Method
 */
function gillion_ocdi_import_files() {
    $demos = array(

        array(
            'import_file_name'           => 'Blog Styles Bundle',
            'categories'                 => array( 'Basic', 'Bundle' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/blog_style_bundle/blog_style_bundle.xml',
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/blog_style_bundle.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/blog-style/masonry-style/',
        ),

        array(
            'import_file_name'           => 'Features Bundle',
            'categories'                 => array( 'Basic', 'Bundle' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/features_bundle/features_bundle.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/features_bundle.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/post-content-gallery/',
        ),

        array(
            'import_file_name'           => 'Basic Bundle',
            'categories'                 => array( 'Basic', 'Bundle' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/basic/basic_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/basic/basic_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/basic/basic_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/basic_bundle.jpg',
            //'import_notice'              => __( '', 'gillion' ),
            'preview_url'                => 'https://gillion.shufflehound.com/',
        ),

        array(
            'import_file_name'           => 'Carousel Slider',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/carousel_slider.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/',
        ),

        array(
            'import_file_name'           => 'Boxed Slider',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/boxed_slider/boxed_slider_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/boxed_slider.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/home/boxed-slider/',
        ),

        array(
            'import_file_name'           => 'Full-Width Slider',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/full_width_slider/full_width_slider_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/full_width_slider.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/home/full-width-slider/',
        ),

        array(
            'import_file_name'           => 'Creative Slider',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/creative_slider/creative_slider_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/creative_slider.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/home/creative-slider/',
        ),

        array(
            'import_file_name'           => 'Background Image',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/background_image/background_image_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/background_image.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/home/background-image/',
        ),

        array(
            'import_file_name'           => 'Card Style',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/card_style/card_style_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/carousel_slider/carousel_slider_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/card_style.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/home/card-style/',
        ),

        array(
            'import_file_name'           => 'Lifestyle',
            'categories'                 => array( 'Lifestyle' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/lifestyle/lifestyle_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/lifestyle/lifestyle_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/lifestyle/lifestyle_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/lifestyle.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/lifestyle/',
        ),

        array(
            'import_file_name'           => 'Tech',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/tech/tech_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/tech/tech_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/tech/tech_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/tech.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/tech/',
        ),

        array(
            'import_file_name'           => 'Foodie',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/foodie/foodie_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/foodie/foodie_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/foodie/foodie_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/foodie.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/foodie/',
        ),

        array(
            'import_file_name'           => 'Personal',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/personal/personal_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/personal/personal_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/personal/personal_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/personal.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/personal/',
        ),

        array(
            'import_file_name'           => 'Clean',
            'categories'                 => array( 'Basic' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/clean/clean_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/clean/clean_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/clean/clean_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/clean.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/clean/',
        ),

        array(
            'import_file_name'           => 'Fashion',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/fashion/fashion_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/fashion/fashion_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/fashion/fashion_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/fashion.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/fashion/',
        ),

        array(
            'import_file_name'           => 'Travel',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/travel/travel_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/travel/travel_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/travel/travel_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/travel.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/travel/',
        ),

        array(
            'import_file_name'           => 'Gizmo News',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/gizmo-news/gizmo_news_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/gizmo-news/gizmo_news_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/gizmo-news/gizmo_news_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/gizmo-news.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/gizmo-news/',
        ),

        array(
            'import_file_name'           => 'Shop',
            'categories'                 => array( 'Industries' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/shop/shop_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/shop/shop_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/shop/shop_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_revslider'           => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/shop/shop_slider.zip',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/shop.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/shop1/',
        ),

        array(
            'import_file_name'           => 'Magazine',
            'categories'                 => array( 'Magazine' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/magazine/magazine_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/magazine/magazine_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/magazine/magazine_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/magazine.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/magazine/',
        ),

        array(
            'import_file_name'           => 'News',
            'categories'                 => array( 'Magazine' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/news/news_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/news/news_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/news/news_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_revslider'           => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/news/news_slider.zip',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/news.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/news/',
        ),

        array(
            'import_file_name'           => 'Journal',
            'categories'                 => array( 'Basic', 'Lifestyle' ),
            'import_file_url'            => 'http://api.shufflehound.com/gillion/ocdi_files/journal/journal_content.xml',
            'import_widget_file_url'     => 'http://api.shufflehound.com/gillion/ocdi_files/journal/journal_widgets.wie',
            'import_json'               => array(
                array(
                    'file_url'    => 'http://api.shufflehound.com/gillion/ocdi_files/journal/journal_options.json',
                    'option_name' => 'fw_theme_settings_options:gillion',
                ),
            ),
            'import_preview_image_url'   => 'http://api.shufflehound.com/gillion/files/journal.jpg',
            'preview_url'                => 'https://gillion.shufflehound.com/journal/',
        ),

    );
    return array_reverse( $demos );
}
add_filter( 'pt-ocdi/import_files', 'gillion_ocdi_import_files' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


/**
 * OCDI Demo Installation Method - Final Steps
 */
function gillion_ocdi_after_import_setup( $selected_import ) {
    // Assign menus to their locations.
    $locations = array();
    $header_menu1 = get_term_by( 'name', 'Header Navigation', 'nav_menu' );
    $header_menu2 = get_term_by( 'name', 'Header', 'nav_menu' );
    if( isset( $header_menu1->term_id ) && $header_menu1->term_id > 0 ) :
        $locations['header'] = $header_menu1->term_id;
    elseif( isset( $header_menu2->term_id ) && $header_menu2->term_id > 0 ) :
        $locations['header'] = $header_menu2->term_id;
    endif;

    $topbar_menu = get_term_by( 'name', 'Topbar Navigation', 'nav_menu' );
    if( isset( $topbar_menu->term_id ) && $topbar_menu->term_id > 0 ) :
        $locations['topbar'] = $topbar_menu->term_id;
    endif;

    $footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
    if( isset( $footer_menu->term_id ) && $footer_menu->term_id > 0 ) :
        $locations['footer'] = $footer_menu->term_id;
    endif;
    set_theme_mod( 'nav_menu_locations', $locations );


    // Assign front page
    update_option( 'show_on_front', 'page' );
    $front_page_id1 = get_page_by_title( 'Carousel Slider' );
    $front_page_id2 = get_page_by_title( 'Home - '.$selected_import['import_file_name'] );
    $front_page_id3 = get_page_by_title( 'Home '.$selected_import['import_file_name'] );
    if( isset( $front_page_id1->ID ) && $front_page_id1->ID > 0 ) :
        update_option( 'page_on_front', $front_page_id1->ID );
    elseif( isset( $front_page_id2->ID ) && $front_page_id2->ID > 0 ) :
        update_option( 'page_on_front', $front_page_id2->ID );
    elseif( isset( $front_page_id3->ID ) && $front_page_id3->ID > 0 ) :
        update_option( 'page_on_front', $front_page_id3->ID );
    endif;


    // Reset theme settings
    $upload_dir = wp_upload_dir();
    if( isset( $upload_dir['basedir'] ) ) :
        $file_path  = $upload_dir['basedir'] . '/gillion-dynamic-styles.css';
        if( function_exists( 'wp_delete_file' ) ) :
            wp_delete_file( $file_path );
        endif;
    endif;
    delete_option( 'jevelin_settings_updated' );
    delete_option( 'gillion_settings_updated' );
}
add_action( 'pt-ocdi/after_import', 'gillion_ocdi_after_import_setup' );


/**
 * OCDI Demo Installation Method - Integration for Custom Frameworks and RevSlider
 */
if ( ! function_exists( 'gillion_prefix_after_content_import_execution' ) ) {
  function gillion_prefix_after_content_import_execution( $selected_import_files, $import_files, $selected_index ) {

    $downloader = new OCDI\Downloader();

    if( ! empty( $import_files[$selected_index]['import_json'] ) ) {

      foreach( $import_files[$selected_index]['import_json'] as $index => $import ) {
        $file_path = $downloader->download_file( $import['file_url'], 'demo-json-import-file-'. $index . '-'. date( 'Y-m-d__H-i-s' ) .'.json' );
        $file_raw  = OCDI\Helpers::data_from_file( $file_path );

    	$media = wp_upload_dir();
    	if( isset( $media['baseurl'] ) ) :
    		$url = $media['baseurl'];
    		$url = str_replace('/', '\/', $url);
    		$url = str_replace('http:', '', $url);
            $url = str_replace('https:', '', $url);
    		$file_raw = str_replace( '[SH-GILLION-DOMAIN-LINK]', $url, $file_raw );
    		$file_raw = str_replace( '[SH-GILLION-DOMAIN-MEDIA]', $url, $file_raw );
    	endif;

        update_option( $import['option_name'], json_decode( $file_raw, true ) );
      }

    } else if( ! empty( $import_files[$selected_index]['local_import_json'] ) ) {

      foreach( $import_files[$selected_index]['local_import_json'] as $index => $import ) {
        $file_path = $import['file_path'];
        $file_raw  = OCDI\Helpers::data_from_file( $file_path );
        update_option( $import['option_name'], json_decode( $file_raw, true ) );
      }

    }

    $ocdi       = OCDI\OneClickDemoImport::get_instance();
    $log_path   = $ocdi->get_log_file_path();
    OCDI\Helpers::append_to_file( 'Custom Framework file loaded.', $log_path );


    /* Revolution Slider */
    if ( class_exists( 'RevSlider' ) ) :
        if( !empty( $import_files[$selected_index]['import_revslider'] ) ) :
            $slider = new RevSlider();
            foreach( $import_files[$selected_index]['import_revslider'] as $index => $import ) :
                $file_path = $downloader->download_file( $import['file_url'], 'demo-revslider-import-file-'. $index . '-'. date( 'Y-m-d__H-i-s' ) .'.zip' );
                if( $file_path ) :
                    $slider->importSliderFromPost( true, true, $file_path );
                endif;
            endforeach;
        endif;
   endif;
  }
  add_action('pt-ocdi/after_content_import_execution', 'gillion_prefix_after_content_import_execution', 3, 99 );
}
