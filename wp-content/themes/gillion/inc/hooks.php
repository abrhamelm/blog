<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
* Filters and Actions
*/


/**
 * https://codex.wordpress.org/Content_Width
 */
if ( ! isset($content_width)) {
    $content_width = 1200;
}


/**
 * Dynamic Styles Update
 */
if ( defined( 'FW' ) ) :
    function gillion_dynamic_styles_update( $old_values ) {

        $css = gillion_render_css();
        $upload_dir = wp_upload_dir();
        if( isset( $upload_dir['basedir'] ) ) :
            $file_path  = $upload_dir['basedir'] . '/gillion-dynamic-styles.css';

            global $wp_filesystem;
            if( empty( $wp_filesystem ) ) :
                require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                WP_Filesystem();
            endif;

            if( !$wp_filesystem || !$wp_filesystem->put_contents( $file_path, $css ) ) :
        		delete_option( 'gillion_settings_updated' );
        	else :
                update_option( 'gillion_settings_updated', rand( 10000000, 900000000 ) );
            endif;
        endif;

    }
    add_action( 'fw_settings_form_saved', 'gillion_dynamic_styles_update' );
    add_action( 'fw_settings_form_reset', 'gillion_dynamic_styles_update' );
    add_action( 'customize_save_after', 'gillion_dynamic_styles_update' );
    add_action( 'after_switch_theme', 'gillion_dynamic_styles_update' );
endif;


/**
 * Load Custom Icon Option
 */
if ( ! function_exists( 'gillion_include_custom_option_types' ) ) :
    function gillion_include_custom_option_types() {
        if (is_admin()) {
            require_once get_template_directory() . '/inc/includes/option-types/new-icon/class-fw-option-type-new-icon.php';
            // and all other option types
        }
    }
    add_action('fw_option_types_init', 'gillion_include_custom_option_types');
endif;


/**
 * Change Header Content
 */
if( !function_exists('gillion_before_header_nav_content') ) :
    add_filter( 'gillion_before_header_nav' , 'gillion_before_header_nav_content' );
    function gillion_before_header_nav_content( $blog_id ) {
        //
    }
endif;

if( !function_exists('gillion_after_header_nav_content') ) :
    add_filter( 'gillion_after_header_nav' , 'gillion_after_header_nav_content' );
    function gillion_after_header_nav_content( $blog_id ) {
        //
    }
endif;



/**
 * General Setup
 */

if ( ! function_exists( 'gillion_setup' ) ) :
	add_action('after_setup_theme', 'gillion_setup');
	function gillion_setup(){

		/* Translations */
	    load_theme_textdomain( 'gillion', get_template_directory() . '/languages' );

        /* Add WooCommerce support */
	    add_theme_support( 'woocommerce' );

	}
endif;


if ( ! function_exists( 'gillion_general_setup' ) ) :
	function gillion_general_setup() {

		/* Add RSS feed links to <head> for posts and comments */
		add_theme_support( 'automatic-feed-links' );

        /* Add editor style */
        add_editor_style(  get_template_directory_uri() . '/css/admin/editor-style.css' );

		/* Enable support for post thumbnails, and declare multiple sizes */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 585, 372, true );
        add_image_size( 'gillion-portrait', 372, 484, true );
        add_image_size( 'gillion-square', 585, 585, true );
        add_image_size( 'gillion-square-small', 220, 220, true );
        add_image_size( 'gillion-square-micro', 80, 80, true );
        add_image_size( 'gillion-square-micro-landscape', 110, 147, true );
        add_image_size( 'gillion-landscape-small', 420, 265, true );
        add_image_size( 'gillion-landscape-large', 1200, 675, true );
        add_image_size( 'gillion-masonry', 585, 1170, false );

		/* Other init */
		add_theme_support( 'title-tag' );
		//add_theme_support( 'custom-background' );
		//add_theme_support( 'custom-header' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		/* Enable support for Post Formats */
		add_theme_support( 'post-formats', array(
			'gallery',
			'quote',
			'link',
			'video',
			'audio',
		) );

		/* KingComposer template path */
        global $kc;
        if( isset( $kc ) ) :
        	$kc->set_template_path( get_template_directory().'/inc/elements/builder-king-composer-elements/' );
        endif;


	}
	add_action( 'init', 'gillion_general_setup' );
endif;


/**
 * Extend the default WordPress body classes
 */
