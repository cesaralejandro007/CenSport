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
                <div class="d-flex justify-content-between align-items-end">
                    <button type="button" class="btn btn-dark border m-2" id="nuevo" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Registrar Funcionario
                    </button>  
                    <div class="py-2 px-4" style="border-radius: 0 0 0 50%; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';" >
                        <h2 class="m-0">Módulo Persona</h2>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Registrar Funcionario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Incluir</button>
                        </div>
                        </div>
                    </div>
                </div>
                    <div class="container-fluid px-2">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Información de Funcionarios
                            </div>
                            <div style="padding:0 15px 15px 15px" class="card-body">
                            <table id="tabla" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Sexo</th>
                                            <th>Correo</th>
                                            <th>Edad</th>
                                            <th>Fecha de Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Sexo</th>
                                            <th>Correo</th>
                                            <th>Edad</th>
                                            <th>Fecha de Ingreso</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
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
        <script src="plugins/demo/datatables-funcionario.js"></script>
        
        <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
        
        <script src="content/js/scripts.js"></script>
    </body>
</html>
