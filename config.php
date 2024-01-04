<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = "db_rekammedis";

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

$main_url = "http://localhost/rekam_medis/";

function uploadGmbr($url) {
    $namaFile = $_FILES['gambar']['name'];   // cara baca => cari name="gambar" lalu ambil namanya
    $ukuran = $_FILES['gambar']['size'];    //  cari nama="gambar" lalu ambil ukurannya
    $tmp = $_FILES['gambar']['tmp_name'];   //  cari nama="gambar" lalu simpan di tempat sementara


    // cek extensi gambar
    $extensiValid = ['jpg', 'jpeg', 'png'];
    $extensiFile = explode('.', $namaFile);
    $extensi = strtolower(end($extensiFile));
    
    if(!in_array($extensi, $extensiValid)) {
        echo "<script>
            alert('extensi gambar anda tidak sesuai!');
            window.location = '$url';
        </script>";
        die();
    }
    
    // cwk ukuran gambar
    if ($ukuran > 1000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar!, max( 1mb )');
            window.location = '$url';
        </script>";
        die();    
    }


    // memasukkan filenya
    $namaFileBaru = time() . '-' . $namaFile;
    move_uploaded_file($tmp, '../assets/img/img-user/' . $namaFileBaru);

    return $namaFileBaru;

}


function in_date($date) {
    // untuk mmembuat tnggl dalam bentuk indonesia
    $dd = substr($date, 8, 2);
    $mm = substr($date, 5, 2);
    $yy = substr($date, 0, 4);

    return $dd . '-' . $mm . '-' . $yy;
}

function umur($tnggl_lahir) {
    $tngglLahir  = new DateTime($tnggl_lahir);
    $hariIni = new DateTime('today');

    $umur = $hariIni->diff($tngglLahir)->y;

    return $umur . " tahun";
}

?>