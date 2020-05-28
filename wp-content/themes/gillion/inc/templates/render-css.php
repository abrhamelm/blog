<?php
ob_start("gillion_compress");
if( defined('FW') ) :

/*-----------------------------------------------------------------------------------*/
/* Define Variables
/*-----------------------------------------------------------------------------------*/

$body = gillion_font_option('styling_body');
$body_color = gillion_option_value('styling_body','color');
$body_line_height = gillion_option_value('styling_body','line-height');
$body_font = gillion_option_value( 'styling_body', 'family', 'Open Sans' );
$body_background = gillion_option( 'styling_body_background' );
$meta_color = gillion_option('styling_meta_color');
$meta_size = gillion_option( 'meta_size', 11 );
$meta_font = gillion_option( 'meta_font', 'default' );

$meta_category_color = gillion_option('styling_meta_categories_color');
$meta_category_hover_color = gillion_option('styling_meta_categories_hover_color');
$meta_category_color_in_slider = gillion_option('styling_meta_categories_slider_color');
$meta_category_hover_color_in_slider = gillion_option('styling_meta_categories_slider_hover_color');
$meta_category_font = gillion_option_value( 'categories_font', 'family', 'Montserrat' );
$meta_category_font_weight = gillion_option_value('categories_font','variation');

$accent_color =  gillion_option('accent_color');
$accent_hover_color = gillion_option('accent_hover_color');
$link_color = gillion_option('link_color');
$link_hover_color = gillion_option('link_hover_color');

$headings = gillion_font_option('styling_headings');
$heading_color = gillion_option_value('styling_headings','color');
$heading_font = gillion_option_value( 'styling_headings','family', 'Montserrat' );
$heading_weight = gillion_option_value( 'styling_headings','variation' );
$heading1 = gillion_option('styling_h1');
$heading2 = gillion_option('styling_h2');
$heading3 = gillion_option('styling_h3');
$heading4 = gillion_option('styling_h4');
$heading5 = gillion_option('styling_h5');
$heading6 = gillion_option('styling_h6');
$headings_line = gillion_option( 'styling_headings_line', 'on' );
$widget_font_weight = gillion_option('styling_widget_font_weight');
$accent_element_font = gillion_option('accent_element_font');
$additional_font = gillion_option_value( 'additional_font', 'family', 'Montserrat' );
$widget_title_font = gillion_option('widget_title_font', 'heading');
$post_title_font = gillion_option('post_title_font', 'heading');
$post_title_uppercase = gillion_option('post_title_uppercase', false);
$single_content_size = gillion_option('styling_single_content_size', '15');

$header_additional_padding = gillion_option('header_additional_padding');
$header_width = gillion_option('header_width');
$header_uppercase = gillion_option('header_uppercase');
$header_mobile_uppercase = gillion_option('header_mobile_uppercase');
$header_background_color = gillion_option('header_background_color');
$header_background_image = gillion_option_image('header_background_image');
$header_text_color = gillion_option('header_text_color');
$header_border_color = gillion_option('header_border_color');
$topbar_background_color = gillion_option('header_top_background_color');
$topbar_background_image = gillion_option_image('header_top_background_image');
$topbar_color = gillion_option('header_top_color');
$topbar_hover_color = gillion_option('header_top_hover_color');
$topbar_nav_size = gillion_option('header_top_nav_size');
$topbar_nav_font_weight = gillion_option('header_top_nav_font_weight');

$header_logo_background_color = gillion_option('header_logo_background_color');
$header_logo_background_image = gillion_option_image('header_logo_background_image');

$header_nav_size = gillion_option('header_nav_size');
$header_mobile_nav_size = gillion_option('header_mobile_nav_size');
$header_nav_color = gillion_option('header_nav_color');
$header_nav_hover_color = gillion_option('header_nav_hover_color');
$header_nav_active_color = gillion_option('header_nav_active_color');
$header_nav_active_line_color = gillion_option('header_nav_active_line_color');
$header_nav_active_background_color = gillion_option('header_nav_active_background_color');
$header_height = ( intval( gillion_logo_height() ) + 30 );
if( $header_height < 70 ) :
	$header_height = 70;
endif;
$header_nav_icon_color = gillion_option('header_nav_icon_color');
$header_nav_icon_hover_color = gillion_option('header_nav_icon_hover_color');

$menu_font_size = gillion_option('menu_font_size');
$menu_background_color = gillion_option('menu_background_color');
$menu_link_border_color = gillion_option('menu_link_border_color');
$menu_link_color = gillion_option('menu_link_color');
$menu_link_hover_color = gillion_option('menu_link_hover_color');
$menu_link_border_color = gillion_option('menu_link_border_color');

$sidebar_headings = gillion_font_option('sidebar_headings');
$sidebar_border_color = gillion_option('sidebar_border_color');

$footer_width = gillion_option('footer_width');
$footer_background_image = gillion_option_image('footer_background_image');
$footer_background_color = gillion_option('footer_background_color');
$footer_text_color = gillion_option('footer_text_color');
$footer_icon_color = gillion_option('footer_icon_color');
$footer_headings = gillion_font_option('footer_headings');
$footer_border_color = gillion_option('footer_border_color');
$footer_border_color2 = gillion_option( 'footer_border_color2', '#ffffff' );
$footer_bottom_border_color = gillion_option('footer_bottom_border_color');
$footer_widgets_bottom_border_color = gillion_option('footer_widgets_bottom_border_color');
$footer_link_color = gillion_option('footer_link_color');
$footer_hover_color = gillion_option('footer_hover_color');
$footer_columns =  gillion_option('footer_columns');
$footer_padding =  gillion_option('footer_padding');

$copyright_background_color = gillion_option('copyright_background_color');
$copyright_text_color = gillion_option('copyright_text_color');
$copyright_link_color = gillion_option('copyright_link_color');
$copyright_hover_color = gillion_option('copyright_hover_color');
$copyright_border_color = gillion_option('copyright_border_color');

$post_meta = gillion_option( 'post_meta' );
$wc_columns = gillion_option( 'wc_columns' );

$white_borders = gillion_option('white_borders', false);
$header_layout = gillion_option('header_layout', 1);
$crispy_images = gillion_option('crispy_images', false);
$back_to_top_rounded = gillion_option('back_to_top_radius', true);
$rtl_support = gillion_option('rtl_support', false);

