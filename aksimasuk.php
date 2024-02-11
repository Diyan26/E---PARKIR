<?php
include 'koneksi.php';

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noPlat = $_POST['NoPlat'];
    $waktuMasuk = $_POST['WaktuMasuk'];
    $merek = $_POST['merek'];

    // Array untuk menyimpan nama-nama file yang diupload
    $keteranganArray = [];

    // Direktori upload
    $uploadDir = 'img/';

    // Pastikan direktori upload ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Periksa apakah input file diatur dan tidak ada kesalahan
    if (isset($_FILES['keterangan']) && is_array($_FILES['keterangan']['name'])) {
        // Loop melalui setiap file
        for ($i = 0; $i < count($_FILES['keterangan']['name']); $i++) {
            $uploadFile = $uploadDir . basename($_FILES['keterangan']['name'][$i]);

            if (move_uploaded_file($_FILES['keterangan']['tmp_name'][$i], $uploadFile)) {
                $keteranganArray[] = $uploadFile;
            } else {
                echo 'Error uploading file ' . $i . ': ' . $_FILES['keterangan']['error'][$i];
                exit; // Hentikan eksekusi jika pengunggahan file gagal
            }
        }
    }

    // Periksa apakah ada file yang diunggah
    if (empty($keteranganArray)) {
        echo 'No files uploaded.';
        exit;
    }

    // Ubah array menjadi string yang dipisahkan koma
    $keterangan = implode(',', $keteranganArray);

    // Masukkan data ke dalam database dengan INSERT IGNORE
    $insertQuery = "INSERT IGNORE INTO terparkir (NoPlat, WaktuMasuk, Merek, Keterangan) VALUES ('$noPlat', '$waktuMasuk', '$merek', '$keterangan')";

    // Eksekusi query insert
    if (mysqli_query($koneksi, $insertQuery)) {
        header('Location: masuk.php');
        exit;
    } else {
        echo "Error inserting data: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode permintaan tidak valid.";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
