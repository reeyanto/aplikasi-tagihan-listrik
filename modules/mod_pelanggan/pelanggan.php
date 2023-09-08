<?php
$act = isset($_GET['act']) ? $_GET['act'] : 'index';

if($act == 'index'):
    $sql = "SELECT p.*, d.daya FROM pelanggan p JOIN daya d ON p.daya_kode = d.kode ORDER BY id ASC";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    ?>
    <div class="row">
        <div class="container">
            <h2>Daftar Pelanggan
                <a href="?mod=pelanggan&act=tambah" class="btn btn-primary mb-3 float-end">
                    <ion-icon name="add-outline"></ion-icon> Tambah Data
                </a>
            </h2>

            <table class="table table-striped mt-4" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>HP</th>
                        <th>Daya (KWH)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($data = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php echo $data['hp']; ?></td>
                            <td><?php echo $data['daya']; ?></td>
                            <td>
                                <a href="modules/mod_pelanggan/aksi.php?act=hapus&id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-sm btn-danger">Hapus</a>
                                <a href="?mod=pelanggan&act=ubah&id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning">Ubah</a>
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
                <a href="?mod=pelanggan" class="btn btn-danger mb-3 float-end">
                    <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                </a>
            </h2>
            <form action="modules/mod_pelanggan/aksi.php?act=tambah" method="post">
                <div class="mb-3">
                    <label for="id">ID Pelanggan</label>
                    <input type="text" name="id" class="form-control" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" cols="30" rows="2" class="form-control" style="resize: none;"></textarea>
                </div>
                <div class="mb-3">
                    <label for="hp">No. HP</label>
                    <input type="text" name="hp" class="form-control" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="daya">Daya (KWH)</label>
                    <select name="daya_kode" class="form-control">
                        <?php
                        $sql = "SELECT * FROM daya";
                        $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

                        while($data = mysqli_fetch_array($result)): ?>
                            <option value="<?php echo $data['kode']; ?>">
                                <?php echo $data['daya']; ?>
                            </option>
                        <?php endwhile; ?>
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
    $id   = $_GET['id'];
    $sql  = "SELECT p.*, d.* FROM pelanggan p JOIN daya d ON p.daya_kode = d.kode AND p.id = '$id'";
    $result = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    if($result) {
        $data = mysqli_fetch_array($result);
        ?>
        <div class="row">
            <div class="container">
                <h2>Ubah Data
                    <a href="?mod=pelanggan" class="btn btn-danger mb-3 float-end">
                        <ion-icon name="arrow-back-outline"></ion-icon> Kembali
                    </a>
                </h2>
                <form action="modules/mod_pelanggan/aksi.php?act=ubah" method="post">
                    <div class="mb-3">
                        <label for="id">ID Pelanggan</label>
                        <input type="text" name="id" value="<?php echo $data['id']; ?>" readonly="true" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" cols="30" rows="2" class="form-control" style="resize: none;"><?php echo $data['alamat']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hp">No. HP</label>
                        <input type="text" name="hp" value="<?php echo $data['hp']; ?>" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="daya">Daya (KWH)</label>
                        <select name="daya_kode" class="form-control">
                            <?php
                            $sql1 = "SELECT * FROM daya";
                            $result1 = mysqli_query($koneksi, $sql1) or die(mysqli_error($koneksi));

                            while($data1 = mysqli_fetch_array($result1)): ?>
                                <option value="<?php echo $data1['kode']; ?>" <?php if ($data['kode'] == $data1['kode']) echo 'selected'; ?>>
                                    <?php echo $data1['daya']; ?>
                                </option>
                            <?php endwhile; ?>
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
    <?php } ?>                  


<?php endif; ?>