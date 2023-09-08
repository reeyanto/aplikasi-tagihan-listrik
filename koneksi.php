<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_tagihan_listrik";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if( ! $koneksi) {
    exit("Koneksi error: " . mysqli_connect_error());
}