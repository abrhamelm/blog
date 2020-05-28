<?php
ob_start("gillion_compress");
if( defined('FW') ) :

/*-----------------------------------------------------------------------------------*/
/* Define Variables
/*-----------------------------------------------------------------------------------*/

$page_layout_val = gillion_option('page_layout');
$page_layout = ( isset( $page_layout_val['page_layout'] ) ) ? esc_attr($page_layout_val['page_layout']) : 'line';
$page_layout_atts = gillion_get_picker( $page_layout_val );

$titlebar_background_main = gillion_get_image( gillion_option( 'titlebar_background' ) );
$titlebar_background_page = gillion_get_image( gillion_post_option( gillion_page_id(), 'titlebar_background' ) );
$titlebar_background = ( $titlebar_background_page ) ? $titlebar_background_page : $titlebar_background_main;

$header_bottom_border = gillion_post_option( gillion_page_id(), 'header_bottom_border' );

$content_width = gillion_option( 'content_width', 1200 );

$page = (get_query_var('page')) ? get_query_var('page') : 1;
$page = (get_query_var('paged')) ? get_query_var('paged') : $page;
?>

<?php
/*-----------------------------------------------------------------------------------*/
/* Page Layout
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $page_layout == 'boxed' ) :
		$background_image = gillion_get_image( $page_layout_atts['page_background_image'] );
		$current = 0;
		if( $page_layout_atts['specific_pages'] ) :
			$limits = explode( ",", $page_layout_atts['specific_pages'] );
			foreach( $limits as $limit ) :
				if( intval( $limit ) == gillion_page_id() ) :
					$current = 1;
				endif;
			endforeach;
		else :
			$limits = '';
		endif;

		if( is_string( $limits ) || ( count( $limits ) > 0 && $current == 1 ) ) : ?>
			<?php if( $page_layout_atts['page_background_color'] ) : ?>
				body {
					background-color: <?php echo esc_attr( $page_layout_atts['page_background_color'] ); ?>!important;
					<?php if( $background_image ) : ?>
						background-image: url(<?php echo esc_url( $background_image ); ?>);
						background-size: cover;
						background-position: center bottom;
						background-repeat: no-repeat;
					<?php endif; ?>
				}
			<?php endif; ?>

			body #page-container {
				position: relative;
				max-width: 1200px!important;
				margin: 0 auto;

				<?php if( $page_layout_atts['content_background_color'] ) : ?>
					background-color: <?php echo esc_attr( $page_layout_atts['content_background_color'] ); ?>!important;
				<?php endif; ?>

				<?php if( $page_layout_atts['page_radius'] ) : ?>
					border-top-left-radius: <?php echo esc_attr( $page_layout_atts['page_radius'] ); ?>;
					border-top-right-radius: <?php echo esc_attr( $page_layout_atts['page_radius'] ); ?>;
					overflow: hidden;
				<?php endif; ?>

				<?php if( $page_layout_atts['margin_top'] ) : ?>
					margin-top: <?php echo esc_attr( $page_layout_atts['margin_top'] ); ?>;
					padding-top: 0px!important;
				<?php endif; ?>

				<?php if( $page_layout_atts['border_style'] == 'shadow' ) : ?>
					box-shadow: 0px 6px 30px rgba(0,0,0,0.1);
				<?php elseif( $page_layout_atts['border_style'] == 'line' ) : ?>
					border-left: 1px solid rgba(0,0,0,0.07);
					border-right: 1px solid rgba(0,0,0,0.07);
					border-bottom: 1px solid rgba(0,0,0,0.07);
				<?php endif; ?>
			}

			#page-container .container {
				width: 100%!important;
				min-width: 100%!important;
				max-width: 100%!important;
				padding-left: 45px!important;
				padding-right: 45px!important;
			}

			.sh-sticky-header-active {
				max-width: 1200px!important;
				margin: 0 auto;
			}
		<?php endif; ?>
	<?php endif; ?>



	<?php if( $content_width && $content_width != 1200 && $content_width >= 1000 ) : ?>
		@media (min-width: <?php echo intval( $content_width ) / 100; ?>50px) {
			.container {
			    max-width: <?php echo intval( $content_width ); ?>px!important;
				min-width: <?php echo intval( $content_width ); ?>px!important;
			    width: <?php echo intval( $content_width ); ?>px!important;
			}
		}
	<?php endif; ?>

<?php
/*-----------------------------------------------------------------------------------*/
/* Titlebar
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $titlebar_background ) : ?>
		.sh-titlebar {
			background-image: url( <?php echo esc_url( $titlebar_background ); ?> );
		}
	<?php endif; ?>

    <?php if( $header_bottom_border == 'off' && $page == 1 ) : ?>
		.sh-header:not(.sh-sticky-header-active),
		.sh-header:not(.sh-sticky-header-active) > .sh-header-standard {
			border-width: 0px!important;
			border-bottom-width: 0px!important;
		}
	<?php endif; ?>


<?php endif;
ob_end_flush();
?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Mega menu
/*-----------------------------------------------------------------------------------*/
?>

<?php
    /*if( function_exists( 'fw_ext_mega_menu_get_db_item_option' ) ) :
    	$locations = get_nav_menu_locations();
    	if( isset( $locations[ 'header' ] ) ) :
    		$menu = wp_get_nav_menu_object( $locations[ 'header' ] );
    		$menuitems = wp_get_nav_menu_items( $menu->term_id );
    		foreach( $menuitems as $menuitem ) :
    			$id = $menuitem->ID;
    			$item_type = fw_ext_mega_menu_get_db_item_option( $id, 'type' );
    			if( $item_type == 'row' ) :
    				$mega_bs = fw_ext_mega_menu_get_db_item_option( $id, 'row/background_image' );
    				if( gillion_get_image_size( $mega_bs ) ) : ?>

    					.menu-item-273 .mega-menu-row {
    						background-image: url( <?php echo esc_url( gillion_get_image_size( $mega_bs ) ); ?> )!important;
    					}

    				<?php endif;
    			endif;
    		endforeach;
    	endif;
    endif;*/
?>
