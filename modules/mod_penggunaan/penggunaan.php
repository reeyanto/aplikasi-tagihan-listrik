<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'index';

if($act == 'index'):
    $sql = "SELECT pg.*, pl.id as pelanggan_id, pl.nama, pg.meteran_akhir - pg.meteran_awal as jumlah_kwh FROM penggunaan pg JOIN pelanggan pl ON pg.pelanggan_id = pl.id";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    ?>
    <div class="row">
        <div class="container">
            <h2>Daftar Penggunaan
                <a href="?mod=penggunaan&act=tambah" class="btn btn-primary mb-3 float-end">
                    <ion-icon name="add-outline"></ion-icon> Tambah Data
                </a>
            </h2>

            <table class="table table-striped mt-4" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Meteran Awal</th>
                        <th>Meteran Akhir</th>
                        <th>Jumlah KWH</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($data = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['pelanggan_id']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['bulan']; ?></td>
                            <td><?php echo $data['tahun']; ?></td>
                            <td><?php echo $data['meteran_awal']; ?></td>
                            <td><?php echo $data['meteran_akhir']; ?></td>
                            <td><?php echo $data['jumlah_kwh']; ?></td>
                            <td>
                                <a href="modules/mod_penggunaan/aksi.php?act=hapus&id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-sm btn-danger">Hapus</a>
                                <a href="?mod=penggunaan&act=ubah&id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning">Ubah</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


<?php elseif($act == 'tambah'): ?>
    <div class="row">
        <div class="container">
            <h2>Tambah Data
                <a href="?mod=penggunaan" class="btn btn-danger mb-3 float-end">
                    <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                </a>
            </h2>
            <form action="modules/mod_penggunaan/aksi.php?act=tambah" method="post">
                <div class="mb-3">
                    <label for="id">ID Pelanggan</label>
                    <select name="pelanggan_id" class="form-control">
                        <?php
                        $sql = "SELECT id, nama FROM pelanggan";
                        $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

                        while($data = mysqli_fetch_array($result)): ?>
                            <option value="<?php echo $data['id']; ?>">
                                <?php echo $data['nama']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" class="form-control">
                        <?php
                        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                        foreach($bulan as $nomor => $nama): ?>
                            <option value="<?php echo $nomor; ?>">
                                <?php echo $nama; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" class="form-control">
                        <?php for($tahun = 2020; $tahun <= date('Y'); $tahun++): ?>
                            <option value="<?php echo $tahun; ?>">
                                <?php echo $tahun; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="meteran_awal">Meteran Awal</label>
                    <input type="number" name="meteran_awal" class="form-control" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="meteran_akhir">Meteran Akhir</label>
                    <input type="number" name="meteran_akhir" class="form-control" autocomplete="off">
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
    $id   = $_GET['id'];
    $sql  = "SELECT pg.*, pl.id as pelanggan_id, pl.nama FROM penggunaan pg JOIN pelanggan pl ON pg.pelanggan_id = pl.id AND pg.id = '$id'";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    if($result) {
        $data = mysqli_fetch_array($result);
        ?>
        <div class="row">
            <div class="container">
                <h2>Ubah Data
                    <a href="?mod=penggunaan" class="btn btn-danger mb-3 float-end">
                        <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                    </a>
                </h2>
                <form action="modules/mod_penggunaan/aksi.php?act=ubah&id=<?php echo $id; ?>" method="post">
                    <div class="mb-3">
                        <label for="id">ID Pelanggan</label>
                        <select name="pelanggan_id" class="form-control">
                            <?php
                            $sql1 = "SELECT id, nama FROM pelanggan";
                            $result1 = mysqli_query($koneksi, $sql1) or die(mysqli_error($koneksi));

                            while($data1 = mysqli_fetch_array($result1)): ?>
                                <option value="<?php echo $data1['id']; ?>" <?php if($data['id'] == $data1['id']) echo 'selected'; ?>>
                                    <?php echo $data1['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control">
                            <?php
                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                            foreach($bulan as $nomor => $nama): ?>
                                <option value="<?php echo $nomor; ?>" <?php if($data['bulan'] == $nomor) echo 'selected'; ?>>
                                    <?php echo $nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-control">
                            <?php for($tahun = 2020; $tahun <= date('Y'); $tahun++): ?>
                                <option value="<?php echo $tahun; ?>" <?php if($data['tahun'] == $tahun) echo 'selected'; ?>>
                                    <?php echo $tahun; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="meteran_awal">Meteran Awal</label>
                        <input type="number" name="meteran_awal" value="<?php echo $data['meteran_awal']; ?>" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="meteran_akhir">Meteran Akhir</label>
                        <input type="number" name="meteran_akhir" value="<?php echo $data['meteran_akhir']; ?>" class="form-control" autocomplete="off">
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