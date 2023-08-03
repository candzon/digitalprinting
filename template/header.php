<?php
require 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

session_start();
error_reporting(0);

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

$level = $_SESSION["level"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem Digital Printing</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">

        <span class="d-none d-lg-block">SIDIPIN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["username"]; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION["username"]; ?></h6>
              <span>
                <?php
                $user = $_SESSION["username"];
                echo $user === "pelanggan" ? "Pelanggan" : ($user === "sales_order" ? "Sales" : ($user === "data_analyst" ? "Analyst" : ($user === "inventory_control" ? "Inventory" : "Finance")));
                ?>
              </span>

            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="javascript: return confirm('Apakah Anda Ingin Keluar?');" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid-3x3-gap-fill"></i><span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->



      <li class="nav-heading">Data Master</li>

      <?php if ($level == "analyst") { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="data-pelanggan.php">
            <i class="bi bi-person-fill"></i><span>Pelanggan</span>
          </a>
        </li><!-- End Pelanggan Nav -->

      <?php }
      if ($level == "inventory" || $level == "pelanggan") { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="data-print.php">
            <i class="bi bi-printer-fill"></i><span>Print</span>
          </a>
        </li><!-- End Pelanggan Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="data-bahan.php">
            <i class="bi bi-collection-fill"></i><span>Bahan</span>
          </a>
        </li><!-- End Pelanggan Nav -->

      <?php } ?>


      <li class="nav-heading">Transaksi</li>

      <?php if ($level == "pelanggan") { ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="pemesanan.php">
            <i class="bi bi-cart-check-fill"></i><span>Pemesanan</span>
          </a>
        </li><!-- End Pemesanan Nav -->

      <?php } ?>

      <li class="nav-heading">Laporan</li>

      <?php if ($level == "analyst") { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="lap-pelanggan.php">
            <i class="ri ri-file-list-2-line"></i><span>Pelanggan</span>
          </a>
        </li><!-- End Pelanggan Nav -->

      <?php }
      if ($level == "inventory") { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="lap-print.php">
            <i class="ri ri-file-list-2-line"></i><span>Print</span>
          </a>
        </li><!-- End Print Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="lap-bahan.php">
            <i class="ri ri-file-list-2-line"></i><span>Bahan</span>
          </a>
        </li><!-- End Bahan Nav -->

      <?php }
      if ($level == "sales" || $level == "finance") { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="lap-pemesanan.php">
            <i class="ri ri-file-list-2-line"></i><span>Pemesanan</span>
          </a>
        </li><!-- End Pemesanan Nav -->
      <?php } ?>
    </ul>

  </aside><!-- End Sidebar-->