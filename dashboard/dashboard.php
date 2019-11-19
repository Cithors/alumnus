<?php
require '../classes/User.php';
require '../classes/Manager.php';

$_SESSION['info'] = '';

//Instanciation d'un objet 'Manager'
$manager = new Manager('schuman');

// Détection du cookie 'user' confirmant la connexion d'un utilisateur
if(isset($_COOKIE['user'])) {
	// Affichage des éléments disponibles seulement après connexion
	$change = "<script>document.getElementById('signin').style.display = 'none';
	document.getElementById('signup').style.display = 'none';
	document.getElementById('signout').style.display = 'block';
	document.getElementById('profile').style.display = 'block';</script>";
	// Si l'admin est connecté
	if ($_COOKIE['user'] == 1)
		// Affichage du tableau de bord
		$change .= "<script>document.getElementById('dashboard').style.display = 'block';</script>";
	// Sinon
	else
		// Masquer le tableau de bord
		$change .= "<script>document.getElementById('dashboard').style.display = 'none';</script>";
} else
	header('location: ../index.php');

function Disconnect() {
    // Date d'expiration des cookies dans le passé
    setcookie('PHPSESSID', 0, time() - 3600, '/');
    setcookie('user', 0, time() - 3600, '/');
    setcookie('nom', 0, time() - 3600, '/');
    setcookie('prenom', 0, time() - 3600, '/');
    setcookie('classe', 0, time() - 3600, '/');
    setcookie('matiere', 0, time() - 3600, '/');
    setcookie('poste', 0, time() - 3600, '/');
    // "Désactivation" des cookies en cas de doute
    unset($_COOKIE['PHPSESSID']);
    unset($_COOKIE['user']);
    unset($_COOKIE['nom']);
    unset($_COOKIE['prenom']);
    unset($_COOKIE['classe']);
    unset($_COOKIE['matiere']);
    unset($_COOKIE['classe']);

    // Retour au mode invité
    $_SESSION['info'] = 'Déconnecté';
    // Redirection vers la page d'accueil
    header('location: ../index.php?nouser');
}

// Détection de 'nouser' dans l'adresse URL confirmant la déconnexion d'un utilisateur et du cookie 'user'
if (isset($_GET['nouser']) && isset($_COOKIE['user']))
	// Déconnexion de l'utilisateur
	Disconnect();

$groupes = array([1, 2, 3, 4, 5, 6]);
if (isset($_GET['query'])) { header("location: groups.php?groupid=".$_GET['query']."#results");}

if (isset($_POST['nom1'])) {
	$user = new Etudiant($_POST['nom1'], $_POST['prenom1'],  $_POST['mdp1']);
	$manager->addEtudiant($user, $_POST['classe1']);
} else if (isset($_POST['nom2'])) {
	$user = new Etudiant($_POST['nom2'], $_POST['prenom2'], $_POST['mdp2']);
	$manager->modEtudiant($user, $_POST['classe2']);
} else if (isset($_POST['nom3'])) {
	$manager->delEtudiant($_POST['nom3'], $_POST['prenom3']);
} else if (isset($_POST['nom4'])) {
	$user = new Professeur($_POST['nom4'], $_POST['prenom4'], $_POST['mdp4']);
	$manager->addProfesseur($user, $_POST['matiere4']);
} else if (isset($_POST['nom5'])) {
	$user = new Professeur($_POST['nom5'], $_POST['prenom5'], $_POST['mdp5']);
	$manager->modProfesseur($user, $_POST['matiere5']);
} else if (isset($_POST['nom6'])) {
	$manager->delProfesseur($_POST['nom6'],  $_POST['prenom6']);
}

