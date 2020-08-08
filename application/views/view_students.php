<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php');?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ViewStudent/generateStudents");?>
				<?php echo validation_errors();?>
				<div class="form-row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label for="stuYear" class="col-sm-2 col-form-label">Year</label>
							<div class="col-sm-10">
								<select id="stuYear" name="year" class="form-control">
									<option value="">Select the Year</option>
									<option value="1" <?php if(isset($_POST['year']) and $_POST['year'] == "1") echo 'selected';?>>1st Year</option>
									<option value="2" <?php if(isset($_POST['year']) and $_POST['year'] == "2") echo 'selected';?>>2nd Year</option>
									<option value="3" <?php if(isset($_POST['year']) and $_POST['year'] == "3") echo 'selected';?>>3rd Year</option>
									<option value="4" <?php if(isset($_POST['year']) and $_POST['year'] == "4") echo 'selected';?>>4th Year</option>
									<option value="0" <?php if(isset($_POST['year']) and $_POST['year'] == "0") echo 'selected';?>>All Years</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-outline-secondary" name="searchStudents">Search</button>
					</div>
				</div>

				<div>
					<?php if(isset($allStudents) and $allStudents!=null){
						echo '<button type="submit" class="btn btn-outline-primary my-2" name="downloadPDF">Download PDF</button>';
					}?>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Student ID</th>
							<th scope="col">Student Name</th>
							<th scope="col">Year</th>
							<th scope="col">Email</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($allStudents)) {
							if($allStudents == null){
								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Sorry. Students not found!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';
							}else {
								foreach ($allStudents->result() as $row) {
									echo "<tr>";
									echo "<td>" . $row->student_id . "</td>";
									echo "<td>" . $row->student_name . "</td>";
									echo "<td>" . $row->year . "</td>";
									echo "<td>" . $row->email . "</td>";
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
		<?php include('templates/footer.php');?>
		<?php
	} else {
		redirect("Student");
	}
}?>
