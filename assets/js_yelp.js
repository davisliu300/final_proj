$(document).ready(function (){
	$('body').on('click', 'img',function(){
		var oneID = $(this).attr('data-index');
//		var getUrl = 

//below are for bootstrap modal variables for JavaScript	

		/*var modalTitle = 
			'<div class="modal fade" id = "myModal" role = "dialog" aria-hidden = "true">';
		modalTitle += '<div class="modal-dialog">';
		modalTitle += '<div class="modal-content">';
		modalTitle += '<div class="modal-header">';
		modalTitle += '<button type="button" class="close" data-target="#myModal" aria-label="Close">';
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
		
		var modalBody_chain3 = '</span> </p> <p> Yelp\'s Link for the shop is here: <a href = "';
		//*** restaurantLink is insert here;
		var modalBody_chain4 = '">Yelp</a>';
		var modalBody_chainEnd= '</p></div>';
		var modalFooter = '<div class="modal-footer">';
		modalFooter += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		modalFooter += '</div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div>';
// modalTitle + [restName] + modalBody + [restPhone] + modalBody_Chain1 + modalBody_chainEnd _ modalFooter;
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
				
				var restaurantLink = thisData[3];
// restaurantName, restAddressFont ,google_coords , <p> Yelp\'s Link for the shop is here: 
				//$('.display_info').html(modalTitle + restaurantName + modalBody + restaurantPhone + modalBody_chain1 + restaurantAddress+ modalBody_chain2 + restaurantGoogle_coord+ modalBody_chain3 + restaurantLink + modalBody_chain4+ modalBody_chainEnd+modalFooter);
				
				
				var p = "<p>";
				var pClose = "</p>";
				var spanClose = "</span>";
// restaurantName, restAddressFont ,google_coords , <p> Yelp\'s Link for the shop is here: 
				$('#restaurant_modal .display_info').html(p + 'The name is:' + restaurantName+  pClose + p + 'The Phone # is:' + restaurantPhone + pClose+ p + 'The Address is : <span class = "restAddressFont">'+ restaurantAddress + spanClose +pClose + p + 'Google Coords: <span class ="google_coords"> '+ restaurantGoogle_coord+spanClose+pClose + '<p> Yelp\'s Link for the shop is here: <a href = "'+ restaurantLink + '">Yelp</a>'+  pClose);
				$('#restaurant_modal .modal-title').html(restaurantName+ ' info');
		
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
                
// ajax GET code below: 
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