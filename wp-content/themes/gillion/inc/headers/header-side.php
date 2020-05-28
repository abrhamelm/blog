<?php
	/* Header Right 1 */
?>

<?php /* Header */ ?>
<div class="sh-header-side">
	<?php if ( is_active_sidebar( 'side-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'side-widgets' ); wp_reset_postdata(); ?>
	<?php endif; ?>
</div>
<div class="sh-header-side-overlay"></div>
