<?php echo form_open('users/login'); ?> 
	<div class="row">
		<div class="col-md-4 offset-4">
			<h1 class="text-center"><?php echo $title; ?></h1>
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
			</div>
			<button class="btn btn-primary btn-block" type="submit">Login</button>
		</div>
	</div>
<?php echo form_close(); ?>