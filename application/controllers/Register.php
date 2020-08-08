<?php


class Register extends CI_Controller
{
	public function index()
	{
		$this->load->view('register');
	}

	public function registerUser()
	{
		$this->form_validation->set_rules("name", "Full Name", "trim|required");
		$this->form_validation->set_rules("role", "Role", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[5]|max_length[12]");
		$this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required|matches[password]");

		if($this->form_validation->run() == FALSE){
			$this->load->view("register");
		}else{
			$this->load->model("User");
			$userData = array(
				'fullName' => $this->input->POST('name',TRUE),
				'email' => $this->input->POST('email',TRUE),
				'password'=> sha1($this->input->POST('password',TRUE)),
				'privilege' => $this->input->POST('role',TRUE)
			);
			if($userData['privilege'] == "Student"){
				$this->load->model("UniStudent");
				$studentID = $this->UniStudent->getStudentID($userData['email']);
				if($studentID == null) {
					$this->session->set_flashdata("registration_error","Invalid email address");
					redirect("Register");
				}
			}
			$addResponse = $this->User->addUser($userData);
			if($addResponse){
				$this->session->set_flashdata("registration_success","You have successfully registered!");
				redirect("Register");
			}else{
				$this->session->set_flashdata("registration_error","Oops! Something went wrong.");
				redirect("Register");
			}
		}
	}
}
