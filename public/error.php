<?php include_once '../src/inc/header.php'; ?>

	<div class="divider"></div>

	<div class="content">
		<div class="container">

			<h1 class="display-1"><?= $_SERVER['REDIRECT_STATUS']; ?> Not Found</h1>
			<hr>
			<div>Page '<code><?= $_SERVER['REDIRECT_URL'] ?></code>' introuvable.</div>
			<span class="center">Tu peux
				<a href="javascript:history.back()">retourner</a>
				à la page précédente, ou
				<a href="<?= HOME ?>">revenir à l'accueil</a>.
			</span>

			<aside id="sidebar">
				<div class="widget sidemenu">
					<ul>
						<li class="current"><a class="trigModal" href="#fancy">Report issue<span class="nr"><i class="far fa-envelope icon"></i></span></a></li>
					</ul>
				</div>
			</aside>
			<!-- / sidebar -->

		</div>
		<!-- / container -->
	</div>

<?php include_once '../src/inc/footer.php'; ?>
