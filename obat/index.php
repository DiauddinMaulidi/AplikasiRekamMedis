<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }
  
  require "../config.php";

  $title = "Data Obat";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

  if ($result['jabatan'] == 3) {
    echo "<script>
        alert('halaman tidak ada!');
        window.location = '../index.php';
    </script>";
    exit();
  }
  
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Obat</h1>
            <a href="<?= $main_url ?>index.php" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
        </div>
        <a href="<?= $main_url ?>obat/tambah-obat.php" class="btn btn-outline-secondary mb-3"><i class="bi bi-plus-circle-dotted align-top"></i> Tambah Pasien</a>

        <table class="table table-responsive tabel" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kegunaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $getObat = mysqli_query($koneksi, "SELECT * FROM tb_obat");
                    while ($obat = mysqli_fetch_assoc($getObat)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $obat['nama_obat'] ?></td>
                            <td><?= $obat['kegunaan'] ?></td>
                            <td>
                                <a href="edit-obat.php?id=<?= $obat['id'] ?>" class="btn btn-sm btn-outline-warning m-auto" title="editlah"><i class="bi bi-pencil align-top"></i></a>
                                <a href="proses-obat.php?id=<?= $obat['id'] ?>&aksi=hapus-obat" onclick="return confirm('Anda ingin menghapus obat?')" class="btn btn-sm btn-outline-danger" title="hapuslah"><i class="bi bi-trash align-top"></i></a>
                            </td>
                        </tr>

                <?php } ?>
            </tbody>
        </table>

    </main>
    
<?php 

  require "../template/footer.php"; 

?>

