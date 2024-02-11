<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query SQL untuk mencari data pengguna berdasarkan username dan password
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = query($query);

    // Periksa apakah ada baris yang sesuai dengan hasil query
    if ($result->num_rows > 0) {
        // Login berhasil, arahkan ke halaman index.php
        header("Location: dashboard.php");
        exit();
    } else {
        // Login gagal, simpan pesan gagal ke dalam variabel session
        session_start();
        $_SESSION['login_error'] = "Login gagal! Silakan coba lagi.";
        header("Location: login.php");
        exit();
    }
}
?>
