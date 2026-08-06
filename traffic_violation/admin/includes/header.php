<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Traffic Violation Admin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        html,
        body{
            height:100%;
        }

        body{
            min-height:100vh;
            display:flex;
            flex-direction:column;
            background:#f4f6f9;
            font-family:'Inter',sans-serif;
            color:#212529;
        }

        main{
            flex:1;
        }

        /* ===== Tiêu đề ===== */

        .page-title{
            font-size:30px;
            font-weight:700;
            color:#1f2937;
            margin-bottom:30px;
        }

        /* ===== Card ===== */

        .card{
            border:none;
            border-radius:16px;
            box-shadow:0 8px 24px rgba(0,0,0,.08);
            overflow:hidden;
        }

        .card-header{
            background:#ffffff;
            border-bottom:1px solid #e9ecef;
            font-weight:600;
        }

        .card-body{
            padding:25px;
        }

        /* ===== Button ===== */

        .btn{
            border-radius:10px;
            font-weight:600;
            transition:.2s;
        }

        .btn-primary{
            background:#2563eb;
            border:none;
        }

        .btn-primary:hover{
            background:#1d4ed8;
        }

        .btn-success{
            border:none;
        }

        .btn-danger{
            border:none;
        }

        .btn-warning{
            border:none;
        }

        /* ===== Input ===== */

        .form-control,
        .form-select{

            border-radius:10px;
            min-height:46px;
            border:1px solid #dcdfe4;

        }

        .form-control:focus,
        .form-select:focus{

            border-color:#2563eb;
            box-shadow:0 0 0 .15rem rgba(37,99,235,.15);

        }

        /* ===== Table ===== */

        .table{

            margin-bottom:0;

        }

        .table thead{

            background:#1f2937;
            color:#ffffff;

        }

        .table th{

            text-align:center;
            vertical-align:middle;
            font-weight:600;
            padding:14px;

        }

        .table td{

            vertical-align:middle;
            padding:14px;

        }

        .table tbody tr:hover{

            background:#f8fafc;

        }

        /* ===== Badge ===== */

        .badge{

            border-radius:8px;
            padding:8px 12px;
            font-size:.85rem;

        }

        /* ===== Link ===== */

        a{

            text-decoration:none;

        }
/* ===== Navbar ===== */

.navbar{

    background:#1f2937 !important;
    padding:14px 0;
    box-shadow:0 2px 12px rgba(0,0,0,.08);

}

.navbar-brand{

    font-size:1.2rem;
    font-weight:700;
    letter-spacing:.3px;

}

.navbar .nav-link{

    color:rgba(255,255,255,.85) !important;
    font-weight:500;
    transition:.2s;

}

.navbar .nav-link:hover{

    color:#ffffff !important;

}

.navbar .nav-link.active{

    color:#ffffff !important;
    font-weight:600;

}

.navbar .btn{

    padding:8px 18px;

}

.navbar .btn-outline-light{

    border-width:2px;

}
    </style>

</head>

<body>