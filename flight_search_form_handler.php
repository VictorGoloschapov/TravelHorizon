<?php

require_once "functions.php";
require_once "config.php";
include_once "includes/header.php";
include_once "includes/flight_search_form.php";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $travel_data = getTravelParams();
        $access_token = getAmadeusAccessToken();
        $flights_offers = fetchAmadeusFlightsOffers($travel_data, $access_token);

        //  echo '<pre>', json_encode($flightsOffers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), '</pre>';
    }
} catch (Exception $e) {
     echo "Ошибка: " . $e->getMessage();
}

$departure = $travel_data['originLocationCode' ];
$arrival = $travel_data['destinationLocationCode' ];
$dateOfFlight  = $travel_data['departureDate' ];
?>

<div class="container mt-4">
    <div class="col-md-2">
        <a class="btn btn-outline-primary mt-3" href="index.php?page=flight_search">Вернуться к поиску</a>
    </div>
</div>

<?php
require_once "includes/search_results.php";
?>

