<?php
	session_start();
	require('connection.php');
	$query="SELECT first_name,last_name,messages.created_at, message FROM messages LEFT JOIN users ON users.id=messages.users_id WHERE users.id = '{$_SESSION['user_info']['id']}' ORDER BY messages.created_at DESC;";
	$messages = fetch_all($query);
?>
<!DOCTYPE html>
<html lang=en>
<head>
	<title>Wall</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!--[if lt IE 9]>
    	<script src="../../assets/js/html5shiv.js"></script>
    	<script src="../../assets/js/respond.min.js"></script>
  	<![endif]-->
		<!-- jQueryUI CSS -->
		<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="wall.css">
		<!-- jQuery, jQueryUI and Bootstrap.js -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<h1>CodingDojo Wall</h1>
		<form id="logout" action="process.php" method="post">
			<input type="hidden" name="action" value="logout"/>
			<input type="submit" value="logout">
		</form>
		<form id="post_message" action="process.php" method="post">
			<textarea name="message" placeholder="what's up?"></textarea>
			<input type="hidden" name="action" value="post_message"/>
			<input type="submit" value="post"/>
		</form>			
		<div class="message">
<?php
		foreach($messages as $message){
?>
			<h2><?= $message['first_name']."' '".$message['last_name']?></h2>
			<p><?= $message['message']?></p>
<?php		}
?>

		</div>
		<form id="post_comment" action="process.php" method="post">
			<input type="text" name="comment"/>
			<input type="hidden" name="action" value="post_comment"/>
			<input type="submit" value="comment">
		</form>
	</div> <!-- 	end wrapper -->
</body>
</html>