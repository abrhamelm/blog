<?php
/* Template Name: Blog */
get_header(); wp_reset_postdata();
$content = get_the_content();

if( gillion_page_layout() == 'sidebar-right' || gillion_page_layout() == 'sidebar-left' ) :
	$layout_sidebar = esc_attr( gillion_page_layout() );
endif;

$pagination_type = gillion_post_option( get_the_ID(), 'page_blog_pagination_type', 'default' );
$categories_query = array();
if( count(gillion_post_option( get_the_ID(), 'page_blog_category' )) > 0 ) :
	$categories_query = gillion_post_option( get_the_ID(), 'page_blog_category' );
endif;

$page = (get_query_var('page')) ? get_query_var('page') : 1;
$page = (get_query_var('paged')) ? get_query_var('paged') : $page;

$featured = ( gillion_post_option( get_the_ID(), 'page_blog_featured', false ) == true ) ? 1 : 0;
$post_per_page = ( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ) : 12;
$post_per_page = ( gillion_option( 'blog-items' ) > 0 ) ? intval( gillion_option( 'blog-items' ) ) : $post_per_page;
$post_per_page = ( gillion_post_option( get_the_ID(), 'page_blog_posts_per_page' ) != 'default' ) ? intval( gillion_post_option( get_the_ID(), 'page_blog_posts_per_page' )) : $post_per_page;

$class = array();
$class[] = 'sh-group';
$class[] = 'blog-list';
$class[] = 'blog-style-'.gillion_post_option( get_the_ID(), 'page-blog-style', 'large' );
$class[] = 'blog-dividing-line-'.gillion_post_option( get_the_ID(), 'page_blog_dividing_line', 'on' );

if( $featured ) :
	set_query_var( 'featured', 1 );
	$post_per_page++;
endif;

$post_id = 0;
$i = 0;

/* Posts Order */
$order = 'DESC';
$orderby = 'date';
$order_option = gillion_post_option( get_the_ID(), 'page_blog_order', 'DESC' );
if( $order_option == 'rand') :
	$orderby = 'rand';
elseif( $order_option ) :
	$order = $order_option;
	$orderby = 'date';
endif;

/* Posts Offset */
$offset_option = gillion_post_option( get_the_ID(), 'page_blog_offset', '0' );

/* Load posts */
if( $offset_option > 0 ) :
	$offset_option = intval( $offset_option ) + ( ( intval( $page ) - 1 ) * intval( $post_per_page ) );
	$blog_posts = new WP_Query( array(
		'post_type' => 'post',
		'paged' => $page,
		'category__in' => $categories_query,
		'posts_per_page' => $post_per_page,
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset_option,
	));
else :
	$blog_posts = new WP_Query( array(
		'post_type' => 'post',
		'paged' => $page,
		'category__in' => $categories_query,
		'posts_per_page' => $post_per_page,
		'order' => $order,
		'orderby' => $orderby,
	));
endif;

$class2 = array();
$class2[] = 'blog-page-list';
if( isset($layout_sidebar) && $layout_sidebar ) :
	$class2[] = 'content-with-'.esc_attr( $layout_sidebar );
endif;


$pageination = gillion_post_option( get_the_ID(), 'page_blog_pagination_alignment', 'left' );
if( $pageination == 'left' ) :
	$class2[] = 'sh-pagination-left';
elseif( $pageination == 'center' ) :
	$class2[] = 'sh-pagination-center';
elseif( $pageination == 'right' ) :
	$class2[] = 'sh-pagination-right';
endif;


$page_blog_description = gillion_post_option( get_the_ID(), 'page_blog_description', 'default' );
if( $page_blog_description == 'off' ) :
	$class2[] = 'sh-posts-description-off';
endif;
?>

	<div id="content-wrapper"<?php echo ( isset($layout_sidebar) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
		<?php if( get_page_template_slug() != 'page-blog.php' ) : ?>
			<?php echo ( do_shortcode( $content ) ); ?>
		<?php else : ?>
			<div id="content" class="<?php echo esc_attr( implode( " ", $class2 ) ); ?>">

				<?php /* Custom Title */ ?>
				<?php if( gillion_post_option( get_the_ID(), 'page_blog_title' ) )  : ?>
					<div class="post-related-title" style="margin-top: 0px; margin-bottom: 35px;">
						<h2 class="post-single-title">
							<?php echo esc_attr( gillion_post_option( get_the_ID(), 'page_blog_title' ) ); ?>
						</h2>
					</div>
				<?php endif; ?>

				<?php /* Featured */
				if( $blog_posts->have_posts() && $featured ) :
					$featured_style = gillion_post_option( get_the_ID(), 'page_blog_featured_style', 'large' );
				?>
					<div class="blog-list-featured blog-style-<?php echo esc_attr( $featured_style ); ?>">
						<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); $i++; ?>

							<?php
								if( $i == 1 ) :
									set_query_var( 'style', $featured_style );
									if( get_post_format() ) :
										get_template_part( 'content', 'format-'.get_post_format() );
									else :
										get_template_part( 'content' );
									endif;
									$post_id = get_the_ID();
								endif;
							?>

						<?php endwhile; ?>
					</div>
				<?php endif; ?>


				<?php /* Standard Posts */ ?>
				<div class="<?php echo esc_attr( implode( " ", $class ) ); ?>">
					<?php
						if( $blog_posts->have_posts() ) :
							$i = 0;
							set_query_var( 'style', gillion_post_option( get_queried_object_id(), 'page-blog-style' ) );

							while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); $i++;

								if( ( $featured && $i != 1 ) || !$featured ) :
									if( get_post_format() ) :
										get_template_part( 'content', 'format-'.get_post_format() );
									else :
										get_template_part( 'content' );
									endif;
								endif;

							endwhile;

						else :

							get_template_part( 'content', 'none' );

						endif;
					?>
				</div>

				<?php if( $pagination_type == 'default' ) :
					gillion_pagination( $blog_posts );
				elseif( ( $pagination_type == 'button' || $pagination_type == 'infinite' ) &&
				isset( $blog_posts->found_posts ) && $blog_posts->found_posts > $post_per_page ) : ?>

					<div class="sh-load-more<?php echo ( $pagination_type == 'infinite' ) ? ' infinite' : ''; ?>"
					data-categories="<?php echo implode( ',', $categories_query ); ?>"
					data-post-style="<?php echo gillion_post_option( get_queried_object_id(), 'page-blog-style' ); ?>"
					data-posts-per-page="<?php echo esc_attr( $post_per_page ); ?>"
					data-offset="<?php echo esc_attr( $offset_option ); ?>"
					data-paged="2"
					data-id="blog-page-list">
						<?php
							if( $pagination_type == 'button' ) :
								esc_html_e( 'Load more', 'gillion' );
							else :
								esc_html_e( 'Loading', 'gillion' );
							endif;
						?>
					</div>

				<?php endif; ?>

			</div>
			<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>
				<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>


<?php get_footer(); ?>
