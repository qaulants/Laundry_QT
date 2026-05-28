<?php
$host_koneksi = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com";
$username_koneksi = "3geAjnUBSzaUMDi.root";
$password_koneksi = "LDISXMaHdZQT0Lo5";
$database_koneksi = "laundry_db";

// Tambahkan port 4000 di fungsi mysqli_connect karena TiDB tidak pakai port default 3306
$koneksi = mysqli_connect($host_koneksi, $username_koneksi, $password_koneksi, $database_koneksi, 4000);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>