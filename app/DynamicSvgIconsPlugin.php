<?php


namespace DynamicSvgIcons;


use DsvgIcons\Framework\AutoLoader;
use DsvgIcons\Framework\Contracts\Initable;
use DsvgIcons\View\View;


class DynamicSvgIconsPlugin {


	private $components = [
		'\DsvgIcons\Components\RenderIconMarkup'
	];


	public function init() {
		$this->init_autoloader();
		$this->init_view_system();
		$this->init_initables( $this->components );

		// todo - move the script loader
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_script( 'dsvgi', DSVGI_PLUGIN_URL . 'assets/build/js/dsvgi.js', [ 'jquery' ], DSVGI_PLUGIN_VERSION, true );
		} );
	}


	private function init_autoloader() {
		require_once DSVGI_PLUGIN_DIR . '/framework/AutoLoader.php';
		$autoloader = new AutoLoader();
		$autoloader->register();
		$autoloader->addNamespace( 'DsvgIcons', DSVGI_PLUGIN_DIR . 'app' );
		$autoloader->addNamespace( 'DsvgIcons\\Framework', DSVGI_PLUGIN_DIR . 'framework' );
	}


	private function init_view_system() {
		View::init();
	}


	private function init_initables( $initables ) {
		foreach ( $initables as $initable ) {
			/** @var \DsvgIcons\Framework\Contracts\Initable $component */
			$i = new $initable;

			if ( $i instanceof Initable ) {
				$i->init();
			} else {
				trigger_error( "$initable does not implement \DsvgIcons\Framework\Contracts\Initable and has not been initialised." );
			}
		}
	}


}