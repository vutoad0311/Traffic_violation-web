<?php

require '../includes/auth.php';
require '../../config/database.php';

include '../includes/header.php';
include '../includes/navbar.php';

$sql = "
SELECT
    violations.*,
    vehicles.license_plate
FROM violations
INNER JOIN vehicles
ON violations.vehicle_id = vehicles.id
ORDER BY violations.violated_at DESC
";

$stmt = $conn->query($sql);

$violations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Quản lý vi phạm

        </h2>

        <a href="add.php"
           class="btn btn-primary">

            Thêm vi phạm

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Biển số</th>

                        <th>Ngày vi phạm</th>

                        <th>Tỉnh/TP</th>

                        <th>Địa điểm</th>

                        <th>Trạng thái</th>

                        <th width="170">

                            Thao tác

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php if (count($violations) > 0): ?>

                    <?php foreach ($violations as $row): ?>

                        <tr>

                            <td>

                                <?= $row['id'] ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['license_plate']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['violated_at']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['province']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['location']) ?>

                            </td>

                            <td>

                                <?php
                                if ($row['status'] == 'processed') {
                                    echo '<span class="badge bg-success">Đã xử lý</span>';
                                } else {
                                    echo '<span class="badge bg-warning text-dark">Chưa xử lý</span>';
                                }
                                ?>

                            </td>

                            <td>

                             <a href="view.php?id=<?= $row['id'] ?>"
   class="btn btn-info btn-sm">

    Xem

</a>

<a href="edit.php?id=<?= $row['id'] ?>"
   class="btn btn-warning btn-sm">

    Sửa

</a>

<a href="delete.php?id=<?= $row['id'] ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Bạn có chắc chắn muốn xóa?');">

    Xóa

</a>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="7" class="text-center">

                            Chưa có dữ liệu.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</main>

<?php

include '../includes/footer.php';

?>