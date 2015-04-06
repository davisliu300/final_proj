
<?php
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
echo "$input_fromUser 's $SEARCH_LIMIT restaurant are: <br>";


$DEFAULT_TERM = 'dinner';
 //$DEFAULT_LOCATION = 'san diego';


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
    $response = json_decode(search($term, $location));	

		$business_id = $response->businesses[0]->id; //changing the index on showing business - D
		$business_id1 = $response->businesses[1]->id;
		$business_id2 = $response->businesses[2]->id;
		$business_id3 = $response->businesses[3]->id;
		$business_id4 = $response->businesses[4]->id;
		$business_id5 = $response->businesses[5]->id;
		$business_id6 = $response->businesses[6]->id;
		$business_id7 = $response->businesses[7]->id;
		$business_id8 = $response->businesses[8]->id;		

//       print "businesses:<pre>".print_r($response,true)."</pre>\n";
/*
    print sprintf(
        "%d businesses found, querying business info for the top result \"%s\"\n\n",         
        count($response->businesses),
        $business_id
    );
*/  
    $response = get_business($business_id);	
	$response = json_decode($response, true); //decode JSON once again from business - DL

	$response1 = get_business($business_id1);	
	$response1 = json_decode($response1, true);
	
	$response2 = get_business($business_id2);
	$response2 = json_decode($response2, true);
	
	$response3 = get_business($business_id3);	
	$response3 = json_decode($response3, true);
	
	$response4 = get_business($business_id4);
	$response4 = json_decode($response4, true);

	$response5 = get_business($business_id5);	
	$response5 = json_decode($response5, true);
	
	$response6 = get_business($business_id6);	
	$response6 = json_decode($response6, true);

	$response7 = get_business($business_id7);	
	$response7 = json_decode($response7, true);
	
	$response8 = get_business($business_id8);	
	$response8 = json_decode($response8, true);	
	
//	var_dump($response);
//	echo $response['snippet_image_url'];

	echo "<img src = $response[image_url] >";
	echo "<img src = $response1[image_url] >";

	echo "<img src = $response2[image_url] >";
	echo "<img src = $response3[image_url] >";
	echo "<img src = $response4[image_url] >";
	echo "<img src = $response5[image_url] >";
	echo "<img src = $response6[image_url] >";
	echo "<img src = $response7[image_url] >";
	echo "<img src = $response8[image_url] >";

    
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

query_api($term, $location);
?>