<?php
require_once "config.php";
require_once "functions.php";
require_once "classes/Engine.php";
$engine = new Engine();
$engine->setPageTitle("TravelHorizon");

include_once "includes/header.php";

if ($engine->getError()) {
    echo "<div style='border:1px solid red;padding:10px;margin: 10px auto;
        width: 500px;'>" . $engine->getError() . "</div>";
}

echo $engine->getContentPage();

include_once "includes/footer.php";
?>