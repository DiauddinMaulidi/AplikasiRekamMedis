<?php

    session_start();

    require "../config.php";
    
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $cekUser = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

        if (mysqli_num_rows($cekUser) === 1) {
            $row = mysqli_fetch_assoc($cekUser);
            if (password_verify($password, $row['password'])) {
                
                // set session
                $_SESSION['ssLoginRM'] = true;
                $_SESSION['ssUserRM'] = $username;
                
                header("location: ../index.php");
                exit();
            } else {
                echo "<script>
                        alert('password anda salah');
                        document.location.href = 'index.php';
                    </script>";
                }
        } else {
            echo "<script>
                alert('login gagal');
                window.location = 'index.php';
            </script>";
        }
   
    }

?>