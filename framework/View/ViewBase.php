<?php


namespace DsvgIcons\Framework\View;


use DsvgIcons\Framework\Traits\Singleton;


/**
 * Class ViewBase
 * @package DsvgIcons\Framework\Facades
 *
 * This class is designed to be extended by application-level View objects and provides a static interface for easily
 * working with those objects. The self::setup() method is required and provides a good point for configuring the
 * underlying view renderer.
 */
abstract class ViewBase extends ViewRenderer {


	use Singleton;


	abstract protected function setup();


	public static function init() {
		$instance = static::get_instance();
		$instance->setup();

		return $instance;
	}


	public static function get( $name, $data = [], $suffix = '.php' ) {
		return static::get_instance()->prepare( $name, $data, $suffix );
	}


	public static function echo( $name, $data = [], $suffix = '.php' ) {
		static::get_instance()->render( $name, $data, $suffix );
	}


}