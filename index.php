<?php include "koneksi.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Tagihan Listrik</title>
    <!-- CSS bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <!-- CSS datatable  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  </head>
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
            if(isset($_GET['mod'])) {
                $mod = $_GET['mod'];

                if(file_exists($module = "modules/mod_$mod/$mod.php")) {
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

    <!-- JS ion icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- JS bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- JS datatable  -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#table');
    </script>
  </body>
</html>