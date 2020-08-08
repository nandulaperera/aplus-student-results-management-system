<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php');?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ViewSubject/generateSubjects");?>
				<?php echo validation_errors();?>
					<div class="form-row">
						<div class="col-sm-4">
							<div class="form-group row">
								<label for="subYear" class="col-sm-2 col-form-label">Year</label>
								<div class="col-sm-10">
									<select id="subYear" name="year" class="form-control">
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
						<div class="col-sm-6">
							<div class="form-group row">
								<label for="subSem" class="col-sm-3 col-form-label">Semester</label>
								<div class="col-sm-7">
									<input type="number" class="form-control" id="subSem" name="semester" min="1" max="2" placeholder="Enter the Semester" value="<?php if(isset($_POST['semester'])) echo $_POST['semester'];?>">
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-outline-secondary" name="searchSubjects">Search</button>
						</div>
					</div>

				<div>
					<?php if(isset($allSubjects) and $allSubjects!=null){
						echo '<button type="submit" class="btn btn-outline-primary my-2" name="downloadPDF">Download PDF</button>';
					}?>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Subject Code</th>
							<th scope="col">Subject Name</th>
							<th scope="col">Year</th>
							<th scope="col">Semester</th>
							<th scope="col">Lecture Credits</th>
							<th scope="col">Practical Credits</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($allSubjects)) {
							if($allSubjects == null){
								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Sorry. Subjects not found!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';
							}else {
								foreach ($allSubjects->result() as $row) {
									echo "<tr>";
									echo "<td>" . $row->subject_code . "</td>";
									echo "<td>" . $row->subject_name . "</td>";
									echo "<td>" . $row->year . "</td>";
									echo "<td>" . $row->semester . "</td>";
									echo "<td>" . $row->lecture_credits . "</td>";
									echo "<td>" . $row->practical_credits . "</td>";
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
