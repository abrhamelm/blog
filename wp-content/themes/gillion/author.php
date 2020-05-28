<?php
/**
 * Author Page
 */
$categories_page_layout = gillion_option( 'author-page-layout', 'sidebar-right' );
if( is_archive() && $categories_page_layout == 'sidebar-right' || $categories_page_layout == 'sidebar-left' ) :
	$layout_sidebar = esc_attr( $categories_page_layout );
elseif( $categories_page_layout == 'default' ) :
	$layout_sidebar = '';
else :
	$layout_sidebar = 'sidebar-right';
endif;


$elements = gillion_option( 'post_elements' );
set_query_var( 'style', 'masonry' );
get_header();
?>

<div id="content-wrapper"<?php echo ( isset( $layout_sidebar ) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
	<div id="content" class="<?php if( isset( $layout_sidebar ) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?>">

		<?php if( ( !defined('FW') || ( isset($elements['athor_box']) && $elements['athor_box'] == true ) ) && get_the_author_meta( 'description' ) ) : ?>
			<div class="sh-post-author sh-table">
				<div class="sh-post-author-avatar sh-table-cell-top">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), '185' ); ?>
				</div>
				<div class="sh-post-author-info sh-table-cell-top">
					<div>
						<h1><?php the_author(); ?></h1>
						<div><?php the_author_meta( 'description' ); ?></div>
						<div class="sh-post-author-icons">
							<?php
								$userinfo = get_userdata( get_the_author_meta( 'ID' ) );
								if( $userinfo->user_url ) :
									echo '<a href="'.esc_url( $userinfo->user_url ).'" target="_blank"><i class="fa fa-globe"></i></a>';
								endif;

								$usermeta = get_user_meta( get_the_author_meta( 'ID' ) );
								$meta_fields = array( 'public_email', 'facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'tumblr', 'youtube' );
								foreach( $meta_fields as $meta) :

									$this_meta = ( isset( $usermeta[$meta][0] ) && $usermeta[$meta][0] ) ? $usermeta[$meta][0] : '';
									if( $meta == 'public_email' && $this_meta ) :
										$meta = 'envelope';
										$this_meta = 'mailto:'.$this_meta;
									endif;

									if( $this_meta ) :
										echo '<a href="'.esc_url( $this_meta ).'" target="_blank"><i class="fa fa-'.esc_attr( $meta ).'"></i></a>';
									endif;

								endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="sh-group blog-list blog-style-masonry masonry-shadow">

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
	<?php if( isset( $layout_sidebar ) && $layout_sidebar ) : ?>
		<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
