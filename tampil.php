<?php
include "cek_session.php"; // Wajib login dulu
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa Ekstrakurikuler RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }

        /* Navbar */
        .navbar {
            background: #2c3e50;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .navbar h1 { font-size: 16px; }
        .navbar .user-info { font-size: 13px; color: #bdc3c7; }
        .navbar a.btn-logout {
            background: #e74c3c;
            color: white;
            padding: 7px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            margin-left: 15px;
            transition: background 0.3s;
        }
        .navbar a.btn-logout:hover { background: #c0392b; }

        /* Content */
        .container { padding: 30px; }
        h2 { color: #2c3e50; margin-bottom: 16px; font-size: 20px; }

        .btn-tambah {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 9px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 18px;
            transition: background 0.3s;
        }
        .btn-tambah:hover { background: #1e8449; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }
        thead tr { background: #2c3e50; color: white; }
        th, td { padding: 12px 15px; text-align: left; font-size: 13px; }
        tbody tr:nth-child(even) { background: #f9f9f9; }
        tbody tr:hover { background: #eaf4fb; }

        .action a {
            margin-right: 8px;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }
        .btn-detail { background: #3498db; }
        .btn-edit   { background: #f39c12; }
        .btn-hapus  { background: #e74c3c; }

        .total { margin-bottom: 10px; color: #555; font-size: 13px; }
    </style>
</head>
<body>

<!-- Navbar -->
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

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM siswa");
    $total = mysqli_num_rows($query);
    ?>
    <p class="total">Total Data: <strong><?php echo $total; ?> siswa</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tgl Lahir</th>
                <th>Kota</th>
                <th>JK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)):
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nis']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                <td><?php echo htmlspecialchars($row['tgl_lahir']); ?></td>
                <td><?php echo htmlspecialchars($row['kota']); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                <td class="action">
                    <a href="detail.php?nis=<?php echo $row['nis']; ?>" class="btn-detail">Detail</a>
                    <a href="form_update.php?nis=<?php echo $row['nis']; ?>" class="btn-edit">Edit</a>
                    <a href="delete.php?nis=<?php echo $row['nis']; ?>" class="btn-hapus"
                       onclick="return confirm('Yakin mau hapus?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>