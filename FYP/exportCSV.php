<?php
$server = mysqli_connect("localhost", "root", "", "299v2");

$location = $_REQUEST['location'];
$category = $_REQUEST['category'];

$result = mysqli_query($server, "select report.report_text, report.image_id, report.location_id, report.report_date, category.category_name from report join category ON report.category_id=category.Id where report.category_id=4");

$users = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$users[] = $row;
	}
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Report.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('report_text', 'image_id', 'location_id', 'report_date', 'category_name'));

if (count($users) > 0) {
	foreach ($users as $row) {
		fputcsv($output, $row);
	}
}

?>