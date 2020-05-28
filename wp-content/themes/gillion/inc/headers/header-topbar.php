<?php /* Header top bar */
$page_topbar = gillion_post_option( gillion_page_id(), 'topbar_status', 'default' );
$global_topbar = gillion_option( 'topbar_status', 'on' );
$titlebar = ( isset($page_topbar) && $page_topbar && $page_topbar != 'default' ) ? $page_topbar : ( ( isset($global_topbar) && $global_topbar ) ? $global_topbar : 'off' );
?>
<?php if( $titlebar == 'on' ) : ?>
	<div class="sh-header-top">
		<div class="container">
			<div class="sh-table">

				<?php /* Header secondery navigation */ ?>
				<div class="sh-table-cell">
					<?php if( has_nav_menu( 'topbar' ) ) : ?>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'topbar',
								'depth' => 1,
								'container_class' => 'sh-nav-container',
								'menu_class' => 'sh-nav',
							));
						?>
					<?php else :
						gillion_asign_menu();
					endif; ?>
				</div>

				<?php /* Header social media */ ?>
				<div class="sh-table-cell">
					<div class="sh-header-top-meta">
						<div class="header-social-media">
							<?php echo gillion_social_media(); ?>
						</div>
						<div class="sh-header-top-date">
							<span class="sh-header-top-date-day"><?php echo date_i18n('d'); ?></span>
							<span class="sh-header-top-date-meta">
								<span class="sh-header-top-date-month"><?php echo date_i18n('M'); ?></span>
								<span class="sh-header-top-date-year"><?php echo date_i18n('Y'); ?></span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
