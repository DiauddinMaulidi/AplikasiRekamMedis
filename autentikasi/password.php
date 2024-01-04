<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: index.php");
    exit();
  }
  
  require "../config.php";

  $title = "Ganti Password";
  
  require "../template/header.php";
  require "../template/navbar.php";
  require "../template/sidebar.php";

?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ganti Password</h1>
    </div>

    <form action="../user/proses-user.php" method="post">
        <div class="form-group mb-3 col-6">
            <label for="passOld" class="form-label">Password Lama</label>
            <input type="password" id="passOld" name="passOld" class="form-control" placeholder="masukkan password lama" required autocomplete="off">
        </div>        
        <div class="form-group mb-3 col-6">
            <label for="passNew" class="form-label">Password Baru</label>
            <input type="password" id="passNew" name="passNew" class="form-control" placeholder="masukkan password yang baru" required autocomplete="off">
        </div>        
        <div class="form-group mb-3 col-6">
            <label for="confPass" class="form-label">Konfirmasi Password</label>
            <input type="password" id="confPass" name="confPass" class="form-control" placeholder="Konfirmasi password anda" required autocomplete="off">
        </div>
        
        <button type="reset" name="reset" class="btn btn-outline-danger btn-sm" onclick="resetGambar()"><i class="bi bi-x-lg align-top"></i> Reset</button>
        <button type="submit" name="ganti-password" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Simpan</button>
        
    </form>
</main>
    
<?php 

  require "../template/footer.php"; 

?>

