<?php
	/* HEADER 3 */

	if ( ! function_exists( 'gillion_nav_wrap' ) ) :
		function gillion_nav_wrap() {
		    $wrap  = '<ul id="%1$s" class="%2$s">%3$s';
		    $wrap .= '</ul>';

		    return $wrap;
		}
	endif;

	$banner = false;
	$banner_url = false;
	$banner_code = gillion_option( 'header_banner_code' );

	if ( ! $banner_code ) {
		$banner = gillion_option_image( 'header_banner' );
		$banner_url = gillion_option( 'header_banner_url' );
	}
?>

<?php /* Header */ ?>
<div class="sh-header-height sh-header-3">
	<div class="sh-header-middle">
		<div class="container sh-header-additional">
			<div class="sh-table">
				<div class="sh-table-cell sh-header-logo-container">

					<?php /* Header logo */ ?>
					<nav class="header-standard-position">
						<div class="sh-nav-container">
							<ul class="sh-nav sh-nav-left">
								<li>
									<?php /* Header logo */ ?>
									<?php gillion_header_logo(); ?>
								</li>
							</ul>
						</div>
					</nav>

				</div>
				<?php if ( $banner || $banner_code ) : ?>
				<div class="sh-table-cell sh-header-banner-container">
					<?php if ( $banner_code ) :
							echo apply_filters( 'the_content', $banner_code );
						elseif ( $banner ) : ?>
						<?php if( $banner_url ) : ?><a href="<?php echo esc_url($banner_url); ?>" target="_blank"><?php endif; ?>
							<img src="<?php echo gillion_option_image('header_banner'); ?>" alt="" />
						<?php if( $banner_url ) : ?></a><?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="<?php gillion_header_classes( 3 ); ?>">
		<div class="container">
			<div class="sh-table">
				<div class="sh-table-cell sh-header-nav-container">

					<?php /* Header navigation */ ?>
					<nav id="header-navigation" class="header-standard-position">
						<?php if ( has_nav_menu( 'header' ) ) : ?>
							<?php
								global $blog_id;
								$current_blog_id = $blog_id;
								apply_filters( 'gillion_before_header_nav', $current_blog_id );

								echo gillion_compress( wp_nav_menu( array(
									'theme_location' => 'header',
									'depth' => 4,
									'container_class' => 'sh-nav-container',
									'menu_class' => 'sh-nav',
									'items_wrap' => gillion_nav_wrap(),
									'echo' => false
								)));

				 				apply_filters( 'gillion_after_header_nav', $current_blog_id );
							?>
						<?php else :
							gillion_asign_menu();
						endif; ?>
					</nav>

				</div>
				<div class="sh-table-cell sh-header-meta-container">

					<?php /* Header meta */ ?>
					<nav class="header-standard-position">
						<div class="sh-nav-container">
							<ul class="sh-nav">

								<?php echo gillion_nav_wrap_sidemenu(); ?>
								<?php echo gillion_nav_wrap_search(); ?>
								<?php echo gillion_nav_wrap_share(); ?>
								<?php echo gillion_nav_wrap_login(); ?>
								<?php echo gillion_nav_wrap_cart(); ?>
								<?php echo gillion_nav_wrap_readlater(); ?>
								<?php echo ( function_exists( 'gillion_purchase_button' ) ) ? gillion_purchase_button() : ''; ?>

							</ul>
						</div>
					</nav>

				</div>
			</div>
		</div>
		<?php
			/* Header popup search */
			get_template_part('inc/headers/header-search');
		?>
	</div>
</div>
