<?php

namespace pulse;

class utils {

	public static function read_msg( $sock ) {

		$c      = null;
		$c_last = null;
		$msg    = null;

		while ( true ) {

			if ( ( $c = socket_read( $sock, 1 ) ) !== '' ) {

				if ( $c_last === "\r" ) {

					if ( $c === "\n" ) {
						$msg = $msg . $c;
						break;
					}

				}

				$msg    = $msg . $c;
				$c_last = $c;

			} else {
				// nothing read from the socket
				break;
			}

		}

		return trim( $msg );

	}


	public static function parse_msg( $msg ) {

		$data = array (
			'error' => 1
		);

		$segments = explode( '|', $msg, 2 );

		if ( count( $segments ) == 2 ) {

			list ( $type, $body ) = $segments;

			$t = new handlers\TelemetryHandler();
			$data = array_merge( $data, $t->parse( $body ) );

		}

		return $data;

	}

}


