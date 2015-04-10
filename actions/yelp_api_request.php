<?php
session_start();
?><html> 

<head> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
  <script src = "../Assets/js_yelp.js"></script>
  
  <link rel ="stylesheet" href = "../Assets/style_yelp.css">
  <style> 
  </style> 
  </head> 
  
  <body>


<?php

require_once('dbConn.php');
/**
 * Yelp API v2.0 code sample.
 *
 * This program demonstrates the capability of the Yelp API version 2.0
 * by using the Search API to query for businesses by a search term and location,
 * and the Business API to query additional information about the top result
 * from the search query.
 * 
 * Please refer to http://www.yelp.com/developers/documentation for the API documentation.
 * 
 * This program requires a PHP OAuth2 library, which is included in this branch and can be
 * found here:
 *      http://oauth.googlecode.com/svn/code/php/
 * 
 * Sample usage of the program:
 * `php sample.php --term="bars" --location="San Francisco, CA"`
 */
// Enter the path that the oauth library is in relation to the php file
require_once('../lib/OAuth.php');
// Set your OAuth credentials here  
// These credentials can be obtained from the 'Manage API Access' page in the
// developers documentation (http://www.yelp.com/developers)
$CONSUMER_KEY = 'uxIopDp70KRjcH6oUaeV0g';
$CONSUMER_SECRET = 'hUfGOs18uJ5I-zxPhuFYgJOJNLA';
$TOKEN = 'KoXIbe2lso3bifg1NuByim7VwRbIxptJ';
$TOKEN_SECRET = 'gSQdI4sXuo77ltfjGf8WfBNI8sE';
$API_HOST = 'api.yelp.com';


$SEARCH_LIMIT = 9;
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';

$input_fromUser = null;

require_once ('input_temp.php');

// echo "i am here after reqired once ";
// echo "$input_fromUser 's $SEARCH_LIMIT restaurant are: <br>";


$DEFAULT_TERM = 'dinner';

if ($input_fromUser == null){
	$DEFAULT_LOCATION  = 'san diego, ca';
}else {
	$DEFAULT_LOCATION = $input_fromUser;
}


/** 
 * Makes a request to the Yelp API and returns the response
 * 
 * @param    $host    The domain host of the API 
 * @param    $path    The path of the APi after the domain
 * @return   The JSON response from the request      
 */
function request($host, $path) {
    $unsigned_url = "http://" . $host . $path;
    // Token object built using the OAuth library
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);
    // Consumer object built using the OAuth library
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);
    // Yelp uses HMAC SHA1 encoding
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer, 
        $token, 
        'GET', 
        $unsigned_url
    );
    
    // Sign the request
    $oauthrequest->sign_request($signature_method, $consumer, $token);
    
    // Get the signed URL
    $signed_url = $oauthrequest->to_url();
    
    // Send Yelp API Call
    $ch = curl_init($signed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);    
    return $data;
}
/**
 * Query the Search API by a search term and location 
 * 
 * @param    $term        The search term passed to the API 
 * @param    $location    The search location passed to the API 
 * @return   The JSON response from the request 
 */
function search($term, $location) {
    $url_params = array();    
    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);
    return request($GLOBALS['API_HOST'], $search_path);
}

/**
 * Query the Business API by business_id
 * 
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request 
 */
function get_business($business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . $business_id;    
    return request($GLOBALS['API_HOST'], $business_path);
}
/**
 * Queries the API by the input values from the user 
 * 
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 */
function query_api($term, $location) {     
    $response = json_decode(search($term, $location),true);	
//	echo '<pre> OM'; print_r($response); echo 'OM </pre>';
	return $response['businesses'];

/*
	foreach($response['businesses'] as $index => $business)
	{
		print("<br>################<br>business $index is ".print_r($business,true));
		echo ("<img src='$business[image_url]'>");
	}
	return $response['businesses'];
 	exit;
	$business_id = $response->businesses[0]->id; //changing the index on showing business - D
*/	

//  print "businesses:<pre>".print_r($response,true)."</pre>\n";
/*
    print sprintf(
        "%d businesses found, querying business info for the top result \"%s\"\n\n",         
        count($response->businesses),
        $business_id
    );
*/  
/*
    $response0 = get_business($business_id0);
// response0 is a string;	
	$response0 = json_decode($response0, true); //decode JSON once again from business - DL
// response0 is an array;		
	//$responseData is "Array";	
	return $responseData;
*/
//    print sprintf("Result >>>>>>>>>>>>> for business \"%s\" found:\n", $business_id);
//    print "1 business:<pre>".print_r($response)."</pre>\n";
}
/**
 * User input is handled here 
 */
$longopts  = array(
	"term:: ",
    "location:: ",
);
   
$options = getopt("", $longopts);
$term = $options['term'] ?: '';
$location = $options['location'] ?: '';

// query_api($term, $location);

// write to db for the query_api: 
// require_once('dbConn.php');
$dbData = query_api($term,$location);
$_SESSION['retrieved_restaurants']=$dbData;

// $_SESSION['response0info'] = $dbData[0];
// $r0Address = $_SESSION['response0info'];
$allInfo = $_SESSION['retrieved_restaurants'];
/*
echo "<pre>";
print_r($r0Address);
echo "</pre>";
*/
echo "<div class = 'random_pic'>";
foreach($dbData as $index => $business){
//		print("<br>################<br>business $index is ".print_r($business,true));

// <a data-toggle = "modal" data-target ="#myModal"> ok to click?</a>
		echo "<div class = 'individual_pic' id = 'ani_$index'> ";
		echo ("<a data-toggle = 'modal' data-target = '#myModal'> <img src='$business[image_url]' data-index='$index'> </a>");
		echo "</div>";
	}
echo "</div>";


// print_r($dbData);
// $response['businesses']['image_url']
// echo $dbData[0]['image_url'];  // this is good !!!

/*
// $dbData = json_encode($dbData);
$zero_element = $dbData[0];
$zero_element = json_decode($zero_element,true);
echo '<pre>'; print_r($zero_element['rating_img_url']); echo '</pre>';
*/

// $temp = $dbData[4]['image_url'];
// $query = "UPDATE table_pic SET response4= '$temp'";

/*
$query = "UPDATE table_pic SET response5 = '" . $dbData[5]['image_url'] . "'";
$result = mysqli_query($CONN, $query);

echo "<br>db updated";
*/
	
?>

<div class = "display_info">


</div> 


</body> 

</html>