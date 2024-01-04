
<div class="container-fluid">
  <div class="row">
    <?php
      $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri_segment = explode('/', $uri_path);
      $menu = $uri_segment[2];

      $userLogin = $_SESSION['ssUserRM'];
      $cekUser = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$userLogin'");
      $result = mysqli_fetch_assoc($cekUser);

    ?>
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h1 class="offcanvas-title" id="sidebarMenuLabel">Company name</h1>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'index.php' ? 'active' : null ?>" aria-current="page" href="<?= $main_url ?>index.php">
                <svg class="bi"><use xlink:href="#house-fill"/></svg>
                Dashboard
              </a>
            </li>
            <?php if ($result['jabatan'] == 1) { ?> 
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'user' ? 'active' : null ?>" href="<?= $main_url ?>user">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                  <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                  </svg>
                  Users
                </a>
              </li>
            <?php  } ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'autentikasi' ? 'active' : null ?>" href="<?= $main_url ?>autentikasi/password.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
                Ganti Password
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Data</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <svg class="bi"><use xlink:href="#plus-circle"/></svg>
            </a>
          </h6>
          <ul class="nav flex-column mb-auto">

          <?php if ($result['jabatan'] != 3) { ?> 
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'pasien' ? 'active' : '' ?>" href="<?= $main_url ?>pasien">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg>
                Pasien
              </a>
            </li>
            <?php } ?>
            <?php if ($result['jabatan'] != 3) { ?> 
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'obat' ? 'active' : '' ?>" href="<?= $main_url ?>obat/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-capsule-pill" viewBox="0 0 16 16">
                <path d="M11.02 5.364a3 3 0 0 0-4.242-4.243L1.121 6.778a3 3 0 1 0 4.243 4.243l5.657-5.657Zm-6.413-.657 2.878-2.879a2 2 0 1 1 2.829 2.829L7.435 7.536zM12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8m-.5 1.042a3 3 0 0 0 0 5.917zm1 5.917a3 3 0 0 0 0-5.917z"/>
                </svg>
                Obat
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'rekammedis' ? 'active' : '' ?>" href="<?= $main_url ?>rekammedis/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16">
                <path d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9z"/>
                <path d="M.88 8C-2.427 1.68 4.41-2 7.823 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
                </svg>
                Rekam Medis
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Laporan</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <svg class="bi"><use xlink:href="#plus-circle"/></svg>
            </a>
          </h6>

          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'riwayat-perekaman' ? 'active' : '' ?>" href="<?= $main_url ?>riwayat-perekaman">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-doc" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-7.839 9.166v.522c0 .256-.039.47-.117.641a.861.861 0 0 1-.322.387.877.877 0 0 1-.469.126.883.883 0 0 1-.471-.126.868.868 0 0 1-.32-.386 1.55 1.55 0 0 1-.117-.642v-.522c0-.257.04-.471.117-.641a.868.868 0 0 1 .32-.387.868.868 0 0 1 .471-.129c.176 0 .332.043.469.13a.861.861 0 0 1 .322.386c.078.17.117.384.117.641Zm.803.519v-.513c0-.377-.068-.7-.205-.972a1.46 1.46 0 0 0-.589-.63c-.254-.147-.56-.22-.917-.22-.355 0-.662.073-.92.22a1.441 1.441 0 0 0-.589.627c-.136.271-.205.596-.205.975v.513c0 .375.069.7.205.973.137.271.333.48.59.627.257.144.564.216.92.216.357 0 .662-.072.916-.216.256-.147.452-.356.59-.627.136-.274.204-.598.204-.973ZM0 11.926v4h1.459c.402 0 .735-.08.999-.238a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.59-.68c-.263-.156-.598-.234-1.004-.234H0Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.141 1.141 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082H.79V12.57Zm7.422.483a1.732 1.732 0 0 0-.103.633v.495c0 .246.034.455.103.627a.834.834 0 0 0 .298.393.845.845 0 0 0 .478.131.868.868 0 0 0 .401-.088.699.699 0 0 0 .273-.248.8.8 0 0 0 .117-.364h.765v.076a1.268 1.268 0 0 1-.226.674c-.137.194-.32.345-.55.454a1.81 1.81 0 0 1-.786.164c-.36 0-.664-.072-.914-.216a1.424 1.424 0 0 1-.571-.627c-.13-.272-.194-.597-.194-.976v-.498c0-.379.066-.705.197-.978.13-.274.321-.485.571-.633.252-.149.556-.223.911-.223.219 0 .421.032.607.097.187.062.35.153.489.272a1.326 1.326 0 0 1 .466.964v.073H9.78a.85.85 0 0 0-.12-.38.7.7 0 0 0-.273-.261.802.802 0 0 0-.398-.097.814.814 0 0 0-.475.138.868.868 0 0 0-.301.398Z"/>
                </svg>
                Riwayat Perekaman
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>