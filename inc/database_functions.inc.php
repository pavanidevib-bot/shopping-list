<?php

/**
 * Database Functions
 *
 * Contains all database operations
 * for the Shopping List application.
 */

// Include the database connection
require_once "database.inc.php";


/**
 * Retrieves all shopping items.
 *
 * @param bool $orderByCategory Sort items by category.
 * @param bool $hideCompleted Hide completed items.
 *
 * @return array List of shopping items.
 */
function getAllItems($orderByCategory = false, $hideCompleted = false)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Base SQL query
    $sql = "SELECT * FROM shopping_items";

    // Store optional WHERE conditions
    $conditions = [];

    // Hide completed items if requested
    if ($hideCompleted) {
        $conditions[] = "status = 0";
    }

    // Add WHERE clause if needed
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    // Sort by category or by item ID
    if ($orderByCategory) {
        $sql .= " ORDER BY category, title";
    } else {
        $sql .= " ORDER BY id";
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Return all shopping items
    return $stmt->fetchAll();
}


/**
 * Retrieves a single shopping item by ID.
 *
 * @param int $id Item ID.
 *
 * @return array|false Shopping item or false if not found.
 */
function getItem($id)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Prepare the query
    $stmt = $pdo->prepare(
        "SELECT * FROM shopping_items
         WHERE id=?"
    );

    // Execute the query
    $stmt->execute([$id]);

    // Return the item
    return $stmt->fetch();
}


/**
 * Inserts a new shopping item into the database.
 *
 * @param string $title
 * @param float $quantity
 * @param string $unit
 * @param string $information
 * @param string $category
 *
 * @return bool True on success.
 */
function createItem(
    $title,
    $quantity,
    $unit,
    $information,
    $category
)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Prepare the INSERT statement
    $stmt = $pdo->prepare(
        "INSERT INTO shopping_items
        (title, quantity, unit, information, category)
        VALUES
        (?, ?, ?, ?, ?)"
    );

    // Execute the query
    return $stmt->execute([
        $title,
        $quantity,
        $unit,
        $information,
        $category
    ]);
}


/**
 * Updates an existing shopping item.
 *
 * @param int $id
 * @param string $title
 * @param float $quantity
 * @param string $unit
 * @param string $information
 * @param string $category
 *
 * @return bool True on success.
 */
function updateItem(
    $id,
    $title,
    $quantity,
    $unit,
    $information,
    $category
)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Prepare the UPDATE statement
    $stmt = $pdo->prepare(
        "UPDATE shopping_items
        SET
        title=?,
        quantity=?,
        unit=?,
        information=?,
        category=?
        WHERE id=?"
    );

    // Execute the query
    return $stmt->execute([
        $title,
        $quantity,
        $unit,
        $information,
        $category,
        $id
    ]);
}


/**
 * Deletes a shopping item.
 *
 * @param int $id Item ID.
 *
 * @return bool True on success.
 */
function deleteItem($id)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Prepare the DELETE statement
    $stmt = $pdo->prepare(
        "DELETE FROM shopping_items
         WHERE id=?"
    );

    // Execute the query
    return $stmt->execute([$id]);
}


/**
 * Toggles the completion status
 * of a shopping item.
 *
 * @param int $id Item ID.
 *
 * @return bool True on success.
 */
function toggleStatus($id)
{
    // Open a database connection
    $pdo = connectDatabase();

    // Load the selected item
    $item = getItem($id);

    // Stop if the item does not exist
    if (!$item) {
        return false;
    }

    // Switch between completed (1) and not completed (0)
    $status = $item['status'] == 1 ? 0 : 1;

    // Prepare the UPDATE statement
    $stmt = $pdo->prepare(
        "UPDATE shopping_items
        SET status=?
        WHERE id=?"
    );

    // Execute the query
    return $stmt->execute([$status, $id]);
}


/**
 * Deletes all shopping items
 * from the database.
 *
 * @return int Number of deleted rows.
 */
function clearList()
{
    // Open a database connection
    $pdo = connectDatabase();

    // Delete every shopping item
    return $pdo->exec(
        "DELETE FROM shopping_items"
    );
}