<?php
$class = '';
if( gillion_page_layout() != 'full' && gillion_page_layout() != 'default default-nopadding' ) {
	$class = ' sh-page-layout-default';
} else if( gillion_page_layout() == 'full' ) {
	$class = ' sh-page-layout-full';
}
/**
 * Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if( gillion_option('responsive_layout') ) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	/* Include page loader HTML */
	wp_reset_postdata();
	get_template_part('inc/templates/page_loader' );
	get_template_part('inc/headers/header-side' );
?>

	<div id="page-container" class="<?php echo gillion_header_page_container(); ?>">
		<?php
			/* Include page notice HTML */
			get_template_part('inc/templates/notice' );

			/* Include header top content template */
			get_template_part('inc/headers/header-top-content' );
		?>

		<?php if( !in_array( get_post_type( get_the_ID() ), array( 'shufflehound_header', 'shufflehound_footer', 'shufflehound_temp' ) ) ) : ?>
			<?php if( gillion_post_option( gillion_page_id(), 'header', 'on' ) != 'off' ) : ?>
				<header class="primary-mobile<?php echo gillion_header_mobile_style(); ?>">
					<?php /* Include mobile header */
						get_template_part('inc/headers/header-mobile' );
					?>
				</header>
				<header class="primary-desktop<?php echo gillion_header_desktop_style(); ?>">
					<?php /* Include desktop header */
						get_template_part('inc/headers/header-topbar' );
						get_template_part('inc/headers/header-'.gillion_header_layout() );
					?>
				</header>
			<?php endif; ?>

			<?php
				/* Include breadcrumbs HTML */
				$post_style = gillion_post_option( get_the_ID(), 'post_style' );

				if ( 'default' == $post_style ) {
					$post_style = gillion_option( 'post_style', 'standard' );
				}

				if( is_single() && $post_style == 'slider' ) :
				else :
					get_template_part('inc/templates/titlebar' );
				endif;
			?>


			<?php
			/* Include WooCommerce Header */
			if( class_exists( 'woocommerce' ) ) :
				get_template_part('inc/templates/woocommerce_header' );
			endif;


			/* Include post slider */
			if( is_single() && $post_style == 'slider' ) :
				get_template_part('inc/templates/post_slider' );
			endif; ?>

		<?php endif; ?>

			<div id="wrapper" class="layout-<?php echo gillion_post_option( gillion_page_id(), 'page_layout', 'default' ); ?>">
				<?php
				$page = (get_query_var('page')) ? get_query_var('page') : 1;
				$page = (get_query_var('paged')) ? get_query_var('paged') : $page;
				if( is_page_template('page-blog.php') && $page == 1 && gillion_page_id() > 0 ) :
					$is_vc = ( preg_match( '/vc_row/', get_the_content( gillion_page_id() ) ) ) ? true : false;
					?>
					<div class="sh-pagebuilder-content">
						<?php if( $is_vc ) : ?>
							<div class="container">
						<?php endif; ?>

							<?php
								while ( have_posts() ) : the_post();
									the_content();
								endwhile;
								set_query_var( 'style', 'masonry' );
							?>
							<div style="clear:both;"></div>

						<?php if( $is_vc ) : ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="content-container<?php echo esc_attr( $class ); ?>">
				<?php if( gillion_post_option( gillion_page_id(), 'page_layout', 'default' ) != 'full' ) : ?>
					<div class="container entry-content">
				<?php endif; ?>

				<?php
					/* Include white borders option HTML */
					get_template_part('inc/templates/white_borders' );
				?>
