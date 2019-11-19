<?php include_once '../../src/inc/header.php'; ?>

	<div class="divider"></div>

	<div class="content">
		<div class="container">

			<div class="main-content">
				<h1><?= $gallery['all'] ?></h1>
				<section class="posts-con">
					<?= $gManager->allImages(); ?>
				</section>
			</div>

			<aside id="sidebar">
				<?php if (isUser() == -1) { ?>
					<div class="widget sidemenu">
						<ul>
							<li class="current">
								<a class="trigModal" href="#addImage"><?= $gallery['add'] ?>
									<span class="nr"><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-image"></i></span>
								</a>
							</li>
						</ul>
					</div>
				<?php } ?>
			</aside>
			<!-- / sidebar -->

		</div>
		<!-- / container -->
	</div>

<?php include_once '../../src/inc/footer.php'; ?>
