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
                    <button type="button" class="btn btn-success border m-2" id="evento">
                        Registrar Deporte
                    </button>
                    <div class="py-2 px-4"
                        style="border-radius: 0 0 0 50%; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';">
                        <h2 class="m-0">Módulo Deporte</h2>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Registrar Deporte</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="accion" class="form-control" id="accion">
                                <input type="hidden" name="id" class="form-control" id="id_deporte">
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Nombre de
                                            Deporte</span>
                                        <input type="Text" name="Nro" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="nombre_deporte" required>
                                    </div>
                                    <span id="snombre_deporte"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="background:#9D2323;" class="btn text-white"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button id="enviar" type="button" class="btn btn-primary">Incluir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid px-2">
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Información de Deportes
                        </div>
                        <div style="padding:0 15px 15px 15px" class="card-body table-responsive">
                            <table id="tabla" class="table table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Deporte</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Deporte</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                foreach ($lista_deportes as $valor) 
                                {?>
                                    <tr>
                                        <td class="project-actions text-left">
                                            <div class="d-flex">
                                                <button class="btn m-1 text-white px-2 py-1" style="background:#E67E22;"
                                                    data-toggle="modal" data-toggle="tooltip" data-placement="top"
                                                    title="Editar"
                                                    onclick="cargar_datos(<?=$valor['id_deporte'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-edit"></i></button>

                                                <button class="btn m-1 px-2 py-1" style="background:#9D2323;color:white"
                                                    type="button" data-toggle="modal" data-toggle="tooltip"
                                                    data-placement="top" title="Eliminar"
                                                    onclick="eliminar(<?=$valor['id_deporte'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['nombre_deporte']; ?>
                                        </td>
                                        <?php
                                }?>
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

    <script src="plugins/demo/datatables-deporte.js"></script>

    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>

    <script src="content/js/scripts.js"></script>
    <script src="content/js/deporte.js"></script>
</body>

</html>