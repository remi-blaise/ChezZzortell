<?php
class StatsBDD
{
	protected $db;
	
	public function __construct ( PDO $db ) {
		$this->db = $db;
	}
	
	public function getTable ( $table, $pChamps='' ) {
		if( is_array ( $pChamps ) ) {
			$i = 0;
			$champs = '';
			foreach ( $pChamps as $one ) {
				if ( $i > 0 ) {
					$champs .= ',';
				}
				$champs .= (string) $one;
				$i++;
			}
		} else {
			$champs = '*';
		}
		
		//On vérifie que la table existe
		$table = (string) $table;
		$req = $this->db->prepare ( 'SHOW TABLES LIKE :table' );
		$req->execute ( array ( 'table' => $table ) ) or die(print_r($req->errorInfo()));
		$exists = in_array ($table, $req->fetch());
		$req->closeCursor ();
		
		if ( $exists ) {
			$req = $this->db->query ( 'SELECT ' . $champs . ' FROM ' . $table ) or die(print_r($req->errorInfo()));
			$donnees = array ();
			while ( $fetch = $req->fetch() ) {
				$donnees[] = $fetch;
			}
			$req->closeCursor ();
			return $donnees;
		} else {
			return false;
		}
	}
	
	public function getNbEntries ( Array $tables ) {
		$nbEntries = array ();
		foreach ( $tables as $table ) {
			$table = (string) $table;
			$req = $this->db->query ( 'SELECT COUNT(*) AS nbEntries FROM ' . $table ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
			
			$nbEntries [$table] = $donnees ['nbEntries'];
		}
		return $nbEntries;
	}
	
	public function getSum ( $table, $champs ) {
		$champs = (string) $champs;
		$table = (string) $table;
		
		$req = $this->db->query ( 'SELECT SUM(' . $champs . ') AS sum FROM ' . $table ) or die(print_r($req->errorInfo()));
		$donnees = $req->fetch();
		$req->closeCursor ();
		
		return $donnees ['sum'];;
	}
}