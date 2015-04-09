$(document).ready(function (){
	$('body').on('click', 'img',function(){
		var oneID = $(this).attr('data-index');
//		console.log("one id is ", oneID);
//		var getUrl = 

		$.ajax({
			url : 'retrivingDB.php', 
//			url : 'https://www.yelp.com',
			data: {id: oneID}, // send to server 
			dataType : 'json', //expect json data back
			cache : false, //do not let the response be cached
			method : 'POST', //use POST to send it
			success : function (response) { 
				console.log("my response is: ", response);
				console.log("my data is: ", oneID);
//				$('.display_info').html(response.html);
				$('.display_info').html(response);
//				$('.display_info').html(response);
				
//				$('.display_info').text("ok");
			},
			error: function(response){
				console.log("something was wrong in ajax", response);
			}
		});
	});
});
