<?php
session_start();
include 'koneksi.php';
// munculkan atau pilih  sebuah atau semua kolom dari table user
$queryTrans = mysqli_query($koneksi,  "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id=trans_order.id_customer ORDER BY id DESC");
// pake mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $dataUser = mysqli_fetch_assoc($queryUser);
// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
    $id =  $_GET['delete']; // untuk mengambil nilai parameter
    //masukin $query untuk melakukan perintah yg diinginkan
    $delete  = mysqli_query($koneksi, "DELETE FROM trans_order WHERE id = '$id'");
    header("location:trans-order.php?hapus=berhasil");
}

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

    <title>Data Transaksi</title>

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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">Transaksi Laundry</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <div align="right" class="mb-3">
                                            <a href="tambah-trans.php" class="btn btn-primary">Tambah</a>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Invoice</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Laundry</th>
                                                    <th>Status</th>

                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($rowTrans = mysqli_fetch_assoc($queryTrans)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $rowTrans['order_code'] ?></td>
                                                        <td><?php echo $rowTrans['customer_name'] ?></td>
                                                        <td><?php echo $rowTrans['order_date'] ?></td>
                                                        <td>
                                                            <?php
                                                                switch($rowTrans['order_status']) {
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
                                                            <a href="tambah-trans.php?detail=<?php echo $rowTrans['id'] ?>" class="btn btn-primary btn-sm">
                                                                <span class="tf-icon bx bx-show bx-18px"></span>
                                                            </a>
                                                            <a target="_blank" href="print.php?id=<?php echo $rowTrans['id'] ?>" class="btn btn-success btn-sm">
                                                                <span class="tf-icon bx bx-printer bx-18px"></span>
                                                            </a>
                                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                                                href="trans-order.php?delete=<?php echo $rowTrans['id'] ?>" class="btn btn-danger btn-sm">
                                                                <span class="tf-icon bx bx-trash bx-18px"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'inc/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>

                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

               <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/assets/vendor/js/bootstrap.js"></script>
    <script src="assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>