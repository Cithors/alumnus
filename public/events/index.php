<?php include_once '../../src/inc/header.php'; ?>
<link rel="stylesheet" href="cal.css?=<?= rand(); ?>">
<div class="divider"></div>

<div class="content">
	<?php
			// Add Event
	if(isUser()==-2){
		echo '
		<form action="<?=$ROOT;?>/app/trait/events_add.php" method="post">
			<input type="text" name="title" id="title" placeholder="Titre" required>
			<input type="text" name="desc" id="desc" placeholder="Description" required>
			<input type="date" name="sdate" id="sdate" min="<?=$DATE?>" required>
			<input type="date" name="edate" id="edate" min="<?=$DATE?>" required>
			<input type="url" name="pic" id="pic" placeholder="url de l\'image" required>
			<button type="submit">Ajouter cet évènement</button>
		</form>
		';
	}
	?>
	<div class="container">
		<div class="main-content">
			<h1><?= $events['all'] ?></h1>
			<section class="posts-con">
				<?= $eManager->allEvents($date) ?>
			</section>
		</div>

		<aside id="sidebar">
			<?php if (isUser() == -1) { ?>
				<div class="widget sidemenu">
					<ul>
						<li class="current">
							<a class="trigModal" href="#addEvent"><?= $events['add'] ?>
								<span class="nr"><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-calendar"></i></span>
							</a>
						</li>
					</ul>
				</div>
			<?php } ?>

			<!-- <div class="widget clearfix calendar">
				<h2><?= $events['cal']['title'] ?></h2>
				<div class="head">
					<a class="prev" href="#"></a>
					<a class="next" href="#"></a>
					<h4><?= $date['m'][date('m')].' '.date('Y') ?></h4>
				</div>
				<div class="table">
					<table>
						<tr>
							<th class="col-1">Dim</th>
							<th class="col-2">Lun</th>
							<th class="col-3">Mar</th>
							<th class="col-4">Mer</th>
							<th class="col-5">Jeu</th>
							<th class="col-6">Ven</th>
							<th class="col-7">Sam</th>
						</tr>
						<tr>
							<td class="col-1 disable"><div>26</div></td>
							<td class="col-2 disable"><div>27</div></td>
							<td class="col-3 disable"><div>28</div></td>
							<td class="col-4 disable"><div>29</div></td>
							<td class="col-5 disable"><div>30</div></td>
							<td class="col-6 disable"><div>31</div></td>
							<td class="col-7"><div>1</div></td>
						</tr>
						<tr>
							<td class="col-1"><div>2</div></td>
							<td class="col-2 archival">
								<div>
									<div class="tooltip">
										<div class="holder">
											<h4>Omnis iste natus error sit voluptatem dolor</h4>
											<p class="info-line">
												<span class="time">10:30 AM</span>
												<span class="place">Lincoln High School</span>
											</p>
											<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident similique.</p>
										</div>
									</div>
									3
								</div>
							</td>
							<td class="col-3"><div>4</div></td>
							<td class="col-4"><div>5</div></td>
							<td class="col-5"><div>6</div></td>
							<td class="col-6"><div>7</div></td>
							<td class="col-7"><div>8</div></td>
						</tr>
						<tr>
							<td class="col-1"><div>9</div></td>
							<td class="col-2 upcoming">
								<div>
									<div class="tooltip">
										<div class="holder">
											<h4>Omnis iste natus error sit voluptatem dolor</h4>
											<p class="info-line">
												<span class="time">10:30 AM</span>
												<span class="place">Lincoln High School</span>
											</p>
											<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident similique.</p>
										</div>
									</div>
									10
								</div>
							</td>

							<td class="col-3"><div>11</div></td>
							<td class="col-4 upcoming"><div><div class="tooltip"><div class="holder">
								<h4>Omnis iste natus error sit voluptatem dolor</h4>
								<p class="info-line"><span class="time">10:30 AM</span><span class="place">Lincoln High School</span></p>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident similique.</p>
							</div></div>12</div></td>
							<td class="col-5"><div>13</div></td>
							<td class="col-6"><div>14</div></td>
							<td class="col-7"><div>15</div></td>
						</tr>
						<tr>
							<td class="col-1"><div>16</div></td>
							<td class="col-2"><div>16</div></td>
							<td class="col-3"><div>18</div></td>
							<td class="col-4"><div>19</div></td>
							<td class="col-5 upcoming"><div><div class="tooltip"><div class="holder">
								<h4>Omnis iste natus error sit voluptatem dolor</h4>
								<p class="info-line"><span class="time">10:30 AM</span><span class="place">Lincoln High School</span></p>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident similique.</p>
							</div></div>20</div></td>
							<td class="col-6"><div>21</div></td>
							<td class="col-7"><div>22</div></td>
						</tr>
						<tr>
							<td class="col-1"><div>23</div></td>
							<td class="col-2 upcoming"><div><div class="tooltip"><div class="holder">
								<h4>Omnis iste natus error sit voluptatem dolor</h4>
								<p class="info-line"><span class="time">10:30 AM</span><span class="place">Lincoln High School</span></p>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident similique.</p>
							</div></div>24</div></td>
							<td class="col-3"><div>25</div></td>
							<td class="col-4"><div>26</div></td>
							<td class="col-5"><div>27</div></td>
							<td class="col-6"><div>28</div></td>
							<td class="col-7"><div>29</div></td>
						</tr>
						<tr>
							<td class="col-1"><div>30</div></td>
							<td class="col-2 disable"><div>1</div></td>
							<td class="col-3 disable"><div>2</div></td>
							<td class="col-4 disable"><div>3</div></td>
							<td class="col-5 disable"><div>4</div></td>
							<td class="col-6 disable"><div>5</div></td>
							<td class="col-7 disable"><div>6</div></td>
						</tr>
					</table>
				</div>
				<div class="note">
					<p class="upcoming-note"><?= $events['cal']['upcoming'] ?></p>
					<p class="archival-note"><?= $events['cal']['archival'] ?></p>
				</div>
			</div> -->

			<div class="widget list">
				<div id="calendar"></div>
			</div>

			<!-- <div class="widget list">
				<h2><?= $events['gallery']['title'] ?></h2>
				<ul>
					<li><a href="#"><img src="<?= IMG; ?>4.png" alt=""></a></li>
					<li><a href="#"><img src="<?= IMG; ?>4_2.png" alt=""></a></li>
					<li><a href="#"><img src="<?= IMG; ?>4_3.png" alt=""></a></li>
					<li><a href="#"><img src="<?= IMG; ?>4_4.png" alt=""></a></li>
					<li><a href="#"><img src="<?= IMG; ?>4_5.png" alt=""></a></li>
					<li><a href="#"><img src="<?= IMG; ?>4_6.png" alt=""></a></li>
				</ul>
				<div class="btn-holder">
					<a class="btn blue" href="<?= GALLERY ?>"><?= $events['gallery']['more'] ?></a>
				</div>
			</div> -->
		</aside>

			<!-- / sidebar -->

		</div>
		<!-- / container -->
	</div>

	<?php include_once '../../src/inc/footer.php'; ?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js?=<?= rand(); ?>"></script>
	<script src="cal.js?=<?= rand(); ?>"></script>
