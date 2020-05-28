<?php
/**
 * Single Post
 */
if( defined('FW') ) :
	if( gillion_option( 'post_view_count', 'default' ) == 'default' ) :
		gillion_add_post_views( get_the_ID() );
	endif;

	$elements = gillion_option( 'post_elements' );

	if( gillion_post_option( get_the_ID(), 'post_layout' ) == 'default' ) {
		$post_layout = gillion_option( 'post_layout' );
	} else {
		$post_layout = gillion_post_option( get_the_ID(), 'post_layout' );
	}

	if( $post_layout == 'sidebar-left' || $post_layout == 'sidebar-right' ) :
		$layout_sidebar = esc_attr( $post_layout );
	endif;
else :
	$post_layout = '';
	$layout_sidebar = 'sidebar-right';
endif;


$class = array();
$post_share = 0;
if( !defined('FW') ) :
	$post_share = 1;
elseif( isset($elements['share']) && $elements['share'] == true ) :
	$social_share_items = gillion_option( 'social_share' );
	if( is_array( $social_share_items ) && count( $social_share_items ) ) :
		$post_share = 1;
	endif;
endif;

if( $post_share ) :
	$class[] = ' blog-style-single-share';
endif;


$blockquote_style = gillion_post_option( get_the_ID(), 'blockquote_style', 'default' );
if( $blockquote_style != 'default' ) :
	$class[] = ' blog-blockquote-'.$blockquote_style;
else :
	$class[] = ' blog-blockquote-'.gillion_option( 'blockquote_style', 'style1' );
endif;

$post_style = gillion_post_option( get_the_ID(), 'post_style' );
if ( 'default' == $post_style ) {
	$post_style = gillion_option( 'post_style', 'standard' );
}

$class[] = ' blog-style-post-'.esc_attr( $post_style );
get_header();


// Get if post template is selected
$page_template_id = '';
$page_template = gillion_option( 'post_template', 'default' );
if( $page_template && $page_template != 'default' && get_post_status( $page_template ) ) :
	$page_template_id = $page_template;
endif;
?>

<?php if( $page_template_id > 0 ) :

	/* Page Template Output */
	if( class_exists( 'Vc_Manager' ) ) :
		ob_start();

		Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $page_template_id );
		$page_template_css = ob_get_contents();
		ob_end_clean();

		if( $page_template_css ) :
			echo $page_template_css;
		else :
			$page_template_custom_css = get_post_meta( $page_template_id, '_wpb_shortcodes_custom_css', true );
			if( !empty( $page_template_custom_css ) ) :
				echo '<style type="text/css">';
				echo $page_template_custom_css;
				echo '</style>';
			endif;
		endif;

		$the_post = get_post( $page_template_id );
		echo do_shortcode(  apply_filters( 'the_content', $the_post->post_content ) );
	endif;

