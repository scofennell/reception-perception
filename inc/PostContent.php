<?php

/**
 * A class for filtering post content.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class PostContent {

	function __construct() {

		add_filter( 'the_content', array( $this, 'player' ) );

	}

	function player( $content ) {

		if( is_admin() ) { return $content; }

		global $post;

		if( ! is_singular( __FUNCTION__ ) ) { return $content; }

		$graphic = new Graphic( $post -> ID );

		$content .= $graphic -> get();

		return $content;

	}

}