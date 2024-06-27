<?php
$pdo = include_once __DIR__ . '/connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute(['id' => $id]);
    header('Location: index.php');
} catch (PDOException $ex) {
    echo "Error deleting task: {$ex->getMessage()}";
}
