<?php

/**
 * A class for getting info about the configuration of our plugin.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */

namespace Reception_Perception;

class Config {

	function __construct() {

		$reception_perception     = get_reception_perception();
		$this -> subsite_settings = $reception_perception -> subsite_settings;

	}	

}