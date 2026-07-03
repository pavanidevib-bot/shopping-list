<?php

/**
 * Edit Item Page
 *
 * Loads an existing shopping item,
 * validates user input,
 * updates the database,
 * and redirects back to the shopping list.
 */

// Include database functions
require_once "inc/database_functions.inc.php";

// Include helper functions
require_once "inc/functions.inc.php";


/* ===============================
   CHECK ITEM ID
   =============================== */

// Check whether an ID was provided and is valid
if (!isset($_GET["id"]) || !validId($_GET["id"])) {
    redirect("list.php");
}

// Store the item ID
$id = $_GET["id"];

// Load the shopping item from the database
$item = getItem($id);

// If the item doesn't exist, return to the list
if (!$item) {
    redirect("list.php");
}


// Fill the form with the current item values
$title = $item["title"];
$quantity = $item["quantity"];
$unit = $item["unit"];
$information = $item["information"];
$category = $item["category"];

// Store validation errors
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Read and clean user input
    $title = trim($_POST["title"]);
    $quantity = trim($_POST["quantity"]);
    $unit = $_POST["unit"];
    $information = trim($_POST["information"]);
    $category = $_POST["category"];


    /*  VALIDATION  */

    // Title must contain between 2 and 40 characters
    if (strlen($title) < 2 || strlen($title) > 40) {
        $errors[] = "Title must contain 2 to 40 characters.";
    }

    // Quantity must be a positive number
    if (!is_numeric($quantity) || $quantity <= 0) {
        $errors[] = "Quantity must be greater than 0.";
    }

    // Allowed units
    $allowedUnits = ["l", "g", "kg", "St.", "Pk."];

    // Check if the selected unit is valid
    if (!in_array($unit, $allowedUnits)) {
        $errors[] = "Please select a valid unit.";
    }

    // Information must not exceed 120 characters
    if (strlen($information) > 120) {
        $errors[] = "Information must not exceed 120 characters.";
    }

    // Allowed categories
    $allowedCategories = [
        "food",
        "convenience",
        "non-food"
    ];

    // Check if the selected category is valid
    if (!in_array($category, $allowedCategories)) {
        $errors[] = "Please select a valid category.";
    }


    /*    UPDATE ITEM   */

    // Update the database if there are no validation errors
    if (empty($errors)) {

        updateItem(
            $id,
            $title,
            $quantity,
            $unit,
            $information,
            $category
        );

        // Return to the shopping list
        redirect("list.php");
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Edit Item</title>

<!-- Main stylesheet -->
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<!-- Page heading -->
<h1>Edit Shopping Item</h1>

<?php
// Display validation errors
if (!empty($errors)) {

    echo "<div class='error'>";

    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }

    echo "</div>";
}
?>


<form method="post">

    <!-- Display item information -->
    <p><strong>ID:</strong> <?= e($item["id"]); ?></p>

    <p><strong>Created:</strong> <?= e($item["created_at"]); ?></p>

    <p><strong>Last Updated:</strong> <?= e($item["updated_at"]); ?></p>

    <!-- Item title -->
    <label>Title</label>

    <input
        type="text"
        name="title"
        value="<?= e($title); ?>"
        required>

    <!-- Quantity -->
    <label>Quantity</label>

    <input
        type="number"
        step="0.01"
        name="quantity"
        value="<?= e($quantity); ?>"
        required>

    <!-- Unit selection -->
    <label>Unit</label>

    <select name="unit">

        <option value="l" <?= $unit=="l" ? "selected" : "" ?>>l</option>

        <option value="g" <?= $unit=="g" ? "selected" : "" ?>>g</option>

        <option value="kg" <?= $unit=="kg" ? "selected" : "" ?>>kg</option>

        <option value="St." <?= $unit=="St." ? "selected" : "" ?>>St.</option>

        <option value="Pk." <?= $unit=="Pk." ? "selected" : "" ?>>Pk.</option>

    </select>

    <!-- Additional information -->
    <label>Information</label>

    <textarea name="information"><?= e($information); ?></textarea>

    <!-- Category selection -->
    <label>Category</label>

    <select name="category">

        <option value="food"
            <?= $category=="food" ? "selected" : "" ?>>
            Food
        </option>

        <option value="convenience"
            <?= $category=="convenience" ? "selected" : "" ?>>
            Convenience
        </option>

        <option value="non-food"
            <?= $category=="non-food" ? "selected" : "" ?>>
            Non-Food
        </option>

    </select>

    <!-- Save changes -->
    <input type="submit" value="Update">

    <!-- Return without saving -->
    <a href="list.php">Cancel</a>

</form>

</div>

</body>

</html>