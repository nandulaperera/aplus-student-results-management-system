<?php


class ManageSubject extends CI_Controller
{

	public function index(){
		$this->load->model('Subject');
		$result['allSubjects']=$this->Subject->getAllSubjects();
		$this->load->view("manage_subjects",$result);
	}

	public function update(){
		if (isset($_POST['searchSubject'])){
			$this->form_validation->set_rules("subjectCode", "Subject Code", "required");
			$this->form_validation->set_rules("semester", "Semester", "required");
			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("Subject");
				$subject = $this->input->POST('subjectCode',TRUE);
				$semester = $this->input->POST('semester',TRUE);
				$result['subjectDetails'] = $this->Subject->getSubjectDetails($subject,$semester);
				$result['allSubjects']=$this->Subject->getAllSubjects();
				$this->load->view("manage_subjects",$result);
			}
		}else{
			$this->form_validation->set_rules("subjectCode", "Subject Code", "required");
			$this->form_validation->set_rules("subjectName", "Subject Name", "required");
			$this->form_validation->set_rules("year", "Year", "required");
			$this->form_validation->set_rules("semester", "Semester", "required");
			$this->form_validation->set_rules("lectureCredits", "Lecture Credits", "required");
			$this->form_validation->set_rules("practicalCredits", "Practical Credits", "required");

			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$this->load->model("Subject");
				if (isset($_POST['addSubject']) or isset($_POST['updateSubject'])) {
					$subjectData = array(
						'subject_id' => $this->input->POST('subjectCode',TRUE).$this->input->POST('semester',TRUE),
						'subject_code' => $this->input->POST('subjectCode',TRUE),
						'subject_name' => $this->input->POST('subjectName',TRUE),
						'year'=> $this->input->POST('year',TRUE),
						'semester' => $this->input->POST('semester',TRUE),
						'lecture_credits' => $this->input->POST('lectureCredits',TRUE),
						'practical_credits' => $this->input->POST('practicalCredits',TRUE)
					);

					if(isset($_POST['addSubject'])) {
						$addSub = $this->Subject->addSubject($subjectData);
						if ($addSub) {
							$this->session->set_flashdata("addSuccess", "Success");
						} else {
							$this->session->set_flashdata("addSuccess", "Fail");
						}
						redirect("ManageSubject");
					}else{
						$updateSub = $this->Subject->updateSubject($subjectData);
						if ($updateSub) {
							$this->session->set_flashdata("updateSuccess", "Success");
						} else {
							$this->session->set_flashdata("updateSuccess", "Fail");
						}
						redirect("ManageSubject");
					}

				}

				if (isset($_POST['deleteSubject'])) {
					$this->load->model("Subject");
					$subject = $this->input->POST('subjectCode',TRUE);
					$semester = $this->input->POST('semester',TRUE);
					$deleteSub = $this->Subject->deleteSubject($subject,$semester);
					if ($deleteSub) {
						$this->session->set_flashdata("deleteSuccess", "Success");
					} else {
						$this->session->set_flashdata("deleteSuccess", "Fail");
					}
					redirect("ManageSubject");

				}
			}
		}
	}
}
