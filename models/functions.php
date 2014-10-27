<?php 

//connect to the database
function connect($config)
{	try {
		$conn  = new PDO('mysql:host=localhost;dbname='.$config['db'],
						  $config['user'],
						  $config['pass']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	} catch(Exception $e) {
		return false;
	}
}

// loads the view
function view($view, $data = null) {
	if($data) extract($data);	
	$view_path = 'views/'.$view.'.view.php';
	require 'views/layout.php';
}


//do a query
function query($query, $binding, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($binding);
	return ($stmt->rowCount() > 0) ? $stmt : false;
	// $results = $stmt->fetch(PDO::FETCH_ASSOC);
	// return $results ? $results : false;
}

// checks if the given username exists
function check_username_exists($username,$conn)
{
	$results =  query('SELECT * FROM user_master WHERE username = :username LIMIT 1',
				 array('username' => $username),
				 $conn);
	return $results ? true : false;
}

// login validation
function is_valid($username,$password,$conn)
{	
	$hash_password = sha1($password);
	$result =  query('SELECT password FROM user_master WHERE username = :username LIMIT 1',
				 array('username' => $username),
				 $conn);
	if ($result) {
		$result = $result->fetch(PDO::FETCH_ASSOC);
		if($hash_password == $result['password']) {
			return true;
		}
	}
	return false;		
}

// fetch user_id for a given username
function get_user_id($username,$conn)
{
	$result =  query('SELECT user_id FROM user_master WHERE username = :username LIMIT 1',
				 array('username' => $username),
				 $conn);
	if ($result) {
		$result = $result->fetch(PDO::FETCH_ASSOC);
		return $result['user_id'];
	}
	return false;	
}

// fetch username for a given user_id
function get_username($user_id,$conn)
{
	$result =  query('SELECT username FROM user_master WHERE user_id = :user_id LIMIT 1',
				 array('user_id' => $user_id),
				 $conn);
	if ($result) {
		$result = $result->fetch(PDO::FETCH_ASSOC);
		return $result['username'];	
	}
	return false;	
}


// signup
function create($username,$hash_password,$conn)
{
	$sql = "INSERT INTO user_master(username,password) VALUES (:username,:password)";
	$stmt = $conn->prepare($sql);

    $stmt->execute(array('username' => $username,
                         'password' => $hash_password));
    return ($stmt->rowCount() > 0) ? true : false;
}

// gets last 20 status updates of friends and themselves
function get_updates($user_id,$conn)
{	
	$results = query('SELECT user_master_id,user_status,timestamp FROM user_update WHERE user_master_id IN (SELECT derivedTable.friend_id as fid FROM(
(SELECT F.friend_request_to AS friend_id FROM user_friend_requests AS F WHERE F.friend_request_from = :friend_request_from AND F.friend_request_accepted = 1)
UNION
(SELECT G.friend_request_from AS friend_id FROM user_friend_requests AS G WHERE G.friend_request_to = :friend_request_to AND G.friend_request_accepted = 1)
UNION
(SELECT H.user_id AS friend_id FROM user_master AS H WHERE H.user_id = :user_id)) AS derivedTable) ORDER BY timestamp DESC LIMIT 20',
			  		  array('friend_request_from' => $user_id,
						  	'friend_request_to' => $user_id,
						  	'user_id' => $user_id),
			  		  $conn);
	if ($results) {
		return $results;
	}
	return false;	
}

// gets the friend list
function get_friends($user_id, $conn)
{
	$results = query('SELECT derivedTable.friend_id as user_id FROM(
					(SELECT F.friend_request_to AS friend_id FROM user_friend_requests AS F WHERE F.friend_request_from = :friend_request_from AND F.friend_request_accepted = 1)
					UNION
					(SELECT G.friend_request_from AS friend_id FROM user_friend_requests AS G WHERE G.friend_request_to = :friend_request_to AND G.friend_request_accepted = 1)) AS derivedTable',
					array('friend_request_from' => $user_id,
						  'friend_request_to' => $user_id),
					$conn);
	if ($results) {
		return $results;
	}
	return false;
}


// updates the status
function set_update($user_master_id,$update,$conn)
{
	$sql = "INSERT INTO user_update(user_master_id,user_status) VALUES (:user_master_id,:user_status)";
	$stmt = $conn->prepare($sql);

    $stmt->execute(array('user_master_id' => $user_master_id,
                         'user_status' => $update));
    return ($stmt->rowCount() > 0) ? true : false;
}


// gets the users on network who are not friends
function get_users_not_friends($user_id,$conn)
{
	$results = query('SELECT * FROM user_master WHERE user_id NOT IN (SELECT derivedTable.friend_id as fid FROM(
					(SELECT F.friend_request_to AS friend_id FROM user_friend_requests AS F WHERE F.friend_request_from = :friend_request_from)
					UNION
					(SELECT G.friend_request_from AS friend_id FROM user_friend_requests AS G WHERE G.friend_request_to = :friend_request_to)
					UNION
					(SELECT H.user_id AS friend_id FROM user_master AS H WHERE H.user_id = :user_id)) AS derivedTable)',
					array('friend_request_from' => $user_id,
						  'friend_request_to' => $user_id,
						  'user_id' => $user_id),
			  		$conn);
	if ($results) {
		return $results;
	}
	return false;
}


// get the pending friend requests for a given user
function get_friend_requests($user_id,$conn)
{
	$results = query('SELECT friend_request_from AS user_id FROM user_friend_requests WHERE friend_request_to = :friend_request_to AND friend_request_accepted = 0',
					 array('friend_request_to' => $user_id),
					 $conn);
	if ($results) {
		return $results;
	}
	return false;

}

// sends a friend request t a particular user
function send_friend_request($friend_request_to,$friend_request_from,$conn)
{
	$results = get_users_not_friends($friend_request_from,$conn);
	$users_not_friends =  array();
	if ($results) {
		while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
			array_push($users_not_friends,$result['user_id']);
		}
		if(in_array($friend_request_to, $users_not_friends)) {
			$sql = "INSERT INTO user_friend_requests(friend_request_to,friend_request_from) VALUES (:friend_request_to,:friend_request_from)";
			$stmt = $conn->prepare($sql);

    		$stmt->execute(array('friend_request_to' => $friend_request_to,
            		             'friend_request_from' => $friend_request_from));
    		return ($stmt->rowCount() > 0) ? true : false;
		}	
	}
	return false;
}

// accepts a pendidng friend request
function accept_friend_request($friend_request_to,$friend_request_from,$conn)
{
	$results = get_friend_requests($friend_request_to,$conn);
	$friend_requests =  array();
	if ($results) {
		while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
			array_push($friend_requests,$result['user_id']);
		}
		if(in_array($friend_request_from, $friend_requests)) {
			$sql = "UPDATE user_friend_requests SET friend_request_accepted = 1 WHERE friend_request_to = :friend_request_to AND friend_request_from = :friend_request_from";
			$stmt = $conn->prepare($sql);

    		$stmt->execute(array('friend_request_to' => $friend_request_to,
            		             'friend_request_from' => $friend_request_from));
    		return ($stmt->rowCount() > 0) ? true : false;
		}
	}
	
	return false;

}

// checks if the user is logged in
function is_logged()
{
	 return (isset($_SESSION['username']) && isset($_SESSION['is_logged']) && isset($_SESSION['user_id']));
}

		