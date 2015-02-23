<?php
	session_start();
	include('connection.php');
		//controller-router
	if(isset($_POST['action'])&& $_POST['action']=='registration'){
		register();
	}
	else if(isset($_POST['action']) && $_POST['action']=='login'){
		login();
	}
	else if(isset($_POST['action']) && $_POST['action']=='logout'){
		logout();
	}
	else if(isset($_POST['action']) && $_POST['action']=='post_message'){
		message();
	}
	else if(isset($_POST['action']) && $_POST['action']=='post_comment'){
		comment();
	} 
		//functions
function register(){
//validates registration information and if registration form completely filled out and valid enters info into wall_db
		$error_messages=array();
		$min_length=6;
		if(empty($_POST['first_name'])){			
			$error_messages['first_name']= "please enter first name";
		}
		else if(!ctype_alpha($_POST['first_name'])){		
			$error_messages['first_name']= "only letters a-z are allowed";
		}
		if(empty($_POST['last_name'])){
			$error_messages['last_name']="please enter last name";
		}
		else if(!ctype_alpha($_POST['last_name'])){
			$error_messages['last_name']="only letters a-z are allowed";
		}
		if(empty($_POST['email'])){
			$error_messages['email']="please enter email";
		}
		else if(!(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))){
			$error_messages['email']="invalid email";
		}
		if(empty($_POST['password'])){
			$error_messages['password']="please enter password";
		}
		else if(strlen($_POST['password'])<$min_length){
			$error_messages['password']="password must have more than 6 characters";
		}
		if(empty($_POST['confirm_password'])){
			$error_messages['confirm_password']="please confirm password";
		}
		else if($_POST['confirm_password']!=$_POST['password']){
			$error_messages['confirm_password']="passwords do not match, please confirm password again";
		}
				//what happens on success...(1)success message on index page (2)encode password send the login information to the database with a query 
		if(empty($error_messages)){
			$_SESSION['success']= "Registration complete!";
			$password=md5($_POST['password']);
			$query="INSERT INTO users (first_name,last_name,email,password,created_at) VALUES ('{$_POST['first_name']}','{$_POST['last_name']}','{$_POST['email']}','{$password}', NOW())";
			mysql_query($query);
		}
		else{
			$_SESSION['error']=$error_messages;
		}
		header('location: registration.php');
	}//end register()

function login(){
//checks the database for an entry with the email and password you provide in the form. If it's a match then header(wall.php)
	$password=md5($_POST['login_password']);
	$query="SELECT id,first_name,last_name,email,password FROM users WHERE email='{$_POST['login_email']}'AND password='{$password}'";
	$user= fetch_record($query);
	// var_dump($user);
	if(!empty($user)){
		$_SESSION['user_info']=$user;
		header('location: wall.php');
	}
	else{
		$_SESSION['login_error']="Invalid email/password";
		header('location: registration.php');
	}
 }
function logout(){
// destroys session and header('location: registration.php')
 	session_destroy();
 	header('location: registration.php');
 }
function message(){
//inserts message from $_POST['post_message'] into database WHERE id=$_SESSION['user_info']['id']
	$query="INSERT INTO messages(message,users_id,created_at) 
	VALUES ('{$_POST['message']}','{$_SESSION['user_info']['id']}',current_timestamp);";
	mysql_query($query);
	header('location: wall.php');
}//end message
function comment(){
	$query="INSERT INTO comments (comment,users_id,created_at) 
	VALUES ('{$_POST['comment']}','{$_SESSION['user_info']['id']}'),current_timestamp;";
	mysql_query($query);
	header('location: wall.php');
}//end comment
?>