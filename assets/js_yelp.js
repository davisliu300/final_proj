$(document).ready(function (){


	

	$('body').on('click', 'img',function(){
		var oneID = $(this).attr('data-index');
//		console.log("one id is ", oneID);
		$.ajax({
			url : 'retrivingDB.php', 
			data: {id: oneID},
			dataType : 'json', //expect json data back
			cache : false, //do not let the response be cached
			method : 'POST', //use POST to send it
			success : function (response) { //and do something when the response comes back
				//success is achieved!
				console.log("my response is: ", response);
				console.log("my data is: ", oneID);
				$('.display_info').html(response.html);
//				$('.display_info').text("ok");
			},
			error: function(response){
				console.log("something was wrong in ajax", response);
			}
			
		
		
		});
		
	});

});


/*

$('document').ready(function () { //when the document is ready
	$("#save_task").click(function () { //add click handler to save_task button

		var todoadd = $("#todo-add");
		var form_data = {
			subject : todoadd.find("input[name=subject]").val(),
			detail_contents : todoadd.find("textarea[name=detail_contents]").val(),
		} //get all the values from the form and add them to our data object for sending
		$.ajax({
			url : 'pages/modifying_add.php', //send our data to modifying.php
			data : form_data, //give it the form data
			dataType : 'json', //expect json data back
			cache : false, //do not let the response be cached
			method : 'POST', //use POST to send it
			success : function (response) { //and do something when the response comes back
				//success is achieved!
				console.log("in save task success");
				$("#display_refresh").click();
			}
		});

	});
	
	
	
		$('.display_blog').on('click', '.todo-modify > .del_blog', function () {

		var rowID = $(this).parents('.todo-record').attr('data-id');
		console.log("rowID is ", rowID);

		var okToDelete = window.confirm("really to delete?");
		if (okToDelete) {
			$.ajax({
				url : 'pages/modifying_del.php',
				cache : false,
				data : { id : rowID },
				method : 'POST', //use the post method

				success : function () {
					//					console.log("inside success function");
					$("#display_refresh").click();
				}
			});
		}
	});

		$('#todo-list-container').on('click', '.todo-remove > .btn', function () {
		
		var rowID = $(this).parents('.todo-record').attr('data-id');
 		if(okToDelete){		
			$.ajax({
				url : 'actions/remove.php',
				cache : false,
				data: {id: rowID},
				method: 'POST',  //use the post method
				success : function () {
						$("#display_refresh").click();
				}
			});
			
<?php
	require_once('../includes/functions.php');
		
	$con = mysqli_connect("localhost", "root", "", "if_db");
	if(isset($_POST['id'])){
		$id_num = $_POST['id'];	
		$query = "DELETE FROM `todo_items` WHERE id = $id_num";
		$result = mysqli_query($con, $query);
	}
?>
		}
	});
	

*/