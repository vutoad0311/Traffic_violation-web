<?php

require '../includes/auth.php';
require '../../config/database.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $license_plate = trim($_POST['license_plate']);
    $owner_name = trim($_POST['owner_name']);
    $vehicle_type = trim($_POST['vehicle_type']);
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $color = trim($_POST['color']);
    $registration_date = $_POST['registration_date'];
    $inspection_expiry = $_POST['inspection_expiry'];

    $check = $conn->prepare("
        SELECT id
        FROM vehicles
        WHERE license_plate = :license_plate
    ");

    $check->execute([
        ':license_plate' => $license_plate
    ]);

    if ($check->fetch()) {

        $error = "Biển số xe đã tồn tại.";

    } else {

        $sql = "
            INSERT INTO vehicles
            (
                license_plate,
                owner_name,
                vehicle_type,
                brand,
                model,
                color,
                registration_date,
                inspection_expiry
            )
            VALUES
            (
                :license_plate,
                :owner_name,
                :vehicle_type,
                :brand,
                :model,
                :color,
                :registration_date,
                :inspection_expiry
            )
        ";

        $stmt = $conn->prepare($sql);

        $stmt->execute([

            ':license_plate' => $license_plate,
            ':owner_name' => $owner_name,
            ':vehicle_type' => $vehicle_type,
            ':brand' => $brand,
            ':model' => $model,
            ':color' => $color,
            ':registration_date' => $registration_date,
            ':inspection_expiry' => $inspection_expiry

        ]);

        header("Location: index.php");

        exit;

    }

}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Thêm phương tiện</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Thêm phương tiện</h4>

</div>

<div class="card-body">

<?php if($error!=""): ?>

<div class="alert alert-danger">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>

<form method="POST">

<div class="mb-3">

<label>Biển số</label>

<input
type="text"
name="license_plate"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Chủ sở hữu</label>

<input
type="text"
name="owner_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Loại xe</label>

<select
name="vehicle_type"
class="form-select">

<option>Ô tô</option>

<option>Xe máy</option>

<option>Xe tải</option>

</select>

</div>

<div class="mb-3">

<label>Hãng</label>

<input
type="text"
name="brand"
class="form-control">

</div>

<div class="mb-3">

<label>Model</label>

<input
type="text"
name="model"
class="form-control">

</div>

<div class="mb-3">

<label>Màu xe</label>

<input
type="text"
name="color"
class="form-control">

</div>

<div class="mb-3">

<label>Ngày đăng ký</label>

<input
type="date"
name="registration_date"
class="form-control">

</div>

<div class="mb-4">

<label>Hạn đăng kiểm</label>

<input
type="date"
name="inspection_expiry"
class="form-control">

</div>

<button class="btn btn-primary">

Lưu

</button>

<a
href="index.php"
class="btn btn-secondary">

Quay lại

</a>

</form>

</div>

</div>

</div>

</body>

</html>