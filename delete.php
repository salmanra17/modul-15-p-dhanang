<?php
include "cek_session.php";
include "koneksi.php";

$nis = $_GET['nis'];
mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");

header("Location: tampil.php");
exit;
?>