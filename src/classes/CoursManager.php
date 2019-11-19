<?php
session_start();

class CoursManager {
	private $_bdd;

	public function __construct($bdd) { $this->setDb($bdd); }

	// Setter
	public function setDb($bdd) {
		$this->_bdd = new PDO("mysql:host=localhost; dbname=".$bdd."", "root", "");
		$this->_bdd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
	}

	// Autres Méthodes
	public function addCours(Cours $cours) {
		$query = $this->_bdd->prepare("SELECT prof_id, matiere, contenu FROM cours WHERE prof_id = ? AND matiere = ? OR contenu = ?");
		$query->execute([
			$cours->getProfId(),
			$cours->getMatiere(),
			$cours->getContenu()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$_SESSION['info'] = "Cours déjà existant";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 0;
		} else {
			$query = $this->_bdd->prepare("INSERT INTO `cours`(`prof_id`, `matiere`, `classe_e`, `contenu`) VALUES (?,?,?,?)");
			$query->execute([
				$cours->getProfId(),
				$cours->getMatiere(),
				$cours->getClasse(),
				$cours->getContenu()
			]);
			$_SESSION['info'] = "Cours ajouté";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 1;
		}
	}

	public function modCours(Cours $cours) {
		$query = $this->_bdd->prepare("SELECT prof_id, matiere FROM cours WHERE prof_id = ? AND matiere = ?");
		$query->execute([
			$cours->getProfId(),
			$cours->getMatiere()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$query = $this->_bdd->prepare("UPDATE `cours` SET contenu = ? WHERE prof_id = ? AND matiere = ?");
			$query->execute([
				$cours->getContenu(),
				$cours->getProfId(),
				$cours->getMatiere()
			]);
			$_SESSION['info'] = "Cours modifié";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 1;
		} else {
			$_SESSION['info'] = "Cours non existant";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 0;
		}
	}

	public function delCours(Cours $cours) {
		$query = $this->_bdd->prepare("SELECT prof_id, matiere FROM cours WHERE prof_id = ? AND matiere = ?");
		$query->execute([
			$cours->getProfId(),
			$cours->getMatiere()
		]);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($query->rowCount()) {
			$query = $this->_bdd->prepare("DELETE FROM `cours` WHERE prof_id = ? AND matiere = ?");
			$query->execute([
				$cours->getProfId(),
				$cours->getMatiere()
			]);
			$_SESSION['info'] = "Cours supprimé";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 1;
		} else {
			$_SESSION['info'] = "Cours non existant";
			echo "<script>alert('".$_SESSION['info']."')</script>";
			header('location: dashboard.php');
			return 0;
		}
	}

	public function showCours($matiereId, $nomClasse) {
		$num = 0;
		$raw_results = $this->_bdd->prepare("SELECT `cours`.`matiere`, `contenu`, `professeurs`.`nom_p` FROM `cours` INNER JOIN `professeurs` ON `cours`.`prof_id` = `professeurs`.`id` INNER JOIN `classes` ON `cours`.`classe_id` = `classes`.`id` WHERE `prof_id` = ? AND `nom_classe` = ?;");
		$raw_results->execute([$matiereId, $nomClasse]);
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='card text-white bg-dark mb-3'>
							<div class='card-body'>
								<h5 class='card-title'>".$results['matiere']."</h5>
								<p class='card-text'>".$results['contenu']."</p>
							</div>
							<div class='card-footer'>
								<small class='text-muted'>De Professeur ".$results['nom_p']."</small>
	    				</div>";
					$num += 1;
					echo "<script>document.getElementById('info').style.display = 'inline-flex';</script>";
					echo "<script>document.getElementById('num').innerHTML =".$num.";</script>";
				}
			} else
				echo "<div class='card text-white bg-dark mb-3' style='display: inline-flex'>
						<div class='card-body'>
						<h5 class='card-title'>Rien pour l'instant <i class='fa fa-heart' aria-hidden='true'></i></h5>
					</div>";
		}
	}

	public function showFormation($formationId) {
		$num = 0;
		$raw_results = $this->_bdd->prepare("SELECT `cours`.`matiere`, `contenu`, `professeurs`.`nom_p` FROM `cours` INNER JOIN `professeurs` ON `cours`.`prof_id` = `professeurs`.`id` INNER JOIN `classes` ON `cours`.`classe_id` = `classes`.`id` WHERE `prof_id` = ? AND `nom_classe` = ?;");
		$raw_results->execute([$formationId]);
		if (isset($raw_results)){
			if ($raw_results->rowCount() > 0) {
				while($results = $raw_results->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='card text-white bg-dark mb-3'>
							<div class='card-body'>
								<h5 class='card-title'>".$results['matiere']."</h5>
								<p class='card-text'>".$results['contenu']."</p>
							</div>
							<div class='card-footer'>
								<small class='text-muted'>De Professeur ".$results['nom_p']."</small>
	    				</div>";
					$num += 1;
					echo "<script>document.getElementById('info').style.display = 'inline-flex';</script>";
					echo "<script>document.getElementById('num').innerHTML =".$num.";</script>";
				}
			} else
				echo "<div class='card text-white bg-dark mb-3' style='display: inline-flex'>
						<div class='card-body'>
						<h5 class='card-title'>Rien pour l'instant <i class='fa fa-heart' aria-hidden='true'></i></h5>
					</div>";
		}
	}

}
?>
