<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Access forbidden.' ); }
/**
 * Include static files: javascript and css
 */
if ( is_admin() ) {
	return;
}


/**
 * Load JavaScript files
 */

wp_enqueue_script( 'jquery-effects-core' );
wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/plugins/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
wp_enqueue_script( 'gillion-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ) );
wp_enqueue_script( 'gillion-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
wp_localize_script( 'gillion-scripts', 'gillion_loadmore_posts', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));

if(
	( function_exists( 'fw_get_db_customizer_option' ) && fw_get_db_customizer_option('smooth-scrooling') == true ) ||
	( function_exists( 'fw_get_db_settings_option' ) && fw_get_db_settings_option('smooth-scrooling') == true ) &&
	!function_exists( 'shufflehound_disable_smooth_scrolling' )
) :
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/plugins/smoothscroll.js', array( ), '1.4.4', true );
endif;

/* Unminified files
wp_enqueue_script( 'jquery-effects-core' );
wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/plugins/hoverIntent.js', array( 'jquery' ), 'r7', true );
wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/plugins/superfish.js', array( 'jquery' ), '1.7.5', true );
wp_enqueue_script( 'resizesensor', get_template_directory_uri() . '/js/plugins/jquery.resize.sensor.js', array( 'jquery' ), '0.3', true );
wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/plugins/slick.js', array( 'jquery' ) );
wp_enqueue_script( 'lightcase', get_template_directory_uri() . '/js/plugins/lightcase.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'jarallax', get_template_directory_uri() . '/js/plugins/jarallax.js', array( 'jquery' ), '1.5.2', true );
wp_enqueue_script( 'jssocials', get_template_directory_uri() . '/js/plugins/jssocials.min.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/js/plugins/jquery.sticky-kit.min.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/plugins/imagesloaded.pkgd.min.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/plugins/jquery.waypoints.min.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'viewportChecker', get_template_directory_uri() . '/js/plugins/jquery.viewportChecker.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'hoverdir', get_template_directory_uri() . '/js/plugins/jquery.hoverdir.js', array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'actual', get_template_directory_uri() . '/js/plugins/jquery.actual.min.js', array( 'jquery' ), '1.0.16', true );
wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/plugins/jquery.cookie.js', array( 'jquery' ), '1.4.1', true );
wp_enqueue_script( 'tooltipster', get_template_directory_uri() . '/js/plugins/tooltipster.bundle.min.js', array( 'jquery' ), '4.0', true );
wp_enqueue_script( 'justifiedGallery', get_template_directory_uri() . '/js/plugins/jquery.justifiedGallery.js', array( 'jquery' ), '4.0', true );
wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '1.4.1', true );
wp_enqueue_script( 'gillion-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'masonry' ), '1.0', true );
wp_localize_script( 'gillion-scripts', 'gillion_loadmore_posts', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));

if( function_exists( 'fw_get_db_customizer_option' ) && fw_get_db_customizer_option('smooth-scrooling') == true ) :
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( ), '1.4.4', true );
elseif( function_exists( 'fw_get_db_settings_option' ) && fw_get_db_settings_option('smooth-scrooling') == true ) :
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( ), '1.4.4', true );
endif;
*/


/**
 * Load CSS files
 */
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/plugins/bootstrap.min.css', array(), '3.3.4' );
wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/plugins/font-awesome.min.css' );
wp_enqueue_style( 'gillion-plugins', get_template_directory_uri() . '/css/plugins.css' );
wp_enqueue_style( 'gillion-styles', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'gillion-responsive', get_template_directory_uri() . '/css/responsive.css' );


/* Load Dynamic Settings CSS */
$upload_dir = wp_upload_dir();
$file_dir   = $upload_dir['basedir'] . '/gillion-dynamic-styles.css';
$file_path  = $upload_dir['baseurl'] . '/gillion-dynamic-styles.css';
$updated = get_option( 'gillion_settings_updated' );
if( !is_customize_preview() && file_exists( $file_dir ) && $updated > 0 && gillion_option( 'theme_options_stored', 'file' ) == 'file' ) :
	if ( is_ssl() ) :
		$file_path = str_replace( 'http://', 'https://', $file_path );
	endif;

	wp_enqueue_style( 'gillion-theme-settings', $file_path, array(), ''.intval( $updated ).'' );
else :
	$css = gillion_render_css();
	if( $css ) :
		wp_add_inline_style( 'gillion-responsive', $css );
	endif;
endif;
wp_add_inline_style( 'gillion-responsive', gillion_render_css_mini() );


/* Unminified files
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/plugins/bootstrap.min.css', array(), '3.3.4' );
wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/plugins/slick.css', array() );
wp_enqueue_style( 'simple-line-icons', get_template_directory_uri() . '/css/plugins/simple-line-icons.css', false, '1.0.0' );
wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/css/plugins/themify-icons.css', false, '1.0.0' );
wp_enqueue_style( 'lightcase', get_template_directory_uri() . '/css/plugins/lightcase.css', false, '1.0.0' );
wp_enqueue_style( 'jssocials', get_template_directory_uri() . '/css/plugins/jssocials.css', false, '1.0.0' );
wp_enqueue_style( 'pixeden-icons', get_template_directory_uri() . '/css/plugins/pe-icon-7-stroke.css', false, '1.0.0' );
wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/css/plugins/perfect-scrollbar.min.css', false, '1.0.0' );
wp_enqueue_style( 'tooltipster', get_template_directory_uri() . '/css/plugins/tooltipster.bundle.min.css', false, '4.0' );
wp_enqueue_style( 'justifiedGallery', get_template_directory_uri() . '/css/plugins/justifiedGallery.min.css', false, '4.0' );
wp_enqueue_style( 'gillion-styles', get_template_directory_uri() . '/style.css', array(), '1.0' );
wp_enqueue_style( 'gillion-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0' );
*/

if( is_singular( 'post' ) ) :
	wp_enqueue_style( 'plyr', get_template_directory_uri() . '/css/plugins/plyr.css' );
	wp_enqueue_script( 'plyr', get_template_directory_uri() . '/js/plugins/plyr.min.js' );
endif;

if( class_exists( 'woocommerce' ) ) :
	wp_enqueue_style( 'gillion-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
endif;

if( gillion_option('rtl', false) == true ) :
	wp_enqueue_style( 'gillion-rtl', get_template_directory_uri() . '/css/rtl.css', array(), '1.0' );
endif;

if( gillion_option('custom_css') ) :
	$custom_css = gillion_compress( do_shortcode( gillion_option('custom_css') ) );
	if( $custom_css ) :
		wp_add_inline_style( 'gillion-responsive', $custom_css );
	endif;
endif;

if( !function_exists( 'gillion_render_js' ) ) :
	add_action( 'wp_footer', 'gillion_render_js' , 100);
	function gillion_render_js() { ?>
		<script type="text/javascript"><?php get_template_part('inc/templates/render-js' ); ?></script>
	<?php }
endif;


/**
 * Load Google Fonts
 */
if ( function_exists( 'fw_get_db_settings_option' ) ) :
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'gillion' ) ) :
		$enqueue_fonts = array(); $o = '';
		$google_fonts = function_exists('fw_get_google_fonts') ? fw_get_google_fonts() : '';


		global $wp_customize;
		$customizer_option = fw_get_db_customizer_option('styling_body');
		if (isset($wp_customize) && $wp_customize->is_preview() && ! is_admin() && isset($customizer_option) ) {
			$typography1 = fw_get_db_customizer_option('styling_body');
			$typography2 = fw_get_db_customizer_option('styling_headings');
			$typography5 = fw_get_db_customizer_option('categories_font');
			$typography6 = fw_get_db_customizer_option('additional_font');

		} else {
			$typography1 = fw_get_db_settings_option('styling_body');
			$typography2 = fw_get_db_settings_option('styling_headings');
			$typography5 = fw_get_db_settings_option('categories_font');
			$typography6 = fw_get_db_settings_option('additional_font');
		}


		if( isset($google_fonts[$typography1['family']]) ) :
		    $enqueue_fonts[$typography1['family']] =  $google_fonts[$typography1['family']];
		endif;
		if( isset($google_fonts[$typography2['family']]) ) :
		    $enqueue_fonts[$typography2['family']] = $google_fonts[$typography2['family']];
		endif;
		if( isset($google_fonts[$typography5['family']]) ) :
		    $enqueue_fonts[$typography5['family']] = $google_fonts[$typography5['family']];
		endif;
		if( isset($google_fonts[$typography6['family']]) ) :
		    $enqueue_fonts[$typography6['family']] = $google_fonts[$typography6['family']];
		endif;

		if( count( $enqueue_fonts) ) :

			$font_families = array();
			foreach ( $enqueue_fonts as $font => $styles ) :
			    $font_families[] = str_replace( ' ', '+', esc_attr($font) ) . ':' . implode( ',', $styles['variants'] );
			endforeach;

			$subset = gillion_option( 'google_fonts_subset', 'gillion' );
			if( count( $subset ) < 1 ) :
				$subset = array( 'latin' );
			endif;

			if( count($font_families) > 0 ) {
				$fonts_args = array(
					'family' => implode( '%7C', $font_families ),
					'subset' => implode( ',', array_keys($subset) ),
				);

				/* If Unyson plugin is enabled, include Google Fonts from Theme Settings */
				$fonts_url1 = esc_url( add_query_arg( $fonts_args, 'https://fonts.googleapis.com/css' ) );
				wp_enqueue_style( 'gillion-fonts', $fonts_url1, array(), null );
			}

		endif;
	endif;
