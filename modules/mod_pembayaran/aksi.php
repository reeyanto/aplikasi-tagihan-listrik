<?php
include "../../koneksi.php";

if(isset($_GET['act'])) {
    if($_GET['act'] == 'tambah') {
        $penggunaan_id      = $_POST['penggunaan_id'];
        $tanggal            = date('Y-m-d');
        $jml_tagihan        = $_POST['jml_tagihan'];
        $metode_pembayaran  = $_POST['metode_pembayaran'];

        $sql = "INSERT INTO pembayaran (penggunaan_id, tanggal, jml_tagihan, metode_pembayaran) VALUES ('$penggunaan_id', '$tanggal', '$jml_tagihan', '$metode_pembayaran')";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=pembayaran');
        }
    }

}