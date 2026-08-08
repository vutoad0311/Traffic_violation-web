<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold" href="/admin/dashboard.php">

            Traffic Violation Admin

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarAdmin">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="/admin/dashboard.php">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="/admin/vehicles/index.php">

                        Phương tiện

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="/admin/violations/index.php">

                        Vi phạm

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link px-3"
                        href="/index.php">

                        Trang tra cứu

                    </a>

                </li>

            </ul>

            <div class="d-flex align-items-center">

                <span class="navbar-text text-white me-3">

                    Xin chào,

                    <strong>

                        <?= htmlspecialchars($_SESSION['admin']['username']) ?>

                    </strong>

                </span>

                <a
                    href="/admin/logout.php"
                    class="btn btn-outline-light">

                    Đăng xuất

                </a>

            </div>

        </div>

    </div>

</nav>