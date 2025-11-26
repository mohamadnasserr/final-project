<?php
function respond($data = null, $status = 'success', $message = '') {
    header('Content-Type: application/json');
    echo json_encode([
        'Status' => $status,
        'Message' => $message,
        'Data' => $data
    ], JSON_PRETTY_PRINT);
    exit();
}
