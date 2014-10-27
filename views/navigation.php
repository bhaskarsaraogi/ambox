<?php
require_once('links.php');

$currentpage = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<ul class="nav nav-pills">
  <?php
  for ($i =0; $i < count($links); $i++):
    $page = $links[$i];
  if ($page == $currentpage):
    ?>
  <li class="active"><a href="<?php echo $links[$i]; ?>"><?php echo $links_text[$i]; ?></a></li>
  <?php
  else:
    ?>
  <li><a href="<?php echo $links[$i]; ?>"><?php echo $links_text[$i]; ?></a></li>
  <?php
  endif;
  endfor;
  ?>
</ul>