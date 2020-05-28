<?php
	/* HEADER 2 */

	if ( ! function_exists( 'gillion_nav_wrap' ) ) :
		function gillion_nav_wrap() {
			$wrap = '%3$s';

		    return $wrap;
		}
	endif;
?>

<?php /* Header */ ?>
<div class="sh-header-height">
	<div class="<?php gillion_header_classes( 2 ); ?>">
		<div class="container">
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
				<div class="sh-table-cell sh-header-nav-container">

					<?php /* Header navigation */ ?>
					<nav id="header-navigation" class="header-standard-position">

						<?php if ( has_nav_menu( 'header' ) ) : ?>
							<div class="sh-nav-container">
								<ul class="sh-nav">
									<?php
										global $blog_id;
										$current_blog_id = $blog_id;
										apply_filters( 'gillion_before_header_nav', $current_blog_id );

										echo gillion_compress( wp_nav_menu( array(
											'theme_location' => 'header',
											'depth' => 4,
											'container' => false,
											'container_class' => false,
											'menu_class' => false,
											'items_wrap' => gillion_nav_wrap(),
											'echo' => false
										)));

						 				apply_filters( 'gillion_after_header_nav', $current_blog_id );
									?>
									<?php echo gillion_nav_wrap_sidemenu(); ?>
									<?php echo gillion_nav_wrap_search(); ?>
									<?php echo gillion_nav_wrap_share(); ?>
									<?php echo gillion_nav_wrap_login(); ?>
									<?php echo gillion_nav_wrap_cart(); ?>
									<?php echo gillion_nav_wrap_readlater(); ?>
									<?php echo ( function_exists( 'gillion_purchase_button' ) ) ? gillion_nav_wrap_readlater() : ''; ?>
								</ul>
							</div>

						<?php else :
							gillion_asign_menu();
						endif; ?>
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
