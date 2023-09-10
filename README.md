# Aplikasi Tagihan Listik  
Dibuat sebagai bagian dari pengabdian kepada masyarakat dosen Program Studi Manajemen Informatika Kampus Pelalawan PSDKU Politeknik Negeri Padang di Sekolah Menengah Kejuruan (SMK) Negeri 1 Pangkalan Kerinci.  
  
## Sistem Requirements  
1. XAMPP/Laragon/PHPTriad dan sebagainya  
2. Code Editor Visual Studio Code, Sublime Text, Notepad++ dan sebagainya  

## Tasks List  
1. Pembuatan database beserta tabel-tabelnya  
2. Pembuatan struktur folder  
3. Koneksi ke database  
4. Implementasi template bootstrap  
5. Pembuatan modul-modul  

## Database  
CREATE DATABASE IF NOT EXISTS `db_tagihan_listrik`;  
USE `db_tagihan_listrik`;

### Tabel daya  
CREATE TABLE IF NOT EXISTS `daya` (  
  `kode` varchar(5) NOT NULL,  
  `daya` varchar(10) NOT NULL,  
  `tarif_perkwh` int(11) NOT NULL,  
  PRIMARY KEY(`kode`)  
);  

### Tabel pelanggan  
CREATE TABLE IF NOT EXISTS `pelanggan` (  
  `id` varchar(12) NOT NULL,  
  `daya_kode` varchar(5) NOT NULL,  
  `nama` varchar(50) NOT NULL,  
  `alamat` varchar(100) NOT NULL,  
  `hp` varchar(12) DEFAULT NULL,  
  PRIMARY KEY(`id`),  
  FOREIGN KEY(`daya_kode`) REFERENCES `daya`(`kode`) ON UPDATE CASCADE ON DELETE CASCADE    
);  

### Tabel penggunaan  
CREATE TABLE IF NOT EXISTS `penggunaan` (  
  `id` int NOT NULL AUTO_INCREMENT,  
  `pelanggan_id` varchar(12) NOT NULL,  
  `bulan` int NOT NULL,  
  `tahun` year NOT NULL,  
  `meteran_awal` int NOT NULL,  
  `meteran_akhir` int NOT NULL,  
  PRIMARY KEY(`id`),  
  FOREIGN KEY(`pelanggan_id`) REFERENCES `pelanggan`(`id`) ON UPDATE CASCADE ON DELETE CASCADE  
);

### Tabel pembayaran  
CREATE TABLE IF NOT EXISTS `pembayaran` (  
  `id` int NOT NULL AUTO_INCREMENT,  
  `penggunaan_id` INT NOT NULL, 
  `tanggal` date NOT NULL,  
  `jml_tagihan` int NOT NULL,  
  `metode_pembayaran` enum('1', '2', '3') COMMENT '1 = Kantor POS, 2 = Toko Ritel, 3 = Lainnya',  
  PRIMARY KEY(`id`),  
  FOREIGN KEY(`penggunaan_id`) REFERENCES `penggunaan`(`id`) ON UPDATE CASCADE ON DELETE CASCADE  
);

## Struktur Direktori  
aplikasi-tagihan-listrik  
|_ modules  
| |_ mod_pertama  
| | |_ pertama.php  
| | |_ aksi.php  
| |  
| |_ mod_kedua  
| | |_ kedua.php  
| | |_ aksi.php  
|  
|_ koneksi.php  
|_ index.php 
|_ script.php  
|_ style.php