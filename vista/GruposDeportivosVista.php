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
                    <button type="button" class="btn btn-success border m-2" id="nuevo" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                            <input type="hidden" name="id" class="form-control" id="id_usuario">
                            <input type="hidden" name="id" class="form-control" id="cedula">
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label class="input-group-text" for="deporte">Deporte</label>
                                    <select class="form-select" id="deporte">
                                    <option value="0">--Seleccione--</option>
                                        <?php foreach($deporte as $key => $deport) {?>
                                            
                                        <option value="<?php echo $deport["id_deporte"];?>"><?php echo $deport["nombre_deporte"]; ?></option>
                                        <?php }?>
                                    </select>
                                    <spam id="sdeporte"></spam>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label for="grupo" class="input-group-text">Nombre de Grupo</label>
                                    <input type="text" name="RifC" class="form-control" id="grupo" required>
                                    <span id="sgrupo"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-group">
                                    <label for="descripcion" class="input-group-text">Descripción</label>
                                    <input type="text" name="RifC" class="form-control" id="descripcion" required>
                                    <span id="sdescripcion"></span>
                                </div>
                            </div>
                            <div class="col-12 mt-2"> 
                                <div class="input-group">
                                    <label for="exampleDataList" class="input-group-text">Integrante</label>
                                    <input class="form-control" list="opcion_persona" id="exampleDataList" placeholder="Cedula persona">
                                    <datalist id="opcion_persona">
                                        <?php foreach ($cedula as $key => $persona) {?>
                                        <option value="<?php echo $persona["cedula"]; ?>">
                                            <?php echo $persona["nombres"] . " " . $persona["apellidos"]; ?>
                                        </option>
                                        <?php }?>
                                    </datalist>
                                    <button id='agregar' class="btn btn-secondary" type="button">Agregar</button>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                  <label>Integrantes agregados a
                                    <span id='nombre_persona'></span>
                                    </label>
                                <div class="text-center" style='width:95%;height:200px;overflow-y: scroll;background: #D4E6F4'>
                                    <div id='integrantes_agregados' style='width:95%;margin-top:10px;'></div>
                                </div>
                            </div>
                            <div id="seleccionar_area"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="background:#9D2323;" class="btn text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Incluir</button>
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
                            <table id="tabla" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>Deporte</th>
                                            <th>Nombre de Grupo</th>
                                            <th>Descripción de Grupo</th>
                                            <th>Integrantes</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Deporte</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Integrantes</th>
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
        <script src="plugins/demo/datatables-grupos.js"></script>
        
        <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
        
        <script src="content/js/scripts.js"></script>
        <script src="content/js/grupos_deportivos.js"></script>
    </body>
</html>
