<?php
/**PROJECT DOCUMENTATION
 * 
*/

/**todo list for refactor
 * seacrh form - need to check for empty fields, SQL injection prevent
 * seacrh results - need to check for empty array fields in flights array
 */

/** to do list for new features and improvements
 * add hotel rooms search
 * add car rental search
 * add database
 * add autocomplete in search forms
 * add sorting to search results
*/

/*--------------------------------------------------*/
require_once "config.php";
require_once "functions.php";
require_once "Engine.php";

include_once "includes/header.php";

$engine = new Engine();

if ($engine->getError()) {
    echo "<p style='color:red'>" . $engine->getError() . "</p>";
}

echo $engine->getContentPage();
include_once "includes/section.php";
include_once "includes/footer.php";
?>
