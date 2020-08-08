<?php


class User extends CI_Model
{
	function addUser($userData){
		return $this->db->insert("users",$userData);
	}

	function authenticateUser($email,$password){
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$loginResponse = $this->db->get("users");
		if($loginResponse->num_rows() == 1){
			return $loginResponse->row(0);
		}else{
			return false;
		}
	}

	public function updateUser($userData){
		$updated = false;
		$this->db->where('email', $userData['email']);
		if($this->db->update("users",$userData)){
			$updated = true;
		}
		return $updated;
	}
}
