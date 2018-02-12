<?php

/**
 * Register an spl autoloader per PSR4.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */
 

spl_autoload_register( function( $class ) {

	// If the class does not pertain to our plugin, bail. 
	$prefix        = RECEPTION_PERCEPTION . '\\';
	$len           = strlen( $prefix );
	$strncmp       = strncmp( $prefix, $class, $len );

	if( $strncmp !== 0 ) { return; }

	// All of our classes together in this folder.
	$inc = RECEPTION_PERCEPTION_PATH . 'inc/';

	// Convert the class name to the file path for that class name.
	$relative_class = substr( $class, $len );
	$relative_class = str_replace( '\\', '', $relative_class );
	$file           = $inc . $relative_class . '.php';

	if( ! file_exists( $file ) ) {
		return FALSE;
	}

	require_once( $file );

	return TRUE;

});