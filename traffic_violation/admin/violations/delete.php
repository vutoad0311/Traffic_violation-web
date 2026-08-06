<?php

require '../includes/auth.php';
require '../../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| Kiểm tra vi phạm tồn tại
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT id
    FROM violations
    WHERE id = :id
");

$stmt->execute([
    ":id" => $id
]);

if (!$stmt->fetch()) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Xóa vi phạm
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    DELETE
    FROM violations
    WHERE id = :id
");

$stmt->execute([
    ":id" => $id
]);

header("Location: index.php");
exit;