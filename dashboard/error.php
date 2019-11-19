<?php include_once '../src/inc/header.php'; ?>

	<div id="content-wrapper">
		<div class="container-fluid text-center">
			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.php">Accueil</a>
				</li>
				<li class="breadcrumb-item active">Erreur 404</li>
			</ol>

			<!-- Page Content -->
			<h1 class="display-1"><?= $_SERVER['REDIRECT_STATUS']; ?> Not Found</h1>
			<hr>
			<p class="lead">Page '<code><?= $_SERVER['REDIRECT_URL'] ?></code>' introuvable. Tu peux
				<a href="javascript:history.back()">retourner</a>
				à la page précédente, ou
				<a href="<?= URL;?>">revenir à l'accueil</a>.
			</p>
		</div>
	</div>

<?php include_once '../src/inc/footer.php'; ?>
