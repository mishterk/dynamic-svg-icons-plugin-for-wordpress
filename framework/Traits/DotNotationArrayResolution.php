<?php


namespace DsvgIcons\Framework\Traits;


trait DotNotationArrayResolution {


	/**
	 * Resolves the value of a multi-dimensional array using dot notation.
	 *
	 * i.e; resolve(['a' => ['b' => 1]], 'a.b') => 1
	 *
	 * @param array $array
	 * @param $path
	 * @param null $default
	 *
	 * @return array|mixed|null
	 */
	private function resolve_from( array $array, $path, $default = null ) {
		$current = $array;
		$p       = strtok( $path, '.' );

		while ( $p !== false ) {
			if ( ! isset( $current[ $p ] ) ) {
				return $default;
			}
			$current = $current[ $p ];
			$p       = strtok( '.' );
		}

		return $current;
	}


}