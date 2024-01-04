<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }
  
  require "../config.php";
  
//   $main_url = "http://localhost/rekam_medis/";

  $title = "Data Pasien";
  
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
            <h1 class="h2">Data Pasien</h1>
            <a href="<?= $main_url ?>index.php" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
        </div>
        <a href="<?= $main_url ?>pasien/tambah-pasien.php" class="btn btn-outline-secondary mb-3"><i class="bi bi-plus-circle-dotted align-top"></i> Tambah Pasien</a>

        <table class="table table-responsive tabel" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Pasien</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Telpon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $getPasien = mysqli_query($koneksi, "SELECT * FROM tb_pasien");
                    while ($pasien = mysqli_fetch_assoc($getPasien)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pasien['id'] ?></td>
                            <td><?= $pasien['nama'] ?></td>
                            <td><?= in_date($pasien['tnggl_lahir']) ?></td>
                            <td>
                                <?php
                                    if ($pasien['gender'] == 'L') {
                                        echo "Laki - Laki";
                                    } else {
                                        echo "Perempuan";
                                    }
                                ?>
                            </td>
                            <td><?= $pasien['telpon'] ?></td>
                            <td><?= $pasien['alamat'] ?></td>
                            <td>
                                <a href="edit-pasien.php?id=<?= $pasien['id'] ?>" class="btn btn-sm btn-outline-warning m-auto" title="editlah"><i class="bi bi-pencil align-top"></i></a>
                                <a href="proses-pasien.php?id=<?= $pasien['id'] ?>&aksi=hapus-pasien" onclick="return confirm('Apakah anda yakin?')" class="btn btn-sm btn-outline-danger" title="hapuslah"><i class="bi bi-trash align-top"></i></a>
                            </td>
                        </tr>

                <?php } ?>
            </tbody>
        </table>

    </main>
    
<?php 

  require "../template/footer.php"; 

?>

