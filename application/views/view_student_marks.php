<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php') ?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ViewStudentMarks/generateStudentMarks");?>
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
						<button type="submit" class="btn btn-outline-secondary ml-2" name="searchStudentMarks">Search</button>
					</div>
				</div>
				<div class="form-group row">
					<label for="subSem" class="col-sm-2 col-form-label">Semester</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="subSem" name="semester" min="1" max="2" placeholder="Enter the Semester" value="<?php if(isset($_POST['semester'])) echo $_POST['semester'];?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="subCode" class="col-sm-2 col-form-label">Subject Code</label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="subCode" placeholder="Subject Code" name="subjectCode" value="<?php if(isset($_POST['subjectCode'])) echo $_POST['subjectCode'];?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="stuid" class="col-sm-2 col-form-label">Student ID</label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="stuid" placeholder="Student ID" name="studentID" value="<?php if(isset($_POST['studentID'])) echo $_POST['studentID'];?>">
					</div>
				</div>
				<div>
					<?php if(isset($allStudentMarks) and $allStudentMarks!=null){
						echo '<button type="submit" class="btn btn-outline-primary my-2" name="downloadPDF">Download PDF</button>';
					}?>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Subject Code</th>
							<th scope="col">Subject Name</th>
							<th scope="col">Year</th>
							<th scope="col">Semester</th>
							<th scope="col">Student ID</th>
							<th scope="col">Student Name</th>
							<th scope="col">Marks</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($allStudentMarks)) {
							if ($allStudentMarks == null) {
								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Sorry. Student Marks not found!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
							} else {
								foreach ($allStudentMarks->result() as $row) {
									echo "<tr>";
									echo "<td>" . $row->subject_code . "</td>";
									echo "<td>" . $row->subject_name . "</td>";
									echo "<td>" . $row->year . "</td>";
									echo "<td>" . $row->semester . "</td>";
									echo "<td>" . $row->student_id . "</td>";
									echo "<td>" . $row->student_name . "</td>";
									echo "<td>" . $row->marks . "</td>";
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
		redirect("Student");
	}
}?>
