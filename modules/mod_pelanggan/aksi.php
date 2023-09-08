<?php
include "../../koneksi.php";

if(isset($_GET['act'])) {
    if($_GET['act'] == 'tambah') {
        $id         = $_POST['id'];
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $hp         = $_POST['hp'];
        $daya_kode  = $_POST['daya_kode'];

        $sql = "INSERT INTO pelanggan (id, nama, alamat, hp, daya_kode) VALUES ('$id', '$nama', '$alamat', '$hp', '$daya_kode')";
        
        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=pelanggan');
        }
    }

    
    else if($_GET['act'] == 'ubah') {
        $id         = $_POST['id'];
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $hp         = $_POST['hp'];
        $daya_kode  = $_POST['daya_kode'];

        $sql = "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat', hp = '$hp', daya_kode = '$daya_kode' WHERE id = '$id'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=pelanggan');
        }
    }


    else if($_GET['act'] == 'hapus') {
        $id  = $_GET['id'];
        $sql = "DELETE FROM pelanggan WHERE id = '$id'";

        if(mysqli_query($koneksi, $sql)) {
            header('location:../../?mod=pelanggan');
        }
    }
}