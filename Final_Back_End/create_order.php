<?php
include './connection.php';
include './utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(null, 'failed', 'POST method required');
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['product_id'], $input['quantity'], $input['customer_name'])) {
    respond(null, 'failed', 'Product ID, quantity, and customer name are required');
}

$product_id = (int)$input['product_id'];
$quantity = (int)$input['quantity'];
$customer_name = trim($input['customer_name']);

try {
  
    $statment = $connection->prepare("SELECT * FROM products WHERE product_id = ? LIMIT 1");
    $statment->execute([$product_id]);
    $product = $statment->fetch();

    if (!$product) respond(null, 'Failed', 'Product not found');

    $statment = $connection->prepare("INSERT INTO orders (product_id, quantity, customer_name) VALUES (?, ?, ?)");
    $statment->execute([$product_id, $quantity, $customer_name]);

    respond(['order_id' => $connection->lastInsertId()], 'Success', 'Order created successfully');
} catch (PDOException $e) {
    respond(null, 'failed', 'Error creating the order');
}
