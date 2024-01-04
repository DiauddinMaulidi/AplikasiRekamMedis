<?php
  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: autentikasi/index.php");
    exit();
  }
  require "config.php";

  $main_url = "http://localhost/rekam_medis/";

  $title = "Rekam Medis Puskesmas";
  
  require "template/header.php";
  require "template/navbar.php";
  require "template/sidebar.php";

?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pengunjung</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
            <svg class="bi"><use xlink:href="#calendar3"/></svg>
            Tahun ini
          </div>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>Section title</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,013</td>
              <td>apaksas</td>
              <td>irrelevant</td>
              <td>text</td>
              <td>visual</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

<?php 

  require "template/footer.php"; 

?>