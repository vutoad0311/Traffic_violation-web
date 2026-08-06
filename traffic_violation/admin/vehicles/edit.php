<?php

require '../includes/auth.php';
require '../../config/database.php';

include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("
    SELECT *
    FROM vehicles
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vehicle) {
    header("Location: index.php");
    exit;
}

$error = "";

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
        AND id <> :id
    ");

    $check->execute([
        ':license_plate' => $license_plate,
        ':id' => $id
    ]);

    if ($check->fetch()) {

        $error = "Biển số xe đã tồn tại.";

    } else {

        $sql = "
            UPDATE vehicles
            SET
                license_plate = :license_plate,
                owner_name = :owner_name,
                vehicle_type = :vehicle_type,
                brand = :brand,
                model = :model,
                color = :color,
                registration_date = :registration_date,
                inspection_expiry = :inspection_expiry
            WHERE id = :id
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
            ':inspection_expiry' => $inspection_expiry,
            ':id' => $id
        ]);

        header("Location: index.php");
        exit;
    }
}

?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h4 class="mb-0">

                Sửa phương tiện

            </h4>

        </div>

        <div class="card-body">

            <?php if ($error != ""): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">

                        Biển số

                    </label>

                    <input
                        type="text"
                        name="license_plate"
                        class="form-control"
                        value="<?= htmlspecialchars($vehicle['license_plate']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Chủ sở hữu

                    </label>

                    <input
                        type="text"
                        name="owner_name"
                        class="form-control"
                        value="<?= htmlspecialchars($vehicle['owner_name']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Loại xe

                    </label>

                    <select
                        name="vehicle_type"
                        class="form-select">

                        <option <?= $vehicle['vehicle_type']=='Ô tô'?'selected':'' ?>>Ô tô</option>

                        <option <?= $vehicle['vehicle_type']=='Xe máy'?'selected':'' ?>>Xe máy</option>

                        <option <?= $vehicle['vehicle_type']=='Xe tải'?'selected':'' ?>>Xe tải</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Hãng

                    </label>

                    <input
                        type="text"
                        name="brand"
                        class="form-control"
                        value="<?= htmlspecialchars($vehicle['brand']) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Model

                    </label>

                    <input
                        type="text"
                        name="model"
                        class="form-control"
                        value="<?= htmlspecialchars($vehicle['model']) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Màu xe

                    </label>

                    <input
                        type="text"
                        name="color"
                        class="form-control"
                        value="<?= htmlspecialchars($vehicle['color']) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Ngày đăng ký

                    </label>

                    <input
                        type="date"
                        name="registration_date"
                        class="form-control"
                        value="<?= $vehicle['registration_date'] ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        Hạn đăng kiểm

                    </label>

                    <input
                        type="date"
                        name="inspection_expiry"
                        class="form-control"
                        value="<?= $vehicle['inspection_expiry'] ?>">

                </div>

                <button class="btn btn-warning">

                    Cập nhật

                </button>

                <a href="index.php" class="btn btn-secondary">

                    Quay lại

                </a>

            </form>

        </div>

    </div>

</div>

<?php

include '../includes/footer.php';

?>