<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function loginUser(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[5]|max_length[12]");

		if($this->form_validation->run() == FALSE){
			$this->load->view("Login");
		}else{
			$this->load->model("User");
			$email = $this->input->POST('email',TRUE);
			$password = sha1($this->input->POST('password',TRUE));
			$loginResult = $this->User->authenticateUser($email,$password);
			if($loginResult != false){
				$userData = array(
					'name' => $loginResult->fullName,
					'email' => $loginResult->email,
					'role' =>$loginResult->privilege,
					'loggedIn' => TRUE
				);
				if($userData['role'] == "Student"){
					$this->load->model("UniStudent");
					$studentID = $this->UniStudent->getStudentID($userData['email']);
					if($studentID!=null) $userData += array('studentID' => $studentID);
				}
				$this->session->set_userdata($userData);
				if($userData['role'] == "Admin"){
					redirect("Admin");
				}else if($userData['role'] == "Student"){
					redirect("Student");
				}
			}else{
				$this->session->set_flashdata("login_error","Sorry! Invalid credentials.");
				redirect("Login");
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('loggedIn');
		redirect("Login");
	}

}
