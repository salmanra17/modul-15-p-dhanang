<?php
include "cek_session.php";

if (!isset($_SESSION['data_siswa'])) {
    $_SESSION['data_siswa'] = [];
}
$data_siswa = $_SESSION['data_siswa'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa Ekstrakurikuler RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c3e50; padding: 12px 30px;
            display: flex; justify-content: space-between; align-items: center; color: white;
        }
        .navbar h1 { font-size: 16px; }
        .navbar .user-info { font-size: 13px; color: #bdc3c7; }
        .navbar a.btn-logout {
            background: #e74c3c; color: white; padding: 7px 16px;
            border-radius: 5px; text-decoration: none; font-size: 13px; margin-left: 15px;
        }
        .navbar a.btn-logout:hover { background: #c0392b; }
        .container { padding: 30px; }
        h2 { color: #2c3e50; margin-bottom: 16px; font-size: 20px; }
        .btn-tambah {
            display: inline-block; background: #27ae60; color: white;
            padding: 9px 18px; border-radius: 5px; text-decoration: none;
            font-size: 13px; margin-bottom: 18px;
        }
        table {
            width: 100%; border-collapse: collapse; background: white;
            border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }
        thead tr { background: #2c3e50; color: white; }
        th, td { padding: 11px 13px; text-align: left; font-size: 13px; }
        tbody tr:nth-child(even) { background: #f9f9f9; }
        tbody tr:hover { background: #eaf4fb; }
        .action a {
            margin-right: 6px; font-size: 12px; padding: 4px 10px;
            border-radius: 4px; text-decoration: none; color: white;
        }
        .btn-detail { background: #3498db; }
        .btn-edit   { background: #f39c12; }
        .btn-hapus  { background: #e74c3c; }
        .total { margin-bottom: 10px; color: #555; font-size: 13px; }
        .empty { text-align: center; padding: 30px; color: #aaa; font-size: 14px; }
    </style>
</head>
<body>
<div class="navbar">
    <h1>📚 Sistem Data Siswa Ekstrakurikuler RPL</h1>
    <div style="display:flex; align-items:center;">
        <span class="user-info">
            Login sebagai: <strong><?php echo htmlspecialchars($_SESSION['namauser']); ?></strong>
            &nbsp;|&nbsp; <?php echo $_SESSION['waktu_login']; ?>
        </span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <h2>Data Siswa Ekstrakurikuler</h2>
    <a href="formulir.php" class="btn-tambah">+ Daftar Baru</a>
    <p class="total">Total Data: <strong><?php echo count($data_siswa); ?> siswa</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th>
                <th>Tgl Lahir</th><th>Kota</th><th>JK</th>
                <th>Hobby</th><th>Ekskul</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data_siswa)): ?>
                <tr><td colspan="10" class="empty">Belum ada data. Klik "+ Daftar Baru" untuk menambah.</td></tr>
            <?php else: $no = 1; foreach ($data_siswa as $nis => $s): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($nis); ?></td>
                    <td><?php echo htmlspecialchars($s['nama']); ?></td>
                    <td><?php echo htmlspecialchars($s['kelas']); ?></td>
                    <td><?php echo htmlspecialchars($s['tgl_lahir']); ?></td>
                    <td><?php echo htmlspecialchars($s['kota']); ?></td>
                    <td><?php echo $s['jenis_kelamin']=='L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                    <td><?php echo htmlspecialchars($s['hobby']); ?></td>
                    <td><?php echo htmlspecialchars($s['ekskul']); ?></td>
                    <td class="action">
                        <a href="detail.php?nis=<?php echo urlencode($nis); ?>" class="btn-detail">Detail</a>
                        <a href="form_update.php?nis=<?php echo urlencode($nis); ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?nis=<?php echo urlencode($nis); ?>" class="btn-hapus"
                           onclick="return confirm('Yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>