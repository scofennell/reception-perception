<?php

/**
 * A boilerplate for starting new plugins.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 * 
 * Plugin Name: Reception Perception
 * Plugin URI: https://www.lexblog.com
 * Description: A plugin for perceiving receptions.
 * Author: Scott Fennell
 * Version: 0.1
 * Author URI: http://www.scottfennell.org
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
	
// Peace out if you're trying to access this up front.
if( ! defined( 'ABSPATH' ) ) { exit; }

// Watch out for plugin naming collisions.
if( defined( 'RECEPTION_PERCEPTION' ) ) { exit; }
if( isset( $reception_perception ) ) { exit; }

// A slug for our plugin.
define( 'RECEPTION_PERCEPTION', 'Reception_Perception' );

// Establish a value for plugin version to bust file caches.
define( 'RECEPTION_PERCEPTION_VERSION', '0.1' );

// A constant to define the paths to our plugin folders.
define( 'RECEPTION_PERCEPTION_FILE', __FILE__ );
define( 'RECEPTION_PERCEPTION_PATH', trailingslashit( plugin_dir_path( RECEPTION_PERCEPTION_FILE ) ) );

// A constant to define the urls to our plugin folders.
define( 'RECEPTION_PERCEPTION_URL', trailingslashit( plugin_dir_url( RECEPTION_PERCEPTION_FILE ) ) );

// Our master plugin object, which will own instances of various classes in our plugin.
$reception_perception  = new stdClass();
$reception_perception -> bootstrap = RECEPTION_PERCEPTION . '\Bootstrap';

// Register an autoloader.
require_once( RECEPTION_PERCEPTION_PATH . 'autoload.php' );

// Execute the plugin code!
new $reception_perception -> bootstrap;