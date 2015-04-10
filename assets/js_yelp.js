$(document).ready(function (){
	$('body').on('click', 'img',function(){
		var oneID = $(this).attr('data-index');
//		console.log("one id is ", oneID);
//		var getUrl = 

//below are for bootstrap modal variables for JavaScript	

		var modalTitle = 
			'<div class="modal fade" id = "myModal" role = "dialog" aria-hidden = "true">';
		modalTitle += '<div class="modal-dialog">';
		modalTitle += '<div class="modal-content">';
		modalTitle += '<div class="modal-header">';
		modalTitle += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		modalTitle += '<span aria-hidden="true">&times;</span></button>';
		modalTitle += '<h4 class="modal-title restaurantName">';
		//*** restaurantName is insert as the title in AJAX call (modal);
		
		
//		modalBody = '<h4>'; //works at this point without closing div;
		var modalBody = '</h4> </div> <div class = "modal-body"><p> Phone # is:';
		//*** restaurantPhone is insert as in modal body;
		var modalBody_chain1 = '</p> <p> The address is: <span class = "restAddressFont">';
		//*** restaurantAddress is inserted as in modal body - chains 
		var modalBody_chain2 = '</span> </p> <p> Google Coords are: <span class = "google_coords"> ';
		//*** restaurantGoogle_coord is insert here;
		var modalBody_chainEnd= '</span></p></div>';
		var modalFooter = '<div class="modal-footer">';
		modalFooter += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		modalFooter += '</div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div>';
// modalTitle + [restName] + modalBody + [restPhone] + modalBody_Chain1 + modalBody_chainEnd _ modalFooter;

		// insert 

		
		
/*
	$html[0] = $allInfo[$myID]['name'];
	$html[1] = $allInfo[$myID]['location']['display_address'];
	$html[2] = $allInfo[$myID]['display_phone'];
	$html[3] = $allInfo[$myID]['url'];
	
	$html[6] = $allInfo[$myID]['location']['coordinate'];

*/
		
		
		
		
		
		
		

		$.ajax({
			url : 'retrivingDB.php', 
//			url : 'https://www.yelp.com',
			data: {id: oneID}, // send to server 
			dataType : 'json', //expect json data back
			cache : false, //do not let the response be cached
			method : 'POST', //use POST to send it
			success : function (response) { 
//				console.log("my response is: ", response);
				console.log("my data is: ", oneID);
//				$('.display_info').html(response.html);
				var thisData = response;
//				console.log("This data response is: ", thisData[3]);
				var restaurantName = thisData[0];
				var restaurantPhone = thisData[2];
				var restaurantAddress = thisData[1];
//				var restaurantGoogle_coord = thisData[6]['latitude'];

				var restaurantGoogle_coord = thisData[6]['latitude'];
				var and = ", ";
				restaurantGoogle_coord += and + thisData[6]['longitude'];
				
				console.log("rest goole is: ", restaurantGoogle_coord);
				$('.display_info').html(modalTitle + restaurantName + modalBody + restaurantPhone + modalBody_chain1 + restaurantAddress+ modalBody_chain2 + restaurantGoogle_coord+ modalBody_chainEnd+modalFooter);
//modalTitle + [restName] + modalBody + [restPhone] + modalBody_Chain1 + [restaddress] + modalBody_chain2 + restaurantGoogle_coord+ modalBody_chainEnd + modalFooter;			
//				$('.display_info').html(thisTag + thisData[0] + thatTag);
//				$('.display_info').html(response); // working with TEXT !
				
//				$('body').html(modalTitle + thisData[0] + modalBody); // won't work within a div.
				
//				$('.display_info').text("ok");
			},
			error: function(response){
				console.log("something was wrong in ajax", response);
			}
		});
	});
});


/*

 $("#main_nav li").each(function()
        {
            var my_li = this;
            $(this).click(function()
            {
                console.log($(this).attr('data-url'));
                var get_url = $(this).attr('data-url');
                
// ajax code below: 
                $.get(get_url,function()
                    {
                        //fill the contents of #main_content with the data of the retrieved file
								}).done(function(data) {
								$('#main_content').html(data);
						});
            });
        });
    });
*/