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
    $statement  = $connection->prepare("SELECT * FROM products WHERE product_id = ? LIMIT 1");
    $statement->execute([$product_id]);
    $product = $statement->fetch();

    if (!$product) respond(null, 'Failed', 'such a product is not available');

    respond($product);
} catch (PDOException $e) {
    respond(null, 'Failed', 'Error fetching product details');
}
