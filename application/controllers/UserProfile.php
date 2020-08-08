<?php


class UserProfile extends CI_Controller
{
	public function index(){
		$this->load->view("user_profile");
	}

	public  function saveChanges(){
		$this->form_validation->set_rules("name", "Full Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("old_password", "Password", "required");
		if($this->input->POST('new_password',TRUE)!=''){
			$this->form_validation->set_rules("c_new_password", "Confirm Password", "required|min_length[5]|max_length[12]");
		}else if($this->input->POST('c_new_password',TRUE)!=''){
			$this->form_validation->set_rules("new_password", "New Password", "required|min_length[5]|max_length[12]");
		}
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
			$this->load->model("User");
			$name = $this->input->POST('name',TRUE);
			$email = $this->input->POST('email',TRUE);
			$password = sha1($this->input->POST('old_password',TRUE));
			$new_password = $this->input->POST('new_password')!='' ? sha1($this->input->POST('new_password',TRUE)): '';
			$loginResult = $this->User->authenticateUser($email,$password);
			if($loginResult!=false){
				$userData = array(
					'fullName' => $name,
					'email' => $email,
					'password' => $new_password!=''? $new_password : $password
				);
				$updateResponse = $this->User->updateUser($userData);
				if($updateResponse) {
					redirect("Login/logout");
				}else{
					$this->session->set_flashdata("update_failed","Failed");
					$this->index();
				}
			}else{
				$this->session->set_flashdata("auth_error","Failed");
				$this->index();
			}
		}
	}
}
