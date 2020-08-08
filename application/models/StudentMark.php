<?php


class StudentMark extends CI_Model
{
	public function addStudentMark($markDetails){
		$added = false;
		if($this->db->insert("subject_marks",$markDetails)){
			$added = true;
		}
		return $added;
	}

	public function updateStudentMark($markDetails){
		$updated = false;
		$this->db->where('subject_id', $markDetails['subject_id']);
		$this->db->where('student_id', $markDetails['student_id']);
		if($this->db->update("subject_marks",$markDetails)){
			$updated = true;
		}
		return $updated;
	}

	public function deleteStudentMark($subject_id,$student_id){
		$deleted = false;
		if($this->db->delete('subject_marks', array('subject_id' => $subject_id, 'student_id' => $student_id))){
			$deleted = true;
		}
		return $deleted;
	}

	public function getCategorizedDetails($year,$semester,$subjectCode,$studentID){
		if($year!='' and $year!='0') $this->db->where('year',$year);
		if($semester!='') $this->db->where('semester',$semester);
		if($subjectCode!='') $this->db->where('subject_code',$subjectCode);
		if($studentID!='') $this->db->where('student_id',$studentID);
		$this->db->order_by("subject_code");
		$query = $this->db->get('student_marks');
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return array();
		}
	}

	public function getStudentResults($year,$semester,$studentID){
		if($year!='' and $year!='0') $this->db->where('year',$year);
		if($semester!='') $this->db->where('semester',$semester);
		if($studentID!='') $this->db->where('student_id',$studentID);
		$this->db->order_by("subject_code");
		$query = $this->db->get('student_marks');
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return array();
		}
	}

	public function getGPA($year,$semester,$studentID){
		$stored_procedure = "CALL getStudentResults(?,?,?)";
		$query = $this->db->query($stored_procedure,array('studentID' => $studentID, 'year' => $year, 'semester' => $semester));
		if($query->num_rows() == 1){
			return $query->row(0);
		}else{
			return array();
		}
	}

	public function getStudentMarkDetails($subject_code,$semester,$student_id){
		$query = $this->db->get_where('student_marks', array('subject_code' => $subject_code, 'semester' => $semester, 'student_id' => $student_id));
		if($query->num_rows() == 1){
			return $query->row(0);
		}else{
			return array();
		}
	}

	public function getAllStudentMarks(){
		$this->db->order_by("subject_code");
		$query = $this->db->get('student_marks');
		return $query;
	}
}
