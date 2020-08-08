<?php


class UniStudent extends CI_Model
{
	public function addStudent($studentData){
		$added = false;
		if($this->db->insert("student",$studentData)){
			$added = true;
		}
		return $added;
	}

	public function updateStudent($studentData){
		$updated = false;
		$this->db->where('student_id', $studentData['student_id']);
		if($this->db->update("student",$studentData)){
			$updated = true;
		}
		return $updated;
	}

	public function deleteStudent($student_id){
		$deleted = false;
		if($this->db->delete('student', array('student_id' => $student_id))){
			$deleted = true;
		}
		return $deleted;
	}

	public function getCategorizedDetails($year){
		if($year!='' and $year!='0') $this->db->where('year',$year);
		if($year!='' and $year=='0') $this->db->order_by('year',"ASC");
		$query = $this->db->get('student');
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return array();
		}
	}

	public function getStudentDetails($student_id){
		$query = $this->db->get_where('student', array('student_id' => $student_id));
		if($query->num_rows() == 1){
			return $query->row(0);
		}else{
			return array();
		}
	}

	public function getStudentID($email){
		$query = $this->db->get_where('student', array('email' => $email));
		if($query->num_rows() == 1){
			return $query->row(0)->student_id;
		}else{
			return null;
		}
	}

	public function getAllStudents(){
		$query = $this->db->get('student');
		return $query;
	}
}
