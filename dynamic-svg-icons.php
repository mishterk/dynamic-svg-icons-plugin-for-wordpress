<?php
/**
 * Plugin Name: Dynamic SVG Icons
 * Plugin URI:  TODO
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

define( 'DSVGI_PLUGIN_VERSION', 0.1 );
define( 'DSVGI_PLUGIN_TEXT_DOMAIN', 'dynamic-svg-icons' );
define( 'DSVGI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DSVGI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once DSVGI_PLUGIN_DIR . 'app/DynamicSvgIconsPlugin.php';
$plugin = new \DynamicSvgIcons\DynamicSvgIconsPlugin();
$plugin->init();