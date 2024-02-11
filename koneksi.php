<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_parkiran";

$koneksi = new mysqli($servername, $username, $password, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
// Fungsi untuk menjalankan query SQL
function query($sql) {
    global $koneksi;
    $result = $koneksi->query($sql);
    return $result;
}
?>
