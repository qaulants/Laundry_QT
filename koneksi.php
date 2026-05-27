<?php
$host_koneksi = "localhost";
$username_koneksi = "root";
$password_koneksi = "";
$database_koneksi = "angkatan3_laundry";

$koneksi = mysqli_connect($host_koneksi, $username_koneksi, $password_koneksi,  $database_koneksi);

if (!$koneksi) {
    echo "Koneksi Gagal";
}

// $host_koneksi = "sql304.infinityfree.com";
// $username_koneksi = "if0_42013691";
// $password_koneksi = "WKmuIDdJXPZM";
// $database_koneksi = "if0_42013691_angkatan3_laundry";

// $koneksi = mysqli_connect($host_koneksi, $username_koneksi, $password_koneksi,  $database_koneksi);

// if (!$koneksi) {
//     die("Koneksi Gagal: " . mysqli_connect_error());
// }