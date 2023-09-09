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
CREATE DATABASE `db_tagihan_listrik`  

### Tabel daya  
CREATE TABLE `daya` (  
  `kode` varchar(5) NOT NULL,  
  `daya` varchar(10) NOT NULL,  
  `tarif_perkwh` int(11) NOT NULL,  
  PRIMARY KEY(`kode`)  
);  

### Tabel pelanggan  
CREATE TABLE `pelanggan` (  
  `id` varchar(12) NOT NULL,  
  `nama` varchar(50) NOT NULL,  
  `alamat` varchar(100) NOT NULL,  
  `hp` varchar(12) DEFAULT NULL,  
  `daya_kode` varchar(5) NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`daya_kode`) REFERENCES `daya`(`kode`) ON UPDATE CASCADE ON DELETE RESTRICT  
);  

### Tabel tagihan  
CREATE TABLE `tagihan` (  
  `pelanggan_id` varchar(12) NOT NULL,  
  `periode` date NOT NULL,  
  `kwh` int(11) NOT NULL COMMENT 'KWH pemakaian periode ini',  
  `total_bayar` int(11) NOT NULL,  
  `status_bayar` enum('0','1') DEFAULT '0' COMMENT '0 = belum bayar, 1 = sudah dibayar',
  PRIMARY KEY(`pelanggan_id`, `periode`),  
  FOREIGN KEY(`pelanggan_id`) REFERENCES `pelanggan`(`id`) ON UPDATE CASCADE ON DELETE CASCADE  
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