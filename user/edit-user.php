<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }

  require "../config.php";
  
  // $main_url = "http://localhost/rekam_medis/";

  $title = "Edit User";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";
  
  $id = $_GET['id'];
  $getUser = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = $id");
  $user = mysqli_fetch_assoc($getUser);

  if (isset($_SESSION['ssLoginRM'])) {
    $username = $_SESSION['ssUserRM'];
    $result = mysqli_query($koneksi, "SELECT fullname FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_lengkap = $row['fullname'];
    }
}
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
        <a href="<?= $main_url ?>user/index.php" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>
      
      <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-4 mb-4 text-center">
            <div class="px-4 mb-4">
              <input type="hidden" name="gambarLama" value="<?= $user['gambar'] ?>"> 
              <img src="<?= $main_url ?>assets/img/img-user/<?= $user['gambar'] ?>" alt="user" class="img-thumbnail rounded-circle mt-3 mb-3 tampil" width="120">
              <input type="file" class="form-control form-control-sm mb-1" name="gambar" onchange="imgView()" id="gambar">
              <span class="fs-6">Type file image JPG | JPEG | PNG</span><br>
              <span class="fs-6">Width = Height</span>
            </div>
            <button type="submit" name="update" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Update</button>
          </div>

          <div class="col-md-8">
            <div class="form-group mb-3">
                <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                <input type="hidden" name="usernameLama" value="<?= $user['username'] ?>">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $user['username'] ?>" autocomplete="off">
            </div>
            <div class="form-group mb-3">
                <label for="fullname" class="form-label">Nama lengkap</label>
                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $user['fullname'] ?>" autocomplete="off">
            </div>
            <div class="form-group mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-select">pilih
                    <option value="">--Masukkan jabatan--</option>
                    <option value="1" <?= $user['jabatan'] == 1 ? 'selected' : '' ?> >Administrator</option>
                    <option value="2" <?= $user['jabatan'] == 2 ? 'selected' : '' ?> >Petugas</option>
                    <option value="3" <?= $user['jabatan'] == 3 ? 'selected' : '' ?> >Dokter</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea type="text" class="form-control mb-5" name="alamat" id="alamat" placeholder="masukkan alamat"><?= $user['alamat'] ?></textarea>
            </div>

          </div>
        </div>
      </form>
    </main>

    <script>
      let gambar = document.getElementById('gambar');
      let tampil = document.querySelector('.tampil');

      function imgView() {
        let fileRead = new FileReader();
        fileRead.readAsDataURL(gambar.files[0]);

        fileRead.addEventListener('load', (e) => {
          tampil.src = e.target.result;
        });
      };

    </script>

    
<?php 

  require "../template/footer.php"; 

?>

