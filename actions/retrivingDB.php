<?php

session_start();

//	require_once('dbConn.php');
	$myID = $_POST['id']; 
	
	
	$allInfo = $_SESSION['retrieved_restaurants'];
	/*
	echo "<pre>";
	print_r($allInfo);
	echo "</pre>";
	*/
//	echo json_encode($r0Address);

	
	
	$output = [];
	
	$html = []; // null;
	
	$html[0] = $allInfo[$myID]['name'];
	$html[1] = $allInfo[$myID]['location']['display_address'];
	
//	$html[3] = $myID;
	
//	$html[2] = $r0Address['url'];
 
	
	$output = $html;
//	$output['html'] = $html;
	
	echo json_encode($output, true);

/*

 // modify_view.php: 
 
 
	$userID = $_POST['id'];		
	$con = mysqli_connect('localhost', 'root','','blogger');
	$sql = "SELECT * FROM blogger WHERE `id` =  $userID";
    $results = mysqli_query($con, $sql);
 //echo "the query is $sql";
 	$todo_row = mysqli_fetch_assoc($results);
	$output=[];
	$output['data']=$todo_row;
	
	$subject = $output['data']['subject'];
	$time = $output['data']['timestamp'];
	$details = $output['data']['detail_contents'];

    $html='<div class="Container">
			<div class="row">
            <div class="col-xs-3 btn btn-default" disabled = "disabled">Subject</div>
			<div class="col-xs-9">'.$subject.'</div>
			</div> 
			
			<div class="row">
		    <div class="col-xs-3 btn btn-default" disabled = "disabled">Time</div>
			<div class="col-xs-9">'.$time.'</div>
			</div> 
			
			<div class="row">
			<div class="col-xs-3 btn btn-default" disabled = "disabled">Details</div> 
			<div class="col-xs-9">'.$details.'</div>
			</div>
        </div>';
		

	$output['html']=$html;
    echo json_encode($output);
	
	/*
    while($todo_row = mysqli_fetch_assoc($results)){
        
        $id = $todo_row['id'];
        $subject = $todo_row['subject'];
		$modifiedDate = $todo_row['timestamp'];
        $timestamp = $todo_row['timestamp'];
        $details = $todo_row['detail_contents'];
        
        $todo_item_html = 
                "<div class='row todo-record' data-id='$id'>
                    <div class='col-md-2 todo-title'>$subject</div>
                    <div class='col-md-2 todo-date'>$modifiedDate</div>
                    <div class='col-md-7 todo-details'>".nl2br($details)."</div>
                </div> <hr>  ";
            $html.=$todo_item_html;
    }
	*/
//	$output['data']=$todo_row;
//	$output['html']=$html;
//    echo json_encode($output);


?>