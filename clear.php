<?php

/**
 * Clear List Page
 *
 * Deletes all shopping items from the database
 * and redirects back to the shopping list.
 */

// Include database functions
require_once "inc/database_functions.inc.php";

// Include helper functions
require_once "inc/functions.inc.php";


// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Delete all shopping list items
    clearList();
}


// Return the user to the shopping list page
redirect("list.php");