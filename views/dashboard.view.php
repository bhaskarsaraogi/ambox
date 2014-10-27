<section>
	
	<div class="page-header"><h1>Updates<small> from friends</small></h1></div>

	<div id="public" class="control-group span8">
	
	<ul class="testimonial-list">
	<?php foreach ($updates as $update) {?>
		<li class="well well-small">
		<p><?php echo $update['user_status']; ?></p>
		<p class="written-by">&ndash;&nbsp;<?php echo get_username($update['user_master_id'],$conn); ?></p>
        <p>Time: <?php echo $update['timestamp']; ?></p>
        </li>
     <?php } ?>
    </ul>
    
	</div>

	<div class="control-group">
		
		<form action="" method="post">
			<div class="control-group">
    			<div class="controls">
    				<textarea name="status" id="status" class="span6" rows="6">

    				</textarea>
    			</div>
    		</div>	
    		<div class="control-group">
    			<div class="controls">
    				<input type="submit" value="Update" class="btn btn-info span6" id="update">
    			</div>
    		</div>
		</form>
	</div>	

	<?php 
    if ($error != "") {
    ?>
    <div class="control-group">
      <div class="alert alert-error">
        <p><?php echo $error; ?></p>
      </div>
    </div>
    <?php
    }
    ?>

</section>