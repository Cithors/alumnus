<?php
include_once '../classes/Manager.php';
include_once '../classes/Place.php';
include_once '../classes/Builder.php';
include_once '../classes/BookingManager.php';

$manager = new Manager('alumnus');
$builder = new Builder();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php $builder->dashHead(); ?>
</head>

<body id="page-top">
	<?php $builder->dashStart(); ?>
	<div id="content-wrapper">
		<div class="container-fluid">
			<!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.php">Dashboard</a>
				</li>
				<li class="breadcrumb-item active">404 Error</li>
			</ol>

			<!-- Page Content -->
			<h1 class="display-1">404</h1>
			<p class="lead">Page not found. You can
				<a href="javascript:history.back()">go back</a>
				to the previous page, or
				<a href="index.php">return home</a>.</p>

			</div>
			<!-- /.container-fluid -->
			<?php $builder->dashEnd(); ?>
	<?php $builder->dashJs(); ?>

</body>

</html>
