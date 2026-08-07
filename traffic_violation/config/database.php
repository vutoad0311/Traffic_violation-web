<?php

$host = "ep-lively-poetry-az2jhe61-pooler.c-3.ap-southeast-1.aws.neon.tech";
$port = "5432";
$dbname = "neondb";
$username = "neondb_owner";
$password = "npg_d6SkNzuHm0Te";

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}