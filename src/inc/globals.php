<?php
	// Root folder
	define('ROOT', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/alumnus/');
		// Resources folder
		define('SRC', ROOT.'src/');
			define('CLASSES', SRC.'classes/');
				define('cEVENTS', CLASSES.'Events.php');
				define('cGALLERY', CLASSES.'Gallery.php');
				define('cUSERS', CLASSES.'Users.php');
				$cEVENTS = '../src/classes/Events.php';
				$cGALLERY = '../src/classes/Gallery.php';
				$cUSERS = '../src/classes/Users.php';
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

	function jsonFile() { return json_decode(file_get_contents(INC.'langs.json'), true); }

	// $loginMsg = array('en' => 'Login Required !', 'fr' => 'Connexion Requise !');
	// $wrongMsg = array('en' => 'Invalid credentials !', 'fr' => 'Identifiants Invalides !');
	// $mailMsg = array('en' => 'Email Sent !', 'fr' => 'Email Envoyé !');
	// $codeMsg = array('en' => 'Wrong Code !', 'fr' => 'Code Incorrect !');
	// $resetMsg = array('en' => 'Password Reset !', 'fr' => 'Mot de Passe Réinitialisé !');
	// $changeMsg = array('en' => 'Different Passwords !', 'fr' => 'Mots de Passe Différents !');

	function setLang($self, $lang = null) {
		if (!isset($_COOKIE['lang'])) {
			if ($lang) { setcookie('lang', $lang, time() + 86400*10, '/'); }
			else { setcookie('lang', 'en', time() + 86400*10, '/'); }

			if (!isset($_COOKIE['theme'])) { setcookie('theme', 0, time() + 86400*10, '/'); }

			header('location: '.$self);
		} else { return $_COOKIE['lang']; }
	}

	$dirs = ['public/', 'signin/', 'dashboard/'];
	$change = ['/alumnus/'.$dirs[0].'chat/'];

	// Lead the user back home if the URI is not among the subDirs and their files
	$pattern0 = "/(public|signin|dashboard)+(\/)/";
	$pattern1 = "/(public\/)+(chat\/|events\/|gallery\/|profile\/)+[a-z.0-9]*/";
	$pattern2 = "/(dashboard\/)+[a-z.\/0-9]*/";

	if (!preg_match($pattern0, $_SERVER['REQUEST_URI']) &&
		!preg_match($pattern1, $_SERVER['REQUEST_URI']) &&
		!preg_match($pattern2, $_SERVER['REQUEST_URI'])) { header('location: '.HOME); }

	// Check cookie 'user' and current user's access rights
	function check() {
		global $change;
		global $loginMsg;
		// If the 'user' cookie exists
		if (isset($_COOKIE['user'])) {
			$tab = explode(';', $_COOKIE['user']);
			// If there's at least one 0
			if (in_array('0', $tab)) {
				setcookie('user', '', -1, '/');
				return false;
			}
			return true;
		} else {
			// If the user visits a 'special' page
			if ($_SERVER['REQUEST_URI'] == $change[0]) {
					if (!isset($_COOKIE['msg'])) { setcookie('msg', 'login', time()+4, '/'); }
					header('location: '.SIGNIN);
			}
		}
		return false;
	}

	function isUser() {
		if (isset($_COOKIE['user'])) {
			$tab = explode(';', $_COOKIE['user']);
			if ($tab[0] != '0' && $tab[1] == 'a') return -1; // Admin
			if ($tab[0] != '0' && $tab[1] != 'a') return 1; // User
		}
		return 0; // Guest
	}

	check();
?>
