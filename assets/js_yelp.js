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
				var thisData = response;
				console.log("This data response is: ", thisData[3]);
				var thisTag = "<p class = 'restaurantName'>";
				var thatTag = "</p>";
					var restaurantNameTag = thisTag+thisData[0]+thatTag;
				var br = "<br>";
				
				var aLink = "<a href = ";
				var aContent = thisData[3];
				var aAfterLink = "> go to Yelp</a>";
					var restaurantLink = aLink + aContent + aAfterLink;
					
				console.log("thisData a content is: ", aContent);
				$('.display_info').html(restaurantNameTag + br + restaurantLink);				
//				$('.display_info').html(thisTag + thisData[0] + thatTag);
//				$('.display_info').html(response); // working with TEXT !
				
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