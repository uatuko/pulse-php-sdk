<?php

namespace pulse\handlers;

require_once( 'interfaces.php' );


class TelemetryHandler implements HandlerInterface {

	public function parse( $body ) {

		$data     = array ( 'error' => 1 );
		$segments = explode( ',', $body );

		if ( count( $segments ) === 8 ) {

			$data['device_id']   = $segments[0];
			$data['vehicle_reg'] = $segments[1];
			$data['timestamp']   = $segments[2];
			$data['longitude']   = $segments[3];
			$data['latitude']    = $segments[4];
			$data['speed']       = $segments[5];
			$data['heading']     = $segments[6];
			$data['mileage']     = $segments[7];
			$data['error']       = 0;

		}

		return $data;

	}

}

