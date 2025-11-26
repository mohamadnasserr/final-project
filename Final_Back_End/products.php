<?php
include './connection.php';
include './utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    respond(null, 'failed', 'GET method required');
}

try {
    $statement = $connection->query("SELECT * FROM products");
    $products = $statement->fetchAll();
    respond($products);
} catch (PDOException $e) {
    respond(null, 'failed', 'Error fetching producs');
}
