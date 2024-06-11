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
                                <input type="Text" name="user" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="user" required>
                            </div>
                            <span id="suser"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombres</span>
                                <input type="Text" name="nombres" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="nombres" required>
                            </div>
                            <span id="snombres"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Apellidos</span>
                                <input type="Text" name="apellidos" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="apellidos" required>
                            </div>
                            <span id="sapellidos"></span>
                        </div>
                        <div class="col-12">
                                <div class="input-group mb-1">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Cargo</span>
                                    <select type="select" class="form-select" id="rol" aria-label="Default select example">
                                        <option value="0" selected>--Seleccione--</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Usuario">Usuario</option>
                                    </select>
                                </div>
                                <span id="srol"></span>
                            </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Clave</span>
                                <input type="password" name="clave" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="clave" required>
                            </div>
                            <span id="sclave"></span>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="inputGroup-sizing-default">Confirmar Clave</span>
                                <input type="password" name="clave2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="clave2" required>
                            </div>
                            <span id="sclave2"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="enviar" type="button" class="btn btn-primary">Registrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <form>                    
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="d-flex justify-content-center py-1">
                                        <img src="assets/img/SOP.png" class="img-fluid border-bottom border-5 border-danger" alt="Imagen de SOP">
                                    </div>
                                    <div class="card-header">
                                        <center>
                                            <img src="assets/img/CenSPORT.jpg" alt="Logo" style="height: 130px; width: 270px;">
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsuario" type="text" placeholder="Usuario" />
                                            <label for="inputUsuario">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="d-flex align-items-center justify-content-center mb-0">
                                            <button id="ingresar" type="button" class="btn btn-secondary">Iniciar Sesión</button>
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
    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="content/js/login.js"></script>
</body>
</html>
