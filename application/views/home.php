<?php include('templates/header.php') ?>
<?php if($this->session->userdata('loggedIn')){
	if ($this->session->userdata('role') == "Admin") {
		redirect("Admin");
	}else if($this->session->userdata('role') == "Student") {
		redirect("Student");
	}?>

<?php
}?>
<?php include ('templates/footer.php')?>
