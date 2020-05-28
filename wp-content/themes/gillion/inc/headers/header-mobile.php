<?php
	/* HEADER Mobile */
?>
<div id="header-mobile" class="sh-header-mobile">
	<div class="sh-header-mobile-navigation">
		<div class="container">
			<div class="sh-table sh-header-mobile-table">
				<div class="sh-table-cell">

					<?php /* Header navigation */ ?>
					<nav id="header-navigation-mobile" class="header-standard-position sh-header-mobile-navigation-left">
						<div class="sh-nav-container">
							<ul class="sh-nav">
								<li>
									<div class="sh-hamburger-menu sh-nav-dropdown">
					                	<span></span>
					                	<span></span>
					                	<span></span>
					                	<span></span>
					                </div>
								</li>
							</ul>
						</div>
					</nav>

				</div>
				<div class="sh-table-cell sh-header-logo-container">

					<?php /* Header logo */ ?>
					<?php gillion_header_logo(); ?>

				</div>
				<div class="sh-table-cell">

					<?php /* Header meta */ ?>
					<nav class="header-standard-position sh-header-mobile-navigation-right">
						<div class="sh-nav-container">
							<ul class="sh-nav">

								<?php echo gillion_nav_wrap_cart(); ?>
								<?php echo gillion_nav_wrap_readlater( 1 ); ?>

							</ul>
						</div>
					</nav>

				</div>
			</div>
		</div>
	</div>
	<nav class="sh-header-mobile-dropdown">
		<div class="container sh-nav-container">
			<ul class="sh-nav-mobile"></ul>
		</div>

		<div class="container sh-nav-container">
			<?php
				$elements = gillion_option( 'header_elements' );
				if( isset($elements['social_mobile']) && $elements['social_mobile'] == true ) :
			?>
				<div class="header-mobile-social-media">
					<?php echo gillion_social_media(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
			$elements = gillion_option( 'header_elements' );
			if ( isset($elements['search']) && $elements['search'] == true ) :
		?>
			<div class="header-mobile-search">
				<div class="container sh-nav-container">
					<form role="search" method="get" class="header-mobile-form" action="<?php echo esc_url( home_url('/') ); ?>">
						<input class="header-mobile-form-input" type="text" placeholder="<?php esc_html_e( 'Search here..', 'gillion' ); ?>" value="" name="s" required />
						<button type="submit" class="header-mobile-form-submit">
							<i class="icon-magnifier"></i>
						</button>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</nav>
</div>
