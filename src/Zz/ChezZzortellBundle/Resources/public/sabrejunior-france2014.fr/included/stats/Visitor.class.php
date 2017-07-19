<?php
class Visitor
{
	protected $Manager;
	
	protected $ip;
	protected $idCookie;
	protected $idSession;
	protected $geoloc;
	protected $page;
	
	public function __construct ( VisitorManager $Manager ) {
		//Attribution de Manager
		$this->Manager = $Manager;
		
		//Attribution de ip
		$this->setIp ( /*$_SERVER["REMOTE_ADDR"]*/ '86.68.34.35' );
		
		//Attribution de idCookie
		if ( isset ( $_COOKIE['ID_COOKIE'] ) ) {
			$this->setIdCookie ( $_COOKIE['ID_COOKIE'] );
		} else {
			$cookieValue = $this->Manager->newIdCookie();
			setCookie ( 'ID_COOKIE', $cookieValue, time() + 365*24*3600, null, null, false, true );
			$this->setIdCookie ( $cookieValue );
		}
		
		//Attribution de idSession
		if ( isset ( $_SESSION['ID_SESSION'] ) ) {
			$this->setIdSession ( $_SESSION['ID_SESSION'] );
		} else {
			$sessionValue = $this->Manager->newIdSession();
			$_SESSION['ID_SESSION'] = $sessionValue;
			$this->setIdSession ( $sessionValue );
		}
		
		$this->updatePage ();
		
		$this->sendDatas ();
	}
	
	public function ip () {
		return $this->ip;
	}
	
	public function idCookie () {
		return $this->idCookie;
	}
	
	public function idSession () {
		return $this->idSession;
	}
	
	public function geoloc () {
		return $this->geoloc;
	}
	
	public function page () {
		return $this->page;
	}
	
	protected function setIp ( $ip ) {
		if ( filter_var($ip, FILTER_VALIDATE_IP) ) {
			$this->ip = $ip;
			$this->updateGeoloc ();
		}
	}
	
	protected function setIdCookie ( $idCookie ) {
		$this->idCookie = (int) $idCookie;
	}
	
	protected function setIdSession ( $idSession ) {
		$this->idSession = (int) $idSession;
	}
	
	protected function updateGeoloc () {
		include("included/stats/geoloc/geoipcity.inc");
		include("included/stats/geoloc/geoipregionvars.php");
		
		$gi = geoip_open( realpath("included/stats/geoloc/GeoLiteCity.dat"), GEOIP_STANDARD );
		$record = geoip_record_by_addr( $gi, $this->ip() );
		
		$this->geoloc = $record->country_name . " - " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . " - " . $record->postal_code . " - " . $record->city;
		
		geoip_close($gi);
	}
	
	protected function updatePage () {
		$this->page = $_SERVER['PHP_SELF'] . ( isset ( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' );
	}
	
	protected function sendDatas () {
		$this->Manager->receiveDatas ( $this );
	}
}