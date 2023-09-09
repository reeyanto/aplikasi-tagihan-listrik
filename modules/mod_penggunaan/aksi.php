<?php
include "../../koneksi.php";

if(isset($_GET['act'])) {
    if($_GET['act'] == 'tambah') {
        $pelanggan_id   = $_POST['pelanggan_id'];
        $bulan          = $_POST['bulan'];
        $tahun          = $_POST['tahun'];
        $meteran_awal   = $_POST['meteran_awal'];
        $meteran_akhir  = $_POST['meteran_akhir'];

        $sql = "INSERT INTO penggunaan (pelanggan_id, bulan, tahun, meteran_awal, meteran_akhir) VALUES ('$pelanggan_id', '$bulan', '$tahun', '$meteran_awal', '$meteran_akhir')";
        
        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=penggunaan');
        }
    }

    
    else if($_GET['act'] == 'ubah') {
        $id             = $_GET['id'];
        $pelanggan_id   = $_POST['pelanggan_id'];
        $bulan          = $_POST['bulan'];
        $tahun          = $_POST['tahun'];
        $meteran_awal   = $_POST['meteran_awal'];
        $meteran_akhir  = $_POST['meteran_akhir'];

        $sql = "UPDATE penggunaan SET pelanggan_id = '$pelanggan_id', bulan = '$bulan', tahun = '$tahun', meteran_awal = '$meteran_awal', meteran_akhir = '$meteran_akhir' WHERE id = '$id'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=penggunaan');
        }
    }


    else if($_GET['act'] == 'hapus') {
        $id  = $_GET['id'];
        $sql = "DELETE FROM penggunaan WHERE id = '$id'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=penggunaan');
        }
    }
}