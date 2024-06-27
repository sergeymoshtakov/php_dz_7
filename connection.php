<?php
$host = 'localhost';
$dbname = 'todo_app';
$username = 'root';  
$password = 'Moshtakov2005s';  
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error DB connection: {$ex->getMessage()}";
    exit();
}
return $pdo;
