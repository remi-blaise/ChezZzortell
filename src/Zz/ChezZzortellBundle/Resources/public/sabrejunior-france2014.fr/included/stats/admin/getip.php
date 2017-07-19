<?php
include_once ('../DbConnection.class.php');
include_once ('../StatsBDD.class.php');
$statsBDD = new StatsBDD ( DbConnection::newDb() );

	$ipTable = $statsBDD->getTable ( 'ip' );
	$return = [];
	foreach ( $ipTable as $entry ) {
		$return[] = $entry['ip'];
	}
	echo json_encode ($return);