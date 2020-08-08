<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href='<?php echo base_url('assets/images/logo.png');?>'>
	<title>A+</title>
</head>
<body style="margin-bottom: 50px">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?php if($this->session->userdata('loggedIn')){
		if($this->session->userdata('role') =='Admin'){
			echo base_url("./index.php/Admin");
		}else if($this->session->userdata('role') == 'Student'){
			echo './Student';
		}
		}else{
			echo './Home';
		}?>">
		<img src='<?php echo base_url('assets/images/logo.png');?>' width="
		}
		}30" height="30" class="d-inline-block align-top" alt="">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<?php if(!$this->session->userdata('loggedIn')){?>
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				<?php }else{
					if($this->session->userdata('role') == "Admin"){?>
						<div class="btn-group">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Subjects
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="./ManageSubject">Manage Subjects</a>
									<a class="dropdown-item" href="./ViewSubject">View Subjects</a>
								</div>
							</li>
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Students
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="./ManageStudent">Manage Students</a>
									<a class="dropdown-item" href="./ViewStudent">View Student Details</a>
								</div>
							</li>
						</ul>
						<ul class="navbar-nav mr-auto">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Student Marks
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="./ManageStudentMarks">Manage Student Marks</a>
									<a class="dropdown-item" href="./ViewStudentMarks">View Student Mark Report</a>
								</div>
							</li>
						</ul>
						</div>
					<?php }?>
				<?php }?>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<?php if(!$this->session->userdata('loggedIn')){?>
			<button class="btn btn-outline-primary my-2 my-sm-0 mr-2" onclick="document.location='<?php echo base_url('index.php/Login')?>'" type="button">Login</button>
			<button class="btn btn-outline-primary my-2 my-sm-0 mr-2" onclick="document.location='<?php echo base_url('index.php/Register')?>'" type="button">Register</button>
			<?php }else{ ?>
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo $this->session->userdata('name')?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="UserProfile">Profile</a>
						<a class="dropdown-item" href="Login/logout">Log Out</a>
					</div>
				</li>
			</ul>
			<?php }?>
		</form>
	</div>
</nav>

