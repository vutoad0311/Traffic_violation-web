<?php

session_start();

require '../config/database.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM admins WHERE username = :username LIMIT 1";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':username' => $username
    ]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password_hash'])) {

        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'username' => $admin['username']
        ];

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Sai tài khoản hoặc mật khẩu.";

    }

}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">Đăng nhập Admin</h4>

                </div>

                <div class="card-body">

                    <?php if ($error != ""): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">Tên đăng nhập</label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Mật khẩu</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button class="btn btn-primary w-100">

                            Đăng nhập

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>