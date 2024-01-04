<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
  }


require "../config.php";


// create user
if (isset($_POST['simpan'])) {

    $username = trim(htmlspecialchars($_POST['username']));
    $fullname = trim(htmlspecialchars($_POST['fullname']));
    $jabatan = $_POST['jabatan'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gambar = htmlspecialchars($_FILES['gambar']['name']);
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
    

    // cek username
    // $cekUsername = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

    // if (mysqli_num_rows($cekUsername)) {
    //     echo "<script>
    //         alert('username tidak boleh sama dengan yang lain, silahkan cari yang lain');
    //         window.location = 'tambah-user.php';
    //     </script>";
    //     return;
    // }

    // cek kevalidan password
    if ($password !== $password2) {
        echo "<script>
            alert('password anda tidak sama!');
            window.location = 'tambah-user.php';
        </script>";
        return;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    // cek gambar
    if ($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGmbr($url);
    } else {
        $gambar = 'user2.png';
    }

    mysqli_query($koneksi, "INSERT INTO tb_user VALUES(null, '$username', '$fullname', '$pass', '$jabatan', '$alamat', '$gambar')");

    echo "<script>
            alert('user berhasil ditambahkan!');
            window.location = 'tambah-user.php';
        </script>";
        return;
}


// delete user
if (@$_GET['aksi'] == 'hapus-user') {
    $id = $_GET['id'];
    $gbr = $_GET['gambar'];

    mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user = $id");
    // cek apakah gambar default atau tidak
    if ($gbr != 'user2.png') {
        unlink('../assets/img/img-user/' . $gbr);
    }
    
    echo "<script>
        alert('user berhasil dihapus!');
        window.location = 'index.php';
    </script>";
    return;
}



// update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $userLama = trim(htmlspecialchars($_POST['usernameLama']));
    $username = trim(htmlspecialchars($_POST['username']));
    $nama = trim(htmlspecialchars($_POST['fullname']));
    $jabatan = $_POST['jabatan'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $gambar = htmlspecialchars($_FILES['gambar']['name']);
    $gbrLama = htmlspecialchars($_POST['gambarLama']);
    

    // cek username
    // $cekUsername = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' ");
    // if ($username === $userLama) {
    //     if (mysqli_num_rows($cekUsername)) {
    //         echo "<script>
    //             alert('username sudah terpakai!');
    //             window.location = 'data-user.php';
    //         </script>";
    //         return;
    //     }
    // }

    // cek gambar
    if ($gambar != null) {
        $url = 'index.php';
        $gbrUser = uploadGmbr($url);
        if ($gbrLama !== 'user2.png') {
            @unlink('../assets/img/img-user/' . $gbrLama);
        }
    } else {
        $gbrUser = $gbrLama;
    }

    mysqli_query($koneksi, "UPDATE tb_user SET
                            username = '$username',
                            fullname = '$nama',
                            jabatan = '$jabatan',
                            alamat = '$alamat',
                            gambar = '$gbrUser'
                            WHERE id_user = $id
                            ");

    echo "<script>
            alert('user berhasil diperbarui!');
            window.location = 'index.php';
        </script>";
        return;
}

// ganti password
if (isset($_POST['ganti-password'])) {
    $passold = trim(htmlspecialchars($_POST['passOld']));
    $passnew = trim(htmlspecialchars($_POST['passNew']));
    $confpass = trim(htmlspecialchars($_POST['confPass']));

    $userLogin = $_SESSION['ssUserRM'];
    $cekPass = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$userLogin'");
    $query = mysqli_fetch_assoc($cekPass);

    

    if ($passnew !== $confpass) {
        echo "<script>
            alert('password baru dan konfirmsi password tidak sama!');
            window.location = '../autentikasi/password.php';
        </script>";
        return false;
    }
    

    if (!password_verify($passold, $query['password'])) {
        echo "<script>
            alert('password anda salah!');
            window.location = '../autentikasi/password.php';
        </script>";
        return false;
    } else {
        $pass = password_hash($passnew, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tb_user SET password = '$pass' WHERE username = '$userLogin'");
        echo "<script>
            alert('password berhasil diganti!');
            window.location = '../autentikasi/index.php';
        </script>";
        return true;
    }
}

?>

