<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Student") {
		?>
		<?php include('templates/header.php') ?>
		<div class="card mx-auto mt-5" style="width: 75%;">
			<h5 class="card-header text-center bg-light"><?php echo $this->session->userdata('name')?></h5>
			<div class="card-body row">
				<div class="col-md-6">
					<h5 class="card-title text-center text-primary">Current GPA</h5>
					<h3 class="card-title text-center"><?php if(isset($studentResults)) echo(number_format($studentResults->gpa,4)); else echo '0.00';?></h3>
				</div>
				<div class="col-md-6">
					<h5 class="card-title text-center text-primary">Degree Information</h5>
					<h3 class="card-title text-center"><?php if(isset($studentResults)) echo($studentResults->class); else echo '-';?></h3>
				</div>
			</div>
		</div>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("Student/generateResults");?>
				<?php echo validation_errors();?>
				<div class="form-group row">
					<label for="subYear" class="col-sm-2 col-form-label">Year</label>
					<div class="col-sm-10 input-group">
						<select id="subYear" name="year" class="form-control">
							<option value="">Select the Year</option>
							<option value="1" <?php if(isset($_POST['year']) and $_POST['year'] == "1") echo 'selected';?>>1st Year</option>
							<option value="2" <?php if(isset($_POST['year']) and $_POST['year'] == "2") echo 'selected';?>>2nd Year</option>
							<option value="3" <?php if(isset($_POST['year']) and $_POST['year'] == "3") echo 'selected';?>>3rd Year</option>
							<option value="4" <?php if(isset($_POST['year']) and $_POST['year'] == "4") echo 'selected';?>>4th Year</option>
							<option value="0" <?php if(isset($_POST['year']) and $_POST['year'] == "0") echo 'selected';?>>All Years</option>
						</select>
						<button type="submit" class="btn btn-outline-secondary ml-2" name="searchStudentResults">Search</button>
					</div>
				</div>
				<div class="form-group row">
					<label for="subSem" class="col-sm-2 col-form-label">Semester</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="subSem" name="semester" min="1" max="2" placeholder="Enter the Semester" value="<?php if(isset($_POST['semester'])) echo $_POST['semester'];?>">
					</div>
				</div>
				<div>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Subject Code</th>
							<th scope="col">Subject Name</th>
							<th scope="col">Year</th>
							<th scope="col">Semester</th>
							<th scope="col">Grade</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($allStudentResults)) {
							if ($allStudentResults == null) {
								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Sorry. Results not found!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
							} else {
								foreach ($allStudentResults->result() as $row) {
									echo "<tr>";
									echo "<td>" . $row->subject_code . "</td>";
									echo "<td>" . $row->subject_name . "</td>";
									echo "<td>" . $row->year . "</td>";
									echo "<td>" . $row->semester . "</td>";
									echo "<td>" . $row->grade . "</td>";
									echo "</tr>";
								}
							}
						}
						?>
						</tbody>
					</table>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
		<?php include('templates/footer.php') ?>
		<?php
	} else {
		redirect("Admin");
	}
}?>
