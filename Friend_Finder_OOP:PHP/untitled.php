// 	function	login(){
// 		// unset($errors);
// 		if(empty($_POST['login_email'])){				
// 			$errors['login'] = "Please enter an email";
// 		}
// 		if(empty($_POST['login_password'])){
// 			$errors['login'] = "Please enter a password";
// 		}	
// 		if(empty($errors)){
// 			$query = "SELECT * FROM users WHERE '{$_POST['login_email']}' = users.email && '{$_POST['login_password']}' = users.password;";  
// 			$data= mysql_query($query);
// 			// var_dump($data);
// 			// $_SESSION['user_info']
// 		}	
// 	} // end login
// };//end Process	