if ( ! function_exists( 'gillion_filter_theme_body_classes' ) ) :
	function gillion_filter_theme_body_classes( $classes ) {

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}

        if( class_exists( 'woocommerce' ) ) :
			$classes[] = 'gillion-woocommerce';
        endif;

		$white_borders = ( esc_attr( gillion_option('white_borders', false)) == true ) ? 'page-white-borders' : '';
		if( $white_borders ) {
			$classes[] = $white_borders;
		}

		$ipad_navigation = ( gillion_option('ipad_landscape_full_navigation', false) == true ) ? 'sh-ipad-landscape-full-navigation' : '';
		if( $ipad_navigation ) {
			$classes[] = $ipad_navigation;
		}

		$header_sticky = ( gillion_option( 'header_sticky', true ) == true  ) ? 'sh-body-header-sticky' : '';
		if( $header_sticky ) {
			$classes[] = $header_sticky;
		}

		$footer_parallax = ( gillion_option( 'footer_parallax', 'off' ) == 'on'  ) ? 'sh-footer-parallax' : '';
		if( $footer_parallax ) {
			$classes[] = $footer_parallax;
		}

        $blog_bookmarks = ( gillion_option( 'blog_bookmarks', 'style_title' ) != 'disabled'  ) ? 'sh-bookmarks-'.gillion_option( 'blog_bookmarks', 'style_title' ) : '';
		if( $blog_bookmarks ) {
			$classes[] = $blog_bookmarks;
		}

        $transparent_everything = ( gillion_post_option( gillion_page_id(), 'transparent_everything', 'off' ) == 'on' ) ? 'sh-transparent-everything' : '';
        if( $transparent_everything ) {
			$classes[] = $transparent_everything;
		}

        $classes[] = 'sh-title-'.esc_attr( gillion_option('global_title', 'style1') );
        $section_tabs = ( gillion_option( 'global_section_tabs', 'default' ) == 'default' ) ? gillion_option( 'global_title', 'style1' ) : gillion_option( 'global_section_tabs', 'style1' );
        $classes[] = 'sh-section-tabs-'.esc_attr( $section_tabs );

        $classes[] = 'sh-carousel-'.esc_attr( gillion_option('global_carousel_buttons', 'style1') );
        $classes[] = 'sh-carousel-position-'.esc_attr( gillion_option('global_carousel_buttons_position', 'title') );
        $classes[] = 'sh-post-categories-'.esc_attr( gillion_option('global_categories', 'style1') );
        $classes[] = 'sh-review-'.esc_attr( gillion_option( 'global_review', 'style1' ) );
        $classes[] = 'sh-meta-order-'.esc_attr( gillion_option( 'global_post_meta_order', 'bottom' ) );
        $classes[] = 'sh-instagram-widget-'.esc_attr( gillion_option( 'global_instagram_widget_columns', 'columns2' ) );
        $classes[] = 'sh-instagram-widget-'.esc_attr( gillion_option( 'global_instagram_widget_columns', 'columns2' ) );
        $classes[] = 'sh-categories-position-'.gillion_option( 'global_categories_position', 'title' );
        $classes[] = 'sh-media-icon-'.gillion_option( 'global_slider_icon_style', 'style1' );
        $classes[] = 'sh-wc-labels-'.gillion_option( 'wc_labels', 'off' );

        $instagram_widget_button = ( gillion_option( 'global_instagram_widget_button', 'off' ) == 'on' ) ? 'sh-instagram-widget-with-button' : '';
        if( $instagram_widget_button ) {
			$classes[] = $instagram_widget_button;
		}

		return $classes;
	}
	add_filter( 'body_class', 'gillion_filter_theme_body_classes' );
endif;


/**
 * Extend the default WordPress post classes
 */
if ( ! function_exists( 'gillion_filter_theme_body_classes' ) ) :
	function gillion_post_classes( $classes ) {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}
		return $classes;
	}

	add_filter( 'post_class', 'gillion_filter_theme_body_classes' );
endif;


/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 */
if ( ! function_exists( 'gillion_wp_title' ) ) :
	function gillion_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'gillion' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'gillion_wp_title', 10, 2 );
endif;


/**
 * Theme Customizer support
 */
{

	/**
	 * Sanitize the Featured Content layout value.
	 *
	 * @param string $layout Layout type.
	 *
	 * @return string Filtered layout type (grid|slider).
	 * @internal
	 */
	function gillion_fw_theme_sanitize_layout( $layout ) {
		if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
			$layout = 'grid';
		}

		return $layout;
	}

	/**
	 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * @internal
	 */
	function gillion_action_theme_customize_preview_js() {
		wp_enqueue_script(
			'gillion-theme-customizer',
			get_template_directory_uri() . '/js/admin/customizer.js',
			array( 'customize-preview' ),
			'1.0',
			true
		);
	}

	add_action( 'customize_preview_init', 'gillion_action_theme_customize_preview_js' );
}


/**
 * Theme Customizer support
 */
if ( defined( 'FW' ) ):
	/**
	 * Display current submitted FW_Form errors
	 * @return array
	 */
	if ( ! function_exists( 'gillion_display_form_errors' ) ):
		function gillion_display_form_errors() {
			$form = FW_Form::get_submitted();

			if ( ! $form || $form->is_valid() ) {
				return;
			}

			wp_enqueue_script(
				'gillion-show-form-errors',
				get_template_directory_uri() . '/js/form-errors.js',
				array( 'jquery' ),
				'1.0',
				true
			);

			wp_localize_script( 'gillion-show-form-errors', '_localized_form_errors', array(
				'errors'  => $form->get_errors(),
				'form_id' => $form->get_id()
			) );
		}
	endif;
	add_action('wp_enqueue_scripts', 'gillion_display_form_errors');
endif;




/**
 * Register widget areas.
 */
