<?php

/**
 * Database Connection
 *
 * Creates and returns a PDO connection
 * to the Shopping List database.
 */

/**
 * Creates a PDO database connection.
 *
 * @return PDO Database connection object.
 */
function connectDatabase()
{
    // Database server settings
    $host = "localhost";
    $dbname = "shopping_list";
    $username = "root";
    $password = "";

    try
    {
        // Create a new PDO connection
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $username,
            $password
        );

        // Enable exception handling for database errors
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        // Return query results as associative arrays
        $pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );

        // Return the database connection
        return $pdo;
    }
    catch (PDOException $e)
    {
        // Stop the script if the connection fails
        die("Database Connection Failed: " . $e->getMessage());
    }
}