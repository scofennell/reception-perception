<?php

/**
 * A class for enqueing stuff.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class Enqueue {

	function __construct() {

		// Add our JS file to the admin area.
		add_action( 'admin_enqueue_scripts', array( $this, 'script' ) );

		// Add our CSS to the admin area.
		add_action( 'admin_enqueue_scripts', array( $this, 'style' ) );

		// Add our CSS to the front end (due to admin bar).
		add_action( 'wp_enqueue_scripts', array( $this, 'style' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'script' ) );				
        
	}

	/**
	 * Register and enqueue our JS.
	 * 
	 * @param string $hook The current page slug.
	 */
	function script( $hook = '' ) {

		// Register our JS for when we need it.
		wp_register_script( RECEPTION_PERCEPTION . '-script', RECEPTION_PERCEPTION_URL . 'js/script.js', array( 'jquery' ), RECEPTION_PERCEPTION_VERSION, FALSE );

		// Enqueue our plugin JS.
		wp_enqueue_script( RECEPTION_PERCEPTION . '-script' );

		wp_register_script( 'html2canvas', RECEPTION_PERCEPTION_URL . 'js/html2canvas.min.js', array( 'jquery' ), RECEPTION_PERCEPTION_VERSION, FALSE );

	}

	/**
	 * Register and enqueue our CSS.
	 * 
	 * @param string $hook The current page slug.
	 */
	function style( $hook = '' ) {

		// Register our CSS for when we need it.
		wp_register_style( RECEPTION_PERCEPTION . '-style', RECEPTION_PERCEPTION_URL . 'css/style.css', FALSE, RECEPTION_PERCEPTION_VERSION, FALSE );

		// We always need CSS in the admin area.
		if( is_admin() ) {
			wp_enqueue_style( RECEPTION_PERCEPTION . '-style' );
		}

	}	

}