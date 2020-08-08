<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<link rel="icon" href='<?php echo base_url('assets/images/logo.png');?>'>
  	<link href='<?php echo base_url('assets/css/signin.css');?>' rel="stylesheet">
  </head>
  <body class="text-center">
  <?php echo form_open("Login/loginUser","class='form-signin'");?>
  		<?php echo validation_errors();?>
		<a href="./Home"><img class="mb-4" src='<?php echo base_url('assets/images/logo.png');?>' alt="" width="72" height="72"></a>
		<?php
		if($this->session->flashdata("login_success")){
			echo ("<h3 class='text-success'>".$this->session->flashdata('registration_success')."</h3>");
		}else{
			if($this->session->flashdata("login_error")){
				echo ("<h3 class='text-danger'>".$this->session->flashdata('login_error')."</h3>");
			}
			echo('
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend">
                    <span class="input-group-text" style="width: 35px;height: 46px">
                        <span class="fa fa-envelope"></span>
                    </span>
				</div>
				<input type="email" class="form-control" placeholder="Email" name="email">
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-prepend" style="width:35px; height: 46px">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
				</div>
				<input type="password" class="form-control" placeholder="Password" name="password">
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Sign in</button>
		');
			}?>
		<label class="mt-3">Don't have an account? <a href="Register">Sign Up</a></label>

	<?php echo form_close();?>
</body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>
