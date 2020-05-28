<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );
/**
 * @var FW_Ext_Backups_Demo[] $demos
 */

/**
 * @var FW_Extension_Backups $backups
 */
$php_manual_url = 'http://php.net/manual/en/book.zip.php';
$backups = fw_ext('backups');

if ($backups->is_disabled()) {
	$confirm = '';
} else {
	$confirm = esc_html__(
		'IMPORTANT: Installing this demo content will delete the content you currently have on your website. However, we create a backup of your current content in (Tools > Backup). You can restore the backup from there at any time in the future.',
		'gillion'
	);
}
?>
<h2><?php esc_html_e('Demo Content Install', 'gillion') ?></h2>
<?php echo function_exists( 'shufflehound_unyson_demo_notice' ) ? shufflehound_unyson_demo_notice() : ''; ?>
<div>
	<?php if ( !class_exists('ZipArchive') ): ?>
		<div class="error below-h2">
			<p>
				<strong><?php esc_html_e( 'Important', 'gillion' ); ?></strong>:
				<?php printf(
					__( 'You need to activate %s.', 'gillion' ),
					'<a href="'.esc_url($php_manual_url ).'" target="_blank">'. esc_html__('zip extension', 'gillion') .'</a>'
				); ?>
			</p>
		</div>
	<?php endif; ?>

	<?php if ($http_loopback_warning = fw_ext_backups_loopback_test()) : ?>
		<div class="error">
			<p><strong><?php esc_html_e( 'Important', 'gillion' ); ?>:</strong> <?php echo wp_kses_post( $http_loopback_warning ); ?></p>
		</div>
	<?php endif; ?>
	<?php if (
		$http_loopback_warning
		// || (function_exists('is_wpe') && is_wpe()) // WpEngine
	): ?>
		<script type="text/javascript">var fw_ext_backups_loopback_failed = true;</script>
	<?php endif; ?>
</div>

<p></p>
<div class="theme-browser rendered" id="fw-ext-backups-demo-list">
<?php foreach ($demos as $demo): ?>
	<div class="theme fw-ext-backups-demo-item" id="demo-<?php echo esc_attr($demo->get_id()) ?>">
		<div class="theme-screenshot">
			<img src="<?php echo esc_attr($demo->get_screenshot()); ?>" alt="Screenshot" />
		</div>
		<?php if ($demo->get_preview_link()): ?>
			<a class="more-details" target="_blank" href="<?php echo esc_attr($demo->get_preview_link()) ?>">
				<?php esc_html_e('Live Preview', 'gillion') ?>
			</a>
		<?php endif; ?>
		<h3 class="theme-name"><?php echo esc_html($demo->get_title()); ?></h3>
		<div class="theme-actions">
			<a class="button button-primary"
			   href="#" onclick="return false;"
			   data-confirm="<?php echo esc_attr($confirm); ?>"
			   data-install="<?php echo esc_attr($demo->get_id()) ?>"><?php esc_html_e('Install', 'gillion'); ?></a>
		</div>
	</div>
<?php endforeach; ?>
</div>
