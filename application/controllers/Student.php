<?php


class Student extends CI_Controller
{
	public function index(){
		$this->load->model("StudentMark");
		$studentID = $this->session->userdata("studentID");
		$result['allStudentResults'] = $this->StudentMark->getStudentResults('', '', $studentID);
		if($result['allStudentResults']){
			$result['studentResults'] = $this->StudentMark->getGPA('', '', $studentID);
		}
		$this->load->view("student",$result);
	}

	public function generateResults(){
		$this->form_validation->set_rules("year", "Year", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->load->model("StudentMark");
			$year = $this->input->POST('year', TRUE);
			$semester = $this->input->POST('semester', TRUE);
			$studentID = $this->session->userdata("studentID");
			$result['allStudentResults'] = $this->StudentMark->getStudentResults($year, $semester, $studentID);
			if($result['allStudentResults']){
				$result['studentResults'] = $this->StudentMark->getGPA($year, $semester, $studentID);
			}
			$this->load->view("student", $result);
		}
	}
}
