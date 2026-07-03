<?php
/**
 * Shopping List Page
 *
 * Displays all shopping items.
 * Supports sorting, filtering,
 * editing and deleting items.
 */


require_once "inc/database_functions.inc.php"; // database functions
require_once "inc/functions.inc.php"; // helper functions

$sort = isset($_GET['sort']) && $_GET['sort'] === "category"; // check if category sorting is active
$hide = isset($_GET['hide']) ? (int)$_GET['hide'] : 0; // check if completed items should be hidden

$items = getAllItems($sort, $hide); // load items from database

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <div class="top-bar">

        <div class="left-actions">
            <h1>My Shopping List</h1>
            <p class="date"><?= today(); ?></p> <!-- show current date -->
        </div>

        <div class="right-actions">

            <a href="create.php" class="icon-btn" title="New Item">➕</a> <!-- add item -->

            <?php if ($sort): ?>
                <a href="list.php<?= $hide ? '?hide=1' : '' ?>"
                   class="icon-btn"
                   title="Flat View">📄</a> <!-- switch to flat view -->
            <?php else: ?>
                <a href="list.php<?= $hide ? '?hide=1&sort=category' : '?sort=category' ?>"
                   class="icon-btn"
                   title="Group by Category">📂</a> <!-- switch to grouped view -->
            <?php endif; ?>

            <?php if ($hide): ?>
                <a href="list.php<?= $sort ? '?sort=category' : '' ?>"
                   class="icon-btn"
                   title="Show All">👁️‍🗨️</a> <!-- show all items -->
            <?php else: ?>
                <a href="list.php<?= $sort ? '?sort=category&hide=1' : '?hide=1' ?>"
                   class="icon-btn"
                   title="Hide Completed">👁️</a> <!-- hide completed items -->
            <?php endif; ?>

        </div>

    </div>

    <?php if (empty($items)): ?>
        <p>No items available.</p> <!-- empty list message -->

    <?php else: ?>

    <table>

        <tr>
            <th>Status</th>
            <th>Item</th>
            <th>Category</th>
            <th>Qty</th>
            <th>Actions</th>
        </tr>

        <?php
        $currentCategory = ""; // track category for grouping

        foreach ($items as $item):

            if ($sort && $currentCategory != $item['category']):
                $currentCategory = $item['category']; // update category
        ?>
            <tr class="category-row">
                <td colspan="5">
                    <?= e(categoryName($currentCategory)); ?> <!-- category label -->
                </td>
            </tr>
        <?php endif; ?>

        <tr class="<?= $item['status'] ? 'done' : ''; ?>"> <!-- mark completed items -->

            <td>

                <?php
                $formId = 'check-form-' . $item['id']; // unique check form ID
                ?>

                <form id="<?= $formId; ?>" action="check.php" method="post">

                    <input type="hidden" name="id" value="<?= $item['id']; ?>"> <!-- item ID -->

                    <input type="checkbox"
                           onchange="this.form.submit()"
                           <?= $item['status'] ? 'checked' : ''; ?>> <!-- toggle status -->

                </form>

            </td>

            <td><?= e($item['title']); ?></td> <!-- item name -->

            <td><?= e(categoryName($item['category'])); ?></td> <!-- category -->

            <td class="quantity">
                <span class="amount"><?= e($item['quantity']); ?></span> <!-- quantity -->
                <span class="unit"><?= e($item['unit']); ?></span> <!-- unit -->
            </td>

            <td class="actions">

                <a class="btn-edit"
                   href="update.php?id=<?= $item['id']; ?>">Edit</a> <!-- edit item -->

                <?php
                $formId = 'delete-form-' . $item['id']; // unique delete form ID
                ?>

                <form id="<?= $formId; ?>"
                      action="delete.php"
                      method="post"
                      class="inline">

                    <input type="hidden" name="id" value="<?= $item['id']; ?>"> <!-- item ID -->

                    <button type="submit"
                            onclick="return confirm('Delete this item?')">
                        Delete <!-- delete action -->
                    </button>

                </form>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

    <?php endif; ?>

    <div class="bottom-actions">

        <form action="clear.php" method="post">

            <button type="submit"
                    class="danger-btn"
                    onclick="return confirm('Delete all items?')">
                🗑 New List <!-- clear all items -->
            </button>

        </form>

    </div>

</div>

</body>
</html>