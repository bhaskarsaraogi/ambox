<?php 
session_start();
	include 'models/functions.php';
	include 'models/connect.php';
	$page_title = 'Dashboard: My Ambition Box';
	$error = "";

	if(!is_logged()) {
		header("location: login.php");
	}
	else {
	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$status = htmlspecialchars(trim($_POST['status']));

			if (!empty($status)) {
				set_update($_SESSION['user_id'],$status,$conn);
				$error = "Status updated!";
			}
			else {
				$error = "Please enter a status";
			}
		}

		$results = get_updates($_SESSION['user_id'],$conn);
		$updates =  array();
		if ($results) {
			while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
				array_push($updates,$result);
			}	
		}
	}



	view('dashboard',array('updates' => $updates, 'conn' => $conn, 'error' => $error, 'page_title' => $page_title));