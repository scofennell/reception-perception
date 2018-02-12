<?php

/**
 * A singleton for getting meta data about this plugin.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class Meta {

	/**
	 * Get the slug for our plugin.
	 * 
	 * @return string The URL slug for our plugin.
	 */
	function get_slug() {
		return esc_html__( 'boilerplate', 'rp' );
	}
	
	/**
	 * Get the label for our plugin.
	 * 
	 * @return string The admin-facing name for our plugin.
	 */
	function get_label() {
	   
		return esc_html__( 'Reception Perception', 'rp' );
	
	}
	
	function get_icon() {
    	
    	$icon = RECEPTION_PERCEPTION_URL . 'images/favicon.png';
    	
    	return esc_url( $icon );
	
	}

	/**
	 * Get the capability for managing our plugin.
	 * 
	 * @return string The cap name for managing our plugin.
	 */
	function get_capability() {
		return 'update_core';
	}

	/**
	 * Get the parent settings page for our plugin.
	 * 
	 * @return string The parent settings page for our plugin.
	 */
	function get_parent_page() {
		return 'settings.php';
	}		

}