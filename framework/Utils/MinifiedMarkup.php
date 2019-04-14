<?php


namespace DsvgIcons\Framework\Utils;


class MinifiedMarkup {


	private $markup = '';


	/**
	 * @param string $markup
	 */
	public function __construct( string $markup ) {
		$this->markup = $markup;
	}


	public function __toString() {
		return $this->get();
	}


	public static function make( string $markup ) {
		return new self( $markup );
	}


	public function get() {
		return $this->minify( $this->markup );
	}


	private function minify( $markup ) {
		$search = array(
			'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
			'/[^\S ]+\</s',     // strip whitespaces before tags, except space
			'/(\s)+/s',         // shorten multiple whitespace sequences
			'/<!--(.|\s)*?-->/' // Remove HTML comments
		);

		$replace = array(
			'>',
			'<',
			'\\1',
			''
		);

		return preg_replace( $search, $replace, $markup );
	}


}