<?php
/**
 * Plugin Name: PDKDEV Dynamic SVG Icons
 * Plugin URI:  URI
 * Description: DESCRIPTION
 * Version:     0.1
 * Author:      Phil Kurth
 * Author URI:  http://philkurth.com.au
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: TEXT_DOMAIN
 */


// If this file is called directly, abort.
defined( 'WPINC' ) or die();

define( 'DSVGI_PLUGIN_VERSION', 0.1 );
define( 'DSVGI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DSVGI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once DSVGI_PLUGIN_DIR . 'app/DynamicSvgIconsPlugin.php';
$plugin = new \DynamicSvgIcons\DynamicSvgIconsPlugin();
$plugin->init();