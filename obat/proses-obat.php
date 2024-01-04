<?php
    session_start();

    if(!isset($_SESSION['ssLoginRM'])) {
        header("location: ../autentikasi/index.php");
        exit();
    }

    require "../config.php";

    if (isset($_POST['simpan'])) {
        // $id = $_POST['id'];
        $nama = trim(htmlspecialchars($_POST['nama-obat']));
        $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));

        // cek nama obat
        $namaObat = mysqli_query($koneksi, "SELECT * FROM tb_obat WHERE nama_obat = '$nama'");
        if (mysqli_num_rows($namaObat)) {
            echo "<script>
                alert('nama obat sudah ada!');
                window.location = 'tambah-obat.php';
            </script>";
            return;
        }
        

        mysqli_query($koneksi, "INSERT INTO tb_obat VALUES(null, '$nama', '$kegunaan')");

        echo "<script>
            alert('obat berhasil ditambahkan!');
            window.location = 'tambah-obat.php';
        </script>";
        return;

    }

    if (@isset($_GET['aksi']) == 'hapus-obat') {
        $id = $_GET['id'];

        mysqli_query($koneksi, "DELETE FROM tb_obat WHERE id = '$id'");

        echo "<script>
            alert('data obat berhasil dihapus');
            window.location = 'index.php';
        </script>";
        return;
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = trim(htmlspecialchars($_POST['nama_obat']));
        $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));

        mysqli_query($koneksi, "UPDATE tb_obat SET
                                id = '$id',
                                nama_obat = '$nama',
                                kegunaan = '$kegunaan'
                                WHERE id = '$id'
                                ");

        echo "<script>
            alert('data obat berhasil diperbarui!');
            window.location = 'index.php';
            </script>";
        return;

    }


?>