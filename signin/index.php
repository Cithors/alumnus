<?php
	include_once '../src/inc/header.php';

	if (!empty($_POST)) {
		if (isset($_POST['mail'])) {
			$uManager->sendmailreset($_POST['mail']);
		} else if (isset($_POST['code'])) {
			$uManager->resetpwdmail($_POST['code']);
		} else if (isset($_POST['pwd1']) && isset($_POST['pwd2'])) {
			$uManager->changepwd($_POST['id'], $_POST['pwd1'], $_POST['pwd2']);
			// var_dump($_POST);
		} else if (isset($_POST['id']) && isset($_POST['pwd'])) {
			$nick = $_POST['id'];
			$pwd = $_POST['pwd'];
			$uManager->setNickname($nick);
			$uManager->setPwd($pwd);
			$uManager->login();
		}
	}

	if (isset($_COOKIE['user'])) { if (in_array(isUser(), [-1, 1])) { header('location: '.HOME); } }
?>

	<link rel="stylesheet" href="<?= SIGNIN; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/animate/animate.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/css-hamburgers/hamburgers.min.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/animsition/css/animsition.min.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/select2/select2.min.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>vendor/daterangepicker/daterangepicker.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>css/util.css?c=<?= time() ?>">
	<link rel="stylesheet" href="<?= SIGNIN; ?>css/main.css?c=<?= time() ?>">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1"><?= $signin['title'] ?></span>
					<span class="login100-form-title-1 msg">
						<?php if (isset($_COOKIE['msg'])) echo $msg[$_COOKIE['msg']]; ?>
					</span>
				</div>

				<form class="login100-form validate-form" method="post" action="">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Identifiant obligatoire">
						<span class="label-input100"><i class="fa fa-user-o"></i>&nbsp;<?= $signin['user']['name'] ?></span>
						<input class="input100" type="text" name="id" placeholder="Ex: <?= $signin['user']['hint'][array_rand($signin['user']['hint'])] ?>">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Mot de passe obligatoire">
						<span class="label-input100"><i class="fa fa-key"></i>&nbsp;<?= $signin['pwd']['name'] ?></span>
						<input class="input100" type="password" name="pwd" placeholder="Ex: <?= $signin['pwd']['hint'][array_rand($signin['user']['hint'])] ?>">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="pwdReset">
							<a href="#reset" class="txt1 trigModal"><i class="fa fa-question-circle-o"></i>&nbsp;<?= $signin['forgot'] ?></a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"><i class="fa fa-lg fa-sign-in"></i>&nbsp;<?= $signin['btn'] ?></button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="backHome"><a href="<?= $_SERVER['HTTP_REFERER'] ?>"><i class="fa fa-lg fa-arrow-left"></i>&nbsp;<?= $signin['back'] ?></a></button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= SIGNIN; ?>vendor/jquery/jquery-3.2.1.min.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/animsition/js/animsition.min.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/bootstrap/js/popper.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/bootstrap/js/bootstrap.min.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/select2/select2.min.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/daterangepicker/moment.min.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/daterangepicker/daterangepicker.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>vendor/countdowntime/countdowntime.js?c=<?= time() ?>"></script>
	<script src="<?= SIGNIN; ?>js/main.js?c=<?= time() ?>"></script>

<?php include_once '../src/inc/footer.php' ?>
