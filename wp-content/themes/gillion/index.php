<?php
$style = gillion_option( 'categories-blog-style', 'masonry' );
$categories_page_layout = gillion_option( 'categories-page-layout', 'sidebar-right' );
if( is_archive() && $categories_page_layout == 'sidebar-right' || $categories_page_layout == 'sidebar-left' ) :
	$layout_sidebar = esc_attr( $categories_page_layout );
elseif( $categories_page_layout == 'default' ) :
	$layout_sidebar = '';
else :
	$layout_sidebar = 'sidebar-right';
endif;

set_query_var( 'style', $style );
get_header();
?>

	<div id="content-wrapper"<?php echo ( isset($layout_sidebar) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
		<div id="content" class="<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?>">
			<div class="sh-group blog-list blog-style-<?php echo esc_attr( $style ); ?>">

				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();

							if( get_post_format() ) :
								get_template_part( 'content', 'format-'.get_post_format() );
							else :
								get_template_part( 'content' );
							endif;

						endwhile;
					else :

						get_template_part( 'content', 'none' );

					endif;
				?>

			</div>
			<?php gillion_pagination(); ?>

		</div>
		<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>
			<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
