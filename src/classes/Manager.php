<?php
// Début de session
// include_once '../src/inc/globals.php';
if (!isset($_SESSION)) { session_start(); }

function secureVar($var) {
	$var = strip_tags(clean_string($var));
	htmlspecialchars($var);
}

/** Classe 'Manager'
	*	@param $_bdd de type PDO
*/
class Manager {
	private $_bdd;

	/** Méthode appelée si un objet est instancié avec des paramètres
		*	@param $données de type tableau
	*/
	public function __construct($bdd) { $this->setDb($bdd); }

	// Setter
	public function setDb($bdd) { $this->_bdd = new PDO("mysql:host=localhost; dbname=".$bdd."", "root", ""); }

	/** Méthode d'ajout d'un utilisateur
		*	@param $user de type User
	*/
	public function addUser(User $user) {
		$query = $this->_bdd->prepare("SELECT * FROM users WHERE nom = ? AND prenom = ? AND mdp = ? OR email = ?");
		$query->execute([
			$user->getNom(),
			$user->getPrenom(),
			$user->getMdp(),
			$user->getEmail()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$_SESSION['info'] = "Cet utilisateur existe déjà";
			header('location: '.SIGNUP);
			return 0;
		} else {
			$query = $this->_bdd->prepare("INSERT INTO users(nom, prenom, email, oldMdp, newMdp, role) VALUES (?,?,?,?,?,'M')");
			$query->execute([
				$user->getNom(),
				$user->getPrenom(),
				$user->getEmail(),
				$user->getMdp(),
				$user->getMdp()
			]);
			$_SESSION['info'] = "Inscription réussie !";
			header('location: '.SIGNIN);
			return 1;
		}
	}

	public function book() {
		$query = $this->_bdd->prepare("INSERT INTO `bookings` (`id`, `code`, `hasHotel`, `nbAdults`, `nbChildren`, `userId`, `flightId`, `book_reg_date`, `lastUpdate`) VALUES (NULL, 'REF-0000000000', '0', '1', '0', ?, '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
		$query->execute([
			$_COOKIE['user']
		]);
		$_SESSION['info'] = "Réservation réussie !";
		header('location: '.BOOKING.'list.php');
		return 1;

	}

	/** Méthode de modification d'un utilisateur
		*	@param $user de type User
	*/
	public function modUser(User $user) {
		$query = $this->_bdd->prepare("SELECT * FROM users WHERE nom = ? AND prenom = ? AND mdp = ?");
		$query->execute([
			$user->getNom(),
			$user->getPrenom(),
			$user->getMdp()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$query = $this->_bdd->prepare("UPDATE `users` SET mdp = ? WHERE nom = ? AND prenom = ?");
			$query->execute([
				$user->getMdp(),
				$user->getNom(),
				$user->getPrenom()
			]);
			$_SESSION['info'] = "Utilisateur modifié";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 1;
		} else {
			$_SESSION['info'] = "Utilisateur non existant";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 0;
		}
	}

	/** Méthode de suppression d'un utilisateur
		*	@param $user de type User
	*/
	public function delUser(User $user) {
		$query = $this->_bdd->prepare("SELECT nom, prenom FROM users WHERE nom = ? AND prenom = ?");
		$query->execute([
			$user->getNom(),
			$user->getPrenom()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$query = $this->_bdd->prepare("DELETE FROM `users` WHERE nom = ? AND prenom = ?");
			$query->execute([
				$user->getNom(),
				$user->getPrenom()
			]);
			$_SESSION['info'] = "User modifié";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 1;
		} else {
			$_SESSION['info'] = "User non existant";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 0;
		}
	}

	/** Méthode de connexion d'un utilisateur
		*	@param $user de type User
	*/
	public function signUser(User $user) {
		if(isset($_COOKIE['user'])) {
		    $_SESSION['info'] .= '<h6>Déjà connecté</h6>';
		    header('location: index.php');
		} else {

		    $query = $this->_bdd->prepare("SELECT * FROM `users` WHERE `email` = ? AND `mdp` = ?;");
		    $query->execute([
		        $user->getEmail(),
		        $user->getMdp()
		    ]);
		    $result = $query->fetch(PDO::FETCH_ASSOC);

		    if ($result) {
		        setcookie('user', $result['id'], time() + 86400*10, '/');
		        setcookie('nom', $result['nom'], time() + 86400*10, '/');
		        setcookie('prenom', $result['prenom'], time() + 86400*10, '/');
		        setcookie('mdp', $result['mdp'], time() + 86400*10, '/');
		        setcookie('email', $result['email'], time() + 86400*10, '/');
		        setcookie('role', $result['role'], time() + 86400*10, '/');
		        $_SESSION['info'] = "Bienvenue ".$_COOKIE['nom']." ".$_COOKIE['prenom'];
		        setcookie('before', 'none', time() + 86400*10, '/');
		        setcookie('after', 'block', time() + 86400*10, '/');

		        $this->_bdd = null;
		        header('location: ../index.php');

		    } else {
		        $_SESSION['info'] = 'Erreur de connexion';
		        $this->_bdd = null;
		        header('location: index.php');
		    }
		}
	}

	/** Méthodes de déconnexion d'un utilisateur
		*	@param $user de type User
	*/
	public function signOut() {
    	// Date d'expiration des cookies dans le passé
    	setcookie('PHPSESSID', 0, time() - 3600, '/');
    	setcookie('user', 0, time() - 3600, '/');
    	setcookie('nom', 0, time() - 3600, '/');
    	setcookie('prenom', 0, time() - 3600, '/');
    	setcookie('mdp', 0, time() - 3600, '/');
    	setcookie('email', 0, time() - 3600, '/');
    	setcookie('role', 0, time() - 3600, '/');

    	setcookie('before', 'block', time() + 86400*10, '/');
    	setcookie('after', 'none', time() + 86400*10, '/');

    	// "Désactivation" des cookies en cas de doute
    	unset($_COOKIE['PHPSESSID']);
    	unset($_COOKIE['user']);
    	unset($_COOKIE['nom']);
    	unset($_COOKIE['prenom']);
    	unset($_COOKIE['mdp']);
    	unset($_COOKIE['email']);
    	unset($_COOKIE['role']);

    	// Redirection vers la page d'accueil
    	header('location: http://localhost/alumnus/index.php');
    }

	public function goToSi() {
    	// Date d'expiration des cookies dans le passé
    	setcookie('PHPSESSID', 0, time() - 3600, '/');
    	setcookie('user', 0, time() - 3600, '/');
    	setcookie('nom', 0, time() - 3600, '/');
    	setcookie('prenom', 0, time() - 3600, '/');
    	setcookie('mdp', 0, time() - 3600, '/');
    	setcookie('email', 0, time() - 3600, '/');
    	setcookie('role', 0, time() - 3600, '/');

    	setcookie('before', 'block', time() + 86400*10, '/');
    	setcookie('after', 'none', time() + 86400*10, '/');

    	// "Désactivation" des cookies en cas de doute
    	unset($_COOKIE['PHPSESSID']);
    	unset($_COOKIE['user']);
    	unset($_COOKIE['nom']);
    	unset($_COOKIE['prenom']);
    	unset($_COOKIE['mdp']);
    	unset($_COOKIE['email']);
    	unset($_COOKIE['role']);

    	// Redirection vers la page d'accueil
    	header('location: http://localhost/alumnus/temp.php?signin');
    }

    public function goToSu() {
    	// Date d'expiration des cookies dans le passé
    	setcookie('PHPSESSID', 0, time() - 3600, '/');
    	setcookie('user', 0, time() - 3600, '/');
    	setcookie('nom', 0, time() - 3600, '/');
    	setcookie('prenom', 0, time() - 3600, '/');
    	setcookie('mdp', 0, time() - 3600, '/');
    	setcookie('email', 0, time() - 3600, '/');
    	setcookie('role', 0, time() - 3600, '/');

    	setcookie('before', 'block', time() + 86400*10, '/');
    	setcookie('after', 'none', time() + 86400*10, '/');

    	// "Désactivation" des cookies en cas de doute
    	unset($_COOKIE['PHPSESSID']);
    	unset($_COOKIE['user']);
    	unset($_COOKIE['nom']);
    	unset($_COOKIE['prenom']);
    	unset($_COOKIE['mdp']);
    	unset($_COOKIE['email']);
    	unset($_COOKIE['role']);

    	// Redirection vers la page d'accueil
    	header('location: http://localhost/alumnus/temp.php?signup');
    }

    public function setTable() {
		$raw_results = $this->_bdd->query("SHOW COLUMNS FROM `".$_GET['t']."`");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				echo "<tr>";
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					echo "<th>".$results['Field']."</th>";
				}
				echo "</tr>";
			}
		}
	}

    public function showTable() {
    	$raw_results2 = $this->_bdd->query("SHOW COLUMNS FROM `".$_GET['t']."`");
		if (isset($raw_results2)){
			if ($raw_results2->rowCount()) {
				while($results2 = $raw_results2->fetch(PDO::FETCH_ASSOC)) {
					$cols[] = $results2['Field'];
				}
			}
		}
		$raw_results = $this->_bdd->query("SELECT * FROM `".$_GET['t']."`");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>";
					foreach ($cols as $col => $cell) {
						echo "<td>".$results[$cell]."</td>";
					}
					echo "</tr>";
				}
			}
		}
	}

	public function showPlaces() {
		// Affiche tous les lieux qui sont des villes de départ ou d'arrivée
		$raw_results = $this->_bdd->query("SELECT * FROM `places` WHERE place IN (SELECT vDep FROM `flights` UNION SELECT vArr FROM `flights`)");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					// Affiche chaque lieu sous la forme '<option>Lieu</option>'
					echo "<option value='".$results['id']."'>".$results['place']."</option>";
				}
			}
		}
	}

	public function showFlights() {
		//$place = (isset($_GET['place'])) ? $_GET['place'] : 'New York' ;
		$raw_results = $this->_bdd->query("SELECT * FROM `flights`");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					// Affiche chaque vol sous la forme '<option>Départ / Arrivée</option>'
					echo "<option value='".$results['id']."'>".$results['vDep']." / ".$results['vArr']."</option>";
				}
			}
		}
	}

	public function showBookings2($userId) {
		//$place = (isset($_GET['place'])) ? $_GET['place'] : 'New York' ;
		$raw_results = $this->_bdd->query("SELECT * FROM `flights`");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					// Affiche chaque vol sous la forme '<option>Départ / Arrivée</option>'
					echo "<h1>Vol :".$results['vDep']." / ".$results['vArr']."</h1>";
				}
			}
		}
	}

	public function showBookings($userId) {
		$raw_results = $this->_bdd->prepare("SELECT * FROM `bookings` INNER JOIN `flights` ON `bookings`.`flightId` = `flights`.`id` WHERE `bookings`.`userId` = ?");
		$raw_results->execute([$userId]);

		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					$price = $results['nbAdults'] * 300 + $results['nbChildren'] * 150;
					echo "<div class='card text-white bg-warning mb-3' style='width: 670px'>
							<div class='card-body'>
								<h5 class='card-title'>Vol : ".$results['vDep']." / ".$results['vArr']."</h5>
								<p class='card-text'>Départ à : ".$results['hDep']."</p>
								<p class='card-text'>Arrivée à : ".$results['hArr']."</p>
								<p class='card-text'>Nombre d'adultes : ".$results['nbAdults']."</p>
								<p class='card-text'>Nombre d'enfants : ".$results['nbChildren']."</p>
								<p class='card-text'>N° de l'avion (0 ou 1) : ".$results['numav']."</p>
								<p class='card-text'>Hôtel réservé (0 ou 1) : ".$results['hasHotel']."</p>
								<p class='card-text'>Date de réservation : ".$results['lastUpdate']."</p>
								<p class='card-text'>Prix à payer sur place : ".$price." €</p>
							</div>
							<div class='card-footer'>
								<small class='text-muted'>Référence : ".$results['code']."</small>
							</div>
	    				</div>";
				}
			} else
				echo "<div class='card text-white bg-dark mb-3' style='display: inline-flex'>
						<div class='card-body'>
							<h5 class='card-title'>Aucune réservation <i class='fa fa-times' aria-hidden='true'></i></h5>
						</div>
					</div>";
		}
	}

	public function getPlaceId() {
		$place = (isset($_GET['place'])) ? $_GET['place'] : 'New York' ;
		$raw_results = $this->_bdd->query("SELECT id FROM `flights` WHERE id = '".$place."'");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					// Affiche chaque vol sous la forme '<option>Départ / Arrivée</option>'
					echo $results['id'];
				}
			}
		}
	}

	public function getPlace() {
		$place = (isset($_GET['place'])) ? $_GET['place'] : 'New York' ;
		$raw_results = $this->_bdd->query("SELECT place FROM `flights` WHERE id = '".$place."'");
		if (isset($raw_results)){
			if ($raw_results->rowCount()) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					// Affiche chaque vol sous la forme '<option>Départ / Arrivée</option>'
					echo $results['place'];
				}
			}
		}
	}

	public function getCountUsers() {
		$raw_results = $this->_bdd->query("SELECT COUNT(*) AS 'cnt' FROM `users`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					return $results['cnt'];
				}
			}
		}
	}

	public function getCountBookings() {
		$raw_results = $this->_bdd->query("SELECT COUNT(*) AS 'cnt' FROM `bookings`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					return $results['cnt'];
				}
			}
		}
	}

	public function getCountFlights() {
		$raw_results = $this->_bdd->query("SELECT COUNT(*) AS 'cnt' FROM `flights`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					return $results['cnt'];
				}
			}
		}
	}

	public function getCountPlaces() {
		$raw_results = $this->_bdd->query("SELECT COUNT(*) AS 'cnt' FROM `places`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					return $results['cnt'];
				}
			}
		}
	}

	public function getCountPlanes() {
		$raw_results = $this->_bdd->query("SELECT COUNT(*) AS 'cnt' FROM `planes`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					return $results['cnt'];
				}
			}
		}
	}

	public function getLastUpdate() {
		$raw_results = $this->_bdd->query("SELECT MAX(lastUpdate) AS 'last' FROM `".$_GET['t']."`");
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					$timestamp = str_replace(array('-', ':'),' ', $results['last']);
					list($y, $m, $d, $h, $i, $s) = explode(' ', $timestamp);
					return $timestamp = $h.':'.$i.':'.$s.' le '.$d.'/'.$m.'/'.$y;
					// return $results['last'];
				}
			}
		}
	}
}
?>
