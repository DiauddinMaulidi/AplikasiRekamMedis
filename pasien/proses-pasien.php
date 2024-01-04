<?php
    session_start();

    if(!isset($_SESSION['ssLoginRM'])) {
        header("location: ../autentikasi/index.php");
        exit();
    }

    require "../config.php";

    if (isset($_POST['simpan'])) {
        $nama = trim(htmlspecialchars($_POST['nama']));
        $tnggl_lahir = $_POST['tnggl_lahir'];
        $gender = $_POST['gender'];
        $telpon = trim(htmlspecialchars($_POST['telpon']));
        $alamat = trim(htmlspecialchars($_POST['alamat']));
        $id = date('ymdhis');

        mysqli_query($koneksi, "INSERT INTO tb_pasien VALUES ('$id', '$nama', '$tnggl_lahir', '$gender', '$telpon', '$alamat')");

        echo "<script>
            alert('Data pasien berhasil di Input');
            window.location = 'tambah-pasien.php';
        </script>";
        return;
    }

    if(@isset($_GET['aksi']) == 'hapus-pasien') {
        $id = $_GET['id'];

        mysqli_query($koneksi, "DELETE FROM tb_pasien WHERE id = '$id'");
        
        echo "<script>
            alert('data pasien berhasil dihapus');
            window.location = 'index.php';
        </script>";
        return;

    }

    if (isset($_POST['update'])) {
        // $id = $_POST['id'];
        $id = trim(htmlspecialchars($_POST['id']));
        $nama = trim(htmlspecialchars($_POST['nama']));
        $tnggl_lahir = $_POST['tnggl_lahir'];
        $gender = $_POST['gender'];
        $telpon = trim(htmlspecialchars($_POST['telpon']));
        $alamat = trim(htmlspecialchars($_POST['alamat']));

        mysqli_query($koneksi, "UPDATE tb_pasien SET
                                nama = '$nama',
                                tnggl_lahir = '$tnggl_lahir',
                                gender = '$gender',
                                telpon = '$telpon',
                                alamat = '$alamat'
                                WHERE id = '$id'
                                ");

        echo "<script>
            alert('data pasien berhasil diperbarui!');
            window.location = 'index.php';
        </script>";
        return;

    }



?>