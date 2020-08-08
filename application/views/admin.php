<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php') ?>

		<div class="d-flex">
			<div class="container mt-5 row mx-auto">
				<div class="row mx-auto" style="width: 100%">
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm align-items-center">
							<img src="<?php echo base_url('assets/images/subject.png');?>" style="height: 128px;width: 128px;" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Subjects</h5>
								<p class="card-text"></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group mx-auto">
										<button type="button" class="btn btn-sm btn-outline-primary" onclick="document.location='<?php echo base_url("index.php/ManageSubject")?>'">View Page</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm align-items-center">
							<img src="<?php echo base_url('assets/images/student.png');?>" style="height: 128px;width: 128px;" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Students</h5>
								<p class="card-text"></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group mx-auto">
										<button type="button" class="btn btn-sm btn-outline-primary" onclick="document.location='<?php echo base_url("index.php/ManageStudent")?>'">View Page</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm align-items-center">
							<img src="<?php echo base_url('assets/images/marks.png');?>" style="height: 128px;width: 128px;" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Student Marks</h5>
								<p class="card-text"></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group mx-auto">
										<button type="button" class="btn btn-sm btn-outline-primary" onclick="document.location='<?php echo base_url("index.php/ManageStudentMarks")?>'">View Page</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('templates/footer.php') ?>
	<?php
	} else {
		redirect("Student");
	}
}?>
