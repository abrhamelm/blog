<?php
/**
 * White borders option HTML
 */

$white_borders = ( esc_attr( gillion_option('white_borders', false)) == true ) ? 'page-white-borders' : '';
?>

<?php if( $white_borders ) : ?>
	<div class="sh-window-line line-top"></div>
	<div class="sh-window-line line-bottom"></div>
	<div class="sh-window-line line-right"></div>
	<div class="sh-window-line line-left"></div>
<?php endif; ?>
