<?php 
session_start();
	include 'models/functions.php';
	include 'models/connect.php';
	$error = "";
	$page_title = 'Login: My Ambition Box';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = htmlspecialchars(trim($_POST['username']));
		$password = htmlspecialchars(trim($_POST['password']));

		if(!empty($username) && !empty($password)) {
			if(check_username_exists($username,$conn)) {
				if(is_valid($username,$password,$conn)){
					$_SESSION['is_logged'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['user_id'] = get_user_id($username,$conn);
					header("location: dashboard.php");
				}
				else {
					$error = "invalid Credentials";
				}
			}
			else {
				$error = "Username does not exist";
			}
		} 
		else {
			 $error = "Please enter both username and password";
		}
	}
	
	view('login',array('error' => $error, 'page_title' => $page_title));

?>
