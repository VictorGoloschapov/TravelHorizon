<?php

// var_dump($_GET);

// var_dump($_SERVER);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $departure = $_GET["departure"] ?? "";
    $arrival = $_GET["arrival"] ?? "";
    $dateOfFlight = $_GET["dateOfFlight"] ?? "";
}

// Фильтруем рейсы, где маршрут "JFK" → "LHR"
$filteredFlights = array_filter($flights, function($flight) use ($departure, $arrival, $dateOfFlight){
    return $flight['from'] == $departure && $flight['to'] == $arrival && $flight['date'] == $dateOfFlight;
});

// Сортируем отфильтрованные рейсы по дате
usort($filteredFlights, function($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});

if (!empty($filteredFlights)) {
    foreach($filteredFlights as $flight) {
        echo "<div class='search_result_container'>";
        echo "Flight from " . $flight['from'] . " to " . $flight['to'] . " on " . $flight['date'] . " for $" . $flight['price'] . " by " . $flight['airline'] . "<br>";
        echo "<a href='" . $flight['link'] . "'>Book Now</a><br><br>";
        echo "</div>";
    }
} else {
    echo "No flights found based on your criteria.";
}
?>

<pre>
    <p class="fs-4 text-decoration-underline text-danger">Stack trace</p>
    <?php
    echo "flights examples:";

    foreach ($flights as $flight) {
        echo "Flight from " . $flight['from'] . " to " . $flight['to'] . " on " . $flight['date'] . " for $" . $flight['price'] . " by " . $flight['airline'] . "<br>";
    }

    echo "result:";

    echo "Departure airport:" . $departure . "<br>";
    echo "Departure airport:" . $arrival . "<br>";
    echo "date:" . $dateOfFlight . "<br>";
    echo "<br>";

    var_dump($filteredFlights);
    ?>
</pre>