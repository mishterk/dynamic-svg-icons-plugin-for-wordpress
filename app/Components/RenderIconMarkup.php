<?php


namespace DsvgIcons\Components;


use DsvgIcons\Framework\Contracts\Initable;
use DsvgIcons\Framework\Utils\MinifiedMarkup;
use DsvgIcons\Framework\View;


class RenderIconMarkup implements Initable {


	public function init() {
		add_action( 'wp_footer', [ $this, '_render_markup' ] );
	}


	public function _render_markup() {
		$content = '';

		$content .= View::prepare( 'icon-wrapper', [
			'id'   => 'dsvgicon--facebook',
			'icon' => View::prepare( 'icons/facebook' )
		] );

		$content .= View::prepare( 'icon-wrapper', [
			'id'   => 'dsvgicon--twitter',
			'icon' => View::prepare( 'icons/twitter' )
		] );

		$content .= View::prepare( 'icon-wrapper', [
			'id'   => 'dsvgicon--umbrella',
			'icon' => View::prepare( 'icons/umbrella' )
		] );

		View::render( 'template-script', [
			'content' => MinifiedMarkup::make( $content )
		] );
	}


}