if ( ! function_exists( 'gillion_theme_widgets' ) ) :
	function gillion_theme_widgets() {
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Widgets', 'gillion' ),
			'id'            => 'blog-widgets',
			'description'   => esc_html__( 'Appears in the blog page sidebar.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

		register_sidebar( array(
			'name'          => esc_html__( 'Page Widgets', 'gillion' ),
			'id'            => 'page-widgets',
			'description'   => esc_html__( 'Appears in the page sidebar if widgets are added, otherwise footer widgets are used.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'Shop Widgets', 'gillion' ),
			'id'            => 'woocommerce-widgets',
			'description'   => esc_html__( 'Appears in shop page sidebar', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'WPbakery Page Builder Widgets', 'gillion' ),
			'id'            => 'vc-widgets',
			'description'   => esc_html__( 'Can be used in Visual Composer', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( '404 Widgets', 'gillion' ),
			'id'            => '404-widgets',
			'description'   => esc_html__( 'Appears in the 404 page widget place.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'Header Side Menu Widgets', 'gillion' ),
			'id'            => 'side-widgets',
			'description'   => esc_html__( 'Appears in the blog page sidebar.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1 Widgets', 'gillion' ),
			'id'            => 'footer-widgets1',
			'description'   => esc_html__( 'Appears in the page footer.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'Footer 2 Widgets', 'gillion' ),
			'id'            => 'footer-widgets2',
			'description'   => esc_html__( 'Appears in the page footer.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'Footer 3 Widgets', 'gillion' ),
			'id'            => 'footer-widgets3',
			'description'   => esc_html__( 'Appears in the page footer.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));

        register_sidebar( array(
			'name'          => esc_html__( 'Footer Instagram Widgets (Only)', 'gillion' ),
			'id'            => 'footer-instagram',
			'description'   => esc_html__( 'Appears above the page footer.', 'gillion' ),
			'before_widget' => '<div id="%1$s" class="widget-item %2$s">',
			'after_widget'  => '</div>',
            'before_title'  => '<div class="sh-widget-title-styling"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		));
	}

	add_action( 'widgets_init', 'gillion_theme_widgets' );
endif;


/**
 * Display current submitted FW_Form errors
 */
if ( defined( 'FW' ) && !function_exists( 'gillion_form_errors' ) ):
	function gillion_form_errors() {
		$form = FW_Form::get_submitted();

		if ( ! $form || $form->is_valid() ) {
			return;
		}

		wp_enqueue_script(
			'gillion-theme-show-form-errors',
			get_template_directory_uri() . '/js/form-errors.js',
			array( 'jquery' ),
			'1.0',
			true
		);

		wp_localize_script( 'fw-theme-show-form-errors', '_localized_form_errors', array(
			'errors'  => $form->get_errors(),
			'form_id' => $form->get_id()
		) );
	}
	add_action('wp_enqueue_scripts', 'gillion_form_errors');
endif;


/**
 * Sync common Theme Settings and Customizer options db values
 * @internal
 */
class gillion_Sync_Customizer_Options {
    public static function init() {
        add_action('customize_save_after', array(__CLASS__, '_action_after_customizer_save'));
        add_action('fw_settings_form_saved', array(__CLASS__, '_action_after_settings_save'));
        add_action('fw_settings_form_reset', array(__CLASS__, '_action_after_settings_save'));

        /* Callback when lattest settings is not registered */
        add_action('customize_save_after', array(__CLASS__, '_action_after_customizer_save_delay'));
        add_action('customize_save_after_delay','gillion_Sync_Customizer_Options::_action_after_customizer_save', 5 );
    }

    /**
     * If a customizer option also exists in settings options, copy its value to settings option value
     */

     public static function _action_after_customizer_save_delay(){
         gillion_Sync_Customizer_Options::_action_after_customizer_save();
         wp_schedule_single_event(time() + 0, 'customize_save_after_delay');
     }


    public static function _action_after_customizer_save()
    {
        $settings_options = fw_extract_only_options(fw()->theme->get_settings_options());
        //error_log( print_r( $settings_options, true ) );

        foreach (
            array_intersect_key(
                fw_extract_only_options(fw()->theme->get_customizer_options()),
                $settings_options
            )
            as $option_id => $option
        ) {
            if ($option['type'] === $settings_options[$option_id]['type']) {
                fw_set_db_settings_option(
                    $option_id, fw_get_db_customizer_option($option_id)
                );
            }
        }
    }

    /**
     * If a settings option also exists in customizer options, copy its value to customizer option value
     */
    public static function _action_after_settings_save()
    {
        $customizer_options = fw_extract_only_options(fw()->theme->get_customizer_options());
        //error_log( print_r($customizer_options, TRUE) );
        foreach (
            array_intersect_key(
                fw_extract_only_options(fw()->theme->get_settings_options()),
                $customizer_options
            )
            as $option_id => $option
        ) {
            if ($option['type'] === $customizer_options[$option_id]['type']) {
                fw_set_db_customizer_option(
                    $option_id, fw_get_db_settings_option($option_id)
                );
            }
        }
    }
}
gillion_Sync_Customizer_Options::init();
