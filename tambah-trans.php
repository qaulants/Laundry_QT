<?php
session_start();
include 'koneksi.php';

$queryCustomer = mysqli_query($koneksi, "SELECT * FROM customer");
$queryPaket = mysqli_query($koneksi, "SELECT * FROM type_of_service");

$rowPaket = [];
while($data = mysqli_fetch_assoc($queryPaket)){
    $rowPaket[] = $data;
}

// jika button simpan ditekan 
if (isset($_POST['simpan'])) {
    $id_level = $_POST['id_level'];
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $insert =  mysqli_query($koneksi, "INSERT INTO user (id_level, name, email, password) VALUES ('$id_level','$nama', '$email', '$password')");
    header("location:user.php?tambah=berhasil");
}

$id  = isset($_GET['edit']) ?  $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $id_level = $_POST['id_level'];
    $nama = $_POST['name'];
    $email = $_POST['email'];

    //jika button edit di klik
    if (isset($_POST['edit'])) {
        $password  = $_POST['password'];
    } else {
        $password  = $rowEdit['password'];
    }
    $update = mysqli_query($koneksi, "UPDATE user SET id_level='$id_level', name='$nama', email='$email', password='$password' WHERE id = '$id'");
    header("location:user.php?ubah=berhasil");
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

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                
                                                <div class="col-sm-12 mb-3">
                                                    <label for="" class="form-label">Pelanggan</label>
                                                    <select name="id_customer" class="form-control" id="">
                                                        <option value="">Pilih Pelanggan</option>
                                                        <?php while($rowCustomer = mysqli_fetch_assoc($queryCustomer)): ?>
                                                        <option value="<?php echo $rowCustomer['id'] ?>">
                                                            <?php echo $rowCustomer['customer_name'] ?>
                                                        </option>
                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">No invoice</label>
                                                    <input type="text" class="form-control" id="" name="trans_code" readonly
                                                    value="#">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Tanggal Laundry</label>
                                                    <input type="date" name="order_date" class="form-control" id="">
                                                </div>
                                               
                                            </div>
                                            

                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">Detail Transaksi</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                
                                                <div class="col-sm-3 mb-4">
                                                    <label for="" class="form-label">Paket</label>
                                                </div>
                                                <div class="col-9 mb-4">
                                                    <select name="id_service[]" class="form-control" id="">
                                                        <option value="">Pilih Paket</option>
                                                        <?php 
                                                            foreach($rowPaket as $key => $value){
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>">
                                                                <?php echo $value['service_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <label for="" class="form-label">Quantity</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" class="form-control" id="" name="qty"
                                                    value="" placeholder="Qty">
                                                </div>
                                               
                                            </div>
                                            <div class="mb-3 row">
                                                
                                                <div class="col-sm-3 mb-4">
                                                    <label for="" class="form-label">Paket</label>
                                                </div>
                                                <div class="col-9 mb-4">
                                                    <select name="id_service[]" class="form-control" id="">
                                                        <option value="">Pilih Paket</option>
                                                        <?php 
                                                            foreach($rowPaket as $key => $value){
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>">
                                                                <?php echo $value['service_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 mb-3">
                                                    <label for="" class="form-label">Quantity</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" class="form-control" id="" name="qty"
                                                    value="" placeholder="Qty">
                                                </div>
                                               
                                            </div>

                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a
                                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4">Documentation</a>

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
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