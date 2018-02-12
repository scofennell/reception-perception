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

		global $rp;

		$rp -> meta                  = new Meta;
		$rp -> settings              = new Settings;
		$rp -> post_meta_fields      = new PostMetaFields;		
		$rp -> config                = new Config;
		$rp -> enqueue               = new Enqueue;		
		$rp -> subsite_control_panel = new SubsiteControlPanel;
		$rp -> post_meta_box         = new PostMetaBox;

		return $rp;

	}

}