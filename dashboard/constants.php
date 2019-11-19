<?php
	// Root folder
	define('ROOT', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/alumnus/');
		// Resources folder
		define('SRC', ROOT.'src/');
			define('CLASSES', SRC.'classes/');
				define('cEVENTS', CLASSES.'Events.php');
				define('cGALLERY', CLASSES.'Gallery.php');
				define('cUSERS', CLASSES.'Users.php');
				$cEVENT = '../../src/classes/Events.php';
				$cGALLERY = '../../src/classes/Gallery.php';
				$cUSERS = '../src/classes/Users.php';
				// $cUSERS = file_get_contents('http://localhost/alumnus/src/classes');
			define('CSS', SRC.'css/');
			define('FONTS', SRC.'fonts/');
			define('FORMS', SRC.'forms/');
				define('PASS', FORMS.'changepass/');
				define('RESET', FORMS.'reset/');
				define('CONF', FORMS.'reset_confirm/');
			define('IMG', SRC.'images/');
			define('INC', SRC.'inc/');
			define('JS', SRC.'js/');
			define('TRAITS', SRC.'trait/');
		// Public folder
		define('HOME', ROOT.'public/');
			// Chat folder
			define('CHAT', HOME.'chat/');
			define('EVENTS', HOME.'events/');
				define('NEWS', EVENTS.'#news');
					define('NEWS1', NEWS.'1');
					define('NEWS2', NEWS.'2');
			define('GALLERY', HOME.'gallery/');
				define('STUDENTS', GALLERY.'#students');
				define('TEACHERS', GALLERY.'#teachers');
			define('PROFILE', HOME.'profile/');
		define('DASH', ROOT.'dashboard/');
		// Forms folders
		define('SIGNIN', ROOT.'signin/');
		define('SIGNUP', ROOT.'signup/');

	function isUser() {
		if (isset($_COOKIE['user'])) {
			$tab = explode(';', $_COOKIE['user']);
			if ($tab[0] != '0' && $tab[1] == 'a') return -1; // Admin
			if ($tab[0] != '0' && $tab[1] != 'a') return 1; // User
		}
		return 0; // Guest
	}
?>
