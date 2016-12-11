<?php
$host = "10.151.34.159"; 
$user = "root"; 
$pass = "";
$db   = "fppweb"; 
$conn=mysqli_connect($host,$user,$pass,$db);
if(!$conn) die("koneksi error");
//else echo "sukses";
?>