<?php
abstract class DbConnection
{
	public static function newDb () {
		try {
			$db = new PDO ('mysql:host=localhost;dbname=sabrejunior-france2014.fr', 'root', '');
		} catch ( Exception $e ) {
			die ( 'Erreur : ' . $e->getMessage () );
		}
		
		return $db;
	}
}