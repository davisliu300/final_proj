<?php
	require_once('dbConn.php');
	
	$response0 = $responseData[0];
	
	echo $response0;


	
	/*	$con = mysqli_connect("localhost", "root", "", "if_db");
	
	$title = $_POST['title'];
	$date = strtotime($_POST['date']);
	$details = $_POST['details'];
	
	$query = 'INSERT INTO todo_items (`title`, `timestamp`, `details`) VALUES (';
	$query .= '"'.$title.'",';
	$query .= $date.',';
	$query .= '"'.$details.'");';          
	
	$result = mysqli_query($con, $query);
	*/
	
?>