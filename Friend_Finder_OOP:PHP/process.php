<?php
include("connection.php");
session_start();
class Process{
	var $connection;
	function __construct(){
		$errors = array();
		$this->connection = new Database();
		if(isset($_POST['action']) && $_POST['action'] == 'registration'){
			$this->register();
		}
		elseif(isset($_POST['action']) && $_POST['action']=='login'){
			$this->login();
		}
		else if(isset($_POST['action']) && $_POST['action']=='add_friend'){
			var_dump($_POST);
			// $this->add_friend();
		}
		else{
			session_destroy();
			header('location: index.php');
		}
	} // end __construct
	function register(){
			//validates registration info
		if(empty($_POST['first_name'])){		
			$errors['first_name'] = "Please enter first name";
		}
		else if(!ctype_alpha($_POST['first_name'])){
			$errors['first_name'] = "Invalid first name (must only contain letters A-Z)";
		}
		if(empty($_POST['last_name'])){		
			$errors['last_name'] = "Please enter last name";
		}
		else if(!ctype_alpha($_POST['last_name'])){
			$errors['last_name'] = "Invalid last name (must only contain letters A-Z)";
		}
		if(empty($_POST['email'])){
			$errors['email'] = "Please enter email";
		}
		else if(!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
			$errors['email'] = "Invalid email";
		}
		if(empty($_POST['confirm_password'])){
			$errors['confirm_password'] = "Please confirm password";
		}
		else if($_POST['confirm_password'] != $_POST['password']){
			$errors['confirm_password'] = "Passwords do not match";
		}
		if(empty($_POST['password'])){
			$errors['password'] = "Please enter password";
		}
		else if (strlen($_POST['password']) < 6){
			$errors['password'] = "Password length too short (must be over 6 characters)";
		}
			//enters valid registration info into database and returns to index
		if(empty($errors)){
			$query= "INSERT INTO users (first_name, last_name, email, password,created_at,updated_at) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}','{$_POST['password']}', NOW(), NOW());";
			mysql_query($query);
			$success = "New user created successfully";
			$_SESSION['success'] = $success;
			header("location: index.php");
		} 
		else{
			$_SESSION['register_errors']=$errors;
			header("location: index.php");
		}
	} // end register()	
	function display_friends(){
		$query = "SELECT id, first_name, last_name, email FROM friends LEFT JOIN users ON friends.friend_id = users.id WHERE user_id = '{$_SESSION['user_info']['id']}';";
		$friends = $this->connection->fetch_all($query);
		$_SESSION['display_friends'] = $friends;
	}//end display_friends
	function login(){
		$query = "SELECT * FROM users WHERE '{$_POST['login_email']}' = users.email && '{$_POST['login_password']}' = users.password;";  
		$data = $this->connection->fetch_all($query);
		if(!empty($data)){
			$_SESSION['user_info'] = $data;
			$_SESSION['user_info']['first_name'] = $data[0]['first_name'];
			$_SESSION['user_info']['last_name'] = $data[0]['last_name'];
			$_SESSION['user_info']['email'] = $data[0]['email'];
			$_SESSION['user_info']['id'] = $data[0]['id'];
			$_SESSION['logged_in'] = TRUE;
			unset($_POST['action']);
			$this->display_friends();
			$this->display_users();
			header('location: wall.php');
		}		
		else{
			$login_error = "Invalid email/password";
			$_SESSION['login_errors'] = $login_error;
			header('location: index.php');
		}
	} //end login
	function display_users(){
		$query= "SELECT id, first_name, last_name, email FROM users;";
		$users = $this->connection->fetch_all($query);
		$_SESSION['users'] = $users;
		// echo "<pre>";
		// var_dump($users);
		// echo "</pre>";
		// die();
	}
	function add_friend(){
				$query1= "INSERT INTO friends (user_id,friend_id) VALUES ('{$_SESSION['user_info']['id']}','{$_POST['friend_id']}');";
				mysql_query($query1);
					//for parallel frienship making
				// $query2= "INSERT INTO friends (friend_id,user_id) VALUES ('{$_SESSION['user_info']['id']}','{$_POST['friend_id']}');";
				// mysql_query($query2);
				$this->display_friends();
				header("location: wall.php");
	}
} //end Process
$process = new Process();

//you have to display users with a button to add that triggers $_POST['add_friend'] for this to work
	// function create_friend(){
	// 	$query = "INSERT INTO friends (user_id, friend_id) VALUES ('{$_SESSION['user_info']['id']}', '{$_POST['add_friend']}');";
	// 	mysql_query($query)
	// you'll also need to create a form that triggers the function and put something in the construct function that looks for the form 
	// coming through, identifies it, and runs the create friend function when this happens.
	// create the form first so you can test that it works with a var_dump() on the process page or something, then build the function 
	// out AND YOU'RE DONE :)
?>	

