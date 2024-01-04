<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }
  
  require "../config.php";
  
  $main_url = "http://localhost/rekam_medis/";

  $title = "Data User";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

  if ($result['jabatan'] != 1) {
    echo "<script>
        alert('halaman tidak ada!');
        window.location = '../index.php';
    </script>";
    exit();
  }
  
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data User</h1>
            <a href="<?= $main_url ?>index.php" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
        </div>
        <a href="<?= $main_url ?>user/tambah-user.php" class="btn btn-outline-secondary mb-3"><i class="bi bi-plus-circle-dotted align-top"></i> Tambah User</a>

        <table class="table table-responsive tabel">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama lengkap</th>
                    <th scope="col">Username</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $getData = mysqli_query($koneksi, "SELECT * FROM tb_user");
                    while ($user = mysqli_fetch_assoc($getData)) {
                        $jabatan = $user['jabatan'];
                ?>
                    <tr>
                        <td class=""><?= $no++ ?></td>
                        <td class="col-1">
                            <img src="../assets/img/img-user/<?= $user['gambar'] ?>" alt="gambar" class="img-thumbnail rounded-circle img-fluid">
                        </td>
                        <td class="center"><?= $user['fullname'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td>
                            <?php
                                if ($jabatan == 1) {
                                    echo "Administrator";
                                } else if ($jabatan == 2) {
                                    echo "Petugas";
                                } else if ($jabatan == 3) {
                                    echo "Dokter";
                                }
                            ?>
                        </td>
                        <td><?= $user['alamat'] ?></td>
                        <td>
                            <a href="edit-user.php?id=<?= $user['id_user'] ?>&gambar=<?= $user['gambar'] ?>" class="btn btn-sm btn-outline-warning m-auto" title="editlah"><i class="bi bi-pencil align-top"></i></a>
                            <a href="proses-user.php?id=<?= $user['id_user'] ?>&gambar=<?= $user['gambar'] ?>&aksi=hapus-user" onclick="return confirm('Apakah anda yakin?')" class="btn btn-sm btn-outline-danger" title="hapuslah"><i class="bi bi-trash align-top"></i></a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </main>
    
<?php 

  require "../template/footer.php"; 

?>

