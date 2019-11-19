<?php include_once '../../src/inc/header.php'; ?>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css?c=<?= time() ?>"> -->
<!-- <link rel="stylesheet" href="<?= CSS ?>fancybox.css?c=<?= time() ?>"> -->

	<div class="divider"></div>

	<div class="content">
		<div class="container">

			<div class="main-content">
				<h1>Profil</h1>
				<section class="posts-con">
					<a data-fancybox="gallery" href="<?= IMG; ?>5.png"><img src="<?= IMG; ?>5.png"></a>
					<a class="btn blue trigModal" data-animation-duration="700" href="#fancy">Fancy</a>
					<a class="btn blue trigModal" data-animation-duration="700" data-src="#profile" href>Profile</a>
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

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js?c=<?= time() ?>"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js?c=<?= time() ?>"></script> -->

<!-- <script src="<?= JS ?>fancybox.js?c=<?= time() ?>"></script> -->
