<?php
	require 'globals.php';

	if (!isset($_SESSION)) { session_start(); }

	$langs = jsonFile();
	$self = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	$lang = setLang('http://'.$self);

	// Languqge Dictionaries
	$header = $langs[$lang]['header'];
	$index = $langs[$lang]['index'];
	$events = $langs[$lang]['events'];
	$gallery = $langs[$lang]['gallery'];
	$footer = $langs[$lang]['footer'];
	$modal = $langs[$lang]['modal'];
	$date = $langs[$lang]['date'];
	$signin = $langs[$lang]['signin'];
	$msg = $langs[$lang]['msg'];
	$admin = $langs[$lang]['admin'];

	check();

	if (file_exists($cUSERS)) { include $cUSERS; }
	else { include '../../src/classes/Users.php'; }
	$uManager = new Users();
	$info = $uManager->showProfile(1);

	if (file_exists($cGALLERY)) { include $cEVENTS; }
	else { include '../../src/classes/Events.php'; }
	$eManager = new Events();

	if (file_exists($cGALLERY)) { include $cGALLERY; }
	else { include '../../src/classes/Gallery.php'; }
	$gManager = new Gallery();

	if (isset($_POST)) {
		foreach ($_POST as $key => $value) {
			if (!in_array($key, ['url1', 'url2', 'url3', 'url4'])) {
				// Remove tags
				$value = htmlspecialchars(strip_tags($value));
				// Remove special chars
				// $value = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $value);
				// Clean POST vars before sending them
				$_POST[$key] = $value;
			}
		}

		// print_r($_POST);

		if (!empty($_POST)) {
			// Edit Profile
			if (isset($_POST['user']) && isset($_POST['pwd'])) {
				if (!empty($_POST['user']) && !empty($_POST['pwd'])) {
					$uManager->modProfile($_POST['user'], $_POST['pwd']);
				} else { setcookie('code', '3', time()+4, '/'); }
			}

			if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['subject']) && isset($_POST['question']))
			{
				if (!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['subject']) && !empty($_POST['question'])){
					$uManager->sendmailcontact($_POST['name'], $_POST['mail'], $_POST['subject'], $_POST['question']);
				}
			}

			if (isset($_POST['title1']) && isset($_POST['desc1']) && isset($_POST['url1'])) {
				if (!empty($_POST['title1']) && !empty($_POST['desc1']) && !empty($_POST['url1'])) {
					// $check = getimagesize($_POST['url1']);
					$check = 1;
					if ($check !== false) {
						// echo "File is an image - " . $check["mime"] . ".<br><img src=".$_POST['url1'].">";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// If everything is ok, try to upload URL
					} else {
						$gManager->setTitle($_POST['title1']);
						$gManager->setDesc($_POST['desc1']);
						$gManager->setPic($_POST['url1']);
						$gManager->addgallery();
					}
				}
			}

			if (isset($_POST['title2']) && isset($_POST['desc2']) && isset($_POST['url2'])) {
				if (!empty($_POST['title2']) && !empty($_POST['desc2']) && !empty($_POST['url2'])) {
					// $check = getimagesize($_POST['url1']);
					$check = 1;
					if ($check !== false) {
						// echo "File is an image - " . $check["mime"] . ".<br><img src=".$_POST['url1'].">";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// If everything is ok, try to upload URL
					} else {
						$gManager->setTitle($_POST['title2']);
						$gManager->setDesc($_POST['desc2']);
						$gManager->setPic($_POST['url2']);
						$gManager->modgallery($_POST['id']);
					}
				}
			}

			if (isset($_POST['title3']) && isset($_POST['desc3']) && isset($_POST['sdate3']) && isset($_POST['edate3']) && isset($_POST['url3'])) {
				if (!empty($_POST['title3']) && !empty($_POST['desc3']) && !empty($_POST['sdate3']) && !empty($_POST['edate3']) && !empty($_POST['url3'])) {
					// $check = getimagesize($_POST['url1']);
					$check = 1;
					if ($check !== false) {
						// echo "File is an image - " . $check["mime"] . ".<br><img src=".$_POST['url1'].">";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// If everything is ok, try to upload URL
					} else {
						$eManager->setTitle($_POST['title3']);
						$eManager->setDesc($_POST['desc3']);
						$eManager->setSdate($_POST['sdate3']);
						$eManager->setEdate($_POST['edate3']);
						$eManager->setPic($_POST['url3']);
						setcookie('id', '', -1);
						$eManager->addevent();
					}
				}
			}

			if (isset($_POST['title4']) && isset($_POST['desc4']) && isset($_POST['sdate4']) && isset($_POST['edate4']) && isset($_POST['url4'])) {
				if (!empty($_POST['title4']) && !empty($_POST['desc4']) && !empty($_POST['sdate4']) && !empty($_POST['edate4']) && !empty($_POST['url4'])) {
						$eManager->setTitle($_POST['title4']);
						$eManager->setDesc($_POST['desc4']);
						$eManager->setSdate($_POST['sdate4']);
						$eManager->setEdate($_POST['edate4']);
						$eManager->setPic($_POST['url4']);
						setcookie('id2', '', -1);
						$eManager->modevent($_POST['id2']);
				}
			}

			if (isset($_POST['del'])) {
				if (!empty($_POST['del'])) {
					$gManager->delgallery($_POST['del']);
				}
			}

			if (isset($_POST['del2'])) {
				if (!empty($_POST['del2'])) {
					$eManager->delevent($_POST['del2']);
				}
			}
		}
	}

	// echo "<br>$info[0] $info[1] $info[2]";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Alumnus</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">

	<link rel="shortcut icon" href="data:image/png;base64,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">

	<!-- <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB3UlEQVR4nKWTv0sbcRjGn7v75qdn8JSzySEUWxpIRAdRUeFAOpRKtnaUQzoo9C9wcXfo4iqIwUXQyUFuc1AcNAqipoZclqaE5qLmUr3EMyG56yBao2cM+I4v7/PwfN6Xl8KPHbym6GaG2lykbeHT+4Xs98Hs6bf+U5r6ryMviYOcJ7jxJbRRuKkV/C1Of0YvZkwLZlMJeK+Dl7+G5dmd37O560oOAPay+l7TCCuR4MqBWjxYS16sDfjZAQCIqcXYw5lnEab63kyJXT4xtHQYElinEGhxBuwS3BtwbsLNiW/nIu/aI7yX8ISmSN6o5qUwL1VMqwIAl+XapaIZii1C9POH6ESYn5BkRVr+ebZMUxQ9tnoytpW52hrv5sZv4+sxC7BsEyQ1I8m5CZcqGKnJns7JzfTfzUTeSCTyRqJqWlUAiGXr+esMZrZ/zQDA/MfueRdDuxZPcosAwFAUMxRgh+z46xAAgHUw7HSff1q7qWrrKW0dAHp5by/rYFgA2FeL+w0NhoXWYQ+hPbt/9N1yzSwDwKjgGwWA9FU5rZYqakMDscsnAsDReenorjcitI7c8utP+Ot2AAAdbtIBAMfnpeO7niQrkiQrkp34SYJo/Cwav7iOPz5Vo6Je+87/AHVjtrQRFVQiAAAAAElFTkSuQmCC"> -->
	<!-- https://fakeimg.pl/260/008BC4,00/FFF/?text=A&font=lobster&font_size=200 -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<link rel="stylesheet" media="all" href="<?= CSS ?>style.css?=<?= rand(); ?>">
	<link rel="stylesheet" media="all" href="<?= CSS ?>fancybox.css?c=<?= time() ?>">
	<link rel="stylesheet" media="all" href="<?= CSS ?>addons.css?=<?= rand(); ?>">

	<!-- Map API -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
