<?php
require __DIR__ . '/vendor/autoload.php';

//.env handling
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$devVersion = "1.1.0";
$devDescription = "New file structure. Implemented Amadeus Self Service API for development purposes";
?>