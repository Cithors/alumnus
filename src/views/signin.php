<?php include '../classes/Manager.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Alumnus</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/animate/animate.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/select2/select2.min.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>css/util.css">
	<link rel="stylesheet" href="<?= SIGNIN; ?>css/main.css">
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
					<span class="login100-form-title-1">Connexion</span>
					<span class="login100-form-title-1" style="font-size: 0.9em; color: yellow"></span>
				</div>

				<form class="login100-form validate-form" method="post" action="<?= URL; ?>index.php">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Nom de famille obligatoire">
						<span class="label-input100">Nom d'utilisateur</span>
						<input class="input100" type="text" name="nom" placeholder="Ex: ADAMS">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Mot de passe obligatoire">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="mdp" placeholder="Ex: kev">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1">Garder la session ouverte</label>
						</div>

						<div>
							<a href="<?= DASH; ?>forgot-password.php?objet=Mot de passe oublié#form" class="txt1">Mot de passe oublié ?</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"><i class="fa fa-lg fa-sign-in"></i>&nbsp;Se connecter</button>
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
