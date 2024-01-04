<?php
    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
      header("location: ../autentikasi/index.php");
      exit();
    }  

    require "../config.php";
  
    // $main_url = "http://localhost/rekam_medis/";

    
    
    
    $title = "Tambah Data";
    
    require "../template/header.php";
    require "../template/navbar.php";
    require "../template/sidebar.php";
    
    // mengatur no rekam medis
    $today = date('dmy');
    $getNomor = mysqli_query($koneksi, "SELECT max(no_rm) as maxno FROM tb_rekammedis WHERE right(no_rm, 6) = '$today'");
    $dataNo = mysqli_fetch_assoc($getNomor);
    $noRM = $dataNo['maxno'];

    $noUrut = (int) substr($noRM, 3, 3);
    $noUrut++;

    $noRM = 'RM-' . sprintf("%03s", $noUrut) . '-' . $today;
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Perekaman</h1>
        <a href="<?= $main_url ?>rekammedis/" class="text-decoration-none"><i class="bi bi-arrow-left-square align-top"></i> Kembali</a>
      </div>

        <form action="proses-data.php" method="post" class="form-bottom">
            <div class="row">
                <div class="col-lg-6 pe-4">
                    <div class="form-group mb-3">
                        <label for="no_rm" class="form-label">No Rekam Medis</label>
                        <input type="text" name="no_rm" class="form-control" id="no_rm" value="<?= $noRM ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tgl" class="form-label">Tanggal Perekaman</label>
                        <input type="date" name="tgl" class="form-control" id="tgl" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="pasien" class="form-label">Pasien</label>
                        <div class="input-group mb-3">
                            <input type="text" id="pasien_id" name="id" class="form-control" placeholder="ID Pasien" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="cari" data-bs-toggle="modal" data-bs-target="#modalPasien"><i class="bi bi-search align-top"></i></button>
                        </div>
                        <input type="text" name="namaPasien" class="form-control border-0 border-bottom mb-3" id="namaPasien" placeholder="nama pasien" readonly>
                        <textarea name="alamatPasien" id="alamatPasien" class="form-control border-0 border-bottom" placeholder="alamat pasien" rows="1" readonly></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" class="form-control" placeholder="keluhan yang dialami"></textarea>
                    </div>
                </div>
                
                <div class="col-lg-6 border-start ps-3">
                    <div class="form-group mb-3">
                        <label for="dokter" class="form-label">Dokter</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="pilih" class=" form-control">--Pilih Dokter--</option>
                            <?php
                                $getDokter = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE jabatan = 3");
                                while ($dokter = mysqli_fetch_assoc($getDokter)) {
                            ?>
                            <option value="<?= $dokter['id_user'] ?>"><?= $dokter['fullname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" placeholder="hasil dignosa dokter"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="obat" class="form-label">Obat</label>
                        <input type="text" name="obat" class="form-control" id="tokenfield">
                    </div>

                    <button type="reset" name="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top"></i> Reset</button>
                    <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top"></i> Simpan</button>    
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>Cari Pasien</h3>
                    <table class="table table-responsive table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Pasien</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $queryPasien = mysqli_query($koneksi, "SELECT * FROM tb_pasien");
                                while ($query = mysqli_fetch_assoc($queryPasien)) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $query['id'] ?></td>
                                        <td><?= $query['nama'] ?></td>
                                        <td><?= $query['alamat'] ?></td>
                                        <td>
                                            <button type="button" title="pilih pasien" id="cekPasien" data-id="<?= $query['id'] ?>" data-nama="<?= $query['nama'] ?>" data-alamat="<?= $query['alamat'] ?>" class="btn btn-sm btn-outline-primary cekPasien"><i class="bi bi-check-lg"></i></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

    </main>

    <!-- tokenField -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.cekPasien', function() {
                let idPasien = $(this).data('id');
                let namaPasien = $(this).data('nama');
                let alamatPasien = $(this).data('alamat');
                $('#pasien_id').val(idPasien);
                $('#namaPasien').val(namaPasien);
                $('#alamatPasien').val(alamatPasien);

                $('#modalPasien').modal('hide');

            })

            <?php
                $cekObat = mysqli_query($koneksi, "SELECT * FROM tb_obat");
                while ($perobatan = mysqli_fetch_assoc($cekObat)) {
                    $obat[] = $perobatan['nama_obat'];
                }
            ?>

            $('#tokenfield').tokenfield({
                autocomplete: {
                    source: [<?php echo '"' . implode('","', $obat) . '"' ?>],
                    delay: 100
                },
                showAutocompleteOnFocus: true
            })
        })
    </script>

<?php 

  require "../template/footer.php"; 

?>

