<?php 
session_start();
	include 'models/functions.php';
	include 'models/connect.php';
	$page_title = 'Friends: My Ambition Box';
	$error_request = "";
	$error_accept = "";

	if(!is_logged()) {
		header("location: login.php");
	}
	else {

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if (isset($_POST['friend_request_to']) && !empty($_POST['friend_request_to'])) {
				$output = send_friend_request($_POST['friend_request_to'],$_SESSION['user_id'],$conn); 
				if (!$output) {
					$error_request = "Problem sending request!";
				}
			}

			if (isset($_POST['friend_request_from']) && !empty($_POST['friend_request_from'])) {
				$output = accept_friend_request($_SESSION['user_id'],$_POST['friend_request_from'],$conn); 
				if (!$output) {
					$error_accept = "Problem accepting request!";
				}
			}			

		}

		$results = get_friends($_SESSION['user_id'],$conn);
		$friends =  array();
		if ($results) {
			while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
				array_push($friends,$result);
			}	
		}

		$results = get_friend_requests($_SESSION['user_id'],$conn);
		$friend_requests =  array();
		if ($results) {
			while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
				array_push($friend_requests,$result);
			}	
		}

		$results = get_users_not_friends($_SESSION['user_id'],$conn);
		$users_not_friends =  array();
		if ($results) {
			while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
				array_push($users_not_friends,$result);
			}	
		}

	}

	view('friends',array('friends' => $friends, 'friend_requests' => $friend_requests, 'users_not_friends' => $users_not_friends,  'conn' => $conn, 'error_accept' => $error_accept, 'error_request' => $error_request, 'page_title' => $page_title));