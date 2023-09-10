<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'index';

if($act == 'index'):
    $sql = "SELECT pb.*, pg.id, meteran_akhir - meteran_awal as penggunaan_kwh, pl.id as pelanggan_id, pl.nama 
            FROM pembayaran pb 
            JOIN penggunaan pg ON pb.penggunaan_id = pg.id 
            JOIN pelanggan pl ON pg.pelanggan_id = pl.id";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    ?>
    <div class="row">
        <div class="container">
            <h2>Daftar Pembayaran</h2>

            <table class="table table-striped mt-4" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Penggunaan KWH</th>
                        <th>Jml. Tagihan</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($data = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo $data['pelanggan_id']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['penggunaan_kwh']; ?></td>
                            <td><?php echo $data['jml_tagihan']; ?></td>
                            <td><?php echo $data['metode_pembayaran']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


<?php elseif($act == 'tambah'):
    $penggunaan_id = $_GET['penggunaan_id'];
    
    $sql = "SELECT pl.id as pelanggan_id, pg.id as penggunaan_id, nama, tahun, bulan, (meteran_akhir - meteran_awal) * tarif_perkwh as jml_tagihan 
            FROM pelanggan pl 
            JOIN penggunaan pg ON pl.id = pg.pelanggan_id
            JOIN daya d ON pl.daya_kode = d.kode 
            WHERE pg.id = '$penggunaan_id'";

    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($result);
    ?>
    <div class="row">
        <div class="container">
            <h2>Tambah Data
                <a href="?mod=penggunaan" class="btn btn-danger mb-3 float-end">
                    <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                </a>
            </h2>
            <form action="modules/mod_pembayaran/aksi.php?act=tambah" method="post">
                <input type="hidden" name="penggunaan_id" value="<?php echo $data['penggunaan_id']; ?>">
                <div class="mb-3">
                    <label for="pelanggan_id">ID Pelanggan</label>
                    <input type="text" name="pelanggan_id" value="<?php echo $data['pelanggan_id']; ?>" readonly="true" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" readonly="true" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="tahun">Tahun</label>
                    <input type="text" name="tahun" value="<?php echo $data['tahun']; ?>" readonly="true" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="bulan">Bulan</label>
                    <?php $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>
                    <input type="text" name="bulan" value="<?php echo $bulan[$data['bulan']]; ?>" readonly="true" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="jml_tagihan">Jumlah Tagihan</label>
                    <input type="number" name="jml_tagihan" value="<?php echo $data['jml_tagihan']; ?>" readonly="true" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-control">
                        <option value="1">Kantor POS</option>
                        <option value="2">Toko Ritel (Indomaret/Alfamart/dll)</option>
                        <option value="3">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-info" type="submit">
                        <ion-icon name="save-outline"></ion-icon> Simpan
                    </button>
                    <button class="btn btn-warning" type="reset">
                        <ion-icon name="reload-outline"></ion-icon> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>



<?php elseif($act == 'ubah'): 
    $kode = $_GET['kode'];
    $sql  = "SELECT * FROM daya WHERE kode = '$kode'";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    if($result) {
        $data = mysqli_fetch_array($result);
        ?>
        <div class="row">
            <div class="container">
                <h2>Ubah Data
                    <a href="?mod=daya" class="btn btn-danger mb-3 float-end">
                        <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                    </a>
                </h2>
                <form action="modules/mod_daya/aksi.php?act=ubah" method="post">
                    <div class="mb-3">
                        <label for="kode">Kode Daya</label>
                        <input type="text" name="kode" class="form-control" value="<?php echo $data['kode']; ?>" readonly="true" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="daya">Daya (KWH)</label>
                        <input type="number" name="daya" value="<?php echo $data['daya']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tarif">Tarif per-KWH (Rp)</label>
                        <input type="number" name="tarif_perkwh" value="<?php echo $data['tarif_perkwh']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-info" type="submit">
                            <ion-icon name="save-outline"></ion-icon> Simpan
                        </button>
                        <button class="btn btn-warning" type="reset">
                            <ion-icon name="reload-outline"></ion-icon> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>                  


<?php endif; ?>