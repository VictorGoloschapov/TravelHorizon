<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $departure = $_GET["departure"] ?? "";
    $arrival = $_GET["arrival"] ?? "";
    $dateOfFlight = $_GET["dateOfFlight"] ?? "";
    $pax_count = $_GET["pax_count"] ?? "";
}

require __DIR__ . '/vendor/autoload.php';
use WpOrg\Requests\Requests;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$url = "https://test.api.amadeus.com/v1/security/oauth2/token";

$auth_data = array(
    'client_id' => $_ENV["API_KEY"],
    'client_secret' => $_ENV["API_SECRET"],
    'grant_type'    => 'client_credentials'
);


$headers = array('Content-Type' => 'application/x-www-form-urlencoded');

$requests_response = Requests::post($url, $headers, $auth_data);

$response_body = json_decode($requests_response->body);
echo '<pre>', json_encode($response_body, JSON_PRETTY_PRINT), '</pre>';

$access_token = $response_body->access_token;

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
$flights_offers = json_decode($response->body, true);
// print_r($flights_offers );

// echo '<pre>', json_encode($response_body, JSON_PRETTY_PRINT), '</pre>';
?>
    <div>
        <pre>
            <p class="fs-4 text-decoration-underline text-danger">Stack trace</p>
            <?php
            echo "<br>";
            echo "Submitted form result:<br>";

            echo "Departure airport:" . $departure . "<br>";
            echo "Departure airport:" . $arrival . "<br>";
            echo "date:" . $dateOfFlight . "<br>";
            echo "<br>";
            ?>
        </pre>
    </div>

    <h2>Flight Information</h2>
    <h2>Flights found <?php echo count($flights_offers["data"])?></h2>

    <?php foreach ($flights_offers["data"] as $offer): ?>
        <hr>
        <h2>Offer <?= $offer['id'] ?></h2>
        <p><strong>Source:</strong> <?= $offer['source'] ?></p>
        <p><strong>Дата последней продажи билета:</strong> <?= $offer['lastTicketingDate'] ?></p>
        <p><strong>Доступно мест:</strong> <?= $offer['numberOfBookableSeats'] ?></p>

        <?php foreach ($offer['itineraries'] as $itineraryIndex => $itinerary): ?>
            <h3>Маршрут #<?= $itineraryIndex + 1 ?> (Длительность: <?= $itinerary['duration'] ?>)</h3>
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Отправление</th>
                        <th>Прибытие</th>
                        <th>Авиакомпания</th>
                        <th>Рейс</th>
                        <th>Самолёт</th>
                        <th>Длительность</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itinerary['segments'] as $segmentIndex => $segment): ?>
                        <tr>
                            <td><?= $segmentIndex + 1 ?></td>
                            <td><?= $segment['departure']['iataCode'] ?> @ <?= $segment['departure']['at'] ?></td>
                            <td><?= $segment['arrival']['iataCode'] ?> @ <?= $segment['arrival']['at'] ?></td>
                            <td><?= $segment['carrierCode'] ?></td>
                            <td><?= $segment['number'] ?></td>
                            <td><?= $segment['aircraft']['code'] ?></td>
                            <td><?= $segment['duration'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

        <h3>Цена</h3>
        <p><strong>Общая:</strong> <?= $offer['price']['grandTotal'] ?> <?= $offer['price']['currency'] ?> (Базовая: <?= $offer['price']['base'] ?>)</p>
       
        <?php if (!empty($offer['price']['additionalServices'])): ?>
            <h4>Дополнительные услуги:</h4>
            <ul>
                <?php foreach ($offer['price']['additionalServices'] as $service): ?>
                    <li><?= $service['type'] ?>: <?= $service['amount'] ?> <?= $offer['price']['currency'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php foreach ($offer['travelerPricings'] as $traveler): ?>
            <h3>Пассажир: <?= $traveler['travelerType'] ?> — <?= $traveler['price']['total'] ?> <?= $traveler['price']['currency'] ?></h3>
            <table>
                <thead>
                    <tr>
                        <th>Сегмент</th>
                        <th>Класс</th>
                        <th>Тариф</th>
                        <th>Багаж</th>
                        <th>Услуги</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($traveler['fareDetailsBySegment'] as $seg): ?>
                        <tr>
                            <td><?= $seg['segmentId'] ?></td>
                            <td><?= $seg['cabin'] ?> (<?= $seg['class'] ?>)</td>
                            <td><?= $seg['brandedFareLabel'] ?> / <?= $seg['fareBasis'] ?></td>
                            <td>Сдаваемый: <?= $seg['includedCheckedBags']['quantity'] ?> / Ручной: <?= $seg['includedCabinBags']['quantity'] ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($seg['amenities'] as $amenity): ?>
                                        <li>
                                            <?= $amenity['description'] ?>
                                            <?= $amenity['isChargeable'] ? ' (€)' : ' (вкл.)' ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

    <?php endforeach; ?>
</body>

