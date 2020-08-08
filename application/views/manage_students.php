<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php') ?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ManageStudent/update");?>
				<?php echo validation_errors();?>
				<?php if($this->session->flashdata("addStudentSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully added student
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("addStudentSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student could not be added!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("updateStudentSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully updated student
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("updateStudentSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student could not be updated!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("deleteStudentSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully deleted student
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("deleteStudentSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student could not be deleted!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if(isset($studentDetails) and ($studentDetails == null)){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Sorry. Student not found!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<div class="form-group row">
					<label for="stuid" class="col-sm-2 col-form-label">Student ID</label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="stuid" placeholder="Student ID" name="studentID" value="<?php if(isset($studentDetails) and $studentDetails!=null) echo $studentDetails->student_id; else echo ''?>">
						<button type="submit" class="btn btn-outline-secondary ml-2" name="searchStudent">Search</button>
					</div>
				</div>
				<div class="form-group row">
					<label for="stuName" class="col-sm-2 col-form-label">Student Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="stuName" placeholder="Student Name" name="studentName" value="<?php if(isset($studentDetails) and $studentDetails!=null) echo $studentDetails->student_name; else echo ''?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="stuYear" class="col-sm-2 col-form-label">Year of Study</label>
					<div class="col-sm-10">
						<select id="stuYear" name="year" class="form-control">
							<option value="">Select the Year</option>
							<option value="1" <?php if(isset($studentDetails) and $studentDetails!=null and $studentDetails->year == "1") echo 'selected';?>>1st Year</option>
							<option value="2" <?php if(isset($studentDetails) and $studentDetails!=null and $studentDetails->year == "2") echo 'selected';?>>2nd Year</option>
							<option value="3" <?php if(isset($studentDetails) and $studentDetails!=null and $studentDetails->year == "3") echo 'selected';?>>3rd Year</option>
							<option value="4" <?php if(isset($studentDetails) and $studentDetails!=null and $studentDetails->year == "4") echo 'selected';?>>4th Year</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="stuEmail" class="col-sm-2 col-form-label">Student Email</label>
					<div class="col-sm-10 input-group">
						<input type="email" class="form-control" id="stuEmail" placeholder="Student Email" name="studentEmail" value="<?php if(isset($studentDetails) and $studentDetails!=null) echo $studentDetails->email; else echo ''?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-outline-primary col-sm-3 mt-2" name="addStudent">Add Student</button>
						<button type="submit" class="btn btn-outline-success col-sm-3 mt-2" name="updateStudent">Update Student</button>
						<button type="submit" class="btn btn-outline-danger col-sm-3 mt-2" name="deleteStudent">Delete Student</button>
					</div>
				</div>
				<?php echo form_close();?>
				<div>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Student ID</th>
							<th scope="col">Student Name</th>
							<th scope="col">Year</th>
							<th scope="col">Student Email</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($allStudents->result() as $row)
						{
							echo "<tr>";
							echo "<td>".$row->student_id."</td>";
							echo "<td>".$row->student_name."</td>";
							echo "<td>".$row->year."</td>";
							echo "<td>".$row->email."</td>";
							echo "</tr>";
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include('templates/footer.php') ?>
		<?php
	} else {
		redirect("Student");
	}
}?>
