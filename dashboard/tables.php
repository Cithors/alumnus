<?php
	include_once 'constants.php';
	include_once '../src/classes/Builder.php';

	$manager = new Manager('alumnus');
	$builder = new Builder();

	if(!isset($_COOKIE['user']) || isset($_GET['nouser'])) {
		$manager->signOut();
	}

	if (!isset($_GET['t']) || empty($_GET['t'])) {
		header('location: '.DASH);
	} elseif (!in_array($_GET['t'], array('users'))) {
		header('location: '.DASH);
	}

	date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>alumnus</title>
	<!-- Favicon -->
	<link rel='icon' href='../img/favicon.png' type='image/png'>
	<?php $builder->dashHead(); ?>
</head>

<body id="page-top">
	<?php $builder->dashStart(); ?>

	<div id="content-wrapper">
		<div class="container-fluid">
			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Tables</a>
				</li>
				<li class="breadcrumb-item active"><?= ucwords($_GET['t']); ?></li><hr>
				<li class="breadcrumb-item">
					<li>Table&nbsp;&nbsp;</li>
					<li>
						<select class="custom-select custom-select-sm form-control form-control-sm" onchange="window.location.href = 'tables.php?t=' + this.value;">
							<option value="">&nbsp;</option>
							<option value="all">Tout</option>
							<option value="users">users</option>
						</select>
					</li>
				</ol>

				<!-- DataTables Example -->
				<div class="card mb-3">
					<div class="card-header"><i class="fas fa-table"></i>
						Table <code>'<?= $_GET['t']; ?>'</code>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<?php $manager->setTable(); ?>
								</thead>
								<tfoot>
									<?php $manager->setTable(); ?>
								</tfoot>
								<tbody>
									<?php $manager->showTable(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<?php $builder->dashEnd(); ?>
	<?php $builder->dashJs(); ?>

</body>

</html>
