<?php

require '../includes/auth.php';
require '../../config/database.php';

$error = "";
$success = "";


$sql = "SELECT id, license_plate
        FROM vehicles
        ORDER BY license_plate";

$stmt = $conn->query($sql);

$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicle_id = $_POST["vehicle_id"];
    $description = trim($_POST["description"]);
    $violated_at = $_POST["violated_at"];
    $province = trim($_POST["province"]);
    $location = trim($_POST["location"]);
    $decision_no = trim($_POST["decision_no"]);
    $due_date = $_POST["due_date"];
    $status = $_POST["status"];

    if (
        empty($vehicle_id) ||
        empty($description) ||
        empty($violated_at)
    ) {

        $error = "Vui lòng nhập đầy đủ thông tin bắt buộc.";

    } else {

        $sql = "INSERT INTO violations
                (
                    vehicle_id,
                    description,
                    violated_at,
                    status,
                    decision_no,
                    due_date,
                    province,
                    location
                )
                VALUES
                (
                    :vehicle_id,
                    :description,
                    :violated_at,
                    :status,
                    :decision_no,
                    :due_date,
                    :province,
                    :location
                )";

        $stmt = $conn->prepare($sql);

        $stmt->execute([

            ":vehicle_id" => $vehicle_id,
            ":description" => $description,
            ":violated_at" => $violated_at,
            ":status" => $status,
            ":decision_no" => $decision_no,
            ":due_date" => !empty($due_date) ? $due_date : null,
            ":province" => $province,
            ":location" => $location

        ]);

        header("Location: index.php");

        exit;

    }

}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<main class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Thêm vi phạm

        </h2>

        <a href="index.php"
           class="btn btn-secondary">

            Quay lại

        </a>

    </div>

    <?php if ($error != ""): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">

                        Phương tiện

                    </label>

                    <select
                        name="vehicle_id"
                        class="form-select"
                        required>

                        <option value="">

                            -- Chọn phương tiện --

                        </option>

                        <?php foreach ($vehicles as $vehicle): ?>

                            <option
                                value="<?= $vehicle['id'] ?>">

                                <?= htmlspecialchars($vehicle['license_plate']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Nội dung vi phạm

                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"
                        required></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Ngày vi phạm

                        </label>

                        <input
                            type="date"
                            name="violated_at"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Trạng thái

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="unprocessed">

                                Chưa xử lý

                            </option>

                            <option value="processed">

                                Đã xử lý

                            </option>

                        </select>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Tỉnh / Thành phố

                    </label>

                    <input
                        type="text"
                        name="province"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Địa điểm

                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control">

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Số quyết định

                        </label>

                        <input
                            type="text"
                            name="decision_no"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Hạn xử lý

                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control">

                    </div>

                </div>

                <button
                    class="btn btn-success">

                    Lưu vi phạm

                </button>

            </form>

        </div>

    </div>

</main>

<?php

include '../includes/footer.php';

?>