<?php
	/* HEADER 4 */

	if ( ! function_exists( 'gillion_nav_wrap' ) ) :
		function gillion_nav_wrap() {
		    $wrap  = '<ul id="%1$s" class="%2$s">%3$s';
		    $wrap .= '</ul>';

		    return $wrap;
		}
	endif;
?>

<?php /* Header */ ?>
<div class="sh-header-height sh-header-4">
	<div class="sh-header-middle">
		<div class="container sh-header-additional">
			<div class="sh-table">
				<div class="sh-table-cell sh-header-meta1-container">
					<?php /* Header meta */ ?>
					<nav class="header-standard-position">
						<div class="sh-nav-container">
							<ul class="sh-nav">

								<?php echo gillion_nav_wrap_search(); ?>
								<?php echo gillion_nav_wrap_share(); ?>

							</ul>
						</div>
					</nav>
				</div>
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
				<div class="sh-table-cell sh-header-meta2-container">
					<?php /* Header meta */ ?>
					<nav class="header-standard-position">
						<div class="sh-nav-container">
							<ul class="sh-nav">

								<?php echo gillion_nav_wrap_sidemenu(); ?>
								<?php echo gillion_nav_wrap_login(); ?>
								<?php echo gillion_nav_wrap_cart(); ?>
								<?php echo gillion_nav_wrap_readlater(); ?>

							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="<?php gillion_header_classes( 4 ); ?>">
		<div class="container sh-header-standard">

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
		<?php
			/* Header popup search */
			get_template_part('inc/headers/header-search');
		?>
	</div>
</div>
