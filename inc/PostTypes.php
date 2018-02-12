<?php

/**
 * A class for creating custom post types.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class PostTypes {

	public function __construct() {

		// Add our post types.
		add_action( 'init', array( $this, 'register' ), 10 );

	}

	/**
	 * Define all of our post types in an array.
	 * 
	 * @return array All of our post types.
	 */
	public function get_post_types() {

		$out = array(

			// The ID for this post type.
			'player' => array(
				
				'labels'             => array(
					'name'               => _x( 'Players', 'post type general name', 'rp' ),
					'singular_name'      => _x( 'Player', 'post type singular name', 'rp' ),
					'menu_name'          => _x( 'Players', 'admin menu', 'rp' ),
					'name_admin_bar'     => _x( 'Player', 'add new on admin bar', 'rp' ),
					'add_new'            => _x( 'Add New', 'Player', 'rp' ),
					'add_new_item'       => __( 'Add New Player', 'rp' ),
					'new_item'           => __( 'New Player', 'rp' ),
					'edit_item'          => __( 'Edit Player', 'rp' ),
					'view_item'          => __( 'View Player', 'rp' ),
					'all_items'          => __( 'All Players', 'rp' ),
					'search_items'       => __( 'Search Players', 'rp' ),
					'parent_item_colon'  => __( 'Parent Players:', 'rp' ),
					'not_found'          => __( 'No Players found.', 'rp' ),
					'not_found_in_trash' => __( 'No Players found in Trash.', 'rp' ),
				),
				'description'        => __( 'Players.', 'rp' ),
				'public'             => TRUE,
				'publicly_queryable' => TRUE,
				'show_ui'            => TRUE,
				'show_in_menu'       => TRUE,
				'query_var'          => TRUE,
				'rewrite'            => TRUE,
				'capability_type'    => 'post',
				'has_archive'        => TRUE,
				'hierarchical'       => FALSE,
				'menu_position'      => TRUE,
				'menu_icon'          => 'dashicons-universal-access-alt',
				'supports'           => array( 'title', 'editor', 'author', 'custom-fields' ),

			),										

		);

		return $out;

	}

	/**
	 * Add our post types.
	 */
	function register() {

		// Grab the post types we defined above.
		$post_types = $this -> get_post_types();

		// For each post type...
		foreach( $post_types as $slug => $post_type ) {

			register_post_type( $slug, $post_type );	

		}
	
	}

}