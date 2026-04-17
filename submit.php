<?php
session_start();

// Daftar user valid (tanpa database, sesuai modul 15)
$users = [
    'admin'  => 'admin123',
    'salma'  => 'salma123',
    'guru'   => 'guru123',
];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada dan password cocok
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        // Login berhasil — simpan session
        $_SESSION['namauser'] = $username;
        $_SESSION['waktu_login'] = date('d-m-Y H:i:s');

        // Redirect ke halaman biodata siswa
        header("Location: tampil.php");
        exit;
    } else {
        // Login gagal — redirect kembali ke login dengan pesan error
        header("Location: login.php?error=1");
        exit;
    }
} else {
    // Akses langsung tanpa POST — redirect ke login
    header("Location: login.php");
    exit;
}
?>