</head>

<body>
	<header id="header">
		<div class="container">
			<a href="<?= HOME; ?>" id="logo" title="Alumnus">Alumnus</a>
			<div class="menu-trigger"></div>
			<nav id="menu" style="top">
				<ul>
					<?php if (isUser() == -1) { ?>
						<li class="log"><a href="<?= DASH ?>"><?= $header['dash'] ?></a></li>
					<?php } if (isUser() == 1) { ?>
						<!-- <li class="log"><a href="<0?= PROFILE ?>"><0?= $header['profile'] ?></a></li> -->
						<li class="log"><a href="#profile" class="trigModal"><?= $header['profile'] ?></a></li>
					<?php } ?>
					<li><a href="<?= CHAT ?>"><?= $header['chat'] ?></a></li>
					<li><a href="<?= EVENTS ?>"><?= $header['events'] ?></a></li>
				</ul>

				<ul>
					<li><a href="<?= GALLERY ?>"><?= $header['gallery'] ?></a></li>
					<li><a href="#fancy" class="trigModal"><?= $header['contact'] ?></a></li>
					<?php if (in_array(isUser(), [-1, 1])) { ?>
						<li class="log" >
							<a class="trigModal" href="#logout"><?= $header['logout'] ?></a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>

		<div class="nav-wrapper hide">
			<div class="sl-nav">
				<ul>
					<li>
						<i class="sl-flag flag-<?= $lang ?>"></i>
						<b><?= $langs[$lang]['name'] ?></b> <i class="fa fa-angle-down" aria-hidden="true"></i>
						<div class="triangle"></div>
						<ul>
							<li onclick="createCookie('lang', 'en', 10)">
								<i class="sl-flag flag-en"></i><span>English</span>
							</li>
							<li onclick="createCookie('lang', 'fr', 10)">
								<i class="sl-flag flag-fr"></i><span>Français</span>
							</li>
						</ul>
					</li>
				</ul>
			</div>

			<div class="sl-nav">
				<ul>
					<li>
						<i class="sl-flag flag-<?= $_COOKIE['theme'] ?>"></i>
						<b><?= $langs[$lang]['theme'][$_COOKIE['theme']] ?></b> <i class="fa fa-angle-down" aria-hidden="true"></i>
						<div class="triangle"></div>
						<ul>
							<li onclick="createCookie('theme', 0, 10)">
								<i class="sl-flag flag-0"></i><span><?= $langs[$lang]['theme'][0] ?></span>
							</li>
							<li onclick="createCookie('theme', 1, 10)">
								<i class="sl-flag flag-1"></i><span><?= $langs[$lang]['theme'][1] ?></span>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<content>
