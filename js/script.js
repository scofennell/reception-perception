/**
 * Our plugin-wide JS file.
 *
 * @package WordPress
 * @subpackage Reception Perception
 * @since Reception Perception 0.1
 */

/**
 * A global object with members that any of our jQuery plugins can use.
 * 
 * @type {Object}
 */
var receptionPerception = {

	/**
	 * Grab the value of a url var.
	 * @param  {string} url    Any url.
	 * @param  {string} sParam The key for any url variable.
	 * @return {string} The value for sParam in url.
	 */
	getUrlParameter : function ( url, sParam ) {

		// Will hold the value of sParam if it's present in url.
		var out = '';
	 
	 	// Break the url apart at the query string.
		var array = url.split( '?' );

		// Grab the second half of the url.
		var queryStr = array[1];

		// Break the query string into key value pairs.
		var pairs = queryStr.split( '&' );

		// For each pair...
		jQuery( pairs ).each( function( k, v ) {

			// Break the pair into a key and a value.
			var pair = v.split( '=' );

			// If the key for this pair is what we're looking for...
			if( pair[0] == sParam ) {

				// Grab the value.
				out = pair[1];

			}

		});

		return out;

	},

};

/**
 * Our jQuery plugin for doing something.
 */
jQuery( window ).load( function() {

	// Start an options object that we'll pass when we use our jQuery plugin.
	var options = {};

	// Apply our plugin to our thing.
	jQuery( '.Reception_PerceptionGraphic-get' ).receptionPerceptionThing( options );

});

jQuery( document ).ready( function( $ ) {

	/**
	 * Define our jQuery plugin for doing things.
	 * 
	 * @param  {array}  options An array of options to pass to our plugin, documented above.
	 * @return {object} Returns the item that the plugin was applied to, making it chainable.
	 */
	$.fn.receptionPerceptionThing = function( options ) {

		// For each element to which our plugin is applied...
		return this.each( function() {

			// Save a reference to the thing, so that we may safely use "this" later.
			var that = this;

			var trigger = $( that ).find( '.Reception_PerceptionGraphic-get-trigger' );
			var target = $( that ).find( '.Reception_PerceptionGraphic-get-target' );

			$( trigger ).click( function( evt ) {
				evt.preventDefault();
				
				var el = $( target )[0];

				html2canvas( el ).then( function( canvas ) {

					var base64encodedstring = canvas.toDataURL( "image/jpeg", 1 );
					$( '<img>' ).attr( 'src', base64encodedstring ).hide().appendTo( that ).fadeIn();

				});
			
			});

			// Make our plugin chainable.
			return this;

		// End for each element to which our plugin is applied.
		});

	// End the definition of our plugin.
	};

}( jQuery ) );