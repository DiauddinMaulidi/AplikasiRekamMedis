<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }
  
  require "../config.php";

  $title = "Riwayat Perekaman";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";
  
  
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Laporan Riwayat Perekaman</h1>
        </div>

        <table class="table table-responsive tabel" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pasien</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $getRiwayat = mysqli_query($koneksi, "SELECT * FROM tb_pasien");
                    while ($riwayat = mysqli_fetch_assoc($getRiwayat)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riwayat['id'] ?></td>
                            <td><?= $riwayat['nama'] ?></td>
                            <td><?= $riwayat['telpon'] ?></td>
                            <td><?= $riwayat['alamat'] ?></td>
                            <td>
                                <a href="laporan.php?id=<?= $riwayat['id'] ?>" class="btn btn-sm btn-outline-primary m-auto" title="cetak pdf" target="_blank"><i class="bi bi-printer align-top"></i></a>
                            </td>
                        </tr>

                <?php } ?>
            </tbody>
        </table>

    </main>
    
<?php 

  require "../template/footer.php"; 

?>

