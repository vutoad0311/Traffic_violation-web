<?php

require '../includes/auth.php';
require '../../config/database.php';
include '../includes/navbar.php';
$keyword = trim($_GET['keyword'] ?? '');

if ($keyword != '') {

    $sql = "
        SELECT *
        FROM vehicles
        WHERE license_plate ILIKE :keyword
           OR owner_name ILIKE :keyword
        ORDER BY id
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':keyword' => "%{$keyword}%"
    ]);

} else {

    $stmt = $conn->query("
        SELECT *
        FROM vehicles
        ORDER BY id
    ");

}

$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Quản lý phương tiện</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
<main class="container mt-5">

<main class="d-flex justify-content-between align-items-center mb-4">

<h2>

Quản lý phương tiện

</h2>

<a
href="add.php"
class="btn btn-primary">

+ Thêm phương tiện

</a>

</main>

<form method="GET" class="row mb-4">

<main class="col-md-10">

<input
type="text"
name="keyword"
class="form-control"
placeholder="Tìm theo biển số hoặc chủ xe..."
value="<?= htmlspecialchars($keyword) ?>">

</main>

<main class="col-md-2 d-grid">

<button class="btn btn-secondary">

Tìm kiếm

</button>

</main>

</form>

<main class="card shadow">

<main class="card-body">

<main class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Biển số</th>

<th>Chủ sở hữu</th>

<th>Loại xe</th>

<th>Hãng</th>

<th>Model</th>

<th>Màu</th>

<th width="180">

Thao tác

</th>

</tr>

</thead>

<tbody>

<?php if(count($vehicles)==0): ?>

<tr>

<td colspan="8" class="text-center">

Không có dữ liệu.

</td>

</tr>

<?php endif; ?>

<?php foreach($vehicles as $v): ?>

<tr>

<td>

<?= $v['id'] ?>

</td>

<td>

<?= htmlspecialchars($v['license_plate']) ?>

</td>

<td>

<?= htmlspecialchars($v['owner_name']) ?>

</td>

<td>

<?= htmlspecialchars($v['vehicle_type']) ?>

</td>

<td>

<?= htmlspecialchars($v['brand']) ?>

</td>

<td>

<?= htmlspecialchars($v['model']) ?>

</td>

<td>

<?= htmlspecialchars($v['color']) ?>

</td>

<td>

<a
href="edit.php?id=<?= $v['id'] ?>"
class="btn btn-warning btn-sm">

Sửa

</a>

<a
href="delete.php?id=<?= $v['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Bạn có chắc muốn xóa?')">

Xóa

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</main>

</main>

</main>

</main>

</body>

</html>