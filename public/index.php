<?php include_once '../src/inc/header.php'; ?>

	<div class="slider">
		<div class="bx-pager"></div>
		<ul class="bxslider">
			<li>
				<div class="container">
					<div class="info">
						<h2><?= $index['slider']['text1'] ?></h2>
						<a href="<?= EVENTS ?>#slider1"><?= $index['slider']['more'] ?></a>
					</div>
				</div>
			</li>

			<li>
				<div class="container">
					<div class="info">
						<h2><?= $index['slider']['text2'] ?></h2>
						<a href="<?= EVENTS ?>#slider2"><?= $index['slider']['more'] ?></a>
					</div>
				</div>
			</li>

			<li>
				<div class="container">
					<div class="info">
						<h2><?= $index['slider']['text3'] ?></h2>
						<a href="<?= EVENTS ?>#slider3"><?= $index['slider']['more'] ?></a>
					</div>
				</div>
			</li>
		</ul>
		<div class="bg-bottom"></div>
	</div>

	<section class="posts">
		<div class="container">
			<article>
				<div class="pic"><img width="121" src="<?= IMG; ?>2.png" alt="book"></div>
				<div class="info">
					<h3><?= $index['post1']['title'] ?></h3>
					<p><?= $index['post1']['text'] ?></p>
				</div>
			</article>

			<article>
				<div class="pic"><img width="121" src="<?= IMG; ?>3.png" alt="medal"></div>
				<div class="info">
					<h3><?= $index['post2']['title'] ?></h3>
					<p><?= $index['post2']['text'] ?></p>
				</div>
			</article>
		</div>
	</section>

	<section class="news">
		<div class="container">
			<h2><?= $index['news']['latest'] ?></h2>
			<article>
				<div class="pic"><img src="<?= IMG; ?>1.png" alt="news2"></div>
				<div class="info">
					<h4><?= $index['news']['2']['title'] ?></h4>
					<p class="date"><?= $index['news']['2']['date'] ?></p>
					<p><?= $index['news']['2']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>#news2"><?= $index['news']['more'] ?></a>
				</div>
			</article>

			<article>
				<div class="pic"><img src="<?= IMG; ?>1_1.png" alt="news1"></div>
				<div class="info">
					<h4><?= $index['news']['1']['title'] ?></h4>
					<p class="date"><?= $index['news']['1']['date'] ?></p>
					<p><?= $index['news']['1']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>#news1"><?= $index['news']['more'] ?></a>
				</div>
			</article>

			<div class="btn-holder">
				<a class="btn" href="<?= EVENTS ?>#news"><?= $index['news']['all'] ?></a>
			</div>
		</div>
	</section>

	<section class="events">
		<div class="container">
			<h2><?= $index['events']['latest'] ?></h2>
			<article>
				<div class="current-date">
					<p><?= $index['events']['1']['month'] ?></p>
					<p class="date"><?= $index['events']['1']['date'] ?></p>
				</div>

				<div class="info">
					<em><u><?= $index['events']['1']['title'] ?></u></em>
					<p><?= $index['events']['1']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>"><?= $index['events']['more'] ?></a>
				</div>
			</article>

			<article>
				<div class="current-date">
					<p><?= $index['events']['2']['month'] ?></p>
					<p class="date"><?= $index['events']['2']['date'] ?></p>
				</div>

				<div class="info">
					<em><u><?= $index['events']['2']['title'] ?></u></em>
					<p><?= $index['events']['2']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>"><?= $index['events']['more'] ?></a>
				</div>
			</article>

			<article>
				<div class="current-date">
					<p><?= $index['events']['3']['month'] ?></p>
					<p class="date"><?= $index['events']['3']['date'] ?></p>
				</div>

				<div class="info">
					<em><u><?= $index['events']['3']['title'] ?></u></em>
					<p><?= $index['events']['3']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>"><?= $index['events']['more'] ?></a>
				</div>
			</article>

			<article>
				<div class="current-date">
					<p><?= $index['events']['4']['month'] ?></p>
					<p class="date"><?= $index['events']['4']['date'] ?></p>
				</div>

				<div class="info">
					<em><u><?= $index['events']['4']['title'] ?></u></em>
					<p><?= $index['events']['4']['text'] ?></p>
					<a class="more" href="<?= EVENTS ?>"><?= $index['events']['more'] ?></a>
				</div>
			</article>

			<div class="btn-holder">
				<a class="btn blue" href="<?= EVENTS; ?>"><?= $index['events']['all'] ?></a>
			</div>
		</div>
	</section>

<?php include_once '../src/inc/footer.php'; ?>
