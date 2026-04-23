<?php
session_start();

// Jika sudah login, langsung redirect ke tampil.php
if (isset($_SESSION['namauser'])) {
    header("Location: tampil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Data Siswa RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 380px;
        }
        .login-box h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 22px;
        }
        .login-box p.subtitle {
            text-align: center;
            color: #888;
            font-size: 13px;
            margin-bottom: 28px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
        }
        .form-group input:focus {
            border-color: #3498db;
        }
        .btn-login {
            width: 100%;
            padding: 11px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 6px;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #2980b9;
        }
        .alert-error {
            background: #fdecea;
            color: #c0392b;
            border: 1px solid #e74c3c;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .info-box {
            margin-top: 20px;
            background: #eaf4fb;
            border: 1px solid #aed6f1;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: 12px;
            color: #2471a3;
        }
        .info-box strong { display: block; margin-bottom: 4px; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>🔐 Login</h2>
    <p class="subtitle">Sistem Data Siswa Ekstrakurikuler RPL</p>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert-error">
            ❌ Username atau password salah. Silakan coba lagi.
        </div>
    <?php endif; ?>

    <form method="POST" action="submit.php">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <input type="submit" name="submit" value="Login" class="btn-login">
    </form>

</div>
</body>
</html>