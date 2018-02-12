<?php

/**
 * A class for importing players from a csv url.
 *
 * @package WordPress
 * @subpackage Reception_Perception
 * @since Reception_Perception 0.1
 */
namespace Reception_Perception;

class Import {

	public function __construct( $url ) {

		$this -> url = $url;

	}

	function run() {

		$out = array();

		$url = $this -> url;

		$args = array(
			'timeout' => 60,
		);

		$call = wp_remote_get( $url, $args );

		$body = $call['body'];

		$str_getcsv = str_getcsv( $body );

		$rows = $this -> parse_csv( $body );

		$out = $this -> create_posts( $rows );

		return $out;

	}

	function parse_csv ( $csv_string, $delimiter = ",", $skip_empty_lines = true, $trim_fields = true ) {
	    $enc = preg_replace('/(?<!")""/', '!!Q!!', $csv_string);
	    $enc = preg_replace_callback(
	        '/"(.*?)"/s',
	        function ($field) {
	            return urlencode(utf8_encode($field[1]));
	        },
	        $enc
	    );
	    $lines = preg_split($skip_empty_lines ? ($trim_fields ? '/( *\R)+/s' : '/\R+/s') : '/\R/s', $enc);
	    return array_map(
	        function ($line) use ($delimiter, $trim_fields) {
	            $fields = $trim_fields ? array_map('trim', explode($delimiter, $line)) : explode($delimiter, $line);
	            return array_map(
	                function ($field) {
	                    return str_replace('!!Q!!', '"', utf8_decode(urldecode($field)));
	                },
	                $fields
	            );
	        },
	        $lines
	    );
	}

	function create_posts( $rows ) {

		$header = array_shift( $rows );

		$players = $rows;

	}

}