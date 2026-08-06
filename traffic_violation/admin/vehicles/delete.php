<?php

require '../includes/auth.php';
require '../../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("
    SELECT id
    FROM vehicles
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

if (!$stmt->fetch()) {
    header("Location: index.php");
    exit;
}


$stmt = $conn->prepare("
    DELETE
    FROM vehicles
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

header("Location: index.php");
exit;