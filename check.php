<?php

/**
 * Check Item Page
 *
 * Toggles the completion status of a shopping item
 * and redirects back to the shopping list.
 */

// Include database functions
require_once "inc/database_functions.inc.php";

// Include helper functions
require_once "inc/functions.inc.php";


/* HANDLE FORM SUBMISSION  */

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check whether an item ID was submitted and is valid
    if (isset($_POST["id"]) && validId($_POST["id"])) {

        // Change the item's status (checked ↔ unchecked)
        toggleStatus($_POST["id"]);
    }
}


// Return the user to the shopping list page
redirect("list.php");