<?php

require '../includes/auth.php';
require '../../config/database.php';

$error = "";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];



$sql = "SELECT id, license_plate
        FROM vehicles
        ORDER BY license_plate";

$stmt = $conn->query($sql);

$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT *
        FROM violations
        WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$violation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$violation) {
    header("Location: index.php");
    exit;
}



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

        $error = "Vui lòng nhập đầy đủ thông tin.";

    } else {

        $sql = "UPDATE violations
                SET
                    vehicle_id = :vehicle_id,
                    description = :description,
                    violated_at = :violated_at,
                    status = :status,
                    decision_no = :decision_no,
                    due_date = :due_date,
                    province = :province,
                    location = :location
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([

            ":vehicle_id" => $vehicle_id,
            ":description" => $description,
            ":violated_at" => $violated_at,
            ":status" => $status,
            ":decision_no" => $decision_no,
            ":due_date" => !empty($due_date) ? $due_date : null,
            ":province" => $province,
            ":location" => $location,
            ":id" => $id

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

        <h2>Sửa vi phạm</h2>

        <a href="index.php" class="btn btn-secondary">

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

                        <?php foreach ($vehicles as $vehicle): ?>

                            <option
                                value="<?= $vehicle['id'] ?>"
                                <?= $vehicle['id'] == $violation['vehicle_id'] ? 'selected' : '' ?>>

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
                        required><?= htmlspecialchars($violation['description']) ?></textarea>

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
                            value="<?= $violation['violated_at'] ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Trạng thái

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="unprocessed"
                                <?= $violation['status'] == 'unprocessed' ? 'selected' : '' ?>>

                                Chưa xử lý

                            </option>

                            <option
                                value="processed"
                                <?= $violation['status'] == 'processed' ? 'selected' : '' ?>>

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
                        class="form-control"
                        value="<?= htmlspecialchars($violation['province']) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Địa điểm

                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control"
                        value="<?= htmlspecialchars($violation['location']) ?>">

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Số quyết định

                        </label>

                        <input
                            type="text"
                            name="decision_no"
                            class="form-control"
                            value="<?= htmlspecialchars($violation['decision_no']) ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Hạn xử lý

                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control"
                            value="<?= $violation['due_date'] ?>">

                    </div>

                </div>

                <button class="btn btn-warning">

                    Cập nhật

                </button>

            </form>

        </div>

    </div>

</main>

<?php

include '../includes/footer.php';

?>