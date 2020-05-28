<?php
/**
 * Titlebar HTML
 */
$titlebar1 = esc_attr( gillion_post_option( gillion_page_id(), 'titlebar', 'on' ) );
$titlebar2 = esc_attr( gillion_option( 'titlebar', 'on' ) );
$show_titlebar = ( gillion_page_id() && isset($titlebar1) && $titlebar1 && $titlebar1 != 'default' ) ? $titlebar1 : ( ( isset($titlebar2) && $titlebar2 ) ? $titlebar2 : 'off' );
$breadcrumbs = gillion_option( 'titlebar_breadcrumbs', 'on' );

if( $show_titlebar == 'on' ) :

	$titlebar_layout = esc_attr( gillion_option( 'titlebar_layout', 'side' ) );
	$titlebar_background = gillion_get_image( gillion_post_option( gillion_page_id(), 'titlebar_background' ) );

	$titlebar_background_parallax_main = esc_attr( gillion_option( 'titlebar_background_parallax' ) );
	$titlebar_background_parallax_page = esc_attr( gillion_post_option( gillion_page_id(), 'titlebar_background_parallax' ) );
	$titlebar_background_parallax = ( $titlebar_background_parallax_page && ($titlebar_background_parallax_page == 'off' || $titlebar_background_parallax_page == 'on') ) ? $titlebar_background_parallax_page : $titlebar_background_parallax_main;

	$default_home = esc_html__( 'Home', 'gillion' );
	$default_blog = esc_html__( 'Blog', 'gillion' );
	$default_404 = esc_html__( '404', 'gillion' );
	$default_readlater = esc_html__( 'Your read it later bookmarks', 'gillion' );

	$titlebar_style_val = gillion_post_option( gillion_page_id(), 'header_style' );
	$titlebar_style_val2 = ( isset( $titlebar_style_val['header_style'] ) ) ? esc_attr($titlebar_style_val['header_style']) : 'default';
	$titlebar_style_atts = gillion_get_picker( $titlebar_style_val );
	$titlebar_style = ( $titlebar_style_val2 == 'light' || $titlebar_style_val2 == 'light_mobile_off' ) ? ' sh-titlebar-light' : '';
	$titlebar_style = ( $titlebar_style_val2 == 'dark' || $titlebar_style_val2 == 'dark_mobile_off' ) ? ' sh-titlebar-dark' : $titlebar_style;

	if( $titlebar_background && $titlebar_background_parallax == 'on' ) :
		$titlebar_style.= ' sh-titlebar-parallax';
	endif;

	$heading = ( is_archive() || is_search() || is_404() ) ? 'h1' : 'h2';
	?>

	<?php if( in_array( $titlebar_style_val2, array( 'light', 'light_mobile_off', 'dark', 'dark_mobile_off' ) ) ) : ?>

		<div class="sh-titlebar sh-titlebar-center<?php echo esc_attr( $titlebar_style ); ?>">
			<div class="container">
				<div class="sh-table sh-titlebar-height-<?php echo esc_attr( gillion_option( 'titlebar_height', 'medium' ) ); ?>">
					<div class="sh-table-cell">
						<div class="titlebar-title">

							<<?php echo esc_attr($heading); ?> class="titlebar-title-h1">
								<?php
									wp_reset_postdata();
									if( is_home() && isset( $_GET['read-it-later'] ) ) :
										echo esc_attr( gillion_option( 'titlebar-readlater-title', $default_readlater ) );
									elseif( ( is_front_page() && is_home() ) || is_front_page() ) :
										echo esc_attr( gillion_option( 'titlebar-home-title', $default_home ) );
									elseif( is_home() ) :
										echo get_the_title( gillion_page_id() );
									elseif( is_404() ) :
										echo esc_attr( gillion_option( 'titlebar-404-title', $default_404 ) );
									elseif( is_search() ) :
										printf(esc_html__('Search Results for "%s"', 'gillion'), get_search_query());
									elseif( is_archive() ) :
										echo get_the_archive_title();
									elseif( is_page() ) :
										echo get_the_title();
									elseif( is_author() ) :
										echo get_the_author();
									elseif( is_singular( 'post' ) || get_option('page_for_posts', true) ) :
										echo esc_attr( gillion_option( 'titlebar-post-title', $default_blog ) );
									else :
										echo get_the_title();
									endif;
								?>
							</<?php echo esc_attr($heading); ?>>

							<?php if( $titlebar_style_atts['description'] ) : ?>
								<div class="sh-titlebar-desc">
									<p><?php echo esc_attr( $titlebar_style_atts['description'] ); ?></p>
								</div>
							<?php endif; ?>

						</div>
						<?php if( $titlebar_style_atts['breadcrumbs'] == true && $breadcrumbs ) : ?>
							<div class="title-level">

								<?php echo gillion_breadcrumbs( array(
									'home_title' => esc_attr( gillion_option( 'titlebar-home-title', $default_home ) ),
								)); ?>

							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php if( $titlebar_style_atts['scroll_button'] == true ) : ?>
					<div class="sh-titlebar-icon">
						<i class="ti-mouse"></i>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<script type="text/javascript">
			if (document.documentElement.clientWidth > 1020) {
				var header_height = document.getElementsByClassName('primary-desktop')[0].clientHeight;
				document.getElementsByClassName("sh-titlebar")[0].style.paddingTop = header_height +'px';
			} else {
				var header_height = document.getElementsByClassName('primary-mobile')[0].clientHeight;
				document.getElementsByClassName("sh-titlebar")[0].style.paddingTop = header_height +'px';
			}
		</script>

	<?php elseif( $titlebar_layout != 'side' ) : ?>

		<div class="sh-titlebar sh-titlebar-center<?php echo esc_attr( $titlebar_style ); ?>">
			<div class="container">
				<div class="sh-table sh-titlebar-height-<?php echo esc_attr( gillion_option( 'titlebar_height', 'medium' ) ); ?>">
					<div class="sh-table-cell">
						<div class="titlebar-title">

							<<?php echo esc_attr($heading); ?>>
								<?php
									wp_reset_postdata();
									if( is_home() && isset( $_GET['read-it-later'] ) ) :
										echo esc_attr( gillion_option( 'titlebar-readlater-title', $default_readlater ) );
									elseif( ( is_front_page() && is_home() ) || is_front_page() ) :
										echo esc_attr( gillion_option( 'titlebar-home-title', $default_home ) );
									elseif( is_home() ) :
										echo get_the_title( gillion_page_id() );
									elseif( is_404() ) :
										echo esc_attr( gillion_option( 'titlebar-404-title', $default_404 ) );
									elseif( is_search() ) :
										printf(esc_html__('Search Results for "%s"', 'gillion'), get_search_query());
									elseif( is_archive() ) :
										echo get_the_archive_title();
									elseif( is_page() ) :
										echo get_the_title();
									elseif( is_author() ) :
										echo get_the_author();
									elseif( is_singular( 'post' ) || get_option('page_for_posts', true) ) :
										echo esc_attr( gillion_option( 'titlebar-post-title', $default_blog ) );
									else :
										echo get_the_title();
									endif;
								?>
							</<?php echo esc_attr($heading); ?>>

						</div>
						<?php if( $breadcrumbs == 'on' ) : ?>
							<div class="title-level">

								<?php echo gillion_breadcrumbs( array(
									'home_title' => esc_attr( gillion_option( 'titlebar-home-title', $default_home ) ),
								)); ?>

							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

	<?php else : ?>

		<div class="sh-titlebar<?php echo esc_attr( $titlebar_style ); ?>">
			<div class="container">
				<div class="sh-table sh-titlebar-height-<?php echo esc_attr( gillion_option( 'titlebar_height', 'medium' ) ); ?>">
					<div class="titlebar-title sh-table-cell">

						<<?php echo esc_attr($heading); ?>>
							<?php
								wp_reset_postdata();
								if( is_home() && isset( $_GET['read-it-later'] ) ) :
									echo esc_attr( gillion_option( 'titlebar-readlater-title', $default_readlater ) );
								elseif( ( is_front_page() && is_home() ) || is_front_page() ) :
									echo esc_attr( gillion_option( 'titlebar-home-title', $default_home ) );
								elseif( is_home() ) :
									echo get_the_title( gillion_page_id() );
								elseif( is_404() ) :
									echo esc_attr( gillion_option( 'titlebar-404-title', $default_404 ) );
								elseif( is_search() ) :
									printf(esc_html__('Search Results for "%s"', 'gillion'), get_search_query());
								elseif( is_archive() ) :
									echo get_the_archive_title();
								elseif( is_page() ) :
									echo get_the_title();
								elseif( is_author() ) :
									echo get_the_author();
								elseif( is_singular( 'post' ) || get_option('page_for_posts', true) ) :
									echo esc_attr( gillion_option( 'titlebar-post-title', $default_blog ) );
								else :
									echo get_the_title();
								endif;
							?>
						</<?php echo esc_attr($heading); ?>>

					</div>
					<?php if( $breadcrumbs == 'on' ) : ?>
						<div class="title-level sh-table-cell">

							<?php echo gillion_breadcrumbs( array(
								'home_title' => esc_attr( gillion_option( 'titlebar-home-title', $default_home ) ),
							)); ?>

						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php endif; ?>
<?php endif; ?>
