<?php

require 'includes/auth.php';
require '../config/database.php';

include 'includes/header.php';
include 'includes/navbar.php';

$totalVehicles = $conn->query("
    SELECT COUNT(*)
    FROM vehicles
")->fetchColumn();

$totalViolations = $conn->query("
    SELECT COUNT(*)
    FROM violations
")->fetchColumn();

$processed = $conn->query("
    SELECT COUNT(*)
    FROM violations
    WHERE status = 'processed'
")->fetchColumn();

$unprocessed = $conn->query("
    SELECT COUNT(*)
    FROM violations
    WHERE status = 'unprocessed'
")->fetchColumn();

?>

<main class="container py-4">

    <div class="mb-4">

        <h2 class="page-title mb-1">

            Dashboard

        </h2>

        <p class="text-muted mb-0">

            Tổng quan hệ thống tra cứu vi phạm giao thông.

        </p>

    </div>

    <div class="row g-4">

        <div class="col-lg-3 col-md-6">

            <div class="card h-100">

                <div class="card-body text-center">

                    <small class="text-muted text-uppercase">

                        Tổng phương tiện

                    </small>

                    <h1 class="fw-bold text-primary mt-3">

                        <?= $totalVehicles ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card h-100">

                <div class="card-body text-center">

                    <small class="text-muted text-uppercase">

                        Tổng vi phạm

                    </small>

                    <h1 class="fw-bold text-primary mt-3">

                        <?= $totalViolations ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card h-100">

                <div class="card-body text-center">

                    <small class="text-muted text-uppercase">

                        Đã xử lý

                    </small>

                    <h1 class="fw-bold text-primary mt-3">

                        <?= $processed ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card h-100">

                <div class="card-body text-center">

                    <small class="text-muted text-uppercase">

                        Chưa xử lý

                    </small>

                    <h1 class="fw-bold text-primary mt-3">

                        <?= $unprocessed ?>

                    </h1>

                </div>

            </div>

        </div>

    </div>

    <div class="card mt-5">

        <div class="card-header">

            <strong>

                Chức năng quản trị

            </strong>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <a
                        href="vehicles/index.php"
                        class="btn btn-primary w-100 py-3">

                        Quản lý phương tiện

                    </a>

                </div>

                <div class="col-md-4">

                    <a
                        href="violations/index.php"
                        class="btn btn-primary w-100 py-3">

                        Quản lý vi phạm

                    </a>

                </div>

                <div class="col-md-4">

                    <a
                        href="../index.php"
                        class="btn btn-outline-secondary w-100 py-3">

                        Trang tra cứu

                    </a>

                </div>

            </div>

        </div>

    </div>

</main>

<?php

include 'includes/footer.php';

?>