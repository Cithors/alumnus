<?php
/** Classe 'Booking'
	*	@param $_code de type chaîne de caractères
	*	@param $_hasHotel de type booléen
	*	@param $_nbAdults de type nombre entier
	*	@param $_nbChildren de type nombre entier
	*	@param $_userId de type nombre entier
	*	@param $_placeId de type nombre entier
	*	@param $_flightId de type nombre entier
*/
class Booking {
	private $_code;
	private $_hasHotel;
	private $_nbAdults;
	private $_nbChildren;
	private $_userId;
	private $_flightId;

	/** Méthode appelée si un objet est instancié avec des paramètres
		*	@param $hasHotel de type booléen
		*	@param $nbAdults de type nombre entier
		*	@param $nbChildren de type nombre entier
		*	@param $placeId de type nombre entier
		*	@param $_flightId de type nombre entier
	*/
	public function __construct($hasHotel, $nbAdults, $nbChildren, $userId, $flightId) {
		if (func_num_args() != 5) {
			throw new Exception("La classe 'Booking' prend 5 arguments");
		}
		$this->setCode($hasHotel, $nbAdults, $nbChildren, $flightId);
		$this->setHasHotel($hasHotel);
		$this->setNbAdults($nbAdults);
		$this->setNbChildren($nbChildren);
		$this->setUserId($_COOKIE['user']);
		$this->setFlightId($flightId);
	}

	// 7 Setters
	public function setCode($hasHotel, $nbAdults, $nbChildren, $flightId) {
		$this->_code = 'REF-'.time().$flightId.$nbAdults.$nbChildren.$hasHotel;
	}

	public function setHasHotel($hasHotel) {
		if (!is_numeric($hasHotel) && ($hasHotel == 0 || $hasHotel == 1)) {
			throw new Exception('HasHotel : doit être un booléen');
			return;
		}

		$this->_hasHotel = $hasHotel;
	}

	public function setNbAdults($nbAdults) {
		if (!is_numeric($nbAdults)) {
			throw new Exception('NbAdults : doit être un nombre entier');
			return;
		}

		$this->_nbAdults = $nbAdults;
	}

	public function setNbChildren($nbChildren) {
		if (!is_numeric($nbChildren)) {
			throw new Exception('NbChildren : doit être un nombre entier');
			return;
		}

		$this->_nbChildren = $nbChildren;
	}

	public function setUserId($userId) {
		if (!isset($_COOKIE['user']) || $userId != $_COOKIE['user']) {
			throw new Exception("UserId : doit être la valeur du cookie 'user'");
			return;
		}

		$this->_userId = $_COOKIE['user'];
	}

	public function setFlightId($flightId) {
		if (!is_numeric($flightId)) {
			throw new Exception('FlightId : doit être un nombre entier');
			return;
		}

		$this->_flightId = $flightId;
	}

	// 7 Getters
	public function getCode() { return $this->_code; }
	public function getHasHotel() { return $this->_hasHotel; }
	public function getNbAdults() { return $this->_nbAdults; }
	public function getNbChildren() { return $this->_nbChildren; }
	public function getUserId() { return $this->_userId; }
	public function getFlightId() { return $this->_flightId; }

	public function setDb() {
		echo $bdd = new PDO('mysql:host=localhost; dbname=alumnus', 'root', '');
	}
}
?>
