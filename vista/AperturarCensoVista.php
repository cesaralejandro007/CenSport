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
                        Registrar Censo
                    </button>
                    <div class="py-2 px-4"
                        style="border-radius: 0 0 0 50%; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';">
                        <h2 class="m-0">Módulo Aperturar Censo</h2>
                    </div>
                </div>
                <div class="container-fluid px-2">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Información de Censo
                        </div>
                        <div style="padding:0 15px 15px 15px" class="card-body table-responsive">
                            <table id="tablaCensos" class="table table-bordered table-hover datatable border">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listados_censo as $valor) 
                                {?>
                                    <tr>
                                        <td class="project-actions text-left">
                                            <div class="d-flex">
                                                <button class="btn m-1 text-white px-2 py-1" style="background:#E67E22;"
                                                    data-toggle="modal" data-toggle="tooltip" data-placement="top"
                                                    title="Editar"
                                                    onclick="cargar_datos(<?=$valor['id_censo'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-edit"></i></button>

                                                <button class="btn m-1 px-2 py-1" style="background:#9D2323;color:white"
                                                    type="button" data-toggle="modal" data-toggle="tooltip"
                                                    data-placement="top" title="Eliminar"
                                                    onclick="eliminar(<?=$valor['id_censo'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['nombre_censo']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['descripcion_censo']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['fecha_inicio_censo']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['fecha_final_censo']; ?>
                                        </td>
                                        <?php
                                }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            </main>
            
            <!-- Modal para agregar censo -->
            <div class="modal fade" id="modalCenso" tabindex="-1" aria-labelledby="modalCensoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCensoLabel">Registrar Censo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formCenso">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" required>
                                    <div id="nombre-error" class="text-danger"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" required></textarea>
                                    <div id="descripcion-error" class="text-danger"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha y Hora de Inicio</label>
                                    <input type="datetime-local" class="form-control" id="fecha_inicio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_fin" class="form-label">Fecha y Hora de Fin</label>
                                    <input type="datetime-local" class="form-control" id="fecha_fin" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
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
    <script src="plugins/demo/datatables-censo.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>

    <script src="content/js/scripts.js"></script>
    <script src="content/js/censo.js"></script>
</body>

</html>