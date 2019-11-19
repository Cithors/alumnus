<?php
	include_once '../../src/inc/header.php';
	include '../../src/classes/Events.php';
	$evtManager = new Events();
?>

	<div class="divider"></div>

	<div class="content">
		<div class="container">

			<div class="main-content">
				<h1><?= $events['all'] ?></h1>
				<section class="posts-con">

				<?= $evtManager->allEvents($date) ?>

				</section>
			</div>

			<aside id="sidebar">
				<div class="widget clearfix calendar">
					<h2><?= $events['cal']['title'] ?></h2>
					<div class="head">
						<a class="prev" href="#"></a>
						<a class="next" href="#"></a>
						<h4><?= $date['m'][date('m')].' '.date('Y') ?></h4>
					</div>
					<div class="table">
						<table>
							<tr>
								<th class="col-1">Lun</th>
								<th class="col-2">Mar</th>
								<th class="col-3">Mer</th>
								<th class="col-4">Jeu</th>
								<th class="col-5">Ven</th>
								<th class="col-6">Sam</th>
								<th class="col-7">Dim</th>
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
				</div>
				<div class="widget list">
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
						<a class="btn blue" href="#"><?= $events['gallery']['more'] ?></a>
					</div>
				</div>
			</aside>
			<!-- / sidebar -->

		</div>
		<!-- / container -->
	</div>

<?php include_once '../../src/inc/footer.php'; ?>
