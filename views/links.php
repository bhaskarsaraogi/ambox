<?php
  $site_url = 'localhost/myambitionbox/';
  if (isset($_SESSION['is_logged']))
  {
    $links = array(
      0 => 'dashboard.php',
      1 => 'friends.php',
      2 => 'logout.php'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Friends',
      2 => 'Logout'
      );
  }
  else {
    $links = array(
      0 => 'signup.php',
      1 => 'login.php'
      );
    $links_text = array(
      0 => 'SignUp',
      1 => 'Login'
      );
  }
