<?php
	$server = mysqli_connect("localhost", "root", "", "299v2");

	$result = mysqli_query($server, "SELECT * 
									FROM location l , report r, category c
									WHERE l.Id = r.location_Id
									And c.Id = r.category_id 
									ORDER BY report_id DESC");

	if($result->num_rows > 0){
		$delimiter = ",";
		$filename = "reports_" . date('Y-m-d') . ".csv";
		
		//create a file pointer
		$f = fopen('php://memory', 'w');
		
		//set column headers
		$fields = array('Report ID', 'Title', 'Text', 'Longitude', 'Latitude', 'Category', 'Date');
		fputcsv($f, $fields, $delimiter);
		
		//output each row of the data, format line as csv and write to file pointer
		while($row = $result->fetch_assoc()){
			// $status = ($row['status'] == '1')?'Active':'Inactive';
			$lineData = array($row['report_Id'], $row['report_title'], $row['report_text'], $row['longitude'], $row['latitude'], $row['category_name'], date("M jS, Y", strtotime($row['report_date'])));
			fputcsv($f, $lineData, $delimiter);
		}
		
		//move back to beginning of file
		fseek($f, 0);
		
		//set headers to download file rather than displayed
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		
		//output all remaining data on a file pointer
		fpassthru($f);
	}
	exit;

?>