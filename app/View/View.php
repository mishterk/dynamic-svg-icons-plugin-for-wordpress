<?php


namespace DsvgIcons\View;


/**
 * Class View
 * @package DsvgIcons\Utils
 *
 * @method static View get_instance();
 */
class View extends \DsvgIcons\Framework\View\ViewBase {


	protected function setup() {
		$this->set_view_base_dir( DSVGI_PLUGIN_DIR . 'templates' );
		$this->set_view_override_base_dir( get_stylesheet_directory() . '/dsvgicons' );
//		$this->add_overridable_template_dir( 'icons' );
//		$this->add_overridable_template( 'icons/umbrella.php' );
	}


}
