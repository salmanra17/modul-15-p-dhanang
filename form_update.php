<?php
include "cek_session.php";

$nis = urldecode($_GET['nis']);
$s   = $_SESSION['data_siswa'][$nis] ?? null;

if (isset($_POST['simpan'])) {
    $tgl_lahir = $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];
    $hobby     = implode(', ', $_POST['hobby']  ?? []);
    $ekskul    = implode(', ', $_POST['ekskul'] ?? []);

    $_SESSION['data_siswa'][$nis] = [
        'nama'          => $_POST['nama'],
        'kelas'         => $_POST['kelas'],
        'tgl_lahir'     => $tgl_lahir,
        'alamat'        => $_POST['alamat'],
        'kota'          => $_POST['kota'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'hobby'         => $hobby,
        'ekskul'        => $ekskul,
    ];

    header("Location: tampil.php");
    exit;
}

$tgl          = explode('-', $s['tgl_lahir'] ?? '2009-01-01');
$hobbiesCheck = explode(', ', $s['hobby']  ?? '');
$ekskulsCheck = explode(', ', $s['ekskul'] ?? '');
$hobbies      = ['Membaca','Olahraga','Menyanyi','Menari','Travelling'];
$ekskuls      = ['Pramuka','Basket','Voli','Band','Seni Tari','PMR','Rohis','Badminton'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
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
        input[type=text], select, textarea {
            width: 100%; padding: 9px 12px; border: 1px solid #ddd;
            border-radius: 5px; font-size: 13px; outline: none;
        }
        .row { display: flex; gap: 8px; }
        .row select { flex: 1; }
        .check-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px; }
        .check-group label { font-weight: normal; display: flex; align-items: center; gap: 5px; }
        select[multiple] { height: 100px; }
        .btn-row { display: flex; gap: 10px; margin-top: 20px; }
        .btn-simpan {
            flex: 1; padding: 10px; background: #f39c12; color: white;
            border: none; border-radius: 5px; font-size: 14px; cursor: pointer;
        }
        .btn-batal {
            flex: 1; padding: 10px; background: #95a5a6; color: white;
            border-radius: 5px; font-size: 14px; text-decoration: none;
            display: flex; align-items: center; justify-content: center;
        }
        .nis-display { background: #f4f6f7; padding: 9px 12px; border-radius: 5px; font-size: 13px; color: #555; }
    </style>
</head>
<body>
<div class="navbar">
    <span>✏️ Edit Data Siswa</span>
    <a href="tampil.php">← Kembali ke Daftar</a>
</div>
<div class="container">
    <div class="form-card">
        <h2>Edit Data Siswa</h2>
        <form method="POST">
            <div class="form-group">
                <label>NIS</label>
                <div class="nis-display"><?php echo htmlspecialchars($nis); ?></div>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($s['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas">
                    <?php foreach(['X','XI','XII'] as $k): ?>
                    <option value="<?php echo $k; ?>" <?php if($s['kelas']==$k) echo 'selected'; ?>><?php echo $k; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tgl Lahir</label>
                <div class="row">
                    <select name="tanggal">
                        <?php for($i=1;$i<=31;$i++){$v=str_pad($i,2,'0',STR_PAD_LEFT);$sel=($v==$tgl[2])?'selected':'';echo "<option value='$v' $sel>$i</option>";} ?>
                    </select>
                    <select name="bulan">
                        <?php $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        foreach($bulan as $k=>$b){$v=str_pad($k+1,2,'0',STR_PAD_LEFT);$sel=($v==$tgl[1])?'selected':'';echo "<option value='$v' $sel>$b</option>";} ?>
                    </select>
                    <select name="tahun">
                        <?php for($i=2010;$i>=2000;$i--){$sel=($i==$tgl[0])?'selected':'';echo "<option value='$i' $sel>$i</option>";} ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="2"><?php echo htmlspecialchars($s['alamat']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" name="kota" value="<?php echo htmlspecialchars($s['kota']); ?>">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="check-group">
                    <label><input type="radio" name="jenis_kelamin" value="L" <?php if($s['jenis_kelamin']=='L') echo 'checked'; ?>> Laki-Laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="P" <?php if($s['jenis_kelamin']=='P') echo 'checked'; ?>> Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label>Hobby</label>
                <div class="check-group">
                    <?php foreach($hobbies as $h): ?>
                    <label><input type="checkbox" name="hobby[]" value="<?php echo $h; ?>" <?php if(in_array($h,$hobbiesCheck)) echo 'checked'; ?>> <?php echo $h; ?></label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Pilihan Ekskul</label>
                <select name="ekskul[]" multiple>
                    <?php foreach($ekskuls as $e): ?>
                    <option value="<?php echo $e; ?>" <?php if(in_array($e,$ekskulsCheck)) echo 'selected'; ?>><?php echo $e; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="btn-row">
                <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
                <a href="tampil.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>