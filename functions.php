<?php
//1. Start by loading API requests
use WpOrg\Requests\Requests;

//2. preparing data for API call
function getTravelParams() {
    return array(
        'originLocationCode'        => $_GET["departure"] ?? "",
        'destinationLocationCode'   => $_GET["arrival"] ?? "",
        'departureDate'             => $_GET["dateOfFlight"] ?? "",
        'adults'                    => $_GET["pax_count"] ?? "1",
    );
}

//3. Requesting an access token
function getAmadeusAccessToken() {
    $auth_data = array (
        'client_id' => $_ENV["API_KEY"],
        'client_secret' => $_ENV["API_SECRET"],
        'grant_type'    => 'client_credentials'
    );

    $url = "https://test.api.amadeus.com/v1/security/oauth2/token";//url for amadeus api
    $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
    $requests_response = Requests::post($url, $headers, $auth_data);
    $response_body = json_decode($requests_response->body);
    $access_token = $response_body->access_token;

    // if (!isset($body->access_token)) {
    //     throw new Exception("Access token not found in response");
    // }

    //for test
    // echo '<pre>', json_encode($response_body, JSON_PRETTY_PRINT), '</pre>';

    return $access_token;
}

//4. Calling the Flight Offers Search API
function fetchAmadeusFlightsOffers($travel_data, $access_token) {
    $endpoint = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
    $params = http_build_query($travel_data);
    $url = $endpoint.'?'. $params;
    $headers = array('Authorization' => 'Bearer '.$access_token);

    $response = Requests::get($url, $headers);
    $flights_offers = json_decode($response->body, true);

    return $flights_offers;
}

function searchAmadeusHotelBookings() {
    $hotelBookingOffers = array();

    return $hotelBookingOffers;
}

function searchAmadeusCarRental() {
    $carRentalOffers = array();

    return $carRentalOffers;
}
?>