<?php

/**
 * Helper Functions
 *
 * Contains reusable helper functions
 * used throughout the application.
 */

/**
 * Escapes HTML special characters.
 *
 * Prevents Cross-Site Scripting (XSS).
 *
 * @param string $text
 *
 * @return string Escaped text.
 */

function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirects the browser
 * to another page.
 *
 * @param string $page Destination page.
 */

function redirect($page)
{
    header("Location: " . $page);
    exit;
}

/**
 * Checks whether an ID
 * is a valid positive integer.
 *
 * @param mixed $id
 *
 * @return bool
 */

function validId($id)
{
    return is_numeric($id) && $id > 0 && floor($id) == $id;
}

/**
 * Converts database category names
 * into user-friendly text.
 *
 * @param string $category
 *
 * @return string
 */

function categoryName($category)
{
    switch ($category) {

        case "food":
            return "Food";

        case "convenience":
            return "Convenience";

        case "non-food":
            return "Non-Food";

        default:
            return $category;
    }
}

/**
 * Returns the current date.
 *
 * @return string Current date.
 */

function today()
{
    return date("d.m.Y");
}