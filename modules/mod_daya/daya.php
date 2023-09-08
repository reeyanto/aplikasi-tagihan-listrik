<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'index';

if($act == 'index'):
    $sql = "SELECT * FROM daya ORDER BY kode ASC";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    ?>
    <div class="row">
        <div class="container">
            <h2>Daftar Tarif
                <a href="?mod=daya&act=tambah" class="btn btn-primary mb-3 float-end">
                    <ion-icon name="add-outline"></ion-icon> Tambah Data
                </a>
            </h2>

            <table class="table table-striped mt-4" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Daya (KWH)</th>
                        <th>Tarif per-KWH (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($data = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['kode']; ?></td>
                            <td><?php echo $data['daya']; ?></td>
                            <td><?php echo $data['tarif_perkwh']; ?></td>
                            <td>
                                <a href="modules/mod_daya/aksi.php?act=hapus&kode=<?php echo $data['kode']; ?>" onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-sm btn-danger">Hapus</a>
                                <a href="?mod=daya&act=ubah&kode=<?php echo $data['kode']; ?>" class="btn btn-sm btn-warning">Ubah</a>
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
                <a href="?mod=daya" class="btn btn-danger mb-3 float-end">
                    <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                </a>
            </h2>
            <form action="modules/mod_daya/aksi.php?act=tambah" method="post">
                <div class="mb-3">
                    <label for="kode">Kode Daya</label>
                    <input type="text" name="kode" class="form-control" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="daya">Daya (KWH)</label>
                    <input type="number" name="daya" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="tarif">Tarif per-KWH (Rp)</label>
                    <input type="number" name="tarif_perkwh" class="form-control">
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