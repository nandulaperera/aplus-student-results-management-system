<?php
if(!$this->session->userdata('loggedIn')){
	redirect("Home/Login");
}else {
	if ($this->session->userdata('role') == "Admin") {
		?>
		<?php include('templates/header.php');?>
		<div class="d-flex min-vh-100">
			<div class="container mt-5">
				<?php echo form_open("ManageSubject/update");?>
					<?php echo validation_errors();?>
				<?php if($this->session->flashdata("addSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully added subject
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("addSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Subject could not be added!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("updateSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully updated subject
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("updateSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Subject could not be updated!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if($this->session->flashdata("deleteSuccess") == "Success"){?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Successfully deleted subject
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }else if($this->session->flashdata("deleteSuccess") == "Fail"){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Oops. Something went wrong. Subject could not be deleted!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
				<?php if(isset($subjectDetails) and ($subjectDetails == null)){?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Sorry. Subject not found!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
					<div class="form-group row">
						<label for="subCode" class="col-sm-2 col-form-label">Subject Code</label>
						<div class="col-sm-10 input-group">
							<input type="text" class="form-control" id="subCode" placeholder="Subject Code" name="subjectCode" value="<?php if(isset($subjectDetails) and $subjectDetails!=null) echo $subjectDetails->subject_code; else echo ''?>">
							<button type="submit" class="btn btn-outline-secondary ml-2" name="searchSubject">Search</button>
						</div>

					</div>
					<div class="form-group row">
						<label for="subName" class="col-sm-2 col-form-label">Subject Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="subName" placeholder="Subject Name" name="subjectName" value="<?php if(isset($subjectDetails) and $subjectDetails!=null) echo $subjectDetails->subject_name; else echo ''?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="subYear" class="col-sm-2 col-form-label">Year</label>
						<div class="col-sm-10">
							<select id="subYear" name="year" class="form-control">
								<option value="">Select the Year</option>
								<option value="1" <?php if(isset($subjectDetails) and $subjectDetails!=null and $subjectDetails->year == "1") echo 'selected';?>>1st Year</option>
								<option value="2" <?php if(isset($subjectDetails) and $subjectDetails!=null and $subjectDetails->year == "2") echo 'selected';?>>2nd Year</option>
								<option value="3" <?php if(isset($subjectDetails) and $subjectDetails!=null and $subjectDetails->year == "3") echo 'selected';?>>3rd Year</option>
								<option value="4" <?php if(isset($subjectDetails) and $subjectDetails!=null and $subjectDetails->year == "4") echo 'selected';?>>4th Year</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="subSem" class="col-sm-2 col-form-label">Semester</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="subSem" name="semester" min="1" max="2" placeholder="Enter the Semester" value="<?php if(isset($subjectDetails) and $subjectDetails!=null) echo $subjectDetails->semester; else echo ''?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="lecCredits" class="col-sm-2 col-form-label">Lecture Credits</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="lecCredits" name="lectureCredits" placeholder="Lecture Credits" value="<?php if(isset($subjectDetails) and $subjectDetails!=null) echo $subjectDetails->lecture_credits; else echo ''?>" min="0">
						</div>
					</div>
					<div class="form-group row">
						<label for="pracCredits" class="col-sm-2 col-form-label">Practical Credits</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="pracCredits" name="practicalCredits" placeholder="Practical Credits" value="<?php if(isset($subjectDetails) and $subjectDetails!=null) echo $subjectDetails->practical_credits; else echo ''?>" min="0">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-outline-primary col-sm-3 mt-2" name="addSubject">Add Subject</button>
							<button type="submit" class="btn btn-outline-success col-sm-3 mt-2" name="updateSubject">Update Subject</button>
							<button type="submit" class="btn btn-outline-danger col-sm-3 mt-2" name="deleteSubject">Delete Subject</button>
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
							<th scope="col">Lecture Credits</th>
							<th scope="col">Practical Credits</th>
						</tr>
						</thead>
						<tbody>
						<?php
							foreach($allSubjects->result() as $row)
							{
								echo "<tr>";
								echo "<td>".$row->subject_code."</td>";
								echo "<td>".$row->subject_name."</td>";
								echo "<td>".$row->year."</td>";
								echo "<td>".$row->semester."</td>";
								echo "<td>".$row->lecture_credits."</td>";
								echo "<td>".$row->practical_credits."</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include('templates/footer.php');?>
		<?php
	} else {
		redirect("Student");
	}
}?>
