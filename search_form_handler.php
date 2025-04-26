<?php
/**Working with Amadues API
 * 1. Requesting an access token
 * 2. Calling the Flight Offers Search API
 */

//1. Start by loading API requests
use WpOrg\Requests\Requests;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $departure = $_GET["departure"] ?? "";
    $arrival = $_GET["arrival"] ?? "";
    $dateOfFlight = $_GET["dateOfFlight"] ?? "";
    $pax_count = $_GET["pax_count"] ?? "";
}

//2. Requesting an access token
$auth_data = array(
    'client_id' => $_ENV["API_KEY"],
    'client_secret' => $_ENV["API_SECRET"],
    'grant_type'    => 'client_credentials'
);

$url = "https://test.api.amadeus.com/v1/security/oauth2/token";//url for amadeus api
$headers = array('Content-Type' => 'application/x-www-form-urlencoded');
$requests_response = Requests::post($url, $headers, $auth_data);
$response_body = json_decode($requests_response->body);
$access_token = $response_body->access_token;

//for test
echo '<pre>', json_encode($response_body, JSON_PRETTY_PRINT), '</pre>';


//3. Calling the Flight Offers Search API
$travel_data = array(
    'originLocationCode'        => $departure,
    'destinationLocationCode'   => $arrival,
    'departureDate'             => $dateOfFlight,
    'adults'                    => $pax_count,
);

$endpoint = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
$params = http_build_query($travel_data);
$url = $endpoint.'?'. $params;
$headers = array('Authorization' => 'Bearer '.$access_token);

$response = Requests::get($url, $headers);
$flights_offers = json_decode($response->body, true); //array with flight offers

require_once "includes/search_results.php";
?>

