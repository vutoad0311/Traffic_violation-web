<?php

require 'config/database.php';
require 'functions/vehicle.php';
require 'functions/violation.php';

include 'includes/header.php';
include 'includes/navbar.php';

$plate = trim($_GET['license_plate'] ?? '');

$vehicle = null;
$violations = [];

if (!empty($plate)) {
    $vehicle = searchVehicleByPlate($conn, $plate);

    if ($vehicle) {
        $violations = getViolationsByVehicle($conn, $vehicle['id']);
    }
}

?>

<main class="container py-5">

    <main class="card shadow-sm mb-4">

        <main class="card-body">

            <h4 class="mb-3">
                🔍 Tra cứu phương tiện
            </h4>

            <form action="search.php" method="GET">

                <main class="row">

                    <main class="col-md-9">

                        <input
                            type="text"
                            name="license_plate"
                            class="form-control form-control-lg"
                            placeholder="Nhập biển số xe..."
                            value="<?= htmlspecialchars($plate) ?>"
                            required>

                    </main>

                    <main class="col-md-3 d-grid">

                        <button class="btn btn-primary btn-lg">
                            Tra cứu
                        </button>

                    </main>

                </main>

            </form>

        </main>

    </main>

<?php if (empty($plate)): ?>

    <main class="alert alert-warning">
        Vui lòng nhập biển số xe.
    </main>

<?php elseif (!$vehicle): ?>

    <main class="alert alert-danger">
        Không tìm thấy phương tiện có biển số
        <strong><?= htmlspecialchars($plate) ?></strong>
    </main>

<?php else: ?>


    <main class="card shadow mb-4">

        <main class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Thông tin phương tiện
            </h5>

        </main>

        <main class="card-body">

            <table class="table table-bordered align-middle">

                <tr>
                    <th width="220">Biển số</th>
                    <td><?= htmlspecialchars($vehicle['license_plate'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Chủ sở hữu</th>
                    <td><?= htmlspecialchars($vehicle['owner_name'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Loại xe</th>
                    <td><?= htmlspecialchars($vehicle['vehicle_type'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Hãng xe</th>
                    <td><?= htmlspecialchars($vehicle['brand'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Model</th>
                    <td><?= htmlspecialchars($vehicle['model'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Màu xe</th>
                    <td><?= htmlspecialchars($vehicle['color'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Ngày đăng ký</th>
                    <td><?= htmlspecialchars($vehicle['registration_date'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Hạn đăng kiểm</th>
                    <td><?= htmlspecialchars($vehicle['inspection_expiry'] ?? '-') ?></td>
                </tr>

            </table>

        </main>

    </main>

    <main class="card shadow">

        <main class="card-header bg-danger text-white">

            <h5 class="mb-0">
                Danh sách vi phạm
            </h5>

        </main>

        <main class="card-body">

            <?php if (count($violations) == 0): ?>

                <main class="alert alert-success mb-0">
                    Phương tiện này hiện chưa có vi phạm.
                </main>

            <?php else: ?>

                <main class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">
<thead>
    <tr>
        <th class="bg-dark text-white">Ngày vi phạm</th>
        <th class="bg-dark text-white">Vi phạm</th>
        <th class="bg-dark text-white">Tỉnh/TP</th>
        <th class="bg-dark text-white">Địa điểm</th>
        <th class="bg-dark text-white">Trạng thái</th>
        <th class="bg-dark text-white">Số quyết định</th>
        <th class="bg-dark text-white">Hạn xử lý</th>
    </tr>
</thead>

                        <tbody>

                        <?php foreach ($violations as $v): ?>

                            <tr>

                                <td><?= htmlspecialchars($v['violated_at'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($v['description'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($v['province'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($v['location'] ?? '-') ?></td>

                                <td>

                                    <?php

                                    $status = $v['status'] ?? '';

                                    if ($status == 'processed') {

                                        echo '<span class="badge bg-success">Đã xử lý</span>';

                                    } elseif ($status == 'unprocessed') {

                                        echo '<span class="badge bg-danger">Chưa xử lý</span>';

                                    } else {

                                        echo '<span class="badge bg-secondary">-</span>';

                                    }

                                    ?>

                                </td>

                                <td><?= htmlspecialchars($v['decision_no'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($v['due_date'] ?? '-') ?></td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </main>

            <?php endif; ?>

        </main>

    </main>

<?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>