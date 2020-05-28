<?php
/**
 * Single Page
 */
wp_reset_postdata();
if( gillion_page_layout() == 'sidebar-right' || gillion_page_layout() == 'sidebar-left' ) :
	$layout_sidebar = esc_attr( gillion_page_layout() );
endif;

$class = '';
if( function_exists('fw_ext_page_builder_is_builder_post') && !fw_ext_page_builder_is_builder_post( get_queried_object_id() ) ) {
	$class = ' page-default-content';
}

wp_reset_postdata();
$is_vc = ( preg_match( '/vc_row/', get_the_content( gillion_page_id() ) ) ) ? true : false;
if( is_page() && !$is_vc ) :
	$class.= ' sh-text-content';
endif;

get_header(); ?>

	<div id="content-wrapper"<?php echo ( isset($layout_sidebar) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
		<div id="content" class="page-content <?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?><?php echo esc_attr( $class ); ?>">

			<div class="page-content">
				<?php if( function_exists('is_cart') && is_cart() ) : ?>
					<h3 class="woocommerce-cart-title">
						<?php esc_html_e( 'Cart Overview', 'gillion' ); ?>
					</h3>
				<?php endif; ?>

				<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
				?>

				<?php /* Clear unclosed floats */ ?>
				<div class="sh-clear"></div>
			</div>

			<?php
				wp_reset_postdata();
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				if ( is_singular() ) :
					wp_enqueue_script( 'comment-reply' );
				endif;
			?>

		</div>
		<?php if( isset( $layout_sidebar ) && $layout_sidebar ) : ?>
			<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