if (isset($_GET['del'])) { $manager->delGetEtudiant($_GET['del']); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Academica</title>
	<meta charset="UTF-8">
	<meta name="description" content="Academica">
	<meta name="keywords" content="education, school, pronote, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/ticket.ico" rel="shortcut icon"/>

	<!-- Google Font -->   
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="http://localhost/academica/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/flaticon.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/owl.carousel.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/style.css"/>
	<link rel="stylesheet" href="http://localhost/academica/css/animate.css"/>

	<style>
		html, body{height: 100%; overflow: hidden;}

		/*FORM*/
		.form-style-1 textarea{ height: 20px; }

		.form-style-1 textarea:focus,
		.form-style-1 input:focus,
		.form-style-1 textarea:active,
		.form-style-1 input:active{ border-bottom: 3px solid #EF0031; }
		.form-style-1 label{ color: yellow; }
		.form-style-1 input:hover, input[type=submit]:hover{ border: all; }
		.placeholder-1 ::-webkit-input-placeholder { font-style: italic; color: #aaa; font-size: .9em;  }
		.placeholder-1 ::-moz-placeholder { font-style: italic; color: #aaa; font-size: .9em; }
		.placeholder-1 :-ms-input-placeholder { font-style: italic; color: #aaa; font-size: .9em;  }
		.placeholder-1 :-moz-placeholder { font-style: italic; color: #aaa; font-size: .9em;  }

		.form-brdr-b input,
		.form-brdr-b textarea {
		        outline: 0;
		        background: none;
		        border: 0;
		        border-bottom: 1px solid #ccc;
		}
	</style>
</head>
<body>
	<section class="elements-section">
		<div class="container">

			<div class="element">
				<div class="section-title text-center" style="margin-bottom: 25px;">
					<h2>Gestion des membres</h2><br><br>
					<a id="signout" class="site-btn sb-line" href="../index.php"><i class="fa fa-lg fa-home"></i>&nbsp;Retour à l'espace personnel</a>
					<div style="padding-top: 45px; padding-left: 20px">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							Afficher un groupe
						</button><br><br>
						<?php if (!empty($_SESSION['info'])) { ?>
						<div id='info' class='alert alert-info alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Nice~&nbsp;</strong><?php echo $_SESSION['info']; ?>
						</div><br>
						<?php } ?>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin: 0; padding: 0">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel" style="color: black">Afficher un groupe</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      	<form class="form-style-1 placeholder-1" action="dashboard.php" method="GET">
						      		<i style="color: white;" class="fa fa-lg fa-search"></i>
						      		<input type="text" name="query" placeholder="Classe" style="width: 170px;" list="datalist" required>
						      		<datalist id="datalist">
						      			<option value="1">Seconde</option>
						      			<option value="2">Première</option>
						      			<option value="3">Terminale</option>
						      			<option value="4">BTS SIO</option>
						      			<option value="5">Professeurs</option>
						      			<option value="6">Direction</option>
						      		</datalist>
						      		<input class="btn btn-primary" type="submit" value="GO">
						      	</form>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						      </div>
						    </div>
						  </div>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">

						<div id="accordion" class="accordion-area">
							<div class="panel">
								<div class="panel-header" id="headingOne">
									<!-- Add 'active' after panel-link -->
									<button class="panel-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">Ajouter un média</button>
								</div>
								<!-- Add 'show' after panel-link -->
								<div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom1">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="Prénom" name="prenom1">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="Mot de passe" name="mdp1">
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe1" value="1"> Seconde<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe1" value="2"> Première<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe1" value="3"> Terminale<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe1" value="4"> BTS<br>
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: green" class="site-btn" value="Ajouter" type="submit" name="add1">
														<!-- <button class="site-btn">Ajouter</button> -->
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-header" id="headingTwo">
									<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Modifier un média</button>
								</div>
								<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom2">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="Prénom" name="prenom2">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="Mot de passe" name="mdp2">
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe2" value="1"> Seconde<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe2" value="2"> Première<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe2" value="3"> Terminale<br>
												</div>
												<div class="col-lg-3" style="color: white;">
													<input type="radio" name="classe2" value="4"> BTS<br>
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: cyan" class="site-btn" value="Modifier" type="submit" name="edit1">
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-header" id="headingThree"><!-- active -->
									<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">Supprimer un média</button>
								</div>
								<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom3">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="" disabled="" style="visibility: hidden;">
												</div>
												<div class="col-lg-4">
													<input type="text" placeholder="Prénom" name="prenom3">
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: red" class="site-btn" value="Supprimer" type="submit" name="delete1">
														<!-- <button class="site-btn">Modifier</button> -->
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<!-- Tabs -->
						<div id="accordion" class="accordion-area">
							<div class="panel">
								<div class="panel-header" id="headingFour">
									<button class="panel-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">Ajouter un utilisateur</button>
								</div>
								<div id="collapse4" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom4">
												</div>
												<div class="col-lg-4"></div>
												<div class="col-lg-4">
													<input type="text" placeholder="Mot de passe" name="mdp4">
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: green" class="site-btn" value="Ajouter" type="submit" name="add2">
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-header" id="headingFive">
									<button class="panel-link" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">Modifier un utilisateur</button>
								</div>
								<div id="collapse5" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom5">
												</div>
												<div class="col-lg-4"></div>
												<div class="col-lg-4">
													<input type="text" placeholder="Mot de passe" name="mdp5">
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: cyan" class="site-btn" value="Modifier" type="submit" name="edit2">
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="panel">
								<div class="panel-header" id="headingSix"><!-- active -->
									<button class="panel-link" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">Supprimer un utilisateur</button>
								</div>
								<div id="collapse6" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
									<div class="panel-body">
										<form class="contact-form form-style-1 placeholder-1" action="dashboard.php" method="post">
											<div class="row">
												<div class="col-lg-4">
													<input type="text" placeholder="Nom" name="nom6">
												</div>
												<div class="col-lg-4"></div>
												<div class="col-lg-4">
													<input type="passw" placeholder="Mot de passe" name="mdp6">
												</div>
												<div class="col-lg-12">
													<div class="text-center">
														<input style="background-color: red" class="site-btn" value="Supprimer" type="submit" name="delete2">
														<!-- <button class="site-btn">Modifier</button> -->
													</div>
												</div>	
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center">
					<a href="index.php" class="site-btn sb-line">PAGE 1</a>
				</div>
			</div>

	<!--====== Javascripts & Jquery ======-->
	<script src="http://localhost/academica/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost/academica/js/jquery-ui.min.js"></script>
	<script src="http://localhost/academica/js/bootstrap.min.js"></script>
	<script src="http://localhost/academica/js/owl.carousel.min.js"></script>
	<script src="http://localhost/academica/js/circle-progress.min.js"></script>
	<script src="http://localhost/academica/js/main.js"></script>
    </body>
</html>
