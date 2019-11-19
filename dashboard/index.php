<?php
	// include_once '../src/inc/header.php';
	include_once 'constants.php';

	// include_once '../src/classes/Manager.php';
	include_once '../src/classes/Builder.php';

	// $manager = new Manager('alumnus');
	$builder = new Builder();


	if (!isset($_GET['pages']) || empty($_GET['pages'])) {
		header('location: ?pages=overview');
	} else {
		if($_GET['pages'] == 'gotosi') {
			$manager->goToSi();
		} elseif($_GET['pages'] == 'gotosu') {
			$manager->goToSu();
		}
	}

	if (isUser() != -1) { header('location: '.HOME); }

	// header("HTTP/1.0 404 Not Found");
	// echo "<html><head><meta http-equiv='Refresh' content='0;url=".URL."dashboard/404.php' />
	// 		</head><body></body></html>";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Alumnus</title>
	<!-- Favicon -->
	<link rel='icon' href='../img/favicon.png' type='image/png'>
	<?php $builder->dashHead(); ?>
</head>

<body id="page-top">
	<?php $builder->dashStart(); ?>
		<?php call_user_func(array($builder, $_GET['pages'])); ?>
	<?php $builder->dashEnd(); ?>
	<?php $builder->dashJs(); ?>
</body>
</html>
