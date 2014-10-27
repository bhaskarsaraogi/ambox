<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title; ?></title>
	<link rel="icon" type="favicon" href="http://localhost/ambox/public/img/favicon.ico"/>
  	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css" rel="stylesheet" />
  	<link rel="stylesheet" type="text/css" href="public/css/font-awesome.min.css">
  	<!--[if IE 7]>
  		<link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
  	<![endif]-->
  	<link rel="stylesheet" type="text/css" href="public/css/style.css" rel="stylesheet" />
  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
  	<link href='http://fonts.googleapis.com/css?family=Crimson+Text:700,400' rel='stylesheet' type='text/css'>
  	<script src="public/js/jquery.js" type="text/javascript"></script>
  	<script src="public/js/humanize.min.js" type="text/javascript"></script>
  	<script src="public/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/script.js" type="text/javascript"></script>
</head>
<body>
  <div class="container">
    <header class="row" role="banner">
      <div class="span4">
        <h1><a href="http://localhost/ambox">My Amb Box</a></h1>
      </div>
      <div class="span8">
        <nav class="navbar" role="navigation">
          <?php include 'navigation.php'; ?>
        </nav>
      </div>
    </header>
    <div class="row">
      <article class="span12 content" role="content">

	       <?php include($view_path); ?>
      
      </article>  
    </div>
    <footer class="row" role="footer">
      <div class="span12">
        <p></p>
        <p></p>
      </div>
    </footer>
  </div>
</body>
</html>
