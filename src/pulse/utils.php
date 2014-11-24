<?php

namespace pulse;

function read_msg( $sock ) {

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