$page_404_background = ( gillion_option('404_background') ) ? gillion_option('404_background') : $accent_color;
$page_404_background2 = gillion_option('404_background2');

$global_tabs_transform = gillion_option( 'global_tabs_transform', 'default' );
$global_title_transform = gillion_option( 'global_title_transform', 'none' );
$global_title_weight = gillion_option( 'global_title_weight', 'none' );
$global_title_font_size = gillion_option( 'global_title_font_size' );

$border_radius_images = gillion_option( 'border_radius_images', 'enabled' );
?>

/* Gillion CSS */

<?php
/*-----------------------------------------------------------------------------------*/
/* Body
/*-----------------------------------------------------------------------------------*/
?>

	.sh-default-color a,
	.sh-default-color,
	#sidebar a:not(.widget-learn-more),
	.logged-in-as a ,
	.wpcf7-form-control-wrap .simpleselect {
		color: <?php echo esc_attr( $body_color ); ?>!important;
	}

	html body,
	html .menu-item a {
		<?php echo wp_kses_post( $body ); ?>
		<?php if( $body_background != '#ffffff' ) : ?>
			background-color: <?php echo esc_attr( $body_background ); ?>;
		<?php endif; ?>
	}

	<?php if( $body_line_height > 0 ) : ?>
		body p {
			line-height: <?php echo esc_attr( $body_line_height ); ?>px;
		}
	<?php endif; ?>

	<?php if( $meta_color ) : ?>
		.post-thumnail-caption,
		.post-meta a,
		.post-meta span,
		.sh-pagination a,
		.sh-pagination span,
		#sidebar .widget_recent_entries .post-date {
			color: <?php echo esc_attr( $meta_color ); ?>;
		}

		#sidebar .widget_recent_comments .recentcomments > span a,
		#sidebar .post-meta a {
			color: <?php echo esc_attr( $meta_color ); ?>!important;
		}
	<?php endif; ?>

	<?php if( $meta_size && $meta_size >= 8 && $meta_size != 11 ) : ?>
		.post-meta,
		.post-meta a {
			font-size: <?php echo intval( $meta_size ); ?>px;
		}
	<?php endif; ?>

	<?php if( $meta_font && $meta_font != 'default' ) : ?>
		.post-meta,
		.post-meta a {
			font-family: "<?php
			if( $meta_font == 'body') :
			    echo esc_attr( $body_font );
			elseif( $meta_font == 'meta') :
			    echo esc_attr( $meta_category_font );
			elseif( $meta_font == 'additional') :
			    echo esc_attr( $additional_font );
			elseif( $meta_font == 'heading' ) :
			    echo esc_attr( $heading_font );
			endif;
			?>";
		}
	<?php endif; ?>

	<?php if( $meta_category_color && $meta_category_color != '#d79c6a' ) : ?>
		.post-categories,
		.post-categories a {
			color: <?php echo esc_attr( $meta_category_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $meta_category_hover_color ) : ?>
		.post-categories a:hover,
		.post-categories a:focus {
			color: <?php echo esc_attr( $meta_category_hover_color ); ?>;
		}
	<?php endif; ?>


	<?php if( $meta_category_color_in_slider ) : ?>
		.blog-slider-item .post-categories,
		.blog-slider-item .post-categories a,
		.post-style-cover .post-categories,
		.post-style-cover .post-categories a {
			color: <?php echo esc_attr( $meta_category_color_in_slider ); ?>;
		}
	<?php endif; ?>

	<?php if( $meta_category_hover_color_in_slider ) : ?>
		.blog-slider-item a:hover,
		.blog-slider-item a:focus,
		.post-style-cover a:hover,
		.post-style-cover a:focus {
			color: <?php echo esc_attr( $meta_category_hover_color_in_slider ); ?>;
		}
	<?php endif; ?>


	<?php if( $meta_category_font ) :
		$meta_category_font_weight = ( $meta_category_font_weight == 'regular' ) ? '400' : $meta_category_font_weight;
	?>
		.cat-item a,
		.post-categories,
		.post-categories a {
			font-family: <?php echo esc_attr( $meta_category_font ); ?>;
		}

		.sh-post-categories-style1 .cat-item a,
		.sh-post-categories-style1 .post-categories,
		.sh-post-categories-style1 .post-categories a {
			font-weight: <?php echo esc_attr( $meta_category_font_weight ); ?>
		}
	<?php endif; ?>

<?php
/*-----------------------------------------------------------------------------------*/
/* Accent colors
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( class_exists( 'woocommerce' ) ) : ?>
		.woocommerce-header.step1 .woocommerce-header-item-cart .woocommerce-header-icon i,
		.woocommerce-header.step2 .woocommerce-header-item-checkout .woocommerce-header-icon i,
		.woocommerce-header.step3 .woocommerce-header-item-complate .woocommerce-header-icon i,
	<?php endif; ?>
	.sh-accent-color,
	ul.page-numbers a:hover,
	.sh-comment-date a:hover,
	.comment-respond #cancel-comment-reply-link,
	.post-sticky,
	.post-swtich-style2 h4:hover,
	.sh-unyson-frontend-test.active,
	.plyr--full-ui input[type=range],
	.sh-post-author-info a:hover i,
	.sh-post-author-info h4:hover {
		color: <?php echo esc_attr( $accent_color ); ?>!important;
	}

	<?php if( class_exists( 'woocommerce' ) ) : ?>
		.woocommerce-header.step1 .woocommerce-header-content .woocommerce-header-item-cart .woocommerce-header-icon,
		.woocommerce-header.step2 .woocommerce-header-content .woocommerce-header-item-checkout .woocommerce-header-icon,
		.woocommerce-header.step3 .woocommerce-header-content .woocommerce-header-item-complate .woocommerce-header-icon {
		    border-color: <?php echo esc_attr( $accent_color ); ?>;
		}

		.gillion-woocommerce nav.woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link.is-active {
		    border-left-color: <?php echo esc_attr( $accent_color ); ?>!important;
		}
	<?php endif; ?>

	.sh-post-categories-style2 .post-format-icon:hover,
	.sh-post-categories-style2 .post-thumbnail .post-categories a:hover,
	.sh-post-categories-style2 .post-gallery .post-categories a:hover,
	.sh-post-categories-style2 .blog-slider-item .post-categories a:hover,
	.sh-post-categories-style2 .post-style-cover .post-categories a:hover,
	.sh-dropcaps-full-square,
	.sh-dropcaps-full-square-border,
	.mc4wp-form input[type=submit],
	.mc4wp-form button[type=submit],
	.gillion-woocommerce .woocommerce .return-to-shop a.button,
	.sh-accent-color-background {
		background-color: <?php echo esc_attr( $accent_color ); ?>;
	}

	<?php if( class_exists( 'woocommerce' ) ) : ?>
		.woocommerce-header.step1 .woocommerce-header-item-cart .woocommerce-header-icon span,
		.woocommerce-header.step1 .woocommerce-header-item-cart:after,
		.woocommerce-header.step2 .woocommerce-header-item-checkout .woocommerce-header-icon span,
		.woocommerce-header.step2 .woocommerce-header-item-checkout:before,
		.woocommerce-header.step2 .woocommerce-header-item-checkout:after,
		.woocommerce-header.step3 .woocommerce-header-item-complate .woocommerce-header-icon span,
		.woocommerce-header.step3 .woocommerce-header-item-complate:before,
		.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
		.gillion-woocommerce div.product form.cart .button:hover,
		.gillion-woocommerce .sh-nav .widget_shopping_cart .buttons a.checkout,
		.gillion-woocommerce a.button.alt:hover,
	<?php endif; ?>
	.sh-instagram-widget-with-button .null-instagram-feed .clear a:hover,
	.sh-instagram-widget-with-button .null-instagram-feed .clear a:focus,
	.contact-form input[type="submit"],
	.sh-back-to-top:hover,
	.sh-dropcaps-full-square-tale,
	ul.page-numbers .current,
	ul.page-numbers .current:hover,
	.comment-input-required,
	.widget_tag_cloud a:hover,
	.post-password-form input[type="submit"],
	.wpcf7-form .wpcf7-submit,
	.plyr--audio .plyr__control.plyr__tab-focus,
	.plyr--audio .plyr__control:hover,
	.plyr--audio .plyr__control[aria-expanded=true] {
		background-color: <?php echo esc_attr( $accent_color ); ?>!important;
	}

	::selection {
		background-color: <?php echo esc_attr( $accent_color ); ?>!important;
		color: #fff;
	}
	::-moz-selection {
		background-color: <?php echo esc_attr( $accent_color ); ?>!important;
		color: #fff;
	}

	.sh-dropcaps-full-square-tale:after,
	.widget_tag_cloud a:hover:after {
		border-left-color: <?php echo esc_attr( $accent_color ); ?>!important;
	}

	.sh-instagram-widget-with-button .null-instagram-feed .clear a:hover,
	.sh-instagram-widget-with-button .null-instagram-feed .clear a:focus,
	.sh-back-to-top:hover,
	.vcg-woocommerce-spotlight-tabs li.active a,
	.wpb-js-composer .vc_tta.vc_general.vc_tta-style-flat .vc_tta-tab.vc_active > a {
		border-color: <?php echo esc_attr( $accent_color ); ?>!important;
	}

	<?php if($accent_hover_color) : ?>
		.contact-form input[type="submit"]:hover,
		.wpcf7-form .wpcf7-submit:hover,
		.post-password-form input[type="submit"]:hover,
		.mc4wp-form input[type=submit]:hover,
		.sh-accent-color-background-hover:hover {
			background-color: <?php echo esc_attr( $accent_hover_color ); ?>!important;
		}
	<?php endif; ?>

<?php
/*-----------------------------------------------------------------------------------*/
/* Links
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $link_color ) : ?>
		a {
			color: <?php echo esc_attr( $link_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $link_hover_color ) : ?>
		a:hover,
		a:focus {
			color: <?php echo esc_attr( $link_hover_color ); ?>;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Headings
/*-----------------------------------------------------------------------------------*/
?>

	body h1,
	body h2,
	body h3,
	body h4,
	body h5,
	body h6 {
		<?php echo wp_kses_post( $headings ); ?>
	}

	.post-meta,
	.post-categories,
	.post-switch-item-right,
	.sh-read-later-review-score,
	.sh-nav li.menu-item a,
	.sh-nav-container li.menu-item a,
	.sh-comment-date a,
	.post-button .post-button-text,
	.widget_categories li,
	.sh-dropcaps,
	.sh-dropcaps-full-square,
	.sh-dropcaps-full-square-border,
	.sh-dropcaps-full-square-tale,
	.sh-dropcaps-square-border,
	.sh-dropcaps-square-border2,
	.sh-dropcaps-circle,
	.comment-body .reply,
	.sh-comment-form label,
	blockquote,
	blockquote:after,
	.post-review-score,
	.sh-comment-author a,
	.sh-header-top .sh-nav li.menu-item a,
	.post-quote-link-content p,
	.instagram-post-overlay-container,
	.widget_categories li .count,
	.sh-login-popup,
	.widget-learn-more,
	.gillion-woocommerce ul.products li.product,
	.gillion-woocommerce div.product div.summary > *:not(.woocommerce-product-details__short-description),
	.gillion-woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.gillion-woocommerce #review_form,
	.gillion-woocommerce .widget_shopping_cart .cart_list > li > a:not(.remove),
	.gillion-woocommerce .widget_shopping_cart .total,
	.gillion-woocommerce .woocommerce-MyAccount-navigation ul li,
	.gillion-woocommerce table thead,
	body.woocommerce-account.woocommerce-page:not(.woocommerce-edit-address) .woocommerce-MyAccount-content > p,
	.gillion-woocommerce .woocommerce .button,
	.gillion-woocommerce #coupon_code,
	.sh-instagram-widget-with-button .null-instagram-feed .clear a,
	.sh-post-title-font {
		font-family: "<?php
		if( $accent_element_font == 'body') :
			echo esc_attr( $body_font );
		elseif( $accent_element_font == 'meta') :
			echo esc_attr( $meta_category_font );
		else :
			echo esc_attr( $heading_font );
		endif;
		?>";
	}

	<?php if( $post_title_font && $post_title_font != 'heading') : ?>
		.post-title,
		.post-title > h1,
		.post-title > h2,
		.post-title > h3,
		.post-title > h5,
		.sh-post-title-font {
			font-family: "<?php
			if( $post_title_font == 'body') :
				echo esc_attr( $body_font );
			elseif( $post_title_font == 'meta') :
				echo esc_attr( $meta_category_font );
			elseif( $post_title_font == 'additional') :
				echo esc_attr( $additional_font );
			endif;
			?>";
		}
	<?php endif; ?>

	<?php if( $widget_title_font && $widget_title_font != 'heading') : ?>
		.sh-widget-title-styling .widget-title {
			font-family: "<?php
			if( $post_title_font == 'body') :
				echo esc_attr( $body_font );
			elseif( $post_title_font == 'meta') :
				echo esc_attr( $meta_category_font );
			elseif( $post_title_font == 'additional') :
				echo esc_attr( $additional_font );
			endif;
			?>";
		}
	<?php endif; ?>

	.sh-heading-font {
		font-family: "<?php echo esc_attr( $heading_font ); ?>"
	}

	.sh-heading-weight {
		font-weight: <?php echo esc_attr( $heading_weight ); ?>
	}

	<?php if( $heading1 ) : ?>
		h1 {
			font-size: <?php echo esc_attr( $heading1 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $heading2 ) : ?>
		h2 {
			font-size: <?php echo esc_attr( $heading2 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $heading3 ) : ?>
		h3 {
			font-size: <?php echo esc_attr( $heading3 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $heading4 ) : ?>
		h4 {
			font-size: <?php echo esc_attr( $heading4 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $heading5 ) : ?>
		h5 {
			font-size: <?php echo esc_attr( $heading5 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $heading6 ) : ?>
		h6 {
			font-size: <?php echo esc_attr( $heading6 ); ?>px;
		}
	<?php endif; ?>

	<?php if( $headings_line == 'off' ) : ?>
		.sh-footer .post-meta-content>*:not(:last-child):not(:nth-last-child(2)):after,
		.sh-footer-widgets h3:not(.widget-tab-title):after,
		.sh-footer-widgets .sh-widget-poststab-title:after,
		#sidebar h3:after,
		.post-single-title:after,
		.sh-widget-poststab-title:after,
		.sh-blog-fancy-title:after {
			height: 0px;
		}
	<?php endif; ?>

	<?php if( $post_title_uppercase ) : ?>
		.post-title {
			text-transform: uppercase;
		}
	<?php endif; ?>

	<?php if( $single_content_size && $single_content_size != '15' ) : ?>
		.blog-single .post-content/*
		.sh-text-content .page-content*/ {
			font-size: <?php echo esc_attr( $single_content_size ); ?>px;
		}
	<?php endif; ?>

	<?php if( $widget_font_weight && $widget_font_weight != 'default' ) : ?>
		.widget-title,
		.post-single-title,
		.sh-post-author .sh-post-author-info h1,
		.sh-post-author .sh-post-author-info h4,
		.comment-reply-title {
			font-weight: <?php echo esc_attr( $widget_font_weight ); ?>;
		}
	<?php endif; ?>

	.sh-heading-color,
	table th,
	.blog-single .post-title h2:hover,
	.wrap-forms label,
	.wpcf7-form p,
	.post-password-form label,
	#sidebar .widget_categories li > a,
	#sidebar .widget_categories li .count,
	#sidebar .sh-widget-posts-slider-group-style2 .post-categories a,
	#sidebar .sh-widget-posts-slider-group-style3 .post-categories a,
	.sh-footer-widgets .sh-widget-posts-slider-group-style2 .post-categories a,
	.sh-footer-widgets .sh-widget-posts-slider-group-style3 .post-categories a,
	.sh-comment-author,
	.post-meta a:hover,
	.post-meta a:focus,
	.sh-comment-author a,
	.blog-textslider-post a,
	.gillion-woocommerce .price > ins,
	.gillion-woocommerce ul.products li.product .price > span.amount,
	.gillion-woocommerce p.price,
	.gillion-woocommerce span.price,
	.gillion-woocommerce ul.products li.product .woocommerce-loop-product__title,
	.gillion-woocommerce ul.products li.product .outofstock,
	.gillion-woocommerce .widget_shopping_cart .cart_list > li > a:not(.remove),
	.gillion-woocommerce .widget_shopping_cart .total,
	.gillion-woocommerce .widget_shopping_cart .buttons a,
	.gillion-woocommerce .widget_shopping_cart .buttons a:not(.checkout) {
		color: <?php echo esc_attr( $heading_color ); ?>!important;
	}


<?php
/*-----------------------------------------------------------------------------------*/
/* Header
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $header_background_color ) : ?>
		.sh-header,
		.sh-header-top,
		.sh-header-mobile {
			background-color: <?php echo esc_attr( $header_background_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $topbar_background_color ) : ?>
		.sh-header-top {
			background-color: <?php echo esc_attr( $topbar_background_color ); ?>!important;
		}
	<?php endif; ?>

	<?php if( $topbar_color && $topbar_color != '#ffffff' ) : ?>
		.sh-header-top .sh-nav li.menu-item a,
		.sh-header-top .header-social-media a,
		.sh-header-top-date {
			color: <?php echo esc_attr( $topbar_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $topbar_hover_color && $topbar_hover_color != '#b1b1b1' ) : ?>
		.sh-header-top .sh-nav li.menu-item a:hover,
		.sh-header-top .header-social-media a:hover,
		.sh-header-top-date:hover {
			color: <?php echo esc_attr( $topbar_hover_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $topbar_nav_size ) : ?>
		.sh-header-top .sh-nav > li.menu-item > a {
			font-size: <?php echo esc_attr( gillion_addpx( $topbar_nav_size ) ); ?>;
		}
	<?php endif; ?>

	<?php if( $topbar_nav_font_weight && $topbar_nav_font_weight != 'default' ) : ?>
		.sh-header-top .sh-nav > li.menu-item > a {
			font-weight: <?php echo esc_attr( $topbar_nav_font_weight ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_background_image ) : ?>
		.sh-header,
		.sh-header-mobile-navigation {
			background-image: url(<?php echo esc_url( $header_background_image ); ?>);
			background-size: cover;
			background-position: 50% 50%;
		}
	<?php endif; ?>
	<?php if( $topbar_background_image ) : ?>
		.sh-header-top {
			background-image: url(<?php echo esc_url( $topbar_background_image ); ?>);
		}
	<?php endif; ?>

	<?php if( $header_uppercase == true ) : ?>
		.sh-header .sh-nav > li.menu-item > a {
			text-transform: uppercase;
		}
	<?php endif; ?>

	<?php if( $header_mobile_uppercase == true ) : ?>
		.sh-nav-mobile li a {
			text-transform: uppercase;
		}
	<?php endif; ?>

	<?php if( $header_nav_color ) : ?>
		.sh-header-search-close i,
		.sh-header .sh-nav > li.menu-item > a,
		.sh-header-mobile-navigation li.menu-item > a > i {
			color: <?php echo esc_attr( $header_nav_color ); ?>;
		}

		.sh-header .sh-nav-login #header-login > span {
			border-color: <?php echo esc_attr( $header_nav_color ); ?>;
		}
	<?php endif; ?>

	.sh-header .sh-nav > li > a i {
		color: <?php echo esc_attr( $header_nav_icon_color ); ?>;
	}

	.sh-header .sh-nav > li > a:hover i {
		color: <?php echo esc_attr( $header_nav_icon_hover_color ); ?>;
	}

	<?php if( $header_nav_size ) : ?>
		.sh-nav > li.menu-item > a {
			font-size: <?php echo esc_attr( gillion_addpx($header_nav_size) ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_mobile_nav_size ) : ?>
		.sh-nav-mobile li a {
			font-size: <?php echo esc_attr( gillion_addpx($header_mobile_nav_size) ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_nav_hover_color ) : ?>
		.sh-header .sh-nav > li.menu-item:hover:not(.sh-nav-social) > a,
		.sh-header .sh-nav > li.menu-item:hover:not(.sh-nav-social) > a > i,
		.sh-header .sh-nav > li.sh-nav-social > a:hover > i,
		.sh-header-mobile-navigation li > a:hover > i {
			color: <?php echo esc_attr( $header_nav_hover_color ); ?>;
		}

		.sh-header .sh-nav > li.menu-item:hover .sh-hamburger-menu span {
			background-color: <?php echo esc_attr( $header_nav_hover_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_nav_active_color ) : ?>
		.sh-header .sh-nav > .current_page_item > a,
		.sh-header .sh-nav > .current-menu-ancestor > a,
		.sh-header .sh-nav > .current-menu-item > a {
			color: <?php echo esc_attr( $header_nav_active_color ); ?>!important;
		}
	<?php endif; ?>

	<?php if( $header_nav_active_line_color ) : ?>
		.sh-header-3 .sh-header-nav-container .sh-nav > li.current-menu-item a:after,
		.sh-header-4 .sh-nav-container .sh-nav > li.current-menu-item a:after,
		.sh-header-6 .sh-nav-container .sh-nav > li.current-menu-item a:after {
			background-color: <?php echo esc_attr( $header_nav_active_line_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_nav_active_background_color ) : ?>
		.sh-header .sh-nav > .current_page_item {
			background-color: <?php echo esc_attr( $header_nav_active_background_color ); ?>!important;
		}
	<?php endif; ?>

	<?php if( $header_height ) : ?>
		.header-logo img {
			height: <?php echo esc_attr( gillion_logo_height() ); ?>;
			max-height: 250px;
		}

		.sh-header-mobile-navigation .header-logo img {
			height: <?php echo esc_attr( gillion_logo_height( 'responsive' ) ); ?>;
			max-height: 250px;
		}

		.sh-sticky-header-active .header-logo img {
			height: <?php echo esc_attr( gillion_logo_height( 'sticky' ) ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_border_color ) : ?>
		.sh-header,
		.sh-header-3 > .container {
			border-bottom: 1px solid <?php echo esc_attr( $header_border_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_width == 'full' ) : ?>
		.sh-header .container,
		.sh-header-top .container {
			width: 92%!important;
			max-width: 92%!important;
		}
	<?php endif; ?>

	<?php if( $header_additional_padding ) : ?>
		.sh-header:not(.sh-sticky-header-active) {
			padding: <?php echo $header_additional_padding; ?>;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Menu
/*-----------------------------------------------------------------------------------*/
?>

 	<?php if( $menu_background_color ) : ?>
		.sh-header-mobile-dropdown,
		.header-mobile-social-media a,
		.primary-desktop .sh-nav > li.menu-item ul:not(.nav-tabs),
		.sh-header-mobile-dropdown {
			background-color: <?php echo esc_attr( $menu_background_color ); ?>!important;
		}
	<?php endif; ?>

	<?php if( $menu_font_size ) : ?>
		.primary-desktop .sh-nav > li.menu-item ul a {
			font-size: <?php echo esc_attr( gillion_addpx( $menu_font_size ) ); ?>;
		}
	<?php endif; ?>

 	<?php if( $menu_link_border_color ) : ?>
		.sh-nav-mobile li:after,
		.sh-nav-mobile ul:before {
			background-color: <?php echo esc_attr( $menu_link_border_color ); ?>!important;
		}
	<?php endif; ?>

 	<?php if( $menu_link_color ) : ?>
		.header-mobile-social-media a i,
		.sh-nav-mobile li a,
		.primary-desktop .sh-nav > li.menu-item ul a {
			color: <?php echo esc_attr( $menu_link_color ); ?>!important;
		}
	<?php endif; ?>

	.sh-nav-mobile .current_page_item > a,
	.sh-nav-mobile > li a:hover,
	.primary-desktop .sh-nav ul,
	.primary-desktop .sh-nav > li.menu-item ul li:hover > a,
	.primary-desktop .sh-nav > li.menu-item ul li:hover > a i,
	.primary-desktop .sh-nav ul.mega-menu-row li.mega-menu-col > a {
		color: <?php echo esc_attr( $menu_link_hover_color ); ?>!important;
	}

	.header-mobile-social-media,
	.header-mobile-social-media a {
		border-color: <?php echo esc_attr( $menu_link_border_color ); ?>!important;
	}

	/*.primary-desktop .sh-nav li.menu-item ul:not(.nav-tabs) {
		border: 1px solid <?php echo esc_attr( $menu_link_border_color ); ?>!important;
	}*/

	.sh-nav .mega-menu-row > li.menu-item {
		border-right: 1px solid <?php echo esc_attr( $menu_link_border_color ); ?>!important;
	}


	<?php /* Header Logo Section */ ?>
	<?php if( $header_logo_background_color ) : ?>
		.sh-header-middle,
		.sh-header-mobile-navigation {
			background-color: <?php echo esc_attr( $header_logo_background_color ); ?>;
		}
	<?php endif; ?>

	<?php if( $header_logo_background_image ) : ?>
		.sh-header-middle,
		.sh-header-mobile-navigation {
			background-image: url(<?php echo esc_url( $header_logo_background_image ); ?>);
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Sidebar
/*-----------------------------------------------------------------------------------*/
?>

	#sidebar .widget-item .widget-title,
	.wpb_widgetised_column .widget-item .widget-title {
		<?php echo wp_kses_post( $sidebar_headings ); ?>
	}

	<?php if( $sidebar_border_color ) : ?>
		#sidebar .widget-item li {
			border-color: <?php echo esc_attr( $sidebar_border_color ); ?>!important;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Footer
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $footer_width == 'full' ) : ?>
		@media (min-width: 1000px) {
			.sh-footer .container {
				width: 92%!important;
				max-width: 92%!important;
			}
		}
	<?php endif; ?>

	.sh-footer {
		<?php if( $footer_background_image ) : ?>
			background-image: url(<?php echo esc_url ($footer_background_image ); ?>);
		<?php endif; ?>
		background-size: cover;
		background-position: 50% 50%;
	}

	.sh-footer .sh-footer-widgets {
		background-color: <?php echo esc_attr( $footer_background_color ); ?>;
		color: <?php echo esc_attr( $footer_text_color ); ?>;
		<?php if( $footer_padding && $footer_padding != '100px 0px 100px 0px' ) : ?>
			padding: <?php echo esc_attr( $footer_padding ); ?>
		<?php endif; ?>
	}

	.sh-footer .sh-footer-widgets .post-meta,
	.sh-footer .sh-footer-widgets .sh-recent-posts-widgets-item-meta a {
		color: <?php echo esc_attr( $footer_text_color ); ?>;
	}

	.sh-footer .sh-footer-widgets i:not(.icon-link):not(.icon-magnifier),
	.sh-footer .sh-footer-widgets .widget_recent_entries li:before {
		color: <?php echo esc_attr( $footer_icon_color ); ?>!important;
	}

	.sh-footer .sh-footer-widgets h3,
	.sh-footer .sh-footer-widgets h4,
	.sh-title-style2 .sh-footer-widgets .sh-tabs-stying li.active a,
	.sh-title-style2 .sh-footer-widgets .sh-tabs-stying li.active a h4 {
		<?php echo wp_kses_post( $footer_headings ); ?>
	}

	.sh-footer .sh-footer-widgets ul li,
	.sh-footer .sh-footer-widgets ul li,
	.widget_product_categories ul.product-categories a,
	.sh-recent-posts-widgets .sh-recent-posts-widgets-item,
	.sh-footer .sh-widget-posts-slider-style1:not(:last-child),
	.sh-footer-widgets .widget_tag_cloud a,
	.sh-title-style2 .sh-footer-widgets .sh-widget-title-styling,
	.sh-carousel-style2 .sh-footer-widgets .sh-carousel-buttons-styling {
		border-color: <?php echo esc_attr( $footer_border_color ); ?>;
	}

	.sh-title-style2 .sh-footer-widgets .sh-widget-title-styling h3 {
		border-color: <?php echo esc_attr( $footer_border_color2 ); ?>;
	}

	.sh-footer .post-meta-content > *:not(:last-child):not(:nth-last-child(2)):after,
	.sh-footer-widgets h3:not(.widget-tab-title):after,
	.sh-footer-widgets .sh-widget-poststab-title:after,
	.sh-carousel-style2 .sh-footer-widgets .sh-carousel-buttons-styling:after {
		background-color: <?php echo esc_attr( $footer_border_color ); ?>;
	}

	@media (max-width: 1025px) {
		.sh-footer .post-meta-content > *:nth-last-child(2):after {
			background-color: <?php echo esc_attr( $footer_border_color ); ?>;
		}
	}

	.sh-footer-widgets {
		border-bottom: 1px solid <?php echo esc_attr( $footer_bottom_border_color ); ?>;
	}

	<?php if( $footer_widgets_bottom_border_color ) : ?>
		.sh-footer-widgets {
			border-top: 1px solid <?php echo esc_attr( $footer_widgets_bottom_border_color ); ?>;
		}
	<?php endif; ?>

	.sh-footer .sh-footer-widgets a,
	.sh-footer .sh-footer-widgets .post-views,
	.sh-footer .sh-footer-widgets li a,
	.sh-footer .sh-footer-widgets h6,
	.sh-footer .sh-footer-widgets .sh-widget-posts-slider-style1 h5,
	.sh-footer .sh-footer-widgets .sh-widget-posts-slider-style1 h5 span,
	.sh-footer .widget_about_us .widget-quote {
		color: <?php echo esc_attr( $footer_link_color ); ?>;
	}

	.sh-footer .sh-footer-widgets a:hover,
	.sh-footer .sh-footer-widgets li a:hover,
	.sh-footer .sh-footer-widgets h6:hover {
		color: <?php echo esc_attr( $footer_hover_color ); ?>;
	}

	.sh-footer-columns > .widget-item {
		<?php if( $footer_columns == 1 ) : ?>
			width: 100%;
		<?php elseif( $footer_columns == 2 ) : ?>
			width: 50%;
		<?php elseif( $footer_columns == 4 ) : ?>
			width: 25%;
		<?php elseif( $footer_columns == 5 ) : ?>
			width: 20%;
		<?php endif; ?>
	}

	.sh-footer .sh-copyrights {
		background-color: <?php echo esc_attr( $copyright_background_color ); ?>;
		color: <?php echo esc_attr( $copyright_text_color ); ?>;
	}

	.sh-footer .sh-copyrights a,
	.sh-footer .sh-copyrights .sh-nav li.menu-item a {
		color: <?php echo esc_attr( $copyright_link_color ); ?>;
	}

	.sh-footer .sh-copyrights a:hover {
		color: <?php echo esc_attr( $copyright_hover_color ); ?>!important;
	}

	.sh-footer .sh-copyrights-social a {
		border-left: 1px solid <?php echo esc_attr( $copyright_border_color ); ?>;
	}

	.sh-footer .sh-copyrights-social a:last-child {
		border-right: 1px solid <?php echo esc_attr( $copyright_border_color ); ?>;
	}

	@media (max-width: 850px) {
		.sh-footer .sh-copyrights-social a {
			border: 1px solid <?php echo esc_attr( $copyright_border_color ); ?>;
		}
	}


<?php
/*-----------------------------------------------------------------------------------*/
/* Blog / Posts
/*-----------------------------------------------------------------------------------*/
if( $post_meta == 'enabled_single' || $post_meta == 'disabled' ) : ?>
	.post-meta {
		display: none!important;
	}

	<?php if( $post_meta == 'enabled_single' ) :?>
		.post-single-meta .post-meta {
			display: block!important;
		}
	<?php endif; ?>
<?php endif;


/*-----------------------------------------------------------------------------------*/
/* WooCommerce
/*-----------------------------------------------------------------------------------*/
?>

	.gillion-woocommerce #content:not(.page-content) ul.products li.product {
		<?php if( $wc_columns == 3 ) : ?>
			width: 33.3%;
		<?php elseif( $wc_columns == 2 ) : ?>
			width: 50%;
		<?php else : ?>;
			width: 25%;
		<?php endif; ?>
	}

	<?php if( gillion_option( 'wc_labels', 'off' ) == 'on' ) : ?>
		.gillion-woocommerce .woocommerce .woocommerce-billing-fields .form-row label,
		.gillion-woocommerce .woocommerce-additional-fields h3 {
		    display: block!important;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Titlebar
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( gillion_option_image( 'titlebar-background' ) ) : ?>
		.sh-titlebar {
			background-image: url(<?php echo esc_url( gillion_option_image( 'titlebar-background' ) ); ?>);
		}
	<?php endif; ?>

	<?php if( gillion_option( 'titlebar-background-color' ) ) : ?>
		.sh-titlebar {
			background-color: <?php echo esc_attr( gillion_option( 'titlebar-background-color') ); ?>;
		}
	<?php endif; ?>

	<?php if( gillion_option( 'titlebar-title-color' ) ) : ?>
		.sh-titlebar .titlebar-title h1 {
			color: <?php echo esc_attr( gillion_option( 'titlebar-title-color') ); ?>;
		}
	<?php endif; ?>

	<?php if( gillion_option( 'titlebar-breadcrumbs-color' ) ) : ?>
		.sh-titlebar .title-level a,
		.sh-titlebar .title-level span {
			color: <?php echo esc_attr( gillion_option( 'titlebar-breadcrumbs-color') ); ?>!important;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Crispy Images
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $crispy_images == true ) : ?>
		img {
			-webkit-backface-visibility: hidden;
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* RTL Support
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $rtl_support == true ) : ?>
		body {
			text-align: right;
		}

		.sh-comments-required-notice {
			float: left;
		}

		.widget_search .search-field {
			text-align: right;
		}

		.widget_search .search-submit {
			right: auto;
			left: 5px;
		}

		.sh-recent-posts-widgets-item-thumb {
			right: 0;
			left: auto;
		}

		.sh-recent-posts-widgets-item-content {
			padding-left: 0px;
			padding-right: 80px;
		}

		.post-meta-comments > a {
			float: left!important;
		}

		.sh-blog-social div {
			max-width: 600px;
		}

		.sh-contacts-widget-item {
			padding-left: 0px;
			padding-right: 40px!important;
		}

		.sh-contacts-widget-item i {
			right: 0!important;
			left: auto;
		}

		.titlebar-title-h1 {
			text-align: right;
		}

		.sh-nav li.menu-item li.menu-item-has-children > a:after {
			float: left;
		}

		.sh-list-item:after,
		.post-content:before {
			content: "";
			display: block;
			clear: both;
		}

		.post-item h2,
		.post-item .post-content {
			text-align: right;
		}

		input,
		textarea {
			text-align: right;
		}

		.sh-nav {
			float: left;
		}

		.sh-header .sh-nav li.menu-item:first-child {
			padding-left: 0px!important;
		}

		.sh-header .header-logo {
			float: right;
		}

		.sh-copyrights-logo {
			padding-right: 0px;
			padding-left: 25px;
		}

		.menu-item.sh-nav-search {
			padding: 0!important;
		}

		.header-social-media {
			text-align: left;
		}

	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* Back to top button - rounded
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $back_to_top_rounded && $back_to_top_rounded != '0px' ) : ?>
		.sh-back-to-top {
			border-radius: <?php echo esc_attr( $back_to_top_rounded ); ?>
		}
	<?php endif; ?>


<?php
/*-----------------------------------------------------------------------------------*/
/* 404 Page
/*-----------------------------------------------------------------------------------*/
?>

	.sh-404-left .sh-ratio-content {
		background-image: url(<?php echo esc_url( gillion_option_image('404_image') ); ?>);
	}

	.sh-404-page .sh-404-overay {
		<?php
			if( $page_404_background && $page_404_background2 ) :
				echo 'background-color: '.esc_attr( $page_404_background ).'; background: linear-gradient(to bottom, '.esc_attr( $page_404_background ).' 0%,'.esc_attr( $page_404_background2 ).' 100%);';
			elseif( $page_404_background ) :
				echo 'background-color: '.esc_attr( $page_404_background ).';';
			endif;
		?>
	}


<?php
/*-----------------------------------------------------------------------------------*/
/* Page Loader
/*-----------------------------------------------------------------------------------*/
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
?>

	<?php if( $page_loader == 1 ) : ?>
		body {
			overflow: hidden;
		}

		.sh-page-loader {
			background-color: <?php echo esc_attr( gillion_option('page_loader_background_color') ); ?>;
		}

		.sk-cube-grid .sk-cube,
		.sk-folding-cube .sk-cube:before,
		.sk-spinner > div,
		.sh-page-loader-style-spinner .object {
			background-color: <?php echo ( gillion_option('page_loader_accent_color') ) ? esc_attr(gillion_option('page_loader_accent_color')) : esc_attr(gillion_option('accent_color')); ?>!important;
		}
	<?php endif; ?>

<?php
/*-----------------------------------------------------------------------------------*/
/* Page - White Borders
/*-----------------------------------------------------------------------------------*/
?>

	<?php if( $white_borders == true ) : ?>
		body.admin-bar.page-white-borders .sh-window-line.line-top,
		body.admin-bar.page-white-borders .sh-window-line.line-left,
		body.admin-bar.page-white-borders .sh-window-line.line-right {
			top: 32px;
		}

		body.page-white-borders #page-container {
			padding-top: 20px;
		}

		body.admin-bar.page-white-borders #page-container {
			padding-top: 52px!important;
		}

		body.page-white-borders.page-layout-right-fixed .sh-window-line.line-top {
			top: 0!important;
		}

		body.page-white-borders .sh-sticky-header-active {
			top: 20px!important;
			left: 20px!important;
			right: 20px!important;
			width: auto!important;
		}

		body.admin-bar.page-white-borders .sh-sticky-header-active {
			top: 52px!important;
		}
	<?php endif; ?>




<?php
/*-----------------------------------------------------------------------------------*/
/* Border Radius
/*-----------------------------------------------------------------------------------*/
?>

<?php if( $border_radius_images && $border_radius_images == 'disabled' ) : ?>
	.post-thumbnail,
	.post-thumbnail img,
	.post-thumbnail .sh-ratio-content,
	.post-switch-item,
	.post-switch-item:after,
	.sh-widget-instagram-item img,
	.sh-widget-instagram-item-overlay,
	.sh-read-later-thumbnail,
	.sh-read-later-thumbnail:after,
	.sh-overlay-style1,
	.post-gallery-list,
	.post-gallery-list .slick-list,
	.sh-widget-posts-slider-thumbnail,
	.post-content img,
	.widget_about_us img,
	.sh-post-author .sh-post-author-avatar img,
	.null-instagram-feed .instagram-pics li a,
	.post-style-cover .sh-ratio-content,
	.post-style-cover .post-cover-link,
	.post-style-cover .post-container:after,
	.post-overlay-small,
	.sh-categories.sh-categories-style2.sh-categories-round .blog-mini-post-large .blog-mini-post-thumb,
	.post-overlay,
	.blog-style-left-small .post-thumbnail,
	.sh-widget-facebook-overlay,
	.sh-widget-facebook-item,
	.sh-widget-posts-slider-thumbnail,
	.sh-widget-posts-slider-group-style2,
	.sh-widget-posts-slider-group-style2 .slick-list.draggable,
	.blog-mini-post-thumb,
	.blog-slider .blog-slider-item {
		border-radius: 0px;
	}
<?php endif; ?>




<?php
/*-----------------------------------------------------------------------------------*/
/* Global
/*-----------------------------------------------------------------------------------*/
?>

<?php if( $global_title_transform && $global_title_transform != 'none' ) : ?>
	.sh-widget-title-styling h3,
	.post-related-title h2,
	.sh-categories-title h2,
	.sh-blog-fancy-title-container h2 {
		text-transform: <?php echo esc_attr( $global_title_transform ); ?>
	}
<?php endif; ?>

<?php if( $global_tabs_transform && $global_tabs_transform != 'default' ) : ?>
	.sh-title-style2 .sh-tabs-stying a,
	.sh-title-style2 ul.sh-tabs-stying.nav-tabs li a h4 {
		text-transform: <?php echo esc_attr( $global_tabs_transform ); ?>
	}
<?php endif; ?>

<?php if( $global_title_weight && $global_title_weight != 'default' ) : ?>
	.sh-widget-title-styling h3,
	.post-related-title h2,
	.sh-categories-title h2,
	.sh-blog-fancy-title-container h2 {
		font-weight: <?php echo intval( $global_title_weight ); ?>
	}
<?php endif; ?>

<?php if( $global_title_font_size ) : ?>
	.post-related-title h2,
	.sh-categories-title h2,
	.sh-blog-fancy-title-container h2 {
		font-size: <?php echo esc_attr( gillion_addpx( $global_title_font_size ) ); ?>!important;
	}
<?php endif; ?>



<?php else : ?>

	.post-meta,
	.post-categories,
	.post-switch-item-right,
	.sh-read-later-review-score,
	.sh-header .sh-nav li.menu-item a,
	.sh-comment-date a,
	.post-button .post-button-text,
	.widget_categories li,
	.sh-dropcaps,
	.sh-dropcaps-full-square,
	.sh-dropcaps-full-square-border,
	.sh-dropcaps-full-square-tale,
	.sh-dropcaps-square-border,
	.sh-dropcaps-square-border2,
	.sh-dropcaps-circle,
	.comment-body .reply,
	.sh-comment-form label,
	blockquote,
	blockquote:after,
	.sh-heading-font,
	.post-review-score,
	.sh-comment-author a,
	.sh-header-top .sh-nav li.menu-item a {
		font-family: Montserrat;
	}

	.post-title h2:hover {
		color: #d79c74;
	}

	.primary-desktop .sh-header-top {
		background-color: #313131;
	}

	.blog-single .post-title h2:hover,
	.post-password-form label,
	.sh-page-links p {
		color: #3f3f3f!important;
	}

	.sh-default-color a,
	.sh-default-color,
	#sidebar a,
	.logged-in-as a ,
	.sh-social-share-networks .jssocials-share i {
		color: #8d8d8d!important;
	}

	.sh-sidebar-search-active .search-field,
	.post-password-form input[type="submit"] {
		background-color: #d79c74;
	}

	.post-password-form input[type="submit"]:hover {
		background-color: #21bee2;
	}

	.sh-sidebar-search-active .search-field,
	.sh-sidebar-search-active .search-submit i {
		color: #fff;
	}

	.sh-sidebar-search-active .search-field {
		border-color: #d79c74!important;
	}

	.sh-back-to-top {
		border-radius: 100px;
	}

	/* Elements CSS */

<?php endif;
ob_end_flush();
?>
