<?php


class ViewSubject extends CI_Controller
{
	public function index(){
		$this->load->view('view_subjects');
	}

	public function generateSubjects(){
		$this->form_validation->set_rules("year", "Year", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->load->model("Subject");
			$year = $this->input->POST('year', TRUE);
			$semester = $this->input->POST('semester', TRUE);
			$result['allSubjects'] = $this->Subject->getCategorizedDetails($year, $semester);
			if(isset($_POST['searchSubjects'])){
				$this->load->view("view_subjects", $result);
			}
			if(isset($_POST['downloadPDF'])){
				$resultPDF = $result['allSubjects']->result();
				$html = '';
				foreach ($resultPDF as $row) {
					$html .="<tr>
					<td>$row->subject_code</td>;
					<td>$row->subject_name</td>;
					<td>$row->year</td>;
					<td>$row->semester</td>;
					<td>$row->lecture_credits</td>;
					<td>$row->practical_credits</td>;
					</tr>";
				}
				$this->convertpdf($html);
			}
		}
	}

	function convertpdf($html){
		$PDFtitle = 'Subject Details - ';
		$outputPDF = '<title>Subject Details - ';
		if(isset($_POST['year'])) {$tempYear = $_POST['year']; if($tempYear == "0") {$tempYear = "All Years";} else{$tempYear = 'Year '.$tempYear;} $outputPDF .= " ".$tempYear; $PDFtitle .= " ".$tempYear;}
		if(isset($_POST['semester']) and $_POST['semester'] != "") {$outputPDF .= " - Semester ".$_POST['semester']; $PDFtitle .= " - Semester ".$_POST['semester'];}
		$outputPDF .= '</title>';
		$outputPDF .=
		'<h2 style="text-align: center"><u>'.$PDFtitle.'</u></h2><br /> 
      <table border="1" cellpadding="5" style="border-collapse: collapse;margin: auto; width: 100%">  
           <tr>  
                <th>Subject Code</th>
				<th>Subject Name</th>
				<th>Year</th>
				<th>Semester</th>
				<th>Lecture Credits</th>
				<th>Practical Credits</th>  
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
