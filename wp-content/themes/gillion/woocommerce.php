<?php
/**
 * WooCommerce
 */

if( gillion_page_layout() == 'sidebar-right' || gillion_page_layout() == 'sidebar-left' ) :
    $layout_sidebar = esc_attr( gillion_page_layout() );
endif;

$style = ( is_archive() ) ? gillion_option( 'categories-blog-style', 'masonry' ) : 'masonry';
set_query_var( 'style', $style );
get_header();
?>

    <div id="content-wrapper"<?php echo ( isset($layout_sidebar) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
    	<div id="content" class="<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?>">
    		<?php woocommerce_content(); ?>
    	</div>
    	<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>
    		<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>">
    			<?php get_sidebar(); ?>
    		</div>
    	<?php endif; ?>
    </div>

<?php get_footer(); ?>
