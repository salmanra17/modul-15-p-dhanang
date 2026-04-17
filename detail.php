<?php
include "cek_session.php";
include "koneksi.php";

$nis = $_GET['nis'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .navbar {
            background: #2c3e50;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar a {
            color: #aed6f1;
            text-decoration: none;
            font-size: 13px;
        }

        .container {
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 480px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }

        td:first-child {
            color: #777;
            width: 140px;
            font-weight: bold;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            background: #95a5a6;
            color: white;
            padding: 8px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <span>🔍 Detail Siswa</span>
        <a href="tampil.php">← Kembali ke Daftar</a>
    </div>
    <div class="container">
        <div class="card">
            <h2>Detail Siswa</h2>
            <?php if ($data): ?>
                <table>
                    <tr>
                        <td>NIS</td>
                        <td><?php echo htmlspecialchars($data['nis']); ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td><?php echo htmlspecialchars($data['kelas']); ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><?php echo htmlspecialchars($data['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td><?php echo htmlspecialchars($data['kota']); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?php echo $data['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                    </tr>
                    <tr>
                        <td>Hobby</td>
                        <td><?php echo htmlspecialchars($data['hobby']); ?></td>
                    </tr>
                    <tr>
                        <td>Pilihan Ekskul</td>
                        <td><?php echo htmlspecialchars($data['ekskul']); ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p style="color:#e74c3c;">Data tidak ditemukan.</p>
            <?php endif; ?>
            <a href="tampil.php" class="btn-back">← Kembali</a>
        </div>
    </div>
</body>

</html>