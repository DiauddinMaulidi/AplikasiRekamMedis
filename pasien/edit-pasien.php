<?php
    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
      header("location: ../autentikasi/index.php");
      exit();
    }  

  require "../config.php";

  $title = "Edit Pasien";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

   $id = $_GET['id'];
   $getPasien = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE id = '$id'");
   $pasien = mysqli_fetch_assoc($getPasien);

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
        <h1 class="h2">Edit Pasien</h1>
        <a href="<?= $main_url ?>pasien" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>

        <form action="proses-pasien.php" method="post">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" value="<?= $pasien['id'] ?>">
                        <label for="nama" class="form-label">Nama Pasien</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="nama lengkap" autocomplete="off" value="<?= $pasien['nama'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tnggl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tnggl_lahir" class="form-control" id="tnggl_lahir" value="<?= $pasien['tnggl_lahir'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="L" <?= ($pasien['gender'] == 'L') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="gender">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="P" <?= ($pasien['gender'] == 'P') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="gender">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telpon" class="form-label">Telepon</label>
                        <input type="tel" name="telpon" placeholder="minimal 8 angka" pattern="[0-9]{8,}" title="minimal 8 angka" class="form-control" id="telpon" autocomplete="off" value="<?= $pasien['telpon'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="" rows="3" placeholder="masukkan alamat"><?= $pasien['alamat'] ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Update</button>
                </div>
            </div>
        </form>

    </main>

<?php 

  require "../template/footer.php"; 

?>

