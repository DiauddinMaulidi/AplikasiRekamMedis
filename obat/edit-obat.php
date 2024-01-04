<?php
    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
      header("location: ../autentikasi/index.php");
      exit();
    }  

  require "../config.php";

  $title = "Edit Obat";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

   $id = $_GET['id'];
   $getObat = mysqli_query($koneksi, "SELECT * FROM tb_obat WHERE id = '$id'");
   $obat = mysqli_fetch_assoc($getObat);

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
        <h1 class="h2">Edit Obat</h1>
        <a href="<?= $main_url ?>obat" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>

        <form action="proses-obat.php" method="post">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" value="<?= $obat['id'] ?>">
                        <label for="nama" class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="nama-obat" placeholder="nama obat" autocomplete="off" value="<?= $obat['nama_obat'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kegunaan" class="form-label">Kegunaan</label>
                        <textarea name="kegunaan" id="kegunaan" class="form-control" cols="" rows="3" placeholder="kegunaan obat apa?"><?= $obat['kegunaan'] ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Update</button>
                </div>
            </div>
        </form>

    </main>

<?php 

  require "../template/footer.php"; 

?>

