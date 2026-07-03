-- ==================================================
-- Shopping List Database
-- Creates the database, table and sample data
-- ==================================================

-- Create the database if it does not already exist

CREATE DATABASE IF NOT EXISTS shopping_list;

-- Select the database
USE shopping_list;


-- Create Shopping Items Table
CREATE TABLE shopping_items (

    -- Unique item ID
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    -- Name of the shopping item
    title VARCHAR(40) NOT NULL,

    -- Quantity of the item
    quantity DECIMAL(8,2) NOT NULL,

    -- Unit of measurement for the quantity
    unit ENUM('l','g','kg','St.','Pk.') NOT NULL,

    -- Additional information about the item
    information VARCHAR(120) NOT NULL DEFAULT '',

    -- Category of the item (food, convenience, non-food)
    category ENUM('food','convenience','non-food') NOT NULL,

    -- Status of the item (0 for active, 1 for inactive)
    status TINYINT(1) NOT NULL DEFAULT 0,

    -- Timestamps for creation and last update
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Timestamps for creation and last update
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);
-- Insert sample data into the Shopping Items table
INSERT INTO shopping_items (title, quantity, unit, information, category, status)
VALUES
('Milk',2,'l','Low fat milk','food',0),
('Rice',5,'kg','Basmati Rice','food',0),
('Soap',4,'St.','Bathroom','non-food',1),
('Pizza',2,'Pk.','Frozen Pizza','convenience',0),
('Sugar',1,'kg','','food',0);