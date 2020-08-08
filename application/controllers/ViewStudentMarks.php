<?php


class ViewStudentMarks extends CI_Controller
{
	public function index(){
		$this->load->view("view_student_marks");
	}

	public function generateStudentMarks(){
		$this->form_validation->set_rules("year", "Year", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->load->model("StudentMark");
			$year = $this->input->POST('year', TRUE);
			$semester = $this->input->POST('semester', TRUE);
			$subjectCode = $this->input->POST('subjectCode', TRUE);
			$studentID = $this->input->POST('studentID', TRUE);
			$result['allStudentMarks'] = $this->StudentMark->getCategorizedDetails($year, $semester, $subjectCode, $studentID);
			if(isset($_POST['searchStudentMarks'])){
				$this->load->view("view_student_marks", $result);
			}
			if(isset($_POST['downloadPDF'])){
				$resultPDF = $result['allStudentMarks']->result();
				$html = '';
				foreach ($resultPDF as $row) {
					$html .="<tr>
					<td>$row->subject_code</td>;
					<td>$row->subject_name</td>;
					<td>$row->year</td>;
					<td>$row->semester</td>;
					<td>$row->student_id</td>;
					<td>$row->student_name</td>;
					<td>$row->marks</td>;
					</tr>";
				}
				$this->convertpdf($html);
			}
		}
	}

	function convertpdf($html){
		$PDFtitle = 'Student Marks - ';
		$outputPDF = '<title>Student Marks - ';
		if(isset($_POST['year'])) {$tempYear = $_POST['year']; if($tempYear == "0") {$tempYear = "All Years";} else{$tempYear = 'Year '.$tempYear;} $outputPDF .= " ".$tempYear; $PDFtitle .= " ".$tempYear;}
		if(isset($_POST['semester']) and $_POST['semester'] != "") {$outputPDF .= " - Semester ".$_POST['semester']; $PDFtitle .= " - Semester ".$_POST['semester'];}
		if(isset($_POST['studentID']) and $_POST['studentID'] != "") {$outputPDF .= " - Student ID ".$_POST['studentID']; $PDFtitle .= " - Student ID ".$_POST['studentID'];}
		if(isset($_POST['subjectCode']) and $_POST['subjectCode'] != "") {$outputPDF .= " - Subject ".$_POST['subjectCode']; $PDFtitle .= " - Subject Code ".$_POST['subjectCode'];}
		$outputPDF .= '</title>';
		$outputPDF .=
			'<h2 style="text-align: center"><u>'.$PDFtitle.'</u></h2><br /> 
      <table border="1" cellpadding="5" style="border-collapse: collapse;margin: auto; width: 100%">  
           <tr>  
                <th>Subject Code</th>
				<th>Subject Name</th>
				<th>Year</th>
				<th>Semester</th>
				<th>Student ID</th>
				<th>Student Name</th>
				<th>Marks</th>  
           </tr>  
      ';
		$outputPDF .= $html;
		$outputPDF .= '</table>';
		// Load HTML content
		$this->dompdf->loadHtml($outputPDF);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$this->dompdf->render();

		// Output the generated PDF (1 = download and 0 = preview)
		$this->dompdf->stream($PDFtitle, array("Attachment"=>0));
	}
}
