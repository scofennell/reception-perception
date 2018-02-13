<?php

/**
 * A class for managing plugin dependencies and loading the plugin.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */
namespace Reception_Perception;

class Bootstrap {

	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'create' ), 100 );

	}

	/**
	 * Instantiate and store a bunch of our plugin classes.
	 */
	function create() {

		$reception_perception = get_reception_perception();

		$reception_perception -> meta                  = new Meta;
		$reception_perception -> subsite_settings      = new SubsiteSettings;
		$reception_perception -> post_types            = new PostTypes;
		$reception_perception -> taxonomies            = new Taxonomies;
		$reception_perception -> post_meta_fields      = new PostMetaFields;		
		$reception_perception -> config                = new Config;
		$reception_perception -> enqueue               = new Enqueue;		
		$reception_perception -> subsite_control_panel = new SubsiteControlPanel;
		$reception_perception -> post_meta_box         = new PostMetaBox;
		$reception_perception -> post_content          = new PostContent;		

		return $reception_perception;

	}

}