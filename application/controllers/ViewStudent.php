<?php


class ViewStudent extends CI_Controller
{
	public function index(){
		$this->load->view("view_students");
	}

	public function generateStudents(){
		$this->form_validation->set_rules("year", "Year", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->load->model("UniStudent");
			$year = $this->input->POST('year', TRUE);
			$result['allStudents'] = $this->UniStudent->getCategorizedDetails($year);
			if(isset($_POST['searchStudents'])){
				$this->load->view("view_students", $result);
			}
			if(isset($_POST['downloadPDF'])){
				$resultPDF = $result['allStudents']->result();
				$html = '';
				foreach ($resultPDF as $row) {
					$html .="<tr>
					<td>$row->student_id</td>;
					<td>$row->student_name</td>;
					<td>$row->year</td>;
					<td>$row->email</td>;
					</tr>";
				}
				$this->convertpdf($html);
			}
		}
	}

	function convertpdf($html){
		$PDFtitle = 'Student Details - ';
		$outputPDF = '<title>Student Details - ';
		if(isset($_POST['year'])) {$tempYear = $_POST['year']; if($tempYear == "0") {$tempYear = "All Years";} else{$tempYear = 'Year '.$tempYear;} $outputPDF .= " ".$tempYear; $PDFtitle .= " ".$tempYear;}
		$outputPDF .= '</title>';
		$outputPDF .=
			'<h2 style="text-align: center"><u>'.$PDFtitle.'</u></h2><br /> 
      <table border="1" cellpadding="5" style="border-collapse: collapse;margin: auto; width: 100%">  
           <tr>  
                <th>Student ID</th>
				<th>Student Name</th>
				<th>Year</th>
				<th>Email</th>  
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
