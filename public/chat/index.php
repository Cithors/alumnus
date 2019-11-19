<?php
	include '../../src/inc/header.php';

	if (!in_array(isUser(), [-1, 1])) {
		header('location: '.SIGNIN);
	} else if (!isset($_SESSION['username'])) {
		header('location: signin.php');
	}

	// $start = exec("php -aG server.php");
	// include_once '../src/inc/header.php';
	$colors = array(
		'#007AFF',
		'#FF7000',
		'#FF7000',
		'#15E25F',
		'#CFC700',
		'#CFC700',
		'#CF1100',
		'#CF00BE',
		'#F00'
	);
	$color_pick = array_rand($colors);

	$names = array(
		'Your Name...',
		'Pick A Nick...'
	);
	$pName = $names[array_rand($names)];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alumnus Chat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= CSS ?>chat.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<div class="container">
		<h3 align="center">Alumnus Chat - PHP Ajax Jquery</a></h3><br />
		<div class="table-responsive">
			<h4 align="center">Online User</h4>
			<p align="right">
				Hi - <?= $_SESSION['username']; ?> - <a href="signout.php">Logout</a>
			</p>
		</div>
	</div>
	<div class="chat-wrapper">
		<div id="message-box"></div>
		<div class="user-panel">
			<input type="text" name="name" id="name" placeholder="<?= $_SESSION['username']; ?>" value="<?= $_SESSION['username']; ?>" maxlength="15" disabled/>
			<input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" />
			<button id="send-message">Send</button>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		// Create a new WebSocket object.
		var msgBox = $('#message-box');
		var wsUri = "ws://localhost:9000/server.php";
		websocket = new WebSocket(wsUri);

		websocket.onopen = function(ev) { // connection is open
			msgBox.append("<center class='system_msg'>Welcome to Alumnus WebSocket Chat Box !</center>"); //notify user
		}
		// Message received from server
		websocket.onmessage = function(ev) {
			var response 		= JSON.parse(ev.data); //PHP sends Json data
			var res_type 		= response.type; //message type
			var user_message 	= response.message; //message text
			var user_name 		= response.name; //user name
			var user_color 		= response.color; //color

			switch(res_type){
				case 'user':
					msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
					break;
				case 'system':
					msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
					break;
			}
			msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message

		};

		websocket.onerror	= function(ev){ msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>'); };
		websocket.onclose 	= function(ev){ msgBox.append('<div class="system_msg">Connection Closed</div>'); };

		//Message send button
		$('#send-message').click(function(){
			send_message();
		});

		//User hits enter key
		$( "#message" ).on( "keydown", function( event ) {
			if(event.which==13){
				send_message();
			}
		});

		//Send message
		function send_message(){
			var message_input = $('#message'); //user message text
			var name_input = $('#name'); //user name

			if(name_input.val() == ""){ //empty name?
				alert("Enter your Name please!");
				return;
			}
			if(message_input.val() == ""){ //emtpy message?
				alert("Enter Some message Please!");
				return;
			}

			//prepare json data
			var msg = {
				message: message_input.val(),
				name: name_input.val(),
				color : '<?php echo $colors[$color_pick]; ?>'
			};
			//convert and send data to server
			websocket.send(JSON.stringify(msg));
			message_input.val(''); //reset message input
		}
	</script>
</body>
</html>