else :

	/* If Unyson plugin is disabled, include Google Fonts: "Open Sans" and "Montserrat" (this is Gillion theme main font and is used by default in style.css) */
	wp_enqueue_style( 'gillion-default-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,700|Open+Sans:300,400,400i,700' );

endif;


/**
 * Set Javascript variables
 */

$gillion_notice = false;
if( defined('FW') && gillion_option( 'notice_status', true ) == true && gillion_option( 'notice_close', 'enable' ) != 'disable' ) :
	$gillion_notice = esc_js( gillion_option( 'notice_close', 'enable' ) );
endif;

$page_loader = 0;
if( gillion_option('page_loader', 'off') != 'off' ) :
	if( gillion_option('page_loader') == 'on2' ) :
		if (strpos(wp_get_referer(), esc_url( home_url('/') ) ) !== false) :
			$page_loader = 0;
		else :
			$page_loader = 1;
		endif;
	else :
		$page_loader = 1;
	endif;
endif;

if( !defined('FW') ) :
	$social_share = '{"twitter":true,"facebook":true,"googleplus":true,"pinterest":true}';
elseif( is_array( gillion_option( 'social_share' ) ) && count( gillion_option( 'social_share' ) ) ) :
	$social_share = array();
	foreach( gillion_option( 'social_share' ) as $icon => $key ) :
		if( $key == true ) :
			$social_share[$icon] = $key;
		endif;
	endforeach;
