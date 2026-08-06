<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="index.php">

            Traffic Violation Lookup System

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarMain">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="index.php">

                        Trang chủ

                    </a>

                </li>

            </ul>

            <?php if (isset($_SESSION['admin'])): ?>

                <span class="navbar-text text-white me-3">

                    Xin chào,

                    <strong>

                        <?= htmlspecialchars($_SESSION['admin']['username']) ?>

                    </strong>

                </span>

                <a
                    href="admin/dashboard.php"
                    class="btn btn-outline-light me-2">

                    Dashboard

                </a>

                <a
                    href="admin/logout.php"
                    class="btn btn-danger">

                    Đăng xuất

                </a>

            <?php else: ?>

                <a
                    href="admin/login.php"
                    class="btn btn-outline-light">

                    Đăng nhập Admin

                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>