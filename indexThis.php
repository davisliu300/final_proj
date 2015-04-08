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
  

  
  
</head>
<body>




<div> 
<form class="form-horizontal" action = "actions/yelp_api_request.php" method = "post">

  <div class="form-group">
    <label for="inputText" class="col-sm-2 control-label">You Ask</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="inputText" placeholder="What to eat in your ZIP CODE?!?">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" checked = "true" name = "pictures"> Pictures? 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Let's see what can be offered!</button>
    </div>
  </div>
</form>
</div>

<div class = "yelp_picture_display">
	<? php
		include ('actions/yelp_api_request.php');
		echo "index this";
	?>
</div> 


</body>

</html>