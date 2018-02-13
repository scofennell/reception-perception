<?php

/**
 * A class for getting a Graphic for a player.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class Graphic {

	function __construct( $post_id ) {

		$reception_perception = get_reception_perception();
	
		$post_meta_fields = $reception_perception -> post_meta_fields;

		$this -> meta_values = $post_meta_fields -> get_values(  $post_id );

	}

	function get() {

		wp_enqueue_script( 'html2canvas' );
		wp_enqueue_script( 'jquery-ui-core' );

		$class = sanitize_html_class( __CLASS__ . '-' . __FUNCTION__ );

		$style = "background: red; border: 5px solid green; height: 200px;";

		$label = esc_html__( 'Get Image', 'rp' );

		$out = "
			<div class='$class'>
				<div style='$style' class='$class-target'></div>
				<a href='#' class='$class-trigger'>$label</a>
			</div>
		";

		return $out;

	}

}