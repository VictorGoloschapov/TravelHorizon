<?php
/**пока будет иммитация ответа API */

$flights = [
    ["id" => 1, "from" => "JFK", "to" => "LHR", "date" => "2025-06-01", "price" => 450, "airline" => "British Airways", "link" => "https://example.com/book/1"],
    ["id" => 2, "from" => "LAX", "to" => "CDG", "date" => "2025-06-02", "price" => 520, "airline" => "Air France", "link" => "https://example.com/book/2"],
    ["id" => 3, "from" => "ORD", "to" => "AMS", "date" => "2025-06-03", "price" => 430, "airline" => "KLM", "link" => "https://example.com/book/3"],
    ["id" => 4, "from" => "ATL", "to" => "FRA", "date" => "2025-06-04", "price" => 490, "airline" => "Lufthansa", "link" => "https://example.com/book/4"],
    ["id" => 5, "from" => "MIA", "to" => "MAD", "date" => "2025-06-05", "price" => 410, "airline" => "Iberia", "link" => "https://example.com/book/5"],
    ["id" => 6, "from" => "SFO", "to" => "DXB", "date" => "2025-06-06", "price" => 600, "airline" => "Emirates", "link" => "https://example.com/book/6"],
    ["id" => 7, "from" => "SEA", "to" => "NRT", "date" => "2025-06-07", "price" => 550, "airline" => "ANA", "link" => "https://example.com/book/7"],
    ["id" => 8, "from" => "JFK", "to" => "HKG", "date" => "2025-06-08", "price" => 700, "airline" => "Cathay Pacific", "link" => "https://example.com/book/8"],
    ["id" => 9, "from" => "DFW", "to" => "ICN", "date" => "2025-06-09", "price" => 580, "airline" => "Korean Air", "link" => "https://example.com/book/9"],
    ["id" => 10, "from" => "BOS", "to" => "SYD", "date" => "2025-06-10", "price" => 950, "airline" => "Qantas", "link" => "https://example.com/book/10"]
];

//for test curl purposes

// $json_arr = json_encode($flights);
// var_dump(json_decode($json_arr));
$url = "http://localhost/travel_search_engine_project/TravelHorizon/curl_test.php";

// require __DIR__ . '/vendor/autoload.php';
// use Dotenv\Dotenv;
// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// var_dump($_ENV);


$devVersion = "1.0.1";
$devDescription = "New file structure. Using imitation of reply from API, to get developer API";

// var_dump($flights);
?>