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
        <div id="layoutSidenav_content" class="bg-secondary">
            <main>
                <div class="d-flex justify-content-between align-items-end ">
                    <button type="button" class="btn btn-success border mx-2 my-1" id="evento">
                        Registrar Funcionario
                    </button>
                    <div class="py-2 px-4 bg-dark text-light"
                        style="border-radius: 0 0 0 30px; margin-bottom:10px; font-family:'Baskerville Old Face';">
                        <h2 class="m-0">Módulo Personas</h2>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="titulo" class="modal-title" id="staticBackdropLabel">Registrar Funcionario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="accion" class="form-control" id="accion">
                                <input type="hidden" name="id" class="form-control" id="id_persona">
                                <input type="hidden" name="id" class="form-control" id="cedula_persona">
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Cedula</span>
                                        <input type="text" name="cedula" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="cedula" value="">
                                    </div>
                                    <span id="scedula"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Nombres</span>
                                        <input type="Text" name="Nro" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="nombres" required>
                                    </div>
                                    <span id="snombres"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Apellidos</span>
                                        <input type="Text" name="Sujeto Pasivo" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="apellidos" required>
                                    </div>
                                    <span id="sapellidos"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Género o
                                            Sexo</span>
                                        <select type="select" class="form-select" id="sexo"
                                            aria-label="Default select example">
                                            <option value="0" selected>--Seleccione--</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <span id="ssexo"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">telefono</span>
                                        <input type="Text" name="telefono" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="telefono" required>
                                    </div>
                                    <span id="stelefono"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha de
                                            Nacimiento</span>
                                        <input type="date" name="RifC" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="fecha_nacimiento" required>
                                    </div>
                                    <span id="sfecha_nacimiento"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha de Ingreso
                                            SENIAT</span>
                                        <input type="date" name="RifC" class="form-control"
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default" id="fecha_ingreso" required>
                                    </div>
                                    <span id="sfecha_ingreso"></span>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="inputGroup-sizing-default">División</span>
                                        <select class="form-select" id="select_division"
                                            aria-label="Default select example" required>
                                            <option value="0" selected>--Seleccione--</option>
                                            <?php foreach ($divisiones as $key => $value) {?>
                                            <option value="<?=$value['id_division'];?>">
                                                <?=$value['nombre_division'];?>
                                            </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <span id="sselect_division"></span>
                                </div>
                                <div id="selec_area"></div>
                                <div class="col-12 mt-2">
                                    <div class="input-group">
                                        <label for="id_diciplina" class="input-group-text">Disciplina</label>
                                        <input class="form-control" list="opcion_diciplina" id="id_diciplina"
                                            placeholder="Seleccione una disciplina">
                                        <datalist id="opcion_diciplina">
                                            <?php foreach ($lista_deportes as $deporte) { ?>
                                            <option value="<?php echo $deporte['nombre_deporte']; ?>">
                                                <?php echo $deporte['nombre_deporte']; ?>
                                            </option>
                                            <?php } ?>
                                        </datalist>
                                        <button id="agregar" class="btn btn-secondary" type="button">Agregar</button>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label>Disciplinas agregadas:</label>
                                    <div class="text-center"
                                        style="width:100%; height:200px; overflow-y: scroll; background: #D4E6F4">
                                        <table id="disciplinas_agregadas" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Deporte</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_disciplinas">
                                                <!-- Aquí se agregarán las disciplinas seleccionadas -->
                                            </tbody>
                                        </table>
                                    </div>
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Información de Funcionarios
                        </div>
                        <div style="padding:0 15px 15px 15px" class="card-body table-responsive">
                            <table id="tabla" class="table table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Sexo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Edad</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Telefono</th>
                                        <th>Diciplinas</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Sexo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Edad</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Telefono</th>
                                        <th>Diciplinas</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                foreach ($funcionarios as $valor) 
                                {?>
                                    <tr>
                                        <td class="project-actions text-left">
                                            <div class="d-flex">
                                                <button class="btn m-1 text-white px-2 py-1" style="background:#E67E22;"
                                                    data-toggle="modal" data-toggle="tooltip" data-placement="top"
                                                    title="Editar"
                                                    onclick="cargar_datos(<?=$valor['id_persona'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-edit"></i></button>

                                                <button class="btn m-1 px-2 py-1" style="background:#9D2323;color:white"
                                                    type="button" data-toggle="modal" data-toggle="tooltip"
                                                    data-placement="top" title="Eliminar"
                                                    onclick="eliminar(<?=$valor['id_persona'];?>);"><i
                                                        style="font-size: 15px" class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['cedula']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['nombres']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['apellidos']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['sexo']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['fecha_nacimiento_formateada']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['edad']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['fecha_formateada']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['telefono']; ?>
                                        </td>
                                        <td class="project-actions text-left">
                                            <?php echo $valor['deportes_vinculados']; ?>
                                        </td>
                                    </tr>
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
    <script src="plugins/datatables/js/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="plugins/demo/datatables-funcionario.js"></script>

    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>

    <script src="content/js/scripts.js"></script>
    <script src="content/js/funcionarios.js"></script>
</body>

</html>