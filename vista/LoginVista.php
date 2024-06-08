<?php
use config\componentes\configSistema as configSistema;
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once "bin/component/head.php";?>
<body style="background:#991B27;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main class="d-flex align-items-center justify-content-center vh-100">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Cedula</span>
                                <input type="Text" name="telefono" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="telefono" required>
                            </div>
                            <span id="stelefono"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombres</span>
                                <input type="Text" name="RifC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="fecha_nacimiento" required>
                            </div>
                            <span id="sfecha_nacimiento"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Apellidos</span>
                                <input type="Text" name="RifC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="fecha_nacimiento" required>
                            </div>
                            <span id="sfecha_nacimiento"></span>
                        </div>
                        <div class="col-12">
                                <div class="input-group mb-1">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Cargo</span>
                                    <select type="select" class="form-select" id="sexo" aria-label="Default select example">
                                        <option value="0" selected>--Seleccione--</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Usuario">Usuario</option>
                                    </select>
                                </div>
                                <span id="ssexo"></span>
                            </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Clave</span>
                                <input type="Text" name="RifC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="fecha_ingreso" required>
                            </div>
                            <span id="sfecha_ingreso"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Confirmar Clave</span>
                                <input type="Text" name="RifC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="fecha_ingreso" required>
                            </div>
                            <span id="sfecha_ingreso"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Registrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <form>
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="card-header">
                                        <center>
                                            <img src="assets/img/CenSPORT.jpg" alt="Logo" style="height: 130px; width: 270px;">
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="d-flex align-items-center justify-content-center mb-0">
                                            <a class="btn btn-secondary border" href="?pagina=<?php configSistema::_PRINCIPAL_();?>">Iniciar Sesión</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php include_once "bin/component/footer.php";?>
        </div>
    </div>
    <script src="plugins/jquery/jquery.js" crossorigin="anonymous"></script>
    <script src="plugins/all/js/all.min.js" crossorigin="anonymous"></script> 
    <script src="plugins/popper/popper.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && event.shiftKey && event.key === 'y') {
        $("#exampleModal").modal("show");
    }
    });
    </script>
</body>
</html>
