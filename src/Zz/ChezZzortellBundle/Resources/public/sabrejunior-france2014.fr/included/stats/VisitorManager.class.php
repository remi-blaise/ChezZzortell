<?php
class VisitorManager
{
	protected $db;
	
	public function __construct ( PDO $db ) {
		$this->db = $db;
	}
	
	public function newIdCookie () {
		$response = $this->db->query ( 'SELECT MAX(idCookie) AS max_id FROM idcookie' ) or die(print_r($this->db->errorInfo()));
		$return = $response->fetch()['max_id'] + 1;
		$response->closeCursor();
		return $return;
	}
	
	public function newIdSession () {
		$response = $this->db->query ( 'SELECT MAX(idSession) AS max_id FROM idsession' ) or die(print_r($this->db->errorInfo()));
		$return = $response->fetch()['max_id'] + 1;
		$response->closeCursor();
		return $return;
	}
	
	public function receiveDatas ( Visitor $Visitor ) {
		//Table ip
		//On vérifie si l'ip est déjà dans la table
		$req = $this->db->prepare ( 'SELECT ip, idCookieArray FROM ip WHERE ip = :ip' );
		$req->execute ( array ( 'ip' => $Visitor->ip() ) ) or die(print_r($req->errorInfo()));
		$donnees = $req->fetch();
		$rowCount = $req->rowCount();
		$req->closeCursor ();
		
		if ( $rowCount === 1 ) { //Si l'ip existe déjà
			//On récupère idCookieArray
			$idCookieArray = unserialize ( $donnees['idCookieArray'] );
			//Si l'idSession n'est pas dans idSessionArray
			if ( !in_array  ( $Visitor->idCookie(), $idCookieArray ) ) {
				//On ajoute l'idCookie à idCookieArray
				$idCookieArray [] = $Visitor->idCookie();
				//On update le champs
				$req = $this->db->prepare ( 'UPDATE ip SET idCookieArray = :idCookieArray WHERE ip = :ip' );
				$req->execute ( array ( 'ip' => $Visitor->ip(), 'idCookieArray' => serialize ($idCookieArray) ) ) or die(print_r($req->errorInfo()));
				$donnees = $req->fetch();
				$req->closeCursor ();
			}
		} else {
			//On insert l'entrée
			$req = $this->db->prepare ( 'INSERT INTO ip (ip, geolocInfos, idCookieArray) VALUES (:ip, :geolocInfos, :idCookieArray)' );
			$req->execute ( array ( 'ip' => $Visitor->ip(), 'geolocInfos' => $Visitor->geoloc(), 'idCookieArray' => serialize ( array ($Visitor->idCookie()) ) ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		}
		
		//Table idcookie
		$req = $this->db->prepare ( 'SELECT idCookie, idSessionArray FROM idcookie WHERE idCookie = :idCookie' );
		$req->execute ( array ( 'idCookie' => $Visitor->idCookie() ) ) or die(print_r($req->errorInfo()));
		$donnees = $req->fetch();
		$rowCount = $req->rowCount();
		$req->closeCursor ();
		
		if ( $rowCount === 1 ) { //Si l'idCookie existe déjà
			//On récupère idSessionArray
			$idSessionArray = unserialize ( $donnees['idSessionArray'] );
			//Si l'idSession n'est pas dans idSessionArray
			if ( !in_array ( $Visitor->idSession(), $idSessionArray ) ) {
				//On ajoute l'idSession à idSessionArray
				$idSessionArray [] = $Visitor->idSession();
				//On update le champs
				$req = $this->db->prepare ( 'UPDATE idcookie SET idSessionArray = :idSessionArray WHERE idCookie = :idCookie' );
				$req->execute ( array ( 'idCookie' => $Visitor->idCookie(), 'idSessionArray' => serialize ($idSessionArray) ) ) or die(print_r($req->errorInfo()));
				$donnees = $req->fetch();
				$req->closeCursor ();
			}
		} else {
			//On insert l'entrée
			$req = $this->db->prepare ( 'INSERT INTO idcookie (idCookie, idSessionArray) VALUES (:idCookie, :idSessionArray)' );
			$req->execute ( array ( 'idCookie' => $Visitor->idCookie(), 'idSessionArray' => serialize ( array ($Visitor->idSession()) ) ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		}
		
		//Table idsession
		$req = $this->db->prepare ( 'SELECT idSession, vues FROM idsession WHERE idSession = :idSession' );
		$req->execute ( array ( 'idSession' => $Visitor->idSession() ) ) or die(print_r($req->errorInfo()));
		$donnees = $req->fetch();
		$rowCount = $req->rowCount();
		$req->closeCursor ();
		
		if ( $rowCount === 1 ) { //Si l'idSession existe déjà
			//On récupère vues
			$vues = $donnees['vues'];
			//On incrémente vues
			$vues++;
			//On update le champs
			$req = $this->db->prepare ( 'UPDATE idsession SET vues = :vues WHERE idSession = :idSession' );
			$req->execute ( array ( 'idSession' => $Visitor->idSession(), 'vues' => $vues ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		} else {
			//On insert l'entrée
			$req = $this->db->prepare ( 'INSERT INTO idsession (idSession, vues) VALUES (:idSession, :vues)' );
			$req->execute ( array ( 'idSession' => $Visitor->idSession(), 'vues' => 1 ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		}
		
		//Table vuespages
		$req = $this->db->prepare ( 'SELECT name, vues FROM pages WHERE name = :page' );
		$req->execute ( array ( 'page' => $Visitor->page() ) ) or die(print_r($req->errorInfo()));
		$donnees = $req->fetch();
		$rowCount = $req->rowCount();
		$req->closeCursor ();
		
		if ( $rowCount === 1 ) { //Si la page existe déjà
			//On récupère vues
			$vues = $donnees['vues'];
			//On incrémente vues
			$vues++;
			//On update le champs
			$req = $this->db->prepare ( 'UPDATE pages SET vues = :vues WHERE name = :page' );
			$req->execute ( array ( 'page' => $Visitor->page(), 'vues' => $vues ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		} else {
			//On insert l'entrée
			$req = $this->db->prepare ( 'INSERT INTO pages (name, vues) VALUES (:page, :vues)' );
			$req->execute ( array ( 'page' => $Visitor->page(), 'vues' => 1 ) ) or die(print_r($req->errorInfo()));
			$donnees = $req->fetch();
			$req->closeCursor ();
		}
	}
}