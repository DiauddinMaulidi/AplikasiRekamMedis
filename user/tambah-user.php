<?php
    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
      header("location: ../autentikasi/index.php");
      exit();
    }  

  require "../config.php";
  
  // $main_url = "http://localhost/rekam_medis/";

  $title = "Tambah User";
  
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


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah User</h1>
        <a href="<?= $main_url ?>user" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>
      
      <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-4 mb-4 text-center">
            <div class="px-4 mb-4">
              <img src="<?= $main_url ?>assets/img/img-user/user2.png" alt="user" class="img-thumbnail rounded-circle mt-3 mb-3 tampil" width="120">
              <input type="file" class="form-control form-control-sm mb-1" name="gambar" onchange="imgView()" id="gambar">
              <span class="fs-6">Type file image JPG | JPEG | PNG</span><br>
              <span class="fs-6">Width = Height</span>
            </div>
            <button type="reset" name="reset" class="btn btn-outline-danger btn-sm" onclick="resetGambar()"><i class="bi bi-x-lg align-top"></i> Reset</button>
            <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Simpan</button>
          </div>

          <div class="col-md-8">
            <div class="form-group mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="masukkan username" required autocomplete="off">
            </div>
            <div class="form-group mb-3">
              <label for="fullname" class="form-label">Nama lengkap</label>
              <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nama lengkap anda" autocomplete="off">
            </div>
            <div class="form-group mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="masukkan password">
            </div>
            <div class="form-group mb-3">
              <label for="password2" class="form-label">Konfirmasi password</label>
              <input type="password" class="form-control" name="password2" id="password2" placeholder="masukkan kembali password">
            </div>
            <div class="form-group mb-3">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select name="jabatan" id="jabatan" class="form-select">pilih
                <option value="">--Masukkan jabatan--</option>
                <option value="1">Administrator</option>
                <option value="2">Petugas</option>
                <option value="3">Dokter</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea type="text" class="form-control mb-5" name="alamat" id="alamat" cols="" rows="3" placeholder="masukkan alamat"></textarea>
            </div>

          </div>
        </div>
      </form>
    </main>

    <script>
      let tampil = document.querySelector('.tampil');
      
      function imgView() {
        let gambar = document.getElementById('gambar');
        let tampil = document.querySelector('.tampil');

        let fileRead = new FileReader();
        fileRead.readAsDataURL(gambar.files[0]);

        fileRead.addEventListener('load', (e) => {
          tampil.src = e.target.result;
        });
        
        // fileRead.onload = function(e) {
        //   tampil.src = e.target.result;
        // }

      };

      function resetGambar() {
        tampil.src = '<?= $main_url ?>/assets/img/img-user/user2.png';
      }

    </script>

    
<?php 

  require "../template/footer.php"; 

?>

