<?php

// defines
define( 'LIBRARY_BASEPATH', ( dirname( __FILE__ ) . '/' ) );

// register auto-loaders
spl_autoload_register( function( $class_name ) {

	// sanitise for namespace classes
	$class_name = str_replace( '\\', '/', $class_name );

	// class files array
	$class_files[] = LIBRARY_BASEPATH . strtolower( $class_name ) . '.class.php';
	$class_files[] = LIBRARY_BASEPATH . strtolower( $class_name ) . '.interface.php';


	foreach ( $class_files as $class_file ) {
		if ( is_file( $class_file ) ) {
			require_once ( $class_file );
			break;
		}
	}

});

