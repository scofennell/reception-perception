<?php

/**
 * A class for defining our post meta fields.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class PostMetaFields {

	function __construct() {

		// Define our settings.
		$this -> set_fields();

	}

	/**
	 * Get the array that defines our plugin post meta fields.
	 * 
	 * @return array Our plugin post meta fields.
	 */
	function get_fields() {

		return $this -> fields;

	}

	/**
	 * Store our meta fields definitions.
	 */
	function set_fields() {

		$out = array(

			// A post type.
			'player' => array(

				// A section.
				'bio' => array(

					// The label for this section.
					'label' => esc_html__( 'Bio', 'rp' ),

					// The settings for this section.
					'settings' => array(

						// A setting.
						'last_name' => array(
							'type'           => 'text',
							'label'          => esc_html__( 'Last Name', 'rp' ),
							'description'    => esc_html__( 'Last name.', 'rp' ),
						),

						// A setting.
						'first_name' => array(
							'type'           => 'text',
							'label'          => esc_html__( 'First Name', 'rp' ),
							'description'    => esc_html__( 'First name.', 'rp' ),
						),	

						'years_experience' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Years Experience', 'rp' ),
							'description'    => esc_html__( 'Years experience.', 'rp' ),
						),						

						'birth_date' => array(
							'type'           => 'date',
							'label'          => esc_html__( 'Birth Date', 'rp' ),
							'description'    => esc_html__( 'Birth date.', 'rp' ),
						),

					),

				),

				// A section.
				'skills' => array(

					// The label for this section.
					'label' => esc_html__( 'Skills', 'rp' ),

					// The settings for this section.
					'settings' => array(

						// A setting.
						'broken_tackles_0' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Zero Broken Tackles', 'rp' ),
							'description'    => esc_html__( 'Zero broken tackles.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'broken_tackles_1' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'One Broken Tackle', 'rp' ),
							'description'    => esc_html__( 'One broken tackle.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'broken_tackles_2' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Two or More Broken Tackles', 'rp' ),
							'description'    => esc_html__( 'Two or more broken tackles.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),			

						'contested_catch' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Contested Catch', 'rp' ),
							'description'    => esc_html__( 'Contested catch.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

					),

				),	

				// A section.
				'route_tree_percentage' => array(

					// The label for this section.
					'label' => esc_html__( 'Route Tree Percentage', 'rp' ),

					// The settings for this section.
					'settings' => array(

						// A setting.
						'nine' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Nine', 'rp' ),
							'description'    => esc_html__( 'Nine.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'post' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Post', 'rp' ),
							'description'    => esc_html__( 'Post.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'dig' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Dig', 'rp' ),
							'description'    => esc_html__( 'Dig.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),			

						'curl' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Curl', 'rp' ),
							'description'    => esc_html__( 'Curl.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'slant' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Slant', 'rp' ),
							'description'    => esc_html__( 'Slant.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'screen' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Screen', 'rp' ),
							'description'    => esc_html__( 'Screen.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),	

						'other' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Other', 'rp' ),
							'description'    => esc_html__( 'Other.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'flat' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Flat', 'rp' ),
							'description'    => esc_html__( 'Flat.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'comeback' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Comeback', 'rp' ),
							'description'    => esc_html__( 'Comeback.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),	

						'out' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Out', 'rp' ),
							'description'    => esc_html__( 'Out.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'corner' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Corner', 'rp' ),
							'description'    => esc_html__( 'Corner.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

					),

				),	

				// A section.
				'success_rate_coverage' => array(

					// The label for this section.
					'label' => esc_html__( 'Success Rate VS Coverage', 'rp' ),

					// The settings for this section.
					'settings' => array(

						// A setting.
						'nine' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Nine', 'rp' ),
							'description'    => esc_html__( 'Nine.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'post' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Post', 'rp' ),
							'description'    => esc_html__( 'Post.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'dig' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Dig', 'rp' ),
							'description'    => esc_html__( 'Dig.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),			

						'curl' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Curl', 'rp' ),
							'description'    => esc_html__( 'Curl.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'slant' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Slant', 'rp' ),
							'description'    => esc_html__( 'Slant.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'screen' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Screen', 'rp' ),
							'description'    => esc_html__( 'Screen.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),	

						'other' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Other', 'rp' ),
							'description'    => esc_html__( 'Other.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'flat' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Flat', 'rp' ),
							'description'    => esc_html__( 'Flat.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						'comeback' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Comeback', 'rp' ),
							'description'    => esc_html__( 'Comeback.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),	

						'out' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Out', 'rp' ),
							'description'    => esc_html__( 'Out.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

						// A setting.
						'corner' => array(
							'type'           => 'number',
							'label'          => esc_html__( 'Corner', 'rp' ),
							'description'    => esc_html__( 'Corner.', 'rp' ),
							'attrs'          => array(
								'step' => 'any'
							),
						),

					),

				),	

			),									

		);

		$this -> fields = $out;

	}

	/**
	 * Get the values for our meta box.
	 * 
	 * @param  integer $post_id The ID of the post.
	 * @return array            A multidimensional array of values by setting and section.
	 */
	function get_values( $post_id ) {

		$post_types = $this -> get_fields();
		$fields     = $post_types[ get_post_type( $post_id ) ];

		$out = array();

		$post_meta = get_post_meta( $post_id );

		foreach( $fields as $section_key => $section ) {

			$settings = $section['settings'];

			foreach( $settings as $setting_key => $setting ) {

				//$out[ $section_key ][ $setting_key ] = $post_meta[ $section_key ][ $setting_key ];
				$out[ $section_key ][ $setting_key ] = $post_meta[ RECEPTION_PERCEPTION . "-$section_key-$setting_key" ][ 0 ];
			
			}

		}

		return $out;

	}

	/**
	 * Get the value for a meta field.
	 * 
	 * @param  integer $post_id    The post ID.
	 * @param  string  $section_id The section ID.
	 * @param  string  $setting_id The setting ID.
	 * @return mixed               The post meta value from the DB.
	 */ 
	function get_value( $post_id, $section_id, $setting_id ) {

		$values = $this -> get_values( $post_id );

		// If this section has no values, bail.
		if( ! isset( $values[ $section_id ] ) ) { return FALSE; }

		// If this setting has no value, bail.
		if( ! isset( $values[ $section_id ][ $setting_id ] ) ) { return FALSE; }

		return $values[ $section_id ][ $setting_id ];

	}

}