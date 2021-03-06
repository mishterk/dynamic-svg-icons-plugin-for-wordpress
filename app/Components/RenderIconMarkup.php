<?php


namespace DsvgIcons\Components;


use DsvgIcons\Framework\Contracts\Initable;
use DsvgIcons\Framework\Utils\MinifiedMarkup;
use DsvgIcons\View\View;


class RenderIconMarkup implements Initable {


	public function init() {
		add_action( 'wp_footer', [ $this, '_render_markup' ] );
	}


	public function _render_markup() {
		View::echo( 'template-script', [
			'content' => MinifiedMarkup::make( $this->get_active_icon_markup() )
		] );
	}


	private function get_active_icon_markup() {
		$content = '';

		foreach ( $this->get_active_icons() as $icon ) {

			$filename = pathinfo( $icon, PATHINFO_FILENAME );

			$content .= View::get( 'icon-wrapper', [
				'id'   => "dsvgicon--{$filename}",
				'icon' => View::get( "icons/{$filename}" )
			] );
		}

		return $content;
	}


	private function get_active_icons() {
		// todo - get using config object
		//$icons = include DSVGI_PLUGIN_DIR . 'config/active-icons.php';
		$config_path = get_stylesheet_directory() . '/dsvgicons/active-icons.php';
		$icons       = file_exists( $config_path )
			? include $config_path
			: [];

		return apply_filters( 'dsvgicons/active_icons', $icons );
	}


	/**
	 * NOTE: this resolves ALL icons in a given directory. We won't use this to load up icons on the front end but it
	 *   will be of use to us when we list out all available icons in the admin.
	 */
	private function get_all_icons() {
		$content = '';

		if ( $handle = opendir( DSVGI_PLUGIN_DIR . 'templates/icons' ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != "." && $file != ".." ) {

					$filename = pathinfo( $file, PATHINFO_FILENAME );
					$content  .= View::get( 'icon-wrapper', [
						'id'   => "dsvgicon--{$filename}",
						'icon' => View::get( "icons/{$filename}" )
					] );

				}
			}
			closedir( $handle );
		}

		return $content;
	}


}