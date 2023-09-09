<?php include "koneksi.php"; ?>

<!doctype html>
<html lang="en">

<?php include "style.php"; ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="PLN" style="width: 30px;">
                Aplikasi Tagihan Listrik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <ion-icon name="server-outline"></ion-icon> Data Master
                        </a>
                        <ul class="dropdown-menu">
<<<<<<< HEAD
                            <li>
                                <a class="dropdown-item" href="?mod=daya">
                                    <ion-icon name="flash-outline"></ion-icon> Daya Listrik
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="?mod=pelanggan">
                                    <ion-icon name="people-outline"></ion-icon> Pelanggan
                                </a>
                            </li>
=======
                            <li><a class="dropdown-item" href="?mod=daya">Daya Listrik</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="?mod=pelanggan">Pelanggan</a></li>
>>>>>>> e9fc79fff9036a0977e66ea26c4020bc81b13e8d
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?mod=penggunaan">
                            <ion-icon name="pulse-outline"></ion-icon> Penggunaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?mod=pembayaran">
                            <ion-icon name="wallet-outline"></ion-icon> Pembayaran
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="mt-3">
            <?php
            if (isset($_GET['mod'])) {
                $mod = $_GET['mod'];

                if (file_exists($module = "modules/mod_$mod/$mod.php")) {
                    include $module;
                } else {
                    include "modules/mod_404/404.php";
                }
            } else {
                include "modules/mod_home/home.php";
            }
            ?>
        </div>
    </div>

    <?php include "script.php"; ?>

</body>

</html>