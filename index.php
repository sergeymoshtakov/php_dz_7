<?php
$pdo = include_once __DIR__ . '/connection.php';

$stmt = $pdo->query("SELECT COUNT(*) as count FROM categories");
$count = $stmt->fetchColumn();

if ($count == 0) {
    $categories = [
        'Домашні',
        'Святкові',
        'Робочі'
    ];

    try {
        foreach ($categories as $category) {
            $insertSql = "INSERT INTO categories (name) VALUES (:name)";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute(['name' => $category]);
        }
    } catch (PDOException $ex) {
        echo "Errors with adding categories: {$ex->getMessage()}";
    }
}

$stmt = $pdo->query("SELECT tasks.*, categories.name as category_name FROM tasks LEFT JOIN categories ON tasks.category_id = categories.id");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Task List</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="add_task.php" class="btn btn-primary">Add Task</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task['id']) ?></td>
                            <td><?= htmlspecialchars($task['title']) ?></td>
                            <td><?= htmlspecialchars($task['description']) ?></td>
                            <td><?= htmlspecialchars($task['category_name']) ?></td>
                            <td>
                                <a href="edit_task.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_task.php?id=<?= htmlspecialchars($task['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
