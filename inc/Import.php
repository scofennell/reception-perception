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

		$rows = $this -> parse_csv( $body );

		$out = $this -> create_posts( $rows );

		return $out;

	}

	function parse_csv ( $body ) {

		$out = array();

		$fp = tmpfile();
		fwrite( $fp, $body );
		rewind( $fp );
		while( ( $row = fgetcsv( $fp, 0 ) ) !== FALSE ) {
			$rows[] = $row;
		}

		fclose( $fp );

		$header_cells = array_shift( $rows );

		foreach( $rows as $row ) {

			$row_i = 0;

			$row_out = array();

			foreach( $header_cells as $header ) {

				$row_out[ $header ] = $row[ $row_i ];

				$row_i++;

			}

			$out[] = $row_out;

		}


		return $out;

	}

	function create_posts( $rows ) {

		$players = $rows;

		foreach( $players as $player ) {

			$team = $player['bio-team'];
			$ln = $player['bio-last_name'];
			$fn = $player['bio-first_name'];
			$post_title = wp_kses_post( "$ln, $fn ($team)" );
			$post_exists = post_exists( $post_title );
			if( $post_exists ) { continue; }

			$post_meta = array();
			foreach( $player as $k => $v ) {
				$post_meta[ RECEPTION_PERCEPTION . "-$k" ] = $v;
			}

			$post_data = array(
				'post_type'   => 'player',
				'post_title'  => $post_title,
				'post_status' => 'publish',
				'tax_input'   => array( 'team' => $team ),
				'meta_input'  => $post_meta,
			);

			$post_id = wp_insert_post( $post_data );

			$out[] = $post_id;

		}

		return $out;

	}

}