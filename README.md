# Shopping List Web Application

## Overview

The Shopping List Web Application is a PHP and MySQL project that allows users to manage a personal shopping list through a simple web interface.

Users can:

- Add new shopping items
- Edit existing items
- Delete individual items
- Mark items as completed
- Hide completed items
- Group items by category
- Delete all items and start a new shopping list

The application follows a simple CRUD (Create, Read, Update, Delete) structure and uses PHP with a MySQL database.

---

## Features

- Create shopping items
- Update shopping items
- Delete shopping items
- Mark items as completed
- Show or hide completed items
- Group items by category
- Display creation and update timestamps
- Input validation
- Protection against HTML injection using `htmlspecialchars()`
- Simple responsive interface using CSS

---

## Technologies Used

- PHP 8+
- MySQL / MariaDB
- HTML5
- CSS3
- PDO (PHP Data Objects)

---

## Project Structure

```
shopping-list/
│
├── css/
│   └── style.css
│
├── inc/
│   ├── database.inc.php
│   ├── database_functions.inc.php
│   └── functions.inc.php
│
├── create.php
├── update.php
├── delete.php
├── check.php
├── clear.php
├── list.php
├── index.php
│
├── shopping_list.sql
└── README.md
```

---

## Database

The project uses one database named:

```
shopping_list
```

with one table:

```
shopping_items
```

### Table Fields

| Field | Type | Description |
|--------|------|-------------|
| id | INT | Primary key |
| title | VARCHAR(40) | Item name |
| quantity | DECIMAL | Item quantity |
| unit | ENUM | Unit of measurement |
| information | VARCHAR(120) | Additional notes |
| category | ENUM | food, convenience, non-food |
| status | TINYINT | 0 = open, 1 = completed |
| created_at | TIMESTAMP | Creation date |
| updated_at | TIMESTAMP | Last modification |

---

## Installation

### 1. Clone the project

```bash
git clone https://github.com/yourusername/shopping-list.git
```

or download the ZIP file.

---

### 2. Copy into your web server

Example:

```
xampp/htdocs/shopping-list
```

---

### 3. Create the database

Import

```
shopping_list.sql
```

using phpMyAdmin or the MySQL command line.

---

### 4. Configure the database

Open

```
inc/database.inc.php
```

and adjust the database credentials if necessary.

Example:

```php
$host = "localhost";
$dbname = "shopping_list";
$username = "root";
$password = "";
```

---

### 5. Start Apache and MySQL

Using XAMPP, WAMP or MAMP.

---

### 6. Open the application

```
http://localhost/shopping-list/
```

---

## Validation Rules

### Title

- Required
- 2–40 characters

### Quantity

- Required
- Must be greater than 0

### Information

- Maximum 120 characters

### Unit

Allowed values:

- l
- g
- kg
- St.
- Pk.

### Category

Allowed values:

- Food
- Convenience
- Non-Food

---

## Application Workflow

```
User

   │

   ▼

Shopping List

   │

   ├── Create Item

   ├── Edit Item

   ├── Delete Item

   ├── Toggle Status

   └── Clear List

          │

          ▼

      MySQL Database
```

---

## Security

The application includes basic security features:

- Prepared SQL statements (PDO)
- HTML escaping with `htmlspecialchars()`
- Input validation
- Server-side validation
- ID validation before database operations

---

## Future Improvements

Possible enhancements include:

- User authentication
- Search functionality
- Pagination
- Sorting by quantity
- Mobile-friendly improvements
- Shopping priorities
- Favorite items
- Image uploads

---
