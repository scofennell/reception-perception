<?php

/**
 * A class for getting and setting the Reception Perception subsite options.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class SubsiteSettings {

	public function __construct() {}

	/**
	 * Get the unique namespace for our plugin subsite settings.  What you'd call in get_option( $slug ).
	 * 
	 * @return string The unique namespace for our plugin subsite settings.
	 */
	public function get_settings_slug() { return RECEPTION_PERCEPTION . '_subsite'; }

	/**
	 * Define our multidimensional array of sections and settings.
	 * 
	 * @return array A multidimensional array of sections and settings.
	 */
	public function get_settings_array() {

		$out = array();

		// Create the "section_1" section.
		$out['data'] = array(

			// The label for this settings section.
			'label' => esc_html__( 'Data', 'rp' ),
			
			// The array of settings for this section.
			'settings' => array(

	            // A setting.
				'google_sheets_url' => array(

					// The user-facing label text for this setting.
					'label'    => esc_html__( 'Google Sheets URL', 'rp' ),
					
					// The type of form input.
					'type'     => 'url',
					
					// Some notes for this setting.
					'notes'    => esc_html__( 'A google sheets url.', 'rp' ),

				// End this setting.
				),
				
			// End the list of settings for this section.
			)

		// End this section.
		);

		return $out;

	}

	/**
	 * Grab the values for all of our plugin settings.
	 * 
	 * @return array A call to get_option();
	 */
	public function get_settings_values() {

		$out = get_option( $this -> get_settings_slug() );

		return $out;

	}

}