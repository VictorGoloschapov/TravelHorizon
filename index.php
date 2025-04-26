<?php
/**PROJECT DOCUMENTATION
 * 
*/

/**todo list for refactor
 * in function.php create search function for flight, hotel, car rental offers - in process
 * seacrh form - need to check for empty fields, SQL injection prevent
 * seacrh results - need to check for empty array fields in flights array
 * create new repo for UI components and html template development
 */

/** to do list for new features and improvements 
 * add database
 * add sorting to search results
 * replan project to MVC architecture
*/

/*--------------------------------------------------*/
require_once "config.php";
require_once "functions.php";

include_once "includes/header.php";
include_once "search.php";

include_once "includes/footer.php";
?>
