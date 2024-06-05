<?php
use config\componentes\configSistema as configSistema;
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once "bin/component/head.php";?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main class="d-flex align-items-center justify-content-center vh-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <form>
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
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
                                            <a class="btn btn-primary" href="?pagina=<?php configSistema::_PRINCIPAL_();?>">Iniciar Sesión</a>
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
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="content/js/scripts.js"></script>
</body>
</html>
