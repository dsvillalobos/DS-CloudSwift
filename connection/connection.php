<?php

$hostname = "localhost";
$port = "3306";
$username = "root";
$password = "";
$dbname = "dscloudswift";

try {
    $conn = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Couldn't Establish a Connection: " . $err->getMessage();
}
