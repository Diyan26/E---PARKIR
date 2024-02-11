<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nomor plat dari formulir
    $license_plate_out = $_POST["license_plate_out"];

    // Query untuk mengambil data kendaraan berdasarkan nomor plat
    $sql = "SELECT * FROM terparkir WHERE NoPlat = '$license_plate_out'";
    $result = query($sql);

    // Jika data ditemukan
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WaktuMasuk = $row["WaktuMasuk"];
        // Anda dapat menambahkan data lain yang ingin Anda tampilkan di sini
    } else {
        // Jika data tidak ditemukan, Anda dapat menampilkan pesan atau melakukan tindakan lain
        echo "Data kendaraan tidak ditemukan";
    }
}
?>
