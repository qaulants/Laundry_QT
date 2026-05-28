<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'koneksi.php';

// User
$id = $_SESSION['id'];

// Total transaksi hari ini
$queryTotalTrans = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM trans_order WHERE DATE(order_date) = CURDATE()");
$totalTrans = mysqli_fetch_assoc($queryTotalTrans)['total'];

// Total transaksi keseluruhan
$querySemuaTrans = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM trans_order;");
$semuaTrans = mysqli_fetch_assoc($querySemuaTrans)['total'];

// Total customer
$queryCustomer = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM customer");
$totalCustomer = mysqli_fetch_assoc($queryCustomer)['total'];

// 5 Transaksi terbaru
$queryTerbaru = mysqli_query($koneksi, "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id = trans_order.id_customer ORDER BY trans_order.id DESC LIMIT 5");

?>

<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="description" content="" />

    <?php include 'inc/head.php'; ?>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'inc/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'inc/nav.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    Selamat Datang Kembali, <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : '' ?>👋
                                </h5>
                                <p class="mb-0 text-mutted">
                                    <?php echo date('l, d F Y'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Start Cards -->
                        <div class="row g-4 mb-4">
                            <!-- Transaksi Hari Ini -->
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-primary">
                                                <i class="bx bx-receipt"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Transaksi Hari Ini</p>
                                            <h4 class="mb-0 fw-bold"><?php echo $totalTrans; ?></h4>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Total Semua Transaksi -->
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-warning">
                                                <i class="bx bx-list-ul"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Total Semua Transaksi</p>
                                            <h4 class="mb-0 fw-bold"><?php echo $semuaTrans; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Customer -->
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-success">
                                                <i class="bx bx-group"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Total Customer</p>
                                            <h4 class="mb-0 fw-bold"><?php echo $totalCustomer; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- Tabel Transaksi Terbaru -->
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Transaksi Terbaru</h5>
                                        <a href="trans-order.php" class="btn btn-primary">
                                            Lihat Semua
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No Invoice</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($queryTerbaru)): ?>
                                                        <tr>
                                                            <td><?php echo $row['order_code']; ?></td>
                                                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                                            <td><?php echo $row['order_date']; ?></td>
                                                            <td>
                                                                <?php
                                                                switch ($row['order_status']) {
                                                                    case '1':
                                                                        $badge = "<span class='badge bg-success'>Sudah dikembalikan</span>";
                                                                        break;
                                                                    default:
                                                                        $badge = "<span class='badge bg-warning'>Baru</span>";
                                                                        break;
                                                                }
                                                                echo $badge;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="tambah-trans.php?detail=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                                                    <span class="tf-icon bx bx-show bx-18px"></span>
                                                                </a>
                                                                <a href="print.php?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-success btn-sm">
                                                                    <span class="tf-icon bx bx-printer bx-18px"></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>

                                                    <?php if ($semuaTrans === 0): ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted py-3">
                                                                Belum ada transaksi
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'inc/footer.php' ?>
                    <!-- / Footer -->

                    <div class=" content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php include 'inc/js.php' ?>
</body>

</html>