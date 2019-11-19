<?php
include '../../src/inc/header.php';

// Connection to the database 'chat'
$bdd = new PDO('mysql:host=localhost; dbname=chat', 'root', '');
// New session
if (!isset($_SESSION)) session_start();
// Troubleshooting variable
$message = '';

/* DEPRECATED (PHP 7.0.0): salt option
password_hash('admin', PASSWORD_BCRYPT, ['cost' => 10]);
password_hash('test', PASSWORD_BCRYPT, ['cost' => 10]);
*/

// If the user is already logged in, lead them to the homepage
if (isset($_SESSION['user_id'])) { header('location:index.php'); }

// If a user tries to sign in
if (isset($_POST["login"])) {

	// Check if they are a registered user
	$query = "SELECT * FROM login WHERE username = ?";
	$stmt = $bdd->prepare($query);
	$stmt->execute([$_POST["username"]]);
	$count = $stmt->rowCount();

	// If it's true
	if ($count > 0) {

		// Get all occurences of their username
		$users = $stmt->fetchAll();
		$user = $users[0];
		// Then if one registered user matches with it
		if ($count == 1) {

			// And their stored hashed password matches the one given
			if (password_verify($_POST["password"], $user["password"])) {

				// Create their session variables
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];

				// Store their login details
				$subQuery = "INSERT INTO login_details (user_id) VALUES ('".$user['user_id']."')";
				$stmt = $bdd->prepare($subQuery);
				$stmt->execute();

				// Create their login id
				$_SESSION['login_details_id'] = $bdd->lastInsertId();

				// And lead them to the homepage
				header("location:index.php");
			} else {
				// Output error message if passwords don't match
				$message = "Wrong Password";
			}
		} else {
			// Output error message if there are several registered users that match
			$message = "There are multiple occurences of the name ".$_POST['username'].". Contact an admin ASAP !";
		}
	} else {
		// Output error message if there's not any registered user that match
		$message = "Wrong Username";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alumnus Chat</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<div class="container">
		<h3 align="center">Alumnus Chat - PHP Ajax Jquery</a></h3><br />
		<br>
		<div class="panel panel-default">
			<div class="panel-heading">Chat Application Form</div>
			<div class="panel-body">
				<form method="post">
					<p class="text-danger"><label><?= $message; ?></label></p>
					<div class="form-group">
						<label>Enter Username</label>
						<input type="text" name="username" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Enter Password</label>
						<input type="password" name="password" class="form-control" required />
					</div>
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-info" value="Login" />
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