else :
	$social_share = '';
endif;

$scripts_array = array(
	'siteurl' => esc_url( home_url( '/' ) ),
	'loggedin' => ( get_current_user_id() > 0 ) ? true : false,
	'page_loader' => $page_loader,
	'notice' => $gillion_notice,
	'header_animation_dropdown_delay' => ( esc_js( gillion_option('header_animation_dropdown_delay' , 1) ) * 1000 ),
	'header_animation_dropdown' => esc_js( gillion_option('header_animation_dropdown' , 'easeOutQuint') ),
	'header_animation_dropdown_speed' => ( esc_js( gillion_option('header_animation_dropdown_speed' , 0.3) ) * 1000 ),
	'lightbox_opacity' => ( ( gillion_option('lightbox_opacity') > 0 ) ? esc_js( gillion_option('lightbox_opacity') ) / 100 : '0.88' ),
	'lightbox_transition' => ( ( gillion_option('lightbox_transition') > 0 ) ? esc_js( gillion_option('lightbox_transition') ) : 'elastic' ),
	'page_numbers_prev' => esc_html__( 'Previous', 'gillion' ),
	'page_numbers_next' => esc_html__( 'Next', 'gillion' ),
	'rtl_support' => ( ( gillion_option('rtl') ) ? true : false ),
	'footer_parallax' => ( ( gillion_option( 'footer_parallax', 'off' ) == 'on' ) ? true : false ),
	'social_share' => json_encode( $social_share ),
	'text_show_all' => esc_html__( 'Show All', 'gillion' ),
);

wp_localize_script( 'gillion-scripts', 'gillion', $scripts_array );
wp_enqueue_script( 'gillion-scripts' );
