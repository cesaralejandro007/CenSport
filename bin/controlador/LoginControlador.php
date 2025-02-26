<?php

use modelo\LoginModelo as Login;
use modelo\RegistroFuncionarioModelo as Funcionario;
use modelo\RegistroDeporteModelo as Deporte;
use modelo\AperturarCensoModelo as AperturarCenso;
use config\componentes\configSistema as configSistema;

session_start();
require_once 'bin/component/captcha/securimage/securimage.php';

$config = new configSistema;
$securimage = new Securimage();
$login = new Login();
$deporte = new Deporte();
$censo = new AperturarCenso();
$funcionario = new Funcionario();

if (!is_file($config->_Dir_Model_() . $pagina . $config->_MODEL_())) {
    exit("Falta definir la clase " . $pagina);
}

if (is_file("vista/" . $pagina . "Vista.php")) {

    if (!empty($_POST['accion'])) {
        $accion = $_POST['accion'];

        switch ($accion) {
            case "ingresar":
                $usuario = $_POST['usuario'] ?? '';
                $clave = $_POST['password'] ?? '';
                $codigo = $_POST['captcha'] ?? '';

                if (empty($usuario) || empty($clave) || empty($codigo)) {
                    echo json_encode([
                        'estatus' => '2',
                        'icon' => 'error',
                        'title' => 'Login',
                        'message' => 'Ingrese usuario, contraseña y código!'
                    ]);
                    exit;
                }

                $res_usuario = $login->verificar_usuario($usuario, $clave);
                if ($res_usuario && $securimage->check($codigo)) {
                    $info_usuario = $login->datos_usuario($usuario);
                    foreach ($info_usuario as $datos) {
                        $_SESSION['usuario'] = [
                            'id' => $datos['id_usuario'],
                            'cedula' => $datos['cedula'],
                            'nombres' => $datos['nombres'],
                            'apellidos' => $datos['apellidos'],
                            'rol' => $datos['cargo']
                        ];
                    }
                    echo json_encode([
                        'estatus' => '1',
                        'icon' => 'success',
                        'title' => 'Login',
                        'message' => 'Inicio exitoso!'
                    ]);
                } else {
                    echo json_encode([
                        'estatus' => '2',
                        'icon' => 'info',
                        'title' => 'Login',
                        'message' => 'Verifique los datos de usuario, contraseña y código!'
                    ]);
                }
                exit;

            case "codificarURL":
                echo configSistema::_PRINCIPAL_();
                exit;

            case "registrar_usuario":
                $cedula = $_POST['cedula'] ?? '';
                $nombres = $_POST['nombres'] ?? '';
                $apellidos = $_POST['apellidos'] ?? '';
                $rol = $_POST['rol'] ?? '';
                $clave_encriptada = password_hash($_POST['clave'] ?? '', PASSWORD_DEFAULT);

                $login->set_cedula($cedula);
                $login->set_nombres($nombres);
                $login->set_apellidos($apellidos);
                $login->set_rol($rol);
                $login->set_clave_encriptada($clave_encriptada);

                $response = $login->registrar_usuario();
                echo json_encode([
                    'estatus' => $response ? '1' : '2',
                    'icon' => $response ? 'success' : 'info',
                    'title' => 'Usuario',
                    'message' => $response ? 'Registro exitoso.' : 'El usuario ya está registrado.'
                ]);
                exit;

            case "buscar_area":
                $datos = $funcionario->buscar_area($_POST['id_division'] ?? '');
                echo $datos;
                exit;

            case "registrar":
                $array_disciplinas = explode(",", $_POST['disciplinas'] ?? '');
                $response = $funcionario->registrar_funcionario(
                    $_POST['cedula'] ?? '',
                    $_POST['nombres'] ?? '',
                    $_POST['apellidos'] ?? '',
                    $_POST['sexo'] ?? '',
                    $_POST['telefono'] ?? '',
                    $_POST['fecha_nacimiento'] ?? '',
                    $_POST['fecha_ingreso'] ?? '',
                    $_POST['id_area'] ?? '',
                    $array_disciplinas
                );

                echo json_encode([
                    'estatus' => $response["resultado"] == 1 ? '1' : '2',
                    'icon' => $response["resultado"] == 1 ? 'success' : 'error',
                    'title' => "Censo",
                    'message' => $response["mensaje"]
                ]);
                exit;

            default:
                session_destroy();
                exit;
        }
    }

    $divisiones = $funcionario->listar_division();
    $lista_deportes = $deporte->listar_deportes();
    require_once "vista/" . $pagina . "Vista.php";

} else {
    exit("Página en construcción");
}
