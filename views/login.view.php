<section>
  <div class="page-header"><h1>Login to access your profile</h1></div>

  <form action="" class="form-horizontal" method="post">
  <div class="control-group">
    <label for="username" class="control-label">Username</label>
    <div class="controls">
      <div>
      <input type="text" name="username" id="username" class="span3">
      </div>
    </div>
  </div>
  <div class="control-group">
    <label for="password" class="control-label">Password</label>
    <div class="controls">
      <div>
        <input type="password" name="password" id="password" class="span3">
      </div>
    </div>
  </div>
  <div class="control-group">
      <div class="controls">
        <input type="submit" value="Login" class="btn btn-primary span2" id="signup">
      </div>
    </div>

    </form>
   <?php 
    if ($error != "") {
    ?>
      <div class="alert alert-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php
    }
    ?>
  </section>