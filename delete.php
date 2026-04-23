<?php
include "cek_session.php";

$nis = urldecode($_GET['nis']);
unset($_SESSION['data_siswa'][$nis]);

header("Location: tampil.php");
exit;