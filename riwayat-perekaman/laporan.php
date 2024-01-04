<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../autentikasi/index.php");
    exit();
    }

    require "../config.php";
    require '../vendor/autoload.php';

    $title = "Laporan Perekaman";

    $id = $_GET['id'];
    $getPasien = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE id = '$id'");
    $pasien = mysqli_fetch_assoc($getPasien);
    
    if ($pasien['gender'] == "L") {
        $gender =  "Laki Laki";
    } else {
        $gender = "Perempuan";
    }


    // print PDF
    $content = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .head {
                text-align: center;
                margin-bottom: 40px;
                margin-top: -5px;
            }
            .label-head {
                width: 120px;
                text-align: left;
            }
            .data-left {
                width: 300px;
                text-align: left;
            }
            .data-right {
                width: 130px;
                text-align: left;
            }
            hr {
                margin-buttom: 2px;
                margin-left: -5px;
                width: 700px;
            }
            .table-head {
                width: 130px;
                padding-left: 1px;
                padding-bottom: 1px;
                text-align: left;
            }
            .data {
                vertical-align: top;
            }
        </style>
    </head>
    <body>
        <h2 class="head">Laporan Rekam Medis</h2>

        <table>
            <tr>
                <th class="label-head">ID Pasien</th>
                <td class="data-left">: '. $pasien['id'] .'</td>
                <th class="label-head">Umur</th>
                <td class="data-left">: '. umur($pasien['tnggl_lahir']) .'</td>
            </tr>
            <tr>
                <th class="label-head">Nama</th>
                <td class="data-right">: '. $pasien['nama'] .'</td>
                <th class="label-head">No Telpon</th>
                <td class="data-right">: '. $pasien['telpon'] .'</td>
            </tr>
            <tr>
                <th class="label-head">Jenis Kelamin</th>
                <td class="data-right">: '. $gender .'</td>
                <th class="label-head">Alamat</th>
                <td class="data-right">: '. $pasien['alamat'] .'</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="5">
                        <hr size="3">
                    </th>
                </tr>
                <tr>
                    <th class="table-head" style="width: 90px;">Tanggal</th>
                    <th class="table-head" style="width: 180px;">Keluhan</th>
                    <th class="table-head" style="width: 130px;">Diagnosa</th>
                    <th class="table-head" style="width: 210px;">Obat</th>
                    <th class="table-head" style="width: 70px;">Dokter</th>
                </tr>
                <tr>
                    <th colspan="5">
                        <hr size="3">
                    </th>
                </tr>
            </thead>
            <tbody>';
                $sqlRM = "SELECT * FROM tb_rekammedis INNER JOIN tb_user ON tb_rekammedis.id_dokter = tb_user.id_user WHERE id_pasien = '$id'";
                $queryRM = mysqli_query($koneksi, $sqlRM);
                while ($rm = mysqli_fetch_assoc($queryRM)) {
                    $content .= 
                        '<tr>
                            <td class="data">'. in_date($rm['tgl_rm']) .'</td>
                            <td class="data">'. $rm['keluhan'] .'</td>
                            <td class="data">'. $rm['diagnosa'] .'</td>
                            <td class="data">'. $rm['obat'] .'</td>
                            <td class="data">'. $rm['fullname'] .'</td>
                        </tr>';
                }
            $content .=
            '</tbody>
            <tfoot>
                <tr>
                    <th colspan="5">
                        <hr size="3">
                    </th>
                </tr>
            </tfoot>

        </table>

    </body>
    </html>';

    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($content);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream("Laporan Rekam Medis", array("attachment" => false));

?>