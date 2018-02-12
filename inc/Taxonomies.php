<?php

/**
 * A class for creating custom taxonomies.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class Taxonomies {

	public function __construct() {

		// Add our post types.
		add_action( 'init', array( $this, 'register' ), 10 );

	}

	/**
	 * Define all of our taxonomies in an array.
	 * 
	 * @return array All of our taxonomies.
	 */
	public function get_taxonomies() {

		$out = array(

			// The ID for this post type.
			'team' => array(
				
				'labels' => array(
					'name'              => _x( 'Teams', 'taxonomy general name', 'textdomain' ),
					'singular_name'     => _x( 'Team', 'taxonomy singular name', 'textdomain' ),
					'search_items'      => __( 'Teams', 'textdomain' ),
					'all_items'         => __( 'Teams', 'textdomain' ),
					'parent_item'       => __( 'Parent Team', 'textdomain' ),
					'parent_item_colon' => __( 'Parent Team:', 'textdomain' ),
					'edit_item'         => __( 'Edit Team', 'textdomain' ),
					'update_item'       => __( 'Update Team', 'textdomain' ),
					'add_new_item'      => __( 'Add New Team', 'textdomain' ),
					'new_item_name'     => __( 'New Team', 'textdomain' ),
					'menu_name'         => __( 'Teams', 'textdomain' ),
				),
				'hierarchical'      => FALSE,
				'show_ui'           => TRUE,
				'show_admin_column' => TRUE,
				'query_var'         => TRUE,
				'rewrite'           => array( 'slug' => 'team' ),
				'post_types'        => array( 'player' ),
			),

		);

		return $out;

	}

	/**
	 * Add our taxonomies.
	 */
	function register() {

		// Grab the taxonomies we defined above.
		$taxonomies = $this -> get_taxonomies();

		// For each taxonomy...
		foreach( $taxonomies as $slug => $tax ) {

			register_taxonomy( $slug, $tax['post_types'], $tax );										

		}
	
	}

}