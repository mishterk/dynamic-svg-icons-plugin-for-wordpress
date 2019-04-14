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
		$content = '';

		// todo - this should really just feed from a config array instead of rendering all files in directory the
		//   opendir isn't taking theme dirs into account and that means it won't be loading any custom icons added
		//   by a dev.
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

		View::echo( 'template-script', [
			'content' => MinifiedMarkup::make( $content )
		] );
	}


}