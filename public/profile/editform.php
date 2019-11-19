<?php
	include_once '../../src/inc/header.php';
	include $cUSERS;
	$uManager = new Users();
	$tab = $users->getDataEdit($_GET['id']);
?>
	<div class="divider"></div>

	<div class="content">
		<div class="container">

			<div class="main-content">
				<h1>Profil</h1>
				<section class="posts-con">
					<div align="center">
						<form action="<?= TRAITS ?>users_edit.php" method="post">
							<input type="text" name="id" id="id" value="<?=$_GET['id'];?>" hidden>
							<input type="text" name="type" id="type" value="p" hidden>
							<h3>Nom: </h3>
							<input type="text" name="lastname" id="lastname" value="<?=$tab['lastname'];?>">
							<h3>Prénom: </h3>
							<input type="text" name="firstname" id="firstname" value="<?=$tab['firstname'];?>">
							<h3>Date de naissance: </h3>
							<input type="date" max="<?=$DATE;?>" name="birth" id="birth" value="<?=$tab['birth'];?>">
							<br><br>
							<button type="submit">Valider</button>
						</form>
					</div>
				</section>
			</div>

			<aside id="sidebar">
				<div class="widget list">
					<h2>Sidebar</h2>
					<ul>
						<li><a href="#"><img src="<?= IMG; ?>4.png" alt=""></a></li>
						<li><a href="#"><img src="<?= IMG; ?>4_2.png" alt=""></a></li>
						<li><a href="#"><img src="<?= IMG; ?>4_3.png" alt=""></a></li>
						<li><a href="#"><img src="<?= IMG; ?>4_4.png" alt=""></a></li>
						<li><a href="#"><img src="<?= IMG; ?>4_5.png" alt=""></a></li>
						<li><a href="#"><img src="<?= IMG; ?>4_6.png" alt=""></a></li>
					</ul>
					<div class="btn-holder">
						<a class="btn blue" href="<?= EVENTS ?>"><?= $gallery['events']['more'] ?></a>
					</div>
				</div>
			</aside>
			<!-- / sidebar -->

		</div>
		<!-- / container -->
	</div>

<?php include_once '../../src/inc/footer.php'; ?>
