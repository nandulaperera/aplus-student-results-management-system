<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php') ?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ManageStudentMarks/update");?>
				<?php echo validation_errors();?>
				<?php if($this->session->flashdata("addMarksSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully added student marks
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("addMarksSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student marks could not be added!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("updateMarksSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully updated student marks
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("updateMarksSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student marks could not be updated!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("deleteMarksSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully deleted student marks
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("deleteMarksSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Student marks could not be deleted!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if(isset($markDetails) and ($markDetails == null)){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Sorry. Student marks not found!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<div class="form-group row">
					<label for="subCode" class="col-sm-2 col-form-label">Subject Code</label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="subCode" placeholder="Subject Code" name="subjectCode" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->subject_code; else echo ''?>">
						<button type="submit" class="btn btn-outline-secondary ml-2" name="searchStudentMarks">Search</button>
					</div>
				</div>
				<div class="form-group row">
					<label for="subName" class="col-sm-2 col-form-label">Subject Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="subName" placeholder="Subject Name" name="subjectName" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->subject_name; else echo ''?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="subYear" class="col-sm-2 col-form-label">Year</label>
					<div class="col-sm-10">
						<select id="subYear" name="year" class="form-control">
							<option value="">Select the Year</option>
							<option value="1" <?php if(isset($markDetails) and $markDetails!=null and $markDetails->year == "1") echo 'selected';?>>1st Year</option>
							<option value="2" <?php if(isset($markDetails) and $markDetails!=null and $markDetails->year == "2") echo 'selected';?>>2nd Year</option>
							<option value="3" <?php if(isset($markDetails) and $markDetails!=null and $markDetails->year == "3") echo 'selected';?>>3rd Year</option>
							<option value="4" <?php if(isset($markDetails) and $markDetails!=null and $markDetails->year == "4") echo 'selected';?>>4th Year</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="subSem" class="col-sm-2 col-form-label">Semester</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="subSem" name="semester" min="1" max="2" placeholder="Enter the Semester" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->semester; else echo ''?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="stuid" class="col-sm-2 col-form-label">Student ID</label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="stuid" placeholder="Student ID" name="studentID" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->student_id; else echo ''?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="stuName" class="col-sm-2 col-form-label">Student Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="stuName" placeholder="Student Name" name="studentName" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->student_name; else echo ''?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="subMark" class="col-sm-2 col-form-label">Mark</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="subMark" name="studentMark" min="0" max="100" placeholder="Student Marks" value="<?php if(isset($markDetails) and $markDetails!=null) echo $markDetails->marks; else echo ''?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-outline-primary col-sm-3 mt-2" name="addStudentMarks">Add Student Marks</button>
						<button type="submit" class="btn btn-outline-success col-sm-3 mt-2" name="updateStudentMarks">Update Student Marks</button>
						<button type="submit" class="btn btn-outline-danger col-sm-3 mt-2" name="deleteStudentMarks">Delete Student Marks</button>
					</div>
				</div>
				<?php echo form_close();?>
				<div>
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
						foreach($allStudentMarks->result() as $row)
						{
							echo "<tr>";
							echo "<td>".$row->subject_code."</td>";
							echo "<td>".$row->subject_name."</td>";
							echo "<td>".$row->year."</td>";
							echo "<td>".$row->semester."</td>";
							echo "<td>".$row->student_id."</td>";
							echo "<td>".$row->student_name."</td>";
							echo "<td>".$row->marks."</td>";
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
