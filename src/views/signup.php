<?php include '../classes/Manager.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>alumnus</title>
	<meta charset="UTF-8">
	<meta name="description" content="alumnus">
	<meta name="keywords" content="t2c, travel, booking, html">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../img/favicon.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= SIGNIN; ?>css/main.css">
	<style>
		.container-login100 {
		    background: #191919;
		}
		.login100-form-btn {
		    background-color: crimson;
		}
		.focus-input100::before {
		    content: "";
		    background: crimson;
		}
	</style>
</head>
<body style="background-color: rgb(255,25,25);">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?= SIGNIN; ?>images/bg-01.jpg);">
					<span class="login100-form-title-1">Inscription</span>
					<span class="login100-form-title-1" style="font-size: 0.9em; color: yellow"></span>
				</div>

				<form class="login100-form validate-form" method="post" action="index.php">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Nom de famille obligatoire">
						<span class="label-input100">Nom de famille</span>
						<input class="input100" type="text" name="nom" placeholder="Ex: DOE">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Prénom obligatoire">
						<span class="label-input100">Prénom</span>
						<input class="input100" type="text" name="prenom" placeholder="Ex: John">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Email manquant ou incorrect">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Ex: john@doe">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Mot de passe obligatoire">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="mdp" placeholder="Ex: anon">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"><i class="fa fa-lg fa-user-plus"></i>&nbsp;S'inscrire</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button><a href="../index.php"><i class="fa fa-lg fa-home"></i>&nbsp;Retour à l'accueil</a></button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= SIGNIN; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?= SIGNIN; ?>vendor/animsition/js/animsition.min.js"></script>
	<script src="<?= SIGNIN; ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= SIGNIN; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= SIGNIN; ?>vendor/select2/select2.min.js"></script>
	<script src="<?= SIGNIN; ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= SIGNIN; ?>vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<?= SIGNIN; ?>vendor/countdowntime/countdowntime.js"></script>
	<script src="<?= SIGNIN; ?>js/main.js"></script>

</body>
</html>
