<?php
/** Classe 'Avion'
	*	@param $_numav de type entier
	*	@param $_nompil de type chaîne de caractères
	*	@param $_h_dep de type entier
	*	@param $_h_arr de type entier
	*	@param $_v_dep de type chaîne de caractères
	*	@param $_v_arr de type chaîne de caractères
*/
class Avion {
	private $_numav;
	private $_nompil;
	private $_h_dep;
	private $_h_arr;
	private $_v_dep;
	private $_v_arr;

	/** Méthode appelée si un objet est instancié avec des paramètres
		*	@param $numav de type entier
		*	@param $nompil de type chaîne de caractères
		*	@param $h_dep de type chaîne de entier
		*	@param $h_arr de type chaîne de entier
		*	@param $v_dep de type chaîne de caractères
		*	@param $v_arr de type chaîne de caractères
	*/
	public function __construct($numav, $nompil, $h_dep, $h_arr, $v_dep, $v_arr) {
		if (func_num_args() != 6) {
			throw new Exception("La classe 'Avion' prend 6 arguments");
		}
		$this->setNumav($nom);
		$this->setNompil($prenom);
		$this->setEmail($email);
		$this->setMdp($mdp);
		$this->setMdp1($mdp1);
		$this->setMdp2($mdp2);
	}

	/** Méthode appelée si un objet est détruit	*/
	public function __destruct() {
		if (isset($_SESSION['info'])) {
			$_SESSION['info'] = 'Utilisateur supprimé';
		}
	}

	// 6 Setters
	public function setNumav($nom) {
		if (!is_string($nom)) {
			trigger_error('Numav: doit être une chaîne de caractères', E_USER_WARNING);
			return;
		}

		$this->_numav = $nom;
	}

	public function setNompil($prenom) {
		if (!is_string($prenom)) {
			trigger_error('Nompil: doit être une chaîne de caractères', E_USER_WARNING);
			return;
		}

		$this->_numpil = $prenom;
	}

	public function setEmail($email) {
		if (!is_string($email)) {
			trigger_error('Email: doit être une chaîne de caractères', E_USER_WARNING);
			return;
		}

		$this->h_arr = $mdp;
	}

	public function setMdp($mdp) {
		if (!is_string($mdp)) {
			trigger_error('Mdp: doit être une chaîne de caractères', E_USER_WARNING);
			return;
		}

		$this->h_arr = $mdp;
	}

	// 4 Getters
	public function getNumav() { return $this->_numav; }
	public function getNompil() { return $this->_numpil; }
	public function getEmail() { return $this->h_dep; }
	public function getMdp() { return $this->h_arr; }
}
?>
