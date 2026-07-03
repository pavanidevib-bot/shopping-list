<?php
/**
 * Create Shopping Item
 *
 * Displays the form and
 * inserts a new shopping item.
 */
require_once "inc/database_functions.inc.php";
require_once "inc/functions.inc.php";

$title = "";
$quantity = "";
$unit = "";
$information = "";
$category = "";

$errors = [];
// Validate user input.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $quantity = trim($_POST["quantity"]);
    $unit = $_POST["unit"];
    $information = trim($_POST["information"]);
    $category = $_POST["category"];

    // Validation

    if (strlen($title) < 2 || strlen($title) > 40) {
        $errors[] = "Title must contain 2 to 40 characters.";
    }

    if (!is_numeric($quantity) || $quantity <= 0) {
        $errors[] = "Quantity must be greater than 0.";
    }

    $allowedUnits = ["l", "g", "kg", "St.", "Pk."];

    if (!in_array($unit, $allowedUnits)) {
        $errors[] = "Please select a valid unit.";
    }

    if (strlen($information) > 120) {
        $errors[] = "Information can contain a maximum of 120 characters.";
    }

    $allowedCategories = [
        "food",
        "convenience",
        "non-food"
    ];

    if (!in_array($category, $allowedCategories)) {
        $errors[] = "Please select a valid category.";
    }

    if (empty($errors)) {
        // Save the new item if validation succeeds.

        createItem(
            $title,
            $quantity,
            $unit,
            $information,
            $category
        );
        
        // Redirect to the shopping list after saving.

        redirect("list.php");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Item</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <h1>New Shopping Item</h1>

    <?php
    // Display validation errors if any exist
    if (!empty($errors)) {
        echo "<div class='error'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
    ?>

    <!-- New item form -->
    <form method="post">

        <!-- Title -->
        <label>Title</label>
        <input type="text"
               name="title"
               value="<?= e($title); ?>"
               required>

        <!-- Quantity -->
        <label>Quantity</label>
        <input type="number"
               step="0.01"
               name="quantity"
               value="<?= e($quantity); ?>"
               required>

        <!-- Unit -->
        <label>Unit</label>
        <select name="unit">
            <option value="">Select</option>
            <option value="l" <?= $unit=="l"?"selected":"" ?>>l</option>
            <option value="g" <?= $unit=="g"?"selected":"" ?>>g</option>
            <option value="kg" <?= $unit=="kg"?"selected":"" ?>>kg</option>
            <option value="St." <?= $unit=="St."?"selected":"" ?>>St.</option>
            <option value="Pk." <?= $unit=="Pk."?"selected":"" ?>>Pk.</option>
        </select>

        <!-- Information -->
        <label>Information</label>
        <textarea name="information"><?= e($information); ?></textarea>

        <!-- Category -->
        <label>Category</label>
        <select name="category">
            <option value="">Select</option>
            <option value="food" <?= $category=="food"?"selected":"" ?>>
                Food
            </option>
            <option value="convenience" <?= $category=="convenience"?"selected":"" ?>>
                Convenience
            </option>
            <option value="non-food" <?= $category=="non-food"?"selected":"" ?>>
                Non-Food
            </option>
        </select>

        <!-- Submit -->
        <input type="submit" value="Save">

        <!-- Cancel -->
        <a href="list.php">Cancel</a>

    </form>

</div>

</body>
</html>