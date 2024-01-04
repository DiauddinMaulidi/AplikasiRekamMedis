<?php
    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
      header("location: ../autentikasi/index.php");
      exit();
    }  

  require "../config.php";
  
//   $main_url = "http://localhost/rekam_medis/";

  $title = "Tambah Obat";
  
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
        <h1 class="h2">Tambah Pasien</h1>
        <a href="<?= $main_url ?>obat" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>

        <form action="proses-obat.php" method="post">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama Obat</label>
                        <input type="text" name="nama-obat" class="form-control" id="nama-obat" placeholder="nama obat" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kegunaan" class="form-label">Kegunaan</label>
                        <textarea name="kegunaan" id="kegunaan" class="form-control" cols="" rows="3" placeholder="kegunaan obat apa?" required></textarea>
                    </div>
                    <button type="reset" name="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top"></i> Reset</button>
                    <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Simpan</button>
                </div>
            </div>
        </form>

    </main>

<?php 

  require "../template/footer.php"; 

?>

