<?php

/**
 * A class for creating a post meta box.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class PostMetaBox {

	use Form;

	function __construct() {

		// Grab our plugin-wide helpers.
		$reception_perception = get_reception_perception();

		$this -> meta             = $reception_perception -> meta;
		$this -> subsite_settings = $reception_perception -> subsite_settings;
		$this -> config           = $reception_perception -> config;
		
		global $post_id;

		// Grab the list of meta fields.
		$this -> post_meta_fields = $reception_perception -> post_meta_fields;
		$this -> meta_fields      = $this -> post_meta_fields -> get_fields();

		// Add our meta boxes.
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		
		// Handle the saving of our meta boxes.
		add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );

	}

	/**
	 * Determine if we are on the post page.
	 * 
	 * @return boolean Returns TRUE if we are on the post page, else FALSE.
	 */
	function is_current_page() {

		// If we're in network admin, bail.
		if( is_multisite() ) {
			if( is_network_admin() ) { return FALSE; }
		}

		// If we're not in admin, bail.
		if( ! is_admin() ) { return FALSE; }

		$current_screen = get_current_screen();

		// If we're not on the post screen, bail.
		$base      = $current_screen -> base;
		if( $base != 'post' ) { return FALSE; }
	
		return TRUE;

	}

	/**
	 * Add the meta boxes.
	 * 
	 * @param string $post_type The post type to which we're adding meta boxes.
	 */
	public function add_meta_boxes( $post_type ) {

		// If we're not on the correct page, bail.
		if( ! $this -> is_current_page() ) { return FALSE; }

		$id            = RECEPTION_PERCEPTION;
		$title         = $this -> meta -> get_label();
		$callback      = array( $this, 'the_content' );
		$screen        = $post_type;
		$context       = 'advanced';
		$priority      = 'high';
		$callback_args = array();

		add_meta_box(
			$id, 
			$title, 
			$callback, 
			$screen, 
			$context,
			$priority,
			$callback_args
		);
	
	}

	/**
	 * Echo the meta box content.
	 */
	public function the_content( $post ) {

		echo $this -> get_content( $post );

	}

	/**
	 * Get the meta box content.
	 * 
	 * @param  object $post A WP_POST.
	 * @return string       The meta box content.
	 */
	function get_content( $post ) {

		$out = '';

		$post_id = absint( $post -> ID );

		$post_type = $post -> post_type;

		// Grab the meta values for this post.
		$values = array();
		if( ! empty( $post_id ) ) {
			$values = $this -> post_meta_fields -> get_values( $post_id );
		}

		// Grab the meta field inputs.
		$post_types = $this -> meta_fields;
		$fields = $post_types[ $post_type ];

		// Loop through the array of sections and inputs.
		$count = count( $fields );
		$i     = 0;
		foreach( $fields as $section_id => $section ) {

			$i++;

			// The label for this section.
			$section_label = $section['label'];

			// The description for this section.
			$section_description = '';
			if( ! empty( $section['description'] ) ) {
				$section_description = '<p>' . $section['description'] . '</p>';
			}

			// Loop through the settings in this section.
			$settings     = $section['settings'];
			$settings_out = '';
			foreach( $settings as $setting_id => $setting ) {

				// Grab the value for this setting.
				$value = '';
				if( isset( $values[ $section_id ][ $setting_id ] ) ) {
					$value = $values[ $section_id ][ $setting_id ];
				}

				//wp_die( var_dump( $value ) );

				if( is_scalar( $value ) ) {

					$value = esc_attr( $value );

				} elseif( is_array( $value ) ) {

					$value = array_map( 'esc_attr', $value );

				}
		
				// Grab the input for this setting.
				$settings_out .= $this -> get_field( $post_id, $value, $section_id, $setting_id, $setting );

			}

			// Wrap this section.
			$out .= "
				<fieldset>
					<legend><strong>$section_label</strong></legend>
					$section_description
					<div>$settings_out</div>
				</fieldset>
			";

			if( $i < $count ) {
				$out .= "<br><hr>";
			}

		}

		// Add an nonce field so we can check for it later.
		$nonce = wp_nonce_field( 'save', RECEPTION_PERCEPTION . '-meta_box', TRUE, FALSE );

		$out = "
			$nonce
			$out
			$nonce
		";

		return $out;

	}

	/**
	 * Get an HTML input for a meta field.
	 * 
	 * @param  string $post_id    The post ID.
	 * @param  string $value      The database value for this input.
	 * @param  string $section_id The ID for the section that this setting is in.
	 * @param  string $setting_id The ID for this setting.
	 * @param  string $setting    The definition of this setting.
	 * @return string             An HTML input for a meta field.
	 */
	function get_field( $post_id, $value, $section_id, $setting_id, $setting ) {

		$out = '';

		// The label for this setting.
		$setting_label = $setting['label'];

		// The description for this setting.
		$setting_description = '';
		if( isset( $setting['description'] ) ) {
			$setting_description = '<p class="howto">' . $setting['description'] . '</p>';
		}
		
		// Namespace the ID for this setting.
		$id = RECEPTION_PERCEPTION . '-' . $section_id . '-' . $setting_id;

		// Name the setting so it will be saved as an array.
		$name = RECEPTION_PERCEPTION . '[' . $section_id . ']' .  '[' . $setting_id . ']';

		// Maybe get some options for this setting.
		if( isset( $setting['options_cb'] ) ) {

			// Get the options from this CB class.
			$options_class = __NAMESPACE__ . '\\' . $setting['options_cb'][0];

			// Instantiate the CB class, providing the current value of the setting.
			$options_obj = new $options_class( $value, $id, $name );

			// Grab the cb method.
			$options_method = $setting['options_cb'][1];

			// Call the cb method.
			$options = call_user_func( array( $options_obj, $options_method ) );
			if( is_wp_error( $options ) ) { return $options; }

		}

		// The type of input.
		$type = $setting['type'];
		
		$attrs = '';
		if( isset( $setting['attrs'] ) ) {
			$attrs = $this -> get_attrs_from_array( $setting['attrs'] );
		}	
		
		// Deal with checkboxes.
		if( $type == 'checkbox' ) {

			// The value the box will have when checked.
			$checkbox_value = esc_attr( $setting['checkbox_value'] );

			// Should the box be checked?
			$checked = checked( $value, $checkbox_value, FALSE );

			// Wrap the checkbox.
			$out = "
				<div id='$id-wrap'>
					<input $attrs $checked class='' type='$type' id='$id' name='$name' value='$checkbox_value'>
					<label for='$id'>$setting_label</label>
					$setting_description
				</div>
			";

		} elseif( $type == 'checkbox_group' ) {

			$out = "
				<div id='$id-wrap'>
					$options
					$setting_description
				</div>
			";

		// All other input types.
		} else {

			// Wrap the input.
			$out = "

				<div id='$id-wrap'>
					<div>
						<label for='$id'>$setting_label</label>
					</div>
					<input $attrs class='regular-text' style='width: 100%;' type='text' id='$id' name='$name' value='$value'>
					$setting_description
				</div>

			";

		}

		return $out;

	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_post( $post_id, $post, $update ) {

		// Are we on the right page?
		if( ! $this -> is_current_page() ) { return $post_id; }

		// Was the meta box submit?
		if ( ! isset( $_POST[ RECEPTION_PERCEPTION . '-meta_box' ] ) ) {
			return $post_id;
		}

		// Check the nonce.
		$nonce = $_POST[ RECEPTION_PERCEPTION . '-meta_box' ];
		if ( ! wp_verify_nonce( $nonce, 'save' ) ) {
			return $post_id;
		}

		// Is this an autosave?
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Are we in ajax-land?
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return $post_id;
		}

		// Is this a revision?
		if( wp_is_post_revision( $post_id ) ) {
			return $post_id;
		}

		// Is the user allowed to do this?
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Check if there was a multisite switch before saving.
		if ( is_multisite() && ms_is_switched() ) {
			return $post_id;
		}

		$old_values = $this -> post_meta_fields -> get_values( $post_id );

		// Grab and sanitize the data.
		$posted_data = $_POST[ RECEPTION_PERCEPTION ];
		$posted_data = $this -> sanitize( $posted_data );
		
		// Finally!  Update the data.
		foreach( $posted_data as $section_key => $section ) {
		
			foreach( $section as $setting_key => $setting ) {

				update_post_meta( $post_id, RECEPTION_PERCEPTION . "-$section_key-$setting_key" , $posted_data[ $section_key ][ $setting_key ] );

			}

		}

		//wp_die( var_dump( get_post_meta( $post_id, RECEPTION_PERCEPTION . "-bio-last_name", TRUE ) ) );

		return $post_id;

	}

}