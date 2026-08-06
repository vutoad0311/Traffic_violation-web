<?php

require '../includes/auth.php';
require '../../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$sql = "
SELECT
    violations.*,
    vehicles.license_plate,
    vehicles.owner_name,
    vehicles.vehicle_type,
    vehicles.brand,
    vehicles.color
FROM violations
INNER JOIN vehicles
ON violations.vehicle_id = vehicles.id
WHERE violations.id = :id
LIMIT 1
";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$violation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$violation) {
    header("Location: index.php");
    exit;
}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<main class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Chi tiết vi phạm

        </h2>

        <a href="index.php" class="btn btn-secondary">

            Quay lại

        </a>

    </div>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                Thông tin phương tiện

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="220">

                        Biển số xe

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['license_plate']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Chủ phương tiện

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['owner_name']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Loại phương tiện

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['vehicle_type']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Hãng xe

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['brand']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Màu xe

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['color']) ?>

                    </td>

                </tr>

            </table>

        </div>

    </div>

    <br>

    <div class="card shadow">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">

                Thông tin vi phạm

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="220">

                        Nội dung vi phạm

                    </th>

                    <td>

                        <?= nl2br(htmlspecialchars($violation['description'])) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Ngày vi phạm

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['violated_at']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Địa điểm

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['location']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Tỉnh / Thành phố

                    </th>

                    <td>

                        <?= htmlspecialchars($violation['province']) ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Số quyết định

                    </th>

                    <td>

                   <?= htmlspecialchars($violation['decision_no'] ?? '') ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Hạn xử lý

                    </th>

                    <td>

                   <?= htmlspecialchars($violation['due_date'] ?? '') ?>

                    </td>

                </tr>

                <tr>

                    <th>

                        Trạng thái

                    </th>

                    <td>

                        <?php if ($violation['status'] == 'processed'): ?>

                            <span class="badge bg-success">

                                Đã xử lý

                            </span>

                        <?php else: ?>

                            <span class="badge bg-warning text-dark">

                                Chưa xử lý

                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

            </table>

        </div>

    </div>

</main>

<?php

include '../includes/footer.php';

?>