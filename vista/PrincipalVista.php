<?php
use config\componentes\configSistema as configSistema;
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once "bin/component/head.php";?>

    <style>
        .card-bg1 {
            background-image: url('assets/img/Funcionarios.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }

        .card-bg1 .card-body, .card-bg1 .card-footer {
            background: rgba(0, 123, 255, 0.5); /* Fondo semitransparente */
        }

        .card-bg2 {
            background-image: url('assets/img/Deportes.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }

        .card-bg2 .card-body, .card-bg2 .card-footer {
            background: rgba(0, 128, 0, 0.5); /* Fondo semitransparente */
        }

        .card-bg3 {
            background-image: url('assets/img/Grupos.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }

        .card-bg3 .card-body, .card-bg3 .card-footer {
            background: rgba(220, 53, 69, 0.5); /* Fondo semitransparente */
        }
    </style>
    <body class="sb-nav-fixed">
      <?php include_once "bin/component/header.php";?>
        <div id="layoutSidenav">
          <?php include_once "bin/component/sidebar.php";?>
            <div id="layoutSidenav_content" style="background:#D4E6F1;">
                <main>
                <div class="d-flex justify-content-start align-items-end">
                  <div class="py-2 px-4" style="border-radius: 0 0 50% 0; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';">
                    <h2 class="m-0">Pagina Principal</h2>
                  </div>
                </div>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-primary text-white mb-4 card-bg1">
                                    <div class="card-body fw-bold">Modulo Funcionarios</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?pagina=<?php configSistema::_Funcionarios_();?>">Ver Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-success text-white mb-4 card-bg2">
                                    <div class="card-body fw-bold">Modulo Deportes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?pagina=<?php configSistema::_Deportes_();?>">Ver Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-danger text-white mb-4 card-bg3">
                                    <div class="card-body fw-bold">Grupos Deportivos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?pagina=<?php configSistema::_Grupos_();?>">Ver Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Resumen
                            </div>
                            <div class="card-body table-responsive">
                            <table id="tabla" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Sexo</th>
                                            <th>Correo</th>
                                            <th>Edad</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Deporte</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Sexo</th>
                                            <th>Correo</th>
                                            <th>Edad</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Deporte</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Roporte de Deporte X Persona
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="plugins/demo/datatables-principal.js"></script>

        <script src="plugins/sweetalert2/sweetalert2.all.js"></script>

        <script src="content/js/scripts.js"></script>
        <script src="plugins/Chart.min.js" crossorigin="anonymous"></script>
        <script src="plugins/demo/chart-area-demo.js"></script>
        <script src="plugins/demo/chart-bar-demo.js"></script>
        <script src="plugins/datatables/js/simple-datatables.min.js" crossorigin="anonymous"></script>
    </body>
</html>