else : ?>

	<div id="content-wrapper"<?php echo ( isset($layout_sidebar) && $layout_sidebar ) ? ' class="content-wrapper-with-sidebar"': ''; ?>>
		<div id="content" class="content-layout-<?php echo esc_attr( $post_layout ); ?> <?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?>">
			<div class="blog-single blog-style-single<?php echo implode( " ", $class ); ?>">
				<?php
					if ( have_posts() ) :
						set_query_var( 'style', 'single' );
						while ( have_posts() ) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('post-item post-item-single'); ?>>

								<meta content="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" itemprop="image"/>

								<?php if( $post_style != 'slider' && $post_style != 'toptitle' ) : ?>
									<div class="post-type-content">
										<?php get_template_part( 'content', 'format-'.get_post_format() ); ?>
									</div>
								<?php endif; ?>

								<?php if( gillion_post_option( get_the_ID(), 'post-copyrights' ) ) : ?>
									<div class="post-copyrights">
										<?php echo ( gillion_post_option( get_the_ID(), 'post-copyrights' ) ); ?>
									</div>
								<?php endif; ?>

								<div class="post-item-single-container">
									<?php /* Show social share */ ?>
									<?php if( $post_share ) : ?>
										<div class="post-content-share post-content-share-bar"></div>
									<?php endif; ?>

									<?php if( $post_style != 'slider' ) : ?>
										<div class="post-single-meta">
											<?php gillion_post_categories(); ?>

											<?php if( get_the_title() ) : ?>
												<a class="post-title">
													<h1>
														<?php gillion_sticky_post(); ?>
														<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
													</h1>
												</a>
											<?php endif; ?>

											<div class="post-meta">
												<?php gillion_post_meta( 10 ); ?>
											</div>
										</div>
									<?php endif; ?>


									<?php if( $post_style == 'toptitle' ) : ?>
										<div class="post-type-content">
											<?php get_template_part( 'content', 'format-'.get_post_format() ); ?>
										</div>
									<?php endif; ?>


									<div class="post-content post-single-content">
										<?php /* Review */
										$score = gillion_post_review_score( get_the_ID() );
										$review_layout = gillion_post_option( get_the_ID(), 'review_layout' );
										if( $score && $review_layout != 'hidden' && $review_layout != 'full bottom' ) :
											gillion_post_single_review( get_the_ID(), $score, $review_layout );
										endif;
										?>

										<?php the_content(); ?>

										<?php if( $score && $review_layout == 'full bottom' ) :
										gillion_post_single_review( get_the_ID(), $score, $review_layout );
										endif; ?>
									</div>


									<?php /* Show page links navigation */ ?>
									<?php gillion_page_links(); ?>


									<div class="post-tags-container">
										<?php /* Show Via */?>
										<?php
										$via = gillion_post_option( get_the_ID(), 'via' );
										if( is_array( $via ) && count( $via ) ) :?>
											<div class="post-tags post-tags-source">
												<a class="post-tags-item post-tags-item-title">
													<?php esc_attr_e( 'Via', 'gillion' ); ?>
												</a>
												<?php foreach( $via as $item ) : ?>
													<a href="<?php echo esc_url( $item['url'] ); ?>" class="post-tags-item">
														<?php echo esc_attr( $item['name'] ); ?>
													</a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>


										<?php /* Show Source */?>
										<?php
										$source = gillion_post_option( get_the_ID(), 'source' );
										if( is_array( $source ) && count( $source ) ) :?>
											<div class="post-tags post-tags-source">
												<a class="post-tags-item post-tags-item-title">
													<?php esc_attr_e( 'Source', 'gillion' ); ?>
												</a>
												<?php foreach( $source as $item ) : ?>
													<a href="<?php echo esc_url( $item['url'] ); ?>" class="post-tags-item">
														<?php echo esc_attr( $item['name'] ); ?>
													</a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>


										<?php /* Show Tags */ ?>
										<?php if( count( wp_get_post_tags( get_the_ID() ) ) > 0 ) : ?>
											<div class="post-tags">
												<a class="post-tags-item post-tags-item-title">
													<?php esc_attr_e( 'Tags', 'gillion' ); ?>
												</a>
												<?php foreach( get_the_tags( get_the_ID() ) as $tag ) :
													$term_link = get_tag_link( $tag->term_id );
												?>
													<a href="<?php echo esc_url( $term_link ); ?>" class="post-tags-item">
														#<?php echo esc_attr( $tag->name ); ?>
													</a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>

										<?php /* Clear unclosed floats */ ?>
										<div class="sh-clear"></div>
									</div>

									<?php if( $post_share ) : ?>
										<div class="post-content-share-mobile-contaner">
											<div class="post-content-share post-content-share-bar post-content-share-mobile"></div>
										</div>
									<?php endif; ?>

								</div>

									<?php if( gillion_option( 'post_view_count') == 'ajax' ) : ?>
									<script type="text/javascript">
										jQuery(function($) {
											$.ajax({
												type: 'POST',
												url: "/wp-admin/admin-ajax.php",
												data : {
													action : 'post_views_count',
													post_id : <?php echo esc_js( get_the_ID() ); ?>
												},
												success: function( response ) {
													$('.sh-page-views').html( response );
												}
											});
										});
									</script>
									<?php endif; ?>




									<?php /* Show next / previous post links */ ?>
									<?php if( !defined('FW') || ( isset($elements['prev_next']) && $elements['prev_next'] == true ) ) :
											$prev_post = get_next_post();
											$next_post = get_previous_post();
											$prev_class = '';
											$next_class = '';

											if( !isset( $prev_post->ID) ) {
												$prev_post = get_post( get_the_ID() );
												$prev_class = 'post-switch-item-disabled';
											}

											if( !isset( $next_post->ID) ) {
												$next_post = get_post( get_the_ID() );
												$next_class = 'post-switch-item-disabled';
											}
										?>

		<?php $post_swtich_style = gillion_option( 'post_switcher_style', 'style1' ); ?>
		<div class="post-switch post-swtich-<?php echo esc_attr( $post_swtich_style ); ?>">
			<div class="row">
				<div class="col-md-6">
					<?php if( isset( $prev_post->ID) ) : ?>
						<?php if( $post_swtich_style == 'style2' ) : ?>

							<?php echo ( $prev_class != 'post-switch-item-disabled' ) ? '<a href="'.esc_url( get_permalink( $prev_post->ID ) ).'" class="post-switch-prev text-left">': '<span class="post-switch-next text-left">'; ?>
								<div class="post-switch-type"><?php esc_attr_e( 'Previous', 'gillion' ); ?></div>
								<h4>
									<?php if( isset($prev_post->ID) && get_permalink($prev_post->ID) ) : ?>
										<?php echo wp_kses_post( $prev_post->post_title ); ?>
									<?php endif; ?>
								</h4>
							<?php echo ( $prev_class != 'post-switch-item-disabled' ) ? '</a>': '</span>'; ?>

						<?php else :?>

							<div class="post-switch-item <?php echo esc_attr( $prev_class ); ?>" style="background-image: url(<?php echo esc_url( gillion_thumbnail_url( $prev_post->ID ) ); ?>);">
								<div class="post-switch-item-content">
									<?php if( $prev_class != 'post-switch-item-disabled' ) : ?>
										<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="post-switch-item-left">
											<i class="icon icon-arrow-left-circle"></i>
										</a>
									<?php else : ?>
										<span class="post-switch-item-left">
											<i class="icon icon-arrow-left-circle"></i>
										</span>
									<?php endif; ?>

									<div class="post-switch-item-right">
										<?php echo gillion_post_categories( $prev_post->ID, 5 ); ?>
										<p>
											<?php if( $prev_class != 'post-switch-item-disabled' ) : ?>
												<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
													<?php if( isset($prev_post->ID) && get_permalink($prev_post->ID) ) : ?>
														<?php echo wp_kses_post( $prev_post->post_title ); ?>
													<?php endif; ?>
												</a>
											<?php else : ?>
												<span>
													<?php if( isset($prev_post->ID) && get_permalink($prev_post->ID) ) : ?>
														<?php echo wp_kses_post( $prev_post->post_title ); ?>
													<?php endif; ?>
												</span>
											<?php endif; ?>
										</p>
									</div>
								</div>
							</div>

						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="col-md-6">
					<?php if( isset( $next_post->ID) ) : ?>
						<?php if( $post_swtich_style == 'style2' ) : ?>

							<?php echo ( $next_class != 'post-switch-item-disabled' ) ? '<a href="'.esc_url( get_permalink( $next_post->ID ) ).'" class="post-switch-next text-right">': '<span class="post-switch-next text-right">'; ?>
								<div class="post-switch-type"><?php esc_attr_e( 'Next', 'gillion' ); ?></div>
								<h4>
									<?php if( isset($next_post->ID) && get_permalink($next_post->ID) ) : ?>
										<?php echo wp_kses_post( $next_post->post_title ); ?>
									<?php endif; ?>
								</h4>
							<?php echo ( $next_class != 'post-switch-item-disabled' ) ? '</a>': '</span>'; ?>

						<?php else :?>

							<div class="post-switch-next post-switch-item <?php echo esc_attr( $next_class ); ?>" style="background-image: url(<?php echo esc_url( gillion_thumbnail_url( $next_post->ID ) ); ?>);">
								<div class="post-switch-item-content">

									<div class="post-switch-item-right">
										<?php echo gillion_post_categories( $next_post->ID, 5 ); ?>
										<p>
											<?php if( $next_class != 'post-switch-item-disabled' ) : ?>
												<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
													<?php if( isset($next_post->ID) && get_permalink($next_post->ID) ) : ?>
														<?php echo wp_kses_post( $next_post->post_title ); ?>
													<?php endif; ?>
												</a>
											<?php else : ?>
												<span>
													<?php if( isset($next_post->ID) && get_permalink($next_post->ID) ) : ?>
														<?php echo wp_kses_post( $next_post->post_title ); ?>
													<?php endif; ?>
												</span>
											<?php endif; ?>
										</p>
									</div>

									<?php if( $next_class != 'post-switch-item-disabled' ) : ?>
										<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="post-switch-item-left">
											<i class="icon icon-arrow-right-circle"></i>
										</a>
									<?php else : ?>
										<span class="post-switch-item-left">
											<i class="icon icon-arrow-right-circle"></i>
										</span>
									<?php endif; ?>

								</div>
							</div>

						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

									<?php endif; ?>





									<?php /* Show information about author */ ?>
									<?php if( ( !defined('FW') || ( isset($elements['athor_box']) && $elements['athor_box'] == true ) ) ) :
											$author_id = get_the_author_meta( 'ID' );
										?>
										<div class="sh-post-author sh-table">
											<div class="sh-post-author-avatar sh-table-cell-top">
												<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
						                            <?php echo get_avatar( $author_id, '185' ); ?>
						                        </a>
											</div>
											<div class="sh-post-author-info sh-table-cell-top">
												<div>
													<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><h4><?php the_author(); ?></h4></a>
													<div><?php the_author_meta( 'description' ); ?></div>
													<div class="sh-post-author-icons">
														<?php
															$userinfo = get_userdata( $author_id );
															if( $userinfo->user_url ) :
																echo '<a href="'.esc_url( $userinfo->user_url ).'" target="_blank"><i class="fa fa-globe"></i></a>';
															endif;

															$usermeta = get_user_meta( $author_id );
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


									<?php if( gillion_option( 'single_related_posts', 'on' ) == 'on' ) :
									$position = gillion_option( 'global_carousel_buttons_position', 'title' ); ?>
									<div class="post-related-title post-slide-arrows-container">
										<h2 class="post-single-title">
											<?php esc_html_e( 'Related posts', 'gillion' ); ?>
										</h2>
										<?php if( $position == 'title' ) : ?>
											<div class="post-slide-arrows sh-carousel-buttons-styling"></div>
										<?php endif; ?>
									</div>
									<div class="post-related">
										<?php
										$categories = array();
										foreach( get_the_category( get_the_ID() ) as $category ) :
											$categories[] = $category->term_id;
										endforeach;

										$args = array(
											'post__not_in' => array( get_the_ID() ),
											'posts_per_page' => 6,
											'ignore_sticky_posts' => 1,
											'tax_query' => array(
												'relation' => 'AND',
												array(
													'taxonomy' => 'category',
													'field'    => 'term_id',
													'terms'    => $categories,
													'operator' => 'IN',
												),
												array(
							                         'taxonomy' => 'post_format',
							                         'field' => 'slug',
							                         'terms' => array( 'post-format-quote', 'post-format-link' ),
							                         'operator' => 'NOT IN'
							                     )
											),
											'orderby' => 'rand'
										);
										$query = new WP_Query( $args );

										if( $query->post_count < 3 ) :
											$args = array(
												'post__not_in' => array( get_the_ID() ),
												'posts_per_page' => 6,
												'ignore_sticky_posts' => 1,
												'orderby' => 'rand'
											);
											$query = new WP_Query( $args );
										endif;

										if( $query->have_posts() ) :
											set_query_var( 'style', 'grid-simple' );
											while ($query->have_posts()) : $query->the_post();
												echo '<div class="post-related-item">';

													if( get_post_format() ) :
														get_template_part( 'content', 'format-'.get_post_format() );
													else :
														get_template_part( 'content' );
													endif;

												echo '</div>';
											endwhile; ?>
										<?php endif; wp_reset_postdata(); ?>
									</div>
									<?php endif; ?>

									<?php if( isset( $position ) && $position == 'bottom' ) : ?>
										<div class="post-related-arrows">
											<div class="post-slide-arrows sh-carousel-buttons-styling"></div>
										</div>
									<?php endif; ?>

							</article>
						<?php endwhile;

						/* Show comments */
						if( !defined('FW') || ( isset($elements['comments']) && $elements['comments'] == true ) ) :
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							if ( is_singular() ) :
								wp_enqueue_script( 'comment-reply' );
							endif;
						endif;

						else :
							get_template_part( 'content', 'none' );
						endif;
					?>

				</div>
			</div>
			<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>
				<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div>

	<?php endif; ?>
<?php get_footer(); ?>
