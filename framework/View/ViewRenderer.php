<?php


namespace DsvgIcons\Framework\View;


/**
 * Class ViewRenderer
 * @package DsvgIcons\Framework\View
 *
 * This class provides a means for rendering views with support for passing variables to those view templates. View
 * templates are all relative to a base directory and can be configured as overridable. The override system works by way
 * of searching for the same template in the override location and falling back the base dir where an override template
 * is not found.
 *
 * You can use this class by itself or, for a static interface, you can write your own app-level view object/s that
 * extend \DsvgIcons\Framework\View\ViewBase.
 */
class ViewRenderer {


	/**
	 * @var string The view directory inside the plugin
	 */
	protected $view_base_dir = '';


	/**
	 * @var string The alternate view directory we check for overridable template resolution.
	 */
	protected $view_override_base_dir = '';


	/**
	 * @var array An array of template names that are checked for override in the theme. These must include the template
	 * paths relative to the view directory. File extensions are also required here.
	 * TODO: remove the need to specify file extensions
	 */
	protected $overridable_templates = [];


	/**
	 * @var array An array of template directory names that are checked for override in the theme. These must include
	 * the path relative to the view directory.
	 */
	protected $overridable_template_dirs = [];


	/**
	 * @param string $view_base_dir
	 */
	public function __construct( $view_base_dir = '' ) {
		$this->set_view_base_dir( $view_base_dir );
	}


	public function set_view_base_dir( $dir ) {
		$this->view_base_dir = $dir;
	}


	/**
	 * @param $dir
	 */
	public function set_view_override_base_dir( $dir ) {
		$this->view_override_base_dir = $dir;
	}


	/**
	 * @param array $templates An array of template paths that are overridable
	 */
	public function set_overridable_templates( array $templates ) {
		$this->overridable_templates = $templates;
	}


	/**
	 * @param $template
	 */
	public function add_overridable_template( $template ) {
		$this->overridable_templates[] = $template;
	}


	/**
	 * @param array $dirs
	 */
	public function set_overridable_template_dirs( array $dirs ) {
		$this->overridable_template_dirs = $dirs;
	}


	/**
	 * @param $dir
	 */
	public function add_overridable_template_dir( $dir ) {
		$this->overridable_template_dirs[] = $dir;
	}


	/**
	 * Echos the rendered template
	 *
	 * @param $name
	 * @param array $data
	 * @param string $suffix
	 */
	public function render( $name, $data = [], $suffix = '.php' ) {
		echo $this->prepare( $name, $data, $suffix );
	}


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
	public function prepare( $name, $data = [], $suffix = '.php' ) {
		$markup = '';
		$path   = $this->get_full_path( $name . $suffix );

		if ( $t = $this->view_template_exists( $path ) ) {
			$data   = $this->prepare_data( $data );
			$markup = $this->enclose_vars_with_template( $path, $data );
		}

		return $markup;
	}


	public function todo( $message ) {
		ob_start();
		?>
        <span style="color:red; display: inline-block; clear:both;">TODO: <?php echo $message; ?></span>
		<?php
		return ob_get_clean();
	}


	/**
	 * Pieces together the full path to the file
	 *
	 * @param $name
	 *
	 * @return string
	 */
	private function get_full_path( $name ) {
		// attempt to resolve template in override directory
		if ( $this->template_is_overridable( $name ) ) {
			$override_path = trailingslashit( $this->view_override_base_dir ) . ltrim( $name, '/' );

			if ( $this->view_template_exists( $override_path ) ) {
				return $override_path;
			}
		}

		return trailingslashit( $this->view_base_dir ) . ltrim( $name, '/' );
	}


	/**
	 * Making sure the template exists
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	private function view_template_exists( $name ) {
		return file_exists( $name );
	}


	/**
	 * Casts data to an array for exraction before template inclusion
	 *
	 * @param $data
	 *
	 * @return array
	 */
	private function prepare_data( $data ) {
		if ( ! is_array( $data ) ) {
			$data = (array) $data;
		}

		return $data;
	}


	private function enclose_vars_with_template( $path, $data ) {
		extract( $data );
		ob_start();
		include $path;
		$markup = ob_get_clean();

		return $markup;
	}


	/**
	 * @param $name
	 *
	 * @return bool
	 */
	private function template_is_overridable( $name ) {
		// check explicitly declared templates
		if ( in_array( $name, $this->overridable_templates ) ) {
			return true;
		}

		// check if name starts with a declared directory
		foreach ( $this->overridable_template_dirs as $dir ) {
			if ( strpos( $name, $dir ) === 0 ) {
				return true;
			}
		}

		return false;
	}


}