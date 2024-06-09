<?php
use config\componentes\configSistema as configSistema;
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once "bin/component/head.php";?>
    <body class="sb-nav-fixed">
      <?php include_once "bin/component/header.php";?>
        <div id="layoutSidenav">
          <?php include_once "bin/component/sidebar.php";?>
          <div id="layoutSidenav_content" style="background:#D4E6F1;">
                <main>
                <div class="pagetitle">
  <div class="d-flex justify-content-start align-items-end">
  <div class="py-2 px-4" style="border-radius: 0 0 50% 0; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';">
      <h2 class="m-0">Perfil</h2>
    </div>
  </div>
    <section class="section profile m-3">
      <div class="row">
        <div class="col-xl-4">
        <input type="hidden" name="cedula_usuario" id="cedula_usuario"
                        value="" />
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['usuario']['nombres'] ?></h2>
              <h2><?php echo $_SESSION['usuario']['apellidos'] ?></h2>
              <h4> <?php echo $_SESSION['usuario']['rol']  ?></h4>
              <div class="social-links mt-2">
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">
        <div class="card">
  <div class="card-body pt-3">
    <!-- Bordered Tabs -->
    <ul class="nav nav-tabs nav-tabs-bordered">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detalle de la cuenta</button>
      </li>
    </ul>
    <div class="tab-content pt-2">
      <div class="tab-pane fade show active" id="profile-overview">
        <h5 class="card-title">Detalles de perfil</h5>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th scope="row">Cedula</th>
                <td><?php echo $_SESSION['usuario']['cedula']?></td>
              </tr>
              <tr>
                <th scope="row">Nombres</th>
                <td><?php echo  $_SESSION['usuario']['nombres'] ?></td>
              </tr>
              <tr>
                <th scope="row">Apellidos</th>
                <td><?php echo  $_SESSION['usuario']['apellidos'] ?></td>
              </tr>
              <tr>
                <th scope="row">Cargo en el sistema</th>
                <td><?php echo $_SESSION['usuario']['rol']?></td>
              </tr>
              <tr>
                <th scope="row">Compañia</th>
                <td>SENIAT</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- End Bordered Tabs -->
  </div>
</div>


        </div>
      </div>
    </section>
                </main>
                <?php include_once "bin/component/footer.php";?>
            </div>
        </div>
        <script src="plugins/jquery/jquery.js" crossorigin="anonymous"></script>
        
        <script src="plugins/all/js/all.min.js" crossorigin="anonymous"></script> 
        <script src="plugins/popper/popper.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="plugins/datatables/js/jszip.min.js"></script>
        <script src="plugins/datatables/js/pdfmake.min.js"></script>
        <script src="plugins/datatables/js/vfs_fonts.js"></script>
        <script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/js/dataTables.bootstrap5.min.js"></script>
        <script src="plugins/datatables/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/js/buttons.bootstrap5.min.js"></script>
        <script src="plugins/datatables/js/buttons.colVis.min.js"></script>
        <script src="plugins/datatables/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables/js/buttons.print.min.js"></script>
        <script src="plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/js/responsive.bootstrap5.js"></script>
        <script src="plugins/datatables/js/simple-datatables.min.js" crossorigin="anonymous"></script>
        
        <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
        
        <script src="content/js/scripts.js"></script>
    </body>
</html>
