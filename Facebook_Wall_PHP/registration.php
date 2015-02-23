<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang=en>
<head>
	<title>Registration/Login</title>
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
	<div id="registration_error_display">
	<?php	
		if(isset($_SESSION['error'])){
			foreach($_SESSION['error'] AS $error){
				echo "<p>".$error."</p>";
			}
			unset($_SESSION['error']);
		}
	?>
	</div>
	<div id="registration_success_display">
	<?php 
		if(isset($_SESSION['success'])){
			echo "<p>".$_SESSION['success']."</p>";
		}
		unset($_SESSION['success']);
	?>
	</div>
	<form id="registration_form" action="process.php" method="post">
		First Name: <input type="text" name="first_namee"/><br />
		Last Name:  <input type="text" name="last_name"/><br />
		Email:      <input type="text" name="email"/><br />
		Password:   <input type="text" name="password"/><br />
		Confirm	Password:   <input type="text" name="confirm_password"/><br />
		<input type="hidden" name="action" value="registration"/>
		<input type="submit" value="submit"><br />	
	</form>
	<div id="login_error_display">
	</div>
	<form id="login_form" action="process.php" method="post">
		Login Email: <input type="text" name="login_email"><br />
		Password: <input type="text" name="login_password"><br />
		<input type="hidden" name="action" value="login">
		<input type="submit" value="login">
	</form>
</body>
</html>