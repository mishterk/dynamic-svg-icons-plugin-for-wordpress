<?php


namespace DsvgIcons\AdminNotices;


class FailedPhpVersionNotice {


	private $plugin_name;
	private $min_php_version;


	/**
	 * @param $plugin_name
	 * @param $min_php_version
	 */
	public function __construct( $plugin_name, $min_php_version ) {
		$this->plugin_name     = $plugin_name;
		$this->min_php_version = $min_php_version;
	}


	public function init() {
		add_action( 'admin_notices', [ $this, 'print_notice' ] );
	}


	public function print_notice() {
		$message = __( "The <em>{$this->plugin_name}</em> plugin requires PHP version {$this->min_php_version} or higher. The plugin is active but is not currently functioning.", DSVGI_PLUGIN_TEXT_DOMAIN );
		printf( '<div class="error">%s</div>', wpautop( $message ) );
	}


}