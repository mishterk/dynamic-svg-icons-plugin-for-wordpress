<?php


namespace DsvgIcons\Framework\Traits;


trait Singleton {


	private static $_instance;


	public static function get_instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new static();
		}

		return self::$_instance;
	}


}