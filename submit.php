<?php
session_start();

$username_db ="admin";
$password_db ="123";

$username=$_POST['username'];
$password=$_POST['password'];

if($username==$username_db AND $password==$password_db)
    {
        $_SESSION['username'] = $username;
        echo "USERNAME : ".$username."<br>";
        echo "selmat datang <b>".$_SESSION['username']."</b> <br>";
        echo " Menu navigasi anda <br>";
        echo "<a href='hal1.php'>menu 1</a><br>";
        echo "<a href='hal2.php'>menu 2</a><br>";
        echo "<a href='hal3.php'>menu 3</a><br>";
    } else {
        echo "<b>USERNAME ATAU PASSWORD ANDA SALAH!";
    }
?>