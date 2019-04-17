<?php
/**
 * Plugin Name: Dynamic SVG Icons
 * Plugin URI:  https://wordpress.org/plugins/dynamic-svg-icons/
 * Description: Dynamically place SVG icons and images on your site using placeholder markup.
 * Version:     0.1
 * Author:      Phil Kurth
 * Author URI:  http://philkurth.com.au
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: dynamic-svg-icons
 */


// If this file is called directly, abort.
defined( 'WPINC' ) or die();

define( 'DSVGI_MIN_PHP_VERSION', '7.0' );
define( 'DSVGI_PLUGIN_NAME', 'Dynamic SVG Icons' );
define( 'DSVGI_PLUGIN_VERSION', 0.1 );
define( 'DSVGI_PLUGIN_TEXT_DOMAIN', 'dynamic-svg-icons' );
define( 'DSVGI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DSVGI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( version_compare( PHP_VERSION, DSVGI_MIN_PHP_VERSION, '>=' ) ) {
	require_once DSVGI_PLUGIN_DIR . 'app/DynamicSvgIconsPlugin.php';
	$plugin = new \DsvgIcons\DynamicSvgIconsPlugin();
	$plugin->init();

} else {
	require_once DSVGI_PLUGIN_DIR . 'app/AdminNotices/FailedPhpVersionNotice.php';
	$notice = new \DsvgIcons\AdminNotices\FailedPhpVersionNotice( DSVGI_PLUGIN_NAME, DSVGI_MIN_PHP_VERSION );
	$notice->init();
}