<?php
	$filled = ( in_array( gillion_option('back_to_top'), array('1 filled', '2 filled', '3 filled') ) ) ? ' filled' : '';
?>

<?php if( gillion_option('back_to_top') != 'disabled' ) : ?>

	<div class="sh-back-to-top sh-back-to-top1<?php echo esc_attr( $filled ); ?>">
		<i class="fa fa-angle-up"></i>
	</div>

<?php endif; ?>
