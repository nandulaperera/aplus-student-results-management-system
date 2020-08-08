<?php


class ManageStudentMarks extends CI_Controller
{
	public function index(){
		$this->load->model('StudentMark');
		$result['allStudentMarks']=$this->StudentMark->getAllStudentMarks();
		$this->load->view("manage_student_marks",$result);
	}

	public function update(){
		if (isset($_POST['searchStudentMarks'])){
			$this->form_validation->set_rules("subjectCode", "Subject Code", "required");
			$this->form_validation->set_rules("semester", "Semester", "required");
			$this->form_validation->set_rules("studentID", "Student ID", "required");
			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("StudentMark");
				$subject = $this->input->POST('subjectCode',TRUE);
				$semester = $this->input->POST('semester',TRUE);
				$student = $this->input->POST('studentID',TRUE);
				$result['markDetails'] = $this->StudentMark->getStudentMarkDetails($subject,$semester,$student);
				$result['allStudentMarks']=$this->StudentMark->getAllStudentMarks();
				$this->load->view("manage_student_marks",$result);
			}
		}else{
			$this->form_validation->set_rules("subjectCode", "Subject Code", "required");
			$this->form_validation->set_rules("year", "Year", "required");
			$this->form_validation->set_rules("semester", "Semester", "required");
			$this->form_validation->set_rules("studentID", "Student ID", "required");
			$this->form_validation->set_rules("studentMark", "Student Marks", "required");

			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("StudentMark");
				if (isset($_POST['addStudentMarks']) or isset($_POST['updateStudentMarks'])) {
					$markData = array(
						'subject_id' => $this->input->POST('subjectCode',TRUE).$this->input->POST('semester',TRUE),
						'student_id'=> $this->input->POST('studentID',TRUE),
						'marks'=> $this->input->POST('studentMark',TRUE),

					);

					if(isset($_POST['addStudentMarks'])) {
						$addMark = $this->StudentMark->addStudentMark($markData);
						if ($addMark) {
							$this->session->set_flashdata("addMarksSuccess", "Success");
						} else {
							$this->session->set_flashdata("addMarksSuccess", "Fail");
						}
						redirect("ManageStudentMarks");
					}else{
						$updateMark = $this->StudentMark->updateStudentMark($markData);
						if ($updateMark) {
							$this->session->set_flashdata("updateMarksSuccess", "Success");
						} else {
							$this->session->set_flashdata("updateMarksSuccess", "Fail");
						}
						redirect("ManageStudentMarks");
					}

				}

				if (isset($_POST['deleteStudentMarks'])) {
					$this->load->model("StudentMark");
					$subject = $this->input->POST('subjectCode',TRUE);
					$semester = $this->input->POST('semester',TRUE);
					$student = $this->input->POST('studentID',TRUE);
					$deleteSub = $this->StudentMark->deleteStudentMark($subject.$semester,$student);
					if ($deleteSub) {
						$this->session->set_flashdata("deleteMarksSuccess", "Success");
					} else {
						$this->session->set_flashdata("deleteMarksSuccess", "Fail");
					}
					redirect("ManageStudentMarks");

				}
			}
		}
	}
}
