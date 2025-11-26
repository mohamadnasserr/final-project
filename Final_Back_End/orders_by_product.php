<?php
include './connection.php';
include './utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    respond(null, 'failed', 'GET method required');
}

if (!isset($_GET['product_id'])) {
    respond(null, 'failed', 'Product ID required');
}
$product_id = (int)$_GET['product_id'];

try {
   
    $statement = $connection->prepare("SELECT * FROM products WHERE product_id = ? LIMIT 1");
    $statement->execute([$product_id]);
    $product = $statement->fetch();

    if (!$product) {
        respond(null, 'failed', 'Product not found');
    }

    $statement = $connection->prepare("
        SELECT * FROM orders 
        WHERE product_id = ? 
        ORDER BY order_date DESC 
        LIMIT 10
    ");
    $statement->execute([$product_id]);
    $orders = $statement->fetchAll();

    respond($orders, 'Success', '');
    
} catch (PDOException $e) {
    respond(null, 'failed', 'Error fetching the orders');
}
