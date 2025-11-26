<?php
$host = 'localhost';
$usermane = 'root';
$password = 'Nasser_1998';
$db = 'FCS_66';

try {
    $connection = new PDO("mysql:host=$host;dbname=$db", $usermane, $password);
    echo "Connected Successfully";
} catch (PDOException $e) {
    echo "Connection failed";
    die();
}
