<?php


namespace DsvgIcons\AdminNotices;


class FailedPhpVersionNotification {


	public function init() {
		add_action( 'admin_notices', [ $this, 'print_notice' ] );
	}


	public function print_notice() {
		$name    = DSVGI_PLUGIN_NAME;
		$min_php = DSVGI_MIN_PHP_VERSION;
		$message = __( "The <em>{$name}</em> plugin requires PHP version {$min_php} or higher. The plugin is active but is not currently functioning.", DSVGI_PLUGIN_TEXT_DOMAIN );

		printf( '<div class="error">%s</div>', wpautop( $message ) );
	}


}