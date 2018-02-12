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

		global $rp;
		$this -> settings = $rp -> settings;

	}	

}