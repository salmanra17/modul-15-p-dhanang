<?php
include "cek_session.php";
include "koneksi.php";

$pesan = "";

if (isset($_POST['kirim'])) {
    $nis            = $_POST['nis'];
    $nama           = $_POST['nama'];
    $kelas          = $_POST['kelas'];
    $tgl_lahir      = $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];
    $alamat         = $_POST['alamat'];
    $kota           = $_POST['kota'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $hobby          = implode(', ', $_POST['hobby'] ?? []);
    $ekskul         = implode(', ', $_POST['ekskul'] ?? []);

    $sql = "INSERT INTO siswa (nis, nama, kelas, tgl_lahir, alamat, kota, jenis_kelamin, hobby, ekskul)
            VALUES ('$nis','$nama','$kelas','$tgl_lahir','$alamat','$kota','$jenis_kelamin','$hobby','$ekskul')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: tampil.php");
        exit;
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Siswa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c3e50; padding: 12px 30px;
            display: flex; justify-content: space-between; align-items: center; color: white;
        }
        .navbar a { color: #aed6f1; text-decoration: none; font-size: 13px; }
        .container { padding: 30px; display: flex; justify-content: center; }
        .form-card {
            background: white; padding: 35px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); width: 500px;
        }
        h2 { color: #2c3e50; text-align: center; margin-bottom: 24px; font-size: 18px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 5px; font-weight: bold; }
        input[type=text], input[type=number], select, textarea {
            width: 100%; padding: 9px 12px; border: 1px solid #ddd;
            border-radius: 5px; font-size: 13px; outline: none;
        }
        input:focus, select:focus, textarea:focus { border-color: #3498db; }
        .row { display: flex; gap: 8px; }
        .row select { flex: 1; }
        .check-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px; }
        .check-group label { font-weight: normal; display: flex; align-items: center; gap: 5px; cursor: pointer; }
        select[multiple] { height: 100px; }
        .btn-row { display: flex; gap: 10px; margin-top: 20px; }
        .btn-kirim {
            flex: 1; padding: 10px; background: #3498db; color: white;
            border: none; border-radius: 5px; font-size: 14px; cursor: pointer;
        }
        .btn-kirim:hover { background: #2980b9; }
        .btn-batal {
            flex: 1; padding: 10px; background: #95a5a6; color: white;
            border: none; border-radius: 5px; font-size: 14px; cursor: pointer; text-align: center;
            text-decoration: none; display: flex; align-items: center; justify-content: center;
        }
        .alert { background: #fdecea; color: #c0392b; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px; }
    </style>
</head>
<body>
<div class="navbar">
    <span>📝 Form Pendaftaran Siswa</span>
    <a href="tampil.php">← Kembali ke Daftar</a>
</div>
<div class="container">
    <div class="form-card">
        <h2>Pendaftaran Ekstrakurikuler</h2>

        <?php if ($pesan): ?>
            <div class="alert"><?php echo $pesan; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>NIS</label>
                <input type="text" name="nis" placeholder="Nomor Induk Siswa" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama lengkap" required>
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tgl Lahir</label>
                <div class="row">
                    <select name="tanggal">
                        <?php for ($i=1; $i<=31; $i++) echo "<option value='" . str_pad($i,2,'0',STR_PAD_LEFT) . "'>$i</option>"; ?>
                    </select>
                    <select name="bulan">
                        <?php
                        $bulan = ['Januari','Februari','Maret','April','Mei','Juni',
                                  'Juli','Agustus','September','Oktober','November','Desember'];
                        foreach ($bulan as $k => $b) {
                            $val = str_pad($k+1, 2, '0', STR_PAD_LEFT);
                            echo "<option value='$val'>$b</option>";
                        }
                        ?>
                    </select>
                    <select name="tahun">
                        <?php for ($i=2010; $i>=2000; $i--) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="2" placeholder="Alamat lengkap"></textarea>
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" name="kota" placeholder="Kota">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="check-group">
                    <label><input type="radio" name="jenis_kelamin" value="L"> Laki-Laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="P"> Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label>Hobby</label>
                <div class="check-group">
                    <?php
                    $hobbies = ['Membaca','Olahraga','Menyanyi','Menari','Travelling'];
                    foreach ($hobbies as $h):
                    ?>
                    <label><input type="checkbox" name="hobby[]" value="<?php echo $h; ?>"> <?php echo $h; ?></label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan Ekskul</label>
                <select name="ekskul[]" multiple>
                    <?php
                    $ekskuls = ['Pramuka','Basket','Voli','Band','Seni Tari','PMR','Rohis','Badminton'];
                    foreach ($ekskuls as $e) echo "<option value='$e'>$e</option>";
                    ?>
                </select>
                <small style="color:#888;">Ctrl+klik untuk pilih lebih dari satu</small>
            </div>
            <div class="btn-row">
                <button type="submit" name="kirim" class="btn-kirim">Kirim</button>
                <a href="tampil.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>