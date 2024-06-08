<?php
use config\componentes\configSistema as configSistema;
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once "bin/component/head.php";?>
    <body class="sb-nav-fixed">
      <?php include_once "bin/component/header.php";?>
            <style>
                .integrantes-table-container {
                    max-height: 200px;
                    overflow-y: auto;
                }
            </style>
        <div id="layoutSidenav">
          <?php include_once "bin/component/sidebar.php";?>
          <div id="layoutSidenav_content" style="background:#D4E6F1;">
            <main>
                <div class="d-flex justify-content-between align-items-end">
                    <button type="button" class="btn btn-success border m-2" id="evento">
                        Registrar Grupos
                    </button>  
                    <div class="py-2 px-4" style="border-radius: 0 0 0 50%; margin-bottom:10px; background:#D4AC0D; font-family:'Baskerville Old Face';" >
                        <h2 class="m-0">Módulo Grupos Deportivos</h2>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Registrar Grupos Deportivos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="accion" class="form-control" id="accion">
                            <input type="hidden" name="id" class="form-control" id="id_deporte">
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label class="input-group-text" for="deporte_selec">Deporte</label>
                                    <select class="form-select" id="deporte_selec">
                                    <option value="0">--Seleccione--</option>
                                        <?php foreach($deportes as $key => $deport) {?>
                                            
                                        <option value="<?php echo $deport["id_deporte"];?>"><?php echo $deport["nombre_deporte"]; ?></option>
                                        <?php }?>
                                    </select>
                                    </div>
                                <spam id="sdeporte"></spam>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label for="nombre_grupo" class="input-group-text">Nombre de Grupo</label>
                                    <input type="text" name="nombre_grupo" class="form-control" id="nombre_grupo" required>
                                    <span id="snombre_grupo"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label for="descripcion_grupo" class="input-group-text">Descripción</label>
                                    <input type="text" name="RifC" class="form-control" id="descripcion_grupo" required>
                                    <span id="sdescripcion_grupo"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-2"> 
                                <div class="input-group">
                                    <label for="cedula_persona_grupo" class="input-group-text">Integrante</label>
                                    <input class="form-control" list="opcion_persona" id="cedula_persona_grupo" placeholder="Cedula persona">
                                    <datalist id="opcion_persona">
                                        <?php foreach ($cedulas as $key => $persona) {?>
                                        <option value="<?php echo $persona["cedula"]; ?>">
                                            <?php echo $persona["nombres"] . " " . $persona["apellidos"]; ?>
                                        </option>
                                        <?php }?>
                                    </datalist>
                                    <button id='agregar' class="btn btn-secondary" type="button">Agregar</button>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label>Integrantes agregados:
                                </label>
                                <div class="text-center" style='width:100%;height:200px;overflow-y: scroll;background: #D4E6F4'>
                                    <table id='integrantes_agregados' class='table table-striped'>
                                        <thead>
                                            <tr>
                                                <th>Cedula</th>
                                                <th>Nombre</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody_integrantes'>
                                            <!-- Aquí se agregarán los integrantes -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="seleccionar_area"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="background:#9D2323;" class="btn text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button id="enviar" type="button" class="btn btn-primary">Incluir</button>
                        </div>
                        </div>
                    </div>
                </div>
                    <div class="container-fluid px-2">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Información de Grupos Deportivos
                            </div>
                            <div style="padding:0 15px 15px 15px" class="card-body table-responsive">
                            <table id="tabla" class="table table-bordered table-hover datatable border">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Deporte</th>
                                            <th>Nombre de Grupo</th>
                                            <th>Descripción de Grupo</th>
                                            <th>Integrantes</th>
                                            <th>Cant. Integrante</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Deporte</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Integrantes</th>
                                            <th>Cant. Integrante</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>  
                                    <?php foreach ($grupos_deportivos as $grupo): ?>
                                    <tr>
                                        <td class="project-actions text-left">
                                            <div class="d-flex">
                                                <button class="btn m-1 text-white px-2 py-1" style="background:#E67E22;" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Editar"
                                                onclick="cargar_datos(<?= $grupo['id_grupo_deportivo'] ?>);"><i style="font-size: 15px" class="fas fa-edit"></i></button>

                                                <button class="btn m-1 px-2 py-1" style="background:#9D2323;color:white"  type="button" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Eliminar"
                                                onclick="eliminar(<?= $grupo['id_grupo_deportivo'] ?>);"><i style="font-size: 15px" class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td><?= $grupo['deporte'] ?></td>
                                        <td><?= $grupo['nombre_grupo'] ?></td>
                                        <td><?= $grupo['descripcion_grupo'] ?></td>
                                        <td>
                                            <div class="integrantes-table-container">
                                                <table class="table table-secondary table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Cédula</th>
                                                            <th scope="col">Nombres</th>
                                                            <th scope="col">Apellidos</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Cédula</th>
                                                            <th>Nombres</th>
                                                            <th>Apellidos</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php foreach ($grupo['integrantes'] as $integrante): ?>
                                                            <tr>
                                                                <td><?= $integrante['cedula'] ?></td>
                                                                <td><?= $integrante['nombres'] ?></td>
                                                                <td><?= $integrante['apellidos'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td><?= $grupo['cantidad_integrantes'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
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
        <script src="plugins/demo/datatables-grupos.js"></script>
        
        <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
        
        <script src="content/js/scripts.js"></script>
        <script src="content/js/grupos_deportivos.js"></script>
    </body>
</html>
