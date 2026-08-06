<?php

session_start();

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Traffic violation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="index.php">

            Traffic violation

        </a>

        <?php if (isset($_SESSION['admin'])): ?>

            <div class="d-flex align-items-center">

                <span class="text-white me-3">

                    Xin chào,

                    <strong>

                        <?= htmlspecialchars($_SESSION['admin']['username']) ?>

                    </strong>

                </span>

                <a
                    href="admin/dashboard.php"
                    class="btn btn-primary me-2">

                    Dashboard

                </a>

                <a
                    href="admin/logout.php"
                    class="btn btn-danger">

                    Đăng xuất

                </a>

            </div>

        <?php else: ?>

            <a
                href="admin/login.php"
                class="btn btn-warning">

                Đăng nhập Admin

            </a>

        <?php endif; ?>

    </div>

</nav>

<main class="flex-grow-1">

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">

                        <h3 class="text-center mb-0">

                            TRA CỨU PHƯƠNG TIỆN VI PHẠM GIAO THÔNG

                        </h3>

                    </div>

                    <div class="card-body">

                        <form
                            action="search.php"
                            method="GET">

                            <div class="mb-3">

                                <label class="form-label">

                                    Biển số xe

                                </label>

                                <input
                                    type="text"
                                    name="license_plate"
                                    class="form-control form-control-lg"
                                    placeholder="Ví dụ: 30A-123.45"
                                    required>

                            </div>

                            <div class="d-grid">

                                <button
                                    class="btn btn-primary btn-lg">

                                    Tra cứu

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php include 'includes/footer.php'; ?>

</body>

</html>