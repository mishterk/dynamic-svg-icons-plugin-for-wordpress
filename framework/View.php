<?php


namespace DsvgIcons\Framework;


class View {


	/**
	 * @var string The view directory inside the plugin
	 */
	public static $view_dir = '';


	/**
	 * @var string The alternate view directory we check for overridable template resolution.
	 */
	public static $theme_view_dir = '';


	/**
	 * @var array An array of template names that are checked for override in the theme. These include the template paths
	 * relative to the view directory.
	 */
	public static $overridable_templates = [];


	/**
	 * @var array An array of template directory names that are checked for override in the theme. These must include
	 * the path relative to the view directory.
	 */
	public static $overridable_template_dirs = [];


	/**
	 * Render View Template With Data
	 *
	 * Locates a view template and includes it within the same scope as a data object/array. This makes it possible to
	 * access raw data in the template.
	 *
	 * Note: Any data passed into this function will be casted as an array and then as an object. The final data available
	 *   within a template is in the form of an object with the variable name $data.
	 *
	 * e.g.
	 *
	 *      array('name' => 'Bob', 'age' => 42)
	 *
	 * Will be converted to an object to be used as;
	 *
	 *      $data->name
	 *      $data->age
	 *
	 * @param   string|null $name A named variation for the template. This is in the form {$name}.php. Can include directories, where necessary.
	 * @param   object|array $data An associative array or object to use inside the template.
	 * @param   string $suffix The file suffix.
	 *
	 * @return  string
	 */
	public static function prepare( $name, $data = [], $suffix = '.php' ) {

		$markup = '';
		$path   = self::get_full_path( $name . $suffix );

		if ( $t = self::view_template_exists( $path ) ) {
			$data   = self::prepare_data( $data );
			$markup = self::enclose_vars_with_template( $path, $data );
		}

		return $markup;
	}


	public static function enclose_vars_with_template( $path, $data ) {
		extract( $data );
		ob_start();
		include $path;
		$markup = ob_get_clean();

		return $markup;
	}


	/**
	 * Use this to echo out templates
	 *
	 * @param $name
	 * @param array $data
	 * @param string $suffix
	 */
	public static function render( $name, $data = [], $suffix = '.php' ) {
		echo self::prepare( $name, $data, $suffix );
	}


	/**
	 * Casts data to an array for exraction before template inclusion
	 *
	 * @param $data
	 *
	 * @return array
	 */
	private static function prepare_data( $data ) {

		// if data is not already an object, cast as object
		if ( ! is_array( $data ) ) {
			$data = (array) $data;
		}

		return $data;
	}


	/**
	 * Making sure the template exists
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	private static function view_template_exists( $name ) {
		return file_exists( $name );
	}


	/**
	 * Pieces together the full path to the file
	 *
	 * @param $name
	 *
	 * @return string
	 */
	private static function get_full_path( $name ) {

		// attempt to resolve template in override directory (wp theme)
		if ( self::template_is_overridable( $name ) ) {
			$override_path = trailingslashit( self::$theme_view_dir ) . ltrim( $name, '/' );

			if ( self::view_template_exists( $override_path ) ) {
				return $override_path;
			}
		}

		return trailingslashit( self::$view_dir ) . ltrim( $name, '/' );
	}


	/**
	 * @param $name
	 *
	 * @return bool
	 */
	private static function template_is_overridable( $name ) {
		// check explicitly declared templates
		if ( in_array( $name, self::$overridable_templates ) ) {
			return true;
		}

		// check if name starts with a declared directory
		foreach ( self::$overridable_template_dirs as $dir ) {
			if ( strpos( $name, $dir ) === 0 ) {
				return true;
			}
		}

		return false;
	}


	public static function todo( $message ) {
		ob_start();
		?>
        <span style="color:red; display: inline-block; clear:both;">TODO: <?php echo $message; ?></span>
		<?php
		return ob_get_clean();
	}


}