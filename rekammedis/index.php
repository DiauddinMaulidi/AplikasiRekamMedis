<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }
  
  require "../config.php";

  $title = "Data Rekam Medis";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Perekaman</h1>
            <a href="<?= $main_url ?>index.php" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
        </div>
        <a href="<?= $main_url ?>rekammedis/tambah-data.php" class="btn btn-outline-secondary mb-3"><i class="bi bi-plus-circle-dotted align-top"></i> Tambah Data</a>

        <table class="table table-responsive tabel" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl</th>
                    <th>Pasien</th>
                    <th>Alamat</th>
                    <th>Keluhan</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                    <th>Obat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $sqlRM = "SELECT *, tb_pasien.alamat AS alamatPasien FROM tb_rekammedis INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id INNER JOIN tb_user ON tb_rekammedis.id_dokter = tb_user.id_user ORDER BY tgl_rm DESC";
                    $queryRM = mysqli_query($koneksi, $sqlRM);
                    while ($rm = mysqli_fetch_assoc($queryRM)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= in_date($rm['tgl_rm']) ?></td>
                            <td><?= $rm['nama'] ?></td>
                            <td><?= $rm['alamatPasien'] ?></td>
                            <td><?= $rm['keluhan'] ?></td>
                            <td><?= $rm['fullname'] ?></td>
                            <td><?= $rm['diagnosa'] ?></td>
                            <td><?= $rm['obat'] ?></td>
                            <td>
                                <a href="edit-data.php?id=<?= $rm['no_rm'] ?>" class="btn btn-sm btn-outline-warning m-auto" title="editlah"><i class="bi bi-pencil align-top"></i></a>
                                <a href="proses-data.php?id=<?= $rm['no_rm'] ?>&aksi=hapus-data" onclick="return confirm('Anda ingin menghapus data rekaman?')" class="btn btn-sm btn-outline-danger" title="hapuslah"><i class="bi bi-trash align-top"></i></a>
                            </td>
                        </tr>

                <?php } ?>
            </tbody>
        </table>

    </main>
    
<?php 

  require "../template/footer.php"; 

?>

