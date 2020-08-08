<?php


class ManageStudent extends CI_Controller
{

	public function index(){
		$this->load->model('UniStudent');
		$result['allStudents']=$this->UniStudent->getAllStudents();
		$this->load->view("manage_students",$result);
	}

	public function update(){
		if (isset($_POST['searchStudent'])){
			$this->form_validation->set_rules("studentID", "Student ID", "required");
			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("UniStudent");
				$student = $this->input->POST('studentID',TRUE);
				$result['studentDetails'] = $this->UniStudent->getStudentDetails($student);
				$result['allStudents']=$this->UniStudent->getAllStudents();
				$this->load->view("manage_students",$result);
			}
		}else{
			$this->form_validation->set_rules("studentID", "Student ID", "required");
			$this->form_validation->set_rules("studentName", "Student Name", "required");
			$this->form_validation->set_rules("year", "Year", "required");
			$this->form_validation->set_rules("studentEmail", "Student Email", "required|valid_email");

			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("UniStudent");
				if (isset($_POST['addStudent']) or isset($_POST['updateStudent'])) {
					$studentData = array(
						'student_id' => $this->input->POST('studentID',TRUE),
						'student_name' => $this->input->POST('studentName',TRUE),
						'year'=> $this->input->POST('year',TRUE),
						'email' => $this->input->POST('studentEmail',TRUE)
					);

					if(isset($_POST['addStudent'])) {
						$addStu = $this->UniStudent->addStudent($studentData);
						if ($addStu) {
							$this->session->set_flashdata("addStudentSuccess", "Success");
						} else {
							$this->session->set_flashdata("addStudentSuccess", "Fail");
						}
						redirect("ManageStudent");
					}else{
						$updateStu = $this->UniStudent->updateStudent($studentData);
						if ($updateStu) {
							$this->session->set_flashdata("updateStudentSuccess", "Success");
						} else {
							$this->session->set_flashdata("updateStudentSuccess", "Fail");
						}
						redirect("ManageStudent");
					}

				}

				if (isset($_POST['deleteStudent'])) {
					$this->load->model("UniStudent");
					$student = $this->input->POST('studentID',TRUE);
					$deleteStu = $this->UniStudent->deleteStudent($student);
					if ($deleteStu) {
						$this->session->set_flashdata("deleteStudentSuccess", "Success");
					} else {
						$this->session->set_flashdata("deleteStudentSuccess", "Fail");
					}
					redirect("ManageStudent");

				}
			}
		}
	}
}
