<?php
session_start();

if (!isset($_SESSION['namauser'])) {
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <title>Akses Ditolak</title>
        <style>
            body { font-family: Arial; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f0f2f5; }
            .box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
            h2 { color: #e74c3c; }
            p { color: #555; margin: 10px 0; }
            a { color: #3498db; text-decoration: none; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>🚫 Anda Belum Login</h2>
            <p>Halaman ini hanya bisa diakses setelah login.</p>
            <p><a href='login.php'>← Kembali ke Halaman Login</a></p>
        </div>
    </body>
    </html>";
    exit;
}
?>