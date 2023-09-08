<?php
include "../../koneksi.php";

if(isset($_GET['act'])) {
    if($_GET['act'] == 'tambah') {
        $kode = $_POST['kode'];
        $daya = $_POST['daya'];
        $tarif_perkwh = $_POST['tarif_perkwh'];

        $sql = "INSERT INTO daya (kode, daya, tarif_perkwh) VALUES ('$kode', '$daya', '$tarif_perkwh')";
        
        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=daya');
        }
    }

    
    else if($_GET['act'] == 'ubah') {
        $kode = $_POST['kode'];
        $daya = $_POST['daya'];
        $tarif_perkwh = $_POST['tarif_perkwh'];

        $sql = "UPDATE daya SET daya = '$daya', tarif_perkwh = '$tarif_perkwh' WHERE kode = '$kode'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=daya');
        }
    }


    else if($_GET['act'] == 'hapus') {
        $kode = $_GET['kode'];
        $sql  = "DELETE FROM daya WHERE kode = '$kode'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=daya');
        }
    }
}