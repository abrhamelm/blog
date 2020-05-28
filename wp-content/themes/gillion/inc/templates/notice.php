<?php
/**
 * Notice option HTML
 */

if( defined('FW') && gillion_option( 'notice_status', true ) == true ) :
?>

	<div class="sh-page-notice">
		<div class="container">
			<div class="sh-table">
				<div class="sh-table-cell">
					<?php echo gillion_remove_p( wp_kses_post( gillion_option( 'notice_text' ) ) ); ?>
				</div>
				<div class="sh-table-cell text-right">
					<?php if( gillion_option( 'notice_more_url' ) ) : ?>
						<a href="<?php echo esc_url( gillion_option( 'notice_more_url' )); ?>">
							<?php esc_html_e( 'Learn more', 'gillion' ); ?>
						</a>
					<?php endif; ?>
					<?php if( gillion_option( 'notice_close' ) != 'disable' ) : ?>
						<a href="#" class="sh-page-notice-button">
							<?php esc_html_e( 'Got it!', 'gillion' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
