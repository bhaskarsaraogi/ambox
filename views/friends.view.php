<section>
  
  <div class="page-header"><h1><small>Friends</small></h1></div>

  <div class="search-results">
  	<?php
    if (!empty($friends)) {
      ?>
      <ul class="thumbnails">
        <?php
        foreach($friends as $friend) {
          ?>
          <li class="span3">
            <figure class="profile">
              <a class="thumbnail" href="">
                <img src="https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png" alt="" />
              </a>
              <figcaption><p class="name"><?php echo get_username($friend['user_id'],$conn); ?></a></figcaption>
            </figure>
          </li>
          <?php
        }
        ?>
      </ul>
      <?php
    }
    else {
      ?>
      <p>No results found.</p>
      <?php
    }
    ?>    
 </div>


 <div class="page-header"><h1><small>Friend Requests</small></h1></div>
  
  <div class="search-results">
  	<?php
    if (!empty($friend_requests)) {
      ?>
      <ul class="thumbnails">
        <?php
        foreach($friend_requests as $friend) {
          ?>
          <li class="span3">
            <figure class="profile">
              <a class="thumbnail" href="">
                <img src="https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png" alt="" />
              </a>
              <figcaption><p class="name"><?php echo get_username($friend['user_id'],$conn); ?></a></figcaption>
            </figure>
            <form action="" method="post">
              <input type="hidden" name="friend_request_from" value="<?php echo $friend['user_id']; ?>">
              <input type="submit" value="Accept" class="btn btn-primary span2">
            </form>
          </li>
          <?php
        }
        ?>
      </ul>
      <?php
    }
    else {
      ?>
      <p>No results found.</p>
      <?php
    }
    ?>    

<?php 
    if ($error_accept != "") {
    ?>
      <div class="alert alert-error">
        <p><?php echo $error_accept; ?></p>
      </div>
    <?php
    }
    ?>


 </div>


 <div class="page-header"><h1><small>Add Friend</small></h1></div>
  
  <div class="search-results">
  	<?php
    if (!empty($users_not_friends)) {
      ?>
      <ul class="thumbnails">
        <?php
        foreach($users_not_friends as $friend) {
          ?>
          <li class="span3">
            <figure class="profile">
              <a class="thumbnail" href="">
                <img src="https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png" alt="" />
              </a>
              <figcaption><p class="name"><?php echo get_username($friend['user_id'],$conn); ?></a></figcaption>
            </figure>
            <form action="" method="post">
              <input type="hidden" name="friend_request_to" value="<?php echo $friend['user_id']; ?>">
              <input type="submit" value="Send Request" class="btn btn-primary span2">
            </form>
          </li>
          <?php
        }
        ?>
      </ul>
      <?php
    }
    else {
      ?>
      <p>No results found.</p>
      <?php
    }
    ?>    

    <?php 
    if ($error_request != "") {
    ?>
      <div class="alert alert-error">
        <p><?php echo $error_request; ?></p>
      </div>
    <?php
    }
    ?>

 </div>

 </section>