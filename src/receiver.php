<?php

require_once( 'loader.php' );

echo "pulse message receiver, version 1.0.0\n";

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();

$address = '127.0.0.1';
$port    = 8765;


if ( ( $sock = socket_create( AF_INET, SOCK_STREAM, SOL_TCP ) ) === false ) {
	die( "socket_create() failed: " . socket_strerror( socket_last_error() ) . "\n" );
}

if ( socket_bind( $sock, $address, $port ) === false ) {
	die( "socket_bind() failed: " . socket_strerror( socket_last_error() ) . "\n" );
}

if ( socket_listen( $sock, 1 ) === false ) {
	die( "socket_listen() failed: " . socket_strerror( socket_last_error() ) . "\n" );
}


while ( true ) {

	if ( ( $m_sock = socket_accept( $sock ) ) === false ) {
		echo( "socket_accept() failed: " . socket_strerror( socket_last_error() ) . "\n" );
		break;
	}

	// read messages
	do {

		if ( $msg = \pulse\utils::read_msg( $m_sock ) ) {

			// echo( "msg: " . $msg . "\n" );

			$data = \pulse\utils::parse_msg( $msg );

			if (! $data['error'] ) {
				echo( json_encode( $data ) . "\n" );
			} else {
				echo( "failed to parse message\n" );
			}

		} else {
			echo( "msg not received\n" );
		}

	} while ( $msg != '' );

	socket_close( $m_sock );

}

