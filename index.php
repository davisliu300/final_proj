<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LF finalProj</title>
  <style>

  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  
  
  <link rel="stylesheet" href="assets/style_yelp.css">
  
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  
  <script src = "../assets/js_yelp.js"></script>
  
  
</head>
<body>




<div class = "center-block "> 

<div>
<form action = "actions/yelp_api_request.php" method = "post">

  <div class="form-group">
    <label for="inputText" class="col-sm-2 control-label"></label>
    <div class="col-sm-7 input-group">
      <input type="text" class="form-control" name="inputText" placeholder="What to eat in your zip code? OR &quot;City&quot" autofocus>
	  <span class = "input-group-btn" >

	  <button class = "btn btn-info ">  O </button>
<!--	  <button type="submit"  id = "searchIt" class="btn btn-default glyphicon glyphicon-search"></button> -->
	  </span>
    </div>
  </div>
  

</form>
</div>
</div>




</body>

</html>