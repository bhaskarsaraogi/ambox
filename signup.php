<?php 
session_start();
	include 'models/functions.php';
	include 'models/connect.php';
	$page_title = 'Sign Up: My Ambition Box';
	$error = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = htmlspecialchars(trim($_POST['username']));
		$password = htmlspecialchars(trim($_POST['password']));
		$passconf = htmlspecialchars(trim($_POST['passconf']));
		if(!empty($username) && !empty($password) && !empty($passconf)) {
			if(!check_username_exists($username,$conn)) {
				if ($password != $passconf) {
				$error = "Password and Confirm Password fields do not match";
				}
				else {
				$hash_password = sha1($password);
				create($username,$hash_password,$conn);
				$error = "Successful, login to access your account";
				}
			}
			else {
				$error = "Username already exists, please choose another one";
			}
		}
		else {
			 $error = "Please enter all three fields";
		}
	}

	view('signup',array('error' => $error, 'page_title' => $page_title));

?>
