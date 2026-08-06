<?php

$host = "localhost";
$port = "5432";
$dbname = "traffic_violation";
$username = "postgres";
$password = "03112004"; 

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}