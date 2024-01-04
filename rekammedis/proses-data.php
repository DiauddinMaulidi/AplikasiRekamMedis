<?php
    session_start();

    if(!isset($_SESSION['ssLoginRM'])) {
        header("location: ../autentikasi/index.php");
        exit();
    }

    require "../config.php";

    if (isset($_POST['simpan'])) {
        $no_rm = $_POST['no_rm'];
        $tgl = $_POST['tgl'];
        $idPasien = $_POST['id'];
        $keluhan = trim(htmlspecialchars($_POST['keluhan']));
        $dokter = $_POST['dokter'];
        $diagnosa = trim(htmlspecialchars($_POST['diagnosa']));
        $obat = trim(htmlspecialchars($_POST['obat']));

        // cek nama obat
        mysqli_query($koneksi, "INSERT INTO tb_rekammedis VALUES('$no_rm', '$tgl', '$idPasien','$keluhan','$dokter','$diagnosa','$obat')");

        echo "<script>
            alert('data berhasil dimasukkan!');
            window.location = 'tambah-data.php';
        </script>";
        return;

    }
    

    if (@isset($_GET['aksi']) == 'hapus-data') {
        $noRM = $_GET['id'];

        mysqli_query($koneksi, "DELETE FROM tb_rekammedis WHERE no_rm = '$noRM'");

        echo "<script>
            alert('data rekaman berhasil dihapus');
            window.location = 'index.php';
        </script>";
        return;
    }


    if (isset($_POST['update'])) {
        $no_rm = $_POST['no_rm'];
        $tgl = $_POST['tgl'];
        $idPasien = $_POST['id'];
        $keluhan = trim(htmlspecialchars($_POST['keluhan']));
        $dokter = $_POST['dokter'];
        $diagnosa = trim(htmlspecialchars($_POST['diagnosa']));
        $obat = trim(htmlspecialchars($_POST['obat']));

        mysqli_query($koneksi, "UPDATE tb_rekammedis SET
                                tgl_rm = '$tgl',
                                id_pasien = '$idPasien',
                                keluhan = '$keluhan',
                                id_dokter = '$dokter',
                                diagnosa = '$diagnosa',
                                obat = '$obat'
                                WHERE no_rm = '$no_rm'
                                ");

        echo "<script>
            alert('data rekaman berhasil diperbarui!');
            window.location = 'index.php';
            </script>";
        return;

    }


?>