<?php


class Subject extends CI_Model
{
	public function addSubject($subjectData){
		$added = false;
		if($this->db->insert("subject",$subjectData)){
			$added = true;
		}
		return $added;
	}

	public function updateSubject($subjectData){
		$updated = false;
		$this->db->where('subject_id', $subjectData['subject_id']);
		if($this->db->update("subject",$subjectData)){
			$updated = true;
		}
		return $updated;
	}

	public function deleteSubject($subject_code,$semester){
		$deleted = false;
		if($this->db->delete('subject', array('subject_code' => $subject_code, 'semester' => $semester))){
			$deleted = true;
		}
		return $deleted;
	}

	public function getCategorizedDetails($year,$semester){
		if($year!='' and $year!='0') $this->db->where('year',$year);
		if($semester!='') $this->db->where('semester',$semester);
		$query = $this->db->get('subject');
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return array();
		}
	}

	public function getSubjectDetails($subject_code,$semester){
		$query = $this->db->get_where('subject', array('subject_code' => $subject_code, 'semester' => $semester));
		if($query->num_rows() == 1){
			return $query->row(0);
		}else{
			return array();
		}
	}

	public function getAllSubjects(){
		$query = $this->db->get('subject');
		return $query;
	}
}
