<?php
session_start();

if (!isset ($_SESSION['namauser']))
    {
    echo"anda belum login";
    exit;
    }
?>